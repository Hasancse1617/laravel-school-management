 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Marksheet</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Marksheet Profit</li>
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
                  <!-- <a href="{{ route('accounts.salary.add') }}" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i>&nbsp;Add/Edit Employee Salary</a> -->
                </h3>
              </div>
              <div class="card-body">
                <form action="{{route('reports.marksheet.get')}}" method="get" target="_blank" id="addForm">
                 <div class="form-row">
                   <div class="form-group col-md-3">
                     <label>Year</label>
                     <select name="year_id" id="year_id" class="form-control">
                       <option value="">Select Year</option>
                       @foreach($years as $year)
                        <option value="{{$year->id}}">{{$year->name}}</option>
                       @endforeach
                     </select>
                   </div>
                   <div class="form-group col-md-3">
                     <label>Class</label>
                     <select name="class_id" id="class_id" class="form-control">
                       <option value="">Select Class</option>
                       @foreach($classes as $class)
                        <option value="{{$class->id}}">{{$class->name}}</option>
                       @endforeach
                     </select>
                   </div>
                   <div class="form-group col-md-3">
                     <label>Exam Type</label>
                     <select name="exam_type_id" id="exam_type_id" class="form-control">
                       <option value="">Select Exam Type</option>
                       @foreach($exam_types as $exam)
                        <option value="{{$exam->id}}">{{$exam->name}}</option>
                       @endforeach
                     </select>
                   </div>
                   <div class="form-group col-md-3">
                     <label>ID No</label>
                     <input type="text" name="id_no" class="form-control">
                   </div>
                   <div class="form-group col-md-2">
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
        year_id: {
          required: true,
        },
        class_id: {
          required: true,
        },
        exam_type_id: {
          required: true,
        },
        id_no: {
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