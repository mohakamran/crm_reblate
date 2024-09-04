<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\URL;

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

public function getTotalRevenueRangeDate($start, $end) {
        // Ensure the start and end dates are correctly formatted
        $totalAmount = DB::table('invoices')
            ->whereBetween('created_at', [$start, $end])
            ->sum('amount');

        return max(0, $totalAmount); // Return total amount, but ensure it's not negative
}

// public function salary start and end date
public function getTotalSalaryRangeDate($start, $end) {
    // Convert inputs to Carbon dates (in ISO 8601 format)
    $startDate = Carbon::parse($start); // Parse start date
    $endDate = Carbon::parse($end);
    $formattedStart = $startDate->format('d/m/Y'); // Format to dd/mm/yyyy
    $formattedEnd = $endDate->format('d/m/Y'); // Format to dd/mm/yyyy
    // dd($formattedStart, $formattedEnd);
    // Additional logic here if needed...

    // Return the formatted dates

    // Parse end date

    // Query to get the total salary where the 'payment_date' is within the specified range
    $totalAmount = DB::table('salaries')
        ->whereBetween('date',[$formattedStart, $formattedEnd])
        ->sum('amount');

        // dd($totalAmount);




    return max(0, $totalAmount); // Ensure non-negative return
}
// expense range date
public function getTotalExpenseRangeDate($start, $end) {
    // Query to sum expenses between the specified start and end dates
    $totalAmount = DB::table('expenses')
        ->whereBetween('expense_date', [$start, $end]) // Modify 'expense_date' to your specific date column
        ->sum('expense_amount'); // 'expense_amount' is the column to be summed

    return max(0, $totalAmount); // Ensure a non-negative return
}

