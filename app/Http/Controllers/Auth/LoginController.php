<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        // dd($request->all());

        $credentials = $request->validate([
            'myEmail' => ['required', 'email'],
            'myPassword' => ['required'],
        ], $messages = [
            'myEmail.required' => 'The email field is required.',
            'myEmail.email' => 'The email must be a valid email address.',
            'myPassword.required' => 'The password must be required.',
        ]);
 
        if (Auth::attempt([
            'email' => $credentials['myEmail'],
            'password' => $credentials['myPassword'],
        ])) {
            $request->session()->regenerate();
 
            return redirect()->intended('admin.dashboard');
        }
 
        return back()->withErrors([ 
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
