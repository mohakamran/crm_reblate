<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Login;
use App\Models\UserEmployee;
use App\Models\User;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use DB;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function resetPassword($id) {
        $userEmp = User::where('user_code',$id)->first();
        // $userEmp = DB::table('users')->where('user_code',$id)->first();
        if($userEmp) {
            // send email to relevant user
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=';
            $randomPassword = Str::random(12, $characters);
            $login_user_name = $userEmp->user_name;
            $login_user_code = $userEmp->user_code;
            $login_user_email = $userEmp->user_email;
            // $randomPassword = $randomPassword;
            $data = compact('login_user_code', 'login_user_email','login_user_name', 'randomPassword' );
            $mail_subject = "Your Password has been reset!";
            // Mail::send('login.email-template', [], function ($message) use ($mail_subject, $login_user_email) {
            //     $message->to($login_user_email)
            //             ->subject($mail_subject);
            // });
            // exit;
            Mail::send('login.update-email-template', $data, function ($message) use ($mail_subject, $login_user_email) {
                $message->to($login_user_email)
                        ->subject($mail_subject);
            });

            $hashedPassword = Hash::make($randomPassword);
            $userEmp->password = $hashedPassword;
            $userEmp->save();
            return response()->json(['success']);
        } else {
            return response()->json(['error']);
        }

    }
    public function createNewEmployeeLogin() {
        return view('login.create-new-emp-login');
    }
    //
    public function createLoginView() {
        $emp_data = Employee::all();
        if($emp_data) {
            $data = compact('emp_data');
            return view('login.create-new-login')->with($data);
        }
        else {
            return redirect('/');
        }
    }

    // get employee id and return results
    public function createLoginEmp($id) {
        $employee = Employee::where('Emp_Code', $id)->first();
        if($employee) {
            $emp_login_name = $employee->Emp_Full_Name;
            $emp_login_email = $employee->Emp_Email;
            $emp_login_code = $employee->Emp_Code;
            $emp_login_designation = $employee->designation;
            $login_data = compact('emp_login_name','emp_login_email','emp_login_code','emp_login_designation');
            return view('login.emp-login-detail',$login_data);
        }  else {
            return redirect('/create-new-login');
        }
        // return $id;
    }

    // create a new login for new employee
    public function registerNewEmployeeLogin(Request $req) {
        $req->validate([
            'emp_login_name' => 'required',
            'emp_login_email' => 'required|unique:employees,emp_email',
            'emp_login_user_type_hidden' => 'required',
            'emp_code' => 'required',
            'employee_department' => 'required',
            'employee_designation' => 'required',
            'employee_shift_time' => 'required',
            'employee_joining_date' => 'required'
        ]);

        $employee_department = $req->employee_department;
        $employee_designation = $req->employee_designation;
        $employee_shift_time = $req->employee_shift_time;
        $employee_joining_date = $req->employee_joining_date;
        // $data = compact('employee_department','employee_designation','employee_joining_date','employee_shift_time');
        // dd($data);

        $login_user_name = $req->emp_login_name;
        $login_user_email = $req->emp_login_email;
        $login_user_type = $req->emp_login_user_type_hidden;
        $login_user_code = $req->emp_code;
        // $data = compact('login_user_name','login_user_email','login_user_type','login_user_code');
        // dd($data);

        $user_check = UserEmployee::where('emp_code', $login_user_code)->first();
        $email_check = DB::table('users')->where('user_email',$login_user_email)->first();
        if($email_check) {
            session()->flash('fail', 'Email Already Exists!');
            return back();
        }
        if($user_check) {
            session()->flash('fail', 'Employee ID already exists!');
            return back();
        }
        else {
             // emp access
            $emp_access = $req->input('emp_access', []);
            // expenses access
            $expenses_access = $req->input('expenses_access', []);
            // clients_access
            $clients_access = $req->input('clients_access', []);
            // invoices_access
            $invoices_access = $req->input('invoices_access', []);
            // salary_slip_access
            $salary_slip_access = $req->input('salary_slip_access', []);
            // reports_access
            $reports_access = $req->input('reports_access', []);
            // tasks_access
            $tasks_access = $req->input('tasks_access', []);
            // attendance_access
            $attendance_access = $req->input('attendance_access', []);

            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=';
            $randomPassword = Str::random(12, $characters);




            $login = new Login();
            $login->username = $login_user_name;
            $login->email = $login_user_email;
            $login->employee_type = $login_user_type;
            $login->emp_code = $login_user_code;

            // Save the access data in the database
            $login->employees_access = implode(',', $emp_access);
            $login->expenses_access = implode(',', $expenses_access);
            $login->clients_access = implode(',', $clients_access);
            $login->invoices_access = implode(',', $invoices_access);
            $login->salary_slips_access = implode(',', $salary_slip_access);
            $login->reports_access = implode(',', $reports_access);
            $login->tasks_access = implode(',', $tasks_access);
            $login->attendance_access = implode(',', $attendance_access);

            $login->save();


            // $UserEmployee = new UserEmployee();
            // $UserEmployee->username = $login_user_name;
            // $UserEmployee->status = "created";
            // $UserEmployee->emp_email = $login_user_email;
            // $UserEmployee->employee_type = $login_user_type;
            // $UserEmployee->remember_token = '';
            // $UserEmployee->emp_code = $login_user_code;
            // $UserEmployee->password = Hash::make($randomPassword);
            // $UserEmployee->save();
            DB::table('users')->insert([
                'user_name' => $login_user_name,
                'user_email' => $login_user_email,
                'user_type' => $login_user_type,
                'remember_token' => '',
                'user_code' => $login_user_code,
                'password' => Hash::make($randomPassword),
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            // save in employee table

            // saving data to database
            $empModel = new Employee();
            $empModel->Emp_Full_Name = $login_user_name;
            $empModel->Emp_Email = $login_user_email;
            $empModel->Emp_Phone = "";
            $empModel->Emp_Shift_Time = $employee_shift_time;
            $empModel->Emp_Designation = $employee_designation;
            $empModel->Emp_Status = "inactive";
            $empModel->Emp_Joining_Date = $employee_joining_date;
            $empModel->Emp_Address = "";
            $empModel->Emp_Image =  "";
            $empModel->Emp_Relation = "";
            $empModel->Emp_Relation_Name = "";
            $empModel->Emp_Relation_Phone = "";
            $empModel->Emp_Relation_Address = "";
            $empModel->Emp_Bank_Name = "";
            $empModel->Emp_Bank_IBAN = "";
            $empModel->Emp_Code = $login_user_code;
            $empModel->department = $employee_department;
            $empModel->save();

             // send email to relevant user
            $data = compact('login_user_code', 'employee_designation' ,'employee_shift_time' ,'employee_joining_date', 'employee_department', 'login_user_email','login_user_name', 'randomPassword' );
            $mail_subject = "Welcome to Reblate Solutions";

            Mail::send('login.email-template', $data, function ($message) use ($mail_subject, $login_user_email) {
                $message->to($login_user_email)
                        ->subject($mail_subject);
            });

            session()->flash('success', 'Login Invitation Sent successfully!');
            return redirect('/create-new-login');

        }

    }

    // create login and save data in databse
    public function registerLoginEmp($id, Request $req) {
        $employee = Employee::where('Emp_Code', $id)->first();

        if($employee) {
            $login_user_name = $req->emp_login_name_hidden;
            $login_user_email = $req->emp_login_email_hidden;
            $login_user_type = $req->emp_login_user_type_hidden;
            $login_user_code = $req->emp_login_code_hidden;
            $employee_designation = $employee->Emp_Designation;
            $employee_shift_time = $employee->Emp_Shift_Time;
            $employee_joining_date = $employee->Emp_Joining_Date;
            $employee_department = $employee->department;
            // emp access
            $emp_access = $req->input('emp_access', []);
            // expenses access
            $expenses_access = $req->input('expenses_access', []);
            // clients_access
            $clients_access = $req->input('clients_access', []);
            // invoices_access
            $invoices_access = $req->input('invoices_access', []);
            // salary_slip_access
            $salary_slip_access = $req->input('salary_slip_access', []);
            // reports_access
            $reports_access = $req->input('reports_access', []);
            // tasks_access
            $tasks_access = $req->input('tasks_access', []);
            // attendance_access
            $attendance_access = $req->input('attendance_access', []);


            // send email to relevant user
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=';
            $randomPassword = Str::random(12, $characters);

            $data = compact('login_user_code', 'employee_designation' ,'employee_shift_time' ,'employee_joining_date', 'employee_department', 'login_user_email','login_user_name', 'randomPassword' );
            $mail_subject = "Reblate Solutions Invited You For A New Role";
            // Mail::send('login.email-template', [], function ($message) use ($mail_subject, $login_user_email) {
            //     $message->to($login_user_email)
            //             ->subject($mail_subject);
            // });
            // exit;
            Mail::send('login.email-template-two', $data, function ($message) use ($mail_subject, $login_user_email) {
                $message->to($login_user_email)
                        ->subject($mail_subject);
            });

            $login = new Login();
            $login->username = $login_user_name;
            $login->email = $login_user_email;
            $login->employee_type = $login_user_type;
            $login->emp_code = $login_user_code;

            // Save the access data in the database
            $login->employees_access = implode(',', $emp_access);
            $login->expenses_access = implode(',', $expenses_access);
            $login->clients_access = implode(',', $clients_access);
            $login->invoices_access = implode(',', $invoices_access);
            $login->salary_slips_access = implode(',', $salary_slip_access);
            $login->reports_access = implode(',', $reports_access);
            $login->tasks_access = implode(',', $tasks_access);
            $login->attendance_access = implode(',', $attendance_access);

            $login->save();


            DB::table('users')->insert([
                'user_name' => $login_user_name,
                'user_email' => $login_user_email,
                'user_type' => $login_user_type,
                'remember_token' => '',
                'user_code' => $login_user_code,
                'password' => Hash::make($randomPassword),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            session()->flash('success', 'Login Invitation Sent successfully!');
            return redirect('/create-new-login');

        } else {
            return redirect('/create-new-login');
        }

    }

    public function viewLoginEmp() {
        // $rec = UserEmployee::orderBy('id', 'desc')->get();
        $rec = DB::table('table_login_details')
                    ->orderBy('id', 'desc')
                    ->get();
        $title = "Logins Created";
        $data = compact('rec','title');
        return view('login.view-login',$data);
    }

    public function delviewLoginEmp($id) {

        // $emp_data = UserEmployee::where('emp_code', $id)->first();

        $emp_data = DB::table('users')->where('user_code',$id)->first();
        // console.log($id);

        if($emp_data) {
            // $emp = Login::where('emp_code',$id)->first();
            $emp = DB::table('table_login_details')->where('emp_code',$id)->first();
            if($emp) {
                DB::table('table_login_details')->where('emp_code',$id)->delete();
            }
            DB::table('users')->where('user_code',$id)->delete();
            return response()->json(['message' => 'success']);
        }

    }

    public function updateLoginEmp($id) {

        $emp_data = Login::where('emp_code',$id)->first();
        if($emp_data) {
            $full_name = $emp_data->username;
            $emp_code = $emp_data->emp_code;
            $emp_email = $emp_data->email;
            $employee_type = $emp_data->employee_type;
            $employees_access = $emp_data->employees_access;
            $expenses_access = $emp_data->expenses_access;
            $clients_access = $emp_data->clients_access;
            $invoices_access = $emp_data->invoices_access;
            $salary_slips_access = $emp_data->salary_slips_access;
            $reports_access = $emp_data->reports_access;
            $tasks_access = $emp_data->tasks_access;
            $attendance_access = $emp_data->attendance_access;

            $data = compact('attendance_access','tasks_access','reports_access','salary_slips_access','invoices_access','clients_access','expenses_access','employees_access','emp_data','emp_email','full_name','emp_code','employee_type');
            return view('login.update-new-login')->with($data);
        }
        else {
            return redirect('/');
        }
    }

    public function updateLoginAccess($id, Request $req) {
        $employee = Login::where('emp_code', $id)->first();
        if($employee) {
            $login_user_type = $req->emp_login_user_type_hidden;
             // emp access
             $emp_access = $req->input('emp_access', []);
             // expenses access
             $expenses_access = $req->input('expenses_access', []);
             // clients_access
             $clients_access = $req->input('clients_access', []);
             // invoices_access
             $invoices_access = $req->input('invoices_access', []);
             // salary_slip_access
             $salary_slip_access = $req->input('salary_slip_access', []);
             // reports_access
             $reports_access = $req->input('reports_access', []);
             // tasks_access
             $tasks_access = $req->input('tasks_access', []);
             // attendance_access
             $attendance_access = $req->input('attendance_access', []);


             $employee->employees_access = implode(',', $emp_access);
             $employee->expenses_access = implode(',', $expenses_access);
             $employee->clients_access = implode(',', $clients_access);
             $employee->invoices_access = implode(',', $invoices_access);
             $employee->salary_slips_access = implode(',', $salary_slip_access);
             $employee->reports_access = implode(',', $reports_access);
             $employee->tasks_access = implode(',', $tasks_access);
             $employee->attendance_access = implode(',', $attendance_access);
             $employee->employee_type = $login_user_type;
             $employee->save();
             session()->flash('success', 'Login Access Updated successfully!');
             return redirect('/view-login');
        }
        else {
            return redirect('/create-new-login');
        }
    }
}
