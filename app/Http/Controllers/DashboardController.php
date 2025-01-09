<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\office_ip;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use App\Models\Attendance;
use Illuminate\Support\Carbon;
use App\Models\AttendenceDeatail;


class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {

        $attendences_data = array();
        $attendences = Attendance::where('user_id', Auth::id())->get();
        foreach ($attendences as $attendance) {
            $attendences_data[] = [
                'title' => $attendance->status,
                'start' => $attendance->date,
                'created_at' => $attendance->created_at,
                'punch_out' => $attendance->punch_out,
            ];
        }

        $totaluser = User::where('status', 1)
            ->orWhere('status', 0)
            ->get();

        $counttotal = $totaluser->count();

        $WFO = User::where('work_type', 'WFO');
        $countWFO = $WFO->count();

        $WFH = User::where('work_type', 'WFH');
        $countWFH = $WFH->count();

        //dd($counttotal);

        $office_ip = office_ip::where('Address', 'Office IP')->first();
        $user_ip = $_SERVER['REMOTE_ADDR'];
        //dd($user_ip);

        // Employee Attendence Deatails Logic 
        $month =  Carbon::now()->format('Y-m');
        $attendenceDeatailShow = AttendenceDeatail::where([
            'user_id' => Auth::user()->id,
            'month' => $month
        ])->first();

        //dd($office_ip);
        if ($request->ajax()) {
            $roles = User::where('status', 1)
                ->orWhere('status', 0)
                ->get();

            return datatables()->of($roles)
                ->addIndexColumn()
                ->addColumn('actions', function ($role) {
                    if (Auth::user()->role === "HR" || Auth::user()->role === "Admin") {
                        return '
                    <a href="' . route('employees.edit', $role->id) . '" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="' . route('employees.destroy', $role->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                ';
                    }
                })
                ->rawColumns(['actions']) // Allow HTML for permissions and actions columns
                ->make(true);
        }
        return view('admin.dashboard', compact('counttotal', 'attendenceDeatailShow', 'countWFO', 'countWFH', "attendences_data", "office_ip", "user_ip"));
    }
}
