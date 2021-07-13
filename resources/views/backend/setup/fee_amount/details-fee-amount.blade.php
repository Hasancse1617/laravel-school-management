 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Fee Category Amount</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Fee Amount</li>
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
                  Fee Amount Details
                  <a href="{{ route('setups.fee.amount.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Fee Amount List</a>
                </h3>
              </div>
              <div class="card-body">
              	<h4><strong>Fee Type:</strong> {{ $detaildata['0']['fee_category']['name'] }}</h4>
                 <table  class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SL.</th>
                    <th>Class</th>
                    <th>Amount</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($detaildata as $key => $value)
                    <tr>
	                    <td>{{ $key+1 }}</td>
	                    <td>{{ $value['student_class']['name'] }}</td>
	                    <td>{{ $value->amount }}</td>
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