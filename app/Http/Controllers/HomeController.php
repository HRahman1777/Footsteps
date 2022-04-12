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

    public function allPost()
    {
        $posts = Post::all();
        return view('admin.post', [
            'posts' => $posts,
        ]);
    }

    public function postDelete($id)
    {
        $jervis = [];
        $post = Post::find($id);
        if ($post) {
            $isDelete = $post->delete();
            if ($isDelete) {
                $jervis = [
                    'status' => 'success',
                    'message' => 'Post Deleted Successfully!'
                ];
                return redirect('admin/post')->with('jervis', $jervis);;
            }
        }
        $jervis = [
            'status' => 'error',
            'message' => 'Could not Delete!'
        ];
        return redirect('admin/post')->with('jervis', $jervis);
    }
}
