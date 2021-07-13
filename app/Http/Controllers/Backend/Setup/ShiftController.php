<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentShift;
use Session;

class ShiftController extends Controller
{
    public function view()
    {
    	Session::put('page', 'student_shift');
    	$alldata = StudentShift::all();
    	return view('backend.setup.shift.view-shift')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.setup.shift.add-shift');
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required|unique:student_shifts,name'
    	]);
    	$data = new StudentShift();
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data created successfully';
    	return redirect()->route('setups.student.shift.view')->with('success_message',$message);
    }
    public function edit(Request $request,$id)
    {
    	$editdata = StudentShift::find($id);
    	return view('backend.setup.shift.add-shift')->with(compact('editdata'));
    }
    public function update(Request $request,$id)
    {
    	$this->validate($request,[
            'name'=>'required|unique:student_shifts,name'
    	]);
    	$data = StudentShift::find($id);
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data updated successfully';
    	return redirect()->route('setups.student.shift.view')->with('success_message',$message);
    }
    public function delete(Request $request)
    {
    	$data = StudentShift::find($request->id);
    	$data->delete();
    	$message = 'Data deleted successfully';
    	return redirect()->route('setups.student.shift.view')->with('success_message',$message);
    }
}
