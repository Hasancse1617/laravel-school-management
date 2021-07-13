<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use Session;

class StudentClassController extends Controller
{
    public function view()
    {
    	Session::put('page', 'student_class');
    	$allclass = StudentClass::all();
    	return view('backend.setup.student_class.view-class')->with(compact('allclass'));
    }
    public function add()
    {
    	return view('backend.setup.student_class.add-class');
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required|unique:student_classes,name'
    	]);
    	$data = new StudentClass();
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data  created successfully';
    	return redirect()->route('setups.student.class.view')->with('success_message',$message);
    }
    public function edit(Request $request,$id)
    {
    	$editdata = StudentClass::find($id);
    	return view('backend.setup.student_class.add-class')->with(compact('editdata'));
    }
    public function update(Request $request,$id)
    {
    	$this->validate($request,[
            'name'=>'required|unique:student_classes,name'
    	]);
    	$data = StudentClass::find($id);
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data updated successfully';
    	return redirect()->route('setups.student.class.view')->with('success_message',$message);
    }
    public function delete(Request $request)
    {
    	$data = StudentClass::find($request->id);
    	$data->delete();
    	$message = 'Data deleted successfully';
    	return redirect()->route('setups.student.class.view')->with('success_message',$message);
    }
}
