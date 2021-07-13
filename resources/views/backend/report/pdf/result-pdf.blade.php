<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Student Result</title>
	<link rel="stylesheet" href="{{ asset('public/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	<style>
		table{
			border-collapse: collapse;
		}
		h2 h3{
			margin: 0;
			padding: 0;
		}
		.table{
			width: 100%;
			margin-bottom: 1rem;
			background-color: transparent;
		}
		.table th,.table td{
			vertical-align: top;
			padding: 0.75rem;
			border-top: 1px solid #dee2e6;
		}
		.table thead th{
			vertical-align: bottom;
			border-bottom: 2px solid #dee2e6;
		}
		.table tbody + tbody{
			border-top: 2px solid #dee2e6;
		}
		.table .table{
			background-color: #fff;
		}
		.table-bordered{
			border: 1px solid #dee2e6;
		}
		.table-bordered th,
		.table-bordered td {
            border: 1px solid #dee2e6;
		}
		.table-bordered thead th,
		.table-bordered thead td {
            border-bottom-width: 2px;
		}
		.text-center{
			text-align: center;
		}
		.text-right{
			text-align: right;
		}
		table tr td{
			padding: 5px;
		}
		.table-bordered thead th,.table-bordered td,.table-bordered th{
			border: 1px solid black !important;
		}
		.table-bordered thead th{
			background-color: #cacaca;
		}

	</style>
</head>
<body>
	<div class="container">
	   <div class="row">
	   	<div class="col-md-12">
	   		<table width="80%">
	   			<tr>
	   				<td width="33%" class="text-center"><img src="{{ url('public/upload/school.jpg') }}" alt="" style="height:70px; width:70px"></td>
	   				<td width="63%" class="text-center">
	   					<h4><strong>Bansherbada ML High School</strong></h4>
	   					<h5><stong>Pabna Gorgory</stong></h5>
	   					<h6><stong>www.abcschool.com</stong></h6>
	   				</td>
	   				<td class="text-center"></td>
	   			</tr>
	   		</table>
	   	</div>
	   	<div class="col-md-12 text-center">
	   		<h5 style="font-weight: bold; padding-top: -25px;">Results of {{@$alldata['0']['exam_type']['name']}}</h5>
	   	</div>
	   	<div class="col-md-12">
	   		<hr style="border:solid 1px;width:100%;color:#DDD;margin-bottom:0px;">
	   		<table border="0" width="100%" cellpadding="1" cellspacing="2" class="text-center">
	   			<tbody>
	   				<tr>
	   					<td><strong>Year/Session : </strong> {{@$alldata['0']['year']['name']}}</td>
	   					<td></td>
	   					<td></td>
	   					<td><strong>Class : </strong> {{@$alldata['0']['student_class']['name']}}</td>
	   				</tr>
	   			</tbody>
	   		</table>
	   	</div><br>
	   	<div class="col-md-12">
	   		<table border="1" width="100%">
	   			<thead>
	   				<tr>
	   					<th width="5%">S/L</th>
	   					<th>Student Name</th>
	   					<th>ID NO</th>
	   					<th width="10%">Letter Grade</th>
	   					<th width="10%">Grade Point</th>
	   					<th width="15%">Remarks</th>
	   				</tr>
	   			</thead>
	   			<tbody>
	   				@foreach($alldata as $key => $value)
	   				@php
	   				  $allmarks = App\Model\StudentMark::where('year_id',$value->year_id)->where('class_id',$value->class_id)->where('exam_type_id',$value->exam_type_id)->where('student_id',$value->student_id)->get();
	   				  $total_marks = 0;
	   				  $total_point = 0;
	   				  foreach($allmarks as $mark){
                        $count_fail = App\Model\StudentMark::where('year_id',$mark->year_id)->where('class_id',$mark->class_id)->where('exam_type_id',$mark->exam_type_id)->where('student_id',$mark->student_id)->where('marks','<','33')->get()->count();
                        $get_mark = $mark->marks;
                        $grade_marks = App\Model\MarksGrade::where([['start_marks','<=',(int)$get_mark],['end_marks','>=',(int)$get_mark]])->first();
                        $grade_name = $grade_marks->grade_name;
                        $grade_point = number_format((float)$grade_marks->grade_point,2);
                        $total_point = (float)$total_point+(float)$grade_point;
	   				  }

	   				@endphp
	   				<tr>
	   					<td>{{$key+1}}</td>
	   					<td>{{$value['student']['name']}}</td>
	   					<td>{{$value['student']['id_no']}}</td>
	   					@php
                           $total_subject = App\Model\StudentMark::where('year_id',$value->year_id)->where('class_id',$value->class_id)->where('exam_type_id',$value->exam_type_id)->where('student_id',$value->student_id)->get()->count();
                           $total_grade = 0;
                           $point_for_letter_grade = (float)$total_point/(float)$total_subject;
                           $total_grade = App\Model\MarksGrade::where([['start_point','<=',$point_for_letter_grade],['end_point','>=',$point_for_letter_grade]])->first();
                           $grade_point_average = (float)$total_point/(float)$total_subject;
                          @endphp
	   					<td>
	   						@if($count_fail>0)
	   						F
	   						@else
	   						{{$total_grade->grade_name}}
	   						@endif
	   					</td>
	   					<td>
	   						@if($count_fail>0)
	   						0.00
	   						@else
	   						{{number_format((float)$grade_point_average,2)}}
	   						@endif
	   					</td>
	   					<td>
	   						@if($count_fail>0)
	   						Fail
	   						@else
	   						{{$total_grade->remarks}}
	   						@endif
	   					</td>
	   				</tr>
	   				@endforeach
	   				<tr>
	   					<td colspan="2">
	   						
	   					</td>
	   				</tr>
	   			</tbody>
	   		</table>
	   		<i style="font-size: 10px;">Print Date: {{ date('d m Y') }}</i>
	   	</div><br>
	   	<div class="col-md-12">
	   		<table border="0" width="100%">
	   			<tbody>
	   				<tr>
	   					<td style="width: 30%"></td>
	   					<td style="width: 30%"></td>
	   					<td style="width: 40%;text-align: center;">
	   						<hr style="border: 1px solid;width: 60%;color: #000;margin-bottom: 0px;">
	   						<p style="text-align: center;">Principal/HeadMaster</p>
	   					</td>
	   				</tr>
	   			</tbody>
	   		</table>
	   	</div>
	   </div>
	</div>
</body>
</html>