 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Employee Attendance Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Attendance Report</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ Session::get('success_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             @endif
            @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ Session::get('error_message') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
             @endif
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>
                  Select Criteria
                </h3>
              </div>
              <div class="card-body">
                <form action="{{route('reports.attendance.get')}}" method="get" target="_blank" id="addForm">
                 <div class="form-row">
                   <div class="form-group col-md-3">
                     <label>Employee</label>
                     <select name="employee_id" id="employee_id" class="form-control">
                       <option value="">Select Employee</option>
                       @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->name}}</option>
                       @endforeach
                     </select>
                   </div>
                   <div class="form-group col-md-3">
                     <label>Date</label>
                     <input type="text" name="date" class="form-control datepicker" placeholder="DD-MM-YYYY" readonly>
                   </div>
                   <div class="form-group col-md-2" style="padding-top: 32px;">
                     <button type="submit" class="btn btn-success">Search</button>
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
        employee_id: {
          required: true,
        },
        date: {
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