<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasschangdController extends Controller
{
    public function passchang()
    {
        $getadmin = User::latest()->first();
        return view('admin.passchang', compact('getadmin'));
    }
    public function passedit($id, Request $req)
    {
        $req->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]);

        $admin = Auth::guard('admin')->user();
        if ($req->new_password !== $req->confirm_password) {
            return redirect()->back()->withErrors(['confirm_password' => 'New password and confirm password do not match.'])->withInput();
        }
        if (!Hash::check($req->old_password, $admin->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The specified old password does not match the Old password'])->withInput();
        }
        $admin->password = Hash::make($req->new_password);
        $admin->save();
        return redirect()->route('admin.dashboard')->with('success', 'Password changed successfully');
    }
}
