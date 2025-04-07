<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $name, $email, $password;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:admins,email',
        'password' => 'required|min:6',
    ];

    public function register()
    {
        $this->validate();

        Admin::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('success', 'Admin account created successfully.');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
