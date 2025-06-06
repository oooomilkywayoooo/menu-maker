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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ジャンルを渡す
        $genres = Genre::all();
        return view('add_cooking', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
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
        ]);

        // 画像がある場合は保存してパスを取得
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // 登録処理
        Recipe::create([
            'name' => $request->input('name'),
            'genre_id' => $request->input('genre_id'),
            'materials' => json_encode($request->input('materials')), // JSONとして保存
            'image_path' => $imagePath,
            'memo' => $request->input('memo'),
            // 'favorite_flg' はDB側でデフォルトfalse設定なら省略OK
        ]);

        return redirect()->route('recipes.create')->with('success', 'レシピを登録しました');
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
