<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Employee Monthly Salary</title>
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
		@php
            $date = date('Y-m',strtotime($totalattendgroupbyid['0']->date));
	    	if ($date != '') {
	    		$where[] = ['date','like',$date.'%'];
	    	}
	    	$totalattend = App\Model\EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$totalattendgroupbyid['0']->employee_id)->get();
            $absentcount = count($totalattend->where('attend_status','Absent'));
	    	$salary = (float)$totalattendgroupbyid['0']['user']['salary'];
    		$salaryperday = (float)$salary/30;
    		$totalsalaryminus = (float)$absentcount*(float)$salaryperday;
    		$totalsalary = (int)$salary - (int)$totalsalaryminus;
		@endphp
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
	   				<td class="text-center"><img src="{{ url('public/upload/employee_images/'.$totalattendgroupbyid['0']['user']['image'])}}" alt="" style="height:70px; width:70px"></td>
	   			</tr>
	   		</table>
	   	</div>
	   	<div class="col-md-12 text-center">
	   		<h5 style="font-weight: bold; padding-top: -25px;">Employee Monthly Salary</h5>
	   	</div>
	   	<div class="col-md-12">
	   		
	   		<table border="1" width="100%">
	   			<tbody>
	   				<tr>
	   					<td style="width: 50%">Employee Name</td>
	   					<td>{{ $totalattendgroupbyid['0']['user']['name'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Basic Salary</td>
	   					<td>{{ $totalattendgroupbyid['0']['user']['salary'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Total absent this month</td>
	   					<td>{{ $absentcount }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Month</td>
	   					<td>{{ date('M Y',strtotime($totalattendgroupbyid['0']->date)) }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Salary for this month</td>
	   					<td>{{ $totalsalary }}</td>
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
	   <hr style="border:dashed 1px;width:96%;color:#DDD;margin-bottom:50px;">
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
	   				<td class="text-center"><img src="{{ url('public/upload/employee_images/'.$totalattendgroupbyid['0']['user']['image'])}}" alt="" style="height:70px; width:70px"></td>
	   			</tr>
	   		</table>
	   	</div>
	   	<div class="col-md-12 text-center">
	   		<h5 style="font-weight: bold; padding-top: -25px;">Employee Monthly Salary</h5>
	   	</div>
	   	<div class="col-md-12">
	   		
	   		<table border="1" width="100%">
	   			<tbody>
	   				<tr>
	   					<td style="width: 50%">Employee Name</td>
	   					<td>{{ $totalattendgroupbyid['0']['user']['name'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Basic Salary</td>
	   					<td>{{ $totalattendgroupbyid['0']['user']['salary'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Total absent this month</td>
	   					<td>{{ $absentcount }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Month</td>
	   					<td>{{ date('M Y',strtotime($totalattendgroupbyid['0']->date)) }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Salary for this month</td>
	   					<td>{{ $totalsalary }}</td>
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