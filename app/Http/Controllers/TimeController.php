<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;


use Illuminate\Http\Request;
use DB;

class TimeController extends Controller
{
    // view index page
    public function indexPage() {
        $data = DB::table('office_times')->get();
        return view('time.index',compact('data'));
    }
    // set morning shift time
    public function setMorningShift(Request $req) {
        $req->validate([
            'shift_start_morning' => 'required',
            'break_start_morning' => 'required',
            'break_end_morning' => 'required',
            'shift_end_morning' => 'required',
        ]);

        $shift_start_morning = request()->input('shift_start_morning');
        $shift_start_morning = Carbon::parse($shift_start_morning)->format('h:i A');

        $break_start_morning = request()->input('break_start_morning');
        $break_start_morning = Carbon::parse($break_start_morning)->format('h:i A');

        $break_end_morning = request()->input('break_end_morning');
        $break_end_morning = Carbon::parse($break_end_morning)->format('h:i A');

        $shift_end_morning = request()->input('shift_end_morning');
        $shift_end_morning = Carbon::parse($shift_end_morning)->format('h:i A');

        $check = DB::table('office_times')->where('shift_type','morning')->first();
        if($check == null) {
            DB::table('office_times')->insert([
                'shift_type' => "morning",
                'shift_start' =>  $shift_start_morning,
                'break_start' => $break_start_morning,
                'break_end' => $break_end_morning,
                'shift_end' => $shift_end_morning
            ]);

        } else {
            DB::table('office_times')->where('shift_type','morning')->update([
                'shift_start' =>  $shift_start_morning,
                'break_start' => $break_start_morning,
                'break_end' => $break_end_morning,
                'shift_end' => $shift_end_morning
            ]);
        }
        return redirect('/office-time');
    }
    // set morning night time
    public function setEveningShift(Request $req) {
        $req->validate([
            'shift_start_night' => 'required',
            'break_start_night' => 'required',
            'break_end_night' => 'required',
            'shift_end_night' => 'required',
        ]);

        $shift_start_night = request()->input('shift_start_night');
        $shift_start_night = Carbon::parse($shift_start_night)->format('h:i A');

        $break_start_night = request()->input('break_start_night');
        $break_start_night = Carbon::parse($break_start_night)->format('h:i A');

        $break_end_night = request()->input('break_end_night');
        $break_end_night= Carbon::parse($break_end_night)->format('h:i A');

        $shift_end_night = request()->input('shift_end_night');
        $shift_end_night = Carbon::parse($shift_end_night)->format('h:i A');

        $check = DB::table('office_times')->where('shift_type','night')->first();
        if($check == null) {
            DB::table('office_times')->insert([
                'shift_type' => "night",
                'shift_start' =>  $shift_start_night,
                'break_start' => $break_start_night,
                'break_end' => $break_end_night,
                'shift_end' => $shift_end_night
            ]);

        } else {
            DB::table('office_times')->where('shift_type','night')->update([
                'shift_start' =>  $shift_start_night,
                'break_start' => $break_start_night,
                'break_end' => $break_end_night,
                'shift_end' => $shift_end_night
            ]);
        }
        return redirect('/office-time');
    }
}
