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

class EmployeeRegController extends Controller
{
    public function view()
    {
    	Session::put('page', 'employee_reg');
    	$alldata = User::where('usertype','employee')->get();
    	return view('backend.employee.employee_reg.view-employee')->with(compact('alldata'));
    }
    public function add()
    {
    	$designations = Designation::all();
    	return view('backend.employee.employee_reg.add-employee')->with(compact('designations'));
    }
    public function store(Request $request)
    {
    	DB::transaction(function() use($request){
           $checkYear = date('Ym',strtotime($request->join_date));
           $employee = User::where('usertype','employee')->orderBy('id','desc')->first();
           if ($employee==null) {
           	  $first_reg = 0;
           	  $employeeId = $first_reg + 1;
           	  if ($employeeId < 10) {
           	  	$id_no = '000'.$employeeId;
           	  }
           	  elseif ($employeeId < 100) {
           	  	$id_no = '00'.$employeeId;
           	  }
           	  elseif ($employeeId < 1000) {
           	  	$id_no = '0'.$employeeId;
           	  }
           }
           else {
           	  $employee = User::where('usertype','employee')->orderBy('id','desc')->first()->id;
           	  $employeeId = $employee + 1;
           	  if ($employeeId < 10) {
           	  	$id_no = '000'.$employeeId;
           	  }
           	  elseif ($employeeId < 100) {
           	  	$id_no = '00'.$employeeId;
           	  }
           	  elseif ($employeeId < 1000) {
           	  	$id_no = '0'.$employeeId;
           	  }
           }
           $final_id_no = $checkYear.$id_no;
           $user = new User();
           $code = rand(0000,9999);

           $user->id_no = $final_id_no;
           $user->name = $request->name;
           $user->code = $code;
           $user->password = bcrypt($code);
           $user->usertype = 'employee';
           $user->fname = $request->fname;
           $user->mname = $request->mname;
           $user->mobile = $request->mobile;
           $user->email = $request->email;
           $user->address = $request->address;
           $user->gender = $request->gender;
           $user->religion = $request->religion;
           $user->salary = $request->salary;
           $user->designation_id = $request->designation_id;
           $user->dob = date('Y-m-d',strtotime($request->dob));
           $user->join_date = date('Y-m-d',strtotime($request->join_date));
           if ($request->file('image')) {
	    		$file = $request->file('image');
	    		//@unlink(public_path('upload/user_images/'.$data->image));
	    		$filename = date('YmdHi').$file->getClientOriginalName();
	    		$file->move(public_path('upload/employee_images/'), $filename);
	    		$user['image'] = $filename;
    	    }
           $user->save();

           $employee_salary = new EmployeeSalaryLog();
           $employee_salary->employee_id = $user->id;
           $employee_salary->effected_date = date('Y-m-d',strtotime($request->join_date));
           $employee_salary->previous_salary = $request->salary;
           $employee_salary->present_salary = $request->salary;
           $employee_salary->increment_salary = '0';
           $employee_salary->save();
    	});
    	return redirect()->route('employees.reg.view')->with('success_message','Data inserted successfully');
    }
    public function edit($id)
    {
    	$editdata = User::find($id);
    	$designations = Designation::all();
    	return view('backend.employee.employee_reg.add-employee')->with(compact('editdata','designations'));
    }
    public function update(Request $request,$id)
    {
       $user = User::find($id);
       $user->name = $request->name;
       $user->fname = $request->fname;
       $user->mname = $request->mname;
       $user->mobile = $request->mobile;
       $user->email = $request->email;
       $user->address = $request->address;
       $user->gender = $request->gender;
       $user->religion = $request->religion;
       $user->designation_id = $request->designation_id;
       $user->dob = date('Y-m-d',strtotime($request->dob));
       if ($request->file('image')) {
    		$file = $request->file('image');
    		@unlink(public_path('upload/employee_images/'.$user->image));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/employee_images/'), $filename);
    		$user['image'] = $filename;
	    }
       $user->save();
       return redirect()->route('employees.reg.view')->with('success_message','Data updated successfully');
    }
    public function details($id)
    {
    	$data['details'] = User::find($id);
    	$pdf = PDF::loadView('backend.employee.employee_reg.employee-details-pdf', $data);
		  $pdf->SetProtection(['copy', 'print'], '', 'pass');
		  return $pdf->stream('document.pdf');
    }
}
