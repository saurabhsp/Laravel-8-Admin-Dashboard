<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function showSignupForm(){
        return view('admin.signup');
    }
    public function adminSignup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin account created successfully.');
    }



    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Invalid credentials.');
        }

        Session::put('admin_id', $admin->id);
        Session::put('admin_name', $admin->name);

        return redirect()->route('admin.dashboard');
    }

    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function adminLogout()
    {
        Session::flush();
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }

}
