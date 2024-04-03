<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportingController extends Controller
{
    public function viewReports() {
        $daily_reporting = DB::table('daily_reporting')->orderBy('id','desc')->get();
        $title = "Daily Reporting";
        return view('reports.index',compact('daily_reporting','title'));
    }

    // save data in database
    public function saveReportsDatabase(Request $req) {
        $user_code = Auth()->user()->user_code;
        $user_name = Auth()->user()->user_name;
        $daily_reporting = $req->input('DailyReport');
        $currentDate = date("Y-m-d");


        DB::table('daily_reporting')->insert([
            'emp_id' => $user_code,
            'report' => $daily_reporting,
            'date' => $currentDate,
            'emp_name' => $user_name,
        ]);
        return response()->json([
            'message' => "Report Added Successfully!"
        ]);
    }
}
