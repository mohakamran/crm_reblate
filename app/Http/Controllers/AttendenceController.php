<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;


use Carbon\Carbon;


class AttendenceController extends Controller
{
    // add attendence of employeee
    public function addAttendence(Request $request) {
        $emp_code = $request->emp_code;

        $emp_date = $request->emp_date;
        $check = DB::table('attendence')->where('emp_id',$emp_code)->where('date',$emp_date)->first();
        if($check) {
            return response()->json(['success' =>false,'message'=>true]);
        }
        $emp_check_in = $request->emp_check_in;
        $emp_check_out = $request->emp_check_out;

        $emp_break_start = $request->emp_break_start;
        $emp_break_end = $request->emp_break_end;

        $emp_overtime_start = $request->emp_overtime_start;
        $emp_overtime_end = $request->emp_overtime_end;



        $emp_check_in = Carbon::createFromFormat('h:i A', $request->emp_check_in);
        $emp_check_out = Carbon::createFromFormat('h:i A', $request->emp_check_out);



        // Check if Carbon instances were successfully created
        if ($emp_check_in && $emp_check_out) {
                // Calculate total work hours
                $totalWorkHours = $emp_check_out->diffInMinutes($emp_check_in) / 60;

                // Handle break time subtraction if break times are provided
                if ($request->emp_break_start && $request->emp_break_end) {
                    $breakStart = Carbon::createFromFormat('h:i A', $request->emp_break_start);
                    $breakEnd = Carbon::createFromFormat('h:i A', $request->emp_break_end);

                    // Verify if break times are valid
                    if ($breakStart && $breakEnd) {
                        if ($breakStart >= $emp_check_in && $breakEnd <= $emp_check_out) {
                            $totalWorkHours -= $breakEnd->diffInMinutes($breakStart) / 60;
                        }
                    }
                }

                // Format total worked hours into HH:MM format
                $hours = floor($totalWorkHours);
                $minutes = ($totalWorkHours - $hours) * 60;
                $total_daily_work_hours = sprintf('%02d:%02d', $hours, $minutes);
        }

        $total_overtime = "";

        if ($request->emp_overtime_start && $request->emp_overtime_end) {
            $checkIn = Carbon::createFromFormat('h:i A', $request->emp_overtime_start);
            $checkOut = Carbon::createFromFormat('h:i A', $request->emp_overtime_end);
            $totalWorkHours = $checkOut->diffInMinutes($checkIn) / 60; // Convert minutes to hours

            $hours = floor($totalWorkHours);
            $minutes = ($totalWorkHours - $hours) * 60;
            $total_overtime = sprintf('%02d:%02d', $hours, $minutes);
        }

        DB::table('attendence')->insert([
            'emp_id' => $emp_code,
            'check_in_time' => $request->emp_check_in,
            'check_out_time' => $request->emp_check_out,
            'break_start' => $request->emp_break_start,
            'break_end' => $request->emp_break_end,
            'overtime_start' => $request->emp_overtime_start,
            'overtime_end' => $request->emp_overtime_end,
            'check_in_status' => "done",
            'check_out_status' => "done",
            'total_time' => $total_daily_work_hours,
            'total_over_time' => $total_overtime,
            'date' => $emp_date,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return response()->json(['success' =>true,'message'=>false]);
    }
    // overtime start
   public function overTimeStart() {
        $id = Auth()->user()->user_code;
        $emp = DB::table('employees')->where('Emp_Code',$id)->first();
        $currentDateTime = now();
        $dayFullName = $currentDateTime->format('l'); // get full day name
        $todayDate = $currentDateTime->toDateString(); // 'Y-m-d'
        $overTimeStart = $currentDateTime->format('h:i A'); // get time now 11:01 AM/PM

        $overTimeStart = $currentDateTime->format('h:i A'); // get time now 11:01 AM/PM
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
            $check = DB::table('attendence')->orderBy('id','desc')->where('emp_id',$id)->first();
            // dd($check->id);
            if($check!=null && $check->check_out_status =="done") {

                $query =  DB::table('attendence')->where('id', $check->id)->update([
                    'overtime_start' => $overTimeStart,
                ]);
                // dd($query);
                // $success_message = "Successfully Checked In!";


                return redirect('/');
                // return view('emp-dashboard.index',compact('shift_time','success_message'));
            } else {

            // $check_in_already_message = "Employee Not Found!";
            // $check_in_already_message = "";
            return redirect('/');

        }
    }

   }
    // overtime end
        public function overTimeEnd() {
        $id = Auth()->user()->user_code;
        $emp = DB::table('employees')->where('Emp_Code',$id)->first();
        $currentDateTime = now();
        $dayFullName = $currentDateTime->format('l'); // get full day name
        $todayDate = $currentDateTime->toDateString(); // 'Y-m-d'
        $overTimeEnd = $currentDateTime->format('h:i A'); // get time now 11:01 AM/PM

        $overTimeEnd = $currentDateTime->format('h:i A'); // get time now 11:01 AM/PM
        $todayDate = $currentDateTime->toDateString(); // 'Y-m-d'

        if($emp) {
            $shift_time = $emp->Emp_Shift_Time;
            if($shift_time == "Morning") {
                $shift_time = "morning";
            } else {
                $shift_time = "night";
            }
            // dd($shift->Emp_Shift_Time);
            // if($dayFullName == "Sunday" || $dayFullName == "sunday" || $dayFullName == "saturday" || $dayFullName == "Saturday") {
            //   return back();
            // }
            $check = DB::table('attendence')->orderBy('id','desc')->where('emp_id',$id)->first();
            // dd($check);
            if($check!=null && $check->overtime_start !=null) {

                $overtime_start = $check->overtime_start;
                $checkIn = Carbon::createFromFormat('h:i A', $overtime_start);
                $checkOut = Carbon::createFromFormat('h:i A', $overTimeEnd);
                $totalWorkHours = $checkOut->diffInMinutes($checkIn) / 60; // Convert minutes to hours

                $hours = floor($totalWorkHours);
                $minutes = ($totalWorkHours - $hours) * 60;
                $formattedTotalWorkHours = sprintf('%02d:%02d', $hours, $minutes);

                DB::table('attendence')->where('id', $check->id)->update([
                    'overtime_end' => $overTimeEnd,
                    'total_over_time' => $formattedTotalWorkHours,
                ]);

                return redirect('/');
                // return view('emp-dashboard.index',compact('shift_time','success_message'));
            } else {

            return redirect('/');
            }

        }
    }
    // save attendence
        public function saveAttendence(Request $req) {

        // Retrieve the data from the AJAX request
        $check_in = $req->check_in;
        $check_out = $req->check_out;
        $break_start = $req->break_start;
        $break_end = $req->break_end;
        $overtime_start = $req->overtime_start;
        $overtime_end = $req->overtime_end;

       // Create an associative array to represent your JSON object


        $id = $req->id;

        if($break_start == '') {
            $break_start = "00:00";
        }

        if($break_end == '') {
            $break_end = "00:00";
        }

        if($overtime_start != null && $overtime_end != null) {
                $overtime_start = Carbon::createFromFormat('h:i A', $overtime_start);
                $overtime_end = Carbon::createFromFormat('h:i A', $overtime_end);
                // Calculate total work hours
                $totalWorkHoursTime = $overtime_end->diffInMinutes($overtime_start) / 60; // Convert minutes to hours
                $hours_over = floor($totalWorkHoursTime);
                $minutes_over = ($totalWorkHoursTime - $hours_over) * 60;
                $formattedTotalWorkHoursTime = sprintf('%02d:%02d', $hours_over, $minutes_over);

        } else {
            $overtime_start = null;
            $overtime_end = null;
            $formattedTotalWorkHoursTime = null;
        }



        try {
            // Parse the check-in and check-out times
            $checkIn = Carbon::createFromFormat('h:i A', $check_in);
            $checkOut = Carbon::createFromFormat('h:i A', $check_out);





            if ($checkOut < $checkIn) {
                $checkOut->addDay(); // Add a day to check-out time
            }



            // If break times are not empty, adjust the total work hours
            if ($break_start =="" && $break_end == "") {



               $breakStart = Carbon::createFromFormat('h:i A', $break_start);
              $breakEnd = Carbon::createFromFormat('h:i A', $break_end);



                // Ensure break times are within working hours before adjusting
                if ($breakStart >= $checkIn && $breakEnd <= $checkOut) {
                    $totalWorkHours -= $breakEnd->diffInMinutes($breakStart) / 60; // Subtract break time
                }



            } else {
               // Calculate total work hours
               $totalWorkHours = $checkOut->diffInMinutes($checkIn) / 60; // Convert minutes to hours
            }









            // Format total worked hours into HH:MM format
            $hours = floor($totalWorkHours);
            $minutes = ($totalWorkHours - $hours) * 60;
            $formattedTotalWorkHours = sprintf('%02d:%02d', $hours, $minutes);

            if($break_start == "00:00") {
                $break_start = "";
            }
            if($break_end == "00:00") {
                $break_end = "";
            }







            // Update the attendance record in the database
            DB::table('attendence')->where('id', $id)->update([
                'check_in_time' => $check_in,
                'check_out_time' => $check_out,
                'break_start' => $break_start ?: '', // Handle empty values
                'break_end' => $break_end ?: '', // Handle empty values
                'total_time' => $formattedTotalWorkHours,
                'overtime_start' => $overtime_start, // Handle empty values
                'overtime_end' => $overtime_end , // Handle empty values
                'total_over_time' => $formattedTotalWorkHoursTime, // Handle empty values
            ]);
            return response()->json(['message' => 'success']);



        } catch (\Exception $e) {
            \Log::error('Error updating attendance: ' . $e->getMessage()); // Log the error
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating attendance data.',
            ], 500);
        }
    }
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

    // Retrieve data from the request
    $attendence_id = $req->attendence_id;
    $check_in_time = $req->check_in_time;
    $checkout_time = $req->check_out_time;
    $break_start_time = $req->break_start;
    $break_end_time = $req->break_end;

    // Check if check-in and check-out times are null and set them to empty strings if so
    $checkIn = $checkIn ?? "";
    $checkOut = $checkOut ?? "";

   // Parse and format times to 'h:i A' format using Carbon
    $checkIn_format = $check_in_time ? Carbon::parse($check_in_time)->format('h:i A') : '';
