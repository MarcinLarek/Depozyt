<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResponseEmail;

class ContactController extends Controller
{
    public function index()
    {
        try {
            $contacts = Contact::all();
            return view('/frontend/admin/contact/index')
            ->with('contacts', $contacts);
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Contact", "index", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }

    public function show($id)
    {
        try {
            $contact = Contact::find($id);
            return view('/frontend/admin/contact/show')
            ->with('contact', $contact);
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Contact", "show", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }
    public function reply($id)
    {
        try {
            $contact = Contact::find($id);
            return view('/frontend/admin/contact/reply')
            ->with('contact', $contact);
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Contact", "reply", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }
    public function sendreply(Request $request, $id)
    {
        try {
            $contact = Contact::find($id);
            $varmail = $contact->email;
            Mail::to($varmail)->send(new ResponseEmail());
            return redirect()->route('admin.contact')->with('successalert', 'successalert');
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Contact", "sendreply", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }
    public function delete($id)
    {
        try {
            $contact = Contact::find($id);
            return view('/frontend/admin/contact/delete')
            ->with('contact', $contact);
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Contact", "delete", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }
    public function deletemessege($id)
    {
        try {
            $contact = Contact::find($id);
            $contact->delete();
            return redirect()->route('admin.contact')->with('successalert', 'successalert');
        } catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Contact", "deletemessege", $ex->getMessage(), $request->ip(), Auth::id());
            return redirect()->route('admin.siteerror');
        }
    }
}
