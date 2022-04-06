<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $posts = Post::orderBy('updated_at', 'desc')->limit(5)->get();
        $tag_array = array();
        foreach ($tags as $value) {
            array_push($tag_array, $value->name);
        }
        return view('home', [
            'categories' => $categories,
            'tag_array' => $tag_array,
            'posts' => $posts
        ]);
    }

    public function admin()
    {
        return view('admin.index');
    }
}
