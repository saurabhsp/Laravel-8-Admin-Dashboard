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

    //Store user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:users,phone|numeric|digits:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        // Check if image is uploaded
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $filename = time() . '_' . $image->getClientOriginalName();

            // Save to public/users/profilepic
            $image->move(public_path('users/profilepic'), $filename);

            $imagePath = 'users/profilepic/' . $filename; // Save this path to DB
        }

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,
            'profile_picture' => $imagePath,
        ]);

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
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];
    
        // ✅ Only update image if a new one is uploaded
        if ($request->hasFile('profile_picture')) {
            // Delete old image if exists
            if ($user->profile_picture && file_exists(public_path($user->profile_picture))) {
                unlink(public_path($user->profile_picture));
            }
    
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('users/profilepic'), $filename);
            $data['profile_picture'] = 'users/profilepic/' . $filename;
        }
    
        $user->update($data);
    
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
