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
                  Student Fee List
                  <a href="{{ route('accounts.fee.add') }}" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i>&nbsp;Add/Edit Student Fee</a>
                </h3>
              </div>
              <div class="card-body">
                 <table id="userlist" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.</th>
                    <th>ID No</th>
                    <th>Name</th>
                    <th>Year</th>
                    <th>Class</th>
                    <th>Fee Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($alldata as $key => $value)
                    <tr class="{{ $value->id }}">
                      <td>{{ $key+1 }}</td>
                      <td>{{ $value['student']['id_no'] }}</td>
                      <td>{{ $value['student']['name'] }}</td>
                      <td>{{ $value['year']['name'] }}</td>
                      <td>{{ $value['student_class']['name'] }}</td>
                      <td>{{ $value['fee_category']['name'] }}-{{ $value->end_point }}</td>
                      <td>{{ $value->amount }}</td>
                      <td>{{date('M Y',strtotime($value->date))}}</td>
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