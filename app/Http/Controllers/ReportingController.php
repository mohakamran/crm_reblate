<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportingController extends Controller
{
    public function viewReports() {
        $isFriday = Carbon::now()->isFriday();
        $user_code = Auth::user()->user_code;
        $report = DB::table('to_do_list')->where('user_code', $user_code)->where('status','completed')->get();
        return view('reports.index',compact('report','isFriday'));
    }

    public function addReports(){
        $user_code = Auth()->user()->user_code;
        $user_name = Auth()->user()->user_name;
        $previousMonth = Carbon::now()->subMonth()->format('F');
        return view('reports.add',compact('user_code','user_name','previousMonth'));
    }

    public function submitForm(Request $request){

        $user_code = Auth()->user()->user_code;
        $user_name = Auth()->user()->user_name;
        $daily_reporting = $request->input('DailyReport');
        $tasks_completed = $request->input('tasks_completed');
        $projects_worked_on = $request->input('projects_worked_on');
        $goals_achieved = $request->input('goals_achieved');
        $challenges_faced = $request->input('challenges_faced');
        $goals_for_next_month = $request->input('goals_for_next_month');
        $admin_comments = $request->input('admin_comments');
        $manager_comments = $request->input('manager_comments');
        $currentDate = date("Y-m-d");
        $previousMonth = Carbon::now()->subMonth()->format('F');

        DB::table('daily_reporting')->insert([
            'emp_id' => $user_code,
            'report' => $daily_reporting,
            'date' => $currentDate,
            'emp_name' => $user_name,
            'tasks_completed' => $tasks_completed,
            'projects_worked_on' => $projects_worked_on,
            'goals_achieved' => $goals_achieved,
            'challenges_faced' => $challenges_faced,
            'goals_for_next_month' => $goals_for_next_month,
            'admin_comments' => $admin_comments,
            'manager_comments' => $manager_comments,
            'month' => $previousMonth,
        ]);

        // Get all admin and manager IDs
        $adminIds = DB::table('users')->where('user_type', 'admin')->pluck('user_code');
        $managerIds = DB::table('users')->where('user_type', 'manager')->pluck('user_code');

        // Create notifications for admins
        foreach ($adminIds as $adminId) {
            DB::table('notifications')->insert([
                'title' => 'Monthly Report',
                'message' => "The Monthly Report from {$user_name} has been created.",
                'date' => $currentDate,
                'user_id' => $adminId,
                'time' => Carbon::now()->format('h:i A'),
                'status' => "unread",
                'type' => "admin",
                'link' => "/monthly-report",
            ]);
        }

        // Create notifications for managers
        foreach ($managerIds as $managerId) {
            DB::table('notifications')->insert([
                'title' => 'Monthly Report',
                'message' => "The Monthly Report from {$user_name} has been created.",
                'date' => $currentDate,
                'user_id' => $managerId,
                'time' => Carbon::now()->format('h:i A'),
                'status' => "unread",
                'type' => "manager",
                'link' => "/monthly-report",
            ]);
        }

        return redirect()->route('report.index')->with('success', 'Report submitted successfully!');
    }

    public function deleteReport($id) {

        $report = DB::table('daily_reporting')->where('id', $id)->first(); // Use first() instead of findOrFail

        if ($report) {
            DB::table('daily_reporting')->where('id', $id)->delete(); // Correct deletion method
            return response()->json(['message' => 'success'], 200);
        } else {
            return response()->json(['message' => 'Report not found'], 404); // Return error if report not found
        }
    }

    public function editReports($id) {
        $report = DB::table('daily_reporting')->where('id', $id)->first();
        return view('reports.edit',compact('report'));
    }

    public function updateReport(Request $request, $id){

        $user_code = Auth()->user()->user_code;
        $user_name = Auth()->user()->user_name;
        $daily_reporting = $request->input('DailyReport');
        $tasks_completed = $request->input('tasks_completed');
        $projects_worked_on = $request->input('projects_worked_on');
        $goals_achieved = $request->input('goals_achieved');
        $challenges_faced = $request->input('challenges_faced');
        $goals_for_next_month = $request->input('goals_for_next_month');
        $admin_comments = $request->input('admin_comments');
        $manager_comments = $request->input('manager_comments');
        $currentDate = date("Y-m-d");
        $previousMonth = Carbon::now()->subMonth()->format('F');

        // Update existing record
        DB::table('daily_reporting')
            ->where('id', $id)
            ->update([
                'emp_id' => $user_code,
                'report' => $daily_reporting,
                'date' => $currentDate,
                'emp_name' => $user_name,
                'tasks_completed' => $tasks_completed,
                'projects_worked_on' => $projects_worked_on,
                'goals_achieved' => $goals_achieved,
                'challenges_faced' => $challenges_faced,
                'goals_for_next_month' => $goals_for_next_month,
                'admin_comments' => $admin_comments,
                'manager_comments' => $manager_comments,
                'month' => $previousMonth,
            ]);

        // Sending notifications
        $adminIds = DB::table('users')->where('user_type', 'admin')->pluck('user_code');
        $managerIds = DB::table('users')->where('user_type', 'manager')->pluck('user_code');
        foreach ($adminIds as $adminId) {
            DB::table('notifications')->insert([
                'title' => 'Monthly Report',
                'message' => "The Monthly Report from {$user_name} has been updated.",
                'date' => $currentDate,
                'user_id' => $adminId,
                'time' => Carbon::now()->format('h:i A'),
                'status' => "unread",
                'type' => "admin",
                'link' => "/monthly-report",
            ]);
        }
          // Create notifications for managers
        foreach ($managerIds as $managerId) {
            DB::table('notifications')->insert([
                'title' => 'Monthly Report',
                'message' => "The Monthly Report from {$user_name} has been updated.",
                'date' => $currentDate,
                'user_id' => $managerId,
                'time' => Carbon::now()->format('h:i A'),
                'status' => "unread",
                'type' => "manager",
                'link' => "/monthly-report",
            ]);
        }

        return redirect()->route('report.index')->with('success', 'Report updated successfully!');
    }

    public function reportRecords($employeeId){
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = $startOfWeek->copy()->addDays(3);
    
        $startOfWeekFormatted = $startOfWeek->format('Y-m-d');
        $endOfWeekFormatted = $endOfWeek->format('Y-m-d');
    
        $employee = DB::table('employees') 
        ->where('Emp_Code', $employeeId)
        ->first(['Emp_Full_Name']); 

        $employeeode = DB::table('employees') 
        ->where('Emp_Code', $employeeId)
        ->first(['Emp_Code']); 

        $disapprovals = DB::table('to_do_list')
        ->where('approval', 'not approved')
        ->get();
        $employeeName = $employee ? $employee->Emp_Full_Name : 'Unknown';
        $employeeCode = $employeeode ? $employeeode->Emp_Code : 'Unknown';

        $report = DB::table('to_do_list')
            ->where('user_code', $employeeId)
            ->where('status','Completed')
            ->whereRaw('DATE_FORMAT(STR_TO_DATE(`date`, "%W, %M %d, %Y"), "%Y-%m-%d") BETWEEN ? AND ?', [$startOfWeekFormatted, $endOfWeekFormatted])
            ->get();

        return view('reports.show', compact('report','employeeName','disapprovals','employeeCode'));
    }

    public function Adminupdate(Request $request, $id){

        $request->validate([
            'admin_comments' => 'nullable|string',
        ]);

        $report = DB::table('to_do_list')->where('id', $id)->get();

        if ($report) {
            DB::table('to_do_list')
                ->where('id', $id)
                ->update(['admin_comments' => $request->input('admin_comments')]);
    
            return redirect()->route('report.record')
                ->with('success', 'Comment updated successfully!');
        } else {
            return redirect()->route('report.record')
                ->with('error', 'Report not found!');
        }
    }

    public function Managerupdate(Request $request, $id)
    {
        $request->validate([
            'manager_comments' => 'nullable|string',
        ]);

        DB::table('daily_reporting')
        ->where('id', $id)
        ->update(['manager_comments' => $request->input('manager_comments')]);

        return redirect()->route('report.record')
            ->with('success', 'Comment updated successfully!'); // Flash a flag to hide the form
    }

    public function ShowAdminRecords($id){
        $report = DB::table('to_do_list')->where('id',$id)->first();
        return view('reports.showadmin',compact('report'));
    }

    public function ShowEmpRecords($id){
        
        $user_code = Auth()->user()->user_code;
        $user_name = Auth()->user()->user_name;
        $report = DB::table('to_do_list')->where('status','completed')->where('id', $id)->first();
        return view('reports.showemp',compact('report','user_name','user_code'));
    }

    public function index(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        if ($startDate && $endDate) {
            $startDate = Carbon::parse($startDate)->format('Y-m-d');
            $endDate = Carbon::parse($endDate)->format('Y-m-d');
        }
        $query = DB::table('to_do_list');

        if ($startDate && $endDate) {
            $query->whereBetween(DB::raw("DATE(STR_TO_DATE(date, '%W, %M %d, %Y'))"), [$startDate, $endDate]);
        }
        $report = $query->get();
        $isFriday = now()->dayOfWeek === 5; // 5 represents Friday

        return view('reports.index', compact('report','isFriday'));
    }

    public function getWeeklyReport()
    {
        $user_code = Auth::user()->user_code;
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = $startOfWeek->copy()->addDays(4);
    
        // Fetch tasks for the week
        $tasks = DB::table('to_do_list')
            ->where('user_code', $user_code)
            ->whereRaw('DATE_FORMAT(STR_TO_DATE(`date`, "%W, %M %d, %Y"), "%Y-%m-%d") BETWEEN ? AND ?', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')])
            ->get();
    
        // Define week days
        $weekDays = [];
        for ($i = 0; $i < 5; $i++) {
            $weekDays[] = $startOfWeek->copy()->addDays($i)->format('l'); // 'Monday', 'Tuesday', etc.
        }
    
        // Check for submitted days
        $submittedDays = $tasks->pluck('date')->map(function ($date) {
            return Carbon::createFromFormat('l, F d, Y', $date)->format('l'); // Get just the day names
        })->toArray();
    
        // Identify missing days
        $missingDays = array_diff($weekDays, $submittedDays);
    
        // Ensure missingDays is always an array
        return response()->json(['tasks' => $tasks, 'missingDays' => array_values($missingDays)]);
    }
    

    public function submitWeeklyReport(Request $request)
    {
        $currentDate = date("Y-m-d");
        $user_name = Auth::user()->user_name;
        $user_id = Auth::user()->user_code;
        DB::table('to_do_list')
        ->updateOrInsert(
            ['user_code' => $user_id,],
            ['weeklyReport' => 'submitted']
        );
        $adminIds = DB::table('users')->where('user_type', 'admin')->pluck('user_code');
        $managerIds = DB::table('users')->where('user_type', 'manager')->pluck('user_code');

        foreach ($adminIds as $adminId) {
            DB::table('notifications')->insert([
                'title' => 'Weekly Report',
                'message' => "The Weekly Report from {$user_name} has been Submitted.",
                'date' => $currentDate,
                'user_id' => $adminId,
                'time' => Carbon::now()->format('h:i A'),
                'status' => "unread",
                'type' => "admin",
                'link' => "/Show-Weekly-report/{$user_id}",
            ]);
        }

        foreach ($managerIds as $managerId) {
            DB::table('notifications')->insert([
                'title' => 'Weekly Report',
                'message' => "The Weekly Report from {$user_name} has been Submitted.",
                'date' => $currentDate,
                'user_id' => $managerId,
                'time' => Carbon::now()->format('h:i A'),
                'status' => "unread",
                'type' => "manager",
                'link' => "/Show-Weekly-report/{$user_id}",
            ]);

            return response()->json(['success' => true]);
        }
    }

    public function approve($id)
    {
        DB::table('to_do_list')
            ->where('id', $id)
            ->update(['approval' => 'approved']);

        return redirect()->back()->with('approved_task_id', $id);
    }

    public function notApprove(Request $request, $id)
    {

        DB::table('to_do_list')
            ->where('id', $id)
            ->update([
                'approval' => 'not approved',
                'disapproval_reason' => $request->disapproval_reason
            ]);

        return redirect()->back()->with('message', 'Task disapproved with reason.');
    }

    public function validateWeeklyReport(Request $request)
    {
        $user_id = Auth::user()->user_code;
        $weeklyReportSubmitted = DB::table('to_do_list')
            ->where('user_code', $user_id)
            ->where('weeklyReport', 'submitted')
            ->exists(); // Check if weekly report is marked as submitted

        return response()->json(['weeklyReportSubmitted' => $weeklyReportSubmitted]);
    }


    
}
