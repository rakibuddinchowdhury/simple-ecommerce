<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    // 1. Show Register Form
    public function register()
    {
        return view('auth.register');
    }

    // 2. Handle Registration Logic
    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', // expects password_confirmation field
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 0, // 0 = Customer, 1 = Admin
        ]);

        // Auto Login after Register
        Auth::login($user);

        return redirect('/')->with('success', 'Registration Successful! Welcome.');
    }

    // 3. Show Login Form
    public function login()
    {
        return view('auth.login');
    }

    // 4. Handle Login Logic
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            // Check User Role for Redirect
            if(Auth::user()->role == '1') {
                return redirect('admin/dashboard')->with('success', 'Welcome Admin!');
            }

            return redirect('/')->with('success', 'Logged in successfully!');
        }

        return back()->with('error', 'Invalid Email or Password');
    }

    // 5. Handle Logout
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}