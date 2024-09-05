<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ReportingController extends Controller
{
    public function viewReports() {
        return view('reports.index');
    }

    // save data in database
    // public function saveReportsDatabase(Request $req) {
    //     $user_code = Auth()->user()->user_code;
    //     $user_name = Auth()->user()->user_name;
    //     $daily_reporting = $req->input('DailyReport');
    //     $currentDate = date("Y-m-d");


    //     DB::table('daily_reporting')->insert([
    //         'emp_id' => $user_code,
    //         'report' => $daily_reporting,
    //         'date' => $currentDate,
    //         'emp_name' => $user_name,
    //     ]);
    //     return response()->json([
    //         'message' => "Report Added Successfully!"
    //     ]);
    // }

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

        return redirect()->route('report.index')->with('success', 'Report submitted successfully!');
    }
}
