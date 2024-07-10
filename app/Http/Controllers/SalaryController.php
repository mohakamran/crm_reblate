<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;

use Carbon\CarbonPeriod;
use GuzzleHttp\Client as GuzzleClient;
use DB;

use Storage;



use Carbon\Carbon;
use PDF;

class SalaryController extends Controller
{
    // search month admin salaries
    public function showMonthWiseSalariesByMonth(Request $req) {
        $date = $req->monthly_salaries;
        $shift_type = $req->shift_type;

        if($shift_type == "all") {
            $employees = DB::table('employees')->where('Emp_Status','active')->get();
        } else if($shift_type == "Night") {
            $employees = DB::table('employees')->where('Emp_Status','active')->where('Emp_Shift_Time','Night')->get();
        } else {
            $employees = DB::table('employees')->where('Emp_Status','active')->where('Emp_Shift_Time','Morning')->get();
        }


        list($currentYear, $currentMonth) = explode('-', $date);
        $formattedDate = "$currentMonth/$currentYear";

        // Fetch salaries for the selected employees, month, and shift type
        $salaries = DB::table('salaries')
            ->join('employees', 'salaries.emp_id', '=', 'employees.Emp_Code')
            ->whereIn('salaries.emp_id', $employees->pluck('Emp_Code'))
            ->where('employees.Emp_Status', 'active')
            ->where('salaries.date', 'LIKE', "%$formattedDate")
            ->when($shift_type != 'all', function ($query) use ($shift_type) {
                $query->where('employees.Emp_Shift_Time', $shift_type);
            })
            ->orderBy('salaries.date')
            ->get();

        // Calculate total salaries
        $sum_total_salaries = $salaries->sum(function ($salary) {
            return (float) $salary->amount;
        });

        $sum_total_salaries = $salaries->sum('amount');

        $sum_total_salaries = number_format($sum_total_salaries);


        // dd($salaries, $sum_total_salaries);
        return view('adminSalaries.update', compact('shift_type','salaries', 'sum_total_salaries', 'currentMonth', 'currentYear'));
    }

    // show monthwise salaries
    public function showMonthWiseSalaries() {

        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        $salary_month = date('F,Y');

        // Fetch salaries for the current month
        $salaries = DB::table('salaries')
            ->whereRaw("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$currentYear-$currentMonth-01' AND LAST_DAY(STR_TO_DATE(date, '%d/%m/%Y'))")
            ->orderByDesc('date')
            ->get();

        $sum_total_salaries = DB::table('salaries')
            ->select(DB::raw('SUM(amount) as total_amount'))
            ->whereRaw("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$currentYear-$currentMonth-01' AND LAST_DAY(STR_TO_DATE(date, '%d/%m/%Y'))")
            ->get();



        // If no salaries found for the current month, fetch salaries for the previous month
        if ($salaries->isEmpty()) {
            $previousMonth = Carbon::now()->subMonth()->format('m'); // Get the previous month
            $currentMonth = Carbon::now()->subMonth()->format('m');
            $previousYear = Carbon::now()->subMonth()->format('Y');   // Get the previous year

            $salaries = DB::table('salaries')
                ->whereRaw("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$previousYear-$previousMonth-01' AND LAST_DAY(STR_TO_DATE(date, '%d/%m/%Y'))")
                ->orderByDesc('date')
                ->get();

                $sum_total_salaries = DB::table('salaries')
                ->select(DB::raw('SUM(amount) as total_amount'))
                ->whereRaw("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$previousYear-$previousMonth-01' AND LAST_DAY(STR_TO_DATE(date, '%d/%m/%Y'))")
                ->orderByDesc('date')
                ->get();


        }

        $sum_total_salaries = $salaries->sum('amount');

        $sum_total_salaries = number_format($sum_total_salaries);

        // dd($sum_total_salaries);

        return view('adminSalaries.index',compact('salaries','sum_total_salaries','salary_month','currentMonth','currentYear'));

    }

