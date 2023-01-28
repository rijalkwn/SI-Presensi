<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CenterController extends Controller
{
    public function index()
    {
        // route to login
        if (auth()->guest()) {
            return redirect()->route('login');
        } else {
            // if user has logged in, route to dashboard
            return redirect()->route('dashboard');
        }
    }
}
