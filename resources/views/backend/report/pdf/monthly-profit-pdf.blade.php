<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Monthly/Yearly Profit</title>
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
	   				<td width="33%" class="text-center"><img src="{{ url('public/upload/school.jpg') }}" alt="" width="100px" height="100px"></td>
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
	   		<h5 style="font-weight: bold; padding-top: -25px;">Monthly/Yearly Profit</h5>
	   	</div>
	   	<div class="col-md-12" style="padding: 0 20px;">
	   		@php
	   		    $student_fee = App\Model\AccountStudentFee::whereBetween('date',[$start_date, $end_date])->sum('amount');
		    	$other_cost = App\Model\AccountOtherCost::whereBetween('date',[$sdate, $edate])->sum('amount');
		    	$emp_salary = App\Model\AccountEmployeeSalary::whereBetween('date',[$start_date, $end_date])->sum('amount');
		        $total_cost = $emp_salary + $other_cost;
		        $profit = $student_fee - $total_cost;
	   		@endphp
	   		<table border="1" width="100%">
	   			<tbody>
	   				<tr>
	   					<td colspan="2" style="text-align:center"><h4>Reporting Date: {{date('d M Y',strtotime($sdate))}} - {{date('d M Y',strtotime($edate))}}</h4></td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%"><h4>Purpose</h4></td>
	   					<td><h4>Amount</h4></td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Students Fee</td>
	   					<td>{{ round($student_fee, 2) }} TK</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Employee Salary</td>
	   					<td>{{ round($emp_salary, 2) }} TK</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Other Cost</td>
	   					<td>{{ round($other_cost, 2) }} TK</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%"><h4>Total Cost</h4></td>
	   					<td><h4>{{ round($total_cost, 2) }} TK</h4></td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%"><h4>Profit</h4></td>
	   					<td><h4>{{ round($profit, 2) }} TK</h4></td>
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