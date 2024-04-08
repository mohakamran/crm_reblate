<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;

use DB;

use Storage;



use Carbon\Carbon;
use PDF;

class SalaryController extends Controller
{
    //view hightest paid employee
    public function viewHighPaidEmployee() {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // $currentMonth = Carbon::now()->subMonth()->month;
        // dd($currentMonth);


        $rankedEmployees = DB::table('salaries')
            ->whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->orderByDesc('amount')
            ->get();

            // echo $rankedEmployees;

        // dd($rankedEmployees);

        if ($rankedEmployees->isEmpty()) {
            echo "No records found for the current month and year.";
        } else {
            foreach ($rankedEmployees as $employee) {
                echo $employee->name . " - Salary: " . $employee->amount . "<br>";
            }
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
        $rec = DB::table('employees')->orderBy('id', 'desc')->get();
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

            $btn_text = "Proceed";
            return view('salaries.add-new',compact('id','title','emp','btn_text','route','emp_date_of_joining','emp_month_salary'));
        } else {
            return view('index.index');
        }
    }

    public function generateNewSlipTable($id, Request $req) {
       $id = $id;
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
       $emp_leave = $req->emp_leave;
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
        $emp_total_salary = $emp_basic_salary + $emp_kpi_bonus + $emp_project_bonus + $emp_travel_allowence + $emp_designation_bonus;
        $emp_net_salary =  $emp_total_salary - $emp_deduction;

        $data = compact('emp_month_salary_hidden','emp_designation_bonus','emp_travel_allowence','emp_date_of_joining_hidden','emp_no_of_working_days','title', 'emp_code','route','emp_name','emp_shift_time','id','emp_email','emp_designation','emp_basic_salary','emp_kpi_bonus','emp_project_bonus','emp_absent','emp_leave','emp_deduction','emp_reason_deduction','emp_total_salary','emp_net_salary');
              return view('salaries.confirm-page',$data);
        //    $pdf_name = "sample.pdf";
        //    $pdf = PDF::loadView('salaries.preview-slip', $data);
        //    return $pdf->download('sample.pdf');
            //   return view('salaries.preview-slip',$data);
    }

    public function testPdf() {
        $data = [
            'title' => 'Dynamic PDF Example',
            'content' => 'This is the content of the PDF file.',
        ];

        $pdf = PDF::loadView('pdf', $data);

        $pdf_name = date('d_m_y')."_file.pdf";
        // Save the PDF to the public folder
        // $pdf->save(public_path($pdf_name));

        return $pdf->stream('dynamic.pdf');
        // phpinfo();
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
        $emp_leave = $req->emp_leave;
        $emp_deduction = $req->emp_deduction;
        $emp_net_salary = $req->emp_net_salary;
        $emp_total_salary = $req->emp_total_salary;
        $emp_reason_deduction = $req->emp_reason_deduction;
        $emp_designation_bonus = $req->emp_designation_bonus;
        $emp_no_of_working_days = $req->emp_no_of_working_days;
        $emp_absent = $req->emp_absent;
        $emp_date_of_joining_hidden = $req->emp_date_of_joining_hidden;
        $data = compact('emp_date_of_joining_hidden','emp_month_salary_hidden','emp_designation_bonus','emp_travel_allowence','emp_no_of_working_days','title', 'emp_code','emp_name','emp_shift_time','id','emp_email','emp_designation','emp_basic_salary','emp_kpi_bonus','emp_project_bonus','emp_absent','emp_leave','emp_deduction','emp_reason_deduction','emp_total_salary','emp_net_salary');

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
        $date = date('F  Y');
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
        $emp->date  = date('d/m/Y');

        $emp->save();

        $message = "Salary Slip has been sent to ".$emp_name;
        return redirect('generate-new-salary-slip')->with('email_sent',$message);


    }

    // view recipts
    public function viewReciepts() {
        $rec = Employee::orderBy('id', 'desc')->get();
        $title = "Salaries Slips Of Registered Employees";
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
            $data = compact(
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



}
