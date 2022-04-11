<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tags = Tag::all();
        return view('admin.tag', [
            'tags' => $tags
        ]);
    }

    public function save(Request $request)
    {
        $jervis = [];
        $tag = Tag::create([
            'name' => $request->name
        ]);
        if ($tag) {
            $jervis = [
                'status' => 'success',
                'message' => 'Tag Added Successfully!'
            ];
            return redirect('admin/tag')->with('jervis', $jervis);
        }
        $jervis = [
            'status' => 'error',
            'message' => 'Tag Could not Added!'
        ];
        return redirect('admin/tag')->with('jervis', $jervis);
    }

    public function edit(Request $request, $id)
    {
        $jervis = [];
        $tag = Tag::find($id);
        if ($tag) {
            $tag->update([
                'name' => $request->input('name')
            ]);
            $jervis = [
                'status' => 'success',
                'message' => 'Tag Updated Successfully!'
            ];
            return redirect('admin/tag')->with('jervis', $jervis);
        }
        $jervis = [
            'status' => 'error',
            'message' => 'Tag Could not Updated!'
        ];
        return redirect('admin/tag')->with('jervis', $jervis);
    }

    public function delete($id)
    {
        $jervis = [];
        $tag = Tag::find($id);
        if ($tag) {
            $isDelete = $tag->delete();
            if ($isDelete) {
                $jervis = [
                    'status' => 'success',
                    'message' => 'Tag Deleted Successfully!'
                ];
                return redirect('admin/tag')->with('jervis', $jervis);;
            }
        }
        $jervis = [
            'status' => 'error',
            'message' => 'Could not Delete!'
        ];
        return redirect('admin/tag')->with('jervis', $jervis);
    }
}
