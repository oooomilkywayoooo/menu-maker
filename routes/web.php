<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\MenuDayController;
use App\Http\Controllers\MenuItemController;

Route::get('/one_week_menu', function () {
    return view('one_week_menu');
})->name('one_week_menu');

Route::get('/shopping_list', function () {
    return view('shopping_list');
})->name('shopping_list');

Route::get('/show', function () {
    return view('recipe_show');
})->name('recipe_show');

Route::get('/menu_history', function () {
    return view('menu_history');
})->name('menu_history');

Route::get('/show_menu_history', function () {
    return view('show_menu_history');
})->name('show_menu_history');

// レシピコントローラ
Route::resource('recipes', RecipeController::class);
Route::get('/', [RecipeController::class, 'home'])->name('home');
Route::get('/favorite', [RecipeController::class, 'favorite'])->name('favorite');
Route::post('/recipes/{recipe}/toggle-favorite', [RecipeController::class, 'toggleFavorite'])->name('recipes.toggleFavorite');

// 献立日コントローラ
Route::resource('menu-days', MenuDayController::class);
// 献立コントローラ
Route::resource('menu-items', MenuItemController::class);