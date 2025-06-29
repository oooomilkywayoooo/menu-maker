<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Genre;
use App\Models\MenuDay;
use App\Models\MenuItem;
use Illuminate\Support\Carbon;

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
                $randomRecipe = Recipe::where('genre_id', $genres[$day])->inRandomOrder()->first();
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

        $recipe = Recipe::where('genre_id', $genreId)->inRandomOrder()->first();

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

        session()->forget('weeklyMenu');

        return redirect()->route('home')->with('success', '1週間分の献立を保存しました！');
    }

    /**
     * 週間履歴の一覧表示
     */
    public function menuHistory()
    {
        //
    }

    /**
     * 週間履歴の詳細を表示
     */
    public function menuHistoryShow(string $id)
    {
        //
    }

    
}
