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
use App\User;
use Session;
use DB;
use PDF;

class StudentRegController extends Controller
{
    public function view()
    {
    	Session::put('page', 'students_reg');
    	$years = Year::orderBy('id','desc')->get();
    	$year_id = Year::orderBy('id','desc')->first()->id;
    	$classes = StudentClass::all();
    	$class_id = StudentClass::orderBy('id','asc')->first()->id;
    	$alldata = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();
    	return view('backend.student.student_reg.view-student')->with(compact('alldata','years','classes','year_id','class_id'));
    }
    public function yearClassWise(Request $request)
    {
    	Session::put('page', 'students_reg');
    	$years = Year::orderBy('id','desc')->get();
    	$year_id = $request->year_id;
    	$classes = StudentClass::all();
    	$class_id = $request->class_id;
    	$alldata = AssignStudent::where('year_id',$year_id)->where('class_id',$class_id)->get();
    	return view('backend.student.student_reg.view-student')->with(compact('alldata','years','classes','year_id','class_id'));
    }
    public function add()
    {
    	$years = Year::orderBy('id','desc')->get();
    	$shifts = StudentShift::all();
    	$classes = StudentClass::all();
    	$groups = StudentGroup::all();
    	return view('backend.student.student_reg.add-student')->with(compact('years','shifts','classes','groups'));
    }
    public function store(Request $request)
    {
    	DB::transaction(function() use($request){
           $checkYear = Year::find($request->year_id)->name;
           $student = User::where('usertype','student')->orderBy('id','desc')->first();
           if ($student==null) {
           	  $first_reg = 0;
           	  $studentId = $first_reg + 1;
           	  if ($studentId < 10) {
           	  	$id_no = '000'.$studentId;
           	  }
           	  elseif ($studentId < 100) {
           	  	$id_no = '00'.$studentId;
           	  }
           	  elseif ($studentId < 1000) {
           	  	$id_no = '0'.$studentId;
           	  }
           }
           else {
           	  $student = User::where('usertype','student')->orderBy('id','desc')->first()->id;
           	  $studentId = $student + 1;
           	  if ($studentId < 10) {
           	  	$id_no = '000'.$studentId;
           	  }
           	  elseif ($studentId < 100) {
           	  	$id_no = '00'.$studentId;
           	  }
           	  elseif ($studentId < 1000) {
           	  	$id_no = '0'.$studentId;
           	  }
           }
           $final_id_no = $checkYear.$id_no;
           $user = new User();
           $code = rand(0000,9999);

           $user->id_no = $final_id_no;
           $user->name = $request->name;
           $user->code = $code;
           $user->password = bcrypt($code);
           $user->usertype = 'student';
           $user->fname = $request->fname;
           $user->mname = $request->mname;
           $user->mobile = $request->mobile;
           $user->address = $request->address;
           $user->gender = $request->gender;
           $user->religion = $request->religion;
           $user->dob = date('Y-m-d',strtotime($request->dob));
           if ($request->file('image')) {
  	    		$file = $request->file('image');
  	    		//@unlink(public_path('upload/user_images/'.$data->image));
  	    		$filename = date('YmdHi').$file->getClientOriginalName();
  	    		$file->move(public_path('upload/student_images/'), $filename);
  	    		$user['image'] = $filename;
      	    }
           $user->save();

           $assign_student = new AssignStudent();
           $assign_student->student_id = $user->id;
           $assign_student->class_id = $request->class_id;
           $assign_student->year_id = $request->year_id;
           $assign_student->group_id = $request->group_id;
           $assign_student->shift_id = $request->shift_id;
           $assign_student->save();

           $dicount_student = new DiscountStudent();
           $dicount_student->assign_student_id = $assign_student->id;
           $dicount_student->fee_category_id = '1';
           $dicount_student->discount = $request->discount;
           $dicount_student->save();
    	});
    	return redirect()->route('students.reg.view')->with('success_message','Data inserted successfully');
    }
    public function edit($student_id)
    {
    	$editdata = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
    	//dd($editdata->toArray());
    	$years = Year::orderBy('id','desc')->get();
    	$shifts = StudentShift::all();
    	$classes = StudentClass::all();
    	$groups = StudentGroup::all();
    	return view('backend.student.student_reg.add-student')->with(compact('editdata','years','shifts','classes','groups'));
    }
    public function update(Request $request,$student_id)
    {
    	DB::transaction(function() use($request,$student_id){
           
           $user = User::where('id',$student_id)->first();
           $user->name = $request->name;
           $user->fname = $request->fname;
           $user->mname = $request->mname;
           $user->mobile = $request->mobile;
           $user->address = $request->address;
           $user->gender = $request->gender;
           $user->religion = $request->religion;
           $user->dob = date('Y-m-d',strtotime($request->dob));
           if ($request->file('image')) {
  	    		$file = $request->file('image');
  	    		@unlink(public_path('upload/student_images/'.$user->image));
  	    		$filename = date('YmdHi').$file->getClientOriginalName();
  	    		$file->move(public_path('upload/student_images/'), $filename);
  	    		$user['image'] = $filename;
    	    }
           $user->save();

           $assign_student = AssignStudent::where('id',$request->id)->where('student_id',$student_id)->first();
           $assign_student->year_id = $request->year_id;
           $assign_student->class_id = $request->class_id;
           $assign_student->group_id = $request->group_id;
           $assign_student->shift_id = $request->shift_id;
           $assign_student->save();

           $dicount_student = DiscountStudent::where('assign_student_id',$request->id)->first();
           $dicount_student->discount = $request->discount;
           $dicount_student->save();
    	});
    	return redirect()->route('students.reg.view')->with('success_message','Data updated successfully');
    }
    public function promotion($student_id)
    {
    	$editdata = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
    	//dd($editdata->toArray());
    	$years = Year::orderBy('id','desc')->get();
    	$shifts = StudentShift::all();
    	$classes = StudentClass::all();
    	$groups = StudentGroup::all();
    	return view('backend.student.student_reg.promotion-student')->with(compact('editdata','years','shifts','classes','groups'));
    }
    public function promotionStore(Request $request,$student_id)
    {
    	DB::transaction(function() use($request,$student_id){
           
           $user = User::where('id',$student_id)->first();
           $user->name = $request->name;
           $user->fname = $request->fname;
           $user->mname = $request->mname;
           $user->mobile = $request->mobile;
           $user->address = $request->address;
           $user->gender = $request->gender;
           $user->religion = $request->religion;
           $user->dob = date('Y-m-d',strtotime($request->dob));
           if ($request->file('image')) {
	    		$file = $request->file('image');
	    		@unlink(public_path('upload/student_images/'.$user->image));
	    		$filename = date('YmdHi').$file->getClientOriginalName();
	    		$file->move(public_path('upload/student_images/'), $filename);
	    		$user['image'] = $filename;
    	    }
           $user->save();

           $assign_student = new AssignStudent();
           $assign_student->student_id = $student_id;
           $assign_student->year_id = $request->year_id;
           $assign_student->class_id = $request->class_id;
           $assign_student->group_id = $request->group_id;
           $assign_student->shift_id = $request->shift_id;
           $assign_student->save();

           $dicount_student = new DiscountStudent();
           $dicount_student->assign_student_id = $assign_student->id;
           $dicount_student->fee_category_id = '1';
           $dicount_student->discount = $request->discount;
           $dicount_student->save();
    	});
    	return redirect()->route('students.reg.view')->with('success_message','Student promotion successfully');
    }
    public function details($student_id)
    {
    	$data['details'] = AssignStudent::with(['student','discount'])->where('student_id',$student_id)->first();
    	$pdf = PDF::loadView('backend.student.student_reg.student-details-pdf', $data);
		  $pdf->SetProtection(['copy', 'print'], '', 'pass');
		  return $pdf->stream('document.pdf');
    }
	
}
