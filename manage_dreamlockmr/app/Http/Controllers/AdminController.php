<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Velidator;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AdminController extends Controller
{

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {

            session()->flash('error', 'Invalid Email or Password.');
            return back()->withInput($request->only('email'));
        }

        if ($user->status == 1 || $user->status == 2) {
            // Attempt login
            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                session()->flash('Success', 'Login Successfully');
                return redirect()->route('admin.dashboard');
            } else {
                session()->flash('error', 'Invalid Email or Password.');
                return back()->withInput($request->only('email'));
            }
        } else {
            // If the user's status is not 1 or 2
            session()->flash('error', 'Your account is not activet. Please contact support.');
            return back()->withInput($request->only('email'));
        }
    }

    public function getRecentUsers()
    {
        // Fetch users created in the last 2 days
        $recentUsers = User::where('created_at', '>=', now()->subDays(2))->where('status', 1)
            ->orWhere('status', 0)
            ->orderBy('created_at', 'desc')
            ->get(['id', 'name', 'email', 'created_at', 'role']); // Adjust fields as needed
        $totalCount = $recentUsers->count();

        return response()->json([
            'users' => $recentUsers,
            'count' => $totalCount,
        ]);
    }

    public function removeNotification($id)
    {
        // Handle logic to mark the notification as seen or remove it
        // Example: If notifications are stored in a table, mark as seen
        // If directly removing from frontend list, this may just return success.
        return response()->json(['status' => 'success']);
    }



    // public function authenticate(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email', // Added email format validation
    //         'password' => 'required',
    //     ]);

    //     if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
    //         session()->flash('Success', 'Login Successfully');
    //         return redirect()->route('admin.dashboard');
    //     } else {
    //         session()->flash('error', 'Error In Login');
    //         return back()->withInput($request->only('email'));
    //     }
    // }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
