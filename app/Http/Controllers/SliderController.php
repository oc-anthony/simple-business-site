<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function Sliders() {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider() {
        return view('admin.slider.create');
    }

    public function StoreSlider(Request $request) {
        $validated = $request->validate([
            'title' => 'required|unique:sliders|max:255',
            'description' => 'required|max:255',
            'image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'title.required' => 'Please input Slider Title',
            'title.max' => 'Slider Title more than 255 characters',
            'description.required' => 'Please input Slider Description',
            'description.max' => 'Slider Description more than 255 characters',
        ]);

        $slider_image = $request->file('image');

        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('image/slider/'.$name_gen);

        $last_img = 'image/slider/'.$name_gen;

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image = $last_img;
        $slider->save();

        return Redirect()->route('all.slider')->with('success', 'Slider inserted successfully');
    }

    public function Edit($id) {
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function Update(Request $request, $id) {

        $old_image = $request->old_image;

        $slider_image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('image/slider/'.$name_gen);

        $last_img = 'image/slider/'.$name_gen;

        if($old_image) {
            unlink($old_image);
        }

        Slider::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('all.slider')->with('success', 'Slider updated successfully');
    }

    public function Delete($id) {
        $slider = Slider::find($id);
        $old_image = $slider->image;
        unlink($old_image);

        Slider::find($id)->delete();
        return Redirect()->back()->with('success', 'Slider deleted successfully');
    }
}
