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
                  Employee List
                </h3>
              </div>
              <div class="card-body">
                 <table id="userlist" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Name</th>
                    <th>ID No</th>
                    <th>Mobile No</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Join Date</th>
                    <th>Salary</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($alldata as $key => $value)
                    <tr class="{{ $value->id }}">
                      <td>{{ $key+1 }}</td>
                      <td>{{ $value->name }}</td>
                      <td>{{ $value->id_no }}</td>
                      <td>{{ $value->mobile }}</td>
                      <td>{{ $value->email }}</td>
                      <td>{{ $value->gender }}</td>
                      <td>{{ date('d-m-Y',strtotime($value->join_date)) }}</td>
                      <td>{{ $value->salary }}</td>
                      <td style="width: 10%">
                        <a href="{{ route('employees.salary.increment',$value->id) }}" title="Salary Increment" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i></a>
                        <a href="{{ route('employees.salary.details',$value->id) }}" title="Salary Details" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
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