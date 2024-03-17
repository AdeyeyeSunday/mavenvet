<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Picqer;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EmployeeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
public function Employee(){

    $employee=User::get();

return view('Admin.Employee.Employee',['employee'=>$employee]);
}

public function Employee_store(){
    $inputs = request()->validate([
        'user_id'=>'required',
        'Title'=>'required',
        'name_id'=>'required',
        'email'=>'required',
        'number'=>'required',
        'gst_number'=>'required',
        'address'=>'required',
        'city'=>'required',
        'image'=>'required',
        'state'=>'required',
        'country'=>'required',
        'gender'=>'required',
        'position'=>'required',
        'staff_no'=>'required',
        'salary'=>'required'
    ]);

    if(request('image')){
     $inputs['image']= request('image')->store('employee');
    }
    Employee::create($inputs);
    session()->flash('message','Employee Registered');
    return redirect()->route('Admin.Employee.Employee_list');
     }

   public function Employee_list(){
    $employee = Employee::with('user')->where('name_id',auth()->id())->get();
    return view('Admin.Employee.Employee_list',['employee'=>$employee]);
    }

    public function Employee_view($id){

        $employee_view=Employee::with('user')->where('id',$id)->where('user_id',auth()->id())->first();

   return view('Admin.Employee.Employee_view',['employee_view'=>$employee_view]);
    }

    public function Employee_update(Request $request, $id){
        $inputs = request()->validate([
            'email'=>'required',
            'number'=>'required',
            'address'=>'required',
            'position'=>'required',
            'syn_flag'=>'0'
        ]);
        Employee::whereId($id)->update($inputs);
        return redirect()->route('Admin.Employee.Employee_list');
    }

    public function Employee_edit($id){
        $employee_edit =DB::table('employees')->where('id',$id)->where('user_id',auth()->id())->first();
        return view('Admin.Employee.Employee_edit',['employee_edit'=>$employee_edit]);
    }



     public function leave(){
        $employee = Employee::get();
        $leave = DB::table('leaves')->where('user_id',Auth::id())->get();
       return view('Admin.Employee.leave',['employee'=>$employee, 'leave'=>$leave]);
     }


     public function leave_store(){
        $inputs = request()->validate([
            'staff_id'=>'required',
            'user_id'=>'required',
            'type'=>'required',
            'from'=>'required',
            'to'=>'required',
            'description'=>'required',
            'month'=>'required',
            'year'=>'required',
            'status'=>'required'
        ]);
        $leave =  DB::table('leaves')->where('from',$inputs['from'])->where('to',$inputs['to'])->where('description',$inputs['description'])->get();
        if (count($leave)>0) {
            session()->flash('leave','Duplicate Leave Request');
            return back();
        }else{
            Leave::create($inputs);
        }


        session()->flash('leave','Leave Request');
        return back();
     }


     public function leave_list(){


        $leave_list  = DB::table('leaves')->where('status','pending')->get();

        return view('Admin.Employee.leave_list',['leave_list'=>$leave_list]);
     }


      public function leave_edit($id){
        $leave_edit = DB::table('leaves')->where('id',$id)->first();
        return view('Admin.Employee.leave_edit',['leave_edit'=>$leave_edit]);

      }



     public function leave_update(Request $request, $id){

        $leave_update = DB::table('leaves')->where('id',$id)->update(['status'=>'Approved']);
        return redirect()->route('Admin.Employee.leave_list');
     }


     public function leave_decline(Request $request, $id){

        $leave_decline = DB::table('leaves')->where('id',$id)->update(['status'=>'Rejected']);

        return redirect()->route('Admin.Employee.leave_list');
     }




     public function salary_add()
     {
         // Get all employees with their associated users
         $employees = Employee::with('user')->get();
         $daysInMonth = Carbon::now()->daysInMonth;
         // Get the current month and year
         $currentMonth = Carbon::now()->format('F');
         $currentYear = Carbon::now()->year;

         // Retrieve attendance records for the current month
         $attendances = Attendance::where('year', $currentYear)
             ->where('month', $currentMonth)
             ->get();

         // Count the number of times each user attended work
         $attendanceCounts = [];
         $lateCounts = [];

         foreach ($attendances as $attendance) {
             $userId = $attendance->user_id;

             if (isset($attendanceCounts[$userId])) {
                 $attendanceCounts[$userId]++;
             } else {
                 $attendanceCounts[$userId] = 1;
             }

             if ($attendance->late_status > 0) {
                // Count late attendance
                if (isset($lateCounts[$userId])) {
                    $lateCounts[$userId]++;
                } else {
                    $lateCounts[$userId] = 1;
                }
            }
         }

         $salaries = User::get();


         return view('Admin.Employee.salary_add', [
             'employees' => $employees,
             'attendanceCounts' => $attendanceCounts,
             'lateCounts'=>$lateCounts,
             'salaries' => $salaries,
             'daysInMonth'=>$daysInMonth
         ]);
     }


     public function salary_store(){
        $salary = request()->validate([
          'user_id'=>'required',
          'Month'=>'required',
          'Amount'=>'required',
          'description'=>'required',
          'year'=>'required'
        ]);
        Salary::create($salary);
        return back();
     }

     public function salary_details(){

        $amount= DB::table('salaries')->where('user_id',Auth::id())->sum('Amount');

     $salary_details = DB::table('salaries')->where('user_id',Auth::id())->get();
     return view('Admin.Employee.salary_details',['salary_details'=>$salary_details,'amount'=>$amount]);
     }


}
