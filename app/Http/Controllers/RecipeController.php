<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Genre;

class RecipeController extends Controller
{

    /**
     * ホーム画面の表示
     */
    public function home()
    {
        // ホーム画面
        return view('home');
    }

    /**
     * お気に入り画面の表示
     */
    public function favorite()
    {
        // favorite_flgがtrueのレシピ取得
        $recipes = Recipe::where('favorite_flg', true)->paginate(10);
        // 取得したレシピを favorite.blade.php に渡す
        return view('favorite', compact('recipes'));
    }

    /**
     * 料理一覧を表示
     */
    public function index()
    {
        // 料理一覧表示
        $recipes = Recipe::paginate(10); // 1ページあたり10件
        return view('recipes_index', compact('recipes'));
    }

    /**
     * 登録画面を表示
     */
    public function create()
    {
        // ジャンルを渡す
        $genres = Genre::all();
        return view('add_cooking', compact('genres'));
    }

    /**
     * 登録処理
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'materials' => 'required|array',
            'materials.*' => 'string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'memo' => 'nullable|string',
            'url' => 'nullable|url',
        ]);

        // 画像がある場合は保存してパスを取得
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = 'images/no_image.jpg';
        }

        // 登録処理
        Recipe::create([
            'name' => $request->input('name'),
            'genre_id' => $request->input('genre_id'),
            'materials' => json_encode($request->input('materials')), // JSONとして保存
            'image_path' => $imagePath,
            'memo' => $request->input('memo'),
            'url' => $request->input('url'),
            // 'favorite_flg' はDB側でデフォルトfalse設定なら省略OK
        ]);

        return redirect()->route('recipes.create')->with('success', 'レシピを登録しました');
    }

    /**
     * お気に入りフラグチェンジ
     */
    public function toggleFavorite(Recipe $recipe)
    {
        $recipe->favorite_flg = !$recipe->favorite_flg;
        $recipe->save();

        return response()->json([
            'favorite' => $recipe->favorite_flg
        ]);
    }

    /**
     * 料理詳細画面
     */
    public function show(string $id)
    {
        $recipe = Recipe::with('genre')->findOrFail($id);
        return view('recipe_show', compact('recipe'));
    }

    /**
     * 料理編集画面の表示
     */
    public function edit(string $id)
    {
        $recipe = Recipe::findOrFail($id);
        $genres = Genre::all();
        return view('edit_cooking', compact('recipe'), compact('genres'));
    }

    /**
     * 更新処理
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'genre_id' => 'required|exists:genres,id',
            'materials' => 'required|array',
            'materials.*' => 'string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'memo' => 'nullable|string',
            'url' => 'nullable|url',
        ]);

        $recipe = Recipe::findOrFail($id);

        // 画像がアップロードされた場合のみ保存
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // ← 登録に合わせて修正
        } else {
            $imagePath = $request->input('existing_image') ?? 'images/no_image.jpg';
        }

        // 更新処理
        $recipe->update([
            'name' => $request->input('name'),
            'genre_id' => $request->input('genre_id'),
            'materials' => json_encode($request->input('materials')),
            'image_path' => $imagePath,
            'memo' => $request->input('memo'),
            'url' => $request->input('url'),
        ]);

        return redirect()->route('recipes.show', $recipe->id)->with('success', 'レシピを更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
