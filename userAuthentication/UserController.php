<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->all());
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'work_type' => 'required|string',
            'role' => 'required|exists:roles,name', // Role must exist in roles table
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'work_type' => $request->work_type,
            'password' => bcrypt($request->password), // Encrypt the password
        ]);

        // Assign role to the user
        $user->assignRole($request->role);

        return redirect()->back()->with('success', 'Registeretion and role assigned successfully!');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email', // Added email format validation
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            session()->flash('Success', 'Login Successfully');
            return redirect()->route('admin.dashboard');
        } else {
            session()->flash('error', 'Error In Login');
            return back()->withInput($request->only('email'));
        }
    }
    
    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('user.login');
    }
}