// get range employees
public function getEmployeesRange($start, $end) {


    // Query to count employees between the specified start and end dates
    $empCount = DB::table('employees')
        ->where('Emp_Status', 'active') // Adjust 'hiring_date' to your relevant date column
        ->count();

    // dd($empCount);
    return $empCount;
}
// get range clients
public function getClientRange($start, $end) {

    // Query to count employees between the specified start and end dates
    $clientCount = DB::table('clients')

        ->where('project_type', 'on going') // Adjust 'hiring_date' to your relevant date column
        ->count();

    return $clientCount;
}
// homepage search
public function searchDateManagerHomePage(Request $req) {
    $user = Auth()->user()->user_type;
    // dd($user);
    $user_code = Auth()->user()->user_code;
    if($user == "manager") {
        $date = $req->daterange;
        // Split the date range by the separator " - "
        $date_parts = explode(" - ", $date);

        // Assign start and end dates
        $start_date = $date_parts[0];
        $end_date = $date_parts[1];

        $start_date = \DateTime::createFromFormat('m/d/Y', $start_date);
        $end_date = \DateTime::createFromFormat('m/d/Y', $end_date);

        // Convert to "YYYY-MM-DD" format
        $end_date = $end_date->format('Y-m-d');
        $start_date = $start_date->format('Y-m-d');
        // dd($start_date,$end_date);

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
        $total_revenue = $this->getTotalRevenueRangeDate($start_date,$end_date);
        // dd($total_revenue);
        // dd($total_revenue);
        // get total salary (PKR)
        $total_salary = $this->getTotalSalaryRangeDate($start_date,$end_date);

        // get total expense (PKR)
        // dd($total_salary);
        $total_expense = $this->getTotalExpenseRangeDate($start_date,$end_date);
        // dd($total_expense );
        // // get usd to pkr total revenue
        $usd_pkr_expenses = $this->getExchangeRate($total_expense);
        $usd_pkr_salary = $this->getExchangeRate($total_salary);

        // dd($usd_pkr_expenses,$usd_pkr_salary);
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
        // dd($usd_pkr_salary);
        $client_count = $this->getClientRange($start_date,$end_date);


        $total_profit = number_format($total_profit, 2);


        $emp_count = $this->getEmployeesRange($start_date,$end_date);
        // dd($emp_count, $client_count, $usd_pkr_salary);
        // $client_count = $this->getClientCount($start_date,$end_date);
        $total_revenue = $this->getInvoiceAmountSum($start_date,$end_date);




        $salary_deduct = DB::table('salaries')->orderBy('id','desc')->where('emp_id',$user_code)->first();
                    if($salary_deduct) {
                $salary_deduct = $salary_deduct->deduction;
            }

        $data = [
            'salary_deduct' => $salary_deduct,
            'usd_pkr_expenses' => $usd_pkr_expenses,
            'usd_pkr_salary' => $usd_pkr_salary,
            'absent_days' => $absent_days,
            'total_present_day' => $total_present_day,
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

        return view('index.search-manager-dashboard',$data);



    } else {
        return view('errors.404');
    }
}

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
        $tasks_count = $this->getTaskCountsInRange($startDate,$endDate);
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

    public function showResetForm(Request $request)
{
    // Logic to verify the token
    if (!$request->hasValidSignature()) {
        // If the request does not have a valid signature, return a response indicating an invalid token
        return response()->view('errors.page-expire');
    }

    // If the request has a valid signature, proceed to show the reset password form with the token
    return view('auth.passwords.reset');
}


    // send OTP to admin
    public function generateIndexView($id) {
        $user_code = auth()->user()->user_code;
    //    dd($user_code);
       return view('auth.otp-page',compact('id'));
    }


    // show reset form if signed link is clicked on email
    public function updatePassword(Request $req) {
        $validatedData = $req->validate([
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'user_type' => 'required',
        ], [
            'confirm_password.same' => 'The password and confirm password must match.',
        ]);

        $user = DB::table('users')->where('user_type',$req->user_type)->where('user_email', $req->email)->first();
        if(!$user) {
            session()->flash('user_not_found', 'User Not Found!');
            return back()->withInput();
        }



        DB::table('users')
        ->where('user_type',$req->user_type)->where('user_email', $req->email)
        ->update([
            'password' => Hash::make($req->password),
            'updated_at' => now()
         ]);

         session()->flash('password_update', 'Password Updated Successfully!');
         return back();

    }

    // creae temp link
    public function createLink() {
        $token="204sols";
        $url = URL::temporarySignedRoute('temp.link', now()->addSeconds(30), ['token' => $token]);
        echo "<a href='".$url."' >Link</a>";
    }

    public function seeLink(Request $req) {
        if ($req->hasValidSignature()) {
            dd("Accepted");
        } else {
            return view('errors.401');
        }
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


        $url = URL::temporarySignedRoute(
            'password.reset.link', now()->addMinutes(10)
        );


        $mail_subject = "Request for Reset Password";
        // $check = DB::table('users')
        //     ->where('user_email', $client_email)
        //     ->where('user_type', 'client')
        //     ->first();
        $user_code = $check->user_code;
        $user_name = $check->user_name;

        $data = compact('url','client_email','user_name');

        Mail::send('emails.email-reset-template',$data , function ($message) use ($mail_subject, $client_email) {
            $message->to($client_email)
                ->subject($mail_subject);
        });

        // DB::table('users')
        // ->where('user_code', $user_code)
        // ->update([
        //     'password' => Hash::make($randomPassword)
        //  ]);

        session()->flash('message', 'We have sent you password reset link! Please check your email inbox or see in spam.');
        return back();

    }
    // forget password
    public function forgetPassword(){
        // Generate a signed URL valid for 10 minutes



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
        // dd($check_emp);
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
        // if($request->admin_email == "admin123@gmail.com" && $request->user_password == "Admin@123") {
        //     return redirect('/');
        // }

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
        // Get current month and year
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $user_code = auth()->user()->user_code;
        $total_leaves = DB::table('leaves')
            ->where('emp_code', $user_code)
            ->whereMonth('date', $currentMonth)
            ->whereYear('date', $currentYear)
            ->where('status', 'approved')
            ->sum('totalNumber');

            $total_leaves = DB::table('leaves')
            ->where('emp_code', $user_code)
            ->where('status', 'pending')
            ->whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->sum('totalNumber');


        return $total_leaves ?? 0;
    }
    // get total pending
    public function totalPending() {
         // Get current month and year
         $currentMonth = now()->month;
         $currentYear = now()->year;

         $user_code = auth()->user()->user_code;
         $total_leaves = DB::table('leaves')
        ->where('emp_code', $user_code)
        ->where('status', 'pending')
        ->whereYear('date', $currentYear)
        ->whereMonth('date', $currentMonth)
        ->sum('totalNumber');

         return $total_leaves ?? 0;
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
        $todayMonthDay = now()->format('m-d');
        // Fetch employees with birthdays today
        $emp_birthday = DB::table('employees')
        ->where('Emp_Status', 'active')
        ->whereRaw('DATE_FORMAT(emp_birthday, "%m-%d") = ?', [$todayMonthDay])
        ->select('emp_birthday', 'Emp_Full_Name','Emp_Image','id') // Adjust columns as needed
        ->get();



        if($user_type == "employee") {
            $active_emp = DB::table('employees')
            ->where('Emp_Code', $user_code)
            ->where('Emp_Status', 'disable')
            ->first();

        if ($active_emp) {
            // If $active_emp is null, it means no active employee found
            // Sending the message
            Auth::logout();
            return back()->with('error', 'Your account is not active. Please Contact Admin! ');
        }
            $employees = Employee::all();
            $emp_count = count($employees);
            // dd($count);
            $clients = Client::all();
            $client_count = count($clients);

                Session::forget('employees_access');
                Session::forget('expenses_access');
                Session::forget('clients_access');
                Session::forget('invoices_access');
                Session::forget('salary_slips_access');
                Session::forget('reports_access');
                Session::forget('tasks_access');
                Session::forget('attendance_access');



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

                // dd($attendance);

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

                Session::forget('show_over_time_end');
                Session::forget('overtime_start');
                Session::forget('overtime_end');
                Session::forget('overtime_status');
                Session::forget('total_over_time');


                if ($attendance && $attendance->check_out_time != null) {
                    Session::put('attendence_status', true);
                    Session::put('check_out_time', $attendance->check_out_time);
                    if($attendance && $attendance->overtime_start !=null && $attendance->overtime_end ==null) {
                        // dd('working if');
                        Session::put('show_over_time_end',true);
                        Session::put('overtime_status', false);
                        Session::put('overtime_start', $attendance->overtime_start);

                    }
                    else if($attendance && $attendance->overtime_end !=null && $attendance && $attendance->overtime_start !=null && $attendance->overtime_end ==null)
                     {
                        // dd('else if');
                        Session::put('overtime_end', $attendance->overtime_end);
                        Session::put('show_over_time_end',false);
                        Session::put('overtime_status', false);

                    }
                    else if($attendance && $attendance->overtime_start ==null && $attendance->overtime_end == null) {
                        // dd('working all null');
                        Session::put('show_over_time_end',false);
                        Session::put('overtime_status', false);
                        // dd(Session::get('show_over_time_end'));
                    }
                     else {
                        // dd('else');
                        Session::put('overtime_start', $attendance->overtime_start);
                        Session::put('overtime_end', $attendance->overtime_end);
                        Session::put('total_over_time', $attendance->total_over_time);
                        Session::put('show_over_time_end',false);
                        Session::put('overtime_status', true);
                        // dd('else working');
                    }
                    // dd(Session::get('show_over_time_end'));

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

                        Session::forget('show_over_time_end');
                        Session::forget('overtime_start');
                        Session::forget('overtime_end');
                        Session::forget('overtime_status');
                        Session::forget('total_over_time');

                        if ($attendance && $attendance->check_out_time != null) {
                            Session::put('attendence_status', true);
                            Session::put('check_out_time', $attendance->check_out_time);
                            if($attendance && $attendance->overtime_start !=null && $attendance->overtime_end ==null) {
                                // dd('working if');
                                Session::put('show_over_time_end',true);
                                Session::put('overtime_status', false);
                                Session::put('overtime_start', $attendance->overtime_start);

                            }
                            else if($attendance && $attendance->overtime_end !=null && $attendance && $attendance->overtime_start !=null && $attendance->overtime_end ==null)
                             {
                                // dd('else if');
                                Session::put('overtime_end', $attendance->overtime_end);
                                Session::put('show_over_time_end',false);
                                Session::put('overtime_status', false);

                            }
                            else if($attendance && $attendance->overtime_start ==null && $attendance->overtime_end == null) {
                                // dd('working all null');
                                Session::put('show_over_time_end',false);
                                Session::put('overtime_status', false);
                                // dd(Session::get('show_over_time_end'));
                            }
                             else {
                                // dd('else');
                                Session::put('overtime_start', $attendance->overtime_start);
                                Session::put('overtime_end', $attendance->overtime_end);
                                Session::put('total_over_time', $attendance->total_over_time);
                                Session::put('show_over_time_end',false);
                                Session::put('overtime_status', true);
                                // dd('else working');
                            }
                            // dd(Session::get('show_over_time_end'));

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
            $salary_deduct = DB::table('salaries')->orderBy('id','desc')->where('emp_id',$user_code)->first();
              if($salary_deduct) {
                $salary_deduct = $salary_deduct->deduction;
            }

            $currentMonth = Carbon::now()->format('m');
            $currentYear = Carbon::now()->format('Y');

            $datesForMonth  = $this->getHolidays($currentMonth,$currentYear);
            // dd($get_holidays);
            $numberOfHolidays = count($datesForMonth);



            $total_work_days_in_month = $total_work_days_in_month - $numberOfHolidays;
            // get pending count for emp
            $total_pending = $this->totalPending();
            // dd($total_pending);

            $shift_emp_time = $check_shift_time->Emp_Shift_Time;

            $holidays = $this->getHolidaysUpcoming();
            // dd($holidays);


            $salary_month = date('d/m/y');


            $getTotalPresent = $this->getTotalPresent($user_code,$salary_month);
            $total_absents = $getTotalPresent - $total_leaves;
            $getTotalPresent = $getTotalPresent - $total_leaves;


             $total_leaves = $this->getTotalLeaves($user_code,$salary_month);
            //  dd($total_leaves);

             $total_absents = $this->getTotalAbsents($user_code,$salary_month);

            //  dd($total_absents);
             $total_days = $this->getNumberOfDays($salary_month);
            //  dd($total_absents);



            //  dd($getTotalPresent);

             $total_attendence_rate = 0;

            if($total_days ==null) {
                $total_days = 0;
            }

            $total_leaves_last_month = $this->getTotalLeaves($user_code,$salary_month);
            if($total_leaves_last_month <=2) {
                $getTotalPresent = $getTotalPresent + $total_leaves_last_month;
            }

            if($getTotalPresent == null) {
                $getTotalPresent = 0;
            }

            $total_attendence_rate = ($getTotalPresent / $total_days) * 100;
            $total_attendence_rate = number_format($total_attendence_rate,2);

            $total_points = $this->getPointsPerformance($user_code);

            $professional_growth = ($total_points / 50) * 100;
            $professional_growth = number_format($professional_growth,2);

            // dd($professional_growth);
            $over_all_performance = ($professional_growth + $total_attendence_rate) / 2;
            $over_all_performance = number_format($over_all_performance,2);

            // $user_id = auth()->user()->;

            // policies files
            if($check_shift_time->Emp_Shift_Time == "Morning") {
                $files = DB::table('uploads')->whereIn('shift', ['Morning', 'Both'])->orderBy('id','desc')->limit(2)->get();
            } else if($check_shift_time->Emp_Shift_Time == "Night") {
                $files = DB::table('uploads')->whereIn('shift', ['Night', 'Both'])->orderBy('id','desc')->limit(2)->get();
            }



            $notifications = DB::table('notifications')->where('status','unread')->orderBy('id','desc')->where('user_id',auth()->user()->user_code)->get();
            $tasks_notifications = DB::table('notifications')->where('status','unread')->orderBy('id','desc')->where('type','task')->where('user_id',auth()->user()->user_code)->get();
            $to_do_tasks_notifications = DB::table('notifications')->where('status','unread')->orderBy('id','desc')->where('type','to-do-task')->where('user_id',auth()->user()->user_code)->get();
            // dd($notifications);
            $latest_to_do = DB::table('to_do_list')->where('user_code',auth()->user()->user_code)->orderBy('id','desc')->where('status','pending')->get();


            $data = [
                'emp_birthday'=> $emp_birthday,
                'files' =>$files,
                'latest_to_do' => $latest_to_do,
                'to_do_tasks_notifications' => $to_do_tasks_notifications,
                'tasks_notifications' =>$tasks_notifications,
                'notifications' => $notifications,
                'over_all_performance' => $over_all_performance,
                'professional_growth' => $professional_growth,
                'total_attendence_rate' => $total_attendence_rate,
                'holidays' => $holidays,
                'shift_emp_time' => $shift_emp_time,
                'total_pending' => $total_pending,
                'total_work_days_in_month'=>$total_work_days_in_month,
                'absent_days' => $total_absents,
                'total_present_day' => $total_present_day,
                 'salary_deduct' => $salary_deduct,
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

            $active_emp = DB::table('employees')
            ->where('Emp_Code', $user_code)
            ->where('Emp_Status', 'disable')
            ->first();

            if ($active_emp) {
                // If $active_emp is null, it means no active employee found
                // Sending the message
                Auth::logout();
                return back()->with('error', 'Your account is not active. Please Contact Admin');
            }
            $employees = Employee::all();
            $emp_count = count($employees);
            // dd($count);
            $clients = Client::all();
            $client_count = count($clients);

                Session::forget('employees_access');
                Session::forget('expenses_access');
                Session::forget('clients_access');
                Session::forget('invoices_access');
                Session::forget('salary_slips_access');
                Session::forget('reports_access');
                Session::forget('tasks_access');
                Session::forget('attendance_access');


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

                Session::forget('show_over_time_end');
                Session::forget('overtime_start');
                Session::forget('overtime_end');
                Session::forget('overtime_status');
                Session::forget('total_over_time');


                if ($attendance && $attendance->check_out_time != null) {
                    Session::put('attendence_status', true);
                    Session::put('check_out_time', $attendance->check_out_time);
                    if($attendance && $attendance->overtime_start !=null && $attendance->overtime_end ==null) {
                        // dd('working if');
                        Session::put('show_over_time_end',true);
                        Session::put('overtime_status', false);
                        Session::put('overtime_start', $attendance->overtime_start);

                    }
                    else if($attendance && $attendance->overtime_end !=null && $attendance && $attendance->overtime_start !=null && $attendance->overtime_end ==null)
                     {
                        // dd('else if');
                        Session::put('overtime_end', $attendance->overtime_end);
                        Session::put('show_over_time_end',false);
                        Session::put('overtime_status', false);

                    }
                    else if($attendance && $attendance->overtime_start ==null && $attendance->overtime_end == null) {
                        // dd('working all null');
                        Session::put('show_over_time_end',false);
                        Session::put('overtime_status', false);
                        // dd(Session::get('show_over_time_end'));
                    }
                     else {
                        // dd('else');
                        Session::put('overtime_start', $attendance->overtime_start);
                        Session::put('overtime_end', $attendance->overtime_end);
                        Session::put('total_over_time', $attendance->total_over_time);
                        Session::put('show_over_time_end',false);
                        Session::put('overtime_status', true);
                        // dd('else working');
                    }
                    // dd(Session::get('show_over_time_end'));

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


                        Session::forget('show_over_time_end');
                        Session::forget('overtime_start');
                        Session::forget('overtime_end');
                        Session::forget('overtime_status');
                        Session::forget('total_over_time');

                        if ($attendance && $attendance->check_out_time != null) {
                            Session::put('attendence_status', true);
                            Session::put('check_out_time', $attendance->check_out_time);
                            if($attendance && $attendance->overtime_start !=null && $attendance->overtime_end ==null) {
                                // dd('working if');
                                Session::put('show_over_time_end',true);
                                Session::put('overtime_status', false);
                                Session::put('overtime_start', $attendance->overtime_start);

                            }
                            else if($attendance && $attendance->overtime_end !=null && $attendance && $attendance->overtime_start !=null && $attendance->overtime_end ==null)
                             {
                                // dd('else if');
                                Session::put('overtime_end', $attendance->overtime_end);
                                Session::put('show_over_time_end',false);
                                Session::put('overtime_status', false);

                            }
                            else if($attendance && $attendance->overtime_start ==null && $attendance->overtime_end == null) {
                                // dd('working all null');
                                Session::put('show_over_time_end',false);
                                Session::put('overtime_status', false);
                                // dd(Session::get('show_over_time_end'));
                            }
                             else {
                                // dd('else');
                                Session::put('overtime_start', $attendance->overtime_start);
                                Session::put('overtime_end', $attendance->overtime_end);
                                Session::put('total_over_time', $attendance->total_over_time);
                                Session::put('show_over_time_end',false);
                                Session::put('overtime_status', true);
                                // dd('else working');
                            }
                            // dd(Session::get('show_over_time_end'));

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

            $salary_deduct = DB::table('salaries')->orderBy('id','desc')->where('emp_id',$user_code)->first();
              if($salary_deduct) {
                $salary_deduct = $salary_deduct->deduction;
            }

            $currentMonth = Carbon::now()->format('m');
            $currentYear = Carbon::now()->format('Y');

            $datesForMonth  = $this->getHolidays($currentMonth,$currentYear);
            // dd($get_holidays);
            $numberOfHolidays = count($datesForMonth);



            $total_work_days_in_month = $total_work_days_in_month - $numberOfHolidays;

            // get pending count for emp
            $total_pending = $this->totalPending();
            // dd($total_pending);

            $shift_emp_time = $emp_det->Emp_Shift_Time;

            $salary_month = date('d/m/y');


            $getTotalPresent = $this->getTotalPresent($user_code,$salary_month);
            $total_absents = $getTotalPresent - $total_leaves;
            $getTotalPresent = $getTotalPresent - $total_leaves;


             $total_leaves = $this->getTotalLeaves($user_code,$salary_month);
            //  dd($total_leaves);

             $total_absents = $this->getTotalAbsents($user_code,$salary_month);


             $total_days = $this->getNumberOfDays($salary_month);
            //  dd($total_absents);

             $total_attendence_rate = 0;

            if($total_days ==null) {
                $total_days = 0;
            }

            $total_leaves_last_month = $this->getTotalLeaves($user_code,$salary_month);
            if($total_leaves_last_month <=2) {
                $getTotalPresent = $getTotalPresent + $total_leaves_last_month;
            }

            if($getTotalPresent == null) {
                $getTotalPresent = 0;
            }

            $total_attendence_rate = ($getTotalPresent / $total_days) * 100;
            $total_attendence_rate = number_format($total_attendence_rate,2);

            $total_points = $this->getPointsPerformance($user_code);

            $professional_growth = ($total_points / 50) * 100;
            $professional_growth = number_format($professional_growth,2);

            // dd($professional_growth);
            $over_all_performance = ($professional_growth + $total_attendence_rate) / 2;
            $over_all_performance = number_format($over_all_performance,2);

            $notifications = DB::table('notifications')->where('status','unread')->orderBy('id','desc')->where('user_id',auth()->user()->user_code)->get();
            $tasks_notifications = DB::table('notifications')->where('status','unread')->orderBy('id','desc')->where('type','task')->where('user_id',auth()->user()->user_code)->get();
            $to_do_tasks_notifications = DB::table('notifications')->where('status','unread')->orderBy('id','desc')->where('type','to-do-task')->where('user_id',auth()->user()->user_code)->get();
            $holidays = $this->getHolidaysUpcoming();

            // dd($notifications);

            $latest_to_do = DB::table('to_do_list')->where('user_code',auth()->user()->user_code)->orderBy('id','desc')->where('status','pending')->get();

           // policies files
           if($check_shift_time->Emp_Shift_Time == "Morning") {
            $files = DB::table('uploads')->whereIn('shift', ['Morning', 'Both'])->orderBy('id','desc')->limit(2)->get();
        } else if($check_shift_time->Emp_Shift_Time == "Night") {
            $files = DB::table('uploads')->whereIn('shift', ['Night', 'Both'])->orderBy('id','desc')->limit(2)->get();
        }

            $data = [
                'emp_birthday'=> $emp_birthday,
                'files' => $files,
                'latest_to_do' => $latest_to_do,
                'to_do_tasks_notifications' => $to_do_tasks_notifications,
                'tasks_notifications' =>$tasks_notifications,
                'notifications' => $notifications,
                'over_all_performance' => $over_all_performance,
                'professional_growth' => $professional_growth,
                'total_attendence_rate' => $total_attendence_rate,
                'holidays' => $holidays,
                'shift_emp_time' => $shift_emp_time,
                'tasks_notifications' =>$tasks_notifications,
                'notifications' => $notifications,
                'total_pending' => $total_pending,
                'total_work_days_in_month'=>$total_work_days_in_month,
                'salary_deduct' => $salary_deduct,
                'usd_pkr_expenses' => $usd_pkr_expenses,
                'usd_pkr_salary' => $usd_pkr_salary,
                'absent_days' => $total_absents,
                'total_present_day' => $total_present_day,
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

            $salesData  = $this->getYearWiseData();

            $total_revenue = number_format($total_revenue, 2);

            $notifications = DB::table('notifications')->where('status','unread')->orderBy('id','desc')->where('user_id',auth()->user()->user_code)->get();
            $tasks_notifications = DB::table('notifications')->where('status','unread')->orderBy('id','desc')->where('type','task')->where('user_id',auth()->user()->user_code)->get();
            $to_do_tasks_notifications = DB::table('notifications')->where('status','unread')->orderBy('id','desc')->where('type','to-do-task')->where('user_id',auth()->user()->user_code)->get();
            $holidays = $this->getHolidaysUpcoming();

            // dd($notifications);

            $latest_to_do = DB::table('to_do_list')->where('user_code',auth()->user()->user_code)->orderBy('id','desc')->where('status','pending')->get();




            $data = compact('emp_birthday','latest_to_do','to_do_tasks_notifications','tasks_notifications','notifications','emp_count','client_count','data_chart','total_revenue',
            'usd_pkr_expenses','usd_pkr_salary','total_profit','emp_present_count',
            // 'emp_leave_count','emp_absent_count','tasks_count','total_clients', 'currentTasks','chartData');
            'emp_leave_count','emp_absent_count','tasks_count', 'chartData', 'total_clients', 'currentTasks','salesData');
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


    // get upcoming holidays
public function getHolidaysUpcoming()
{
    // Get today's date
    $currentDate = Carbon::now();

    // Get the last date of the current month
    $lastDateOfMonth = $currentDate->copy()->endOfMonth();

    // Retrieve holidays between today and the end of the current month
    $holidays = DB::table('holidays')
                  ->whereBetween(DB::raw("STR_TO_DATE(startDate, '%m/%d/%Y')"), [$currentDate, $lastDateOfMonth])
                  ->get();

    // Check if any holidays were found
    if ($holidays->isEmpty()) {
        return null;
    } else {
        // Return the holiday dates
        //  dd($holidays);
        return $holidays;
    }

}


    // get leaves for last month


    // get total points performance indicators last month
    public function getPointsPerformance($code) {
        $points = DB::table('salaries')->where('emp_id', $code)->orderBy('id', 'desc')->value('all_total') ?? 0;
        return $points;
    }

    // get total number of days in last month
    public function getNumberOfDays($month) {
        // dd($month);
            // Get the last month
            $date = Carbon::createFromFormat('d/m/Y', $month);
            $lastMonth = $date->subMonth();
            $month = $date->month;
            $currentMonth = sprintf('%02d', $date->month);

            $year = $date->year;
            $currentYear = strlen($year) === 2 ? '20' . $year : $year;
            $holidays = $this->get_Holidays($currentMonth,$currentYear);
            $holidays = count($holidays);


            // Get the total number of days in the last month
            $totalDays = $lastMonth->daysInMonth;

            // Initialize counters
            $numWeekdays = 0;



            // Loop through each day in the last month
            for ($day = 1; $day <= $totalDays; $day++) {
                $date = Carbon::createFromDate($lastMonth->year, $lastMonth->month, $day);


                // Check if the day is a weekday (Monday to Friday)
                if (!$date->isWeekend()) {
                    $numWeekdays++;
                }
            }


            // Calculate the number of weekend days
            // $numWeekendDays = $totalDays - $numWeekdays;






            return $numWeekdays-$holidays;


    }

    public function getTotalLeaves($emp_code, $month) {
        // Parse the month string into a Carbon instance
        $date = Carbon::createFromFormat('d/m/Y', $month);
        // $date = $date->subMonth();



        // Get the year and month from the parsed date
        $year = $date->year;

        $year = $date->year;
        $currentYear = strlen($year) === 2 ? '20' . $year : $year;
        $month = $date->month;
        // dd($emp_code, $month);

        // Get the first and last day of the month
        $firstDayLastMonth = Carbon::createFromDate($currentYear, $month, 1)->startOfMonth()->toDateString();
        $lastDayLastMonth = Carbon::createFromDate($currentYear, $month, 1)->endOfMonth()->toDateString();
        //  dd($firstDayLastMonth, $lastDayLastMonth);


        $total = 0;

        // Get all attendance records for the last month
        $getNumberOfDays = DB::table('leaves')
        ->where('emp_code', $emp_code)
        ->where('status', 'approved')
        ->whereBetween('date', [$firstDayLastMonth, $lastDayLastMonth])
        ->sum('totalNumber'); // Use the 'sum' method directly on the column

        // dd($getNumberOfDays);



        if($getNumberOfDays != null) {
            $total = (int)$getNumberOfDays;
        }
        return $total ?? 0;
    }

    public function getTotalPresent($emp_code,$month) {
        $date = Carbon::createFromFormat('d/m/Y', $month);
        // $date = $date->subMonth();
        $year = $date->year;
        $month = $date->month;

        $currentyear = date('Y');
        $currentmonth = sprintf('%02d', $month);

        // Get the first and last day of the month
        $firstDayLastMonth = Carbon::createFromDate($currentyear, $month, 1)->startOfMonth()->toDateString();
        $lastDayLastMonth = Carbon::createFromDate($currentyear, $month, 1)->endOfMonth()->toDateString();
         // Get all attendance records for the last month
         $getNumberOfDays = DB::table('attendence')
         ->where('emp_id', $emp_code)
         ->whereBetween('date', [$firstDayLastMonth, $lastDayLastMonth])->count();
         return $getNumberOfDays;
    }

    public function getTotalAbsents($emp_code,$month) {
        // Get the current date
    $currentDate = new \DateTime();

    // Get the first day of the current month
    $firstDayOfMonth = new \DateTime($currentDate->format('Y-m-01'));

    // Ensure the first day is before or equal to the current date
    if ($firstDayOfMonth > $currentDate) {
        throw new \Exception('The current date is before the first day of the month.');
    }

    // Initialize counters
    $totalWeekdays = 0;

    // Iterate through each day from the first day of the month to the current date
    $currentDay = $firstDayOfMonth;
    while ($currentDay <= $currentDate) {
        if ($currentDay->format('N') < 6) { // 'N' returns 1 (Monday) through 7 (Sunday)
            $totalWeekdays++;
        }
        $currentDay->modify('+1 day');
    }

    $total_present = $this->getTotalPresent($emp_code, $month);
    $total_leaves = $this->getTotalLeaves($emp_code, $month);


    $total = $totalWeekdays -  $total_present -  $total_leaves;

    // dd($total);

    return $total ?? 0;



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

    // getting sales, profit, expenses yearly data
    public function getYearWiseData() {
        $currentYear = Carbon::now()->year;

        // Query for sales data
        $salesData = DB::table('invoices')
            ->select(DB::raw('MONTH(date) as month'), DB::raw('SUM(amount) as total'))
            ->whereYear('date', $currentYear)
            ->groupBy(DB::raw('MONTH(date)'))
            ->get()->pluck('total', 'month')->toArray();

        // Query for expenses data
        $expensesData = DB::table('expenses')
            ->select(DB::raw('MONTH(expense_date) as month'), DB::raw('SUM(expense_amount) as total'))
            ->whereYear('expense_date', $currentYear)
            ->groupBy(DB::raw('MONTH(expense_date)'))
            ->get()->pluck('total', 'month')->toArray();

        // Initialize arrays for sales, expenses, and profit
        $sales = [];
        $expenses = [];
        $profit = [];

        // Loop through each month and populate data
        for ($month = 1; $month <= 12; $month++) {
            $sales[] = isset($salesData[$month]) ? $salesData[$month] : 0;
            $expenses[] = isset($expensesData[$month]) ? $expensesData[$month] : 0;
            $profit[] = (isset($salesData[$month]) ? $salesData[$month] : 0) - (isset($expensesData[$month]) ? $expensesData[$month] : 0);
        }

        // Prepare response
        $chartData = [
            'sales' => $sales,
            'expenses' => $expenses,
            'profit' => $profit,
        ];

        // dd($chartData);

        return $chartData;
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
// use Carbon\Carbon;

public function getAbsent()
{
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

    // Get all holidays for the current month and year
    $holidays = DB::table('holidays')
        ->whereRaw('MONTH(STR_TO_DATE(startDate, "%m/%d/%Y")) = ?', [$currentMonth])
        ->whereRaw('YEAR(STR_TO_DATE(startDate, "%m/%d/%Y")) = ?', [$currentYear])
        ->get();

    // Convert holiday dates to Carbon instances for comparison
    foreach ($holidays as $holiday) {
        $holiday->startDate = Carbon::createFromFormat('m/d/Y', $holiday->startDate)->startOfDay();
        $holiday->endDate = Carbon::createFromFormat('m/d/Y', $holiday->endDate)->endOfDay();
    }

    // Get total approved leaves for the current month and year
    $leaves = DB::table('leaves')
        ->where('emp_code', $user_code)
        ->where('status', 'approved')
        ->whereMonth('date', $currentMonth)
        ->whereYear('date', $currentYear)
        ->count();

    // Subtract 2 leaves from total leaves if leaves count is greater than 2
    $total_absents = 0;
    if ($leaves > 2) {
        $total_absents = $leaves - 2;
    }

    // Initialize absent count
    $absentCount = 0;

    // Get the current day
    $currentDay = now()->day;
    // dd($currentDay);

    // Loop through each day of the month until the previous day of the current date
    for ($day = 1; $day < $currentDay; $day++) {
        $date = Carbon::create($currentYear, $currentMonth, $day)->startOfDay();

        // Debugging: Output current date
        // echo "Processing date: " . $date->toDateString() . "\n";

        if ($date->isWeekend()) {
            // If it's a Saturday or Sunday, skip to the next iteration
            // echo $date->toDateString() . " is a weekend.\n";
            continue;
        }

        // Check if the date is a holiday
        $isHoliday = false;
        foreach ($holidays as $holiday) {
            if ($date->between($holiday->startDate, $holiday->endDate)) {
                $isHoliday = true;
                break;
            }
        }

        // Debugging: Output holiday status
        if ($isHoliday) {
            // echo $date->toDateString() . " is a holiday.\n";
            continue;
        }

        // Check if there is an attendance record for the current date
        $record = $attendanceRecords->where('date', $date->toDateString())->first();


        // If there is no record or check_in_status is null, consider it absent
        if (!$record || is_null($record->check_in_status)) {
            $absentCount++;
            // echo $date->toDateString() . " is considered absent.\n";
        }
    }

    // Adjust total absents by subtracting holidays and total approved leaves
    $absentCount -= $total_absents;

    // Debugging: Output final absent count
    // echo "Total absent count: " . $absentCount . "\n";

    return $absentCount;
}








       // get public holidays
   public function get_Holidays($month, $year) {
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





    //get tasks
    public function getEmpTasks() {
        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Retrieve all employees
        $employees = DB::table('employees')->get(); // all records
        // DB::table('employees')->where('Emp_Shift_Time','Morning')->orderBy('id','desc')->get();
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
