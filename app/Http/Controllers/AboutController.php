<?php

namespace App\Http\Controllers;

use App\Models\About;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function About() {
        $abouts = About::latest()->get();
        return view('admin.about.index', compact('abouts'));
    }

    public function AddAbout() {
        return view('admin.about.create');
    }

    public function StoreAbout(Request $request) {
        $validated = $request->validate([
            'title' => 'required|unique:abouts|max:255',
            'short_des' => 'required|max:255',
            'long_des' => 'required|max:255',
        ],
        [
            'title.required' => 'Please input Title',
            'title.max' => 'Title more than 255 characters',
            'short_des.required' => 'Please input Description',
            'short_des.max' => 'Short Description more than 255 characters',
            'long_des.required' => 'Please input Description',
            'long_des.max' => 'Long Description more than 255 characters',
        ]);

        About::insert([
            'title' => $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'About inserted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('all.about')->with($notification);
    }

    public function Edit($id) {
        $about = About::find($id);
        return view('admin.about.edit', compact('about'));
    }

    public function Update(Request $request, $id) {
        $validated = $request->validate([
            'title' => 'required|unique:abouts|max:255',
            'short_des' => 'required|max:255',
            'long_des' => 'required|max:255',
        ],
        [
            'title.required' => 'Please input Title',
            'title.max' => 'Title more than 255 characters',
            'short_des.required' => 'Please input Description',
            'short_des.max' => 'Short Description more than 255 characters',
            'long_des.required' => 'Please input Description',
            'long_des.max' => 'Long Description more than 255 characters',
        ]);

        About::find($id)->update([
            'title' => $request->title,
            'short_des' => $request->short_des,
            'long_des' => $request->long_des,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'About updated successfully',
            'alert-type' => 'info'
        );

        return Redirect()->route('all.about')->with($notification);
    }

    public function Delete($id) {
        $about = About::find($id)->delete();

        $notification = array(
            'message' => 'About deleted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('all.about')->with($notification);
    }
}
