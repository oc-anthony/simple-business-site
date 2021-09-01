<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function Categories() {
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

        return view('admin.category.index', compact('categories', 'trashCat'));
    }

    public function AddCat(Request $request) {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please input Category Name',
            'category_name.max' => 'Category Name more than 255 characters'
        ]);

        $category = new Category;
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        $notification = array(
            'message' => 'Category inserted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function Edit($id){
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function Update(Request $request, $id) {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please input Category Name',
            'category_name.max' => 'Category Name more than 255 characters'
        ]);

        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id
        ]);

        $notification = array(
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('all.category')->with($notification);
    }

    public function SoftDelete($id) {
        $delete = Category::find($id)->delete();

        $notification = array(
            'message' => 'Category added to trash',
            'alert-type' => 'info'
        );
        return Redirect()->back()->with($notification);
    }

    public function Restore($id) {
        $restore = Category::withTrashed()->find($id)->restore();

        $notification = array(
            'message' => 'Category has been restored',
            'alert-type' => 'info'
        );
        return Redirect()->back()->with($notification);
    }

    public function Delete($id) {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        $notification = array(
            'message' => 'Category deleted',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
