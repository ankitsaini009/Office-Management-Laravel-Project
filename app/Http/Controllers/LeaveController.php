<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function LeaveIndex()
    {
        return view('admin.leavesShow', ['leave' => null]);
    }

    public function leaveAdd()
    {
        return view('admin.leaveApplye', ['leave' => null]);
    }

    public function editLeave($id)
    {
        $leave = Leave::findOrFail($id);
        return view('admin.leaveApplye', compact('leave'));
    }

    public function deleteleve($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();
        return redirect()->back()->with('success', 'Leave request Delete successfully!');
    }

    public function leaveApply(Request $request)
    {
        $request->validate([
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'leave_reason' => 'nullable|string',
        ]);

        Leave::updateOrCreate(
            ['id' => $request->leave_id],
            [
                'user_id' => auth()->user()->id,
                'leave_type' => $request->leave_type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'leave_reason' => $request->leave_reason,
                'status' => $request->status ?? 0,
            ]
        );

        return redirect()->route('leave.index')->with('success', 'Leave request submitted successfully!');
    }

    public function allleave(Request $request)
    {
        $leaves = Leave::with('user')->get();

        if ($request->ajax()) {
            return datatables()->of($leaves)
                ->addIndexColumn()
                ->addColumn('actions', function ($leaves) {
                    return '
            <a href="' . route('leave.edit', $leaves->id) . '" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
        ';
                })
                ->rawColumns(['actions']) // Allow HTML for permissions and actions columns
                ->make(true);
        }

        return view('admin.HRallleave');
    }

    public function leavesShow(Request $request)
    {
        $leaves = Leave::with('user')->get();

        if ($request->ajax()) {
            return datatables()->of($leaves)
                ->addIndexColumn()
                ->addColumn('actions', function ($leaves) {
                    return '
            <a href="' . route('leave.edit', $leaves->id) . '" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="' . route('leave.deleteleve', $leaves->id) . '" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure?\');">
                ' . csrf_field() . method_field('DELETE') . '
                <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
        ';
                })
                ->rawColumns(['actions']) // Allow HTML for permissions and actions columns
                ->make(true);
        }
    }
}
