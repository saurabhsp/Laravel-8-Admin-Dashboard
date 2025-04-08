<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Login extends Component
{
    public $email = '';
    public $password = '';

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function store()
    {
        $credentials = $this->validate();

        if (Auth::guard('admin')->attempt($credentials)) {
            session()->regenerate();
            Session::flash('success', 'Logged in successfully.');
            return redirect()->route('dashboard'); // Make sure this route is defined
        }

        throw ValidationException::withMessages([
            'email' => 'Invalid email or password.',
        ]);
    }
}
