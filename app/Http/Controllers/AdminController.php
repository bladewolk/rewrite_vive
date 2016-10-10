<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Requests;

class AdminController extends Controller
{
    public function manageUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function managePrices()
    {
        return view('admin.price');
    }

    public function CreateNewUser()
    {
        return view('auth.register');
    }

//This func create new user by Admin. Use view -> Admin/register.blade.php
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'username' => 'required|unique:users|max:50',
            'password' => 'required',
        ]);
        $newuser = new User();http://homevive.com/admin/manageusers
        $newuser->name = $request->name;
        $newuser->username = $request->username;
        $newuser->password = bcrypt($request->password);
        $newuser->isAdmin = $request->isAdmin;
        $newuser->save();
        return redirect('/admin/manageusers');
    }

    public function destroyUser($id)
    {
        $record = User::find($id)->delete();
        return redirect('/admin/manageusers');
    }
}
