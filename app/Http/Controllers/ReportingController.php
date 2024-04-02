<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportingController extends Controller
{
    public function viewReports() {
        $daily_reporting = DB::table('daily_reporting')->orderBy('id','desc')->get();
        return view('reports.index',compact('daily_reporting'));
    }
}
