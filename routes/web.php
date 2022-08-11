<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// TOPページ
Route::get('/home', [App\Http\Controllers\Text\TextController::class, 'index'])->name('home');

// sort_noを入れ替え
Route::get('/home/sort_text', [App\Http\Controllers\Text\TextController::class, 'sortText'])->name('sortText');

// Text
// 新規作成
Route::get('/create', [App\Http\Controllers\Text\TextController::class, 'create'])->name('create');

// 新規作成内容を保存
Route::post('/create/new', [App\Http\Controllers\Text\TextController::class, 'createText'])->name('createText');

// 編集
Route::get('/edit/{id}', [App\Http\Controllers\Text\TextController::class, 'edit'])->name('edit');

// 編集内容を保存
Route::post('/edit/{id}/save', [App\Http\Controllers\Text\TextController::class, 'edit_save'])->name('edit_save');

// 削除
Route::delete('/delete/{id}', [App\Http\Controllers\Text\TextController::class, 'delete'])->name('delete');

// Category
