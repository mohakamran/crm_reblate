<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use App\Models\Employee;
use App\Models\Client;
use DB;

use App\Models\Task;

use GuzzleHttp\Client as GuzzleClient;

use Carbon\Carbon;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Response;


use Illuminate\Support\Str;



class AuthController extends Controller
{
    public function searchFilteredData($dateRange) {
        // Remove the prefix 'date_range='
        $dateRange = str_replace('date_range=', '', $dateRange);

        // Split the string based on the delimiter ' - '
        $dateParts = explode(' - ', $dateRange);

        // Extract start and end dates
        $startDate = $dateParts[0];
        $endDate = $dateParts[1];

        // dd($startDate);

        // $startDate = date_create_from_format('Y-m-d', $startDate)->format('m/d/Y');
        // $endDate = date_create_from_format('Y-m-d', $endDate)->format('m/d/Y');

        // dd($startDate);
        // dd($endDate);

         //get expenses

         $data_chart = [
            'labels' => ['January', 'February', 'March', 'April', 'May'],
            'data' => [65, 59, 80, 81, 56],
        ];

        $emp_count = $this->getEmpCount($startDate,$endDate);
        $client_count = $this->getClientCount($startDate,$endDate);
        $total_revenue = $this->getInvoiceAmountSum($startDate,$endDate);
        $total_revenue = $this->getExchangeRate($total_revenue);

        $usd_pkr_salary = $this->getSalaryAmountSum($startDate,$endDate);
        $usd_pkr_salary = $this->getExchangeRate($usd_pkr_salary);

        $usd_pkr_expenses = $this->getExpenseSum($startDate,$endDate);

        $usd_pkr_expenses = $this->getExchangeRate($usd_pkr_expenses);

        $total_profit = $total_revenue - $usd_pkr_salary - $usd_pkr_expenses;

        // get emp_present_count
        $emp_present_count = $this->empPresentCount($startDate,$endDate);

        // emp_leave_count
        $emp_leave_count = $this->empLeaveCount($startDate,$endDate);

        $emp_absent_count = $emp_count - $emp_present_count - $emp_leave_count;

         // get emp_present_count
        $tasks_count = $this->getTaskCount($startDate,$endDate);
        $total_clients = $this->getTotalClients();

        $currentTasks = $this->getEmpTasks();

        $data = compact('emp_count','client_count','data_chart','total_revenue',
        'usd_pkr_expenses','usd_pkr_salary','total_profit','emp_present_count',
        'emp_leave_count','emp_absent_count','tasks_count','total_clients', 'currentTasks');
        return view('index.search-date-admin',$data);


    }


    // public present count
    public function getTaskCountsInRange($start, $end) {
        // Retrieve counts for total, complete, incomplete, and in-progress tasks within the date range
        $counts = DB::table('tasks')
                    ->select(
                        DB::raw('COUNT(*) as total_tasks'),
                        DB::raw('SUM(CASE WHEN task_status = "completed" THEN 1 ELSE 0 END) as complete_tasks'),
                        DB::raw('SUM(CASE WHEN task_status = "pending" THEN 1 ELSE 0 END) as incomplete_tasks'),
                        DB::raw('SUM(CASE WHEN task_status = "in-progress" THEN 1 ELSE 0 END) as in_progress_tasks')
                    )
                    ->whereBetween('assigned_date', [$start, $end])
                    ->first();

        // Convert the counts object into an array
        $countsArray = (array) $counts;
        return $countsArray;
    }



    // public present count
    public function empLeaveCount($start, $end) {
        $leaveCount = DB::table('leaves')
                        ->whereBetween('date', [$start, $end])
                        ->where('status', 'approved')
                        ->count();
        return $leaveCount;
    }

    // public present count
    public function empPresentCount($start, $end) {
        $presentCount = DB::table('attendence')
                        ->whereBetween('date', [$start, $end])
                        ->where('check_out_status', 'done')
                        ->count();
        return $presentCount;
    }
    // public function to get emp count between two dates
    public function getEmpCount($start, $end) {
        $empCount = DB::table('employees')
            ->count();
        return $empCount;
    }

    public function getSalaryAmountSum($start, $end) {
        $salarySum = DB::table('invoices')
                        ->whereBetween('date', [$start, $end])
                        ->sum('amount');
        return $salarySum;
    }

    // public function to get clients count between two dates
    public function getClientCount($start, $end) {
        $empCount = DB::table('clients')
            ->count();
        return $empCount;
    }
    // public function to get emp count between two dates
    public function getExpenseSum($start, $end) {
        $amountSum = DB::table('expenses')
        ->whereBetween('expense_date', [$start, $end])
        ->sum('expense_amount');
        return  $amountSum;
    }

    public function getInvoiceAmountSum($start, $end) {
        $salarySum = DB::table('invoices')
                        ->whereBetween('date', [$start, $end])
                        ->sum('amount');
        return $salarySum;
    }

    public function unauthorized() {
        return view('errors.401');
    }
    // filter data page of admin
    public function filterDataAdmin(Request $request) {
        $user_type = auth()->user()->user_type;
        // $user_type = "manager";
        if($user_type == "admin") {
            // Assuming $request is an instance of Illuminate\Http\Request
            $dateRange = $request->input('date_range');
            // Process the date range as needed

            // If the date range processing is successful, return success message
            return response()->json(['message' => 'Success']);
        } else {
            // If the user is not an admin, return a view with a 401 error
            return response()->json(['error' => 'Unauthorized'], 401);
        }

    }


    // send OTP to admin
    public function generateIndexView($id) {
        $user_code = auth()->user()->user_code;
    //    dd($user_code);
       return view('auth.otp-page',compact('id'));
    }

