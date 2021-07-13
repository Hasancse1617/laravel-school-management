<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentGroup;
use Session;

class GroupController extends Controller
{
    public function view()
    {
    	Session::put('page', 'student_group');
    	$alldata = StudentGroup::all();
    	return view('backend.setup.group.view-group')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.setup.group.add-group');
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required|unique:student_groups,name'
    	]);
    	$data = new StudentGroup();
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data created successfully';
    	return redirect()->route('setups.student.group.view')->with('success_message',$message);
    }
    public function edit(Request $request,$id)
    {
    	$editdata = StudentGroup::find($id);
    	return view('backend.setup.group.add-group')->with(compact('editdata'));
    }
    public function update(Request $request,$id)
    {
    	$this->validate($request,[
            'name'=>'required|unique:student_groups,name'
    	]);
    	$data = StudentGroup::find($id);
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data updated successfully';
    	return redirect()->route('setups.student.group.view')->with('success_message',$message);
    }
    public function delete(Request $request)
    {
    	$data = StudentGroup::find($request->id);
    	$data->delete();
    	$message = 'Data deleted successfully';
    	return redirect()->route('setups.student.group.view')->with('success_message',$message);
    }
}
