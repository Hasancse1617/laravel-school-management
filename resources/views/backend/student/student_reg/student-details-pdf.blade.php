<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Student Details Info</title>
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
	   				<td class="text-center"><img src="{{ url('public/upload/student_images/'.$details['student']['image'])}}" alt="" width="100px" height="100px"></td>
	   			</tr>
	   		</table>
	   	</div>
	   	<div class="col-md-12 text-center">
	   		<h5 style="font-weight: bold; padding-top: -25px;">Student Registration Card</h5>
	   	</div>
	   	<div class="col-md-12" style="padding: 0 20px;">
	   		<table border="1" width="100%">
	   			<tbody>
	   				<tr>
	   					<td style="width: 50%">Student Name</td>
	   					<td>{{ $details['student']['name'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Father's Name</td>
	   					<td>{{ $details['student']['fname'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Mother's Name</td>
	   					<td>{{ $details['student']['mname'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Year</td>
	   					<td>{{ $details['year']['name'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Class</td>
	   					<td>{{ $details['student_class']['name'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">ID No</td>
	   					<td>{{ $details['student']['id_no'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Roll No</td>
	   					<td>{{ $details->roll }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Mobile No</td>
	   					<td>{{ $details['student']['mobile'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Address</td>
	   					<td>{{ $details['student']['address'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Gender</td>
	   					<td>{{ $details['student']['gender'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Religion</td>
	   					<td>{{ $details['student']['religion'] }}</td>
	   				</tr>
	   				<tr>
	   					<td style="width: 50%">Birth Date</td>
	   					<td>{{ $details['student']['dob'] }}</td>
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