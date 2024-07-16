<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup()
    {
        return view('Auth.signup');
    }

    public function signup_req(Request $request)
    {

        // If the user is a seller, validate and create the store
        if ($request->signup_type == 2) {
            // Validate user input
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'signup_type' => 'required|integer',
                'password' => 'required|between:8,255|confirmed',
                'storeName' => 'required|string|max:255',
            ]);

            // Create the user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['signup_type'],
                'password' => $data['password'],
                'signup_type' => $data['signup_type'],
            ]);

            // Create the store and associate it with the user
            Store::create([
                'name' => $data['storeName'],
                'user_id' => $user->id,
            ]);
        }
        else {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'signup_type' => 'required|integer',
                'password' => 'required|between:8,255|confirmed',
            ]);

            // Create the user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role_id' => $data['signup_type'],
                'password' => $data['password'],
                'signup_type' => $data['signup_type'],
            ]);
        }

        // Redirect to login page or wherever appropriate
        return redirect()->route('login')->with('success', 'User registered successfully.');
    }

    public function login()
    {
        return view('Auth.login');
    }
    public function login_req(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerate session ID here

            return redirect()->intended('/')->with('success', 'You are logged in!');
        }else{
            return redirect()->route('login')->with('error', 'email or password is incorrect');

        }

        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');

    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
