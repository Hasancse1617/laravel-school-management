 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Employee Leave</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee Leave</li>
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
                  Edit Employee Leave
                @else
                  Add Employee Leave
                @endif
                  <a href="{{ route('employees.leave.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Employee Leave List</a>
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ (isset($editdata))?route('employees.leave.update',$editdata->id):route('employees.leave.store') }}" id="addForm">
                 	@csrf
	                <div class="form-row">
	                  <div class="form-group col-md-4">
	                    <label for="name">Employee Name</label>
	                    <select name="employee_id" class="form-control form-control-sm">
                       <option value="">Select Employee</option>
                       @foreach($employees as $employee) 
                       <option value="{{ $employee->id }}" {{(@$editdata->employee_id==$employee->id)?"selected":""}}>{{ $employee->name }}</option> 
                       @endforeach
                      </select>
	                  </div>
                    <div class="form-group col-md-4">
                      <label for="name">Start Date</label>
                      <input type="text" name="start_date"  class="form-control form-control-sm datepicker" value="{{@$editdata->start_date}}" autocomplete="off">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="name">End Date</label>
                      <input type="text" name="end_date"  class="form-control form-control-sm datepicker2" value="{{@$editdata->end_date}}" autocomplete="off">
                    </div>
		                
                    <div class="form-group col-md-8">
                      <label for="name">Leave Purpose</label>
                      <select name="leave_purpose_id" id="leave_purpose_id" class="form-control form-control-sm">
                       <option value="">Select Leave Purpose</option>
                       @foreach($leave_purpose as $purpose) 
                       <option value="{{ $purpose->id }}" {{(@$editdata->leave_purpose_id==$purpose->id)?"selected":""}}>{{ $purpose->name }}</option> 
                       @endforeach
                       <option value="0">New Purpose</option>
                      </select>&nbsp;
                      <input id="new_purpose" style="display: none;" type="text" name="name" class="form-control form-control-sm" placeholder="Enter new purpose">
                    </div>
                    <div class="form-group col-md-4">
                      <input style="margin-top: 32px" type="submit" class="btn btn-primary btn-sm" value="{{ (isset($editdata))?'Update':'Submit' }}">
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
    $(document).ready(function(){
      $(document).on('change','#leave_purpose_id',function(){
        var leave_purpose_id = $(this).val();
        if (leave_purpose_id=='0') {
          $('#new_purpose').show();
        }
        else{
          $('#new_purpose').hide();
        }
      });
    });
  </script>
	<script type="text/javascript">
	
	$(document).ready(function () {
	  
	  $('#addForm').validate({
	    rules: {
	      name: {
	        required: true,
	      },
	    },
	    messages: {
	      name: {
	        required: "Please enter group name",
	      },
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