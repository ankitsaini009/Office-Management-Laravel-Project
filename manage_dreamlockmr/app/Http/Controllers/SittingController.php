<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\setting;

class SittingController extends Controller
{
    public function index()
    {
        $getsetting = setting::latest()->first();
        return view('admin.sittings.index', compact('getsetting'));
    }
    public function editpro()
    {
        $getsetting = setting::latest()->first();
        return view('admin.sittings.edit', compact('getsetting'));
    }
    public function update($id, Request $req)
    {
        $req->validate([
            'site_name' => 'required',
            'AID' => 'required',
            'anugapty_name_snstha' => 'required',
            'anugapty_no' => 'required',
            'anugapty_state' => 'required',
            'anugapty_phone' => 'required',
            'site_email' => 'required',
            'site_contact' => 'required',
            'site_address' => 'required',
        ]);
        $settingdata = setting::find($id);
        $settingdata->site_name = $req->site_name;
        $settingdata->site_email = $req->site_email;
        $settingdata->site_contact = $req->site_contact;
        $settingdata->site_address = $req->site_address;
        $settingdata->facebook_url = $req->facebook_url;
        $settingdata->insta_url = $req->insta_url;
        $settingdata->twitter_url = $req->twitter_url;
        $settingdata->youtub_url = $req->youtub_url;
        $settingdata->linkdin_url = $req->linkdin_url;
        $settingdata->AID = $req->AID;
        $settingdata->anugapty_name_snstha = $req->anugapty_name_snstha;
        $settingdata->anugapty_no = $req->anugapty_no;
        $settingdata->anugapty_state = $req->anugapty_state;
        $settingdata->anugapty_phone = $req->anugapty_phone;

        if (request()->hasFile('sitelogo')) {
            $file = request()->file('sitelogo');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/banners/', $fileName);
            $settingdata->site_logo = $fileName;
        }
        if (request()->hasFile('favicon')) {
            $file = request()->file('favicon');
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $file->move('./uploads/banners/', $fileName);
            $settingdata->site_fav_icon = $fileName;
        }
        if ($settingdata->save()) {
            return redirect()->route('index.sitting')->with('success', 'Site Sitting successfully updated');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error in Profile add. Please try again');
        }
    }
}
