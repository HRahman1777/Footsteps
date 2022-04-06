<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::all();
        return view('admin.category', [
            'categories' => $categories
        ]);
    }

    public function save(Request $request)
    {
        $jervis = [];
        $category = Category::create([
            'name' => $request->name
        ]);
        if ($category) {
            $jervis = [
                'status' => 'success',
                'message' => 'Category Added Successfully!'
            ];
            return redirect('admin/category')->with('jervis', $jervis);
        }
        $jervis = [
            'status' => 'error',
            'message' => 'Category Could not Added!'
        ];
        return redirect('admin/category')->with('jervis', $jervis);
    }

    public function edit(Request $request, $id)
    { ////////////////////////////////////////////////////// NOT YET COMPLETE
        $category = Category::find($id)->get();
        $category->name  = $request->name;
        $category->save();
        return redirect('admin/category')->with('success', 'Category Updated Successfully!');
    }


    public function delete($id)
    {
        $jervis = [];
        $category = Category::find($id);
        if ($category) {
            $isDelete = $category->delete();
            if ($isDelete) {
                $jervis = [
                    'status' => 'success',
                    'message' => 'Category Deleted Successfully!'
                ];
                return redirect('admin/category')->with('jervis', $jervis);;
            }
        }
        $jervis = [
            'status' => 'error',
            'message' => 'Could not Delete!'
        ];
        return redirect('admin/category')->with('jervis', $jervis);
    }
}
