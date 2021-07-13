<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AssignSubject;
use App\Model\AssignStudent;

class DefaultController extends Controller
{
    public function getStudent(Request $request)
    {
    	$year_id = $request->year_id;
    	$class_id = $request->class_id;
    	$alldata = AssignStudent::with(['student'])->where('year_id',$year_id)->where('class_id',$class_id)->get();
    	return response()->json($alldata);
    }
    public function getSubject(Request $request)
    {
    	$class_id = $request->class_id;
    	$alldata = AssignSubject::with(['subject'])->where('class_id',$class_id)->get();
    	return response()->json($alldata);
    }
}
