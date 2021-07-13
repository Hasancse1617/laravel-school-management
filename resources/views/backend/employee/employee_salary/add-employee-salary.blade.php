 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Employee Salary</h1>
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
                  Employee Salary Increment
                  <a href="{{ route('employees.salary.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Employee List</a>
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ route('employees.salary.store',$editdata->id) }}" id="addForm">
                 	@csrf
	                <div class="form-row">
	                  <div class="form-group col-md-4">
	                    <label>Salary Amount</label>
	                    <input type="text" name="increment_salary" class="form-control">
	                  </div>
	                  <div class="form-group col-md-4">
	                    <label>Effected Date</label>
	                    <input type="text" name="effected_date" class="form-control datepicker" placeholder="Date">
	                  </div>

		              <div class="form-group col-md-4">
	                    <input style="margin-top: 32px" type="submit" class="btn btn-primary" value="Submit">
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
	
	$(document).ready(function () {
	  
	  $('#addForm').validate({
	    rules: {
	      increment_salary: {
	        required: true,
	      },
	      effected_date: {
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