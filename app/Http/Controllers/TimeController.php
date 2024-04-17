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
    public function setShift(Request $req) {
        // dd($req->all());
        $office_start = $req->office_start;
        $office_end = $req->office_end;
        $break_start = $req->break_start;
        $break_end = $req->break_end;
        $shift_time = $req->shift_time;




        $check = DB::table('office_times')->where('shift_type', $shift_time)->first();
        if($check == null) {
            DB::table('office_times')->insert([
                'shift_type' => $shift_time,
                'shift_start' =>  $office_start,
                'break_start' => $break_start,
                'break_end' => $break_end,
                'shift_end' => $office_end
            ]);
        } else {
            $check_id = $check->id;
            DB::table('office_times')->where('id',$check_id)->update([
                'shift_type' => $shift_time,
                'shift_start' =>  $office_start,
                'break_start' => $break_start,
                'break_end' => $break_end,
                'shift_end' => $office_end
            ]);
        }

        return redirect('/office-time');
    }

}
