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
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3>
                  Grade Point List
                  <a href="{{ route('marks.grade.add') }}" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i>&nbsp;Add Grade Point</a>
                </h3>
              </div>
              <div class="card-body">
                 <table id="userlist" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Grade Name</th>
                    <th>Grade Point</th>
                    <th>Start Marks</th>
                    <th>End Marks</th>
                    <th>Point Range</th>
                    <th>Remarks</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($alldata as $key => $value)
                    <tr class="{{ $value->id }}">
                      <td>{{ $key+1 }}</td>
                      <td>{{ $value->grade_name }}</td>
                      <td>{{ number_format((float)$value->grade_point,2) }}</td>
                      <td>{{ $value->start_marks }}</td>
                      <td>{{ $value->end_marks }}</td>
                      <td>{{ number_format((float)$value->start_point,2) }}-{{ number_format((float)$value->end_point,2) }}</td>
                      <td>{{ $value->remarks }}</td>
                      <td style="width: 10%">
                        <a href="{{ route('marks.grade.edit',$value->id) }}" title="Edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                      </td>
                    </tr>
                    @endforeach
                 </tbody>
               </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>
@endsection