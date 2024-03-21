<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;


class AttendenceController extends Controller
{
    // check permission
    public function checkPermission() {
        $user_type = Auth()->user()->user_type;
        if($user_type == "admin" || $user_type == "manager") {
            $user = true;
        } else {
            $user = false;
        }
        return $user;
    }
    // manager and admin can see time sheet
    public function viewTimeSheet() {
        $check_user = $this->checkPermission();

        if ($check_user) {


            // Get current month and year
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            // Fetch active employees
            // $employees = Employee::where('Emp_Status', 'active')->get();
            $employees = DB::table('employees')->where('Emp_Status', 'active')->get();

            $attendanceData = DB::table('attendence')->whereYear('date', $currentYear)->whereMonth('date', $currentMonth)->get()->groupBy('emp_id')->toArray();

            // Create an array of dates for the current month
            $dates = [];
            $daysInMonth = Carbon::now()->daysInMonth;
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $dates[] = Carbon::createFromDate($currentYear, $currentMonth, $i)->toDateString();
            }

            return view('attendence.timesheet', compact('employees', 'attendanceData', 'dates'));
        } else {
            return view('errors.401');
        }
    }


    // get form updated check in, check out, data and save in database
    public function updateEmpAttendenceDetails(Request $req) {
        // dd($req->attendence_id);

        $attendence_id = $req->attendence_id;
        $check_in_time = $req->check_in_time;
        $check_out_time = $req->check_out_time;
        $break_start = $req->break_start;
        $break_end = $req->break_end;
        // DB::table('attendence')->
    }
    // show attendence form
    public function showUpdateAttendenceForm(Request $req){
        $attendence_id = $req->attendence_id;
        $emp_id = $req->emp_id;
        // dd($attendence_id);
        $index = DB::table('attendence')->where('id',$attendence_id)->first();
        // dd($attendece);
        $emp = DB::table('employees')->where('Emp_Code',$emp_id)->first();
        // dd($emp);
        $emp_name = $emp->Emp_Full_Name;
        $Emp_Designation = $emp->Emp_Designation;
        $Emp_Image = $emp->Emp_Image;
        $Emp_Shift_Time = $emp->Emp_Shift_Time;
        $date = $index->date;
        // Convert the date to DateTime object
        $dateObj = new \DateTime($date);
        // Format the date as desired (e.g., "3 March 2024")
        $formattedDate = $dateObj->format('j F Y');
        // dd($formattedDate);
        return view('attendence.show-update-form',compact('attendence_id','emp_id','formattedDate','index','emp_name','Emp_Designation','Emp_Image','Emp_Shift_Time'));
    }
    // approval request
    public function approveLeaveRequest($id) {
        $leave = DB::table('leaves')->where('emp_code',$id)->first();
        if($leave) {
            $remaining = $leave->remaining;
            if($remaining >=1) {
                $remaining = $remaining - 1;
            }
            DB::table('leaves')->where('emp_code',$id)->update([
                'status' => 'approved',
                'remaining' => $remaining
            ]);
            return Redirect::back()->with('success', 'Leave request approved successfully!');
        } else {
            return redirect()->back()->with('error', 'No Leave Records found!');
        }
        // dd($leave);
    }
    // decline request
    public function declineLeaveRequest($id) {
        $leave = DB::table('leaves')->where('emp_code',$id)->first();
        if($leave) {
            DB::table('leaves')->where('emp_code',$id)->update([
                'status' => 'declined'
            ]);
            return Redirect::back()->with('success', 'Leave request declined successfully!');
        } else {
            return redirect()->back()->with('error', 'No Leave Records found!');
        }
    }
    public function leaveRequests() {
        $user_type = Auth()->user()->user_type;
        if ($user_type != "" && $user_type == "manager") {
            $records = DB::table('leaves')->where('user_type', 'employee')->where('status','pending')->get();
            $emp = [];

            foreach ($records as $rec) {
                $employees = DB::table('employees')->where('Emp_Code', $rec->emp_code)->get();

                // Loop through each employee record and append to $emp array
                foreach ($employees as $employee) {
                    $emp[] = $employee;
                }
            }


            // if ($records->isEmpty()) {
            //     dd("empty!");
            // }
            // dd($records);
            return view('attendence.approval', compact('records', 'emp'));
        }
        if ($user_type != "" && $user_type == "admin") {
            $records = DB::table('leaves')->where('status','pending')->get();
            $emp = [];

            foreach ($records as $rec) {
                $employees = DB::table('employees')->where('Emp_Code', $rec->emp_code)->get();

                // Loop through each employee record and append to $emp array
                foreach ($employees as $employee) {
                    $emp[] = $employee;
                }
            }


            // if ($records->isEmpty()) {
            //     dd("empty!");
            // }
            // dd($records);
            return view('attendence.approval', compact('records', 'emp'));
        }
    }
    // search employee records
    public function empSearchRecords(Request $req) {
        $validate = $req->validate([
            'date_controller' => 'required'
        ]);
        $date = $req->date_controller;
        // dd($date);
        $id = Auth()->user()->user_code;

        $emp = DB::table('employees')->where('Emp_Code', $id)->first();
        if($emp) {
            if($date!="") {
                $emp_records = DB::table('leaves')->where('emp_code',$id)->where('date',$date)->get();
                $show_back = "yes";
                return view('attendence.leaves',compact('emp_records','show_back'));
            }
        } else {
            return back();
        }
    }
    // employee clicks to see records from employee dashboard
    public function empLeaveRecords() {
        $user_code = Auth()->user()->user_code;
        $emp_records = DB::table('leaves')->where('emp_code',$user_code)->get();
        return view('attendence.leaves',compact('emp_records','user_code'));
    }
    // apply for leave admin
    public function empApplyForLeave(Request $request) {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'reason' => 'required|string',
        ]);
        // dd("fuc");
        $user_type = Auth()->user()->user_type;

        $date = $request->input('date');
        $reason = $request->input('reason');
        $user_code = Auth()->user()->user_code;
        $status  =  "pending";
        $currentYear = date('Y');
        $dayName = date('l', strtotime($date));
        if($dayName == "Sunday" || $dayName == "Saturday") {
            return response()->json(['message' => "You can not apply for leave on saturday or sunday!"], 200);
        }
        // return response()->json(['message' => $dayName], 200);
        // $check   = DB::table('leaves')->('emp_code',$user_code)->where('year',$currentYear)->first();
        $check = DB::table('leaves')->where('emp_code',$user_code)->where('year',$currentYear)->first();
        if($check == null) {
            DB::table('leaves')->insert([
                'status' => $status,
                'date'   => $date,
                'remaining'   => "15",
                'reason'   => $reason,
                'user_type'   => $user_type,
                'year'   => $currentYear,
                'emp_code'   => $user_code
            ]);
            return response()->json(['message' => 'Leave application submitted successfully.Wait for the approval'], 200);
        }

        if($check->remaining <=0) {
            return response()->json(['message' => 'You have no remaining leaves'], 400);
        }
        else {
            $check = DB::table('leaves')->where('emp_code',$user_code)->where('date',$date)->first();
            if($check) {
                return response()->json(['message' => 'You have already applied for the leave on same date!'], 400);
            } else {
                DB::table('leaves')->insert([
                    'status' => $status,
                    'date'   => $date,
                    'remaining'   => "15",
                    'reason'   => $reason,
                    'user_type'   => $user_type,
                    'year'   => $currentYear,
                    'emp_code'   => $user_code
                ]);
                return response()->json(['message' => 'Leave application submitted successfully.Wait for the approval'], 200);
            }
        }

    }
    // view records of each employee
    public function viewEachAttendenceEmp(Request $req) {
        $id = $req->hidden_emp_value;
        if($id) {
            $emp = DB::table('employees')->where('Emp_Code', $id)->first();
            if($emp) {
                $emp_name = $emp->Emp_Full_Name;
                $check_attendence = DB::table('attendence')->where('emp_id', $id)->get();
                // dd($check_attendence->date);
                return view('attendence.view-individual',compact('check_attendence','id','emp_name'));
            } else {
                return back();
            }
        }
        return back();

    }
    // search button admin view by name, id or designation
    public function searchEmpAttendenceAdmin(Request $req) {
       $emp_id = $req->emp_id;
       $emp_name = $req->emp_name;
       $emp_designation = $req->emp_designation;
       $emp_shift = $req->emp_shift;

       if($emp_id!=null) {
           $latestEmployees = DB::table('employees')->where('Emp_Code',$emp_id)->first();

           if($latestEmployees) {
            $full_name_emp = $latestEmployees->Emp_Full_Name;
            $Emp_Image = $latestEmployees->Emp_Image;
            $Emp_Designation = $latestEmployees->Emp_Designation;
            $Emp_Shift_Time = $latestEmployees->Emp_Shift_Time;
            $Emp_code = $latestEmployees->Emp_Code;
            // dd($Emp_code);
            $data = compact('latestEmployees','full_name_emp','Emp_Designation','Emp_Shift_Time','Emp_code','Emp_Image');
            // dd($Emp_Image);
              return view('attendence.search-results',$data);
           } else {
                $latestEmployees = DB::table('employees')->get();
                $error = "Employee ID Not Found!";
                return view('attendence.emp-cards-attendence',compact('latestEmployees','error'));
           }
       }

       if($emp_name!=null) {
           $latestEmployees = DB::table('employees')->where('Emp_Full_Name', 'like', '%' . $emp_name . '%')->get();
           if($latestEmployees) {
            // $full_name_emp = $latestEmployees->Emp_Full_Name;
            // $Emp_Image = $latestEmployees->Emp_Image;
            // $Emp_Designation = $latestEmployees->Emp_Designation;
            // $Emp_Shift_Time = $latestEmployees->Emp_Shift_Time;
            // $Emp_code = $latestEmployees->Emp_Code;
            // $data = compact('full_name_emp','Emp_Designation','Emp_Shift_Time','Emp_code','Emp_Image');
            return view('attendence.emp-cards-attendence',compact('latestEmployees'));
         } else {
              $latestEmployees = DB::table('employees')->get();
              $error = "Employee Name Not Found!";
              return view('attendence.emp-cards-attendence',compact('latestEmployees','error'));
         }
       }
       if($emp_designation!=null) {
           $latestEmployees = DB::table('employees')->where('Emp_Designation',$emp_designation)->get();
           if($latestEmployees) {
            return view('attendence.emp-cards-attendence',compact('latestEmployees'));
         } else {
              $latestEmployees = DB::table('employees')->get();
              $error = "Employee ID Not Found!";
              return view('attendence.emp-cards-attendence',compact('latestEmployees','error'));
         }

       }

       if($emp_shift!=null) {
        $latestEmployees = DB::table('employees')->where('Emp_Shift_Time',$emp_shift)->get();
        if($latestEmployees) {
            return view('attendence.emp-cards-attendence',compact('latestEmployees'));
        } else {
             $latestEmployees = DB::table('employees')->get();
             $error = "Employee ID Not Found!";
             return view('attendence.emp-cards-attendence',compact('latestEmployees','error'));
        }
    }

       $latestEmployees = DB::table('employees')->get();
       return view('attendence.emp-cards-attendence',compact('latestEmployees'));
    }
   // admin can see the the employees card for attendence
   public function viewEmpAttendence() {
        $latestEmployees = DB::table('employees')->get();
        // dd($latestEmployees);
        if ($latestEmployees) {
            return view('attendence.emp-cards-attendence',compact('latestEmployees'));
        } else {
            return back();
        }
   }
   // searcj details
   public function searchAttendenceEmp(Request $req) {
        $validate = $req->validate([
            'date_controller' => 'required'
        ]);
        $date = $req->date_controller;
        // dd($date);
        $id =  $req->emp_search_date;

        $emp = DB::table('employees')->where('Emp_Code', $id)->first();
        if($emp) {
            if($date!="") {
                $emp_name = $emp->Emp_Full_Name;
                $check_attendence = DB::table('attendence')->where('emp_id',$id)->where('date',$date)->get();
                $show_back = "yes";
                return view('attendence.view-individual',compact('check_attendence','show_back','emp_name'));
            }
        } else {
            return back();
        }

   }
   // view attendence details
   public function viewAttendenceEmp() {
    $id = auth()->user()->user_code;
    $emp = DB::table('employees')->where('Emp_Code', $id)->first();
    if($emp) {
        $check_attendence = DB::table('attendence')->where('emp_id', $id)->where('id','desc')->get();
        // dd($check_attendence->date);
        $emp_name = $emp->Emp_Full_Name;
        return view('attendence.view-individual',compact('check_attendence','id','emp_name' ));
    } else {
        return back();
    }

   }

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
            // $check_in_already_message = "No Break Start/End on Saturday and Sunday!";
            // return view('attendence.index', compact('shift_time', 'check_in_already_message'));
            return back();
        }

        if ($shift_time == "Morning") {
            $shift_time = "morning";
        } else {
            $shift_time = "night";
        }

        $check = DB::table('attendence')->where('emp_id', $id)->first();

        if($check->break_end !="") {
            return back();
        }

        DB::table('attendence')->where('emp_id', $id)->update([
            'emp_id' => $id,
            'break_end' => $breakStartTime,
            'date' => $todayDate
        ]);

        // $success_message = "Your Break Ended at " . $breakStartTime;
        session()->put('break_end_time', $breakStartTime);
        // return view('attendence.index', compact('shift_time', 'success_message'));
        return back();
    } else {
        // $check_in_already_message = "Employee Not Found!";
        // return view('attendence.index', compact('check_in_already_message'));
        return back();
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
                // $check_in_already_message = "No Break Start/End on Saturday and Sunday!";
                // return view('attendence.index',compact('shift_time','check_in_already_message'));
                return back();
            }
            if($shift_time == "Morning") {
                $shift_time = "morning";
                // $currentDateTime = Carbon::now();
                // $currentDateTimeWithAMPM = $currentDateTime->format('h:i A');
                // $startTime = Carbon::createFromTime(13, 15); // 1:15 PM
                // if ($currentDateTime < $startTime) {
                //     $check_in_already_message = "Your Break Time Will Start from 1:15 PM, Current Time, ".$currentDateTimeWithAMPM;
                //     return view('attendence.index',compact('shift_time','check_in_already_message'));
                // }
            } else {
                $shift_time = "night";
                // $currentDateTime = Carbon::now();
                // $currentDateTimeWithAMPM = $currentDateTime->format('h:i A');
                // $startTime = Carbon::createFromTime(21, 30); // 9:30 PM
                // if ($currentDateTime < $startTime) {
                //     $check_in_already_message = "Your Break Time Will Start from 9:30 PM, Current Time, ".$currentDateTimeWithAMPM;
                //     return view('attendence.index',compact('shift_time','check_in_already_message'));
                // }
            }

            $check = DB::table('attendence')->where('emp_id',$id)->where('check_in_status','done')->where('date',$todayDate)->first();
            if($check ==null) {
                // $check_in_already_message = "You did not Check In, Please Check In first!";
                // return view('attendence.index',compact('shift_time','check_in_already_message'));
                return back();
            }

            DB::table('attendence')->where('emp_id',$id)->update([
                'emp_id' => $id,
                'break_start' => $breakStartTime,
                'date' => $todayDate
            ]);
            // $success_message = "Your Break Started at".$breakStartTime;
            session::put('break_start_time',$breakStartTime);
            // return view('attendence.index',compact('shift_time','success_message'));
            return back();

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
               return back();
            }
            $check = DB::table('attendence')->where('emp_id',$id)->where('date', $todayDate)->first();
            if($check!=null && $check->check_in_status =="done") {
                $check_in_already_message = "You have already check In!";
                // return view('attendence.index',compact('shift_time','check_in_already_message'));
                return back();
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
                // $success_message = "Successfully Checked In!";
                Session::put('check_in_time',$checkInTime);
                Session::put('show_check_out', true);
                return redirect('/');
                // return view('emp-dashboard.index',compact('shift_time','success_message'));
            }
        } else {
            Session::put('show_break_end', false);
            Session::put('attendence_status', false);
            Session::put('show_check_out', false);
            // $check_in_already_message = "Employee Not Found!";
            // $check_in_already_message = "";
            return redirect('/');
        }

    }


    public function checkOutTime() {
        $id = Auth()->user()->user_code;
        $emp = DB::table('employees')->where('Emp_Code', $id)->first();
        $currentDateTime = now();
        $dayFullName = $currentDateTime->format('l'); // get full day name
        $todayDate = $currentDateTime->toDateString(); // 'Y-m-d'
        $checkOutTime = $currentDateTime->format('h:i A'); // get time now 11:01 AM/PM
        // $checkOutTime = "6:15 PM"; // get time now 11:01 AM/PM

        if ($emp) {
            $shift_time = $emp->Emp_Shift_Time;
            if ($shift_time == "Morning") {
                $shift_time = "morning";
                $check_morning = DB::table('attendence')->where('date', $todayDate)->where('emp_id', $id)->first();
                $check_morning_id = $check_morning->id;
                if ($check_morning) {
                    if ($check_morning->check_in_status == "done" && $check_morning->check_out_status == "") {

                        Session::put('attendence_status', true);
                        Session::put('check_out_time', $checkOutTime);
                        $check_in_time = $check_morning->check_in_time;
                        $check_out_time = $checkOutTime;
                        $break_start_time = $check_morning->break_start;
                        $break_end_time = $check_morning->break_end;

                        $checkIn = Carbon::createFromFormat('h:i A', $check_in_time);
                        $checkOut = Carbon::createFromFormat('h:i A', $check_out_time);

                        $totalWorkHours = $checkOut->diffInMinutes($checkIn) / 60; // Convert minutes to hours

                        if ($break_end_time != "" && $break_start_time != "") {
                            $breakStart = Carbon::createFromFormat('h:i A', $break_start_time);
                            $breakEnd = Carbon::createFromFormat('h:i A', $break_end_time);

                            if ($breakStart >= $checkIn && $breakEnd <= $checkOut) {
                                $totalWorkHours -= $breakEnd->diffInMinutes($breakStart) / 60; // Subtract break time in hours
                            }
                        }

                        // Format total worked hours into HH:MM format
                        $hours = floor($totalWorkHours);
                        $minutes = ($totalWorkHours - $hours) * 60;
                        $formattedTotalWorkHours = sprintf('%02d:%02d', $hours, $minutes);

                        Session::put('total_hours', $formattedTotalWorkHours);
                        DB::table('attendence')
                            ->where('emp_id', $id)
                            ->where('id',$check_morning_id)
                            ->update([
                                'check_out_time' => $checkOutTime,
                                'check_out_status' => "done",
                                'total_time' => $formattedTotalWorkHours
                            ]);

                        return back();
                    } else {
                        return back();
                    }
                } else {
                    return back();
                }
            } else {
                $shift_time = "night";
                $yesterday = Carbon::yesterday(); // Get yesterday's date
                $check_night = DB::table('attendence')->where('date', $yesterday)->where('emp_id', $id)->first();
                $check_night_id = $check_night->id;
                if ($check_night) {
                    if ($check_night->check_in_status == "done" && $check_night->check_out_status == "") {

                        Session::put('attendence_status', true);
                        Session::put('check_out_time', $checkOutTime);
                        $check_in_time = $check_night->check_in_time;
                        $check_out_time = $checkOutTime;
                        $break_start_time = $check_night->break_start;
                        $break_end_time = $check_night->break_end;

                        $checkIn = Carbon::createFromFormat('h:i A', $check_in_time);
                        $checkOut = Carbon::createFromFormat('h:i A', $check_out_time)->addDay(); // Add a day to checkout time

                        $totalWorkHours = $checkOut->diffInMinutes($checkIn) / 60; // Convert minutes to hours

                        if ($break_end_time != "" && $break_start_time != "") {
                            $breakStart = Carbon::createFromFormat('h:i A', $break_start_time);
                            $breakEnd = Carbon::createFromFormat('h:i A', $break_end_time);

                            if ($breakStart >= $checkIn && $breakEnd <= $checkOut) {
                                $totalWorkHours -= $breakEnd->diffInMinutes($breakStart) / 60; // Subtract break time in hours
                            }
                        }

                        // Format total worked hours into HH:MM format
                        $hours = floor($totalWorkHours);
                        $minutes = ($totalWorkHours - $hours) * 60;
                        $formattedTotalWorkHours = sprintf('%02d:%02d', $hours, $minutes);

                        Session::put('total_hours', $formattedTotalWorkHours);

                        DB::table('attendence')
                            ->where('emp_id', $id)
                            ->where('id',$check_night_id)
                            ->update([
                                'check_out_time' => $checkOutTime,
                                'check_out_status' => "done",
                                'total_time' => $formattedTotalWorkHours
                            ]);

                        return back();

                    } else {
                        return back();
                    }
                } else {
                    return back();
                }
            }
        } else {
            Session::put('show_break_end', false);
            Session::put('attendence_status', false);
            Session::put('show_check_out', false);
            // $check_in_already_message = "Employee Not Found!";
            // $check_in_already_message = "";
            return back();
        }
    }


}
