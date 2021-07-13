<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\FeeCategory;
use App\Model\FeeCategoryAmount;
use Session;

class FeeAmountController extends Controller
{
    public function view()
    {
    	Session::put('page', 'fee_amount');
    	$alldata = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
    	
    	return view('backend.setup.fee_amount.view-fee-amount')->with(compact('alldata'));
    }
    public function add()
    {
    	$fee_categories = FeeCategory::all();
    	$classes = StudentClass::all();
    	return view('backend.setup.fee_amount.add-fee-amount')->with(compact('fee_categories','classes'));
    }
    public function store(Request $request)
    {
        $countClass = count($request->class_id);
        if ($countClass !=NULL) {
        	for($i=0; $i< $countClass; $i++){
        		$fee_amount = new FeeCategoryAmount;
        		$fee_amount->fee_category_id = $request->fee_category_id;
        		$fee_amount->class_id = $request->class_id[$i];
        		$fee_amount->amount = $request->amount[$i];
        		$fee_amount->save();
        	}
        }
    	$message = 'Data created successfully';
    	return redirect()->route('setups.fee.amount.view')->with('success_message',$message);
    }
    public function edit($fee_category_id)
    {
    	$fee_categories = FeeCategory::all();
    	$classes = StudentClass::all();
    	$editdata = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
    	//dd($editdata->toArray());
    	return view('backend.setup.fee_amount.edit-fee-amount')->with(compact('fee_categories','classes','editdata'));
    }
    public function update(Request $request,$fee_category_id)
    {
    	if ($request->class_id == NULL) {
    		return redirect()->back()->with('error_message','Sorry! you do not select any item');
    	}
    	else {
    		$editdata = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->delete();
    		$countClass = count($request->class_id);
        	for($i=0; $i< $countClass; $i++){
        		$fee_amount = new FeeCategoryAmount;
        		$fee_amount->fee_category_id = $request->fee_category_id;
        		$fee_amount->class_id = $request->class_id[$i];
        		$fee_amount->amount = $request->amount[$i];
        		$fee_amount->save();
        	}
    	}
    	$message = 'Data updated successfully';
    	return redirect()->route('setups.fee.amount.view')->with('success_message',$message);
    }
    public function delete(Request $request)
    {
    	$data = FeeCategory::find($request->id);
    	$data->delete();
    	$message = 'Data deleted successfully';
    	return redirect()->route('setups.fee.category.view')->with('success_message',$message);
    }
    public function details($fee_category_id)
    {
    	$detaildata = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id','asc')->get();
    	//dd($detaildata->toArray());
    	return view('backend.setup.fee_amount.details-fee-amount')->with(compact('detaildata'));
    }
}
