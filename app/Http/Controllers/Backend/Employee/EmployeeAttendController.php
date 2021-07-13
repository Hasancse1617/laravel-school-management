<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LeavePurpose;
use App\Model\EmployeeLeave;
use App\Model\EmployeeAttendance;
use App\User;
use Session;

class EmployeeAttendController extends Controller
{
    public function view()
    {
    	Session::put('page', 'employee_attend');
    	$alldata = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','desc')->get();
    	return view('backend.employee.employee_attend.view-attend')->with(compact('alldata'));
    }
    public function add()
    {
    	$employees = User::where('usertype','employee')->get();
    	$leave_purpose = LeavePurpose::all();
    	return view('backend.employee.employee_attend.add-attend')->with(compact('leave_purpose','employees'));
    }
    public function store(Request $request)
    {
    	EmployeeAttendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();
        $countemployee = count($request->employee_id);
        for ($i = 0; $i < $countemployee; $i++) {
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d',strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
    	return redirect()->route('employees.attend.view')->with('success_message','Data inserted Successfully');
    }
    public function edit($date)
    {
    	$employees = User::where('usertype','employee')->get();
    	$editdata = EmployeeAttendance::where('date',$date)->get();
    	return view('backend.employee.employee_attend.add-attend')->with(compact('editdata','employees'));
    }
    public function details($date)
    {
        $details = EmployeeAttendance::where('date',$date)->get();
        return view('backend.employee.employee_attend.details-attend')->with(compact('details'));
    }
}
