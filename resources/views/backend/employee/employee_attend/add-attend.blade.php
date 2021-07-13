 @extends('backend.layouts.master')
 @section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Employee Attendance</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee Attendance</li>
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
                  Edit Employee Attendance
                @else
                  Add Employee Attendance
                @endif
                  <a href="{{ route('employees.attend.view') }}" class="btn btn-success float-right"><i class="fas fa-list"></i>&nbsp;Employee Attendance List</a>
                </h3>
              </div>
              <form action="{{ route('employees.attend.store') }}" method="post" id="myform">
               @csrf
               @if(isset($editdata))
              <div class="card-body">
                  <div class="form-group col-md-4">
                    <label>Attendance Date</label>
                    <input type="text" name="date" id="date" value="{{$editdata['0']['date']}}" class="checkdate form-control form-control-sm datepicker" placeholder="Attendance Date" autocomplete="off">
                  </div>
                
                  <table width="100%" class="table-sm table-bordered table-striped dt-responsive">
                    <thead>
                      <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">SL.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee Name</th>
                        <th colspan="3" class="text-center" style="vertical-align: middle;width: 25%">Attendance status</th>
                      </tr>
                      <tr>
                        <th class="text-center btn present_all" style="display: table-cell;background-color: #114190">Present</th>
                        <th class="text-center btn leave_all" style="display: table-cell;background-color: #114190">Leave</th>
                        <th class="text-center btn absent_all" style="display: table-cell;background-color: #114190">Absent</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($editdata as $key=>$data)
                      <tr>
                        <input type="hidden" name="employee_id[]" value="{{$data->employee_id}}" class="employee_id">
                        <td class="text-center">{{ $key+1 }}</td>
                        <td class="text-center">{{ $data['user']['name'] }}</td>
                        <td colspan="3">
                          <div class="switch-toggle switch-3 switch-candy">
                            <input class="present" id="present{{$key}}" type="radio" name="attend_status{{$key}}" value="Present" {{($data->attend_status=='Present')?'checked':''}} />
                            <label for="">Present</label>
                            <input class="leave" id="leave{{$key}}" type="radio" name="attend_status{{$key}}" value="Leave" {{($data->attend_status=='Leave')?'checked':''}}/>
                            <label for="">Leave</label>
                            <input class="absent" id="absent{{$key}}" type="radio" name="attend_status{{$key}}" value="Absent" {{($data->attend_status=='Absent')?'checked':''}}/>
                            <label for="">Absent</label>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table><br>
              <button type="submit" class="btn btn-sm btn-success">Update</button>
              </div>
              @else
               <div class="card-body">
                  <div class="form-group col-md-4">
                    <label>Attendance Date</label>
                    <input type="text" name="date" id="date" class="checkdate form-control form-control-sm datepicker" placeholder="Attendance Date" autocomplete="off">
                  </div>
                
                  <table width="100%" class="table-sm table-bordered table-striped dt-responsive">
                    <thead>
                      <tr>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">SL.</th>
                        <th rowspan="2" class="text-center" style="vertical-align: middle;">Employee Name</th>
                        <th colspan="3" class="text-center" style="vertical-align: middle;width: 25%">Attendance status</th>
                      </tr>
                      <tr>
                        <th class="text-center btn present_all" style="display: table-cell;background-color: #114190">Present</th>
                        <th class="text-center btn leave_all" style="display: table-cell;background-color: #114190">Leave</th>
                        <th class="text-center btn absent_all" style="display: table-cell;background-color: #114190">Absent</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($employees as $key=>$employee)
                      <tr>
                        <input type="hidden" name="employee_id[]" value="{{$employee->id}}" class="employee_id">
                        <td class="text-center">{{ $key+1 }}</td>
                        <td class="text-center">{{ $employee->name }}</td>
                        <td colspan="3">
                          <div class="switch-toggle switch-3 switch-candy">
                            <input class="present" id="present{{$key}}" type="radio" name="attend_status{{$key}}" value="Present" checked="checked" />
                            <label for="">Present</label>
                            <input class="leave" id="leave{{$key}}" type="radio" name="attend_status{{$key}}" value="Leave"  />
                            <label for="">Leave</label>
                            <input class="absent" id="absent{{$key}}" type="radio" name="attend_status{{$key}}" value="Absent"  />
                            <label for="">Absent</label>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table><br>
              <button type="submit" class="btn btn-sm btn-success">Submit</button>
              </div>
              @endif
             </form>
            </div>
          </section>
        </div>
      </div>
    </section>
  </div>

 <script type="text/javascript">
   $(document).ready(function(){
     $(document).on('click','.present_all',function(){
      var present = $('.present').val();
      //alert(present);
      if (present=='Present') {
        $("input:checked[class*='present']").attr("checked","checked");
      }
      else{
        $("input:checked[class*='present']").removeAttr("checked");
      }
        
     });
   });
 </script>
	<script type="text/javascript">
	$(document).ready(function () {
	  
	  $('#myform').validate({
	    rules: {
	      date: {
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
<script type="text/javascript">
  $('.datepicker2').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'yyyy-mm-dd'
  })
</script>
@endsection