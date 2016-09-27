<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
}
