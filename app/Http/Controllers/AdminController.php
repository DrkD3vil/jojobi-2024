<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Pass user data to the view
        return view('adminBackend.adminLayout', compact('user'));
    }
}
