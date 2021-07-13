<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\FeeCategory;
use Session;

class FeeCategoryController extends Controller
{
    public function view()
    {
    	Session::put('page', 'fee_category');
    	$alldata = FeeCategory::all();
    	return view('backend.setup.fee_category.view-fee-category')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.setup.fee_category.add-fee-category');
    }
    public function store(Request $request)
    {
    	$this->validate($request,[
            'name'=>'required|unique:fee_categories,name'
    	]);
    	$data = new FeeCategory();
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data created successfully';
    	return redirect()->route('setups.fee.category.view')->with('success_message',$message);
    }
    public function edit(Request $request,$id)
    {
    	$editdata = FeeCategory::find($id);
    	return view('backend.setup.fee_category.add-fee-category')->with(compact('editdata'));
    }
    public function update(Request $request,$id)
    {
    	$this->validate($request,[
            'name'=>'required|unique:fee_categories,name'
    	]);
    	$data = FeeCategory::find($id);
    	$data->name = $request->name;
    	$data->save();
    	$message = 'Data updated successfully';
    	return redirect()->route('setups.fee.category.view')->with('success_message',$message);
    }
    public function delete(Request $request)
    {
    	$data = FeeCategory::find($request->id);
    	$data->delete();
    	$message = 'Data deleted successfully';
    	return redirect()->route('setups.fee.category.view')->with('success_message',$message);
    }
}
