<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Student ID Card</title>
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
	@foreach($alldata as $data)
	<div class="row">
		<table border="0" style="text-align:center;width:100%;margin:0 100px;">
			<tbody>
				<tr style="background:#982827;">
					<td style="width:30%"></td>
					<td style="text-align:center;width:40%"><img src="{{url('public/upload/school.jpg')}}" width="100px" height="100px"></td>
					<td style="width:30%;color:#fff"><strong>Bansherbada ML</strong> High School</td>
				</tr>
				<tr>
					<td style="width:30%"><img src="{{(@$data['student']['image'])?url('public/upload/student_images/'.$data['student']['image']):url('public/upload/user_images/no-image.png')}}" style="width:100px;height:100px;"></td>
					<td style="width:40%;text-align:left;">
						Name : <strong style="letter-spacing:1px;">{{$data['student']['name']}}</strong><br>
						Father : <strong style="letter-spacing:1px;">{{$data['student']['fname']}}</strong><br>
						Class : <strong style="letter-spacing:1px;">{{$data['student_class']['name']}}</strong><br>
						Session : <strong style="letter-spacing:1px;">{{$data['year']['name']}}</strong><br>
						Mobile No : <strong style="letter-spacing:1px;">{{$data['student']['mobile']}}</strong>
					</td>
					<td style="width:20%; text-align:center;">
						Student ID <br><strong>{{$data['student']['id_no']}}</strong><br><br><br><br>
						<div style="">
							<hr>
						    Principal
						</div>
					</td>
				</tr>
				<tr style="background:#982827;text-align:center;">
					<td style="color:#fff;padding:10px 0px" colspan="3">Bansherbada, Ishwardi, Pabna</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div style="height:30px;"></div>
	@endforeach
</div>
</body>
</html>