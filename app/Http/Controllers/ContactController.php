<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function ContactProfile() {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function AddContact() {
        return view('admin.contact.create');
    }

    public function StoreContact(Request $request) {
        $validated = $request->validate([
            'address' => 'required|min:10',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ],
        [
            'address.required' => 'Please input Address',
            'address.min' => 'Address more than 10 characters',
            'email.required' => 'Please input Email',
            'phone.required' => 'Please input Phone',
            'phone.min' => 'phone more than 10 characters',
        ]);

        Contact::insert([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Contact inserted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('contact.profile')->with($notification);
    }

    public function Edit($id) {
        $contact = Contact::find($id);
        return view('admin.contact.edit', compact('contact'));
    }

    public function Update(Request $request, $id) {
        $validated = $request->validate([
            'address' => 'required|min:10',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ],
        [
            'address.required' => 'Please input Address',
            'address.min' => 'Address more than 10 characters',
            'email.required' => 'Please input Email',
            'phone.required' => 'Please input Phone',
            'phone.min' => 'phone more than 10 characters',
        ]);

        $update = Contact::find($id)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Contact updated successfully',
            'alert-type' => 'success'
        );

        return Redirect()->route('contact.profile')->with($notification);
    }

    public function Delete($id) {
        $contact = Contact::find($id)->delete();

        $notification = array(
            'message' => 'Contact deleted successfully',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }
}
