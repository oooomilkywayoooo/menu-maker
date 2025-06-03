<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\MenuDayController;
use App\Http\Controllers\MenuItemController;

// Viewルーティング
Route::get('/', function () {
    return view('home');
})->name('home');

// Route::get('/add_cooking', function () {
//     return view('add_cooking');
// })->name('add_cooking');

Route::get('/one_week_menu', function () {
    return view('one_week_menu');
})->name('one_week_menu');

Route::get('/shopping_list', function () {
    return view('shopping_list');
})->name('shopping_list');

Route::get('/favorite', function () {
    return view('favorite');
})->name('favorite');

Route::get('/menu_history', function () {
    return view('menu_history');
})->name('menu_history');

Route::get('/show_menu_history', function () {
    return view('show_menu_history');
})->name('show_menu_history');

// コントローラルーティング
Route::resource('recipes', RecipeController::class);
Route::resource('menu-days', MenuDayController::class);
Route::resource('menu-items', MenuItemController::class);