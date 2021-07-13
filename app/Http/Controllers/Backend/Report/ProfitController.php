<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountEmployeeSalary;
use App\Model\AccountStudentFee;
use App\Model\AccountOtherCost;
use App\Model\StudentMark;
use App\Model\ExamType;
use App\Model\StudentClass;
use App\Model\Year;
use App\Model\MarksGrade;
use App\User;
use App\Model\EmployeeAttendance;
use App\Model\AssignStudent;
use Session;
use PDF;

class ProfitController extends Controller
{
    public function view()
    {
    	Session::put('page', 'month_profit');
    	return view('backend.report.view-profit');
    }
    public function profit(Request $request)
    {
    	$start_date = date('Y-m',strtotime($request->start_date));
    	$end_date = date('Y-m',strtotime($request->end_date));
    	$sdate = date('Y-m-d',strtotime($request->start_date));
    	$edate = date('Y-m-d',strtotime($request->end_date));
    	$student_fee = AccountStudentFee::whereBetween('date',[$start_date, $end_date])->sum('amount');
    	$other_cost = AccountOtherCost::whereBetween('date',[$sdate, $edate])->sum('amount');
    	$emp_salary = AccountEmployeeSalary::whereBetween('date',[$start_date, $end_date])->sum('amount');
        $total_cost = $emp_salary + $other_cost;
        $profit = $student_fee - $total_cost;

        $html['thsource'] = '<th>Students Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit</th>';
        $html['thsource'] .= '<th>Action</th>';
        $color = 'success';
        $html['tdsource'] = '<td>'.round($student_fee, 2).'</td>';
        $html['tdsource'] .= '<td>'.round($other_cost, 2).'</td>';
        $html['tdsource'] .= '<td>'.round($emp_salary, 2).'</td>';
        $html['tdsource'] .= '<td>'.round($total_cost, 2).'</td>';
        $html['tdsource'] .= '<td>'.round($profit, 2).'</td>';
        $html['tdsource'] .= '<td>';
        $html['tdsource'] .= '<a href="'.route("reports.profit.pdf").'?start_date='.$sdate.'&end_date='.$edate.'" class="btn btn-sm btn-'.$color.'" title="PDF" target="_blank"><i class="fa fa-file"></i></a>';
        $html['tdsource'] .= '</td>';
        return response()->json(@$html);
    }
    public function pdf(Request $request)
    {
    	$data['start_date'] = date('Y-m',strtotime($request->start_date));
    	$data['end_date'] = date('Y-m',strtotime($request->end_date));
    	$data['sdate'] = date('Y-m-d',strtotime($request->start_date));
    	$data['edate'] = date('Y-m-d',strtotime($request->end_date));
    	$pdf = PDF::loadView('backend.report.pdf.monthly-profit-pdf', $data);
		$pdf->SetProtection(['copy', 'print'], '', 'pass');
		return $pdf->stream('document.pdf');
    }
    public function marksheetView()
    {
        Session::put('page', 'marksheet');
        $years = Year::orderBy('id','desc')->get();
        $classes = StudentClass::all();
        $exam_types = ExamType::all();
        return view('backend.report.view-marksheet')->with(compact('years','classes','exam_types'));
    }
    public function marksheetGet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;
        $count_fail = StudentMark::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->where('marks','<','33')->get()->count();

        $singleStudent = StudentMark::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->first();
        if ($singleStudent==true) {
            $allmarks = StudentMark::with(['assign_subject','year'])->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->where('id_no',$id_no)->get();
            $allgrades = MarksGrade::all();
            return view('backend.report.pdf.marksheet-pdf')->with(compact('allmarks','allgrades','count_fail'));
        }
        else{
            return redirect()->back()->with('error_message','This Criteria does not match');
        }
    }
    public function attendanceView()
    {
        Session::put('page', 'attendance');
        $employees = User::where('usertype','employee')->get();
        return view('backend.report.view-attendance')->with(compact('employees'));
    }
    public function attendanceGet(Request $request)
    {
        $employee_id = $request->employee_id;
        if ($employee_id != '') {
            $where[] = ['employee_id',$employee_id];
        }
        $date = date('Y-m',strtotime($request->date));
        if ($date != '') {
            $where[] = ['date','like',$date.'%'];
        }
        $singleattendance = EmployeeAttendance::with(['user'])->where($where)->first();
        if ($singleattendance==true) {
            $data['alldata'] = EmployeeAttendance::with(['user'])->where($where)->get();
            $data['absents'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','Absent')->get()->count();
            $data['leaves'] = EmployeeAttendance::with(['user'])->where($where)->where('attend_status','Leave')->get()->count();
            $data['month'] = date('M Y',strtotime($request->date));
            $pdf = PDF::loadView('backend.report.pdf.attendance-pdf', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }
        else {
            return redirect()->back()->with('error_message','Sorry! This criteria does not match');
        }
    }
    public function resultView()
    {
        Session::put('page', 'all_result');
        $years = Year::orderBy('id','desc')->get();
        $classes = StudentClass::all();
        $exam_types = ExamType::all();
        return view('backend.report.view-result')->with(compact('years','classes','exam_types'));
    }
    public function resultGet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $singleResult = StudentMark::where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->first();
        if ($singleResult==true) {
            $data['alldata'] = StudentMark::select('year_id','class_id','exam_type_id','student_id')->where('year_id',$year_id)->where('class_id',$class_id)->where('exam_type_id',$exam_type_id)->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();
            //dd($data['alldata']->toArray());
            $pdf = PDF::loadView('backend.report.pdf.result-pdf', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }
        else{
            return redirect()->back()->with('error_message','This Criteria does not match');
        }
    }
    public function idCardView()
    {
        Session::put('page', 'id_card');
        $years = Year::orderBy('id','desc')->get();
        $classes = StudentClass::all();
        return view('backend.report.view-id-card')->with(compact('years','classes'));
    }
    public function idCardGet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $checkdata = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->first();
        if ($checkdata==true) {
            $data['alldata'] = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();
            //dd($data['alldata']->toArray());
            $pdf = PDF::loadView('backend.report.pdf.id-card-pdf', $data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }
        else{
            return redirect()->back()->with('error_message','This Criteria does not match');
        }
    }
}
