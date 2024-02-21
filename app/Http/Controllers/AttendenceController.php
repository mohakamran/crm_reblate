<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Carbon;


class AttendenceController extends Controller
{
   public function breakStart() {
      $id = Auth()->user()->user_code;
   }


    public function index()
    {
      $id = Auth()->user()->user_code;
      // check employee shift time
      $emp = DB::table('employees')->where('Emp_Code',$id)->first();
      if($emp) {
        $shift_time = $emp->Emp_Shift_Time;
        if($shift_time == "Morning") {
            $shift_time = "morning";
        } else {
            $shift_time = "night";
        }
      }
      return view('attendence.index',compact('shift_time'));

    }



    public function checkInTime() {



    }


    public function checkOutTime() {


    }
}
