<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ReportingController extends Controller
{
    public function viewReports() {
        $report = DB::table('daily_reporting')->get();
        return view('reports.index',compact('report'));
    }

    public function addReports(){
        $user_code = Auth()->user()->user_code;
        $user_name = Auth()->user()->user_name;
        $previousMonth = Carbon::now()->subMonth()->format('F');
        return view('reports.add',compact('user_code','user_name','previousMonth'));
    }

    public function submitForm(Request $request)
    {
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
        $adminId = DB::table('users')->where('user_type', 'admin')->pluck('user_code')->implode(',');
        $managerId = DB::table('users')->where('user_type', 'manager')->pluck('user_code')->implode(',');
        DB::table('notifications')->insert([
            [
                'title' => 'Monthly Report',
                'message' => "The Monthly Report from {$user_name} has been created.",
                'date' => $currentDate,
                'user_id' => $adminId,
                'time' => Carbon::now()->format('h:i A'),
                'status' => "unread",
                'type' => "admin",
                'link' => "/monthly-report",
            ],
            [
                'title' => 'Monthly Report',
                'message' => "The Monthly Report from {$user_name} has been created.",
                'date' => $currentDate,
                'user_id' => $managerId,
                'time' => Carbon::now()->format('h:i A'),
                'status' => "unread",
                'type' => "manager",
                'link' => "/monthly-report",
            ]
        ]);
         
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
        $adminId = DB::table('users')->where('user_type', 'admin')->pluck('user_code')->implode(',');
        $managerId = DB::table('users')->where('user_type', 'manager')->pluck('user_code')->implode(',');

        DB::table('notifications')->insert([
            [
                'title' => 'Monthly Report Updated',
                'message' => "The Monthly Report from {$user_name} has been updated.",
                'date' => $currentDate,
                'user_id' => $adminId,
                'time' => Carbon::now()->format('h:i A'),
                'status' => "unread",
                'type' => "admin",
                'link' => "/monthly-report",
            ],
            [
                'title' => 'Monthly Report Updated',
                'message' => "The Monthly Report from {$user_name} has been updated.",
                'date' => $currentDate,
                'user_id' => $managerId,
                'time' => Carbon::now()->format('h:i A'),
                'status' => "unread",
                'type' => "manager",
                'link' => "/monthly-report",
            ]
        ]);

        return redirect()->route('report.index')->with('success', 'Report updated successfully!');
    }

    public function reportRecords(){
    $report = DB::table('daily_reporting')->get();
    return view('reports.show', compact('report'));
    }

    public function Adminupdate(Request $request, $id)
    {
        $request->validate([
            'admin_comments' => 'nullable|string',
        ]);

        DB::table('daily_reporting')
        ->where('id', $id)
        ->update(['admin_comments' => $request->input('admin_comments')]);

        return redirect()->route('report.record')
            ->with('success', 'Comment updated successfully!')
            ->with('hideForm', true); // Flash a flag to hide the form
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
        $report = DB::table('daily_reporting')->where('id',$id)->first();
        return view('reports.showadmin',compact('report'));
    }

    
}
