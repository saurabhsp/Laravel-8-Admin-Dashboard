<?php

namespace App\Http\Controllers;
use App\Models\Dealer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class DealerController extends Controller
{

//Login detailssss

public function showLoginForm()
{
    return view('dealer.login');
}


public function dealerLogin(Request $request)
{

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);


    $dealer = Dealer::where('email', $request->email)->first();

    if (!$dealer) {
        return back()->with('error', 'No dealer found with this email.');
    }


    if (!Hash::check($request->password, $dealer->password)) {
        return back()->with('error', 'Incorrect password.');
    }

    // if ($dealer->status == 0) {
    //     return back()->with('error', 'Your account is blocked. Contact the admin.');
    // }
    
    Session::put('id', $dealer->id);
    Session::put('dealer_status', $dealer->status);
    Session::put('dealer_name', $dealer->name);
    return redirect()->route('dealer.dashboard');
}
public function showDashboard()
{
    $dealer = Dealer::find(Session::get('id')); // Fetch only the logged-in dealer
    return view('dealer.dashboard', compact('dealer'));
}

public function dealerLogout()
{
    if (Session::has('dealer_logged_by_user')) {
        // Restore user session
        Session::put('id', Session::get('backup_user_id'));
        Session::put('user_id', Session::get('backup_user_id'));
        Session::put('user_name', Session::get('backup_user_name'));
        Session::put('user_status', Session::get('backup_user_status'));
        Session::put('logged_in_as', 'user');

        // Clear dealer session
        Session::forget([
            'dealer_id', 'dealer_name', 'dealer_status', 
            'dealer_logged_by_user', 'id'
        ]);

        return redirect()->route('user.dashboard');
    }

    // Regular dealer logout
    Session::flush();
    return redirect()->route('dealer.login');
}



}