    //forget password check
    public function forgetPasswordView(Request $request) {
        $validate = $request->validate([
            'client_email' => 'required',
        ]);
        $user_type = $request->user_type;
        $client_email = $request->client_email;
        if($user_type==""){
            session()->flash('user_role', 'Please select a user type!');
            return back()->withInput(['client_email' => $client_email]);
        }
        if($user_type == "employee") {
            $check = DB::table('users')
            ->where('user_email', $client_email)
            ->where('user_type', 'employee')
            ->first();
            if(!$check) {
                session()->flash('user_role', 'Employee Email not found in Database!');
                return back()->withInput([
                    'client_email' => $client_email,
                    'user_type' => $user_type
                ]);
            }
        }
        if($user_type == "manager") {
            $check = DB::table('users')
            ->where('user_email', $client_email)
            ->where('user_type', 'manager')
            ->first();
            if(!$check) {
                session()->flash('user_role', 'Manager Email not found in Database!');
                return back()->withInput([
                    'client_email' => $client_email,
                    'user_type' => $user_type
                ]);
            }
        }
        if($user_type == "admin") {
            $check = DB::table('users')
            ->where('user_email', $client_email)
            ->where('user_type', 'client')
            ->first();
            if(!$check) {
                session()->flash('user_role', 'Admin Email not found in Database!');
                return back()->withInput([
                    'client_email' => $client_email,
                    'user_type' => $user_type
                ]);
            }
        }
        if($user_type == "client") {
            $check = DB::table('users')
            ->where('user_email', $client_email)
            ->where('user_type', 'client')
            ->first();
            if(!$check) {
                session()->flash('user_role', 'Client Email not found in Database!');
                return back()->withInput([
                    'client_email' => $client_email,
                    'user_type' => $user_type
                ]);
            }
        }

        $mail_subject = "Request for Reset Password";
        // $check = DB::table('users')
        //     ->where('user_email', $client_email)
        //     ->where('user_type', 'client')
        //     ->first();
        $user_code = $check->user_code;
        $user_name = $check->user_name;
         // Define the set of characters to use in the password
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=';
        $randomPassword = Str::random(12, $characters);
        $data = compact('client_email', 'randomPassword','user_name');

        Mail::send('emails.email-reset-template',$data , function ($message) use ($mail_subject, $client_email) {
            $message->to($client_email)
                ->subject($mail_subject);
        });

        DB::table('users')
        ->where('user_code', $user_code)
        ->update([
            'password' => Hash::make($randomPassword)
         ]);

        session()->flash('message', 'We have sent you a new password! Please check inbox.');
        return back();

    }
    // forget password
    public function forgetPassword(){
       return view('auth.forget');
    }
    // client login
    public function loginClient(Request $request){
        $validate = $request->validate([
            'client_email' => 'required',
            'client_password' => 'required',
        ]);
        // $pass = Hash::make($request->client_password);
        // dd($pass);
         // $credentials = $request->only('user_email', 'password');
         $remember = $request->has('remember'); // Check if "Remember Me" is selected

         if (Auth::attempt(['user_email' => $request->client_email, 'password' => $request->client_password],$remember)) {
             // Authentication was successful
            return redirect('/'); // Redirect to the home page
         }

         // Authentication failed
         return redirect()->route('user.client')
                ->withInput(['client_email' => $request->input('client_email')])
                ->with('error', 'Email or Password Incorrect!');
    }
    //employee login
    public function loginEmployee(Request $request) {
        $validate = $request->validate([
            'employee_code' => 'required',
            'user_password' => 'required',
        ]);


        $check_emp = DB::table('users')->where('user_code',$request->employee_code)->first();
        if($check_emp!=null && $check_emp->user_type == "employee") {

             // $credentials = $request->only('user_email', 'password');
            $remember = $request->has('remember'); // Check if "Remember Me" is selected

            if (Auth::attempt(['user_code' => $request->employee_code, 'password' => $request->user_password],$remember)) {
                // Authentication was successful
                return redirect('/'); // Redirect to the home page
            }

            // Authentication failed
            return redirect()->route('user.emp')
                ->withInput(['employee_code' => $request->input('employee_code')])
                ->with('error', 'Employee Code or Password Incorrect!');

        }
        else {
            return redirect()->route('user.emp')
            ->withInput(['employee_code' => $request->input('employee_code')])
            ->with('error', 'You are trying to login on Employee Portal');
        }

    }

    // manager login
    public function LoginManager(Request $request) {
        $validate = $request->validate([
            'employee_code' => 'required',
            'user_password' => 'required',
        ]);


        $check_emp = DB::table('users')->where('user_code',$request->employee_code)->first();
        if($check_emp!=null && $check_emp->user_type == "manager") {

             // $credentials = $request->only('user_email', 'password');
            $remember = $request->has('remember'); // Check if "Remember Me" is selected

            if (Auth::attempt(['user_code' => $request->employee_code, 'password' => $request->user_password],$remember)) {
                // Authentication was successful
                return redirect('/'); // Redirect to the home page
            }

            // Authentication failed
            return redirect()->route('user.manager')
                ->withInput(['employee_code' => $request->input('employee_code')])
                ->with('error', 'Manager Code or Password Incorrect!');

        }
        else {
            return redirect()->route('user.manager')
            ->withInput(['employee_code' => $request->input('employee_code')])
            ->with('error', 'You are trying to login on Manager Portal');
        }
    }

    public function loginAdmin(Request $request) {
        $validate = $request->validate([
            'admin_email' => 'required',
            'user_password' => 'required',
        ]);

        // $pass = Hash::make($request->user_password);
        // dd($pass);

        // $credentials = $request->only('user_email', 'password');
        $remember = $request->has('remember'); // Check if "Remember Me" is selected

        if (Auth::attempt(['user_email' => $request->admin_email, 'password' => $request->user_password],$remember)) {
            // Authentication was successful
            // $user_code = auth()->user()->user_code;
            // dd($user_code);
            // $randomUrl = Str::random(8);
            // return redirect('/send-password/' . $randomUrl);
            return redirect('/'); // Redirect to the home page
        }

        // Authentication failed
        return redirect()->route('user.admin')
               ->withInput(['admin_email' => $request->input('admin_email')])
               ->with('error', 'Email or Password Incorrect!');
    }

