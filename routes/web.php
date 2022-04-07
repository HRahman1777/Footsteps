<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Post\CategoryController;
use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\Post\PostController;
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
//Route::post('/explore/{id}', [CommentController::class, 'deleteComment']);

Route::get('/explore/{pid}/{cid}/delete', [CommentController::class, 'deleteComment']);

Route::get('/admin/home', [HomeController::class, 'admin'])->name('admin.home');
Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category');
Route::post('/admin/category/add', [CategoryController::class, 'save'])->name('add.category');
Route::get('/admin/category/{id}', [CategoryController::class, 'edit']);
Route::get('/admin/category/{id}/delete', [CategoryController::class, 'delete']);






/* testing
Route::get('/test', function () {
    $posts = Post::all();
    $tags = Tag::all();
    //$p = Post::find(3);
    //$p->tags()->attach();
    return view('test', [
        'posts' => $posts,
        'tags' => $tags
    ]);
});
Route::post('/testme', function (Request $request) {
    dd($request);
});

Route::get('/fresh', function () {
    Tag::create([
        'name' => 'engineer'
    ]);
    Tag::create([
        'name' => 'software'
    ]);
    Tag::create([
        'name' => 'hardware'
    ]);
    Tag::create([
        'name' => 'military'
    ]);
    Tag::create([
        'name' => 'bcs'
    ]);
    Tag::create([
        'name' => 'education'
    ]);

    Category::create([
        'name' => 'Engineer'
    ]);
    Category::create([
        'name' => 'Ministry'
    ]);
    Category::create([
        'name' => 'Education'
    ]);
    Category::create([
        'name' => 'Defense'
    ]);
    Category::create([
        'name' => 'Schoolarship'
    ]);

    dd('done');
});
*/