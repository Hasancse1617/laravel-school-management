 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Other Cost</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Other Cost</li>
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
                   Edit Cost
                   @else
                   Add cost
                   @endif
                  <a href="{{ route('accounts.cost.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Other Cost List</a>
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ (@$editdata)?route('accounts.cost.update',$editdata->id):route('accounts.cost.store') }}" id="addForm" enctype="multipart/form-data">
                  @csrf
                  <div class="form-row">
                    <div class="form-group col-md-3">
                      <label>Date</label>
                      <input type="text" name="date" value="{{(@$editdata)?date('d-m-Y',strtotime($editdata->date)):''}}" class="form-control datepicker" autocomplete="off">
                    </div>
                    <div class="form-group col-md-3">
                      <label>Amount</label>
                      <input type="text" name="amount" class="form-control" value="{{@$editdata->amount}}">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Image</label>
                      <input type="file" name="image" class="form-control form-control-sm" id="image">
                    </div>
                    <div class="form-group col-md-4">
                      <img src="{{(!empty(@$editdata->image))?url('public/upload/cost_images/'.@$editdata->image):url('public/upload/cost_images/no.png')}}" id="showImage" style="width: 300px;height: 100px;border:1px solid #000">
                    </div>
                    <div class="form-group col-md-12">
                      <label>Description</label>
                      <textarea name="description" class="form-control" rows="4">{{@$editdata->description}}</textarea>
                    </div>
                    <div class="form-group col-md-3">
                      <input type="submit" class="btn btn-primary" value="{{(@$editdata)?'Update':'Submit'}}">
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
	      date: {
	        required: true,
	      },
        amount: {
          required: true,
        },
        description: {
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
<script type="text/javascript">
  $('.datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd'
  })
</script>

@endsection