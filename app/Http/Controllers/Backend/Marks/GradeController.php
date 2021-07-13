<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\MarksGrade;
use Session;

class GradeController extends Controller
{
    public function view()
    {
    	Session::put('page', 'marks_grade');
    	$alldata = MarksGrade::all();
    	return view('backend.marks.view-marks-grade')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.marks.add-marks-grade');
    }
    public function store(Request $request)
    {
    	$data = new MarksGrade();
    	$data->grade_name = $request->grade_name;
    	$data->grade_point = $request->grade_point;
    	$data->start_marks = $request->start_marks;
    	$data->end_marks = $request->end_marks;
    	$data->start_point = $request->start_point;
    	$data->end_point = $request->end_point;
    	$data->remarks = $request->remarks;
    	$data->save();
    	return redirect()->route('marks.grade.view')->with('success_message','Data added successfully');
    }
    public function edit($id)
    {
    	$editdata = MarksGrade::find($id);
    	return view('backend.marks.add-marks-grade')->with(compact('editdata'));
    }
    public function update(Request $request,$id)
    {
    	$data = MarksGrade::find($id);
    	$data->grade_name = $request->grade_name;
    	$data->grade_point = $request->grade_point;
    	$data->start_marks = $request->start_marks;
    	$data->end_marks = $request->end_marks;
    	$data->start_point = $request->start_point;
    	$data->end_point = $request->end_point;
    	$data->remarks = $request->remarks;
    	$data->save();
    	return redirect()->route('marks.grade.view')->with('success_message','Data updated successfully');
    }
}
