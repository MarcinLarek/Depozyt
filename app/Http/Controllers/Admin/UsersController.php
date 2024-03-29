<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
      try {
        $users = User::all();
        return view('/frontend/admin/users/index', compact('users'));
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Users", "index", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function edit($id)
    {
      try {
        $user = User::find($id);
        return view('/frontend/admin/users/edit')
            ->with('user', $user);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Users", "edit", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function update($id, Request $request)
    {
      $request->validate([
          'username' => ['required','max:100'],
          'password' => ['max:100'],
          'email' => ['required','max:100'],
          'client_type_id' => ['required'],
          'country_id' => ['required','max:100']
      ]);
      try {
        if ($request['password'] == null) {
          $data = array(
            'username' => $request['username'],
            'email' => $request['email'],
            'client_type_id' => $request['client_type_id'],
            'country_id' => $request['country_id']
          );
        } else {
          $data = array(
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
            'email' => $request['email'],
            'client_type_id' => $request['client_type_id'],
            'country_id' => $request['country_id']
          );
        }

        $user = User::find($id);
        $user->update($data);
        $users = User::all();
        return view('/frontend/admin/users/index', compact('users'));
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Users", "update", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }

    public function delete($id)
    {
      try {
        $user = User::find($id);
        return view('/frontend/admin/users/delete')
            ->with('user', $user);
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Users", "delete", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }
    public function deleteuser($id)
    {
      try {
        $user = User::find($id);
        $user->delete();
        $users = User::all();
        return view('/frontend/admin/users/index', compact('users'));
      } catch (\Exception $ex) {
                  saveException(sqlDateTime(), "Admin-Users", "deleteuser", $ex->getMessage(), $request->ip(), Auth::id());
      	    return view('/frontend/admin/admin/index');
              }
    }
}