    //view highest paid employee
   public function viewHighPaidEmployee() {
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;
    $previousMonth = $currentMonth;
    dd($currentYear);

    $rankedEmployees = DB::table('salaries')
        ->whereMonth('date', $currentMonth) // Replace 'date_column_name' with the actual column name in your 'salaries' table that holds the date information.
        ->whereYear('date', $currentYear) // Optionally, you can also filter by year.
        ->orderByDesc('amount')
        ->get();

    if ($rankedEmployees->isEmpty()) {
        echo "No records found for the current month and year.";
    } else {
        echo "<table>";
        echo "<tr>";
        echo "<th> Name </th> ";
        echo "<th> Amount </th>";
        echo "<th> Month </th>";
        echo "</tr>";
        foreach ($rankedEmployees as $employee) {
            echo "<tr>";
            echo "<td>".$employee->emp_name . " </td> <td> Salary: " . "<td> ".$employee->amount . "</td> <td>".$previousMonth."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

    // view slips
    public function viewSlips(){
        $emp_id = auth()->user()->user_code;
        // dd($emp_info);
        if($emp_id) {
            $info = DB::table('salaries')->where('emp_id', $emp_id)->orderBy('id', 'desc')->get();

            $emp_name = auth()->user()->user_name;
            return view('salaries.emp-slips',compact('info','emp_name'));
        }
    }
    public function generateNewSalarySlip() {
        // $rec = Employee::orderBy('id', 'desc')->get();
        $rec = DB::table('employees')->where('Emp_Status','active')->orderBy('id', 'desc')->get();
        // $sal = Salary::orderBy('id', 'desc')->get();
        $sal = DB::table('salaries')->orderBy('id', 'desc')->get();

        // if($sal->isEmpty()) {
        //     echo "empty!";
        // } else {
        //     echo "not empty@!";
        // }
        // die;
        $date = date('F, Y');
        $last_month_date = date('F, Y', strtotime('last month'));
        // dd($date);
        $title = "Salaries of ".$date;
        $data = compact('rec','title','sal','last_month_date');
        return view('salaries.unpaid-salaries',$data);
    }

    public function generateNewSlip($id) {
        $emp = Employee::find($id);

        if($emp) {
            $id = $emp->id;
            // dd($id);
            $route = "/preview-salary/".$emp->id;
            $title = "Employee ".$emp->Emp_Full_Name;
            $emp_date_of_joining = $emp->Emp_Joining_Date;
            $emp_date_of_joining = Carbon::parse($emp_date_of_joining);
            $emp_date_of_joining = $emp_date_of_joining->format('M d, Y');
            $emp_month_salary = date('F, Y');
            // Assuming $emp_month_salary is in the format 'F, Y'
            $emp_month_salary = date('F, Y');
            $timestamp = strtotime($emp_month_salary);

            // Get the timestamp for the first day of the current month
            $first_day_current_month = strtotime(date('Y-m-01', $timestamp));

            // Get the timestamp for the last day of the previous month
            $last_day_previous_month = strtotime('-1 day', $first_day_current_month);

            // Format the result in 'F, Y' format
            $emp_month_salary = date('F, Y', $last_day_previous_month);

            $emp_basic_salary  = $emp->basic_salary;
            $emp_code = $emp->Emp_Code;
            // dd($emp_code);
            // dd($emp_basic_salary);

             $salary_month = date('d/m/y');


             $total_leaves = $this->getTotalLeaves($emp_code,$salary_month);
            //  dd("end here");

             $total_absents = $this->getTotalAbsents($emp_code,$salary_month);
             $total_days = $this->getNumberOfDays($salary_month);

             $getTotalPresent = $this->getTotalPresent($emp_code,$salary_month);

            //  dd($total_leaves, $total_absents , $total_days);



            $btn_text = "Proceed";
            return view('salaries.add-new',compact('getTotalPresent','total_leaves','total_absents','total_days','id','title','emp','btn_text','route','emp_date_of_joining','emp_month_salary'));
        } else {
           return back();
        }
    }

    public function getTotalLeaves($emp_code, $month) {
        // Parse the month string into a Carbon instance
        $date = Carbon::createFromFormat('d/m/Y', $month);
        $date = $date->subMonth();



        // Get the year and month from the parsed date
        $year = $date->year;

        $year = $date->year;
        $currentYear = strlen($year) === 2 ? '20' . $year : $year;
        $month = $date->month;

        // Get the first and last day of the month
        $firstDayLastMonth = Carbon::createFromDate($currentYear, $month, 1)->startOfMonth()->toDateString();
        $lastDayLastMonth = Carbon::createFromDate($currentYear, $month, 1)->endOfMonth()->toDateString();
        //  dd($currentYear);


        $total = 0;

        // Get all attendance records for the last month
        $getNumberOfDays = DB::table('leaves')
            ->where('emp_code', $emp_code)
            ->whereBetween('date', [$firstDayLastMonth, $lastDayLastMonth])
            ->where('status','approved')
            ->count();
        if($getNumberOfDays != null) {
            $total = $getNumberOfDays;
        }
        return $total;
    }

    public function getTotalPresent($emp_code,$month) {
        $date = Carbon::createFromFormat('d/m/Y', $month);
        $date = $date->subMonth();
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
        $get_total = $this->getNumberOfDays($month);
        $getTotalLeaves = $this->getTotalLeaves($emp_code,$month);




        $date = Carbon::createFromFormat('d/m/Y', $month);
        $date = $date->subMonth();
        // Get the year and month from the parsed date
        $year = $date->year;
        $month = $date->month;

        $currentyear = date('Y');
        $currentmonth = sprintf('%02d', $month);

        $get_Holidays = $this->get_Holidays( $currentmonth, $currentyear);
        $holidays_count = count($get_Holidays);




        // Get the first and last day of the month
        $firstDayLastMonth = Carbon::createFromDate($currentyear, $month, 1)->startOfMonth()->toDateString();
        $lastDayLastMonth = Carbon::createFromDate($currentyear, $month, 1)->endOfMonth()->toDateString();



        // Get all attendance records for the last month
        $getNumberOfDays = DB::table('attendence')
        ->where('emp_id', $emp_code)
        ->whereBetween('date', [$firstDayLastMonth, $lastDayLastMonth])->count();


        $getNumberOfDays = $getNumberOfDays + $getTotalLeaves;

        $total = $get_total - $getNumberOfDays;
        // dd($total);

        // dd($total);
        // return $attendanceRecords;
        return $total;

    }

           // get public holidays
   public function get_Holidays($month, $year) {
    // Get the first day of the month
    // dd($year);
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
    // dd($datesForMonth);
    // Return the list of dates for the month
    return  $datesForMonth;
}


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

    public function generateNewSlipTable($id, Request $req) {


        $req->validate([
            'created_by' => 'required',
            'over_all_performance' => 'required',
        ]);

        if($req->salary_id != null) {
            $salary_id = $req->salary_id;
        } else {
            $salary_id = "none";
        }

        $id = $id;
        $quarterly_bonus = $req->quarterly_bonus;
        // basic attributes
        $communication_point = $req->communication_point;
        $problem_solving_point = $req->problem_solving_point;
        $team_work_point = $req->team_work_point;
        $team_management_point = $req->team_management_point;

        // job performance
        $quality_of_work = $req->quality_of_work;
        $productivity = $req->productivity;
        $innovation = $req->innovation;
        $professionalism = $req->professionalism;



        // development_and_growth
        $development_and_growth = $req->development_and_growth;

        // total Marks
        $total_basic_attributes = $communication_point + $problem_solving_point + $team_work_point + $team_management_point;
        $total_job_performance = $quality_of_work + $productivity + $innovation + $professionalism;
        $all_total = $total_basic_attributes + $total_job_performance + $development_and_growth;

        // over all assesment
        $over_all_performance = $req->over_all_performance;
        // dd($over_all_performance);

        $created_by = $req->created_by;
        $authorized_by = $req->authorized_by;

        // dd($created_by,$authorized_by);

        // $emp_present_days =  $req->$emp_presents;

        // dd($emp_present_days);

       $title = "Salary Receipt of ".$req->emp_name_hidden;
       $route = "/send-reciept/".$id;
       $emp_name = $req->emp_name_hidden;
       $emp_email = $req->emp_email_hidden;
       $emp_code = $req->emp_code_hidden;
       $emp_designation = $req->emp_designation_hidden;
       $emp_shift_time = $req->emp_shift_time_hidden;
       $emp_basic_salary = $req->emp_basic_salary;
       $emp_kpi_bonus = $req->emp_kpi_bonus;
       $emp_project_bonus = $req->emp_project_bonus;
       $emp_absent = $req->emp_absent;
       $emp_present_days =  $req->emp_presents;

       $emp_leave = $req->emp_leave;
        //    dd($emp_present_days);
       $emp_deduction = $req->emp_deduction;
       $emp_reason_deduction = $req->emp_reason_deduction;
        //    $emp_total_salary = $req->emp_total_salary_hidden;
        //    $emp_deduction = $req->emp_deduction_hidden;
        //    $emp_net_salary = $req->emp_net_salary_hidden;
        $emp_no_of_working_days = $req->emp_no_of_working_days;
        $emp_date_of_joining_hidden = $req->emp_date_of_joining_hidden;
        $emp_designation_bonus = $req->emp_designation_bonus;
        $emp_travel_allowence = $req->emp_travel_allowence;
        $emp_month_salary_hidden = $req->emp_month_salary_hidden;
        //total salary
        $emp_total_salary = $emp_basic_salary + $emp_kpi_bonus + $emp_project_bonus + $emp_travel_allowence + $emp_designation_bonus + $quarterly_bonus;
        $emp_net_salary =  $emp_total_salary - $emp_deduction;





        $data = compact('emp_present_days','salary_id','authorized_by','created_by','over_all_performance','all_total','total_job_performance','total_basic_attributes','development_and_growth','professionalism','innovation','productivity','quality_of_work','team_management_point','team_work_point','problem_solving_point','quarterly_bonus','communication_point','emp_month_salary_hidden','emp_designation_bonus','emp_travel_allowence','emp_date_of_joining_hidden','emp_no_of_working_days','title', 'emp_code','route','emp_name','emp_shift_time','id','emp_email','emp_designation','emp_basic_salary','emp_kpi_bonus','emp_project_bonus','emp_absent','emp_leave','emp_deduction','emp_reason_deduction','emp_total_salary','emp_net_salary');
              return view('salaries.confirm-page',$data);
        //    $pdf_name = "sample.pdf";
        //    $pdf = PDF::loadView('salaries.preview-slip', $data);
        //    return $pdf->download('sample.pdf');
            //   return view('salaries.preview-slip',$data);
    }



    // send emails to relevant employee
    public function sendReciept($id, Request $req) {
        $emp = new Salary();
        $check = $req->check_box;
        $route = "/send-reciept/".$id;
        $emp_name = $req->emp_name;
        $title = "Salary Receipt of ".$req->$emp_name;
        $emp_email = $req->emp_email;
        $emp_code = $req->emp_code;
        $emp_month_salary_hidden = $req->emp_month_salary_hidden;
        $emp_designation = $req->emp_designation;
        $emp_shift_time = $req->emp_shift_time;
        $emp_basic_salary = $req->emp_basic_salary;
        $emp_kpi_bonus = $req->emp_kpi_bonus;
        $emp_travel_allowence = $req->emp_travel_allowence;
        $emp_travel_allowence = $req->emp_travel_allowence;
        $emp_project_bonus = $req->emp_project_bonus;
        $emp_project_bonus = $req->emp_project_bonus;
        $emp_present_days = $req->emp_present_days;

        $emp_leave = $req->emp_leave;
        $emp_deduction = $req->emp_deduction;
        $emp_net_salary = $req->emp_net_salary;
        $emp_total_salary = $req->emp_total_salary;
        $emp_reason_deduction = $req->emp_reason_deduction;
        $emp_designation_bonus = $req->emp_designation_bonus;
        $emp_no_of_working_days = $req->emp_no_of_working_days;
        $emp_absent = $req->emp_absent;
        $emp_date_of_joining_hidden = $req->emp_date_of_joining_hidden;

        // dd($req->emp_code);

        // attributes
        $quarterly_bonus = $req->quarterly_bonus;
        // dd($quarterly_bonus);
        $communication_point = $req->communication_point;
        $problem_solving_point = $req->problem_solving_point;
        $team_work_point = $req->team_work_point;
        $team_management_point = $req->team_management_point;

        $quality_of_work = $req->quality_of_work;
        $productivity = $req->productivity;
        $innovation = $req->innovation;
        $professionalism = $req->professionalism;

        $development_and_growth = $req->development_and_growth;
        $total_basic_attributes = $req->total_basic_attributes;
        $total_job_performance = $req->total_job_performance;
        $all_total = $req->all_total;

        $created_by = $req->created_by;
        $authorized_by = $req->authorized_by;

        // dd($created_by, $authorized_by);

        $over_all_performance = $req->over_all_performance;


        $message_notification = "";
        $title_notification = "";
        $user_id  = $emp_code;
        $time = Carbon::now()->format('h:i A');
        $status = "unread";
        $link = "";
        $date_notification = date('y-m-d');


        if($req->salary_id != "none") {
            // $emp = DB::table('salaries')->where('id',$req->salary_id)->first();
            $emp = Salary::find($req->salary_id);
            if($emp==null) {
                return back();
            } else {
                $message = "Salary Slip Updated Successfully! ";
                $date = $emp->date;
                $title_notification = "Salary Slip Updated";
                $message_notification = auth()->user()->user_type. " ".auth()->user()->user_name. " has updated your salary slip";
            }


        } else {
            $title_notification = "Salary Slip Created";
            $message_notification = auth()->user()->user_type. " ".auth()->user()->user_name. " has created your salary slip";
            $emp = new Salary();
            $message = "Salary Slip Created Successfully! ";
            $date = date('d/m/Y');
            // dd($emp);
        }


        $data = compact('emp_present_days','authorized_by','created_by','quarterly_bonus','emp_date_of_joining_hidden','emp_month_salary_hidden','emp_designation_bonus','emp_travel_allowence','emp_no_of_working_days','title', 'emp_code','emp_name','emp_shift_time','id','emp_email','emp_designation','emp_basic_salary','emp_kpi_bonus','emp_project_bonus','emp_absent','emp_leave','emp_deduction','emp_reason_deduction','emp_total_salary','emp_net_salary');

        // Assuming $emp_month_salary is in the format 'F, Y'
        $emp_month_salary = date('F, Y');
        $timestamp = strtotime($emp_month_salary);

        // Get the timestamp for the first day of the current month
        $first_day_current_month = strtotime(date('Y-m-01', $timestamp));

        // Get the timestamp for the last day of the previous month
        $last_day_previous_month = strtotime('-1 day', $first_day_current_month);

        // Format the result in 'F, Y' format
        $previous_month = date('F, Y', $last_day_previous_month);
        // dd($previous_month);



        $pdf_name = 'generated-salaries/'.$emp_code."_".$previous_month.".pdf";
        $pdf = PDF::loadView('salaries.preview-slip', $data)->setOptions(['defaultFont' => 'sans-serif']);
        $pdfPath = $pdf->save(public_path($pdf_name));
        // $date = date('F  Y');
        $mail_subject = "Salary Slip for Month of ".$previous_month;
        $pdfContent = $pdf->output();
        Mail::send('salaries.email-template', $data, function ($message) use ( $mail_subject, $emp_email, $pdfContent) {
            $message->to($emp_email)
                    ->subject($mail_subject)
                    ->attachData($pdfContent, 'salary-slip.pdf', [
                        'mime' => 'application/pdf',
                    ]);
        });

         if($emp_reason_deduction==null) {
            $emp_reason_deduction = "";
        }

        $emp->emp_id = $emp_code;
        $emp->emp_name =  $emp_name;
        $emp->file_name  = $pdf_name;
        $emp->status  = "paid";
        $emp->amount  = $emp_net_salary;
        // $emp->basic_salary  = $emp_basic_salary;
        $emp->basic_salary  = $emp_basic_salary;
        $emp->kpi_bonus  = $emp_kpi_bonus;
        $emp->project_bonus  = $emp_project_bonus;
        $emp->designation_bonus  = $emp_designation_bonus;
        $emp->absent_days  = $emp_absent;
        $emp->travel_allowence  = $emp_travel_allowence;
        $emp->leave_days  = $emp_leave;
        $emp->deduction  = $emp_deduction;
        $emp->working_days  = $emp_no_of_working_days;
        $emp->reason_of_deduction  = $emp_reason_deduction;
        $emp->month_salary  = $previous_month;
        $emp->total_salary  = $emp_total_salary;
        $emp->emp_present_days  = $emp_present_days;


        $emp->quarterly_bonus  = $quarterly_bonus;
        $emp->communication_point  = $communication_point;
        $emp->problem_solving_point  = $problem_solving_point;
        $emp->team_work_point  = $team_work_point;
        $emp->team_management_point  = $team_management_point;
        $emp->quality_of_work  = $quality_of_work;
        $emp->productivity  = $productivity;
        $emp->innovation  = $innovation;
        $emp->professionalism  = $professionalism;
        $emp->innovation  = $innovation;
        $emp->development_and_growth  = $development_and_growth;
        $emp->total_basic_attributes  = $total_basic_attributes;
        $emp->total_job_performance  = $total_job_performance;
        $emp->all_total  = $all_total;
        $emp->over_all_performance  = $over_all_performance;

        $emp->created_by  = $created_by;
        $emp->authorized_by  = $authorized_by;

        $emp->date  = $date;

        $emp->save();

        $salary = DB::table('salaries')->where('emp_id',$user_id)->orderBy('id','desc')->select('id')->first();
        $link  = "/preview-slip-employee-page/".$salary->id;
        DB::table('notifications')->insert([
            'title' => $title_notification,
            'message' => $message_notification,
            'user_id' => $user_id,
            'time' => $time,
            'status' => $status,
            'link' => $link,
            'date' => $date_notification
        ]);

        return redirect('generate-new-salary-slip')->with('email_sent',$message);


    }

    // view all employees salaries
    public function viewAll() {
        $rec = Employee::orderBy('id', 'desc')->get();
        $title = "Salaries Slips Of All Employees";
        $data = compact('rec','title');
        return view('salaries.view-slips',$data);
    }

    // View salary Dasboard Page
    public function viewDashboard() {
        $salaries = Salary::orderBy('id', 'desc')->get();

        $totalDeductionAmount = $salaries->reduce(function ($carry, $salary) {
        $deduction = is_numeric($salary->deduction) ? (float) $salary->deduction : 0;
            return $carry + $deduction;
        }, 0);
        $ConvretCurrencyDed = $this->getExchangeRate($totalDeductionAmount);
        $usd_pkr_salary_Ded = number_format($ConvretCurrencyDed,2);

        $totalAmount = $salaries->sum(function ($salary) {
        return (float) $salary->total_salary;
        });
        $ConvretCurrency = $this->getExchangeRate($totalAmount);
        $usd_pkr_salary = number_format($ConvretCurrency,2);

        $totalNetSalary = $salaries->sum(function ($salary) {
            return (float) $salary->amount;
            });
        $ConvretCurrencyNet = $this->getExchangeRate($totalNetSalary);
        $usd_pkr_salary_Net = number_format($ConvretCurrencyNet,2);

        $totalBonus = $salaries->sum(function ($salary) {
            return (float) $salary->kpi_bonus + (float) $salary->project_bonus + (float) $salary->designation_bonus;
        });
        $ConvretCurrencyBonus = $this->getExchangeRate($totalBonus);
        $usd_pkr_salary_Bonus = number_format($ConvretCurrencyBonus,2);
       
        $startDate = Carbon::now()->subMonth()->startOfMonth(); // Start of previous month
        $endDate = Carbon::now()->subMonth()->endOfMonth();     // End of previous month

        $currentDate = Carbon::now();
        $firstDayOfCurrentMonth = $currentDate->startOfMonth();
        $firstDayOfPreviousMonth = $firstDayOfCurrentMonth->copy()->subMonth()->startOfMonth();
        $lastDayOfPreviousMonth = $firstDayOfPreviousMonth->copy()->endOfMonth();
        $formattedStartDate = $firstDayOfPreviousMonth->format('M d, Y');
        $formattedEndDate = $lastDayOfPreviousMonth->format('M d, Y');
        $formattedPayRoll = $lastDayOfPreviousMonth->format('M, Y');

        $TotalEmployees = Employee::where('Emp_status','active')->count();

        $salaryGet = Salary::join('employees','salaries.emp_id','=','employees.Emp_Code' )
        ->select('salaries.*', 'employees.*')
        ->whereBetween('salaries.created_at', [$startDate, $endDate])
        ->orderBy('salaries.emp_id', 'desc')
        ->get();

        $salarysGet = Salary::join('employees', 'salaries.emp_id', '=', 'employees.Emp_Code')
             ->select('employees.Emp_Code', 'employees.Emp_Full_Name', DB::raw('SUM(salaries.total_salary) as total_salary'))
             ->groupBy('employees.Emp_Code', 'employees.Emp_Full_Name') // Group by employee ID and name
             ->orderBy('employees.Emp_Code', 'desc') // Order by employee ID
             ->get();


        $data = compact('salarysGet','usd_pkr_salary_Net','usd_pkr_salary_Bonus','salaryGet','usd_pkr_salary','salaries','formattedStartDate','formattedEndDate','TotalEmployees','usd_pkr_salary_Ded','formattedPayRoll');
        return view('salaries.salary-dashboard',$data);
    }

    // view recipts
    public function viewReciepts() {
        $rec = Employee::orderBy('id', 'desc')->where('Emp_Status','active')->get();
        $title = "Salaries Slips Of Regular Employees";
        $data = compact('rec','title');
        return view('salaries.view-slips',$data);
    }

    // view salary slip of employee on browser
    public function viewSlipBrowser($id) {
        // dd($id);
        $slip = DB::table('salaries')->where('id',$id)->first();

        if($slip) {
            $emp = DB::table('employees')->where('Emp_Code',$slip->emp_id)->first();
            $emp_name = $slip->emp_name;
            $emp_code = $slip->emp_id;
            $emp_designation = $slip->emp_name;
            // $emp_name = $slip->emp_name;
            $emp_no_of_working_days = $slip->working_days;
            $emp_designation = $emp->Emp_Designation;
            $emp_month_salary_hidden = $emp->Emp_Designation;
            $emp_date_of_joining_hidden = $emp->Emp_Joining_Date;
            $emp_absent = $slip->absent_days;
            $emp_leave = $slip->leave_days;
            $emp_basic_salary = $slip->basic_salary;
            $emp_deduction = $slip->deduction;
            $emp_designation_bonus = $slip->designation_bonus;
            $emp_project_bonus = $slip->project_bonus;
            $emp_kpi_bonus = $slip->kpi_bonus;
            $emp_travel_allowence = $slip->travel_allowence;
            $emp_total_salary = $slip->total_salary;
            $emp_net_salary = $slip->amount;
            $emp_reason_deduction = $slip->reason_of_deduction;
            $quarterly_bonus = $slip->quarterly_bonus;
            $authorized_by	 = $slip->authorized_by;
            $created_by	 = $slip->created_by;
            $emp_present_days	 = $slip->emp_present_days;
            $month_salary	 = $slip->month_salary;
            $data = compact(
                'emp_present_days',
                'quarterly_bonus',
                'emp_name',
                'emp_code',
                'emp_designation',
                'emp_no_of_working_days',
                'emp_no_of_working_days',
                'emp_month_salary_hidden',
                'emp_date_of_joining_hidden',
                'emp_absent',
                'emp_leave',
                'emp_basic_salary',
                'emp_deduction',
                'emp_designation_bonus',
                'emp_kpi_bonus',
                'emp_travel_allowence',
                'emp_total_salary',
                'emp_net_salary',
                'emp_reason_deduction',
                'emp_project_bonus',
                'created_by',
                'authorized_by',
                'month_salary'
            );
            return view('salaries.slip-browser',$data);
        }
        else {
            return redirect('/');
        }
    }

    // view salaries of employees
    public function viewSalaries($id) {
        $emp = Salary::where('emp_id', $id)->orderBy('id','desc')->get();
        // dd($emp);
        if($emp) {

            // dd($emp->emp_name);
            $emp_name_search  = Salary::where('emp_id', $id)->first();

            // dd($emp_code_new);
            if($emp_name_search) {
                $title = "Salary Slips Of ".$emp_name_search->emp_name;
                $data = compact('title','emp');
                return view('salaries.individial-employee-slips',$data);
            } else {
                $rec = Employee::orderBy('id', 'desc')->get();
                $title = "Salaries Slips Of Registered Employees";
                $view_slips = "No record found for employee!";
                $data = compact('rec','title','view_slips');
                return view('salaries.view-slips',$data);
            }
        }
    }

    // update salary slip
    public function updateSalary($id) {
        $salary_id = DB::table('salaries')->where('id',$id)->first();
        // dd($salary_id);
        if($salary_id) {

            $emp = DB::table('employees')->where('Emp_Code',$salary_id->emp_id)->first();

            if($emp) {
                $route = "/preview-salary/".$emp->id;
                $title = "Employee ".$emp->Emp_Full_Name;
                $emp_date_of_joining = $emp->Emp_Joining_Date;
                $emp_date_of_joining = Carbon::parse($emp_date_of_joining);
                $emp_date_of_joining = $emp_date_of_joining->format('M d, Y');



                $salary_month  = $salary_id->date;
                $date = Carbon::createFromFormat('d/m/Y', $salary_month);
                $month_name = $date->format('F'); // Full month name (e.g., May)
                $year = $date->format('Y'); // Year (e.g., 2024)

                $emp_month_salary = $month_name . ', ' . $year;



            $timestamp = strtotime($emp_month_salary);

            // Get the timestamp for the first day of the current month
            $first_day_current_month = strtotime(date('Y-m-01', $timestamp));

            // Get the timestamp for the last day of the previous month
            $last_day_previous_month = strtotime('-1 day', $first_day_current_month);

            // Format the result in 'F, Y' format
            $emp_month_salary = date('F, Y', $last_day_previous_month);

            $emp_basic_salary  = $emp->basic_salary;
            $emp_code = $emp->Emp_Code;
            // dd($emp_code);
            // dd($emp_basic_salary);

             $total_days = $this->getNumberOfDays($salary_month);

             $total_absents = $this->getTotalAbsents($emp_code, $salary_month);

             $total_leaves = $this->getTotalLeaves($emp_code,$salary_month);

            //  dd($total_leaves);


            $status = "update";

            $getTotalPresent = $this->getTotalPresent($emp_code,$salary_month);



            $btn_text = "Proceed";
            return view('salaries.add-new',compact('getTotalPresent','status','salary_id','total_leaves','total_absents','total_days','id','title','emp','btn_text','route','emp_date_of_joining','emp_month_salary'));

            }
            return view('errors.404');
        }
        return view('errors.404');
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
