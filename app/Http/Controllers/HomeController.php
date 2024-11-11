<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin()
    {
        $users = User::all();
        $newUsers = User::latest()->get();

        return view('admin.dashboard', compact('users', 'newUsers'));
    }
}
