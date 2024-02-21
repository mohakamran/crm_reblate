<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Carbon;


class AttendenceController extends Controller
{

   public function breakEnd(){
    $id = auth()->user()->user_code;
    $emp = DB::table('employees')->where('Emp_Code', $id)->first();

    if ($emp) {
        $todayDate = now()->format('Y-m-d');
        $shift_time = $emp->Emp_Shift_Time;
        $currentDateTime = now();
        $dayFullName = $currentDateTime->format('l'); // get full day name
        $breakStartTime = $currentDateTime->format('h:i A');

        if ($dayFullName == "Sunday" || $dayFullName == "sunday" || $dayFullName == "Saturday" || $dayFullName == "saturday") {
            $check_in_already_message = "No Break Start/End on Saturday and Sunday!";
            return view('attendence.index', compact('shift_time', 'check_in_already_message'));
        }

        if ($shift_time == "Morning") {
            $shift_time = "morning";
        } else {
            $shift_time = "night";
        }

        DB::table('attendence')->where('emp_id', $id)->update([
            'emp_id' => $id,
            'break_end' => $breakStartTime,
            'date' => $todayDate
        ]);

        $success_message = "Your Break Ended at " . $breakStartTime;
        session()->put('break_end_time', $breakStartTime);
        return view('attendence.index', compact('shift_time', 'success_message'));
    } else {
        $check_in_already_message = "Employee Not Found!";
        return view('attendence.index', compact('check_in_already_message'));
    }


   }
   public function breakStart() {

      $id = Auth()->user()->user_code;
      $emp = DB::table('employees')->where('Emp_Code',$id)->first();
      if($emp) {
            $todayDate = today()->format('Y-m-d');
            $shift_time = $emp->Emp_Shift_Time;
            $currentDateTime = now();
            $dayFullName = $currentDateTime->format('l'); // get full day name
            $breakStartTime = $currentDateTime->format('h:i A');
            // $dayFullName = "Sunday";
             // dd($shift->Emp_Shift_Time);
            if($dayFullName == "Sunday" || $dayFullName == "sunday" || $dayFullName == "saturday" || $dayFullName == "Saturday") {
                $check_in_already_message = "No Break Start/End on Saturday and Sunday!";
                return view('attendence.index',compact('shift_time','check_in_already_message'));
            }
            if($shift_time == "Morning") {
                $shift_time = "morning";
                $currentDateTime = Carbon::now();
                $currentDateTimeWithAMPM = $currentDateTime->format('h:i A');
                $startTime = Carbon::createFromTime(13, 15); // 1:15 PM
                if ($currentDateTime < $startTime) {
                    $check_in_already_message = "Your Break Time Will Start from 1:15 PM, Current Time, ".$currentDateTimeWithAMPM;
                    return view('attendence.index',compact('shift_time','check_in_already_message'));
                }
            } else {
                $shift_time = "night";
                $currentDateTime = Carbon::now();
                $currentDateTimeWithAMPM = $currentDateTime->format('h:i A');
                $startTime = Carbon::createFromTime(21, 30); // 9:30 PM
                if ($currentDateTime < $startTime) {
                    $check_in_already_message = "Your Break Time Will Start from 9:30 PM, Current Time, ".$currentDateTimeWithAMPM;
                    return view('attendence.index',compact('shift_time','check_in_already_message'));
                }
            }

            $check = DB::table('attendence')->where('emp_id',$id)->where('check_in_status','done')->where('date',$todayDate)->first();
            if($check ==null) {
                $check_in_already_message = "You did not Check In! First CheckIn!";
                return view('attendence.index',compact('shift_time','check_in_already_message'));
            }

            DB::table('attendence')->where('emp_id',$id)->update([
                'emp_id' => $id,
                'break_start' => $breakStartTime,
                'date' => $todayDate
            ]);
            $success_message = "Your Break Started at".$breakStartTime;
            session::put('break_start_time',$breakStartTime);
            return view('attendence.index',compact('shift_time','success_message'));

      } else {
        $check_in_already_message = "Employee Not Found!";
        $check_in_already_message = "";
        return view('attendence.index',compact('shift_time','check_in_already_message'));
      }
   }


    public function index()
    {
        // Session::put('attendence_status', false);
      $id = Auth()->user()->user_code;
      $currentDateTime = now();
      $dayFullName = $currentDateTime->format('l'); // get full day name
      $todayDate = $currentDateTime->toDateString(); // 'Y-m-d'
      // check employee shift time
      $emp = DB::table('employees')->where('Emp_Code',$id)->first();
      if($emp) {
        $shift_time = $emp->Emp_Shift_Time;
        if($shift_time == "Morning") {
            $shift_time = "morning";
        } else {
            $shift_time = "night";
        }
        $check_status = DB::table('attendence')->where('emp_id',$id)->where('date',$todayDate)->first();
        // dd($check_status);
        if($check_status!=null) {
            if($check_status->check_in_status == "done" && $check_status->break_start =="" && $check_status->check_out_status =="") {
                // $show_check_out = "yes";
                // dd("this working");
                Session::put('show_check_out', true);
                // dd("yes show");
                return view('attendence.index',compact('shift_time'));
            } else if($check_status->check_in_status == "done" && $check_status->break_start !="" && $check_status->check_out_status =="") {
                // dd("i this is working");
                Session::put('show_break_end', true);
                return view('attendence.index',compact('shift_time'));
            } else if($check_status->check_in_status == "done" && $check_status->break_end !="" &&  $check_status->break_start !="" && $check_status->check_out_status =="done") {
                Session::put('attendence_status', true);

                return view('attendence.index',compact('shift_time'));
            } else {
                Session::put('show_break_end', false);
                Session::put('attendence_status', false);
                Session::put('show_check_out', false);
                session()->forget('check_in_time');
                session()->forget('break_start_time');
                session()->forget('break_end_time');
                session()->forget('check_out_time');
                return view('attendence.index',compact('shift_time'));
            }
        } else {
                Session::put('show_break_end', false);
                Session::put('attendence_status', false);
                Session::put('show_check_out', false);
                session()->forget('check_in_time');
                session()->forget('break_start_time');
                session()->forget('break_end_time');
                session()->forget('check_out_time');
                return view('attendence.index',compact('shift_time'));
        }
      }




    }



