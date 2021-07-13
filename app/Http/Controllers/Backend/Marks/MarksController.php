<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShift;
use App\Model\Year;
use App\Model\ExamType;
use App\Model\StudentMark;
use Session;

class MarksController extends Controller
{
    public function add()
    {
    	Session::put('page', 'marks_entry');
    	$years = Year::orderBy('id','desc')->get();
    	$classes = StudentClass::all();
    	$exam_types = ExamType::all();
    	return view('backend.marks.add-marks')->with(compact('years','classes','exam_types'));
    }
    public function store(Request $request)
    {
    	
    	if ($request->student_id !=null) {
    		for ($i = 0; $i < count($request->student_id); $i++) {
    			$data = new StudentMark();
    			$data->year_id = $request->year_id;
    	        $data->class_id = $request->class_id;
    	        $data->assign_subject_id = $request->assign_subject_id;
    	        $data->exam_type_id = $request->exam_type_id;
    	        $data->student_id = $request->student_id[$i];
    	        $data->id_no = $request->id_no[$i];
    	        $data->marks = $request->marks[$i];
    	        $data->save();
    		}
    	}
    	else{
    		return redirect()->back()->with('error_message','Sorry! There are no Students');
    	}
    	return redirect()->back()->with('success_message','Well done ! Successfully marks inserted');
    }
    public function edit()
    {
    	Session::put('page', 'marks_edit');
    	$years = Year::orderBy('id','desc')->get();
    	$classes = StudentClass::all();
    	$exam_types = ExamType::all();
    	return view('backend.marks.edit-marks')->with(compact('years','classes','exam_types'));
    }
    public function getMarks(Request $request)
    {
    	$year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;
        $getstudent = StudentMark::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->where('assign_subject_id',$assign_subject_id)->where('exam_type_id',$exam_type_id)->get();
        return response()->json($getstudent);
    }
    public function update(Request $request)
    {
    	StudentMark::where('year_id',$request->year_id)->where('class_id',$request->class_id)->where('assign_subject_id',$request->assign_subject_id)->where('exam_type_id',$request->exam_type_id)->delete();
    	if ($request->student_id !=null) {
    		for ($i = 0; $i < count($request->student_id); $i++) {
    			$data = new StudentMark();
    			$data->year_id = $request->year_id;
    	        $data->class_id = $request->class_id;
    	        $data->assign_subject_id = $request->assign_subject_id;
    	        $data->exam_type_id = $request->exam_type_id;
    	        $data->student_id = $request->student_id[$i];
    	        $data->id_no = $request->id_no[$i];
    	        $data->marks = $request->marks[$i];
    	        $data->save();
    		}
    	}
    	else{
    		return redirect()->back()->with('error_message','Sorry! There are no Students');
    	}
    	return redirect()->back()->with('success_message','Well done ! Successfully marks updated');
    }
}
