<?php

namespace App\Http\Controllers;

use App\Models\User;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        $title = 'Login';
        return view('auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $credentials['identifier'];
            unset($credentials['identifier']);
        } else {
            $credentials['nik'] = $credentials['identifier'];
            unset($credentials['identifier']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'loginError' => 'Login Failed.',
        ])->onlyInput('loginError');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
