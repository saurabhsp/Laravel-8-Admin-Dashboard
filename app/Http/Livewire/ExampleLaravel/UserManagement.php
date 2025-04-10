<?php

namespace App\Http\Livewire\ExampleLaravel;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Component
{
    public function render()
    {
        $users = User::all(); // fetch users here
        return view('admin.users', [
            'users' => $users
        ]);
    }
    

    //Create
    public function create()
    {
        return view('admin.users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:users,phone|numeric|digits:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,
            
        ]);
        // return "User Added Success";
        return redirect()->route('user-manage')->with('success', 'User added successfully.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:users,phone,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);
        // return "Updated";
        return redirect()->route('user-manage')->with('success', 'User details updated successfully.');
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->save();

        return redirect()->route('user-manage')->with('success', 'User status updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user-manage')->with('success', 'User deleted successfully.');
    }

    // public function allUsers()
    // {
    //     $users = User::all();
    //     return view('components.navbars.sidebar' , compact('users'));
    // }

    public function index()
    {
        return response()->json(User::all());
    }
    public function showCard($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.usercard', compact('user'));
    }
}
