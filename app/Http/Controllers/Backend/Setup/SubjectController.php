<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Subject;
use Session;

class SubjectController extends Controller
{
    public function view()
    {
    	Session::put('page', 'subject');
    	$alldata = Subject::all();
    	return view('backend.setup.subject.view-subject')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.setup.subject.add-subject');
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required|unique:subjects,name'
    	]);
    	$data = new Subject();
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data created successfully';
    	return redirect()->route('setups.subject.view')->with('success_message',$message);
    }
    public function edit(Request $request,$id)
    {
    	$editdata = Subject::find($id);
    	return view('backend.setup.subject.add-subject')->with(compact('editdata'));
    }
    public function update(Request $request,$id)
    {
    	$this->validate($request,[
            'name'=>'required|unique:years,name'
    	]);
    	$data = Subject::find($id);
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data updated successfully';
    	return redirect()->route('setups.subject.view')->with('success_message',$message);
    }
    public function delete(Request $request)
    {
    	$data = Subject::find($request->id);
    	$data->delete();
    	$message = 'Data deleted successfully';
    	return redirect()->route('setups.subject.view')->with('success_message',$message);
    }
}
