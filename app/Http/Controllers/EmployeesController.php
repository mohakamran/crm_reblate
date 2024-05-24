<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\UserEmployee;
use App\Models\Salary;
use App\Models\Login;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use DB;

class EmployeesController extends Controller
{
    public function viewProfile($id) {
        $emp_data = DB::table('employees')->where('Emp_Code', $id)->first();
        return view('emp.profile',compact('emp_data'));
    }
    // update info employee dashboard
    public function updateEmpInfo(Request $req) {
        $user_code = auth()->user()->user_code;
        $emp_data = DB::table('employees')->where('Emp_Code', $user_code)->first();
        if($emp_data) {
            $validate = $req->validate([
                'employee_name' => 'required|string|max:255',
                'employee_phone' => 'required|numeric',
                'employee_address' => 'required|string',
                'employee_img' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
                'employee_relation' => 'required',
                'employee_relative_name' => 'required',
                'employee_relative_phone_num' => 'required',
                'employee_relative_address' => 'required',
                'emp_cnic' => 'required',
            ]);
            $bank_name = "";
            $bank_iban = "";

            if($req->employee_bank_name == "") {
                $bank_name = "no_bank";
            } else {
                $bank_name = $req->employee_bank_name;
            }
            if($req->employee_bank_iban =="") {
                $bank_iban = "no_iban";
            } else {
                $bank_iban = $req->employee_bank_iban;
            }

                    // check if image is uploaded or not
            if( $req->hasFile('employee_img') ) {
                $image = $req->file('employee_img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('employee_images'), $imageName);

                //  check if there is bank account name or details

                DB::table('employees')->where('Emp_Code',$user_code)->update([
                    'Emp_Image' => 'employee_images/' . $imageName,
                    'Emp_Full_Name' => $req->employee_name,
                    'Emp_Phone' => $req->employee_phone,
                    'Emp_Address' => $req->employee_address,
                    'Emp_Relation' => $req->employee_relation,
                    'Emp_Relation_Name' => $req->employee_relative_name,
                    'Emp_Relation_Phone' => $req->employee_relative_phone_num,
                    'Emp_Relation_Address' => $req->employee_relative_address,
                    'Emp_Bank_Name' => $bank_name,
                    'emp_cnic' => $req->emp_cnic
                ]);

                session()->flash('success', 'Data Updated successfully!');
                return back();
            } else {
                DB::table('employees')->where('Emp_Code',$user_code)->update([
                    // 'Emp_Image' => 'employee_images/' . $imageName,
                    'Emp_Full_Name' => $req->employee_name,
                    'Emp_Phone' => $req->employee_phone,
                    'Emp_Address' => $req->employee_address,
                    'Emp_Relation' => $req->employee_relation,
                    'Emp_Relation_Name' => $req->employee_relative_name,
                    'Emp_Relation_Phone' => $req->employee_relative_phone_num,
                    'Emp_Relation_Address' => $req->employee_relative_address,
                    'Emp_Bank_Name' => $bank_name,
                    'Emp_Bank_IBAN' => $bank_iban,
                    'Emp_Bank_IBAN' => $bank_iban,
                    'emp_cnic' => $req->emp_cnic
                ]);
                session()->flash('success', 'Data Updated successfully!');
                return back();
            }
        }
        else {
            return redirect('/');
        }
    }
    // employee dashboard view
    public function viewEmpSlips() {
        $user_code = auth()->user()->user_code;
        $emp_data = DB::table('employees')->where('Emp_Code', $user_code)->first();
        // dd($emp_data);
        if($emp_data) {
            $title = $emp_data->Emp_Full_Name;
            $btn_text = "Update Data";
            $route="/update-employee-data/".$user_code;
            $data = compact('title', 'emp_data', 'route', 'btn_text');
            return view('emp.add-new-emp-data')->with($data);
        }
        else {
            return redirect('/');
        }
    }

    public function viewInfo() {
        $user_code = auth()->user()->user_code;
        // dd($user_code);
        $emp_data = DB::table('employees')->where('Emp_Code', $user_code)->first();
        // dd($emp_data);
        if($emp_data) {
            $title = $emp_data->Emp_Full_Name;
            $btn_text = "Update Data";
            $route="/update-employee-data/".$user_code;
            $data = compact('title', 'emp_data', 'route', 'btn_text');
            return view('emp.add-new-employee')->with($data);
        }
        else {
            return redirect('/');
        }
    }


    public function index() {
        $title = "Add New Employee";
        $route = "/add-new-employee-data";
        $btn_text = "Add New Employee";
        $data = compact('title', 'route', 'btn_text');
        return view('emp.add-new-employee')->with($data);
    }

    // view employee details
    public function viewEmployeeData($id) {
        // dd($id);
        // $emp_data = Employee::find($id);
        $emp_data = DB::table('employees')->where('Emp_Code',$id)->first();
        // dd($emp_date);
        if($emp_data) {
            $title = $emp_data->Emp_Full_Name;
            $data = compact('title', 'emp_data');
            return view('emp.view-employee-details')->with($data);
        }
        else {
            return redirect('manage-employees');
        }
    }

        // show terminated employees
    public function terminatedEmp() {
        $user_type = Auth()->user()->user_type;


        $latestEmployees = DB::table('employees')
        ->where('Emp_Status', 'disable')
        ->orderBy('Emp_Code', 'asc')
        ->get();

        $totalCount =  DB::table('employees')
        ->where('Emp_Status', 'disable')
        ->orderBy('Emp_Code', 'asc')
        ->count();



        // dd($latestEmployees);
        //$count = Employee::where('Emp_Status', 'active')->orderBy('id', 'desc')->count();
        if($latestEmployees != null) {
            $emp="Reblate Solutions Employees";
            return view('emp.view-employees',compact('latestEmployees','emp','totalCount'));
        } else {
            return redirect('/');
        }
    }

    //show all employees
    public function showAllEmployees() {
        $user_type = Auth()->user()->user_type;

        $latestEmployees = DB::table('employees')
        ->orderBy('Emp_Code', 'asc')
        ->get();

        // dd($latestEmployees);
        //$count = Employee::where('Emp_Status', 'active')->orderBy('id', 'desc')->count();
        $totalCount = DB::table('employees')
        ->orderBy('Emp_Code', 'asc')
        ->count();

        if($latestEmployees != null) {
            $emp="Reblate Solutions Employees";
            return view('emp.view-employees',compact('latestEmployees','emp','totalCount'));
        } else {
            return redirect('/');
        }
    }

    public function manage() {
        // $title = "Update Employee Details";
        // $data = compact('title');
        // $rec = Employee::orderBy('id', 'desc')->get();
        $user_type = Auth()->user()->user_type;

        $latestEmployees = DB::table('employees')
        ->where('Emp_Status', 'active')
        ->orderBy('Emp_Code', 'asc')
        ->get();

        $totalCount = $latestEmployees->count();

        // dd($latestEmployees);
        //$count = Employee::where('Emp_Status', 'active')->orderBy('id', 'desc')->count();
        if($latestEmployees != null) {
            $emp="Reblate Solutions Employees";
            return view('emp.view-employees',compact('latestEmployees','emp','totalCount'));
        } else {
            return redirect('/');
        }

    }

    // get user data and save in database
    public function getData(Request $req) {
        // dd("get");
        $validate = $req->validate([
            'employee_name' => 'required|string|max:255',
            'employee_email' => 'required|email|max:255',
            'employee_phone' => 'required|numeric',
            'employee_designation' => 'required|string',
            'employee_shift_time' => 'required|in:Morning,Night',
            'employee_joining_date' => 'required',
            'employee_address' => 'required|string',
            'employee_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
            'employee_relation' => 'required',
            'employee_relative_name' => 'required',
            'employee_relative_phone_num' => 'required',
            'employee_relative_address' => 'required',
            'employee_code' => 'required|max:255',
            'basic_salary' => 'required ',
            'designation_bonus' => 'required ',
            'travel_allowance' => 'required ',
            'emp_cnic' => 'required'
        ]);



        // check if image is uploaded or not
        if( $req->hasFile('employee_img') ) {
            $image = $req->file('employee_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('employee_images'), $imageName);

            //  check if there is bank account name or details
            if($req->employee_bank_name == "") {
                $bank_name = "no_bank";
            } else {
                $bank_name = $req->employee_bank_name;
            }
            if($req->employee_bank_iban =="") {
                $bank_iban = "no_iban";
            } else {
                $bank_iban = $req->employee_bank_iban;
            }

            // $emp_code = 0;
            // if($req->employee_shift_time == "Morning") {
            //     // get code of last employee
            //     $lastId = Employee::where('Emp_Shift_Time', "Morning")->orderBy('id', 'desc')->value('Emp_Code');
            //     if($lastId == "") {
            //         $emp_code = 200;
            //     }
            //     else {
            //         $emp_code = $lastId+1;
            //     }
            // }
            // else if($req->employee_shift_time == "Night") {
            //     $lastId = Employee::where('Emp_Shift_Time', "Night")->orderBy('id', 'desc')->value('Emp_Code');
            //     if($lastId == "") {
            //         $emp_code = 001;
            //     }
            //     else {
            //         $emp_code = $lastId+1;
            //     }
            // }

            // dd($req->designation_bonus);

            // saving data to database
            $empModel = new Employee();
            $empModel->Emp_Full_Name = $req->employee_name;
            $empModel->Emp_Email = $req->employee_email;
            $empModel->Emp_Phone = $req->employee_phone;
            $empModel->department = $req->employee_department;
            $empModel->Emp_Shift_Time = $req->employee_shift_time;
            $empModel->Emp_Designation = $req->employee_designation;
            $empModel->Emp_Status = "active";
            $empModel->Emp_Joining_Date = $req->employee_joining_date;
            $empModel->Emp_Address = $req->employee_address;
            $empModel->Emp_Image = 'employee_images/' . $imageName;
            $empModel->Emp_Relation = $req->employee_relation;
            $empModel->Emp_Relation_Name = $req->employee_relative_name;
            $empModel->Emp_Relation_Phone = $req->employee_relative_phone_num;
            $empModel->Emp_Relation_Address = $req->employee_relative_address;
            $empModel->Emp_Bank_Name = $bank_name;
            $empModel->Emp_Bank_IBAN = $bank_iban;
            $empModel->Emp_Code = $req->employee_code;
            $empModel->basic_salary = $req->basic_salary;
            $empModel->designation_bonus = $req->designation_bonus;
            $empModel->travel_allowance	 = $req->travel_allowance;
            $empModel->emp_cnic	 = $req->emp_cnic;
            $empModel->save();

            // now adding status in salaries table
            // $empsal = new Salary();
            // $empsal->emp_id = $req->employee_code;
            // $empsal->status = "unpaid";
            // $empsal->date = date('m/y');
            // $empsal->basic_salary = "0";
            // $empsal->basic_salary = "0";
            // $empsal->kpi_bonus = "0";
            // $empsal->deduction = "0";
            // $empsal->project_bonus = "0";
            // $empsal->project_bonus = "0";
            // $empsal->absent_days = "0";
            // $empsal->leave_days = "0";
            // $empsal->reason_of_deduction = "";
            // $empsal->save();

            session()->flash('success', 'Employee added successfully!');
            return back();
        }


    }

    // change Shift
    public function changeShift($id) {
        $emp_data = Employee::find($id);
        if($emp_data !=null) {
            $employee_shift_time = $emp_data->Emp_Shift_Time;
            if($employee_shift_time == "Morning") {
                $employee_shift_time = "Night";
                // $lastId = Employee::where('Emp_Shift_Time', "Morning")->orderBy('id', 'desc')->value('Emp_Code');
                // if($lastId == "") {
                //     $emp_code = 200;
                // }
                // else {
                //     $emp_code = $lastId+1;
                // }

            }
            else if($employee_shift_time == "Night") {
                $employee_shift_time = "Morning";
                // $lastId = Employee::where('Emp_Shift_Time', "Night")->orderBy('id', 'desc')->value('Emp_Code');
                // if($lastId == "") {
                //     $emp_code = 001;
                // }
                // else {
                //     $emp_code = $lastId+1;

                // }
                // echo $emp_code;
            }

            $emp_data->Emp_Shift_Time = $employee_shift_time;
            // $emp_data->Emp_Code = $emp_code;
            $emp_data->save();
            return redirect('manage-employees');
        }
        else {
            return redirect('manage-employees');
        }

    }

    // change status
    public function changeStatus($id) {
        $emp_data = DB::table('employees')->where('Emp_Code',$id)->first();

        if ($emp_data !=null) {

            $get_status = $emp_data->Emp_Status;

            if($get_status == "active") {
                DB::table('employees')->where('Emp_Code',$id)->update([
                    'Emp_Status' => "disable"
                ]);
            } else if($get_status == "disable") {
                DB::table('employees')->where('Emp_Code',$id)->update([
                    'Emp_Status' => "active"
                ]);
            }
            return redirect('manage-employees');
        } else {
            return redirect('manage-employees');
        }
    }

    // delete employee
    public function delEmployee($emp_id) {
        $emp_data = DB::table('employees')->where('Emp_Code', $emp_id)->first();
        // $emp_data = Employee::where('Emp_Code', $emp_data)->first();
        // return $emp_data;
        if($emp_data) {
            $file_path = $emp_data->Emp_Image;
            if (File::exists($file_path)) {
                File::delete($file_path);
                DB::table('employees')->where('Emp_Code', $emp_id)->delete();
                // return redirect('manage-employees');
            } else {
                DB::table('employees')->where('Emp_Code', $emp_id)->delete();
                // return response()->json(['message' => 'success']);
            }
            // $c_employee_user = UserEmployee::where('emp_code',$emp_id)->first();
            $c_employee_user = DB::table('user_employee')->where('emp_code', $emp_id)->first();
            if($c_employee_user) {
                DB::table('user_employee')->where('emp_code', $emp_id)->delete();
            }
            // $login_table_employee_user = Login::where('emp_code',$emp_id)->first();
            $login_table_employee_user = DB::table('user_employee')->where('emp_code', $emp_id)->first();
            if($login_table_employee_user) {
                $login_table_employee_user->delete();
            }
            $login_user_table = DB::table('user_employee')->where('emp_code', $emp_id)->first();
            if($login_user_table) {
                DB::table('user_employee')->where('emp_code', $emp_id)->delete();
            }
            return response()->json(['message' => 'success']);

        } else {
            // return redirect('manage-employees');
            return response()->json(['message' => 'failed']);
        }
    }

    // update employee data
    public function updateEmployee($id) {
        // dd($id);
        $emp_data = DB::table('employees')->where('Emp_Code', $id)->first();
        // dd($emp_data);
        if($emp_data) {
            $title = $emp_data->Emp_Full_Name;
            $btn_text = "Update Data";
            $route="/update-employee-data/".$id;
            $data = compact('title', 'emp_data', 'route', 'btn_text');
            return view('emp.add-new-employee')->with($data);
        }
        else {
            return back();
        }
    }

    // update employee data and update in database
        public function updateEmployeeData($id, Request $req) {

                // dd($req->emp_cnic);
        $id_rec = Employee::where('Emp_Code', $id)->first();

        // $id_rec = DB::table('employees')->where('Emp_Code',$id)->first();
        $imageName = $id_rec->Emp_Image;
        $bank_name = "";
        $bank_iban = "";
        $emp_code = 0;
        if($id_rec) {

                $validate = $req->validate([
                    'employee_name' => 'required|string|max:255',
                    'employee_email' => 'required|email|max:255',
                    'employee_phone' => 'required|numeric',
                    'employee_joining_date' => 'required',
                    'employee_designation' => 'required|string',
                    'employee_address' => 'required|string',
                    'employee_img' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
                    'employee_relation' => 'required',
                    'employee_relative_name' => 'required',
                    'employee_relative_phone_num' => 'required',
                    'employee_relative_address' => 'required',
                    'employee_code' => 'required|max:255',
                    'emp_cnic' => 'required',
                    'employee_shift_time' => 'required',
                ]);

                // dd("this");
                if( $req->hasFile('employee_img') ) {

                    $imgpath = $id_rec->Emp_Image;
                    if (File::exists($imgpath)) {
                        File::delete($imgpath);
                    }

                    $image = $req->file('employee_img');
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $imageName = "employee_images/".$imageName;
                    $image->move(public_path('employee_images'), $imageName);
                }


               //  check if there is bank account name or details
            if($req->employee_bank_name == "") {
                $bank_name = "no_bank";
            } else {
                $bank_name = $req->employee_bank_name;
            }
            if($req->employee_bank_iban =="") {
                $bank_iban = "no_iban";
            } else {
                $bank_iban = $req->employee_bank_iban;
            }


                // saving data to database

                // echo $emp_code."<br>";
                // echo $req->employee_name."<br>";
                // echo $req->employee_email."<br>";
                // echo $req->employee_phone."<br>";
                // echo $req->employee_shift_time."<br>";
                // echo $req->employee_designation."<br>";
                // echo $req->employee_joining_date."<br>";
                // echo $req->employee_address."<br>";
                // echo $imageName."<br>";
                // echo $req->employee_relation."<br>";
                // echo $req->employee_relative_phone_num."<br>";
                // echo $req->employee_relative_name."<br>";
                // echo $req->employee_relative_address."<br>";
                // echo $req->employee_bank_name."<br>";
                // echo $req->employee_bank_iban;


                $id_rec->Emp_Code = $emp_code;
                $id_rec->Emp_Full_Name = $req->employee_name;
                $id_rec->Emp_Email = $req->employee_email;
                $id_rec->Emp_Phone = $req->employee_phone;
                //
                $id_rec->Emp_Designation = $req->employee_designation;
                $id_rec->Emp_Joining_Date = $req->employee_joining_date;
                $id_rec->Emp_Address = $req->employee_address;
                $id_rec->Emp_Image = $imageName;
                $id_rec->Emp_Relation = $req->employee_relation;
                $id_rec->Emp_Relation_Name = $req->employee_relative_name;
                $id_rec->Emp_Relation_Phone = $req->employee_relative_phone_num;
                $id_rec->Emp_Relation_Address = $req->employee_relative_address;
                $id_rec->Emp_Bank_Name = $bank_name;
                $id_rec->Emp_Bank_IBAN = $bank_iban;
                $id_rec->Emp_Code = $req->employee_code;
                $id_rec->department = $req->employee_department;
                $id_rec->basic_salary = $req->basic_salary;
                $id_rec->designation_bonus = $req->designation_bonus;
                $id_rec->travel_allowance = $req->travel_allowance;
                $id_rec->emp_cnic = $req->emp_cnic;
                $id_rec->Emp_Shift_Time = $req->employee_shift_time;


                $id_rec->save();

                session()->flash('success', 'Employee Updated successfully!');
                return back();


        } else {
            return redirect('/');
        }

    }
}
