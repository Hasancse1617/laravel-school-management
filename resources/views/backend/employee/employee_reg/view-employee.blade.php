 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee</li>
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
                  <a href="{{ route('employees.reg.add') }}" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i>&nbsp;Add Employee</a>
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
                    @if(Auth::user()->role=='Admin')
                    <th>Code</th>
                    @endif
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
                      @if(Auth::user()->role=='Admin')
                      <td>{{ $value->code }}</td>
                      @endif
                      <td style="width: 10%">
                        <a href="{{ route('employees.reg.edit',$value->id) }}" title="Edit" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                        <a href="{{ route('employees.reg.details',$value->id) }}" target="_blank" title="Details" class="btn btn-sm btn-success"><i class="fas fa-eye"></i></a>
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