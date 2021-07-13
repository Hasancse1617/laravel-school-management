<!-- Sidebar Menu -->
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
  <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
  
  @if(Auth::user()->role == 'Admin')
  @if(Session::get('page')=="viewuser")
   <?php $active = "active"; $open = "menu-open"; ?>
  @else
   <?php $active = ""; $open = ""; ?>
  @endif
  <li class="nav-item has-treeview {{$open}}">

    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage User
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="viewuser")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('users.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>View User</p>
        </a>
      </li>
    </ul>
  </li>
  @endif
   @if(Session::get('page')=="profile" || Session::get('page')=="editpassword")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Profile
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="profile")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('profiles.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Your Profile</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="editpassword")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('profiles.password.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Change Password</p>
        </a>
      </li>
    </ul>
  </li>

   @if(Session::get('page')=="student_class"||Session::get('page')=="year"||Session::get('page')=="student_group"||Session::get('page')=="student_shift"||Session::get('page')=="fee_category"||Session::get('page')=="fee_amount"||Session::get('page')=="exam_type"||Session::get('page')=="exam_type"||Session::get('page')=="subject"||Session::get('page')=="assign_subject"||Session::get('page')=="designation")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Setup
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="student_class")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('setups.student.class.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Student Class</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="year")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('setups.student.year.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>View Year</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="student_group")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('setups.student.group.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Student Group</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="student_shift")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('setups.student.shift.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Student Shift</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="fee_category")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('setups.fee.category.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Fee Category</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="fee_amount")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('setups.fee.amount.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Fee Amount</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="exam_type")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('setups.exam.type.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Exam Type</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="subject")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('setups.subject.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Subject View</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="assign_subject")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('setups.assign.subject.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Assign Subject</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="designation")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('setups.designation.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Designation</p>
        </a>
      </li>
    </ul>
  </li>

     @if(Session::get('page')=="students_reg" || Session::get('page')=="roll_generate"||Session::get('page')=="reg_fee"||Session::get('page')=="month_fee"||Session::get('page')=="exam_fee")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Students
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="students_reg")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('students.reg.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Student Registration</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="roll_generate")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('students.roll.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Roll Generate</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="reg_fee")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('students.reg.fee.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Registration Fee</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="month_fee")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('students.month.fee.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Monthly Fee</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="exam_fee")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('students.exam.fee.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Exam Fee</p>
        </a>
      </li>
    </ul>
  </li>

     @if(Session::get('page')=="employee_reg"||Session::get('page')=="employee_salary"||Session::get('page')=="employee_leave"||Session::get('page')=="employee_attend"||Session::get('page')=="month_salary")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Employee
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="employee_reg")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('employees.reg.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Employee Registration</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="employee_salary")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('employees.salary.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Employee Salary</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="employee_leave")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('employees.leave.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Employee Leave</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="employee_attend")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('employees.attend.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Employee Attendance</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="month_salary")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('employees.monthly.salary.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Employee Monthly Salary</p>
        </a>
      </li>

    </ul>
  </li>

     @if(Session::get('page')=="marks_entry"||Session::get('page')=="marks_edit"||Session::get('page')=="marks_grade")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Marks
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="marks_entry")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('marks.add') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Marks Entry</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="marks_edit")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('marks.edit') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Marks Edit</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="marks_grade")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('marks.grade.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Grade Point</p>
        </a>
      </li>
    </ul>
  </li>

     @if(Session::get('page')=="student_fee"||Session::get('page')=="employee_salary"||Session::get('page')=="other_cost")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Account
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="student_fee")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('accounts.fee.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Student Fee</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="employee_salary")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('accounts.salary.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Employee Salary</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="other_cost")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('accounts.cost.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Others Cost</p>
        </a>
      </li>
    </ul>
  </li>

     @if(Session::get('page')=="month_profit"||Session::get('page')=="marksheet"||Session::get('page')=="attendance"||Session::get('page')=="all_result"||Session::get('page')=="id_card")
      <?php $active = "active"; $open = "menu-open";?>
     @else
      <?php $active = ""; $open = "";?>
    @endif
  <li class="nav-item has-treeview {{$open}}">
    <a href="#" class="nav-link {{ $active }}">
      <i class="nav-icon fas fa-copy"></i>
      <p>
        Manage Report
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        @if(Session::get('page')=="month_profit")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('reports.profit.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Monthly Profit</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="marksheet")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('reports.marksheet.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Marksheet</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="attendance")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('reports.attendance.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Attendance Report</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="all_result")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('reports.result.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Students Result</p>
        </a>
      </li>
      <li class="nav-item">
        @if(Session::get('page')=="id_card")
          <?php $active = "active"; ?>
         @else
          <?php $active = ""; ?>
        @endif
        <a href="{{ route('reports.id-card.view') }}" class="nav-link {{ $active }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Student ID Card</p>
        </a>
      </li>
    </ul>
  </li>

</ul>
</nav>