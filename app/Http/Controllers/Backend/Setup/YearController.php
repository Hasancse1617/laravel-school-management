<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Year;
use Session;

class YearController extends Controller
{
    public function view()
    {
    	Session::put('page', 'year');
    	$allyear = Year::all();
    	return view('backend.setup.year.view-year')->with(compact('allyear'));
    }
    public function add()
    {
    	return view('backend.setup.year.add-year');
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required|unique:years,name'
    	]);
    	$data = new Year();
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data created successfully';
    	return redirect()->route('setups.student.year.view')->with('success_message',$message);
    }
    public function edit(Request $request,$id)
    {
    	$editdata = Year::find($id);
    	return view('backend.setup.year.add-year')->with(compact('editdata'));
    }
    public function update(Request $request,$id)
    {
    	$this->validate($request,[
            'name'=>'required|unique:years,name'
    	]);
    	$data = Year::find($id);
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data updated successfully';
    	return redirect()->route('setups.student.year.view')->with('success_message',$message);
    }
    public function delete(Request $request)
    {
    	$data = Year::find($request->id);
    	$data->delete();
    	$message = 'Data deleted successfully';
    	return redirect()->route('setups.student.year.view')->with('success_message',$message);
    }
}
