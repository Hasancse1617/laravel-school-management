 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee</li>
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
                  Edit Employee
                @else
                  Add Employee
                @endif
                  <a href="{{ route('employees.reg.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Employee List</a>
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ (isset($editdata))?route('employees.reg.update',$editdata->id):route('employees.reg.store') }}" id="addForm" enctype="multipart/form-data">
                 	@csrf
	                <div class="form-row">
	                  <div class="form-group col-md-4">
	                    <label for="name">Employee Name <font style="color: red;">*</font></label>
	                    <input type="text" name="name" class="form-control form-control-sm" value="{{ @$editdata->name }}">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label for="fname">Father's Name <font style="color: red;">*</font></label>
	                    <input type="text" name="fname" class="form-control form-control-sm" value="{{ @$editdata->fname }}">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label for="mname">Mother's Name <font style="color: red;">*</font></label>
	                    <input type="text" name="mname" class="form-control form-control-sm" value="{{ @$editdata->mname }}">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Mobile No <font style="color: red;">*</font></label>
	                    <input type="text" name="mobile" class="form-control form-control-sm" value="{{ @$editdata->mobile }}">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Email <font style="color: red;">*</font></label>
	                    <input type="text" name="email" class="form-control form-control-sm" value="{{ @$editdata->mobile }}">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Address <font style="color: red;">*</font></label>
	                    <input type="text" name="address" class="form-control form-control-sm" value="{{ @$editdata->address }}">
	                  </div>
	                  <div class="form-group col-md-3">
	                    <label>Gender <font style="color: red;">*</font></label>
	                    <select name="gender" class="form-control form-control-sm">
	                    	<option value="">Select Gender</option>
	                    	<option value="Male" {{(@$editdata->gender=='Male')?'selected':''}}>Male</option>
	                    	<option value="Female" {{(@$editdata->gender=='Female')?'selected':''}}>Female</option>
	                    </select>
	                  </div>
	                  <div class="form-group col-md-3">
	                    <label>Religion <font style="color: red;">*</font></label>
	                    <select name="religion" class="form-control form-control-sm">
	                    	<option value="">Select Religion</option>
	                    	<option value="Islam" {{(@$editdata->religion=='Islam')?'selected':''}}>Islam</option>
	                    	<option value="Hindu" {{(@$editdata->religion=='Hindu')?'selected':''}}>Hindu</option>
	                    	<option value="Khristan" {{(@$editdata->religion=='Khristan')?'selected':''}}>Khristan</option>
	                    </select>
	                  </div>
	                  <div class="form-group col-md-3">
	                    <label>Date of Birth <font style="color: red;">*</font></label>
	                    <input type="text" name="dob" class="form-control form-control-sm datepicker" value="{{ @$editdata->dob }}">
	                  </div>
	                  <div class="form-group col-md-3">
	                    <label>Designation <font style="color: red;">*</font></label>
	                    <select name="designation_id" class="form-control form-control-sm">
	                    	<option value="">Select Designation</option>
	                    	@foreach($designations as $designation)
	                    	<option value="{{ $designation->id }}" {{(@$editdata->designation_id==$designation->id)?'selected':''}}>{{ $designation->name }}</option>
	                    	@endforeach
	                    </select>
	                  </div>
	                  @if(!@$editdata)
	                  <div class="form-group col-md-3">
	                    <label>Join Date <font style="color: red;">*</font></label>
	                    <input type="text" name="join_date" class="form-control form-control-sm datepicker2" value="{{ @$editdata->join_date }}">
	                  </div>
	                  <div class="form-group col-md-3">
	                    <label>Salary <font style="color: red;">*</font></label>
	                    <input type="text" name="salary" class="form-control form-control-sm" value="{{ @$editdata->salary }}">
	                  </div>
	                  @endif
	                  <div class="form-group col-md-3">
	                    <label>Image</label>
	                    <input type="file" name="image" class="form-control form-control-sm" id="image">
	                  </div>
	                  <div class="form-group col-md-3">
	                  	<img id="showImage" class="mt-2"
                       src="{{(!empty($editdata->image))?url('public/upload/employee_images/'.$editdata->image):url('public/upload/user_images/no-image.png')}}"
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
	      email: {
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
	      salary: {
	        required: true,
	      },
	      designation_id: {
	        required: true,
	      },
	      join_date: {
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
<script type="text/javascript">
	$('.datepicker2').datepicker({
		uiLibrary: 'bootstrap4',
		format: 'yyyy-mm-dd'
	})
</script>
@endsection