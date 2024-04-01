<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class TaskController extends Controller
{
       // get task report and save in database
       public function taskUpdateDatabase(Request $req, $id) {
            $validatedData = $req->validate([
                'task_desc' => 'required',
                'task_status' => 'required'
            ]);
       }
       // to update task open form for task update
       public function taskUpdateForm($id) {
        //  dd($id);
        $task = DB::table('tasks')->where('id',$id)->first();
        // dd($task);
        $emp_id = auth()->user()->user_code;
        $emp = DB::table('employees')->where('Emp_Code',$emp_id)->first();
        $emp_name = $emp->Emp_Full_Name;
        $Emp_Designation = $emp->Emp_Designation;
        $Emp_Image = $emp->Emp_Image;
        $Emp_Shift_Time = $emp->Emp_Shift_Time;

        return view('tasks.update-task-form',compact('task','emp_name','Emp_Designation','Emp_Image','Emp_Shift_Time'));
       }
       // employee will see cards based tasks
       public function employeeCanSeeTask() {
            $emp_id = auth()->user()->user_code;
            $emp = DB::table('employees')->where('Emp_Code',$emp_id)->first();
            $emp_name = $emp->Emp_Full_Name;
            $Emp_Designation = $emp->Emp_Designation;
            $Emp_Image = $emp->Emp_Image;
            $Emp_Shift_Time = $emp->Emp_Shift_Time;

            $currentMonth = Carbon::now()->format('m');

            $tasks = DB::table('tasks')
            ->where('emp_id', $emp_id)
            // ->whereMonth('assigned_date', $currentMonth)
            ->orderBy('id', 'desc')
            ->get();

            // dd($tasks);

            return view('tasks.tasks-cards-of-each-employee',compact('tasks','emp_name','emp_id','Emp_Designation','Emp_Image','Emp_Shift_Time'));
       }
       // get task details and save in database
       public function updateEachTaskEmp(Request $request) {
        $validatedData = $request->validate([
            'task_title' => 'required',
            'task_date' => 'required',
            'task_description' => 'required'
        ]);

        $task_title = $request->task_title;
        $task_id = $request->task_id;
        $task_date = $request->task_date;
        $task_description = $request->task_description;
        // dd($task_id);
        // Update task in the database
        DB::table('tasks')->where('id', $task_id)->update([
            'task_title' => $task_title,
            'task_date' => $task_date,
            'task_description' => $task_description
        ]);

        // Redirect back with success message
        return back()->with('success', 'Task updated successfully!');

        // Proceed with your update logic
    }
        // update each task of employe in database
        public function updateEachTask(Request $req) {
            $emp_id = $req->emp_id;
            $task_id = $req->task_id;
            // $task_date = $req->task_date;
            // echo $emp_id."<br>";
            // echo $task_id."<br>";
            // return;

            $tasks = DB::table('tasks')
                ->where('emp_id', $emp_id)
                ->where('id', $task_id)
                ->first();
            // dd($tasks->task_title);

            $emp = DB::table('employees')->where('Emp_Code',$emp_id)->first();
            $emp_name = $emp->Emp_Full_Name;
            $Emp_Designation = $emp->Emp_Designation;
            $Emp_Image = $emp->Emp_Image;
            $Emp_Shift_Time = $emp->Emp_Shift_Time;

            return view('tasks.update-form',compact('task_id','tasks','emp_name','emp_id','Emp_Designation','Emp_Image','Emp_Shift_Time'));
        }
        // update task of each employee
        public function updateTaskEachEmployee($id) {
            // dd($id);
            $emp = DB::table('employees')->where('Emp_Code',$id)->first();
            $emp_name = $emp->Emp_Full_Name;
            $emp_id = $id;
            $tasks = DB::table('tasks')->where('emp_id',$id)->orderBy('id','desc')->get();
            return view('tasks.update-task',compact('tasks','emp_name','emp_id'));
        }
        // admin can see all tasks assigned of each employee
        public function viewTaskEachEmployee(Request $req) {
            $emp_id = $req->hidden_emp_value;
            $emp = DB::table('employees')->where('Emp_Code',$emp_id)->first();
            $emp_name = $emp->Emp_Full_Name;
            $Emp_Designation = $emp->Emp_Designation;
            $Emp_Image = $emp->Emp_Image;
            $Emp_Shift_Time = $emp->Emp_Shift_Time;
            $tasks = DB::table('tasks')
            ->where('emp_id', $emp_id)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
            return view('tasks.tasks-cards-of-each-employee',compact('tasks','emp_name','emp_id','Emp_Designation','Emp_Image','Emp_Shift_Time'));
            // dd($emp_id);
        }
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
        // Fetch latest employees
        $latestEmployees = DB::table('employees')->get();

        if ($latestEmployees->isNotEmpty()) {
            // $latestTasks = DB::table('tasks')->get();
            // Pass the data to the view
            // dd($latestTasks);
            return view('tasks.view', compact('latestEmployees'));
        } else {
            // If no employees found, redirect back
            return back();
        }
    }
    public function addNewTask(Request $request) {
        // Get the name of the authenticated user
        $name = Auth()->user()->user_name;

        // Validate the incoming request data
        $request->validate([
            'emp_name' => 'required',
            'first_task_title' => 'required',
            'first_task_deadline' => 'required|date',
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

        // Get the current date and time
        $dateAssigned = now();

        // Insert the first task
        DB::table('tasks')->insert([
            'emp_id' => $empId,
            'task_title' => $first_task_title,
            'task_description' => $first_task_description,
            'task_date' => $first_task_deadline,
            'task_status' => "pending",
            'task_percentage' => "0",
            'assigned_by' => $name, // Assuming admin is the default assigned_by value
            'assigned_date' => $dateAssigned, // Save the current date as date_assigned
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
                    'task_percentage' => "0",
                    'assigned_by' => 'admin', // Assuming admin is the default assigned_by value
                    'assigned_date' => $dateAssigned, // Save the current date as date_assigned
                ];
            }
            DB::table('tasks')->insert($tasks);
        }

        return back()->with('success','Task Assigned');
    }


}
