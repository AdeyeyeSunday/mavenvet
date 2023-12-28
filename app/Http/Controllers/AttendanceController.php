<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function attendance_list(){
        $attendance = Attendance::get();



        return view("Admin.attendance.attendance_list",['attendance'=>$attendance]);
    }

    public function attendance(){

        $user = User::get();
        $date = date('d/m/y');
        $attendance = Attendance::where('date',$date)->get();


         return view('Admin.attendance.attendance',['user'=>$user,'attendance'=>$attendance]);
    }


    public function  attendance_store(){
     $attendance = request()->validate([
      'staff_name'=>'required',
      'clockin'=>'required',
      'Time'=>'required',
      'date'=>'required',
      'month'=>'required',
      'year'=>'required'
  ]);

  $staff_name = $attendance['staff_name'];
//   $clockin = $attendance['clockin'];
//   $Time = $attendance['Time'];
//   $date = $attendance['date'];
//   $month = $attendance['month'];
//   $year = $attendance['year'];

  $alreadyclockin = Attendance::where('staff_name',$staff_name)->where('clockin','Clockin')->where('date',date('d/m/y'))->get();
  if(count($alreadyclockin) == 0){
    Attendance::create($attendance);
  }
  else{
    Attendance::where('staff_name',$staff_name)->where('clockin','Clockin')->where('date',date('d/m/y'))->update([
        'clockout'=>'clockout','Timeout'=>date(" H:i A")
    ]);


  }
  session()->flash('message','Time Mark');

  return back();
    }

}

