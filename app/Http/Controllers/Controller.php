<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


abstract class Controller
{
    //
    public function index()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('dashboard', compact('user')); // Pass the user data to the dashboard view
    }
}
