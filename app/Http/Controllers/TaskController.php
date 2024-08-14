<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function updateStatus(Request $request)
    {

        // Update the task status in the database
        $updated = DB::table('to_do_list')
                    ->where('id', $request->id)
                    ->update(['status' => $request->status]);

        // Check if the update was successful
        if ($updated) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
    // emmployee adds today tasks completed
    public function todayTaskAdd(Request $request) {
        $tasks = $request->input('tasks');
        $emp_id = auth()->user()->user_code;
        $date  = date('Y-m-d');
        foreach ($tasks as $task) {
            DB::table('tasks')->insert([
                'emp_id' => $emp_id,
                'task_title' => $task['title'],
                'task_description' => $task['description'],
                'task_report' => $task['description'],
                'task_status' => "completed",
                'assigned_date' => $date,
                'task_date' => $date,
                'task_type' => "employee-task",
                'assigned_by' => auth()->user()->user_name
            ]);
        }
        return response()->json(['message' => true]);
    }
    // crearte task by emp
    public function saveToDoTaskByEmp(Request $request)
    {
        // Validate incoming request data (optional but recommended)
        // $validatedData = $request->validate([
        //     'title' => 'required|string|max:255',
        //     'userName' => 'required|string|max:255',
        //     'userCode' => 'required|string|max:255',
        //     'date' => 'required|date',
        //     'time' => 'required|string',
        // ]);

        try {
            // Insert data into database using DB facade and get the inserted ID
            $taskId = DB::table('to_do_list')->insertGetId([
                'task_title' => $request['title'],
                'name' => auth()->user()->user_name,
                'user_code' => auth()->user()->user_code,
                'date' => $request['date'],
                'time' => $request['time'],
                'status' => 'pending'
            ]);

            return response()->json(['id' => $taskId, 'message' => 'Task created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create task', 'error' => $e->getMessage()], 500);
        }
    }
    public function updateToDoTaskEmp(Request $req) {
        $id = $req->id;
        $task_find = DB::table('tasks')->where('id',$id)->first();
        if($task_find) {
            $task_title = $req->task_title;
            $task_desc = $req->task_desc;


            DB::table('tasks')->where('id',$id)->update([
                'task_title' => $task_title,
                'task_report' => $task_desc,
                'task_description' => $task_desc
            ]);

            return response()->json(['message'=>'success']);
        }
        return response()->json(['message'=>'fail']);
    }

    // employee will create task
    public function createTaskByEmp(Request $req) {

        $task_title = $req->task_title;
        $task_description = $req->task_description;
        $user_id = auth()->user()->user_code;
        $user_name = auth()->user()->user_name;
        $emp_check = auth()->user()->user_type;

        DB::table('tasks')->insert([
            'emp_id' => $user_id,
            'task_title' => $task_title,
            'task_description' => $task_description,
            'task_report' => $task_description,
            'assigned_by' => $user_name,
            'assigned_date' =>  now(),
            'task_status' =>  "completed",
            'task_type' =>  "to-do-task"
        ]);

        $role = Auth()->user()->user_type;
        $message = "You have created a New To Do Task";
        $time = date("g:i A");
        $title = "New To Do Task";
        $date = date("Y-m-d");

        DB::table('notifications')->insert([
            'title' => $title,
            'message' => $message,
            'date' => $date,
            'user_id' => $user_id,
            'time' => $time,
            'status' => "unread",
            "type" => "to-do-task",
            "link" => "/view-emp-tasks-each"
        ]);

        $type = "to-do-task";
        $status = "unread";
        $date = date('y-m-d');
        $title = $user_name." created to do task";
        $link = "/view-tasks-employees/".$user_id;
        $message = $user_name." has created to do task";
        $time = date("g:i A");
        if($emp_check == "employee") {
            // if user is employee then send notification to managers and admins
            $emp = DB::table('users')->whereIn('user_type', ['admin', 'manager'])->get();
        } else {
            // if user is manger then send notification to admins only
            $emp = DB::table('users')->where('user_type','admin')->get();
        }

        foreach($emp as $employee) {
            DB::table('notifications')->insert([
                'user_id' => $employee->user_code,
                'title' => $title,
                'date' => $date,
                'message' => $message,
                'status' => $status,
                'type' => $type,
                'link' => $link,
                'time' => $time
            ]);
        }

        return response()->json(['message',true]);

    }
    // employee will change task staus
    public function updateTaskEmp(Request $req) {
        $id = $req->id;
        $task_find = DB::table('tasks')->where('id',$id)->first();
        if($task_find) {
            $task_status = $req->task_status;
            $task_report = $req->task_report;
            $old_status = $req->old_status;

            DB::table('tasks')->where('id',$id)->update([
                'task_status' => $task_status,
                'task_report' => $task_report
            ]);

            $emp_check = auth()->user()->user_type;

            $emp = DB::table('employees')->where('Emp_Code',$task_find->emp_id)->first();
            if($emp) {
                $name = $emp->Emp_Full_Name;
            } else {
                $name = "unknown";
            }

            $type = "task";
            $status = "unread";
            $date = date('y-m-d');
            $title = $name." updated task";
            $link = "/view-tasks-employees/".$task_find->emp_id;
            $message = $name." has updated task from ".$old_status." to ".$task_status;
            $time = date("g:i A");

            if($emp_check == "employee") {
                // if user is employee then send notification to managers and admins
                $emp = DB::table('users')
                ->whereIn('user_type', ['admin', 'manager'])
                ->select('user_code')
                ->get();
            }

            if($emp_check == "manager") {
                // if user is manger then send notification to admins only
                $emp = DB::table('users')->where('user_type','admin')->select('user_code')->get();
            }

            foreach($emp as $employee) {
                DB::table('notifications')->insert([
                    'user_id' => $employee->user_code,
                    'title' => $title,
                    'date' => $date,
                    'message' => $message,
                    'status' => $status,
                    'type' => $type,
                    'link' => $link,
                    'time' => $time
                ]);
            }

            return response()->json(['message'=>'success','emp'=>$emp]);
        }
        return response()->json(['message'=>'fail']);
    }
    // update tasks
    public function updateTask(Request $req) {
        $id = $req->id;
        $task_find = DB::table('tasks')->where('id',$id)->first();
        // Get the current date and time
        $dateAssigned = now();
        if($task_find) {
            $empId = $task_find->emp_id;

            $task_title = $req->task_title;
            $task_deadline = $req->task_deadline;
            $task_desc = $req->task_desc;


            DB::table('tasks')->where('id',$id)->update([
                'task_date' => $task_deadline,
                'task_title' => $task_title,
                'task_description' => $task_desc,
                'assigned_date' => $dateAssigned,
                'task_status' => "pending"
            ]);

            $role = Auth()->user()->user_type;
            $name = Auth()->user()->user_name;
            $message = "The ".$role." ".$name. " has updated an assigned task. task title: ".$task_title;
            $time = date("g:i A");
            $title = "Task Updated";
            $date = date("Y-m-d");

            DB::table('notifications')->insert([
                'title' => $title,
                'message' => $message,
                'date' => $date,
                'user_id' => $empId,
                'time' => $time,
                'status' => "unread",
                "type" => "task",
                "link" => "/view-emp-tasks-each"
            ]);
            return response()->json(['message'=>'success']);
        }
        return response()->json(['message'=>'fail']);
    }
    // delete tasks
    public function deleteTask($id) {
        $task_find = DB::table('tasks')->where('id',$id)->first();
        if($task_find) {
            DB::table('tasks')->where('id',$id)->delete();
        }
        return response()->json(['message','task deleted']);
    }
    // searc emp task by month
    public function searchTaskMonth(Request $req) {
        $emp_id =$req->emp_code;
        $date = $req->emp_month;
        list($year, $month) = explode('-', $date);
        $emp = DB::table('employees')->where('Emp_Code',$emp_id)->first();
        $emp_name = $emp->Emp_Full_Name;
        $Emp_Designation = $emp->Emp_Designation;
        $Emp_Image = $emp->Emp_Image;
        $Emp_Shift_Time = $emp->Emp_Shift_Time;
        $emp_code = $emp->Emp_Code;
        $tasks = DB::table('tasks')
        ->where('emp_id', $emp_id)
        ->whereRaw('YEAR(assigned_date) = ? AND MONTH(assigned_date) = ?', [$year, $month])
        ->orderBy('id', 'desc')
        ->get();

        $to_do_tasks =  DB::table('tasks')
        ->where('emp_id', $emp_id)
        ->where('task_type', "to-do-task")
        ->whereRaw('YEAR(assigned_date) = ? AND MONTH(assigned_date) = ?', [$year, $month])
        ->orderBy('id', 'desc')
        ->get();


        $to_do_task_count = $to_do_tasks->count();


        $show = false;
        return view('tasks.tasks-cards-of-each-employee',compact('to_do_tasks','to_do_task_count','emp_code','month','year','tasks','emp_name','emp_id','Emp_Designation','Emp_Image','Emp_Shift_Time'));

    }
       // to update task open form for task update
       public function taskUpdateForm($id) {

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
            $emp_code = $emp_id;
            $month = date('m');
            $year = date('Y');
            // dd($year,$month);
            $emp = DB::table('employees')->where('Emp_Code',$emp_id)->first();
            $emp_name = $emp->Emp_Full_Name;
            $Emp_Designation = $emp->Emp_Designation;
            $Emp_Image = $emp->Emp_Image;
            $Emp_Shift_Time = $emp->Emp_Shift_Time;

            $currentMonth = Carbon::now()->format('m');

            $tasks = DB::table('tasks')
            ->where('emp_id', $emp_id)
            ->orderBy('id','desc')
            ->where('task_type', "task")
            ->whereMonth('assigned_date', $currentMonth)
            // ->orderBy('id', 'desc')
            ->get();

            // dd($tasks);

            $to_do_task_count = DB::table('tasks')
            ->where('emp_id', $emp_id)
            ->where('task_type', "employee-task")
            ->orderBy('id','desc')
            ->whereMonth('assigned_date', $currentMonth)
            // ->orderBy('id', 'desc')
            ->count();

            $to_do_tasks = DB::table('tasks')
            ->where('emp_id', $emp_id)
            ->where('task_type', "employee-task")
            ->orderBy('id','desc')
            ->whereMonth('assigned_date', $currentMonth)
            // ->orderBy('id', 'desc')
            ->get();
            return view('tasks.tasks-cards-of-each-employee',compact('to_do_tasks','to_do_task_count','month','year','tasks','emp_code','emp_name','emp_id','Emp_Designation','Emp_Image','Emp_Shift_Time'));
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
        public function viewTaskEachEmployee($id) {
            $month = date('m');
            $year = date('Y');
            // dd($month,$year);
            // dd($id);
            $emp_id = $id;
            $currentMonth = Carbon::now()->format('m');
            $emp = DB::table('employees')->where('Emp_Code',$emp_id)->first();
            $emp_name = $emp->Emp_Full_Name;
            $Emp_Designation = $emp->Emp_Designation;
            $Emp_Image = $emp->Emp_Image;
            $Emp_Shift_Time = $emp->Emp_Shift_Time;
            $emp_code = $emp->Emp_Code;
            $tasks = DB::table('tasks')
            ->where('emp_id', $emp_id)
            ->whereRaw('YEAR(assigned_date) = ? AND MONTH(assigned_date) = ?', [$year, $month])
            ->orderBy('id', 'desc')
            ->get();


            $to_do_tasks = DB::table('tasks')
            ->where('emp_id', $emp_id)
            ->where('task_type', "to-do-task")
            ->orderBy('id','desc')
            ->whereMonth('assigned_date', $currentMonth)
            // ->orderBy('id', 'desc')
            ->get();

            $to_do_task_count = $to_do_tasks->count();

            return view('tasks.tasks-cards-of-each-employee',compact('to_do_task_count','to_do_tasks','emp_code','month','year','tasks','emp_name','emp_id','Emp_Designation','Emp_Image','Emp_Shift_Time'));
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
            $date = date('F Y');
            $emp = DB::table('employees')->where('Emp_Status','active')->get();
            $month = date('m');
            $year = date('Y');
            // dd($year,$month);

            $tasks = DB::table('tasks')
            ->whereYear('assigned_date', $year)
            ->whereMonth('assigned_date', $month)
            ->where('task_type','task')
            ->orderBy('id', 'desc')
            ->get();

            $count = DB::table('tasks')
            ->whereYear('assigned_date', $year)
            ->whereMonth('assigned_date', $month)
            ->where('task_type','task')
            ->orderBy('id', 'desc')
            ->count();

            return view('tasks.add-task',compact('emp','date','tasks','count'));
            // return view('tasks.tasks-cards-of-each-employee',compact('emp'));
        }

    // view tasks
    public function viewTasks() {
        // Fetch latest employees
        $latestEmployees = DB::table('employees')->where('Emp_Status','active')->get();

        $name = auth()->user()->user_name;
        $message = $name." has assigned you a new task";
        // dd($name, $message);

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
            'task_type' => "task",
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
                    'task_type' => "task",
                    'assigned_by' => 'admin', // Assuming admin is the default assigned_by value
                    'assigned_date' => $dateAssigned, // Save the current date as date_assigned
                ];
            }
            DB::table('tasks')->insert($tasks);
        }


        $role = Auth()->user()->user_type;
        $message = "The ".$role." ".$name. " has assigned you a new task.";
        $time = date("g:i A");
        $title = "You Have A New Task";
        $date = date("Y-m-d");

        DB::table('notifications')->insert([
            'title' => $title,
            'message' => $message,
            'date' => $date,
            'user_id' => $empId,
            'time' => $time,
            'status' => "unread",
            "type" => "task",
            "link" => "/view-emp-tasks-each"
        ]);

        return back()->with('success','Task Assigned');
    }


}
