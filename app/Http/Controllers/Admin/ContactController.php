<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewErrorMail;
use Illuminate\Support\Facades\DB;
use App\Mail\ResponseEmail;

class ContactController extends Controller
{
    public function index()
    {
      try {
        $contacts = Contact::all();
        return view('/frontend/admin/contact/index')
            ->with('contacts', $contacts);
          }
          catch (\Exception $ex) {
            saveException(sqlDateTime(), "Admin-Contact", "index", $ex->getMessage(), $request->ip(), Auth::id());
            $admins = DB::table('admins')->get();
            foreach ($admins as $admin) {
              Mail::to($admin->email)->send(new NewErrorMail());
            }
	    return view('/frontend/admin/admin/index');
        }
    }

    public function show($id)
    {
      try {
        $contact = Contact::find($id);
        return view('/frontend/admin/contact/show')
            ->with('contact', $contact);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Contact", "show", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new NewErrorMail());
                  }
      	    return view('/frontend/admin/admin/index');
              }

    }
    public function reply($id)
    {
      try {
        $contact = Contact::find($id);
        return view('/frontend/admin/contact/reply')
            ->with('contact', $contact);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Contact", "reply", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new NewErrorMail());
                  }
      	    return view('/frontend/admin/admin/index');
              }
    }
    public function sendreply(Request $request, $id)
    {
      try {
        $contact = Contact::find($id);
        $varmail = $contact->email;
        Mail::to($varmail)->send(new ResponseEmail());


          $contacts = Contact::all();
          return view('/frontend/admin/contact/index')
              ->with('contacts', $contacts);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Contact", "sendreply", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new NewErrorMail());
                  }
      	    return view('/frontend/admin/admin/index');
              }
    }
    public function delete($id)
    {
      try {
        $contact = Contact::find($id);
        return view('/frontend/admin/contact/delete')
            ->with('contact', $contact);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Contact", "delete", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new NewErrorMail());
                  }
      	    return view('/frontend/admin/admin/index');
              }
    }
    public function deletemessege($id)
    {
      try {
        $contact = Contact::find($id);
        $contact->delete();
        $contacts = Contact::all();
        return view('/frontend/admin/contact/index', compact('contacts'));
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Contact", "deletemessege", $ex->getMessage(), $request->ip(), Auth::id());
                  $admins = DB::table('admins')->get();
                  foreach ($admins as $admin) {
                    Mail::to($admin->email)->send(new NewErrorMail());
                  }
      	    return view('/frontend/admin/admin/index');
              }
    }


}