    // attenden check employee
    public function indexEmployee()
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
                // return view('attendence.index',compact('shift_time'));

            } else if($check_status->check_in_status == "done" && $check_status->break_start !="" && $check_status->check_out_status =="") {
                // dd("i this is working");
                Session::put('show_break_end', true);
                // return view('attendence.index',compact('shift_time'));
            } else if($check_status->check_in_status == "done"  && $check_status->check_out_status =="done") {
                Session::put('attendence_status', true);

                // return view('attendence.index',compact('shift_time'));
            } else {
                Session::put('show_break_end', false);
                Session::put('attendence_status', false);
                Session::put('show_check_out', false);
                session()->forget('check_in_time');
                session()->forget('break_start_time');
                session()->forget('break_end_time');
                session()->forget('check_out_time');
                // return view('attendence.index',compact('shift_time'));
            }
        } else {
                Session::put('show_break_end', false);
                Session::put('attendence_status', false);
                Session::put('show_check_out', false);
                session()->forget('check_in_time');
                session()->forget('break_start_time');
                session()->forget('break_end_time');
                session()->forget('check_out_time');
                session()->forget('total_hours');
                // return view('attendence.index',compact('shift_time'));
        }
      }
    }

    // get monthwise attendence details
    public function getAttendenceDetails() {
        $user_code = auth()->user()->user_code;
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $attendanceCount = DB::table('attendence')
        ->where('check_in_status', 'done')
        ->where('emp_id', $user_code)
        ->whereMonth('date', $currentMonth)
        ->whereYear('date', $currentYear)
        ->count();

        return $attendanceCount;
    }

    // get current month tasks details
    public function getTasksDetails() {
        $user_code = auth()->user()->user_code;
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $tasks_details = DB::table('tasks')
            ->where('emp_id', $user_code)
            ->whereMonth('assigned_date', $currentMonth)
            ->whereYear('assigned_date', $currentYear)
            ->get();

        // Initialize counters for each task status
        $completedCount = 0;
        $pendingCount = 0;
        $inProgressCount = 0;

        // Iterate through the tasks details and count the occurrences of each status
        foreach ($tasks_details as $task) {
            switch ($task->task_status) {
                case 'completed':
                    $completedCount++;
                    break;
                case 'pending':
                    $pendingCount++;
                    break;
                case 'in-progress':
                    $inProgressCount++;
                    break;
                // Handle other task statuses if needed
                default:
                    // Do nothing or handle appropriately
                    break;
            }
        }

        // Now you have the count of tasks for each status
        return [
            'completed_count' => $completedCount,
            'pending_count' => $pendingCount,
            'in_progress_count' => $inProgressCount
        ];

    }

    // get latest tasks
    public function getLatestTasks() {
        // dd("this");
        $user_code = auth()->user()->user_code;
        $latestTasks = DB::table('tasks')
        ->where('emp_id', $user_code)
        ->latest('id')
        ->take(3)
        ->get();
        return $latestTasks;
    }
    // get latest leaves
    public function totalLeaves() {
        $user_code = auth()->user()->user_code;
        $total_leaves = DB::table('leaves')
            ->where('emp_code', $user_code)
            ->where('status', 'approved')
            ->get();

        if ($total_leaves->isEmpty()) {
            $total_leaves = 0;
        } else {
            $total_leaves = $total_leaves->count();
        }

        return $total_leaves;
    }
    // attendence report
    public function getAttendeceReport() {
        $date = Carbon::now();
        $formattedDate = Carbon::now()->format('Y-m-d');
        // dd($formattedDate);
        $check_data = DB::table('attendence')->where('date',$formattedDate)->where('check_in_status','done')->where('check_out_status','')->get();
        $count = $check_data->count();
        if($count<= 0) {
            $count = 0;
        }
        else {
            $count = $count;
        }
        return $count;
    }

    // get leaves
    public function getLeaveReport() {
        $date = Carbon::now();
        $formattedDate = Carbon::now()->format('Y-m-d');
        // dd($formattedDate);
        $check_data = DB::table('leaves')
                ->where('date', $formattedDate)
                ->whereIn('status', ['pending', 'approved']) // Check for pending or approved status
                ->get();
        $count = $check_data->count();
        if($count<= 0) {
            $count = 0;
        }
        else {
            $count = $count;
        }
        return $count;
    }
    public function indexHomePage() {
        $user_type = auth()->user()->user_type;
        // dd($user_type);
        $user_code = auth()->user()->user_code;
        if($user_type == "employee") {
            $employees = Employee::all();
            $emp_count = count($employees);
            // dd($count);
            $clients = Client::all();
            $client_count = count($clients);

            // create session for
            $check_permissions = DB::table('table_login_details')->where('emp_code',$user_code)->where('employee_type','employee')->first();
            // dd($check_permissions);
            if($check_permissions) {
                Session::put('employees_access', $check_permissions->employees_access);
                Session::put('expenses_access', $check_permissions->expenses_access);
                Session::put('clients_access', $check_permissions->clients_access);
                Session::put('invoices_access', $check_permissions->invoices_access);
                Session::put('salary_slips_access', $check_permissions->salary_slips_access);
                Session::put('reports_access', $check_permissions->reports_access);
                Session::put('tasks_access', $check_permissions->tasks_access);
                Session::put('attendance_access', $check_permissions->attendance_access);
            }

            $check_shift_time = DB::table('employees')->where('Emp_Code',$user_code)->first();
            if($check_shift_time->Emp_Shift_Time == "Morning") {
                $office_time = DB::table('office_times')->where('shift_type','morning')->first();
            } else {
                $office_time = DB::table('office_times')->where('shift_type','night')->first();
            }

            $office_start_time = $office_time->shift_start;
            $break_start = $office_time->break_start;
            $break_end = $office_time->break_end;
            $office_end_time = $office_time->shift_end;



            // dd($shift->Emp_Shift_Time);
            if($check_shift_time->Emp_Shift_Time == "Morning") {
                // show attendence time
                $todayDate = now()->toDateString();  // Get today's date
                // dd($todayDate);
                // $todayDate = "2024-03-11";
                $attendance = DB::table('attendence')
                ->where('emp_id', $user_code)
                ->where('date', $todayDate)  // Assuming 'created_at' is the timestamp column
                ->orderBy('id', 'desc')
                ->first();
                // dd($attendance);
                if ($attendance && $attendance->check_in_time != null) {
                // If check_in_time exists, set session data and indicate to show the check out button
                    Session::put('check_in_time', $attendance->check_in_time);
                    Session::put('show_check_out', true);
                } else {
                    // If check_in_time does not exist, remove session data and indicate not to show the check out button
                    Session::forget('check_in_time');
                    Session::put('show_check_out', false);
                }


                if ($attendance && $attendance->break_start != null) {
                    Session::put('break_start_time', $attendance->break_start);
                    Session::put('show_break_end',true);
                } else {
                    Session::forget('break_start_time');
                    Session::forget('show_break_end');
                }

                if ($attendance && $attendance->break_end != null) {
                    Session::put('break_end_time', $attendance->break_end);
                } else {
                    Session::forget('break_end_time');
                }


                if ($attendance && $attendance->check_out_time != null) {
                    Session::put('attendence_status', true);
                    Session::put('check_out_time', $attendance->check_out_time);
                } else {
                    Session::put('attendence_status', false);
                    Session::forget('check_out_time');
                }

                if ($attendance && $attendance->total_time != null) {
                Session::put('total_hours', $attendance->total_time);
                } else {
                    Session::forget('total_hours');
                }
            } else {
                // Get the current time
                    $currentTime = Carbon::now();
                    // Define the start and end times of the specified time range in 12-hour format
                    $startTime = Carbon::createFromTimeString("12:00 AM");
                    $endTime = Carbon::createFromTimeString("12:00 PM");

                    // Format the current time in 12-hour format with AM/PM
                    $currentFormattedTime = $currentTime->format("h:i A");
                    // $currentTime = Carbon::createFromFormat('h:i A', "3:00 AM");
                    // dd($currentFormattedTime);
                    // Check if the current time falls within the specified time range
                    // $currentTime = "3:00 AM";
                    if ($currentTime->between($startTime, $endTime)) {
                        // dd("if working" . $currentTime);
                        $yesterdayDate = now()->subDay()->toDateString();
                        $attendance = DB::table('attendence')
                        ->where('emp_id', $user_code)
                        ->where('date', $yesterdayDate)
                        ->orderBy('id', 'desc')
                        ->first();
                    } else {

                        $todayDate = now()->toDateString();
                        // dd($todayDate);
                        $attendance = DB::table('attendence')
                        ->where('emp_id', $user_code)
                        ->where('date', $todayDate)
                        ->orderBy('id', 'desc')
                        ->first();
                    }

                    // $todayDate = "2024-03-12";

                    // Retrieve attendance based on the determined date

                    // dd($attendance);

                    if ($attendance && $attendance->check_in_time != null) {
                        // If check_in_time exists, set session data and indicate to show the check out button
                            Session::put('check_in_time', $attendance->check_in_time);
                            Session::put('show_check_out', true);
                        } else {
                            // If check_in_time does not exist, remove session data and indicate not to show the check out button
                            Session::forget('check_in_time');
                            Session::put('show_check_out', false);
                        }


                        if ($attendance && $attendance->break_start != null) {
                            Session::put('break_start_time', $attendance->break_start);
                            Session::put('show_break_end',true);
                        } else {
                            Session::forget('break_start_time');
                            Session::forget('show_break_end');
                        }

                        if ($attendance && $attendance->break_end != null) {
                            Session::put('break_end_time', $attendance->break_end);
                        } else {
                            Session::forget('break_end_time');
                        }


                        if ($attendance && $attendance->check_out_time != null) {
                            Session::put('attendence_status', true);
                            Session::put('check_out_time', $attendance->check_out_time);
                        } else {
                            Session::put('attendence_status', false);
                            Session::forget('check_out_time');
                        }

                        if ($attendance && $attendance->total_time != null) {
                        Session::put('total_hours', $attendance->total_time);
                        } else {
                            Session::forget('total_hours');
                        }
            }

            //get latest tasks for each employee
            $latest_tasks = $this->getLatestTasks();

            // dd($latest_tasks);

            // get latest records of absent, leaves,
            $total_present_day = $this->getAttendenceDetails();
            // $total_present_day = 10;
            // dd($dat);
            $absent_days = $this->getAbsent();
            // dd($absent_days);
            $total_work_days_in_month = $this->getTotalDaysWork();
            // dd($total_work_days_in_month);
            // $absent_days = $total_work_days_in_month - $total_present_day;
            $total_leaves = $this->totalLeaves();
            // dd($total_leaves);

            // get latest tasks details
            $task_details = $this->getTasksDetails();
            // Extract counts from the returned array
            $completed_count = $task_details['completed_count'];
            $pending_count = $task_details['pending_count'];
            $in_progress_count = $task_details['in_progress_count'];
            // Sample task data
            $task_data = [
                ['', $completed_count, $pending_count, $in_progress_count]
            ];

            $emp_det = DB::table('employees')->where('Emp_Code',$user_code)->first();
            $t_date = Carbon::now()->format('l, d F Y');
            $emp_img = $emp_det->Emp_Image;
            Session::put('emp_img', $emp_img);
            $data = [
                'absent_days' => $absent_days,
                'total_present_day' => $total_present_day,
                'office_start_time' => $office_start_time,
                'break_start' => $break_start,
                'break_end' => $break_end,
                'office_end_time' => $office_end_time,
                'emp_count' => $emp_count,
                'client_count' => $client_count,
                'emp_det' => $emp_det,
                't_date' => $t_date,
                'completed_count' => $completed_count,
                'pending_count' =>$pending_count,
                'in_progress_count' =>$in_progress_count,
                'latest_tasks' => $latest_tasks,
                'total_leaves' => $total_leaves,
            ];

            return view('index.emp-dashboard',$data);
        }
        else if($user_type == "manager") {
            $employees = Employee::all();
            $emp_count = count($employees);
            // dd($count);
            $clients = Client::all();
            $client_count = count($clients);


            // create session for
            $check_permissions = DB::table('table_login_details')->where('emp_code',$user_code)->where('employee_type','manager')->first();
            // dd($check_permissions);
            if($check_permissions) {
                Session::put('employees_access', $check_permissions->employees_access);
                Session::put('expenses_access', $check_permissions->expenses_access);
                Session::put('clients_access', $check_permissions->clients_access);
                Session::put('invoices_access', $check_permissions->invoices_access);
                Session::put('salary_slips_access', $check_permissions->salary_slips_access);
                Session::put('reports_access', $check_permissions->reports_access);
                Session::put('tasks_access', $check_permissions->tasks_access);
                Session::put('attendance_access', $check_permissions->attendance_access);
            }


            $check_shift_time = DB::table('employees')->where('Emp_Code',$user_code)->first();
            if($check_shift_time->Emp_Shift_Time == "Morning") {
                $office_time = DB::table('office_times')->where('shift_type','morning')->first();
            } else {
                $office_time = DB::table('office_times')->where('shift_type','night')->first();
            }

            $office_start_time = $office_time->shift_start;
            $break_start = $office_time->break_start;
            $break_end = $office_time->break_end;
            $office_end_time = $office_time->shift_end;

            // dd($shift->Emp_Shift_Time);
            if($check_shift_time->Emp_Shift_Time == "Morning") {
                // show attendence time
                $todayDate = now()->toDateString();  // Get today's date
                // dd($todayDate);
                // $todayDate = "2024-03-11";
                $attendance = DB::table('attendence')
                ->where('emp_id', $user_code)
                ->where('date', $todayDate)  // Assuming 'created_at' is the timestamp column
                ->orderBy('id', 'desc')
                ->first();
                // dd($attendance);
                if ($attendance && $attendance->check_in_time != null) {
                // If check_in_time exists, set session data and indicate to show the check out button
                    Session::put('check_in_time', $attendance->check_in_time);
                    Session::put('show_check_out', true);
                } else {
                    // If check_in_time does not exist, remove session data and indicate not to show the check out button
                    Session::forget('check_in_time');
                    Session::put('show_check_out', false);
                }


                if ($attendance && $attendance->break_start != null) {
                    Session::put('break_start_time', $attendance->break_start);
                    Session::put('show_break_end',true);
                } else {
                    Session::forget('break_start_time');
                    Session::forget('show_break_end');
                }

                if ($attendance && $attendance->break_end != null) {
                    Session::put('break_end_time', $attendance->break_end);
                } else {
                    Session::forget('break_end_time');
                }


                if ($attendance && $attendance->check_out_time != null) {
                    Session::put('attendence_status', true);
                    Session::put('check_out_time', $attendance->check_out_time);
                } else {
                    Session::put('attendence_status', false);
                    Session::forget('check_out_time');
                }

                if ($attendance && $attendance->total_time != null) {
                Session::put('total_hours', $attendance->total_time);
                } else {
                    Session::forget('total_hours');
                }
            } else {
                // Get the current time
                    $currentTime = Carbon::now();
                    // Define the start and end times of the specified time range in 12-hour format
                    $startTime = Carbon::createFromTimeString("12:00 AM");
                    $endTime = Carbon::createFromTimeString("12:00 PM");

                    // Format the current time in 12-hour format with AM/PM
                    $currentFormattedTime = $currentTime->format("h:i A");
                    // $currentTime = Carbon::createFromFormat('h:i A', "3:00 AM");
                    // dd($currentFormattedTime);
                    // Check if the current time falls within the specified time range
                    // $currentTime = "3:00 AM";
                    if ($currentTime->between($startTime, $endTime)) {
                        // dd("if working" . $currentTime);
                        $yesterdayDate = now()->subDay()->toDateString();
                        $attendance = DB::table('attendence')
                        ->where('emp_id', $user_code)
                        ->where('date', $yesterdayDate)
                        ->orderBy('id', 'desc')
                        ->first();
                    } else {

                        $todayDate = now()->toDateString();
                        // dd($todayDate);
                        $attendance = DB::table('attendence')
                        ->where('emp_id', $user_code)
                        ->where('date', $todayDate)
                        ->orderBy('id', 'desc')
                        ->first();
                    }

                    // $todayDate = "2024-03-12";

                    // Retrieve attendance based on the determined date

                    // dd($attendance);

                    if ($attendance && $attendance->check_in_time != null) {
                        // If check_in_time exists, set session data and indicate to show the check out button
                            Session::put('check_in_time', $attendance->check_in_time);
                            Session::put('show_check_out', true);
                        } else {
                            // If check_in_time does not exist, remove session data and indicate not to show the check out button
                            Session::forget('check_in_time');
                            Session::put('show_check_out', false);
                        }


                        if ($attendance && $attendance->break_start != null) {
                            Session::put('break_start_time', $attendance->break_start);
                            Session::put('show_break_end',true);
                        } else {
                            Session::forget('break_start_time');
                            Session::forget('show_break_end');
                        }

                        if ($attendance && $attendance->break_end != null) {
                            Session::put('break_end_time', $attendance->break_end);
                        } else {
                            Session::forget('break_end_time');
                        }


                        if ($attendance && $attendance->check_out_time != null) {
                            Session::put('attendence_status', true);
                            Session::put('check_out_time', $attendance->check_out_time);
                        } else {
                            Session::put('attendence_status', false);
                            Session::forget('check_out_time');
                        }

                        if ($attendance && $attendance->total_time != null) {
                        Session::put('total_hours', $attendance->total_time);
                        } else {
                            Session::forget('total_hours');
                        }
            }

            //get latest tasks for each employee
            $latest_tasks = $this->getLatestTasks();

            // get latest records of absent, leaves,
            $total_present_day = $this->getAttendenceDetails();
            // $total_present_day = 10;
            // dd($dat);
            $absent_days = $this->getAbsent();
            // dd($absent_days);
            $total_work_days_in_month = $this->getTotalDaysWork();
            // dd($total_work_days_in_month);
            // $absent_days = $total_work_days_in_month - $total_present_day;
            $total_leaves = $this->totalLeaves();
            // dd($total_leaves);

            // get latest tasks details
            $task_details = $this->getTasksDetails();
            // Extract counts from the returned array
            $completed_count = $task_details['completed_count'];
            $pending_count = $task_details['pending_count'];
            $in_progress_count = $task_details['in_progress_count'];
            // Sample task data
            $task_data = [
                ['', $completed_count, $pending_count, $in_progress_count]
            ];

            $emp_det = DB::table('employees')->where('Emp_Code',$user_code)->first();
            $t_date = Carbon::now()->format('l, d F Y');
            $emp_img = $emp_det->Emp_Image;
            Session::put('emp_img', $emp_img);

            // get total revenue record (USD)
            $total_revenue = $this->getTotalRevenue();
            // dd($total_revenue);
            // get total salary (PKR)
            $total_salary = $this->getTotalSalary();
            // get total expense (PKR)
            $total_expense = $this->getTotalExpense();
            // get usd to pkr total revenue
            $usd_pkr_expenses = $this->getExchangeRate($total_expense);
            $usd_pkr_salary = $this->getExchangeRate($total_salary);
            // Convert formatted strings back to float values and round to two decimal places
            $usd_pkr_expenses = str_replace(',', '', $usd_pkr_expenses);
            $usd_pkr_salary = str_replace(',', '', $usd_pkr_salary);
            // dd($usd_pkr_salary);
            // Perform arithmetic operation
            $total_profit = $total_revenue - $usd_pkr_expenses - $usd_pkr_salary;
            //  dd($usd_pkr_salary);
            // $total_profit = $this->getExchangeRate($total_profit);
            $usd_pkr_expenses = number_format($usd_pkr_expenses,2);
            $usd_pkr_salary = number_format($usd_pkr_salary,2);

            $total_profit = number_format($total_profit, 2);

            $data = [
                'absent_days' => $absent_days,
                'total_present_day' => $total_present_day,
                'office_start_time' => $office_start_time,
                'break_start' => $break_start,
                'break_end' => $break_end,
                'office_end_time' => $office_end_time,
                'emp_count' => $emp_count,
                'client_count' => $client_count,
                'emp_det' => $emp_det,
                't_date' => $t_date,
                'completed_count' => $completed_count,
                'pending_count' =>$pending_count,
                'in_progress_count' =>$in_progress_count,
                'latest_tasks' => $latest_tasks,
                'total_leaves' => $total_leaves,
                'total_revenue' => $total_revenue,
                'total_salary' => $usd_pkr_salary,
                'usd_expenses' => $usd_pkr_expenses,
                'total_profit' => $total_profit
            ];

            return view('index.manager-dashboard',$data);
        }
        else if($user_type == "admin") {
            $employees = Employee::all();
            $emp_count = count($employees);
            // dd($count);
            $data_chart = [
                'labels' => ['January', 'February', 'March', 'April', 'May'],
                'data' => [65, 59, 80, 81, 56],
            ];
            // get total revenue record (USD)
            $total_revenue = $this->getTotalRevenue();
            // dd($total_revenue);
            // get total salary (PKR)
            $total_salary = $this->getTotalSalary();
            // get total expense (PKR)
            $total_expense = $this->getTotalExpense();
            // get usd to pkr total revenue
            $usd_pkr_expenses = $this->getExchangeRate($total_expense);
            $usd_pkr_salary = $this->getExchangeRate($total_salary);
            // Convert formatted strings back to float values and round to two decimal places
            $usd_pkr_expenses = str_replace(',', '', $usd_pkr_expenses);
            $usd_pkr_salary = str_replace(',', '', $usd_pkr_salary);
            // dd($usd_pkr_salary);
            // Perform arithmetic operation
            $total_profit = $total_revenue - $usd_pkr_expenses - $usd_pkr_salary;
            //  dd($usd_pkr_salary);
            // $total_profit = $this->getExchangeRate($total_profit);
            $usd_pkr_expenses = number_format($usd_pkr_expenses,2);
            $usd_pkr_salary = number_format($usd_pkr_salary,2);

            $total_profit = number_format($total_profit, 2);

            // get data montly wise

            // total revenue in pkr
            // $total_revenue_pkr = $usd_pkr_revenue - $total_expense - $total_salary;
            // dd($total_revenue);
            // $clients = DB::table('clients')->get();
            $client_count = $clientCount = DB::table('clients')->count();
            // get attendence report
            $emp_present_count = $this->getAttendeceReport();
            $emp_leave_count = $this->getLeaveReport();
            $emp_absent_count = $emp_count - $emp_present_count - $emp_leave_count;

            // dd($emp_leave_count);
            // $emp_leave_count = 3;
            $tasks_count = $this->getTotalTasks();
            // dd($tasks_count);

            // get employee and tasks
            $currentTasks = $this->getEmpTasks();
            // dd($currentTasks);

            $total_clients = $this->getTotalClients();
            // dd($total_clients);

            // get current  monthly wise expense to show in chart
            // $this->getYearBaseDataChart();

            // get get current  monthly wise expense to show in chart
            $chartData = $this->getYearBaseDataChart();
            // dd($chartData);


            $data = compact('emp_count','client_count','data_chart','total_revenue',
            'usd_pkr_expenses','usd_pkr_salary','total_profit','emp_present_count',
            'emp_leave_count','emp_absent_count','tasks_count','total_clients', 'currentTasks','chartData');
            // $chartData = json_encode($data);
            // $chart_data = compact('total_revenue','usd_pkr_expenses','usd_pkr_salary','total_profit');
            // $chartData = json_encode($chart_data);

            return view('index.index', $data);
        }
        else if($user_type == "client") {
            $employees = Employee::all();
            $emp_count = count($employees);
            // dd($count);
            $clients = Client::all();
            $client_count = count($clients);
            $data = compact('emp_count','client_count');
            return view('index.client-dashboard',$data);
        } else {
            return view('auth.login');
        }

    }

    public function getTotalDaysWork() {
        try {
            // Get current month and year
            $currentMonth = now()->month;
            $currentYear = now()->year;

            // Get the first and last day of the current month
            $firstDayOfMonth = now()->firstOfMonth();
            $lastDayOfMonth = now()->endOfMonth();

            // Initialize count of work days
            $workDayCount = 0;

            // Iterate through each day of the month
            $currentDate = $firstDayOfMonth;
            while ($currentDate <= $lastDayOfMonth) {
                // Check if the current day is a weekday (Monday to Friday)
                if ($currentDate->isWeekday()) {
                    // Increment the count of work days
                    $workDayCount++;
                }
                // Move to the next day
                $currentDate->addDay();
            }

            return $workDayCount;
        } catch (\Exception $e) {
            // Log or handle the exception
            return 0; // or throw $e; depending on your requirements
        }
    }


    // get attendence
    public function getAbsent() {
        try {
            // Get the user code
            $user = auth()->user();
            if (!$user) {
                throw new \Exception("User not authenticated.");
            }
            $user_code = $user->user_code;

            // Get current month and year
            $currentMonth = now()->month;
            $currentYear = now()->year;

            // Get all attendance records for the current month and year
            $attendanceRecords = DB::table('attendence')
                ->where('emp_id', $user_code)
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->get();

                // dd($attendanceRecords);

            // Initialize absent count
            $absentCount = 0;



            // Get the current day
            $currentDay = now()->day;

            // Loop through each day of the month until the previous day of the current date
            for ($day = 1; $day <= $currentDay; $day++) {
                $date = now()->setDay($day);

                if ($date->dayOfWeek === 0 || $date->dayOfWeek === 6) {
                    // If it's a Saturday or Sunday, skip to the next iteration
                    continue;
                }

                // echo "<br> Date: ".$date;

                // Check if there is an attendance record for the current date
                $record = $attendanceRecords->where('date', $date->format('Y-m-d'))->first();

                // If there is no record or check_out_status is null, consider it absent
                if (!$record || is_null($record->check_in_status)) {
                    $absentCount++;
                }
            }

            return $absentCount;
        } catch (\Exception $e) {
            // Log or handle the exception
            return 0; // or throw $e; depending on your requirements
        }
    }


    //get tasks
    public function getEmpTasks() {
        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Retrieve all employees
        $employees = DB::table('employees')->get();

        // Initialize an array to store matched employee data
        $matchedEmployeesData = [];

        // Iterate over each employee
        foreach ($employees as $employee) {
            // Check if there is any task with the employee's code created in the current month
            $task = DB::table('tasks')
                        ->where('emp_id', $employee->Emp_Code)
                        ->whereMonth('task_date', $currentMonth)
                        ->whereYear('task_date', $currentYear)
                        ->first();

            // If a task with the employee's code created in the current month is found, store the employee's data
            if ($task !== null) {
                // Fetching employee's image (assuming Emp_Image is the field for storing image path)
                $employeeImage = $employee->Emp_Image;

                // You may need to adjust these field names according to your database structure
                $matchedEmployeesData[] = [
                    'id' => $employee->Emp_Code,
                    'name' => $employee->Emp_Full_Name,
                    'shift_time' => $employee->Emp_Shift_Time,
                    'image' => $employeeImage, // Assuming Emp_Image contains image path
                    'task_title' => $task->task_title,
                    'task_status' => $task->task_status, // Assuming task_status is the field for task status
                ];
            }
        }

        return $matchedEmployeesData;

    }

    // get currenly
    public function getYearBaseDataChart(){
        // Get the current year
        $currentYear = date('Y');

        // Get the current month
        $currentMonth = date('n');

        // Initialize an array to hold the months and their data
        $data = [
            'labels' => [],
            'sales' => [],
            'expenses' => [],
            'profits' => []
        ];

        // Iterate through each month up to the current month of the year
        for ($month = 1; $month <= $currentMonth; $month++) {
            // Get sales data for the month (assuming it's in USD)
            $sales = DB::table('invoices')
                        ->whereYear('date', $currentYear)
                        ->whereMonth('date', $month)
                        ->sum('amount');

            // Get expenses data for the month in PKR
            $expensesPKR = DB::table('expenses')
                            ->whereYear('expense_date', $currentYear)
                            ->whereMonth('expense_date', $month)
                            ->sum('expense_amount');

            // Convert expenses from PKR to USD
            $expensesUSD = $this->getExchangeRate($expensesPKR);

            // Get salaries data for the month in PKR
            $salariesPKR = DB::table('salaries')
                            ->whereYear('date', $currentYear)
                            ->whereMonth('date', $month)
                            ->sum('amount');



                        // Convert salaries from PKR to USD
            $salariesUSD = number_format($this->getExchangeRate($salariesPKR), 2);

            // Calculate total expenses in USD
            $totalExpensesUSD = number_format(($expensesUSD + $salariesUSD), 2);

            // Calculate profit in USD
            $profit = number_format(($sales - $totalExpensesUSD), 2);

            // Push data into the array
            $data['labels'][] = date('M', mktime(0, 0, 0, $month, 1));
            $data['sales'][] = $sales;
            $data['expenses'][] = $totalExpensesUSD;
            $data['profits'][] = $profit;
        }

        return $data;

    }

    // get total tasks
    public function getTotalClients() {
        $clients = DB::table('clients')->get();
        return $clients;
    }

    // get total tasks
    public function getTotalTasks() {
            // Get the current date
            $currentDate = Carbon::now();

            // Get the current month and year
            $currentMonth = $currentDate->month;
            $currentYear = $currentDate->year;

            // Retrieve counts for total, complete, incomplete, and in-progress tasks
            $counts = DB::table('tasks')
                        ->select(
                            DB::raw('COUNT(*) as total_tasks'),
                            DB::raw('SUM(CASE WHEN task_status = "completed" THEN 1 ELSE 0 END) as complete_tasks'),
                            DB::raw('SUM(CASE WHEN task_status = "pending" THEN 1 ELSE 0 END) as incomplete_tasks'),
                            DB::raw('SUM(CASE WHEN task_status = "in-progress" THEN 1 ELSE 0 END) as in_progress_tasks')
                        )
                        ->whereMonth('assigned_date', $currentMonth)
                        ->whereYear('assigned_date', $currentYear)
                        ->first();

            // Access counts
            $totalTasks = $counts->total_tasks;
            $completeTasks = $counts->complete_tasks;
            $incompleteTasks = $counts->incomplete_tasks;
            $inProgressTasks = $counts->in_progress_tasks;
            // Convert the counts object into an array
            $countsArray = (array) $counts;
            return $countsArray;
            // Return the counts array
        //    dd($countsArray);
            // exit;
    }

    // get totoal revenue
    public function getTotalRevenue() {
        $totalAmount = DB::table('invoices')->sum('amount');
        if($totalAmount <= 0) {
            $totalAmount = 0;
        }
        return $totalAmount;
    }
    // get totoal salary
    public function getTotalSalary() {
        $totalAmount = DB::table('salaries')->sum('amount');
        if($totalAmount <= 0) {
            $totalAmount = 0;
        }
        return $totalAmount;
    }
    // get totoal expense
    public function getTotalExpense() {
        $totalAmount = DB::table('expenses')->sum('expense_amount');
        if($totalAmount <= 0) {
            $totalAmount = 0;
        }
        return $totalAmount;
    }

    // datewise expenses, salaries, data
    public function getData() {
        dd('this');
    }

    public function index() {
        return view('auth.login');
    }
    public function loginIndex(Request $request) {
        $validate = $request->validate([
            'user_email' => 'required|string|email',
            'user_password' => 'required',
        ]);

        // $credentials = $request->only('user_email', 'password');
        $remember = $request->has('remember'); // Check if "Remember Me" is selected

        if (Auth::attempt(['user_email' => $request->user_email, 'password' => $request->user_password],$remember)) {
            // Authentication was successful
            return redirect('/'); // Redirect to the home page
        }

        // Authentication failed
        return redirect()->route('auth.user')
               ->withInput(['user_email' => $request->input('user_email')])
               ->with('error', 'Invalid credentials');


    }
    public function registerUser() {
        $title = "User Registeration";
        $route = "/user-register";
        $btn_text = "Add New User";
        return view('auth.user-register',compact('title','route','btn_text'));
    }

    public function registerUserData(Request $req) {

        $validate = $req->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required |string |email|max:255| unique:users',
            'user_role' => 'required|in:admin,super_admin',
        ]);

        // Define the set of characters to use in the password
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=';
        $randomPassword = Str::random(12, $characters);
        $userEmail  = $req->user_email;
        $userName  = $req->user_name;
        $userRole  = $req->user_role;
        //dd($randomPassword);
        $mail_subject = "New Account Creation";
        if($userRole == "super_admin") {
            $userRole = "Super Admin";
        }
        $data = compact('userName', 'userEmail', 'userRole','randomPassword');

         Mail::send('auth.email-template',$data , function ($message) use ($mail_subject, $userEmail) {
            $message->to($userEmail)
                ->subject($mail_subject);
        });


        // hash password
        $hash_password = Hash::make($randomPassword);
        // saving data to database
        $authModel = new User();
        $authModel->user_name = $req->user_name;
        $authModel->user_email = $req->user_email;
        $authModel->password = $hash_password;
        $authModel->user_type = $req->user_role;
        $authModel->save();

        // success message
        session()->flash('success', 'Invitation Sent Successfully!');
        return redirect('/user-register');
    }

    public function logout()
    {
        // session->flush();
        Auth::logout();
        return response()->json(['message' => 'success']);
    }

    public function changePassword() {
        $id = auth()->user()->user_code;
        $user = DB::table('users')->where('user_code',$id)->first();
        if($user) {
            $title= "Change Password";
            $route = "/change-password";
            $btn_text = "Update Password";
            $data = compact('title','user','route','btn_text');
            return view('auth.change-password')->with($data);
        }
        else {
            return redirect('/');
        }

    }

    public function changePasswordData(Request $req){
        $validate = $req->validate([
            'user_name' => 'required|string|max:255',
            // 'user_email' => 'required|string |email|max:255',
            'user_password' => 'sometimes|confirmed',
            'user_password_confirmation' => 'sometimes',
        ]);
        $user_code = auth()->user()->user_code;
        $user = DB::table('users')->where('user_code',$user_code)->first();
        if($user) {
            if($req->user_password == "") {
                $hash_password = $user->password;
            } else {
               // hash password
               $hash_password = Hash::make($req->user_password);
            }

            // udpating data to database
            // $user->user_name = $req->user_name;
            // // $user->user_email = $req->user_email;
            // $user->password = $hash_password;
            // $user->save();
            DB::table('users')->where('user_code',$user_code)->update([
                'user_name'=>$user->user_name,
                'password'=>$hash_password
            ]);
             // success message
            session()->flash('success', 'Account Updated Successfully!');
            return back();
        }
        else {
            return redirect('/');
        }

    }

    public function sendUserResetPassword($id) {

        $user = User::find($id);
        // Define the set of characters to use in the password
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=';
        $randomPassword = Str::random(12, $characters);
        $userName = $user->user_name;
        $userEmail = $user->user_email;
        $mail_subject = "Password Update From Reblate Solutions";
        $data = compact('userName', 'userEmail','randomPassword');
        Mail::send('auth.change-password-template',$data , function ($message) use ($mail_subject, $userEmail) {
        $message->to($userEmail)
            ->subject($mail_subject);
        });
        // hash password
        $hash_password = Hash::make($randomPassword);

        $user->password = $hash_password;
        $user->save();

        return response()->json(['message' => 'success']);

    }

    public function viewUsersData($id) {
       $id = User::find($id);
       if($id) {
            if($id->user_type == "super_admin") {
                $users = User::where('user_type', 'admin')->orderBy('id', 'desc')->get();
                if($users !=null) {
                    $title="All Users";
                    return view('auth.users',compact('users','title'));
                } else {
                    return redirect('/');
                }
            }
            else {
                return redirect('/');
            }
       } else {
          return redirect('/');
       }
    }

    public function deleteUser($id) {
        $user_data = User::find($id);
        if($user_data) {
            $user_data->delete();
            return response()->json(['message' => 'success']);
        } else {
            // return redirect('manage-employees');
            return response()->json(['message' => 'failed']);
        }
    }

    public function changeUserDetails($id) {
        $user = User::find($id);
        if($user) {
            $title= "Account Details";
            $route = "/user-details/".$user->id;
            $btn_text = "Update User";
            $data = compact('title','user','route','btn_text');
            return view('auth.details')->with($data);
        }
        else {
            return redirect('/');
        }
    }

    public function changeUserDetailsData($id, Request $req) {
        $validate = $req->validate([
            'user_role' => 'required|in:admin,super_admin'
        ]);
        $user = User::find($id);
        if($user) {

            $mail_subject = "Reblate Solutions Account Update";
            $userRole = $req->user_role;
            $userRoleOld = $user->user_type;
            if($userRoleOld == "super_admin") {
                $userRoleOld = "Super Admin";
            }
            if($userRole == "super_admin") {
                $userRole = "Super Admin";
            }

            $userName = $user->user_name;
            $userEmail = $req->user_hidden_email;
            $data = compact('userName', 'userEmail', 'userRole','userRoleOld');


              Mail::send('auth.change-role-template',$data , function ($message) use ($mail_subject, $userEmail) {
            $message->to($userEmail)
                ->subject($mail_subject);
           });


            // udpating data to database
            $user->user_type = $userRole;
            $user->save();
             // success message
            session()->flash('success', 'Role Updated Successfully!');
            return back();
        }
        else {
            return redirect('/');
        }
    }

    // login employee view
    public function viewLoginEmployee() {
        return view('auth.emp-login');
    }

    //  client login
    public function viewLoginClient() {
        return view('auth.client-login');
    }
    // admin login view
    public function viewLoginAdmin() {
        return view('auth.admin-login');
    }
    // manager login
    public function viewLoginManager() {
        return view('auth.manager-login');
    }

    //get exchange rate prices
    public function getExchangeRate($amount) {
        $client = new GuzzleClient(); // Use the alias GuzzleClient
        $response = $client->get('https://open.er-api.com/v6/latest/USD');
        $data = json_decode($response->getBody(), true);

        // Get the exchange rate for PKR
        $usdToPkrRate = $data['rates']['PKR'];

        // Convert PKR to USD using the reciprocal of the exchange rate
        $pkrToUsdRate = 1 / $usdToPkrRate;

        // Convert amount from PKR to USD
        $amountInUSD = $amount * $pkrToUsdRate;

        return $amountInUSD;
    }

}
