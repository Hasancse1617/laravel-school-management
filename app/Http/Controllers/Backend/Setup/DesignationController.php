<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Designation;
use Session;

class DesignationController extends Controller
{
    public function view()
    {
    	Session::put('page', 'designation');
    	$alldata = Designation::all();
    	return view('backend.setup.designation.view-designation')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.setup.designation.add-designation');
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required|unique:designations,name'
    	]);
    	$data = new Designation();
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data created successfully';
    	return redirect()->route('setups.designation.view')->with('success_message',$message);
    }
    public function edit(Request $request,$id)
    {
    	$editdata = Designation::find($id);
    	return view('backend.setup.designation.add-designation')->with(compact('editdata'));
    }
    public function update(Request $request,$id)
    {
    	$this->validate($request,[
            'name'=>'required|unique:designations,name'
    	]);
    	$data = Designation::find($id);
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data updated successfully';
    	return redirect()->route('setups.designation.view')->with('success_message',$message);
    }
    public function delete(Request $request)
    {
    	$data = Designation::find($request->id);
    	$data->delete();
    	$message = 'Data deleted successfully';
    	return redirect()->route('setups.designation.view')->with('success_message',$message);
    }
}
