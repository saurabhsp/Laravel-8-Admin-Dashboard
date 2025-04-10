<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dealer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function showdata()
    {
        $users = User::all();
        foreach ($users as $user) {
            dd($user->status);
        }
        return response()->json($users);
    }

    public function showLoginForm()
    {
        return view('admin.users.login');
    }


    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'No user found with this email.');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Invalid password.');
        }

        if ($user->status == 0) {
            return back()->with('error', 'Your account is blocked. Contact admin.');
        }

        // Clear previous session before login
        Session::flush();

        // Store user session under 'user_' keys
        Session::put('id', $user->id);
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);
        Session::put('user_status', $user->status);
        Session::put('logged_in_as', 'user'); // add a flag to identify login role

        return redirect()->route('user.dashboard');
    }


    public function showDashboard()
    {
        $userId = Session::get('id');
        $users = User::all();
        $user = User::find($userId);
        $dealers = Dealer::where('user_id', $userId)->get();
        return view('admin.users.dashboard', compact('user', 'users', 'dealers'));
    }

    public function userLogout()
    {
        Session::flush();
        return redirect()->route('user.login')->with('success', 'Logged out successfully.');
    }

    //CRUD
    public function toggleStatus($id)
    {
        $dealer = Dealer::findOrFail($id);
        $dealer->status = !$dealer->status;
        $dealer->save();

        return redirect()->route('user.dashboard')->with('success', 'User status updated successfully.');
    }


    public function create()
    {
        return view('dealer.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:users,phone|numeric|digits:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        Dealer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,
            'user_id' => Session::get('id'), // Link dealer to the currently logged-in user
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Dealer added successfully.');
    }



    public function edit($id)
    {
        $dealer = Dealer::findOrFail($id);
        return view('dealer.edit', compact('dealer'));
    }

    public function loginAsDealer($dealerId)
    {
        $dealer = Dealer::find($dealerId);

        if (!$dealer) {
            return back()->with('error', 'Dealer not found.');
        }

        // Save current user session temporarily
        Session::put('backup_user_id', Session::get('user_id'));
        Session::put('backup_user_name', Session::get('user_name'));
        Session::put('backup_user_status', Session::get('user_status'));

        // Flag that dealer was logged in by a user
        Session::put('dealer_logged_by_user', true);

        // Now store dealer session
        Session::put('id', $dealer->id);
        Session::put('dealer_id', $dealer->id);
        Session::put('dealer_name', $dealer->name);
        Session::put('dealer_status', $dealer->status);
        Session::put('logged_in_as', 'dealer');

        return redirect()->route('dealer.dashboard');
    }




    public function backToUser(Request $request)
{
    if (!Session::has('dealer_logged_by_user')) {
        return redirect()->route('user.login')->with('error', 'Invalid access.');
    }

    // Restore the original user session
    Session::put('id', Session::get('backup_user_id')); // This is what your middleware is looking for
    Session::put('user_id', Session::get('backup_user_id'));
    Session::put('user_name', Session::get('backup_user_name'));
    Session::put('user_status', Session::get('backup_user_status'));
    Session::put('logged_in_as', 'user');

    // Clean up dealer session
    Session::forget('dealer_id');
    Session::forget('dealer_name');
    Session::forget('dealer_status');
    Session::forget('dealer_logged_by_user');
    Session::forget('backup_user_id');
    Session::forget('backup_user_name');
    Session::forget('backup_user_status');

    return redirect()->route('user.dashboard')->with('success', 'Switched back to user account.');
}


}
