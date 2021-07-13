 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Employee Salary Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee Salary</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <section class="col-lg-12">

            <div class="card">
              <div class="card-header">
                <h3>
                  Employee Salary Details Info
                  <a href="{{ route('employees.salary.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Employee List</a>
                </h3>
              </div>
              <div class="card-body">
              	<strong>Employee Name : </strong>{{$details->name}} &nbsp;&nbsp;<strong>Employee ID : </strong>{{$details->id_no}}
                 <table class="table table-borderd table-hover">
                 	<thead>
                 		<tr>
                 			<th>SL.</th>
                 			<th>Previous Salary</th>
                 			<th>Increment Salary</th>
                 			<th>Present Salary</th>
                 			<th>Effected Date</th>
                 		</tr>
                 	</thead>
                 	<tbody>
                 		@foreach($salarylog as $key=>$salary)
                 		<tr>
                 			@if($key==0)
             			    <td class="text-center" colspan="5"><strong>Joining Salary : </strong>{{$salary->previous_salary}}</td>
             			    @else
                 			<td>{{$key+1}}</td>
                 			<td>{{$salary->previous_salary}}</td>
                 			<td>{{$salary->increment_salary}}</td>
                 			<td>{{$salary->present_salary}}</td>
                 			<td>{{date('d-m-Y',strtotime($salary->effected_date))}}</td>
                 			@endif
                 		</tr>
                 		@endforeach
                 	</tbody>
                 </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
@endsection