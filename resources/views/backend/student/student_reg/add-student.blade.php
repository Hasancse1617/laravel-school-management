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
                @if(isset($editdata))
                  Edit Student
                @else
                  Add Student
                @endif
                  <a href="{{ route('students.reg.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Student List</a>
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ (isset($editdata))?route('students.reg.update',$editdata->student_id):route('students.reg.store') }}" id="addForm" enctype="multipart/form-data">
                 	@csrf
                 	<input type="hidden" name="id" value="{{ @$editdata->id }}">
	                <div class="form-row">
	                  <div class="form-group col-md-4">
	                    <label for="name">Student Name <font style="color: red;">*</font></label>
	                    <input type="text" name="name" class="form-control form-control-sm" value="{{ @$editdata['student']['name'] }}">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label for="fname">Father's Name <font style="color: red;">*</font></label>
	                    <input type="text" name="fname" class="form-control form-control-sm" value="{{ @$editdata['student']['fname'] }}">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label for="mname">Mother's Name <font style="color: red;">*</font></label>
	                    <input type="text" name="mname" class="form-control form-control-sm" value="{{ @$editdata['student']['mname'] }}">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Mobile No <font style="color: red;">*</font></label>
	                    <input type="text" name="mobile" class="form-control form-control-sm" value="{{ @$editdata['student']['mobile'] }}">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Address <font style="color: red;">*</font></label>
	                    <input type="text" name="address" class="form-control form-control-sm" value="{{ @$editdata['student']['address'] }}">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Gender <font style="color: red;">*</font></label>
	                    <select name="gender" class="form-control form-control-sm">
	                    	<option value="">Select Gender</option>
	                    	<option value="Male" {{(@$editdata['student']['gender']=='Male')?'selected':''}}>Male</option>
	                    	<option value="Female" {{(@$editdata['student']['gender']=='Female')?'selected':''}}>Female</option>
	                    </select>
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Religion <font style="color: red;">*</font></label>
	                    <select name="religion" class="form-control form-control-sm">
	                    	<option value="">Select Religion</option>
	                    	<option value="Islam" {{(@$editdata['student']['religion']=='Islam')?'selected':''}}>Islam</option>
	                    	<option value="Hindu" {{(@$editdata['student']['religion']=='Hindu')?'selected':''}}>Hindu</option>
	                    	<option value="Khristan" {{(@$editdata['student']['religion']=='Khristan')?'selected':''}}>Khristan</option>
	                    </select>
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Date of Birth <font style="color: red;">*</font></label>
	                    <input type="text" name="dob" class="form-control form-control-sm datepicker" value="{{ @$editdata['student']['dob'] }}">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Discount <font style="color: red;">*</font></label>
	                    <input type="text" name="discount" class="form-control form-control-sm" value="{{ @$editdata['discount']['discount'] }}">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Year <font style="color: red;">*</font></label>
	                    <select name="year_id" class="form-control form-control-sm">
	                    	<option value="">Select Year</option>
	                    	@foreach($years as $year)
	                    	<option value="{{ $year->id }}" {{(@$editdata->year_id==$year->id)?'selected':''}}>{{ $year->name }}</option>
	                    	@endforeach
	                    </select>
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Class <font style="color: red;">*</font></label>
	                    <select name="class_id" class="form-control form-control-sm">
	                    	<option value="">Select Class</option>
	                    	@foreach($classes as $cls)
	                    	<option value="{{ $cls->id }}" {{(@$editdata->class_id==$cls->id)?'selected':''}}>{{ $cls->name }}</option>
	                    	@endforeach
	                    </select>
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Group</label>
	                    <select name="group_id" class="form-control form-control-sm">
	                    	<option value="">Select Group</option>
	                    	@foreach($groups as $group)
	                    	<option value="{{ $group->id }}" {{(@$editdata->group_id==$group->id)?'selected':''}}>{{ $group->name }}</option>
	                    	@endforeach
	                    </select>
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Shift</label>
	                    <select name="shift_id" class="form-control form-control-sm">
	                    	<option value="">Select Shift</option>
	                    	@foreach($shifts as $shift)
	                    	<option value="{{ $shift->id }}" {{(@$editdata->shift_id==$shift->id)?'selected':''}}>{{ $shift->name }}</option>
	                    	@endforeach
	                    </select>
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Image</label>
	                    <input type="file" name="image" class="form-control form-control-sm" id="image">
	                  </div>
	                  <div class="form-group col-md-4">
	                  	<img id="showImage" class="mt-2"
                       src="{{(!empty($editdata['student']['image']))?url('public/upload/student_images/'.$editdata['student']['image']):url('public/upload/user_images/no-image.png')}}"
                       alt="User profile picture" width="100px" height="110px">
	                  </div>
	                </div>
	                <input style="margin-top: 32px" type="submit" class="btn btn-primary btn-sm" value="{{ (isset($editdata))?'Update':'Submit' }}">
	              </form>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
	<script type="text/javascript">
	
	$(document).ready(function () { 
	  $('#addForm').validate({
	    rules: {
	      name: {
	        required: true,
	      },
	      fname: {
	        required: true,
	      },
	      mname: {
	        required: true,
	      },
	      mobile: {
	        required: true,
	      },
	      address: {
	        required: true,
	      },
	      gender: {
	        required: true,
	      },
	      religion: {
	        required: true,
	      },
	      dob: {
	        required: true,
	      },
	      discount: {
	        required: true,
	      },
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
<script type="text/javascript">
	$('.datepicker').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd'
	})
</script>
@endsection