<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use App\Model\Subject;
use App\Model\AssignSubject;
use Session;

class AssignSubjectController extends Controller
{
    public function view()
    {
    	Session::put('page', 'assign_subject');
    	$alldata = AssignSubject::select('class_id')->groupBy('class_id')->get();
    	
    	return view('backend.setup.assign_subject.view-assign-subject')->with(compact('alldata'));
    }
    public function add()
    {
    	$subjects = Subject::all();
    	$classes = StudentClass::all();
    	return view('backend.setup.assign_subject.add-assign-subject')->with(compact('subjects','classes'));
    }
    public function store(Request $request)
    {
        $countsubject = count($request->subject_id);
        if ($countsubject !=NULL) {
        	for($i=0; $i< $countsubject; $i++){
        		$assign_sub = new AssignSubject;
        		$assign_sub->class_id = $request->class_id;
        		$assign_sub->subject_id = $request->subject_id[$i];
        		$assign_sub->full_mark = $request->full_mark[$i];
        		$assign_sub->pass_mark = $request->pass_mark[$i];
        		$assign_sub->subjective_mark = $request->subjective_mark[$i];
        		$assign_sub->save();
        	}
        }
    	$message = 'Data created successfully';
    	return redirect()->route('setups.assign.subject.view')->with('success_message',$message);
    }
    public function edit($class_id)
    {
    	$subjects = Subject::all();
    	$classes = StudentClass::all();
    	$editdata = AssignSubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();
    	//dd($editdata->toArray());
    	return view('backend.setup.assign_subject.edit-assign-subject')->with(compact('subjects','classes','editdata'));
    }
    public function update(Request $request, $class_id)
    {
    	if ($request->subject_id == NULL) {
    		return redirect()->back()->with('error_message','Sorry! you do not select any item');
    	}
    	else {
    		AssignSubject::whereNotIn('subject_id',$request->subject_id)->where('class_id',$request->class_id)->delete();
        	foreach($request->subject_id as $key => $value){
        		$assign_subject_exist = AssignSubject::where('subject_id',$request->subject_id[$key])->where('class_id',$request->class_id)->first();
                if ($assign_subject_exist) {
                    $assign_sub = $assign_subject_exist;
                }
                else {
                    $assign_sub = new AssignSubject();
                }
        		$assign_sub->class_id = $request->class_id;
        		$assign_sub->subject_id = $request->subject_id[$key];
        		$assign_sub->full_mark = $request->full_mark[$key];
        		$assign_sub->pass_mark = $request->pass_mark[$key];
        		$assign_sub->subjective_mark = $request->subjective_mark[$key];
        		$assign_sub->save();
        	}
    	}
    	$message = 'Data updated successfully';
    	return redirect()->route('setups.assign.subject.view')->with('success_message',$message);
    }
    public function delete(Request $request)
    {
    	$data = AssignSubject::find($request->id);
    	$data->delete();
    	$message = 'Data deleted successfully';
    	return redirect()->route('setups.assign.subject.view')->with('success_message',$message);
    }
    public function details($class_id)
    {
    	$detaildata = AssignSubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();
    	//dd($detaildata->toArray());
    	return view('backend.setup.assign_subject.details-assign-subject')->with(compact('detaildata'));
    }
}
