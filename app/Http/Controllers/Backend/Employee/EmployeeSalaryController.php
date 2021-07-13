<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\Year;
use App\Model\EmployeeSalaryLog;
use App\Model\Designation;
use App\User;
use Session;
use DB;
use PDF;

class EmployeeSalaryController extends Controller
{
    public function view()
    {
    	Session::put('page', 'employee_salary');
    	$alldata = User::where('usertype','employee')->get();
    	return view('backend.employee.employee_salary.view-employee-salary')->with(compact('alldata'));
    }
    public function increment($id)
    {
    	$editdata = User::find($id);
    	return view('backend.employee.employee_salary.add-employee-salary')->with(compact('editdata'));
    }
    public function store(Request $request,$id)
    {
       $user = User::find($id);
       $previous_salary = $user->salary;
       $present_salary = (float)$previous_salary+(float)$request->increment_salary;
       $user->salary = $present_salary;
       $user->save();
       $salarydata = new EmployeeSalaryLog();
       $salarydata->employee_id = $id;
       $salarydata->previous_salary = $previous_salary;
       $salarydata->present_salary = $present_salary;
       $salarydata->increment_salary = $request->increment_salary;
       $salarydata->effected_date = date('Y-m-d',strtotime($request->effected_date));
       $salarydata->save();
       return redirect()->route('employees.salary.view')->with('success_message','Salary increment successfully');
    }
    public function details($id)
    {
    	$details = User::find($id);
    	$salarylog = EmployeeSalaryLog::where('employee_id',$id)->get();
        return view('backend.employee.employee_salary.employee-salary-details')->with(compact('details','salarylog'));
    }
}
