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
                  Add/Edit Employee Salary
                  <a href="{{ route('accounts.fee.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Employee Salary List</a>
                </h3>
              </div>
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="text" name="date" id="date" class=" form-control form-control-sm datepicker" placeholder="YYYY-MM-DD" readonly>
                    <font style="display: none;color: red" id="date_error">Date is required</font>
                  </div>
                </div>
                <a name="search" id="search" class="btn btn-primary btn-sm">Search</a>
              </div>
              <div class="card-body">
                <div id="DocumentResults"></div>
                <script id="document-template" type="text/x-handlebars-template">
                  <form action="{{route('accounts.salary.store')}}" method="post">
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
       var date = $('#date').val();
       if (date=='') {
          $('#date_error').show();
          return false;
       }
       else{$('#date_error').hide();}
       $.ajax({
         url: "{{route('accounts.salary.getemployee')}}",
         type: "get",
         data: {'date':date},
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