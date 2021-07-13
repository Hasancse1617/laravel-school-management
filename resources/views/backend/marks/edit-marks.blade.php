 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Marks Edit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Marks Edit</li>
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
              	<form action="{{ route('marks.update') }}" method="post" id="myform">
              		@csrf
              		<div class="form-row">
              			<div class="form-group col-md-3">
	                    <label>Year <font style="color: red;">*</font></label>
	                    <select name="year_id" id="year_id" class="form-control form-control-sm">
	                    	<option value="">Select Year</option>
	                    	@foreach($years as $year)
	                    	<option value="{{ $year->id }}">{{ $year->name }}</option>
	                    	@endforeach
	                    </select>
	                    <font style="display: none;color: red" id="year_error">Year is required</font>
	                  </div>
	                  <div class="form-group col-md-3">
	                    <label>Class <font style="color: red;">*</font></label>
	                    <select name="class_id" id="class_id" class="form-control form-control-sm">
	                    	<option value="">Select Class</option>
	                    	@foreach($classes as $cls)
	                    	<option value="{{ $cls->id }}">{{ $cls->name }}</option>
	                    	@endforeach
	                    </select>
	                    <font style="display: none;color: red" id="class_error">Class is required</font>
	                  </div>
                    <div class="form-group col-md-3">
                      <label>Subject <font style="color: red;">*</font></label>
                      <select name="assign_subject_id" id="assign_subject_id" class="form-control form-control-sm">
                        <option value="">Select Subject</option>
                      </select>
                      <font style="display: none;color: red" id="subject_error">Subject Name is required</font>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Exam Type <font style="color: red;">*</font></label>
                      <select name="exam_type_id" id="exam_type_id" class="form-control form-control-sm">
                        <option value="">Select Exam Type</option>
                        @foreach($exam_types as $exam)
                        <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                        @endforeach
                      </select>
                      <font style="display: none;color: red" id="exam_error">Class is required</font>
                    </div>
	                  <div class="form-group col-md-4">
	                  	<a id="search" name="search" class="btn btn-primary btn-sm" style="margin-top: 32px;">Search</a>
	                  </div>
              		</div><br>
              		<div class="row d-none" id="marks-entry">
              			<div class="col-md-12">
              				<table class="table table-bordered table-striped dt-responsive" style="width: 100%">
              					<thead>
              						<tr>
              							<th>ID No</th>
              							<th>Student Name</th>
              							<th>Father's Name</th>
              							<th>Gender</th>
              							<th>Marks</th>
              						</tr>
              					</thead>
              					<tbody id="marks-entry-tr"></tbody>
              				</table>
                      <button type="submit" class="btn btn-primary btn-sm">Marks Entry</button>
              			</div>
              		</div>
                    
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
  $(document).on('change','#assign_subject_id',function(){
       var assign_subject_id = $('#assign_subject_id').val();
       if (assign_subject_id != '') {
         $('#subject_error').hide();
       }
  });
  $(document).on('change','#exam_type_id',function(){
       var exam_type_id = $('#exam_type_id').val();
       if (exam_type_id != '') {
         $('#exam_error').hide();
       }
  });
</script>
<script type="text/javascript">
	$(document).on('click','#search',function(){
       var year_id = $('#year_id').val();
       var class_id = $('#class_id').val();
       var assign_subject_id = $('#assign_subject_id').val();
       var exam_type_id = $('#exam_type_id').val();
       if (year_id=='' && class_id=='' && assign_subject_id==''&&exam_type_id=='') {
          $('#year_error').show();
          $('#class_error').show();
          $('#subject_error').show();
          $('#exam_error').show();
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
       else if (assign_subject_id=='') {
          $('#subject_error').show();
          return false;
       }
       else if (exam_type_id=='') {
          $('#exam_error').show();
          return false;
       }

       $.ajax({
          url: "{{ route('get-student-marks') }}",
          type: "GET",
          data: {'year_id':year_id,'class_id':class_id,'assign_subject_id':assign_subject_id,'exam_type_id':exam_type_id},
          success: function(data){
          	$('#marks-entry').removeClass('d-none');
          	var html = '';
          	$.each(data, function(key, v){
               html +=
               '<tr>'+
               '<td>'+v.student.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"><input type="hidden" name="id_no[]" value="'+v.student.id_no+'"></td>'+
               '<td>'+v.student.name+'</td>'+
               '<td>'+v.student.fname+'</td>'+
               '<td>'+v.student.gender+'</td>'+
               '<td><input type="text" class="form-control form-control-sm" value="'+v.marks+'" name="marks[]" ></td>'+
               '</tr>';
          	});
          	html = $('#marks-entry-tr').html(html);
          }
       });
	});
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','#class_id',function(){
      var class_id = $('#class_id').val();
      $.ajax({
        url: "{{route('get-subject')}}",
        type: 'get',
        data: {class_id:class_id},
        success:function(data){
          var html = '<option value="">Select Subject</option>';
          $.each(data, function(key, v){
             html += '<option value="'+v.id+'">'+v.subject.name+'</option>';
          });
          $('#assign_subject_id').html(html);
        }
      });
    });
  });
</script>

<script type="text/javascript">
	$(document).ready(function () {
	$('#myform').validate({
	rules: {
	"marks[]": {
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