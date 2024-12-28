<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AttendenceDeatail;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function calender(){
        $attendences_data = array();  
        $attendences = Attendance::where('user_id', Auth::user()->id)->get();
        foreach($attendences as $attendance){
            $attendences_data[] = [
                'title' => $attendance->status,
                'start' => $attendance->date,
            ];
        }

        // Employee Attendence Deatails Logic 
        $month =  Carbon::now()->format('Y-m');
        $attendenceDeatailShow = AttendenceDeatail::where([
           'user_id' => Auth::user()->id,
           'month' => $month
        ])->first();

        // Dashboard Employee Work Count
        $totaluser = User::where('status', 1)
        ->orWhere('status', 0)
        ->get();

        $counttotal = $totaluser->count();

        $WFO = User::where('work_type', 'WFO');
        $countWFO = $WFO->count();

        $WFH = User::where('work_type', 'WFH');
        $countWFH = $WFH->count();
        
        return view('calender.calender', compact('attendences_data','attendenceDeatailShow','counttotal', 'countWFO', 'countWFH',));
    }

    public function UserAttendence(Request $req){
        Attendance::updateOrCreate(
        ['date' => $req->date],
        [
           'user_id' => $req->user_id,
           'date' => $req->date,
           'status' => $req->status,
        ]);
    }
}
