 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ Session::get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             @endif
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>
                  Student List
                  <a href="{{ route('students.reg.add') }}" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i>&nbsp;Add Student</a>
                </h3>
              </div>
              <div class="card-body">
              	<form action="{{ route('students.year.class.wise') }}" method="get" id="myform">
              		<div class="form-row">
              			<div class="form-group col-md-4">
	                    <label>Year <font style="color: red;">*</font></label>
	                    <select name="year_id" class="form-control form-control-sm">
	                    	<option value="">Select Year</option>
	                    	@foreach($years as $year)
	                    	<option value="{{ $year->id }}" {{ ($year_id==$year->id)?'selected':'' }}>{{ $year->name }}</option>
	                    	@endforeach
	                    </select>
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Class <font style="color: red;">*</font></label>
	                    <select name="class_id" class="form-control form-control-sm">
	                    	<option value="">Select Class</option>
	                    	@foreach($classes as $cls)
	                    	<option value="{{ $cls->id }}" {{ ($class_id==$cls->id)?'selected':'' }}>{{ $cls->name }}</option>
	                    	@endforeach
	                    </select>
	                  </div>
	                  <div class="form-group col-md-4">
	                  	<button type="submit" name="serch" class="btn btn-primary btn-sm" style="margin-top: 32px;">Search</button>
	                  </div>
              		</div>
              	</form>
              </div>
              <div class="card-body">
              	@if(isset($search))
                 <table id="userlist" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="5%">SL.</th>
                    <th>Name</th>
                    <th>ID NO</th>
                    <th>Roll</th>
                    <th>Year</th>
                    <th>Class</th>
                    <th>Image</th>
                    <th width="12%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($alldata as $key => $value)
                    <tr class="{{ $value->id }}">
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $value['student']['name'] }}</td>
	                    <td>{{ $value['student']['id_no'] }}</td>
	                    <td>{{ $value->roll }}</td>
	                    <td>{{ $value['year']['name'] }}</td>
	                    <td>{{ $value['student_class']['name'] }}</td>
	                    <td>
	                    	<img 
                             src="{{(!empty($value['student']['image']))?url('public/upload/student_images/'.$value['student']['image']):url('public/upload/user_images/no-image.png')}}"
                             alt="User profile picture" width="70px" height="80px">
	                    </td>
	                    <td>
	                    	<a href="{{ route('students.reg.edit',$value->student_id) }}" title="Edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
	                    	<a href="{{ route('students.reg.promotion',$value->student_id) }}" title="Edit" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
	                    	<a href="{{ route('students.reg.details',$value->student_id) }}" target="_blank" title="Details" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
	                    </td>
                    </tr>
                    @endforeach
                 </tbody>
               </table>
               @else
                <table id="userlist" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="5%">SL.</th>
                    <th>Name</th>
                    <th>ID NO</th>
                    <th>Roll</th>
                    <th>Year</th>
                    <th>Class</th>
                    <th>Image</th>
                    @if(Auth::user()->role == 'Admin')
                    <th>Code</th>
                    @endif
                    <th width="13%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($alldata as $key => $value)
                    <tr class="{{ $value->id }}">
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $value['student']['name'] }}</td>
	                    <td>{{ $value['student']['id_no'] }}</td>
	                    <td>{{ $value->roll }}</td>
	                    <td>{{ $value['year']['name'] }}</td>
	                    <td>{{ $value['student_class']['name'] }}</td>
	                    <td>
	                    	<img 
                             src="{{(!empty($value['student']['image']))?url('public/upload/student_images/'.$value['student']['image']):url('public/upload/user_images/no-image.png')}}"
                             alt="User profile picture" width="70px" height="80px">
	                    </td>
	                    @if(Auth::user()->role == 'Admin')
	                    <td>{{ $value['student']['code'] }}</td>
	                    @endif
	                    <td>
	                    	<a href="{{ route('students.reg.edit',$value->student_id) }}" title="Edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
	                    	<a href="{{ route('students.reg.promotion',$value->student_id) }}" title="Promotion" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
	                    	<a href="{{ route('students.reg.details',$value->student_id) }}" target="_blank" title="Details" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
	                    </td>
                    </tr>
                    @endforeach
                 </tbody>
               </table>
               @endif
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
  	<script type="text/javascript">
	
	$(document).ready(function () { 
	  $('#myform').validate({
	    rules: {
	      year_id: {
	        required: true,
	      },
	      class_id: {
	        required: true,
	      },
	    },
	    messages: {
	      
	    },
	    errorElement: 'span',
	    errorPlacement: function (error, element) {
	      error.addClass('invalid-feedback');
	      element.closest('.form-group').append(error);
	    },
	    highlight: function (element, errorClass, validClass) {
	      $(element).addClass('is-invalid');
	    },
	    unhighlight: function (element, errorClass, validClass) {
	      $(element).removeClass('is-invalid');
	    }
	  });
	});
</script>
@endsection