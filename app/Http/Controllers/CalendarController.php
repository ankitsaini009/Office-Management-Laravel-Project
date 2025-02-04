<?php

namespace App\Http\Controllers;

use App\Models\office_ip;
use App\Models\User;
use App\Models\Salary;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AttendenceDeatail;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function calender()
    {
        $office_ip = office_ip::where('Address', 'Office IP')->first();
        $user_ip = request()->ip();
        //dd($user_ip);

        $attendences_data = array();
        $attendences = Attendance::where('user_id', Auth::user()->id)->get();
        foreach ($attendences as $attendance) {
            $attendences_data[] = [
                'title' => $attendance->status,
                'start' => $attendance->date,
                'created_at' => $attendance->created_at,
                'punch_out' => $attendance->punch_out,
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

        return view('calender.calender', compact('attendences_data', 'attendenceDeatailShow', 'counttotal', 'countWFO', 'countWFH', "office_ip", "user_ip"));
    }

    public function UserAttendence(Request $req)
    {
        //dd($req->all());

        $today = now()->toDateString();
        $user = Auth::user();

        $alreadyPunched = Attendance::where('date', $today)
            ->where('user_id', $user->id)
            ->first();

        if ($alreadyPunched) {

            $alreadyPunched->update([
                'punch_out' => $req->punch_out,
                'status' => $req->status
            ]);
        } else {
            Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'status' => $req->status
            ]);
        }

        $attendance = Attendance::where('date', $today)
            ->where('user_id', $user->id)
            ->first();

        if (!$attendance) {
            Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'status' => 'Absent', // Automatically Mark Absent.
            ]);
        }
    }

    public function saveip(Request $request)
    {
        // Find the office_ip record by ip_id
        $office_ip = office_ip::find($request->ip_id);

        // Check if the record exists
        if ($office_ip) {
            // Update the ip address
            $office_ip->update([
                'ip' => $request->ip_address,
            ]);

            return redirect()->back()->with('success', 'IP address updated successfully.');
        } else {
            // If no record found, return an error message
            return redirect()->back()->with('error', 'IP address not found.');
        }
    }

    // Attendance Show
    public function attendanceShow(Request $req, $user_id)
    {

        $totaluser = User::where('status', 1)
            ->orWhere('status', 0)
            ->get();

        $counttotal = $totaluser->count();

        $WFO = User::where('work_type', 'WFO');
        $countWFO = $WFO->count();

        $WFH = User::where('work_type', 'WFH');
        $countWFH = $WFH->count();

        // $attendance = Attendance::with('user');

        // dd($attendance);

        if ($req->ajax()) {
            $attendance = Attendance::with('user')
                ->where('user_id', $user_id)
                ->whereMonth('date', Carbon::now()->month)
                ->whereYear('date', Carbon::now()->year)
                ->get();

            return datatables()->of($attendance)
                ->make(true);
        }

        return view('admin.attendance', compact('counttotal', 'countWFO', 'countWFH', 'user_id'));
    }

    public function bonusSalary(Request $req, $id)
    {
        $totaluser = User::where('status', 1)
            ->orWhere('status', 0)
            ->get();

        $counttotal = $totaluser->count();

        $WFO = User::where('work_type', 'WFO');
        $countWFO = $WFO->count();

        $WFH = User::where('work_type', 'WFH');
        $countWFH = $WFH->count();


        // Bonus Deatails Show
        if ($req->ajax()) {
            $bonusSalaries = AttendenceDeatail::where('user_id', $id)
                ->whereYear('created_at', Carbon::now()->year)->get();

            $formatData = json_decode($bonusSalaries[0]->bonuses);

            return dataTables()->of($formatData)
                ->make(true);
        }

        return view('admin.salaryBonus', compact('counttotal', 'countWFO', 'countWFH', 'id'));
    }

    // Salary Bonus Store
    public function salaryBonusStore(Request $request, $id)
    {

        // Validation
        $request->validate([
            'bonus_name' => 'required',
            'bonus_salary' => 'required',
        ]);

        $attendance = AttendenceDeatail::where('user_id', $id)->first();

        if ($attendance) {

            //dd($request->all());

            $newBonus = [
                'bonus_name' => $request->bonus_name,
                'bonus_salary' => $request->bonus_salary,
            ];

            $bonuses = json_decode($attendance->bonuses) ?? [];

            $bonuses[] = $newBonus;
            //dd(json_encode($bonuses));
            // Salary + Bonus salary
            $currentSalary = $attendance->total_salary;
            $newTotalSalary = $currentSalary + $request->bonus_salary;


            //dd($bonuses);
            // Update the bonuses column
            $attendance->update([
                'bonuses' => json_encode($bonuses),
                'total_salary' => $newTotalSalary
            ]);

            return redirect()->back()->with('success', "Bonus Add SuccessFully.");
        }
    }
}
