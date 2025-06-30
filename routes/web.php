<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\MenuDayController;
use App\Http\Controllers\MenuItemController;

// Route::get('/shopping_list', function () {
//     return view('shopping_list');
// })->name('shopping_list');

// Route::get('/menu_history', function () {
//     return view('menu_history');
// })->name('menu_history');

// Route::get('/show_menu_history', function () {
//     return view('show_menu_history');
// })->name('show_menu_history');

// レシピコントローラ
Route::resource('recipes', RecipeController::class);
Route::get('/', [RecipeController::class, 'home'])->name('home');
Route::get('/favorite', [RecipeController::class, 'favorite'])->name('favorite');
Route::post('/recipes/{recipe}/toggle-favorite', [RecipeController::class, 'toggleFavorite'])->name('recipes.toggleFavorite');

// 献立日コントローラ
Route::resource('menu-days', MenuDayController::class);
// 献立コントローラ
// Route::resource('menu-items', MenuItemController::class);
// 献立生成画面でキーワードでレシピ候補を表示する
Route::get('/search-recipes', [RecipeController::class, 'search'])->name('recipes.search');

// 献立生成コントローラ
Route::post('/menu-items', [MenuItemController::class, 'menusCreate'])->name('menu-items.menusCreate');
Route::get('/menu-items', [MenuItemController::class, 'index'])->name('menu-items.index');
// 個別生成コントローラ
Route::get('/each-create', [MenuItemController::class, 'eachCreate'])->name('menu-items.eachCreate');
// 1週間の献立登録コントローラ
Route::post('/menu-items/save', [MenuItemController::class, 'saveMenus'])->name('menu-items.saveMenus');
// 履歴コントローラ
Route::get('/menu-items/history', [MenuItemController::class, 'menuHistory'])->name('menu-items.menuHistory');
Route::get('/menu-items/history-show/{date}', [MenuItemController::class, 'menuHistoryShow'])->name('menu-items.menuHistoryShow');
// 買い物リスト
Route::get('/shopping-list', [MenuItemController::class, 'buyMaterials'])->name('menu-items.buyMaterials');
// 買い物リストのセッション削除
Route::post('/clear-materials', [MenuItemController::class, 'clearMaterials'])->name('materials.clear');