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

    // send credentials to new employee without adding employee data to database
    public function registerNewEmployeeLogin(Request $req) {

        $req->validate([
            'emp_login_name' => 'required',
            'emp_login_email' => 'required',
            'emp_code' => 'required',
            'emp_login_user_type_hidden' => 'required',
            'employee_department' => 'required',
            'employee_designation' => 'required',
            'employee_shift_time' => 'required',
            'employee_joining_date' => 'required'
        ]);

        $user_access = DB::table('users')
        ->where('user_code', $req->emp_code)
        ->where('user_type', $req->emp_login_user_type_hidden)
        ->first();

        $user_email = DB::table('users')
        ->orWhere('user_email', $req->emp_login_email)
        ->first();

        if($user_access) {
            return redirect()->back()->withInput()->with('error', 'Employee Code Already Exists! Use another one.');
        }

        if($user_email) {
            return redirect()->back()->withInput()->with('error', 'Email Already Exists! Use another one.');
        }

        $emp_data = $req->emp_data;
        $expenses_data = $req->expenses_data;
        $clients_data = $req->clients_data;
        $invoices_data = $req->invoices_data;
        $salary_slip_data = $req->salary_slip_data;
        $reports_data = $req->reports_data;
        $tasks_data = $req->tasks_data;
        $attendance_data = $req->attendance_data;

        $login_user_name = $req->emp_login_name;
        $login_user_email = $req->emp_login_email;
        $login_user_type = $req->emp_login_user_type_hidden;
        $login_user_code = $req->emp_code;
        $employee_designation = $req->employee_designation;
        $employee_shift_time = $req->employee_shift_time;
        $employee_joining_date = $req->employee_joining_date;
        $employee_department = $req->employee_department;
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

        // $data = compact('login_user_code', 'employee_designation' ,'employee_shift_time' ,'employee_joining_date', 'employee_department', 'login_user_email','login_user_name', 'randomPassword' );
        // $mail_subject = "Reblate Solutions Invited You For A New Role";

        // Mail::send('login.email-template-two', $data, function ($message) use ($mail_subject, $login_user_email) {
        //     $message->to($login_user_email)
        //             ->subject($mail_subject);
        // });

        $login = DB::table('table_login_details')
        ->where('emp_code', $login_user_code)
        ->where('employee_type', $login_user_type)
        ->first();
        if($login) {
                 DB::table('table_login_details')->where('id',$login->id)->update([
                'emp_code' => $login_user_code,
                'employee_type' => $login_user_type,
                'username' => $login_user_name,
                'email' => $login_user_email,
                'employees_access' => implode(',', $emp_access),
                'expenses_access' => implode(',', $expenses_access),
                'clients_access' => implode(',', $clients_access),
                'invoices_access' => implode(',', $invoices_access),
                'salary_slips_access' => implode(',', $salary_slip_access),
                'reports_access' => implode(',', $reports_access),
                'tasks_access' => implode(',', $tasks_access),
                'attendance_access' => implode(',', $attendance_access),
                'emp_data' =>  $emp_data,
                'expenses_data' =>  $expenses_data,
                'clients_data' =>  $clients_data,
                'salary_slip_data' =>  $salary_slip_data,
                'invoices_data' =>  $invoices_data,
                'reports_data' =>  $reports_data,
                'tasks_data' =>  $tasks_data,
                'attendance_data' =>  $attendance_data,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            DB::table('table_login_details')->insert([
                'emp_code' => $login_user_code,
                'employee_type' => $login_user_type,
                'username' => $login_user_name,
                'email' => $login_user_email,
                'employees_access' => implode(',', $emp_access),
                'expenses_access' => implode(',', $expenses_access),
                'clients_access' => implode(',', $clients_access),
                'invoices_access' => implode(',', $invoices_access),
                'salary_slips_access' => implode(',', $salary_slip_access),
                'reports_access' => implode(',', $reports_access),
                'tasks_access' => implode(',', $tasks_access),
                'attendance_access' => implode(',', $attendance_access),
                'emp_data' =>  $emp_data,
                'expenses_data' =>  $expenses_data,
                'clients_data' =>  $clients_data,
                'salary_slip_data' =>  $salary_slip_data,
                'invoices_data' =>  $invoices_data,
                'reports_data' =>  $reports_data,
                'tasks_data' =>  $tasks_data,
                'attendance_data' =>  $attendance_data,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

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

        return redirect()->back()->with('success', 'Login Invitation Sent successfully!');

    }



    // create login and save data in databse
    public function registerLoginEmp($id, Request $req) {

        $employee = Employee::where('Emp_Code', $id)->first();


        if($employee) {
            $user_access = DB::table('users')->where('user_code',$req->emp_login_code_hidden)->where('user_type',$req->emp_login_user_type_hidden)->first();
            if($user_access) {
                return redirect()->back()->with('error', 'Employee have already account! You can not create another one.');
            }

            $emp_data = $req->emp_data;
            $expenses_data = $req->expenses_data;
            $clients_data = $req->clients_data;
            $invoices_data = $req->invoices_data;
            $salary_slip_data = $req->salary_slip_data;
            $reports_data = $req->reports_data;
            $tasks_data = $req->tasks_data;
            $attendance_data = $req->attendance_data;

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

            Mail::send('login.email-template-two', $data, function ($message) use ($mail_subject, $login_user_email) {
                $message->to($login_user_email)
                        ->subject($mail_subject);
            });

            $login = DB::table('table_login_details')
            ->where('emp_code', $login_user_code)
            ->where('employee_type', $login_user_type)
            ->first();
            if($login) {
                     DB::table('table_login_details')->where('id',$login->id)->update([
                    'emp_code' => $login_user_code,
                    'employee_type' => $login_user_type,
                    'username' => $login_user_name,
                    'email' => $login_user_email,
                    'employees_access' => implode(',', $emp_access),
                    'expenses_access' => implode(',', $expenses_access),
                    'clients_access' => implode(',', $clients_access),
                    'invoices_access' => implode(',', $invoices_access),
                    'salary_slips_access' => implode(',', $salary_slip_access),
                    'reports_access' => implode(',', $reports_access),
                    'tasks_access' => implode(',', $tasks_access),
                    'emp_data' =>  $emp_data,
                    'expenses_data' =>  $expenses_data,
                    'clients_data' =>  $clients_data,
                    'salary_slip_data' =>  $salary_slip_data,
                    'invoices_data' =>  $invoices_data,
                    'reports_data' =>  $reports_data,
                    'tasks_data' =>  $tasks_data,
                    'attendance_data' =>  $attendance_data,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            } else {
                DB::table('table_login_details')->insert([
                    'emp_code' => $login_user_code,
                    'employee_type' => $login_user_type,
                    'username' => $login_user_name,
                    'email' => $login_user_email,
                    'employees_access' => implode(',', $emp_access),
                    'expenses_access' => implode(',', $expenses_access),
                    'clients_access' => implode(',', $clients_access),
                    'invoices_access' => implode(',', $invoices_access),
                    'salary_slips_access' => implode(',', $salary_slip_access),
                    'reports_access' => implode(',', $reports_access),
                    'tasks_access' => implode(',', $tasks_access),
                    'emp_data' =>  $emp_data,
                    'expenses_data' =>  $expenses_data,
                    'clients_data' =>  $clients_data,
                    'salary_slip_data' =>  $salary_slip_data,
                    'invoices_data' =>  $invoices_data,
                    'reports_data' =>  $reports_data,
                    'tasks_data' =>  $tasks_data,
                    'attendance_data' =>  $attendance_data,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

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

            return redirect()->back()->with('success', 'Login Invitation Sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Employee Not Found! First Add Employee Data and then send invitation or you can send invitation directly!');
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
        // Sanitize the input $id
        $id = intval($id);

        // Check if the user exists
        $emp_data = DB::table('users')->where('user_code', $id)->first();

        if ($emp_data) {
            // Check if login details exist for the user
            $emp_login = DB::table('table_login_details')->where('emp_code', $id)->first();

            if ($emp_login) {
                // Delete login details
                DB::table('table_login_details')->where('emp_code', $id)->delete();
            }

            // Delete user
            DB::table('users')->where('user_code', $id)->delete();

            return response()->json(['message' => 'User and associated login details successfully deleted.']);
        } else {
            // User does not exist
            return response()->json(['message' => 'User not found.'], 404);
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


            $emp_access = $emp_data->emp_data;
            $expenses_data = $emp_data->expenses_data;
            $clients_data = $emp_data->clients_data;
            $invoices_data = $emp_data->invoices_data;
            $salary_slip_data = $emp_data->salary_slip_data;
            $reports_data = $emp_data->reports_data;
            $tasks_data = $emp_data->tasks_data;
            $attendance_data = $emp_data->attendance_data;



            $data = compact('emp_access','expenses_data','clients_data','invoices_data','salary_slip_data','reports_data','tasks_data','attendance_data','attendance_access','tasks_access','reports_access','salary_slips_access','invoices_access','clients_access','expenses_access','employees_access','emp_data','emp_email','full_name','emp_code','employee_type');
            return view('login.update-new-login')->with($data);
        }
        else {
            return redirect('/');
        }
    }

    public function updateLoginAccess($id, Request $req) {
        $employee = Login::where('emp_code', $id)->first();
        if($employee) {
            $emp_id = $employee->id;
            // dd($emp_id);
            $login_user_type = $req->emp_login_user_type_hidden;
             // emp access
             $emp_access = $req->input('emp_access', []);
            //  dd($emp_access);
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


            $emp_access = $req->emp_data;
            $expenses_data = $req->expenses_data;
            $clients_data = $req->clients_data;
            $invoices_data = $req->invoices_data;
            $salary_slip_data = $req->salary_slip_data;
            $reports_data = $req->reports_data;
            $tasks_data = $req->tasks_data;
            $attendance_data = $req->attendance_data;

            DB::table('table_login_details')->where('id',$emp_id)->update([
                'employee_type' => $login_user_type,
                'employees_access' => implode(',', $emp_access),
                'expenses_access' => implode(',', $expenses_access),
                'clients_access' => implode(',', $clients_access),
                'invoices_access' => implode(',', $invoices_access),
                'salary_slips_access' => implode(',', $salary_slip_access),
                'reports_access' => implode(',', $reports_access),
                'tasks_access' => implode(',', $tasks_access),
                'emp_data' =>  $emp_access,
                'expenses_data' =>  $expenses_data,
                'clients_data' =>  $clients_data,
                'salary_slip_data' =>  $salary_slip_data,
                'invoices_data' =>  $invoices_data,
                'reports_data' =>  $reports_data,
                'tasks_data' =>  $tasks_data,
                'attendance_data' =>  $attendance_data,
                'created_at' => now(),
                'updated_at' => now()
            ]);


             return redirect()->back()->with('success','Access Updated Successfully!');
        }
        else {
            return redirect()->back()->with('error','User Not Found!');
        }
    }
}
