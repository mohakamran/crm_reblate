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
    // update employee photo
    public function updatePhotoEmp(Request $request) {
        // Retrieve the file and emp_code_file from the request
        $file = $request->file('fileInput');
        $emp_code_file = $request->input('emp_code_file');

        // Check if file was retrieved successfully
        if ($file === null) {
            return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
        }

        // Define the storage path

        $newFileName = $emp_code_file . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('employee_images'), $newFileName);

        // Get the relative URL of the stored file
        $relativeFilePath = 'employee_images/' . $newFileName;

        // Update the employees table with the new file path
        DB::table('employees')
            ->where('Emp_Code', $emp_code_file)
            ->update(['Emp_Image' => $relativeFilePath]);

        // Return a success response
        return response()->json(['success' => true, 'message' => 'Data received successfully']);

    }
    // update work experience
    public function updateWorkEmp(Request $request) {
        $id = $request->update_id;
        $record = DB::table('emp_experience')->where('id',$id)->first();
        if ($record) {
            $work_emp_company = $request->input('work_emp_company');
            $work_emp_position = $request->input('work_emp_position');
            $work_start_date = $request->input('work_start_date');
            $work_end_date = $request->input('work_end_date');

            DB::table('emp_experience')->where('id',$id)->update([
                'company_name' => $work_emp_company,
                'position' => $work_emp_position,
                'start_date' => $work_start_date,
                'end_date' => $work_end_date
            ]);
            return response()->json(['success' => true, 'message' => 'Data received successfully']);
        } else {
            // Return a failure JSON response if the record was not found
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }
    }
    // update education
    public function updateEduEmp(Request $request) {
        $id = $request->update_id;
        $record = DB::table('emp_education')->where('id',$id)->first();
        if ($record) {
            $education_institute_name = $request->input('education_institute_name');
            $education_degree_name = $request->input('education_degree_name');
            $education_start_date = $request->input('education_start_date');
            $education_end_date = $request->input('education_end_date');

            DB::table('emp_education')->where('id',$id)->update([
                'institute_name' => $education_institute_name,
                'degree' => $education_degree_name,
                'start_date' => $education_start_date,
                'end_date' => $education_end_date
            ]);
            return response()->json(['success' => true, 'message' => 'Data received successfully']);
        } else {
            // Return a failure JSON response if the record was not found
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }
    }
    // remove work experience
    public function removeWorkEmp($id) {
        $record = DB::table('emp_experience')->where('id',$id)->first();
        if ($record) {
            // Delete the record if it exists
            DB::table('emp_experience')->where('id', $id)->delete();
            // Return a success JSON response
            return response()->json(['success' => true, 'message' => 'Record deleted successfully']);
        } else {
            // Return a failure JSON response if the record was not found
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }

    }
    // remvoe emp education
    public function removeEduEmp($id) {
        $record = DB::table('emp_education')->where('id',$id)->first();
        if ($record) {
            // Delete the record if it exists
            DB::table('emp_education')->where('id', $id)->delete();
            // Return a success JSON response
            return response()->json(['success' => true, 'message' => 'Record deleted successfully']);
        } else {
            // Return a failure JSON response if the record was not found
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }

    }
    // addWorkEmp
    public function addWorkEmp(Request $request) {
        $work_emp_company = $request->input('work_emp_company');
        $work_emp_position = $request->input('work_emp_position');
        $work_start_date = $request->input('work_start_date');
        $work_end_date = $request->input('work_end_date');

        $emp_code_hidden = $request->input('emp_code');
        DB::table('emp_experience')->insert([
            'company_name' => $work_emp_company,
            'position' => $work_emp_position,
            'start_date' => $work_start_date,
            'end_date' => $work_end_date,
            'emp_code' => $emp_code_hidden,
        ]);
        // Send the data back as JSON response
        return response()->json(['message' => 'Data received successfully']);
    }
    // education of employee add
    public function addEducationEmp(Request $request) {
        $education_institute_name = $request->input('education_institute_name');
        $education_degree_name = $request->input('education_degree_name');
        $education_start_date = $request->input('education_start_date');
        $education_end_date = $request->input('education_end_date');

        $emp_code_hidden = $request->input('emp_code');



        DB::table('emp_education')->insert([
            'institute_name' => $education_institute_name,
            'degree' => $education_degree_name,
            'start_date' => $education_start_date,
            'end_date' => $education_end_date,
            'emp_code' => $emp_code_hidden,
        ]);
        // Send the data back as JSON response
        return response()->json(['message' => 'Data received successfully']);
    }
    // updateInfoCon
    public function updateInfoContact(Request $request) {

        $secondary_employee_relative_address = $request->input('secondary_employee_relative_address');
        $secondary_employee_relative_phone_num = $request->input('secondary_employee_relative_phone_num');
        $secondary_employee_relation_name = $request->input('secondary_employee_relation_name');
        $secondary_employee_relation = $request->input('secondary_employee_relation');

        $Emp_Relation_Address = $request->input('Emp_Relation_Address');
        $Emp_Relation_Phone = $request->input('Emp_Relation_Phone');
        $Emp_Relation = $request->input('Emp_Relation');
        $Emp_Relation_Name = $request->input('Emp_Relation_Name');

        $emp_code_hidden = $request->input('emp_code');


        DB::table('employees')->where('Emp_Code',$emp_code_hidden)->update([

            'secondary_employee_relative_address' => $secondary_employee_relative_address,
            'secondary_employee_relative_phone_num' => $secondary_employee_relative_phone_num,
            'secondary_employee_relation_name' => $secondary_employee_relation_name,
            'secondary_employee_relation' => $secondary_employee_relation,

            'Emp_Relation' => $Emp_Relation,
            'Emp_Relation_Name' => $Emp_Relation_Name,
            'Emp_Relation_Phone' => $Emp_Relation_Phone,
            'Emp_Relation_Address' => $Emp_Relation_Address,

        ]);
        // Send the data back as JSON response
        return response()->json(['message' => 'Data received successfully']);
    }
    // bank info
    public function updateInfoBank(Request $request) {
        $branch_code = $request->input('branch_code');
        $branch_name = $request->input('branch_name');
        $account_number = $request->input('account_number');
        $bank_iban = $request->input('bank_iban');
        $account_title = $request->input('account_title');
        $emp_code = $request->input('emp_code');
        $bank_name = $request->input('bank_name');

        DB::table('employees')->where('Emp_Code',$emp_code)->update([
            'account_title' => $account_title,
            'account_number' => $account_number,
            'branch_name' => $branch_name,
            'branch_code' => $branch_code,
            'Emp_Bank_IBAN' => $bank_iban,
            'Emp_Bank_Name' => $bank_name,
        ]);
        // Send the data back as JSON response
        return response()->json(['message' => 'Data received successfully']);
    }
    // salary info
    public function updateInfoSalary(Request $request) {
        $emp_basic_salary = $request->input('emp_basic_salary');
        $emp_designation_bonus = $request->input('emp_designation_bonus');
        $emp_travel_allowance = $request->input('emp_travel_allowance');
        $emp_code = $request->input('emp_code');

        DB::table('employees')->where('Emp_Code',$emp_code)->update([
            'basic_salary' => $emp_basic_salary,
            'designation_bonus' => $emp_designation_bonus,
            'travel_allowance' => $emp_travel_allowance,
        ]);
        // Send the data back as JSON response
        return response()->json(['message' => 'Data received successfully']);

    }
    // update info company
    public function updateInfoCom(Request $request) {

        $emp_code_input = $request->input('emp_code_input');
        $department = $request->input('department');
        $Emp_Designation = $request->input('Emp_Designation');
        $Emp_Shift_Time = $request->input('emp_shift_time');
        $emp_joining_date = $request->input('emp_joining_date');
        $emp_code = $request->input('emp_code');

        // Prepare the data to be sent back
        $data = [
            'emp_code_input' => $emp_code_input,
            'department' => $department,
            'Emp_Designation' => $Emp_Designation,
            'Emp_Shift_Time' => $Emp_Shift_Time,
            'emp_joining_date' => $emp_joining_date,
            'emp_code' => $emp_code,
        ];



        DB::table('employees')->where('Emp_Code',$emp_code)->update([
            'department' => $department,
            'Emp_Designation' => $Emp_Designation,
            'Emp_Joining_Date' => $emp_joining_date,
            'Emp_Shift_Time' => $Emp_Shift_Time,
        ]);
        // Send the data back as JSON response
        return response()->json(['message' => 'Data received successfully']);

    }
    // update personal info
    public function updateInfoEmp(Request $request) {
        $passport_number = $request->input('passport_number');
        $passportExp = $request->input('passportExp');
        $phoneNo = $request->input('phoneNo');
        $emp_gender = $request->input('emp_gender');
        $emp_marital_status = $request->input('emp_marital_status');
        $emp_birthday = $request->input('emp_birthday');
        $emp_code = $request->input('emp_code');

        DB::table('employees')->where('Emp_Code',$emp_code)->update([
            'Emp_Passport_Number' => $passport_number,
            'emp_cnic' => $passportExp,
            'Emp_Phone' => $phoneNo,
            'Emp_Gender' => $emp_gender,
            'Emp_Marital_Status' => $emp_marital_status,
            'emp_birthday' => $emp_birthday
        ]);

        // Send the data back as JSON response
        return response()->json(['message' => 'Data received successfully']);
    }
    public function viewProfile($id) {

        $emp_data = DB::table('employees')->where('Emp_Code', $id)->first();
        $education = DB::table('emp_education')->orderBy('id','desc')->where('emp_code', $id)->get();
        $experience = DB::table('emp_experience')->orderBy('id','desc')->where('emp_code', $id)->get();
        // dd($education);

        if (Auth()->user()->user_type == "employee") {
            if ($emp_data && $emp_data->Emp_Code != null) {
                if (Auth()->user()->user_code != $emp_data->Emp_Code) {
                    return view('errors.401');
                }
            } else {
                return view('errors.401');
            }
        }

        return view('emp.profile',compact('emp_data','education','experience'));
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
            'Emp_Gender' => 'required',
            'Emp_Marital_Status' => 'required',
            'emp_cnic' => 'required',
            'employee_department' => 'required',
            'employee_relative_address' => 'required',
            'emp_birthday' => 'required'
        ]);

        $emp_code = DB::table('employees')->where('Emp_Code', $req->employee_code)->first();
        $emp_email = DB::table('employees')->where('Emp_Email', $req->employee_email)->first();

        if ($emp_code) {
            return back()->withErrors(['employee_code' => 'Employee Code Already Exists! Use another one'])->withInput();
        }

        if ($emp_email) {
            return back()->withErrors(['employee_email' => 'Employee Email Already Exists! Use another one'])->withInput();
        }



        // check if image is uploaded or not
        if( $req->hasFile('employee_img') ) {

            $name = $req->employee_name;
            $employee_phone = $req->employee_phone;
            $employee_email = $req->employee_email;
            $employee_img = $req->employee_img;
            $Emp_Gender = $req->Emp_Gender;
            $Emp_Marital_Status = $req->Emp_Marital_Status;
            $Emp_Passport_Number = $req->Emp_Passport_Number;
            $emp_cnic = $req->emp_cnic;

            $emp_birthday = $req->emp_birthday;
            $employee_address = $req->employee_address;
            $employee_code = $req->employee_code;
            $employee_department = $req->employee_department;
            $employee_designation = $req->employee_designation;
            $employee_shift_time = $req->employee_shift_time;
            $employee_joining_date = $req->employee_joining_date;

            $basic_salary = $req->basic_salary;
            $designation_bonus = $req->designation_bonus;
            $travel_allowance = $req->travel_allowance;

            $employee_relation = $req->employee_relation;
            $employee_relative_name = $req->employee_relative_name;
            $employee_relative_phone_num = $req->employee_relative_phone_num;
            $employee_relative_address = $req->employee_relative_address;

            $secondary_employee_relation = $req->secondary_employee_relation;
            $secondary_employee_relation_name = $req->secondary_employee_relation_name;
            $secondary_employee_relative_phone_num = $req->secondary_employee_relative_phone_num;
            $secondary_employee_relative_address = $req->secondary_employee_relative_address;

            $employee_bank_iban = $req->employee_bank_iban;
            $account_number = $req->account_number;
            $account_title = $req->account_title;
            $account_number = $req->account_number;
            $branch_name = $req->branch_name;
            $branch_code = $req->branch_code;

            $emp_education = $req->emp_education;
            $emp_degree = $req->emp_degree;
            $emp_education_start = $req->emp_education_start;
            $emp_education_end = $req->emp_education_end;

            $emp_company = $req->emp_company;
            $emp_position = $req->emp_position;
            $emp_work_start = $req->emp_work_start;
            $emp_work_end = $req->emp_work_end;

            for ($i = 0; $i < count($req->emp_education); $i++) {
                DB::table('emp_education')->insert([
                    'institute_name' => $req->emp_education[$i],
                    'degree' => $req->emp_degree[$i],
                    'start_date' => $req->emp_education_start[$i],
                    'end_date' => $req->emp_education_end[$i],
                    'emp_code' => $employee_code // Assuming $employee_code is the correct variable
                ]);
            }

            for ($i = 0; $i < count($req->emp_company); $i++) {
                DB::table('emp_experience')->insert([
                    'company_name' => $req->emp_company[$i],
                    'position' => $req->emp_position[$i],
                    'start_date' => $req->emp_work_start[$i],
                    'end_date' => $req->emp_work_end[$i],
                    'emp_code' => $employee_code // Assuming $employee_code is the correct variable
                ]);
            }

            $image = $req->file('employee_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('employee_images'), $imageName);

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

            $empModel->Emp_Bank_Name = $req->employee_bank_name;
            $empModel->Emp_Bank_IBAN = $req->employee_bank_iban;
            $empModel->account_title	 = $req->account_title;
            $empModel->account_number	 = $req->account_number;
            $empModel->branch_name	 = $req->branch_name;
            $empModel->branch_code	 = $req->branch_code;

            $empModel->Emp_Code = $req->employee_code;
            $empModel->emp_birthday = $req->emp_birthday;

            $empModel->basic_salary = $req->basic_salary;
            $empModel->designation_bonus = $req->designation_bonus;
            $empModel->travel_allowance	 = $req->travel_allowance;
            $empModel->emp_cnic	 = $req->emp_cnic;

            $empModel->Emp_Gender	 = $req->Emp_Gender;
            $empModel->Emp_Marital_Status	 = $req->Emp_Marital_Status;
            $empModel->Emp_Passport_Number	 = $req->Emp_Passport_Number;

            $empModel->secondary_employee_relation	 = $req->secondary_employee_relation;
            $empModel->secondary_employee_relation_name	 = $req->secondary_employee_relation_name;
            $empModel->secondary_employee_relative_phone_num	 = $req->secondary_employee_relative_phone_num;
            $empModel->secondary_employee_relative_address	 = $req->secondary_employee_relative_address;



            $empModel->save();

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
