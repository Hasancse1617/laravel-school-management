 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Assign Subject</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Assign Subject</li>
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
                  Edit Assign Subject
                @else
                  Add Assign Subject
                @endif
                  <a href="{{ route('setups.assign.subject.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Assign Subject List</a>
                </h3>
              </div>
              <div class="card-body">
                 <form  method="post" action="{{ route('setups.assign.subject.update',$editdata['0']->class_id) }}" id="addForm">
                 	@csrf
                 	<div class="add_item">
                 		<div class="form-row">
		                  <div class="form-group col-md-5">
		                    <label for="name">Class Name</label>
		                    <select name="class_id" class="form-control">
		                    	<option value="">Select Class</option>
		                    	@foreach($classes as $cls)
		                    	 <option value="{{ $cls->id }}" {{($editdata['0']->class_id==$cls->id)?"selected":""}}>{{ $cls->name }}</option>
		                    	@endforeach
		                    </select>
		                  </div>
		                </div>
		                @foreach($editdata as $edit)
		                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                 		  <div class="form-row">
		                  <div class="form-group col-md-5">
		                    <label>Subject</label>
		                    <select name="subject_id[]" class="form-control">
		                    	<option value="">Select Subject</option>
		                    	@foreach($subjects as $subject)
		                    	 <option value="{{ $subject->id }}" {{($edit->subject_id==$subject->id)?"selected":""}}>{{ $subject->name }}</option>
		                    	@endforeach
		                    </select>
		                  </div>
		                  <div class="form-group col-md-2">
		                    <label>Full Mark</label>
		                    <input type="text" value="{{$edit->full_mark}}" name="full_mark[]" class="form-control" placeholder="Enter full mark">
		                  </div>
		                  <div class="form-group col-md-2">
		                    <label>Pass Mark</label>
		                    <input type="text" value="{{$edit->pass_mark}}" name="pass_mark[]" class="form-control" placeholder="Enter full mark">
		                  </div>
		                  <div class="form-group col-md-2">
		                    <label>Subjective Mark</label>
		                    <input type="text" value="{{$edit->subjective_mark}}" name="subjective_mark[]" class="form-control" placeholder="Enter full mark">
		                  </div>
		                  <div class="form-group col-md-1" style="padding-top: 30px">
		                  	<div class="form-row">
				           	   <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>             		
				           	   <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>             		
				          	</div>
		                  </div>
		                   </div> 
		                </div>
		                @endforeach
                 	</div>
	                 <button type="submit" class="btn btn-primary">{{ (isset($editdata))?'Update':'Submit' }}</button>
	              </form>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>

<div style="display: none;">
   <div class="whole_extra_item_add" id="whole_extra_item_add">
	   <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
	     <div class="form-row">
	     	<div class="form-group col-md-5">
                <label>Subject</label>
                <select name="subject_id[]" class="form-control">
                	<option value="">Select Subject</option>
                	@foreach($subjects as $subject)
                	 <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                	@endforeach
                </select>
              </div>
               <div class="form-group col-md-2">
                <label>Full Mark</label>
                <input type="text" name="full_mark[]" class="form-control" placeholder="Enter full mark">
              </div>
              <div class="form-group col-md-2">
                <label>Pass Mark</label>
                <input type="text" name="pass_mark[]" class="form-control" placeholder="Enter full mark">
              </div>
              <div class="form-group col-md-2">
                <label>Subjective Mark</label>
                <input type="text" name="subjective_mark[]" class="form-control" placeholder="Enter full mark">
              </div>
              <div class="form-group col-md-1" style="padding-top: 30px">
              	<div class="form-row">
               	   <span class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i></span>             		
               	   <span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i></span>             		
              	</div>
              </div>	
	     </div>	
	   </div>
   	</div>	
</div>

<script type="text/javascript">
	$(document).ready(function(){
		var counter = 0;
		$(document).on('click','.addeventmore',function(){
			var whole_extra_item_add = $('#whole_extra_item_add').html();
			$(this).closest('.add_item').append(whole_extra_item_add);
			counter += 1;
		});
		$(document).on('click','.removeeventmore',function(){
			var delete_whole_extra_item_add = $('#delete_whole_extra_item_add').html();
			$(this).closest('.delete_whole_extra_item_add').remove();
			counter -= 1;
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function () {
	  
	  $("#addForm").validate({
	    rules: {
	      "class_id": {
	        required: true,
	      },
	      "subject_id[]": {
	        required: true,
	      },
	      "full_mark[]": {
	        required: true,
	      },
	      "pass_mark[]": {
	        required: true,
	      },
	      "subjective_mark[]": {
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