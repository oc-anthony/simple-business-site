<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function Brands() {
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request) {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'brand_name.required' => 'Please input Brand Name',
            'brand_image.min' => 'Brand more than 4 characters'
        ]);

        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid()).'.'.strtolower($brand_image->getClientOriginalExtension());
        Image::make($brand_image)->resize(300, 200)->save('image/brand/'.$name_gen);
        $last_img = 'image/brand/'.$name_gen;

        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_image = $last_img;
        $brand->save();

        $notification = array(
            'message' => 'Brand added successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function Edit($id) {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    public function Update(Request $request, $id)
    {
        $validated = $request->validate([
            'brand_name' => 'required|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png',
        ],
            [
                'brand_name.required' => 'Please input Brand Name',
                'brand_image.min' => 'Brand more than 4 characters'
            ]);

        $old_image = $request->old_image;

        $brand_image = $request->file('brand_image');

        if ($brand_image) {
            $name_gen = hexdec(uniqid()) . '.' . $brand_image->getClientOriginalExtension();
            Image::make($brand_image)->resize(1920, 1088)->save('image/brand/' . $name_gen);

            $last_img = 'image/brand/' . $name_gen;

            if ($old_image) {
                unlink($old_image);
            }
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);
        } else {
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);
        }

        $notification = array(
            'message' => 'Brand updated successfully',
            'alert-type' => 'info'
        );

        return Redirect()->back()->with($notification);
    }

    public function Delete($id) {
        $brand = Brand::find($id);
        $old_image = $brand->brand_image;
        unlink($old_image);

        $notification = array(
            'message' => 'Brand deleted successfully',
            'alert-type' => 'success'
        );

        Brand::find($id)->delete();

        return Redirect()->back()->with($notification);
    }
}
