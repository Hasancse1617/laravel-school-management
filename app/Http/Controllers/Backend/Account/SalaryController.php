<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountEmployeeSalary;
use App\Model\EmployeeAttendance;
use App\Model\AccountStudentFee;
use Session;

class SalaryController extends Controller
{
    public function  view()
    {
    	Session::put('page', 'employee_salary');
    	$alldata = AccountEmployeeSalary::all();
    	return view('backend.account.employee.view-salary')->with(compact('alldata'));
    }
    public function add()
    {
    	return view('backend.account.employee.add-salary');
    }
    public function getEmployee(Request $request)
    {
    	$date = date('Y-m',strtotime($request->date));
    	if ($date !=null) {
    		$where[] = ['date','like',$date.'%'];
    	}
    	$data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();
    	$html['thsource'] = '<th>SL</th>';
    	$html['thsource'] .= '<th>ID No</th>';
    	$html['thsource'] .= '<th>Employee Name</th>';
    	$html['thsource'] .= '<th>Basic Salary</th>';
    	$html['thsource'] .= '<th>Salary (This month)</th>';
    	$html['thsource'] .= '<th>Select</th>';
    	foreach ($data as $key=> $attend) {
    		$account_salary = AccountEmployeeSalary::where('employee_id',$attend->employee_id)->where('date',$date)->first();
    		//dd($accountstudentFee);
    		if ($account_salary !=null) {
    			$checked = 'checked';
    		}
    		else{
    			$checked = '';
    		}
    		$color = 'success';
    		$totalattend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
    		$absentcount = count($totalattend->where('attend_status','Absent'));
    		$html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
    		$html[$key]['tdsource'] .= '<td>'.$attend['user']['id_no'].'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
    		$html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
    		$html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'TK'.'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
    		$salary = (float)$attend['user']['salary'];
    		$salaryperday = (float)$salary/30;
    		$totalminus = (float)$absentcount*(float)$salaryperday;
    		$totalsalary = (float)$salary - (float)$totalminus;
    		$html[$key]['tdsource'] .= '<td>'.$totalsalary.'<input type="hidden" name="amount[]" value="'.$totalsalary.'" class="form-control" readonly>'.'</td>';
    		$html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="employee_id[]" value="'.$attend->employee_id.'">'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.' style="transform:scale(1.5);margin-left:10px;">'.'</td>';
    	}
    	return response()->json(@$html);
    }
    public function store(Request $request)
    {
    	$date = date('Y-m',strtotime($request->date));
    	AccountEmployeeSalary::where('date',$date)->delete();
    	$checkdata = $request->checkmanage;
    	if ($checkdata !=null) {
    		for ($i = 0; $i < count($checkdata); $i++) {
    			$data = new AccountEmployeeSalary();
    			$data->date = $date;
    			$data->employee_id = $request->employee_id[$checkdata[$i]];
    			$data->amount = $request->amount[$checkdata[$i]];
                $data->save();
    		}
    	}
    	if (!empty(@$data)||empty($checkdata)) {
    		return redirect()->route('accounts.salary.view')->with('success_message','Well done! Successfully updated');
    	}
    	else{
    		return redirect()->back()->with('error_message','Sorry! Data not saved');
    	}
    }
}
