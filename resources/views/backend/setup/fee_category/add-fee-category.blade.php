 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Fee Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Fee Category</li>
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
                  Edit Fee Category
                @else
                  Add Fee Category
                @endif
                  <a href="{{ route('setups.fee.category.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Fee Category List</a>
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ (isset($editdata))?route('setups.fee.category.update',$editdata->id):route('setups.fee.category.store') }}" id="addForm">
                 	@csrf
	                <div class="form-row">
	                  <div class="form-group col-md-6">
	                    <label for="name">Fee Category</label>
	                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter fee category" value="{{ (isset($editdata))?$editdata->name:'' }}">
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
	        required: "Please enter shift",
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