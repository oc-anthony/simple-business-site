<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

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

    public function Messages() {
        $messages = Message::all();
        return view('admin.contact.messages', compact('messages'));
    }

    public function Contact() {
        $contacts = DB::table('contacts')->first();
        return view('pages.contact', compact('contacts'));
    }

    public function StoreMessage(Request $request) {
        Message::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('contact')->with('success', 'Your message sent successfully');
    }
}
