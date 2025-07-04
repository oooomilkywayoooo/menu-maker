<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Genre;
use App\Models\MenuDay;
use App\Models\MenuItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MenuItemController extends Controller
{
    /**
     * 献立自動生成機能
     */
    public function menusCreate(Request $request)
    {

        //前回の献立セッションを削除
        session()->forget('weeklyMenu');

        $days = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
        $genres = [
            'mon' => 1,
            'tue' => 2,
            'wed' => 3,
            'thu' => 4,
            'fri' => 5,
            'sat' => 6,
            'sun' => 6,
        ];

        $menu = [];

        foreach ($days as $day) {
            $input = $request->input($day);
            if (!empty($input)) {
                // 入力された料理名に一致するレシピをDBから取得（null許容）
                $recipe = Recipe::where('name', $input)->first();
                if ($recipe) {
                    $menu[$day] = [
                        'id' => $recipe->id,
                        'name' => $recipe->name
                    ];
                } else {
                    $menu[$day] = [
                        'id' => null,
                        'name' => $input // 名前だけは使う
                    ];
                }
            } else {
                // 今日から3週間前の日付
                $threeWeeksAgo = Carbon::now()->subWeeks(3)->toDateString();

                // 3週間以内に使われた recipe_id を取得
                $recentRecipeIds = MenuItem::whereHas('menuDay', function ($query) use ($threeWeeksAgo) {
                    $query->where('date', '>=', $threeWeeksAgo);
                })->pluck('recipe_id')->unique()->toArray();

                // そのレシピIDを除いて、該当ジャンルのレシピからランダム取得
                $randomRecipe = Recipe::where('genre_id', $genres[$day])
                    ->whereNotIn('id', $recentRecipeIds)
                    ->inRandomOrder()
                    ->first();

                $menu[$day] = $randomRecipe
                    ? ['id' => $randomRecipe->id, 'name' => $randomRecipe->name]
                    : ['id' => null, 'name' => 'レシピ未登録'];
            }
        }

        // セッションに保存
        session()->put('weeklyMenu', $menu);
        return redirect()->route('menu-items.index');
    }

    /**
     * 1週間の献立画面を表示
     */
    public function index()
    {
        // セッションがなければ空配列を返す
        $menu = session('weeklyMenu', [
            'mon' => '',
            'tue' => '',
            'wed' => '',
            'thu' => '',
            'fri' => '',
            'sat' => '',
            'sun' => '',
        ]);

        return view('one_week_menu', ['menu' => $menu]);
    }
    /**
     * 個別生成機能
     */
    public function eachCreate(Request $request)
    {
        $day = $request->query('day');
        $genreId = $request->query('genre_id');

        if (!$day || !$genreId) {
            return response()->json(['error' => '必要な情報がありません'], 400);
        }

        // お気に入り優先シャッフル
        $recipes = Recipe::where('genre_id', $genreId)->get();
        $weighted = collect();

        foreach ($recipes as $recipe) {
            // すべて1回 push（全レシピ含む）
            $weighted->push($recipe);

            // favorite が true のものはもう1回 push（=確率2倍）
            if ($recipe->favorite) {
                $weighted->push($recipe);
            }
        }

        $recipe = $weighted->shuffle()->first();

        // 現在のセッションデータを取得（なければ初期化）
        $weeklyMenu = session('weeklyMenu', [
            'mon' => ['name' => '', 'id' => null],
            'tue' => ['name' => '', 'id' => null],
            'wed' => ['name' => '', 'id' => null],
            'thu' => ['name' => '', 'id' => null],
            'fri' => ['name' => '', 'id' => null],
            'sat' => ['name' => '', 'id' => null],
            'sun' => ['name' => '', 'id' => null],
        ]);

        // 該当曜日の内容を更新
        $weeklyMenu[$day] = [
            'name' => $recipe?->name ?? 'レシピ未登録',
            'id' => $recipe?->id,
        ];

        // セッションを更新
        session(['weeklyMenu' => $weeklyMenu]);

        return response()->json([
            'name' => $weeklyMenu[$day]['name'],
            'id' => $weeklyMenu[$day]['id'],
        ]);
    }

    /**
     * 1週間献立登録機能
     */
    public function saveMenus(Request $request)
    {
        // バリデーション
        $validated = $request->validate([
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        $weeklyMenu = session('weeklyMenu');

        if (!$weeklyMenu || !is_array($weeklyMenu)) {
            return redirect()->back()->with('error', 'セッションに献立データがありません。');
        }

        // 曜日のキー一覧
        $weekKeys = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];

        // 開始日の曜日
        $startDate = Carbon::parse($validated['start']);
        $startWeekdayIndex = $startDate->dayOfWeek;

        // weeklyMenu を start の曜日から並べ替え
        $orderedWeekKeys = array_merge(
            array_slice($weekKeys, $startWeekdayIndex),
            array_slice($weekKeys, 0, $startWeekdayIndex)
        );

        // 7日分すべて揃っているかチェック
        foreach ($orderedWeekKeys as $dayKey) {
            if (!isset($weeklyMenu[$dayKey]['id']) || empty($weeklyMenu[$dayKey]['id'])) {
                return redirect()->back()
                    ->withInput() // 入力内容を保持
                    ->withErrors("献立の「{$dayKey}」のレシピが登録されていません。すべての日の献立を揃えてから再度登録してください。");
                // セッションは消さず再入力可能な状態にする
            }
        }

        // 実際の保存処理
        $currentDate = $startDate->copy();

        foreach ($orderedWeekKeys as $dayKey) {
            $menuItem = $weeklyMenu[$dayKey] ?? null;

            // menu_days に登録
            $menuDay = MenuDay::create([
                'date' => $currentDate->toDateString(),
            ]);

            // menu_items に登録
            if ($menuItem && !empty($menuItem['id'])) {
                MenuItem::create([
                    'menu_day_id' => $menuDay->id,
                    'recipe_id' => $menuItem['id'],
                    'day_of_week' => $dayKey,
                ]);
            }

            $currentDate->addDay();
        }

        // レシピの材料を全てセッションに追加
        // 全レシピIDを取得（重複を排除）
        $recipeIds = collect($weeklyMenu)
            ->pluck('id')
            ->unique()
            ->filter() // null対策
            ->values()
            ->all();

        // 材料の配列を初期化
        $allMaterials = [];

        if (!empty($recipeIds)) {
            $recipes = Recipe::whereIn('id', $recipeIds)->get();

            foreach ($recipes as $recipe) {
                $materials = json_decode($recipe->materials, true);

                if (is_array($materials)) {
                    foreach ($materials as $material) {
                        $allMaterials[] = [
                            'recipe_id' => $recipe->id,
                            'text' => $material,
                        ];
                    }
                }
            }
        }

        // 材料の「text」だけで重複を除去
        $uniqueMaterials = [];
        $addedTexts = [];

        foreach ($allMaterials as $material) {
            if (!in_array($material['text'], $addedTexts)) {
                $uniqueMaterials[] = $material;
                $addedTexts[] = $material['text'];
            }
        }

        // セッションに格納
        session(['allMaterials' => $uniqueMaterials]);

        session()->forget('weeklyMenu');

        return redirect()->route('home')->with('success', '1週間分の献立を保存しました！');
    }

    /**
     * 週間履歴の一覧表示
     */
    public function menuHistory()
    {
        $groups = DB::table('menu_items')
            ->select(
                DB::raw('DATE(menu_items.created_at) as created_date'),
                DB::raw('MIN(DATE(menu_days.date)) as start_date'),
                DB::raw('MAX(DATE(menu_days.date)) as end_date')
            )
            ->join('menu_days', 'menu_items.menu_day_id', '=', 'menu_days.id')
            ->groupBy('created_date')
            ->orderByDesc('created_date')
            ->get();

        return view('menu_history', compact('groups'));
    }

    /**
     * 週間履歴の詳細を表示
     */
    public function menuHistoryShow($date)
    {
        // $date で絞り込み
        $items = DB::table('menu_items')
            ->join('menu_days', 'menu_items.menu_day_id', '=', 'menu_days.id')
            ->join('recipes', 'menu_items.recipe_id', '=', 'recipes.id')
            ->select(
                'menu_days.date',
                'menu_items.day_of_week',
                'recipes.name as recipe_name',
                'recipes.id as recipe_id',
                'recipes.genre_id'
            )
            ->whereDate('menu_items.created_at', $date)
            ->orderBy('menu_days.date')
            ->get();

        // 1週間の開始日と終了日を計算（menu_days.dateの最小・最大）
        $startDate = $items->min('date');
        $endDate = $items->max('date');

        // 曜日ごとに配列に整理
        $menuByDay = [];
        foreach ($items as $item) {
            $menuByDay[$item->day_of_week] = [
                'recipe_name' => $item->recipe_name,
                'recipe_id' => $item->recipe_id,
                'genre_id' => $item->genre_id,
            ];
        }

        // すべての曜日キー（sun〜sat）が揃っていなければ空データで補完
        $allDays = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
        foreach ($allDays as $day) {
            if (!isset($menuByDay[$day])) {
                $menuByDay[$day] = [
                    'recipe_name' => null,
                    'recipe_id' => null,
                    'genre_id' => null,
                ];
            }
        }

        return view('show_menu_history', compact('menuByDay', 'startDate', 'endDate'));
    }
    /**
     * 買い物メモを表示
     */
    public function buyMaterials()
    {
        // 1週間の献立の材料があれば格納
        $buyMaterials = session('allMaterials', []);

        return view('shopping_list', ['buyMaterials' => $buyMaterials]);
    }

    /**
     * 買い物リストの手動追加
     */
    public function addMaterial(Request $request)
    {
        $text = $request->input('text');

        if (!$text || trim($text) === '') {
            return response()->json(['error' => '無効な入力です'], 400);
        }

        $allMaterials = session('allMaterials', []);

        // すでに同じ材料があるかチェック
        foreach ($allMaterials as $material) {
            if ($material['text'] === $text) {
                return response()->json(['message' => '既に追加済みです']);
            }
        }

        $allMaterials[] = [
            'recipe_id' => null,
            'text' => $text,
        ];

        session(['allMaterials' => $allMaterials]);

        return response()->json(['message' => 'セッションに追加しました']);
    }

    /**
     * 買い物リストのセッションを削除
     */
    public function clearMaterials(Request $request)
    {
        session()->forget('allMaterials');

        return response()->json(['message' => 'セッション削除完了']);
    }
}
