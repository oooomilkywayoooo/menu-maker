<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Genre;

class RecipeController extends Controller
{
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
            'title' => 'required|max:255',
            'memo' => 'required',
            'materials' => 'required|array|min:1',
            'genre_id' => 'required|exists:genres,id',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->file('image')
            ? $request->file('image')->store('images', 'public')
            : null;

        Recipe::create([
            'title' => $request->input('title'),
            'memo' => $request->input('memo'),
            'materials' => $request->input('materials'), // ← LaravelがJSON化してくれる
            'genre_id' => $request->input('genre_id'),
            'image_path' => $imagePath,
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
