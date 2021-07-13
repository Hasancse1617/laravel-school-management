<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountOtherCost;
use Session;

class OtherCostController extends Controller
{
    public function  view()
    {
    	Session::put('page', 'other_cost');
    	$alldata = AccountOtherCost::all();
    	return view('backend.account.cost.view-other-cost')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.account.cost.add-other-cost');
    }
    public function store(Request $request)
    {
    	$cost = new AccountOtherCost();
    	$cost->date = date('Y-m-d',strtotime($request->date));
    	$cost->amount = $request->amount;
    	 if ($request->file('image')) {
    	 	$file = $request->file('image');
    	 	$filename = date('YmdHi').$file->getClientOriginalName();
    	 	$file->move(public_path('upload/cost_images/', $filename));
    	 	$cost['image'] = $filename;
    	 }
	    $cost->description = $request->description;
	    $cost->save();
	    return redirect()->route('accounts.cost.view')->with('success_message','Data inserted successfully');
    }
    public function edit($id)
    {
    	$editdata = AccountOtherCost::find($id);
    	return view('backend.account.cost.add-other-cost')->with(compact('editdata'));
    }
    public function update(Request $request, $id)
    {
    	$data = AccountOtherCost::find($id);
    	$data->date = date('Y-m-d',strtotime($request->date));
    	$data->amount = $request->amount;
    	 if ($request->file('image')) {
    		$file = $request->file('image');
    		@unlink(public_path('upload/cost_images/'.$data->image));
    		$filename = date('YmdHi').$file->getClientOriginalName();
    		$file->move(public_path('upload/cost_images'), $filename);
    		$data['image'] = $filename;
	    }
	    $data->description = $request->description;
	    $data->save();
	    return redirect()->route('accounts.cost.view')->with('success_message','Data updated successfully');
    }
}
