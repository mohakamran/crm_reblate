<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TaskController extends Controller
{
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
                   return view('tasks.search-results',$data);
                } else {
                     $latestEmployees = DB::table('employees')->get();
                     $error = "Employee ID Not Found!";
                     return view('tasks.view',compact('latestEmployees','error'));
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
                 return view('tasks.view',compact('latestEmployees'));
              } else {
                   $latestEmployees = DB::table('employees')->get();
                   $error = "Employee Name Not Found!";
                   return view('tasks.view',compact('latestEmployees','error'));
              }
            }
            if($emp_designation!=null) {
                $latestEmployees = DB::table('employees')->where('Emp_Designation',$emp_designation)->get();
                if($latestEmployees) {
                 return view('tasks.view',compact('latestEmployees'));
              } else {
                   $latestEmployees = DB::table('employees')->get();
                   $error = "Employee ID Not Found!";
                   return view('tasks.view',compact('latestEmployees','error'));
              }

            }

            if($emp_shift!=null) {
             $latestEmployees = DB::table('employees')->where('Emp_Shift_Time',$emp_shift)->get();
             if($latestEmployees) {
                 return view('tasks.view',compact('latestEmployees'));
             } else {
                  $latestEmployees = DB::table('employees')->get();
                  $error = "Employee ID Not Found!";
                  return view('tasks.view',compact('latestEmployees','error'));
             }
         }
        }
        public function index() {
            $emp = DB::table('employees')->get();
            return view('tasks.add-task',compact('emp'));
        }

    // view tasks
    public function viewTasks() {
        $latestEmployees = DB::table('employees')->get();
        // dd($latestEmployees);
        if ($latestEmployees) {
            return view('tasks.view',compact('latestEmployees'));
        } else {
            return back();
        }
    }
    public function addNewTask(Request $request) {
        $name = Auth()->user()->user_name;
        // Validate the incoming request data
        $request->validate([
            'emp_name' => 'required',
            'first_task_title' => 'required',
            'first_task_deadline' => 'required',
            'first_task_description' => 'required',
            'task_title.*' => 'string',
            'task_deadline.*' => 'date',
            'task_description.*' => 'string',
        ]);

        // Retrieve data from the form
        $empId = $request->input('emp_name');
        $first_task_title = $request->input('first_task_title');
        $first_task_description = $request->input('first_task_description');
        $first_task_deadline = $request->input('first_task_deadline');

        // Insert the first task
        DB::table('tasks')->insert([
            'emp_id' => $empId,
            'task_title' => $first_task_title,
            'task_description' => $first_task_description,
            'task_date' => $first_task_deadline,
            'task_status' => "pending",
            'assigned_by' => $name, // Assuming admin is the default assigned_by value
        ]);

        // Check if additional tasks were added
        if ($request->has('task_title')) {
            // Retrieve data for additional tasks
            $titles = $request->input('task_title');
            $deadlines = $request->input('task_deadline');
            $descriptions = $request->input('task_description');

            // Insert additional tasks
            $tasks = [];
            foreach ($titles as $index => $title) {
                $tasks[] = [
                    'emp_id' => $empId,
                    'task_title' => $title,
                    'task_description' => $descriptions[$index],
                    'task_date' => $deadlines[$index],
                    'task_status' => 'pending',
                    'assigned_by' => 'admin', // Assuming admin is the default assigned_by value
                ];
            }
            DB::table('tasks')->insert($tasks);
        }

        return back()->with('success','Task Assigned');
    }

}
