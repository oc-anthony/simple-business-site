<?php

namespace App\Http\Controllers;

use App\Models\MultiPic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function MultiPic() {
        $images = MultiPic::all();
        return view('admin.portfolio.index', compact('images'));
    }

    public function AddImages(Request $request) {
        $validated = $request->validate([
        'image' => 'required',
        'image.*' => 'mimes:jpeg,jpg,png|max:2048'
    ],
    [
        'image.required' => 'Add Image(s)',
    ]);

        $images = $request->file('image');

        foreach($images as $multi_img) {

            $name_gen = hexdec(uniqid()) . '.' . strtolower($multi_img->getClientOriginalExtension());
            Image::make($multi_img)->resize(300, 200)->save('image/multi/' . $name_gen);
            $last_img = 'image/multi/' . $name_gen;

            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        }

        $notification = array(
            'message' => 'Image(s) inserted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function Portfolio() {
        $images = MultiPic::all();
        return view('pages.portfolio', compact('images'));
    }
}