    public function checkInTime() {
        $id = Auth()->user()->user_code;
        $emp = DB::table('employees')->where('Emp_Code',$id)->first();
        $currentDateTime = now();
        $dayFullName = $currentDateTime->format('l'); // get full day name
        $todayDate = $currentDateTime->toDateString(); // 'Y-m-d'
        $checkInTime = $currentDateTime->format('h:i A'); // get time now 11:01 AM/PM
        // dd($dayFullName);
        // $dayFullName = "Saturday";
        //  get today date
        $checkInTime = $currentDateTime->format('h:i A'); // get time now 11:01 AM/PM
        $todayDate = $currentDateTime->toDateString(); // 'Y-m-d'

        if($emp) {
            $shift_time = $emp->Emp_Shift_Time;
            if($shift_time == "Morning") {
                $shift_time = "morning";
            } else {
                $shift_time = "night";
            }
            // dd($shift->Emp_Shift_Time);
            if($dayFullName == "Sunday" || $dayFullName == "sunday" || $dayFullName == "saturday" || $dayFullName == "Saturday") {
                $check_in_already_message = "You can not check-in On Saturday and Sunday!";
                return view('attendence.index',compact('shift_time','check_in_already_message'));
            }
            $check = DB::table('attendence')->where('emp_id',$id)->where('date', $todayDate)->first();
            if($check!=null && $check->check_in_status =="done") {
                $check_in_already_message = "You have already check In!";
                return view('attendence.index',compact('shift_time','check_in_already_message'));
            } else {
                DB::table('attendence')->insert([
                    'emp_id' => $id,
                    'check_in_time' => $checkInTime,
                    'check_out_time' => '',
                    'check_in_status' => 'done',
                    'check_out_status' => '',
                    'break_start' => '',
                    'break_end' => '',
                    'total_time' => '',
                    'date' => $todayDate
                ]);
                $success_message = "Successfully Checked In!";
                Session::put('check_in_time',$checkInTime);
                Session::put('show_check_out', true);
                return view('attendence.index',compact('shift_time','success_message'));
            }
        } else {
            Session::put('show_break_end', false);
            Session::put('attendence_status', false);
            Session::put('show_check_out', false);
            $check_in_already_message = "Employee Not Found!";
            $check_in_already_message = "";
            return view('attendence.index',compact('shift_time','check_in_already_message'));
        }

    }


    public function checkOutTime() {
        $id = Auth()->user()->user_code;
        $emp = DB::table('employees')->where('Emp_Code',$id)->first();
        $currentDateTime = now();
        $dayFullName = $currentDateTime->format('l'); // get full day name
        $todayDate = $currentDateTime->toDateString(); // 'Y-m-d'
        $checkOutTime = $currentDateTime->format('h:i A'); // get time now 11:01 AM/PM
        if($emp) {
            $shift_time = $emp->Emp_Shift_Time;
            if($shift_time == "Morning") {
                $shift_time = "morning";
                $check_morning = DB::table('attendence')->where('date',$todayDate)->where('emp_id',$id)->first();
                if($check_morning) {
                    if($check_morning->break_start !="" && $check_morning->break_end !="" && $check_morning->check_in_status =="done"  ) {
                        DB::table('attendence')
                        ->where('emp_id', $id) // Filter the query to only update rows where emp_id matches $id
                        ->update([
                            'check_out_time' => $checkOutTime,
                            'check_out_status' => "done",
                        ]);
                        Session::put('attendence_status', true);
                        Session::put('check_out_time', $checkOutTime);
                        return redirect('/mark-attendence');
                    } else {
                        $check_in_already_message = "You can not check out!";
                        return view('attendence.index',compact('shift_time','check_in_already_message'));
                    }
                } else {
                    $check_in_already_message = "You can not check out!";
                    return view('attendence.index',compact('shift_time','check_in_already_message'));
                }
            } else {
                $shift_time = "night";
                $today = Carbon::today();
                $yesterday = $today->subDay();
                $check_night = DB::table('attendence')->where('date',$yesterday)->where('emp_id',$id)->first();
                if($check_night) {
                        if($check_night->break_start !="" && $check_night->break_end !="" && $check_night->check_in_status =="done"  ) {
                            DB::table('attendence')
                            ->where('emp_id', $id) // Filter the query to only update rows where emp_id matches $id
                            ->update([
                                'check_out_time' => $checkOutTime,
                                'check_out_status' => "done",
                            ]);
                            Session::put('attendence_status', true);
                            Session::put('check_out_time', $checkOutTime);
                            return redirect('/mark-attendence');
                        } else {
                            $check_in_already_message = "You can not check out!";
                            return view('attendence.index',compact('shift_time','check_in_already_message'));
                        }
                } else {
                    $check_in_already_message = "You can not check out!";
                    return view('attendence.index',compact('shift_time','check_in_already_message'));
                }
            }
        } else {
            Session::put('show_break_end', false);
            Session::put('attendence_status', false);
            Session::put('show_check_out', false);
            $check_in_already_message = "Employee Not Found!";
            // $check_in_already_message = "";
            return view('attendence.index',compact('shift_time','check_in_already_message'));
        }

    }
}
