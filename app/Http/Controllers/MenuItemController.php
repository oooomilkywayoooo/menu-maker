<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Genre;
use Ramsey\Uuid\Type\Integer;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
