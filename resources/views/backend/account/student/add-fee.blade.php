 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Student Fee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Fee</li>
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
                  Add/Edit Student Fee
                  <a href="{{ route('accounts.fee.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Student Fee List</a>
                </h3>
              </div>
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Year</label>
                    <select name="year_id" id="year_id" class="form-control form-control-sm">
                       <option value="">Select Year</option>
                       @foreach($years as $year)
                        <option value="{{$year->id}}">{{$year->name}}</option>
                       @endforeach
                    </select>
                    <font style="display: none;color: red" id="year_error">Year is required</font>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Class</label>
                    <select name="class_id" id="class_id" class="form-control form-control-sm">
                       <option value="">Select Class</option>
                       @foreach($classes as $class)
                        <option value="{{$class->id}}">{{$class->name}}</option>
                       @endforeach
                    </select>
                    <font style="display: none;color: red" id="class_error">Class is required</font>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Fee Category</label>
                    <select name="fee_category_id" id="fee_category_id" class="form-control form-control-sm">
                       <option value="">Select Fee Category</option>
                       @foreach($fee_categories as $fee)
                        <option value="{{$fee->id}}">{{$fee->name}}</option>
                       @endforeach
                    </select>
                    <font style="display: none;color: red" id="fee_error">Fee Category is required</font>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="text" name="date" id="date" class=" form-control form-control-sm datepicker" placeholder="YYYY-MM-DD">
                    <font style="display: none;color: red" id="date_error">Date is required</font>
                  </div>
                </div>
                <a name="search" id="search" class="btn btn-primary btn-sm">Search</a>
              </div>
              <div class="card-body">
                <div id="DocumentResults"></div>
                <script id="document-template" type="text/x-handlebars-template">
                  <form action="{{route('accounts.fee.store')}}" method="post">
                  @csrf
                  <table class="table-sm table-bordered table-striped" style="width:100%">
                    <thead>
                      <tr>
                        @{{{thsource}}}
                      </tr>
                    </thead>
                    <tbody>
                      @{{#each this}}
                      <tr>
                        @{{{tdsource}}}
                      </tr>
                      @{{/each}}
                    </tbody>
                  </table><br>
                  <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </form>
                </script>
              </div>

            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
  <script type="text/javascript">
    $(document).on('click','#search',function(){
       var year_id = $('#year_id').val();
       var class_id = $('#class_id').val();
       var fee_category_id = $('#fee_category_id').val();
       var date = $('#date').val();
       if (year_id==''&&class_id==''&&fee_category_id==''&&date=='') {
          $('#year_error').show();
          $('#class_error').show();
          $('#fee_error').show();
          $('#date_error').show();
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
       else if (fee_category_id=='') {
          $('#fee_error').show();
          return false;
       }
       else if (date=='') {
          $('#date_error').show();
          return false;
       }
       else{$('#date_error').hide();}
       $.ajax({
         url: "{{route('accounts.fee.getstudent')}}",
         type: "get",
         data: {'year_id':year_id,'class_id':class_id,'fee_category_id':fee_category_id,'date':date},
         beforeSend:function(){

         },
         success:function(data){
           var source = $('#document-template').html();
           var template = Handlebars.compile(source);
           var html = template(data);
           $('#DocumentResults').html(html);
           $('[data-toggle="tooltip"]').tooltip();
         }
       });
    });
  </script>
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
  $(document).on('change','#fee_category_id',function(){
       var fee_category_id = $('#fee_category_id').val();
       if (fee_category_id != '') {
         $('#fee_error').hide();
       }
  });
</script>
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
<script type="text/javascript">
  $('.datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd'
  })
</script>

@endsection