<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Post\CategoryController;
use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\TagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/about', function () {
    return view('about');
})->name('about');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/home', [PostController::class, 'savePost'])->name('posted');
Route::get('/explore', [PostController::class, 'allPost'])->name('all.post');
Route::get('/explore/{id}', [PostController::class, 'singlePost']);

Route::post('/explore/{id}', [CommentController::class, 'addComment']);
Route::get('/explore/{pid}/{cid}/delete', [CommentController::class, 'deleteComment']);

Route::get('/admin/home', [HomeController::class, 'admin'])->name('admin.home');
Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
Route::post('/admin/category/add', [CategoryController::class, 'save'])->name('add.category');
Route::post('/admin/category/{id}/edit', [CategoryController::class, 'edit']);
Route::get('/admin/category/{id}/delete', [CategoryController::class, 'delete']);

Route::get('/admin/tag', [TagController::class, 'index'])->name('admin.tag');
Route::post('/admin/tag/add', [TagController::class, 'save'])->name('add.tag');
Route::post('/admin/tag/{id}/edit', [TagController::class, 'edit']);
Route::get('/admin/tag/{id}/delete', [TagController::class, 'delete']);
