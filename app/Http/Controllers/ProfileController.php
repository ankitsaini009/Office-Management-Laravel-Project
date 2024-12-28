<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use App\Models\User;


class ProfileController extends Controller
{
    public function index()
    {
        $getadmin = User::latest()->first();
        return view('admin.profile.index', compact('getadmin'));
    }
    public function editpro()
    {
        $getadmin = User::latest()->first();
        return view('admin.profile.edit', compact('getadmin'));
    }
    public function update($id, Request $req)
    {
        //dd($req->all());

        $req->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $admindata = User::find($id);
        $admindata->name = $req->name;
        $admindata->email = $req->email;
        $admindata->work_type = $req->work_type;
        $admindata->phone_no = $req->phoneno;
        $admindata->status = $req->status;
        $admindata->bank_acount = $req->bank_acount;
        $admindata->Address = $req->address;

        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/banners/', $fileName);
            $admindata->Profile = $fileName;
        }
        if (request()->hasFile('id_proof')) {
            $file = request()->file('id_proof');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/banners/', $fileName);
            $admindata->id_proof = $fileName;
        }
        if ($admindata->save()) {
            return redirect()->route('index.profile')->with('success', 'Profile successfully updated');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error in Profile add. Please try again');
        }
    }
}
