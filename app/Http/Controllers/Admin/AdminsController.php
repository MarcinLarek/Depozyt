<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\WalletHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function adminslist()
    {
      try {
        $admins = Admin::all();
        return view('/frontend/admin/admins/index')
            ->with('admins', $admins);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Admin", "Edit", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('admin.siteerror');
              }
    }

    public function edit($id)
    {
      try {
        $admin = Admin::find($id);
        return view('/frontend/admin/admins/edit')
            ->with('admin', $admin);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Admin", "Edit", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('admin.siteerror');
              }
    }

    public function update($id, Request $request)
    {
      $request->validate([
          'login' => ['required','max:100'],
          'name' => ['required','max:100'],
          'surname' => ['required','max:100'],
          'password' => ['max:100'],
          'error_notification' => ['required'],
          'email' => ['required','max:100']
      ]);
      try {
        if ($request['password'] == null) {
          $data = array(
            'login' => $request['login'],
            'name' => $request['name'],
            'surname' => $request['surname'],
            'error_notification' => $request['error_notification'],
            'email' => $request['email']
          );
        } else {
          $data = array(
            'login' => $request['login'],
            'name' => $request['name'],
            'surname' => $request['surname'],
            'error_notification' => $request['error_notification'],
            'password' => Hash::make($request['password']),
            'email' => $request['email']
          );
        }

        $admin = Admin::find($id);
        $admin->update($data);
        return redirect()->route('admin.admins')->with('successalert','successalert');
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Admin", "update", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('admin.siteerror');
              }
    }

    public function delete($id)
    {
      try {
        $admin = Admin::find($id);
        return view('/frontend/admin/admins/delete')
            ->with('admin', $admin);
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Admin", "delete", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('admin.siteerror');
              }
    }
    public function deleteadmin($id)
    {
      try {
        $admin = Admin::find($id);
        $admin->delete();
        $admins = Admin::all();
        return redirect()->route('admin.admins')->with('successalert','successalert');
      }
      catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Admin", "deleteadmin", $ex->getMessage(), $request->ip(), Auth::id());
                  return redirect()->route('admin.siteerror');
              }
    }

}
