<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\Year;
use App\Model\FeeCategoryAmount;
use App\Model\ExamType;
use App\User;
use Session;
use DB;
use PDF;

class ExamFeeController extends Controller
{
    public function view()
    {
    	Session::put('page', 'exam_fee');
    	$years = Year::orderBy('id','desc')->get();
    	$classes = StudentClass::all();
    	$exams = ExamType::all();
    	return view('backend.student.exam_fee.view-exam-fee')->with(compact('years','classes','exams'));
    }
    public function getStudent(Request $request)
    {
    	$year_id = $request->year_id;
    	$class_id = $request->class_id;
    	if ($year_id!='') {
    		$where[] = ['year_id','like',$year_id.'%'];
    	}
    	if ($class_id!='') {
    		$where[] = ['class_id','like',$class_id.'%'];
    	}
    	$allstudent = AssignStudent::with(['discount'])->where($where)->get();

    	$html['thsource'] = '<th>SL</th>';
    	$html['thsource'] .= '<th>ID</th>';
    	$html['thsource'] .= '<th>Student Name</th>';
    	$html['thsource'] .= '<th>Roll No</th>';
    	$html['thsource'] .= '<th>Exam Fee</th>';
    	$html['thsource'] .= '<th>Discount Amount</th>';
    	$html['thsource'] .= '<th>Fee</th>';
    	$html['thsource'] .= '<th>Action</th>';

    	foreach ($allstudent as $key => $v) {
    		$registrationfee = FeeCategoryAmount::where('fee_category_id','3')->where('class_id',$v->class_id)->first();
    		$color = 'success';
    		$html[$key]['tdsource'] ='<td>'.($key+1).'</td>';
    		$html[$key]['tdsource'] .='<td>'.$v['student']['id_no'].'</td>';
    		$html[$key]['tdsource'] .='<td>'.$v['student']['name'].'</td>';
    		$html[$key]['tdsource'] .='<td>'.$v->roll.'</td>';
    		$html[$key]['tdsource'] .='<td>'.$registrationfee->amount.'TK'.'</td>';
    		$html[$key]['tdsource'] .='<td>'.$v['discount']['discount'].'%'.'</td>';

    		$orginalfee = $registrationfee->amount;
    		$discount = $v['discount']['discount'];
    		$discounttablefee = $discount/100*$orginalfee;
    		$finalfee = (float)$orginalfee - (float)$discounttablefee;
    		$html[$key]['tdsource'] .='<td>'.$finalfee.'TK'.'</td>';
    		$html[$key]['tdsource'] .='<td>';
    		$html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" href="'.route("students.exam.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'&exam_type_id='.$request->exam_type_id.'">Fee Slip</a>';
    	    $html[$key]['tdsource'] .='</td>';

    	}
    	return response()->json(@$html);   
    }
    public function payslip(Request $request)
    {
    	$student_id = $request->student_id;
    	$class_id = $request->class_id;
    	$data['exam_name'] = ExamType::where('id',$request->exam_type_id)->first()['name'];
    	$data['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->where('class_id',$class_id)->first();
    	$pdf = PDF::loadView('backend.student.exam_fee.exam-fee-pdf', $data);
		$pdf->SetProtection(['copy', 'print'], '', 'pass');
		return $pdf->stream('document.pdf');
    }
}
