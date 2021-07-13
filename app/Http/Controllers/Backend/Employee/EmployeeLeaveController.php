<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LeavePurpose;
use App\Model\EmployeeLeave;
use App\User;
use Session;

class EmployeeLeaveController extends Controller
{
    public function view()
    {
    	Session::put('page', 'employee_leave');
    	$alldata = EmployeeLeave::orderBy('id','desc')->get();
    	return view('backend.employee.employee_leave.view-leave')->with(compact('alldata'));
    }
    public function add()
    {
    	$employees = User::where('usertype','employee')->get();
    	$leave_purpose = LeavePurpose::all();
    	return view('backend.employee.employee_leave.add-leave')->with(compact('leave_purpose','employees'));
    }
    public function store(Request $request)
    {
    	if ($request->leave_purpose_id=='0') {
    		$leavepurpose = new LeavePurpose();
    		$leavepurpose->name = $request->name;
    		$leavepurpose->save();
    		$leave_purpose_id = $leavepurpose->id;
    	}
    	else{
    		$leave_purpose_id = $request->leave_purpose_id;
    	}
    	$data = new EmployeeLeave();
    	$data->employee_id = $request->employee_id;
    	$data->start_date = date('Y-m-d',strtotime($request->start_date));
    	$data->end_date = date('Y-m-d',strtotime($request->end_date));;
    	$data->leave_purpose_id = $leave_purpose_id;
    	$data->save();

    	return redirect()->route('employees.leave.view')->with('success_message','Data inserted Successfully');
    }
    public function edit($id)
    {
    	$employees = User::where('usertype','employee')->get();
    	$leave_purpose = LeavePurpose::all();
    	$editdata = EmployeeLeave::find($id);
    	return view('backend.employee.employee_leave.add-leave')->with(compact('editdata','leave_purpose','employees'));
    }
    public function update(Request $request, $id)
    {
    	if ($request->leave_purpose_id=='0') {
    		$leavepurpose = new LeavePurpose();
    		$leavepurpose->name = $request->name;
    		$leavepurpose->save();
    		$leave_purpose_id = $leavepurpose->id;
    	}
    	else{
    		$leave_purpose_id = $request->leave_purpose_id;
    	}
    	$data = EmployeeLeave::find($id);
    	$data->employee_id = $request->employee_id;
    	$data->start_date = date('Y-m-d',strtotime($request->start_date));
    	$data->end_date = date('Y-m-d',strtotime($request->end_date));;
    	$data->leave_purpose_id = $leave_purpose_id;
    	$data->save();

    	return redirect()->route('employees.leave.view')->with('success_message','Data Updated Successfully');
    }
}
