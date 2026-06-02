<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:profile',
            'password' => 'required|string|min:6|confirmed',
            'username' => 'required|string|max:255|unique:profile',
            'contact_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        Profile::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.')->withInput();
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Profile::where('email', $request->email)->first();

        if ($user && password_verify($request->password, $user->password)) {
            session()->put('user_id', $user->id);
            return redirect()->route('dashboard')->with('success', 'Login successful.')->withInput();
        } else {
            return back()->withErrors(['Invalid email or password.'])->withInput();
        }
    }
    public function updateProfile(Request $request)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }

        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contact' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',

            'current_password' => 'required',
        ]);

        $user = Profile::find(session('user_id'));

       
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Please enter your correct password to save changes.'
            ]);
        }

        $user->name = $request->fullname;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->contact_number = $request->contact;
        $user->address = $request->address;

        // Optional password change
        if ($request->filled('new_password')) {

            if ($request->new_password !== $request->confirm_password) {
                return back()->withErrors([
                    'confirm_password' => 'Passwords do not match.'
                ]);
            }

            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

}