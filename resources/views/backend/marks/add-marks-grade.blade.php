 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Grade Point</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Grade Point</li>
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
                  Edit Grade Point
                @else
                  Add Grade Point
                @endif
                  <a href="{{ route('marks.grade.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Grade Point List</a>
                </h3>
              </div>
              <form action="{{ (@$editdata)?route('marks.grade.update',$editdata->id):route('marks.grade.store') }}" method="post" id="myform">
               @csrf
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label>Grade Name</label>
                    <input type="text" name="grade_name" value="{{@$editdata->grade_name}}" class=" form-control form-control-sm">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Grade Point</label>
                    <input type="text" name="grade_point" value="{{@$editdata->grade_point}}" class=" form-control form-control-sm">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Start Marks</label>
                    <input type="text" name="start_marks" value="{{@$editdata->start_marks}}" class=" form-control form-control-sm">
                  </div>
                  <div class="form-group col-md-4">
                    <label>End Marks</label>
                    <input type="text" name="end_marks" value="{{@$editdata->end_marks}}" class=" form-control form-control-sm">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Start Point</label>
                    <input type="text" name="start_point" value="{{@$editdata->start_point}}" class=" form-control form-control-sm">
                  </div>
                  <div class="form-group col-md-4">
                    <label>End Point</label>
                    <input type="text" name="end_point" value="{{@$editdata->end_point}}" class=" form-control form-control-sm">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Remarks</label>
                    <input type="text" name="remarks" value="{{@$editdata->remarks}}" class=" form-control form-control-sm">
                  </div> 
                </div>
                <button type="submit" class="btn btn-sm btn-success">{{@$editdata?'Update':'Submit'}}</button>
              </div>
             </form>
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
	      grade_name: {
	        required: true,
	      },
        grade_point: {
          required: true,
        },
        start_marks: {
          required: true,
        },
        end_marks: {
          required: true,
        },
        start_point: {
          required: true,
        },
        end_point: {
          required: true,
        },
        remarks: {
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