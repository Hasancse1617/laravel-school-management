<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ExamType;
use Session;

class ExamTypeController extends Controller
{
    public function view()
    {
    	Session::put('page', 'exam_type');
    	$alldata = ExamType::all();
    	return view('backend.setup.exam_type.view-exam-type')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.setup.exam_type.add-exam-type');
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required|unique:exam_types,name'
    	]);
    	$data = new ExamType();
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data created successfully';
    	return redirect()->route('setups.exam.type.view')->with('success_message',$message);
    }
    public function edit(Request $request,$id)
    {
    	$editdata = ExamType::find($id);
    	return view('backend.setup.exam_type.add-exam-type')->with(compact('editdata'));
    }
    public function update(Request $request,$id)
    {
    	$this->validate($request,[
            'name'=>'required|unique:years,name'
    	]);
    	$data = ExamType::find($id);
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data updated successfully';
    	return redirect()->route('setups.exam.type.view')->with('success_message',$message);
    }
    public function delete(Request $request)
    {
    	$data = ExamType::find($request->id);
    	$data->delete();
    	$message = 'Data deleted successfully';
    	return redirect()->route('setups.exam.type.view')->with('success_message',$message);
    }
}
