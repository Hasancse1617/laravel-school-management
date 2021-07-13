 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Roll Generate</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Roll Generate</li>
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
            @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ Session::get('error_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             @endif
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>
                  Search Criteria
                </h3>
              </div>
              <div class="card-body">
              	<form action="{{ route('students.roll.store') }}" method="post" id="myform">
              		@csrf
              		<div class="form-row">
              			<div class="form-group col-md-4">
	                    <label>Year <font style="color: red;">*</font></label>
	                    <select name="year_id" id="year_id" class="form-control form-control-sm">
	                    	<option value="">Select Year</option>
	                    	@foreach($years as $year)
	                    	<option value="{{ $year->id }}">{{ $year->name }}</option>
	                    	@endforeach
	                    </select>
	                    <font style="display: none;color: red" id="year_error">Year is required</font>
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Class <font style="color: red;">*</font></label>
	                    <select name="class_id" id="class_id" class="form-control form-control-sm">
	                    	<option value="">Select Class</option>
	                    	@foreach($classes as $cls)
	                    	<option value="{{ $cls->id }}">{{ $cls->name }}</option>
	                    	@endforeach
	                    </select>
	                    <font style="display: none;color: red" id="class_error">Class is required</font>
	                  </div>
	                  <div class="form-group col-md-4">
	                  	<a id="search" name="search" class="btn btn-primary btn-sm" style="margin-top: 32px;">Search</a>
	                  </div>
              		</div><br>
              		<div class="row d-none" id="roll-generate">
              			<div class="col-md-12">
              				<table class="table table-bordered table-striped dt-responsive" style="width: 100%">
              					<thead>
              						<tr>
              							<th>ID No</th>
              							<th>Student Name</th>
              							<th>Father's Name</th>
              							<th>Gender</th>
              							<th>Roll</th>
              						</tr>
              					</thead>
              					<tbody id="roll-generate-tr"></tbody>
              				</table>
              			</div>
              		</div>
                    <button type="submit" class="btn btn-primary btn-sm">Roll Generate</button>
              	</form>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
<script type="text/javascript">
	$(document).on('change','#year_id',function(){
       var year_id = $('#year_id').val();
       if (year_id != '') {
       	 $('#year_error').hide();
       }
	});
	$(document).on('change','#class_id',function(){
       var class_id = $('#class_id').val();
       if (class_id != '') {
       	 $('#class_error').hide();
       }
	});
</script>
<script type="text/javascript">
	$(document).on('click','#search',function(){
       var year_id = $('#year_id').val();
       var class_id = $('#class_id').val();
       if (year_id=='' && class_id=='') {
          $('#year_error').show();
          $('#class_error').show();
          return false;
       }
       else if (year_id=='') {
          $('#year_error').show();
          return false;
       }
       else if (class_id=='') {
          $('#class_error').show();
          return false;
       }

       $.ajax({
          url: "{{ route('students.roll.get-student') }}",
          type: "GET",
          data: {'year_id':year_id,'class_id':class_id},
          success: function(data){
          	$('#roll-generate').removeClass('d-none');
          	var html = '';
          	$.each(data, function(key, v){
               html +=
               '<tr>'+
               '<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
               '<td>'+v.student.name+'</td>'+
               '<td>'+v.student.fname+'</td>'+
               '<td>'+v.student.gender+'</td>'+
               '<td><input type="text" class="form-control form-control-sm" name="roll[]" value="'+v.roll+'"></td>'+
               '</tr>';
          	});
          	html = $('#roll-generate-tr').html(html);
          }
       });
	});
</script>

<script type="text/javascript">
	$(document).ready(function () {
	$('#myform').validate({
	rules: {
	"roll[]": {
	   required: true,
	 }
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