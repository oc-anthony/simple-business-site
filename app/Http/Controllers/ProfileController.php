<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function Profile() {
        if(Auth::user()) {
            $user = User::find(Auth::user()->id);
            if($user) {
                return view('admin.profile.update-profile', compact('user'));
            }
        }
    }

    public function UpdateProfile(Request $request) {
        $user = User::find(Auth::user()->id);
        if($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $notification = array(
                'message' => 'User profile is updated successfully',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            return Redirect()->back();
        }
    }

    public function ChangePassword() {
        return view('admin.profile.change-password');
    }

    public function UpdatePassword(Request $request) {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notification = array(
                'message' => 'Password is changed successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('login')->with($notification);
        } else {

            $notification = array(
                'message' => 'Current password is invalid',
                'alert-type' => 'error'
            );
            return redirect()->back()->with('error', 'Current password is invalid');
        }
    }
}