$checkOut_format = $checkout_time ? Carbon::parse($checkout_time)->format('h:i A') : '';
$break_start_format = $break_start_time ? Carbon::parse($break_start_time)->format('h:i A') : '';
$break_end_format = $break_end_time ? Carbon::parse($break_end_time)->format('h:i A') : '';

// Calculate total work hours
$checkOut = Carbon::createFromFormat('h:i A', $checkOut_format);
$checkIn = Carbon::createFromFormat('h:i A', $checkIn_format);
$totalWorkHours = $checkOut->diffInMinutes($checkIn) / 60; // Convert minutes to hours


    // Subtract break time if provided
    if ($break_end_time != "" && $break_start_time != "") {
        $break_start = Carbon::createFromFormat('h:i A', $break_start_format);
        $break_end = Carbon::createFromFormat('h:i A', $break_end_format);

        if ($break_start >= $checkIn && $break_end <= $checkOut) {
            $totalWorkHours -= $break_end->diffInMinutes($break_start) / 60; // Subtract break time in hours
        }
    }

    // Format total worked hours into HH:MM format
    $hours = floor($totalWorkHours);
    $minutes = ($totalWorkHours - $hours) * 60;
    $formattedTotalWorkHours = sprintf('%02d:%02d', $hours, $minutes);



    // Update database record
    DB::table('attendence')
        ->where('id', $attendence_id)
        ->update([
            'check_in_time' => $checkIn_format,
            'check_out_time' => $checkOut_format,
            'break_end' => $break_end_format,
            'break_start' => $break_start_format,
            'check_in_status' => "done",
            'check_out_status' => "done",
            'total_time' => $formattedTotalWorkHours
        ]);

    dd("worked");

    // Return a response
    return response()->json(['message' => 'Record updated successfully']);
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
    // a manager and admin can approve or decline
    public function updateLeaveStatus($action, $id) {
        // dd("working");
        // Check if the action is either approve or decline
        if ($action == 'approve') {
            // Process approval logic using $id and $emp_code
            // echo "Emp Code: ".$emp_code;
            // echo "<br> ID : ".$id;
            // echo "<br> Action Code: ".$action;
            DB::table('leaves')->where('id',$id)->update([
                'status'=> 'approved'
            ]);
            return back()->with('message','Leave Approved!');
        } elseif ($action == 'decline') {
            // Process decline logic using $id and $emp_code
            // echo "Emp Code: ".$emp_code;
            // echo "<br> ID : ".$id;
            // echo "<br> Action Code: ".$action;
            DB::table('leaves')->where('id',$id)->update([
                'status'=> 'declined'
            ]);
            return back()->with('message','Leave Declined!');
        }

    }
    public function leaveRequests() {
        $user_type = Auth()->user()->user_type;

        if ($user_type != "" && ($user_type == "manager" || $user_type == "admin")) {
            if ($user_type == "manager") {
                $records = DB::table('leaves')->where('user_type', 'employee')->where('status','pending')->orderBy('id','desc')->get();
            } else {
                $records = DB::table('leaves')->where('status','pending')->get();
            }

            $empLeaveRequests = [];

            foreach ($records as $record) {
                $employee = DB::table('employees')->where('Emp_Code', $record->emp_code)->first();

                if ($employee) {
                    $empLeaveRequests[$employee->Emp_Code][] = [
                        'employee' => $employee,
                        'leave_record' => $record
                    ];
                }
            }

            return view('attendence.approval', compact('empLeaveRequests', 'records'));
        }
    }


    // search employee records
    public function empSearchRecords(Request $req) {

        $Date = $req->daterange;
        $dateRange = explode(' - ', $Date);
        $startDate = Carbon::createFromFormat('m/d/Y', $dateRange[0])->format('Y-m-d');
        $endDate = Carbon::createFromFormat('m/d/Y', $dateRange[1])->format('Y-m-d');

        // dd($date);
        $id = Auth()->user()->user_code;
        // dd($id , $startDate, $endDate,);

        $emp = DB::table('employees')->where('Emp_Code', $id)->first();
        if($emp) {
            if($Date!="") {
                $emp_records = DB::table('leaves')
                ->where('emp_code', $id)
                ->whereBetween('date', [$startDate, $endDate])
                ->get();
                $show_back = "yes";
                return view('attendence.leaves-search',compact('emp_records','show_back'));
            }
        } else {
            return back();
        }
    }
    // employee clicks to see records from employee dashboard
    public function empLeaveRecords() {
        $user_code = Auth()->user()->user_code;
        $emp_records = DB::table('leaves')->where('emp_code',$user_code)->orderBy('id','desc')->get();
        return view('attendence.leaves',compact('emp_records','user_code'));
    }
    // apply for leave admin
    public function empApplyForLeave(Request $request) {

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
    public function viewEachAttendenceEmp($id) {
        // $id = $req->hidden_emp_value;
        if($id) {
            $emp = DB::table('employees')->where('Emp_Code', $id)->first();
            if($emp) {
                $emp_name = $emp->Emp_Full_Name;
                $check_attendence = DB::table('attendence')->where('emp_id', $id)->orderBy('id','desc')->get();
                // dd($check_attendence->date);
                return view('attendence.view-individual',compact('check_attendence','emp','id','emp_name'));
            } else {
                return back();
            }
        }
        return back();

    }
    // search button admin view by name, id or designation
    public function searchEmpAttendenceAdmin(Request $req) {
        $emp_page = $req->emp_page;
        // var_dump($emp_page);
        // exit;
        // emp-page
        //task-page


       $emp_name = $req->emp_name;

        $totalCount = 0;


        $user_type = Auth()->user()->user_type;
        if($user_type == "employee") {
            return view('errors.404');
        }

        // dd($emp_name,$emp_page);

        if($emp_name!=null && $emp_page == "emp-page") {

            $latestEmployees = DB::table('employees')->where('Emp_Status','active')->where('Emp_Full_Name', 'like', '%' . $emp_name . '%')->get();
            $totalCount = DB::table('employees')->where('Emp_Status','active')->where('Emp_Full_Name', 'like', '%' . $emp_name . '%')->count();
            if($latestEmployees != null) {
                $emp="Reblate Solutions Employees";
                return view('emp.view-employees',compact('latestEmployees','emp','totalCount'));
            }
            else {
                $emp="Reblate Solutions Employees";
                $latestEmployees = DB::table('employees')->where('Emp_Status','active')->get();
                $totalCount = DB::table('employees')->where('Emp_Status','active')->count();
                return view('emp.view-employees',compact('latestEmployees','emp','totalCount'));
            }
        }

        if($emp_name!=null && $emp_page == "task-page") {
            // dd('kamran');
            $latestEmployees = DB::table('employees')->where('Emp_Status','active')->where('Emp_Full_Name', 'like', '%' . $emp_name . '%')->get();
            if($latestEmployees != null) {
                return view('tasks.view', compact('latestEmployees'));
            }
            else {
                $latestEmployees = DB::table('employees')->where('Emp_Status','active')->get();
                return view('tasks.view', compact('latestEmployees'));
            }
        }


    }
   // admin can see the the employees card for attendence
   // admin can see the the employees card for attendence
   public function viewEmpAttendence() {
            // Get the current month and year
            $currentMonth = Carbon::now()->format('m');
            $currentYear = Carbon::now()->format('Y');
            $currentmonth = Carbon::now()->format('F');
            $currentyear = Carbon::now()->format('Y');

            // dd($currentMonth,$currentYear );

            // Get the first day of the current month
            $firstDayOfMonth = Carbon::now()->startOfMonth();

            // Get the current date
            $today = Carbon::now()->toDateString();

            $datesForMonth  = $this->getHolidays($currentMonth,$currentYear);
            // dd($get_holidays);
            $numberOfHolidays = count($datesForMonth);
            // dd($numberOfHolidays);

            // total working days
            $total_days = $this->getNumberOfDays($currentMonth,$currentyear);
            // dd($total_days);

            // Query attendance records for the current month up to today's date
            // Query employees and their attendance records for the current month up to today's date
            $emp = DB::table('employees')->where('Emp_Status','active')->get();

            // Initialize an empty array to store attendance records
            $attendances = [];

            // Initialize an empty array to store days
            // Get the number of days in the current month
            $numberOfDaysInMonth = Carbon::now()->daysInMonth;
            // dd($numberOfDaysInMonth);

            // Initialize an empty array to store days
            $daysOfMonth = [];

            // Loop through the days of the month and store each day in the array
            // Loop through the days of the month and store each day in the array
            for ($day = 1; $day <= $numberOfDaysInMonth; $day++) {
                // Create a Carbon instance for the current day of the month
                $currentDate = Carbon::createFromDate($currentYear, $currentMonth, $day);

                // Format the date string into the desired format
                $formattedDate = $currentDate->format('j F l'); // e.g., "1 April Monday"

                // Store the formatted date in the array
                $daysOfMonth[] = $formattedDate;
            }

            // dd($daysOfMonth);

            // Iterate over each active employee to fetch their attendance records
            foreach ($emp as $employee) {
                // Query attendance records for the current month up to today's date for each employee
                $employeeAttendances = DB::table('attendence')
                    ->where('emp_id', $employee->Emp_Code)
                    ->whereYear('date', $currentYear)
                    ->whereMonth('date', $currentMonth)
                    ->whereDate('date', '<=', $today)
                    ->get();

                // Append the attendance records to the $attendances array
                $attendances = array_merge($attendances, $employeeAttendances->toArray());
            }

            $date = Carbon::now();
            $month = $date->format('m');
            $year = $date->format('Y');


            $total_present = $this->getHightestPresent($month,$year);
            $total_absent = $this->getLowestPresent($month,$year);

            $upcomingLeaves = $this->getUpcomingLeaves($month,$year);
            // dd($upcomingLeaves);

            return view('attendence.emp-cards-attendence', compact('upcomingLeaves','total_absent','total_present','total_days','numberOfHolidays','datesForMonth','currentyear','currentMonth','numberOfDaysInMonth','attendances','emp','daysOfMonth'));

   }
   // get Leaves for 3 leaves upcoming
   public function getUpcomingLeaves($month, $year) {
    // Step 1: Get current date and last date of the month
    $currentDate = Carbon::now();
    $lastDateOfMonth = Carbon::create($year, $month)->endOfMonth();

    // Step 2: Fetch leaves between current date and last date of the month with status 'pending'
    if(Auth()->user()->user_type == "manager") {
        $upcomingLeaves = DB::table('leaves')
        ->select('emp_code', DB::raw('count(*) as total_leaves'))
        ->where('date', '>=', $currentDate->toDateString())
        ->where('date', '<=', $lastDateOfMonth->toDateString())
        ->where('status', 'pending')
        ->where('user_type', 'employee')
        ->groupBy('emp_code')
        ->distinct() // Ensure only one record per employee
        ->take(3) // Limit to top 3 employees
        ->get();

    } else {
        $upcomingLeaves = DB::table('leaves')
        ->select('emp_code', DB::raw('count(*) as total_leaves'))
        ->where('date', '>=', $currentDate->toDateString())
        ->where('date', '<=', $lastDateOfMonth->toDateString())
        ->where('status', 'pending')
        ->groupBy('emp_code')
        ->distinct() // Ensure only one record per employee
        ->take(3) // Limit to top 3 employees
        ->get();
    }


    // Step 3: Return the fetched leaves
    $upcomingLeavesWithNames = collect([]);

    foreach ($upcomingLeaves as $leave) {
        $employee = DB::table('employees')
            ->select('Emp_Full_Name')
            ->where('Emp_Code', $leave->emp_code)
            ->first();

        if ($employee) {
            $upcomingLeavesWithNames->push([
                'Emp_Code' => $leave->emp_code,
                'Name' => $employee->Emp_Full_Name,
                'total_leaves' => $leave->total_leaves,
            ]);
        }
    }


    return $upcomingLeavesWithNames;
}

public function getLowestPresent($month, $year)
{
    // Construct the start and end dates for the given month and year
    $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
    $endDate = $startDate->copy()->endOfMonth();

    // Fetch the top 3 attendance records for the given month and year, along with employee IDs and their attendance counts
    $attendanceCounts = DB::table('attendence')
        ->select('emp_id', DB::raw('COUNT(*) as present_count'))
        ->whereBetween('date', [$startDate, $endDate])
        ->groupBy('emp_id')
        ->orderBy('present_count')
        ->limit(3)
        ->get();

    if ($attendanceCounts->isNotEmpty()) {
        // Iterate over each attendance record to retrieve employee details
        foreach ($attendanceCounts as $key => $attendance) {
            // Get the employee details based on the emp_id
            $employee = DB::table('employees')
                ->select('Emp_Full_Name')
                ->where('Emp_Code', $attendance->emp_id)
                ->first();

            // If employee is not found, remove the attendance record from the array
            if (!$employee) {
                $attendanceCounts->forget($key);
            } else {
                // Add the employee's full name to the attendance record
                $attendance->Emp_Full_Name = $employee->Emp_Full_Name;
            }
        }
    }

    return $attendanceCounts;
}


   public function getHightestPresent($month, $year)
   {
       // Construct the start and end dates for the given month and year
       $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
       $endDate = $startDate->copy()->endOfMonth();

       // Fetch the top 3 attendance records for the given month and year, along with employee IDs and their attendance counts
       $attendanceCounts = DB::table('attendence')
           ->select('emp_id', DB::raw('COUNT(*) as present_count'))
           ->whereBetween('date', [$startDate, $endDate])
           ->groupBy('emp_id')
           ->orderByDesc('present_count')
           ->limit(3)
           ->get();
        if($attendanceCounts->isNotEmpty()) {

                   // Iterate over each attendance record to retrieve employee details
                   foreach ($attendanceCounts as $key => $attendance) {
                    // Get the employee details based on the emp_id
                    $employee = DB::table('employees')
                        ->select('Emp_Full_Name')
                        ->where('Emp_Code', $attendance->emp_id)
                        ->first();

                    // If employee is not found, remove the attendance record from the array
                    if (!$employee) {
                        $attendanceCounts->forget($key);
                    } else {
                        // Add the employee's full name to the attendance record
                        $attendance->Emp_Full_Name = $employee->Emp_Full_Name;
                    }
                }


        }

       return $attendanceCounts;
   }


   public function getNumberOfDays($month,$year) {
    // Initialize counters
    $numWeekdays = 0;

    // Get the total number of days in the month
    $totalDays = Carbon::createFromDate($year, $month)->daysInMonth;

    // Loop through each day in the month
    for ($day = 1; $day <= $totalDays; $day++) {
        $date = Carbon::createFromDate($year, $month, $day);

        // Check if the day is a weekday (Monday to Friday)
        if (!$date->isWeekend()) {
            $numWeekdays++;
        }
    }

    return $numWeekdays;

}

   // get public holidays
   public function getHolidays($month, $year) {
        // Get the first day of the month
        $startDate = Carbon::createFromDate($year, $month, 1);

        // Get the last day of the month
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        // Array to store the list of dates
        $datesForMonth = [];

        // Iterate over each day from the start date to the end date
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            // Check if the current date falls within any of the holiday ranges
            $isHoliday = DB::table('holidays')
                ->where('startDate', '<=', $date->format('m/d/Y'))
                ->where('endDate', '>=', $date->format('m/d/Y'))
                ->exists();

            // If the date is a holiday, add it to the array
            if ($isHoliday) {
                $datesForMonth[] = $date->format('m/d/Y');
            }
        }

        // Return the list of dates for the month
        return  $datesForMonth;
}

   // function to filter overall employees attendence
   public function filterEmpDateWise(Request $req) {


    $date_controller = $req->date_controller;
    $date_parts = explode('-', $date_controller);
    $emp_attendence_month = $date_parts[1];
    $emp_attendance_year = $date_parts[0];

    // dd($emp_attendence_month,$emp_attendance_year );

    // dd($emp_attendance_year);

    $currentmonth = Carbon::now()->format('F');
    $currentyear = Carbon::now()->format('Y');

    if ($emp_attendance_year != null) {
        $currentyear = $emp_attendance_year;
    }

    // If a month is selected, update $currentmonth and get the first day of that month
    if ($emp_attendence_month != null) {
        $currentmonth = Carbon::create()->month($emp_attendence_month)->format('F');
        $firstDayOfMonth = Carbon::createFromDate($emp_attendance_year, $emp_attendence_month, 1);
        $numberOfDaysInMonth = $firstDayOfMonth->daysInMonth;
    } else {
        // Get the first day of the current month
        $emp_attendence_month = Carbon::now()->format('m');
        $firstDayOfMonth = Carbon::now()->startOfMonth();
        $numberOfDaysInMonth = Carbon::now()->daysInMonth;

    }

    // If a year is selected, update $currentyear



        // Get the current date
        // $today = Carbon::now()->toDateString();

        // Query attendance records for the current month up to today's date
        // Query employees and their attendance records for the current month up to today's date
        $emp = DB::table('employees')->where('Emp_Status','active')->get();

        // Initialize an empty array to store attendance records
        $attendances = [];

        // Initialize an empty array to store days
        // Get the number of days in the current month
        ;
        // dd($numberOfDaysInMonth);

        // Initialize an empty array to store days
        $daysOfMonth = [];

        // Loop through the days of the month and store each day in the array
        // Loop through the days of the month and store each day in the array
        for ($day = 1; $day <= $numberOfDaysInMonth; $day++) {
            // Create a Carbon instance for the current day of the month
            $currentDate = Carbon::createFromDate($emp_attendance_year, $emp_attendence_month, $day);

            // Format the date string into the desired format
            $formattedDate = $currentDate->format('j F l'); // e.g., "1 April Monday"

            // Store the formatted date in the array
            $daysOfMonth[] = $formattedDate;
        }

        // dd($daysOfMonth);

        // Iterate over each active employee to fetch their attendance records
        foreach ($emp as $employee) {
            // Query attendance records for the current month up to today's date for each employee
            $employeeAttendances = DB::table('attendence')
                ->where('emp_id', $employee->Emp_Code)
                ->whereYear('date', $emp_attendance_year)
                ->whereMonth('date', $emp_attendence_month)
                // ->whereDate('date', '<=', $today)
                ->get();

            // Append the attendance records to the $attendances array
            $attendances = array_merge($attendances, $employeeAttendances->toArray());
        }

        $currentMonth = $date_parts[1];

        $datesForMonth  = $this->getHolidays($emp_attendence_month,$emp_attendance_year);
        // dd($get_holidays);
        $numberOfHolidays = count($datesForMonth);
        // dd($numberOfHolidays);

        // total working days
        $total_days = $this->getNumberOfDays($emp_attendence_month,$emp_attendance_year);
        // dd($total_days);

        // dd($attendances);

        // Assuming you have retrieved the latest employees elsewhere in your code
        // $latestEmployees = DB::table('employees')->get();
        $total_present = $this->getHightestPresent($emp_attendence_month,$emp_attendance_year);
        $total_absent = $this->getLowestPresent($emp_attendence_month,$emp_attendance_year);
        // dd($total_absent);
        $total_leaves = $this->getHightLeaves($emp_attendence_month,$emp_attendance_year);


    return view('attendence.emp-cards-attendence-search', compact('total_leaves','total_absent','total_present','total_days','numberOfHolidays','datesForMonth','currentyear','currentMonth','numberOfDaysInMonth','attendances','emp','daysOfMonth'));





   }
   // get highest leaves
   public function getHightLeaves($month, $year) {
         // Construct the start and end dates for the given month and year
    $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
    $endDate = $startDate->copy()->endOfMonth();

    // Fetch the top 3 employees with the highest approved leaves for the given month and year
    $highestLeaves = DB::table('leaves')
        ->select('emp_code', DB::raw('COUNT(*) as leaves_count'))
        ->where('status', 'approved')
        ->whereBetween('date', [$startDate, $endDate])
        ->groupBy('emp_code')
        ->orderByDesc('leaves_count')
        ->limit(3)
        ->get();

    if($highestLeaves->isNotEmpty()) {
        // Iterate over each attendance record to retrieve employee details
        foreach ($highestLeaves as $key => $attendance) {
            // Get the employee details based on the emp_id
            $employee = DB::table('employees')
                ->select('Emp_Full_Name')
                ->where('Emp_Code', $attendance->emp_code)
                ->first();
            // If employee is not found, remove the attendance record from the array
            if (!$employee) {
                $highestLeaves->forget($key);
            } else {
                // Add the employee's full name to the attendance record
                $attendance->Emp_Full_Name = $employee->Emp_Full_Name;
            }

        }
    }
     return $highestLeaves;
   }
   // searcj details
   public function searchAttendenceEmp(Request $req) {


    $Date = $req->daterange;
    $dateRange = explode(' - ', $Date);
    $startDate = Carbon::createFromFormat('m/d/Y', $dateRange[0])->format('Y-m-d');
    $endDate = Carbon::createFromFormat('m/d/Y', $dateRange[1])->format('Y-m-d');

    $id = $req->emp_search_date;
    // dd($startDate, $endDate, $id);
    $emp = DB::table('employees')->where('Emp_Code', $id)->first();
    if($emp) {

            $emp_name = $emp->Emp_Full_Name;
            $check_attendence = DB::table('attendence')
        ->where('emp_id', $id)
        ->whereBetween('date', [$startDate, $endDate])
        ->get();
            $show_back = "yes";
            return view('attendence.search-view-individual',compact('id','check_attendence','emp','show_back','emp_name'));
        }
    else {
        return view('errors.404');
    }

   }
   // view attendence details
   public function viewAttendenceEmp() {
    $id = auth()->user()->user_code;
    $emp = DB::table('employees')->where('Emp_Code', $id)->first();
    if($emp) {
                $check_attendence = DB::table('attendence')
                    ->where('emp_id', $id)
                    ->orderBy('date', 'desc') // Order by date in descending order
                    ->get();
        // foreach ($check_attendence as $attendance) {
        //     echo "<br>".$attendance->date;
        // }
        // exit;
        $emp_name = $emp->Emp_Full_Name;
        return view('attendence.view-individual',compact('check_attendence','id','emp_name','emp' ));
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

        // if ($dayFullName == "Sunday" || $dayFullName == "sunday" || $dayFullName == "Saturday" || $dayFullName == "saturday") {
        //     // $check_in_already_message = "No Break Start/End on Saturday and Sunday!";
        //     // return view('attendence.index', compact('shift_time', 'check_in_already_message'));
        //     return back();
        // }

        if ($shift_time == "Morning") {
            $shift_time = "morning";
        } else {
            $shift_time = "night";
        }

        $check = DB::table('attendence')->where('emp_id', $id)->orderBy('id','desc')->first();
        // dd($check->id);

        if($check->break_end !=null) {
            return redirect('/');
        }

        DB::table('attendence')->where('id', $check->id)->update([

            'break_end' => $breakStartTime,

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
            // if($dayFullName == "Sunday" || $dayFullName == "sunday" || $dayFullName == "saturday" || $dayFullName == "Saturday") {
            //     // $check_in_already_message = "No Break Start/End on Saturday and Sunday!";
            //     // return view('attendence.index',compact('shift_time','check_in_already_message'));
            //     return back();
            // }
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

            $check = DB::table('attendence')->where('emp_id',$id)->where('check_in_status','done')->orderBy('id', 'desc')->first();
            // dd($check);
            if($check ==null) {
                // $check_in_already_message = "You did not Check In, Please Check In first!";
                // return view('attendence.index',compact('shift_time','check_in_already_message'));
                return back();
            }

            if($check->break_start !=null) {
                return redirect('/');
            }

            $break_start_id = $check->id;
            // dd($break_start_id);

            DB::table('attendence')->where('id',$break_start_id)->update([
                'break_start' => $breakStartTime,
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
            // if($dayFullName == "Sunday" || $dayFullName == "sunday" || $dayFullName == "saturday" || $dayFullName == "Saturday") {
            //   return back();
            // }
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
        // $checkOutTime = "4:15 AM"; // get time now 11:01 AM/PM

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
                // dd("good");
                $shift_time = "night";
                // dd($id);
                // $yesterday = Carbon::yesterday(); // Get yesterday's date
                $check_night = DB::table('attendence')
                ->where('emp_id', $id)
                ->orderBy('id', 'desc')->first();

                $check_night_id = $check_night->id;

                // dd($check_night->check_in_status);

                if ($check_night) {
                    if ($check_night->check_in_status == "done" && $check_night->check_out_status == "") {
                        // dd("working status");
                        Session::put('attendence_status', true);
                        Session::put('check_out_time', $checkOutTime);
                        $check_in_time = $check_night->check_in_time;
                        $check_out_time = $checkOutTime;
                        // $check_out_time = "4:15 AM";
                        $break_start_time = $check_night->break_start;
                        $break_end_time = $check_night->break_end;

                        // Assuming $check_in_time and $check_out_time are in the format "h:i A" (e.g., "10:01 PM" and "4:15 AM")
                        $checkIn = Carbon::createFromFormat('h:i A', $check_in_time);
                        $checkOut = Carbon::createFromFormat('h:i A', $check_out_time);

                        // Handle the case where check-out is on the next day
                        if ($checkOut < $checkIn) {
                            $checkOut->addDay(); // Add a day to check-out time
                        }

                        $totalWorkHours = $checkOut->diffInMinutes($checkIn) / 60; // Convert minutes to hours

                        // Assuming $break_start_time and $break_end_time are in the format "h:i A" (e.g., "12:00 PM" and "1:00 PM")
                        if ($break_end_time != "" && $break_start_time != "") {
                            $breakStart = Carbon::createFromFormat('h:i A', $break_start_time);
                            $breakEnd = Carbon::createFromFormat('h:i A', $break_end_time);

                            // Check if break is within working hours
                            if ($breakStart >= $checkIn && $breakEnd <= $checkOut) {
                                $totalWorkHours -= $breakEnd->diffInMinutes($breakStart) / 60; // Subtract break time in hours
                            }
                        }

                        // Format total worked hours into HH:MM format
                        $hours = floor($totalWorkHours);
                        $minutes = ($totalWorkHours - $hours) * 60;
                        $formattedTotalWorkHours = sprintf('%02d:%02d', $hours, $minutes);

                        // Now $formattedTotalWorkHours should reflect the correct total work hours

                        // dd($formattedTotalWorkHours);

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
