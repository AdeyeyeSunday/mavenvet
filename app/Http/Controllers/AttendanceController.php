<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function attendance_list(){
        $attendance1 = Attendance::get();
        $attendance = Attendance::get();
        $daysInMonth = Carbon::now()->daysInMonth;
        $attendanceCounts = [];
        $lateCounts = [];

        foreach ($attendance as $attendance) {
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
        return view("Admin.attendance.attendance_list",['attendance1'=>$attendance1, 'attendanceCounts' => $attendanceCounts,
        'lateCounts'=>$lateCounts,'daysInMonth'=>$daysInMonth]);
    }

    public function attendance(){
        $user = User::get();
        $date = date('d/m/y');
        $attendance = Attendance::where('date',$date)->get();
         return view('Admin.attendance.attendance',['user'=>$user,'attendance'=>$attendance]);
    }
    public function  attendance_store(Request $request){
     $attendance = request()->validate([
      'staff_name'=>'required',
      'clockin'=>'required',
      'Time'=>'required',
      'date'=>'required',
      'month'=>'required',
      'year'=>'required',
      'user_id'=>'required'
  ]);

  $staff_name = $attendance['staff_name'];
  date_default_timezone_set('Africa/Lagos');
  $alreadyclockin = Attendance::where('staff_name',$staff_name)->where('clockin','Clockin')->where('date',date('d/m/y'))->get();
  if(count($alreadyclockin) == 0){
    if (strtotime(date('H:i')) > strtotime(Auth::user()->resumption_time)) {
        $attendance = new Attendance();
        $attendance->staff_name = request()->input('staff_name');
        $attendance->clockin = request()->input('clockin');
        $attendance->Time = request()->input('Time');
        $attendance->date = request()->input('date');
        $attendance->month = request()->input('month');
        $attendance->late_comment = request()->input('late_comment');
        $attendance->year = request()->input('year');
        $attendance->late_status = 1;
        $attendance->user_id =request()->input('user_id');
        $attendance->save();
    }else{
        Attendance::create($attendance);
    }
  }
  else{
    Attendance::where('staff_name',$staff_name)->where('clockin','Clockin')->where('date',date('d/m/y'))->update([
        'clockout'=>'clockout','Timeout'=>date(" H:i A")
    ]);
  }

  return response()->json([
    'status'=>200,
    'message'=>"You clocked in successfully"
]);


//   session()->flash('message','Time mark');

//   return back();
    }

}

