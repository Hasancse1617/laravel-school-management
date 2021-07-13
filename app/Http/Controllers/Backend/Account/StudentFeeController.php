<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountStudentFee;
use App\Model\Year;
use App\Model\StudentClass;
use App\Model\FeeCategory;
use App\Model\AssignStudent;
use App\Model\FeeCategoryAmount;
use Session;

class StudentFeeController extends Controller
{
    public function  view()
    {
    	Session::put('page', 'student_fee');
    	$alldata = AccountStudentFee::all();
    	return view('backend.account.student.view-fee')->with(compact('alldata'));
    }
    public function add()
    {
    	$years = Year::orderBy('id','desc')->get();
    	$classes = StudentClass::all();
    	$fee_categories = FeeCategory::all();
    	return view('backend.account.student.add-fee')->with(compact('years','classes','fee_categories'));
    }
    public function getStudent(Request $request)
    {
    	$year_id = $request->year_id;
    	$class_id = $request->class_id;
    	$fee_category_id = $request->fee_category_id;
    	$date = date('Y-m',strtotime($request->date));
    	$data = AssignStudent::with(['discount'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
    	$html['thsource'] = '<th>ID No</th>';
    	$html['thsource'] .= '<th>Student Name</th>';
    	$html['thsource'] .= '<th>Father Name</th>';
    	$html['thsource'] .= '<th>Orginal Name</th>';
    	$html['thsource'] .= '<th>Discount Amount</th>';
    	$html['thsource'] .= '<th>Fee (this student)</th>';
    	$html['thsource'] .= '<th>Select</th>';
    	foreach ($data as $key=> $value) {
    		$registrationfee = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->where('class_id',$value->class_id)->first();
    		$accountstudentFee = AccountStudentFee::where('student_id',$value->student_id)->where('year_id',$value->year_id)->where('class_id',$value->class_id)->where('fee_category_id',$fee_category_id)->where('date',$date)->first();
    		//dd($accountstudentFee);
    		if ($accountstudentFee !=null) {
    			$checked = 'checked';
    		}
    		else{
    			$checked = '';
    		}
    		$color = 'success';
    		$html[$key]['tdsource'] = '<td>'.$value['student']['id_no'].'<input type="hidden" name="fee_category_id" value="'.$fee_category_id.'">'.'</td>';
    		$html[$key]['tdsource'] .= '<td>'.$value['student']['name'].'<input type="hidden" name="year_id" value="'.$value->year_id.'">'.'</td>';
    		$html[$key]['tdsource'] .= '<td>'.$value['student']['fname'].'<input type="hidden" name="class_id" value="'.$value->class_id.'">'.'</td>';
    		$html[$key]['tdsource'] .= '<td>'.$registrationfee->amount.'TK'.'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
    		$html[$key]['tdsource'] .= '<td>'.$value['discount']['discount'].'%'.'</td>';
    		$orginalfee = $registrationfee->amount;
    		$discount = $value['discount']['discount'];
    		$discounttablefee = $discount/100*$orginalfee;
    		$finalfee = (int)$orginalfee - (int)$discounttablefee;
    		$html[$key]['tdsource'] .= '<td>'.'<input type="text" name="amount[]" value="'.$finalfee.'" class="form-control" readonly>'.'</td>';
    		$html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="student_id[]" value="'.$value->student_id.'">'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.' style="transform:scale(1.5);margin-left:10px;">'.'</td>';
    	}
    	return response()->json(@$html);
    }
    public function store(Request $request)
    {
    	$date = date('Y-m',strtotime($request->date));
    	AccountStudentFee::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('fee_category_id',$request->fee_category_id)->where('date',$date)->delete();
    	$checkdata = $request->checkmanage;
    	if ($checkdata !=null) {
    		for ($i = 0; $i < count($checkdata); $i++) {
    			$data = new AccountStudentFee();
    			$data->year_id = $request->year_id;
    			$data->class_id = $request->class_id;
    			$data->date = $date;
    			$data->fee_category_id = $request->fee_category_id;
    			$data->student_id = $request->student_id[$checkdata[$i]];
    			$data->amount = $request->amount[$checkdata[$i]];
                $data->save();
    		}
    	}
    	if (!empty(@$data)||empty($checkdata)) {
    		return redirect()->route('accounts.fee.view')->with('success_message','Well done! Successfully updated');
    	}
    	else{
    		return redirect()->back()->with('error_message','Sorry! Data not saved');
    	}
    }
}
