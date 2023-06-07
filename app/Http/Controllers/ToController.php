<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToController extends Controller
{
    //
    public function index($username)
    {
        // Make sure username exist in users table
        $user = \App\Models\User::where('url', $username)->firstOrFail();

        // This is where people can view other people's profiles
        return view('to', ['user' => $user]);
    }
}
