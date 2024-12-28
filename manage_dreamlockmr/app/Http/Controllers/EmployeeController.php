<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Salary;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AttendenceDeatail;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{

   public function addEmployee()
   {
      return view('admin.employees_add', ['employee' => null]);
   }

   public function storeEmployee(Request $req)
   {
      $req->validate([
         'employee_name' => 'required',
         'email' => 'required|email',
         'work_type' => 'required'
      ]);

      // Handle file uploads
      $idProofFileName = null;
      if ($req->hasFile('id_proof')) {
         $file = $req->file('id_proof');
         $idProofFileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
         $file->move(public_path('/uploads/banners/'), $idProofFileName);
      }


      $imageFileName = null;
      if ($req->hasFile('image')) {
         $file = $req->file('image');
         $imageFileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
         $file->move(public_path('/uploads/banners/'), $imageFileName);
      }

      // Update or create employee
      $employee = User::updateOrCreate(
         ['id' => $req->employee_id],
         [
            'name' => $req->employee_name,
            'email' => $req->email,
            'role' => $req->role,
            'status' => $req->status,
            'work_type' => $req->work_type,
            'bank_acount' => $req->bank_acount,
            // 'salary' => $req->salary,
            'Address' => $req->address,
            'id_proof' => $idProofFileName ?? $req->id_proof,
            'Profile' => $imageFileName ?? $req->image,
         ]
      );

    // Save Salary Details 
      $month = Carbon::now()->format('Y-m');
      if ($req->filled('salary')) {
         Salary::updateOrCreate(
            ['user_id' => $employee->id], // Link salary to the employee
            [
               'salary' => $req->salary,
               'month' => $month
            ]
         );
  }

      if ($employee) {
         return redirect()->route('admin.dashboard')->with('success', $req->employee_id ? 'Employee successfully Updated!' : "Employee successfully add!");
      } else {
         return redirect()->back()->withInput()->with('error', $req->employee_id ? "Error in empolyee update. Please try again." : "Error in empolyee add. Please try again.");
      }
   }

   public function editEmployee($id)
   {
      $employee = User::findOrFail($id);
      $employeeSalary = Salary::where('user_id', $id)->first();
      return view('admin.employees_add', compact('employee', 'employeeSalary'));
   }

   public function deleteEmployee($id)
   {
      $employee = User::findOrFail($id);
      $employee->delete();

      return \redirect()->route('admin.dashboard')->with('success', 'Employee deleted successfuly');
   }

   public function employeeStatus(Request $request)
   {
      $id = $request->id;
      $employee = User::findOrFail($id);

      if ($employee->status) {
         $employee->status = 0;
      } else {
         $employee->status = 1;
      }

      $employee->save();

      return $employee;
   }


   // Employee Attendence Deatail
   public function attendenceDeatail(Request $req){

        $salary = Salary::where('user_id', $req->user_id)->first();
        $month =  Carbon::now()->format('Y-m');

        $attendenceDatail = AttendenceDeatail::where([
           'user_id' => $req->user_id,
           'month' => $month
         ])->first();

        if(!$attendenceDatail){
            $attendenceDatail = new AttendenceDeatail();
            $attendenceDatail->user_id = $req->user_id;
            $attendenceDatail->month = $month;
         }
        
         if (!$salary) {
            // Create a new salary record if it doesn't exist
            $salary = Salary::create([
                'user_id' => $req->user_id,
                'salary' => 0,
                'month' => $month
            ]);
        }
        
        $attendenceDatail->salary_id = $salary->id;
        $attendenceDatail->working_days = $req->working_days;
        $attendenceDatail->leave_days = $req->leave_days;
        $attendenceDatail->half_days = $req->half_days;

       // Calculate Employee Salary   
        $totalDaysInMonth = Carbon::now()->daysInMonth;
        $employeeSalary = $salary->salary;
        
        $perDaySalary = $employeeSalary / $totalDaysInMonth;
        $halfDaySalary = $perDaySalary / 2;
        $presentDays = $attendenceDatail->working_days;
        $halfDays = $attendenceDatail->half_days;

        $totalSalary = ($presentDays * $perDaySalary) + ($halfDays * $halfDaySalary); 

        $attendenceDatail->total_salary = $totalSalary;
      
        $attendenceDatail->save();
   }
   
   public function attendenceDeatailShow(Request $req){
      
      // Dashboard Employee Work Count
      $totaluser = User::where('status', 1)
      ->orWhere('status', 0)
      ->get();
      
      $counttotal = $totaluser->count();
      
      $WFO = User::where('work_type', 'WFO');
      $countWFO = $WFO->count();
      
      $WFH = User::where('work_type', 'WFH');
      $countWFH = $WFH->count();
      
      
      if($req->ajax()){
         $attendenceDeatailShow = AttendenceDeatail::with(['user','salary'])->get();

         return datatables()->of($attendenceDeatailShow)
                ->addIndexColumn()
                ->make(true);
      }

      return view('admin.salary', compact('counttotal', 'countWFO', 'countWFH',));
   }

   // Update Payment Status
   public function updateSalaryPayStatus(Request $req){
       if($req->user_id != ""){
          $id = $req->user_id;
          $AttenDeatail = AttendenceDeatail::where('user_id', $id)->firstOrFail();;

          if($AttenDeatail->pay_status){
             $AttenDeatail->pay_status = 0;
          }else{
             $AttenDeatail->pay_status = 1;
          }

          $AttenDeatail->save();

          return $AttenDeatail;
       }      
   }
}