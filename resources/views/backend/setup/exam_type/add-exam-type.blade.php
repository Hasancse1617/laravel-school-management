 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Exam Type</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Exam Type</li>
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
                  Edit Exam Type
                @else
                  Add Exam Type
                @endif
                  <a href="{{ route('setups.exam.type.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Exam Type List</a>
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ (isset($editdata))?route('setups.exam.type.update',$editdata->id):route('setups.exam.type.store') }}" id="addForm">
                 	@csrf
	                <div class="form-row">
	                  <div class="form-group col-md-6">
	                    <label for="name">Exam Type</label>
	                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter exam type" value="{{ (isset($editdata))?$editdata->name:'' }}">
	                    <font style="color: red">
	                    	{{ ($errors->has('name'))?($errors->first('name')):'' }}
	                    </font>
	                  </div>

		              <div class="form-group col-md-6">
	                    <input style="margin-top: 32px" type="submit" class="btn btn-primary" value="{{ (isset($editdata))?'Update':'Submit' }}">
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
	      name: {
	        required: true,
	      },
	    },
	    messages: {
	      name: {
	        required: "Please year name",
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
@endsection