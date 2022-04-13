<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function singlePost($id)
    {
        $post = Post::where('id', $id);
        if ($post) {
            return view('posts.single-post', [
                'post' => $post->first()
            ]);
        }
        return view('posts.single-post', [
            'post' => null
        ]);
    }

    public function allPost(Request $request)
    {
        if ($request->catId || $request->sKey) {
            if ($request->catId) {
                $posts = Post::where('category_id', $request->catId)->get();
            } elseif ($request->sKey) {
                $search = '%' . $request->sKey . '%';
                $posts = Post::where('title', 'LIKE', $search)->get();
            }
            $categories = Category::all();
            return view('posts.all-post', [
                'posts' => $posts,
                'categories' => $categories,
            ]);
        }
        $posts = Post::orderBy('updated_at', 'desc')->get();
        $categories = Category::all();
        return view('posts.all-post', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function savePost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'image' => 'mimes:jpg,png,jpeg | max:5048'
        ]);

        $tag_array = [];
        $manage = json_decode($request->tags, true);
        if ($manage != null) {
            for ($i = 0; $i < count($manage); $i++) {
                $tag = Tag::where('name', $manage[$i]['value'])->first();
                array_push($tag_array, $tag->id);
            }
        }
        $filename = null;
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time() . '-' . $request->title . '.' . $file->extension();
            $file->move(public_path('upload/images/'), $filename);
        }

        $post = Post::create([
            'title' => $request->input('title'),
            'category_id' => $request->input('category'),
            'body' => $request->input('description'),
            'image' => $filename,
            'user_id' => Auth::user()->id
        ]);
        $post->tags()->attach($tag_array);

        $jervis = [
            'status' => 'success',
            'message' => 'Successfully Posted!'
        ];
        return redirect('/home')->with('jervis', $jervis);
    }

    public function delete($id)
    {
        $post = Post::find($id);
        if ($post && ($post->user->username == Auth::user()->username)) {
            $isDelete = $post->delete();
            if ($isDelete) {
                $jervis = [
                    'status' => 'success',
                    'message' => 'Post Deleted Successfully!'
                ];
                return redirect('home')->with('jervis', $jervis);
            }
        }
        $jervis = [
            'status' => 'error',
            'message' => 'Could not delete!'
        ];
        return redirect('home')->with('jervis', $jervis);
    }
}
