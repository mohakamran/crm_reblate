<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Carbon\Carbon;


class VacationController extends Controller
{
    // index page
    public function index() {
        $holidays = DB::table('holidays')->orderBy('id','desc')->get();
        // dd($holidays);
        return view('vacations.vacations',compact('holidays'));
    }


    // create holidays in database
    public function createHolidays(Request $req){
       // Retrieve holiday data from the request
        $holiday_type = $req->holiday_type;
        $holiday_description = $req->holiday_description;
        $endDate = $req->endDate;
        $startDate = $req->startDate;



        // Parse the start and end dates using Carbon
        $startDateTime = Carbon::parse($startDate);
        $endDateTime = Carbon::parse($endDate);

        // Calculate the difference in days
        $totalDays = $endDateTime->diffInDays($startDateTime);
        $totalDays = $totalDays + 1;

        if(isset($req->status) && $req->status == "update") {

            $id = $req->id;
            DB::table('holidays')->where('id',$id)->update([
                'holiday_type' => $holiday_type,
                'holiday_description' => $holiday_description,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'total_days' =>$totalDays
            ]);



            return response()->json(['success' => true]);
        }

         // Check if there are any overlapping intervals
         $overlappingHolidays = DB::table('holidays')
         ->where(function ($query) use ($startDate, $endDate) {
             $query->where('startDate', '<=', $endDate)
                 ->where('endDate', '>=', $startDate);
         })
         ->exists();

         // If overlapping vacations found, return error response
         if ($overlappingHolidays) {
         return response()->json(['error' => 'Vacation already set between provided dates.'], 400);
         }





        DB::table('holidays')->insert([
            'holiday_type' => $holiday_type,
            'holiday_description' => $holiday_description,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'total_days' =>$totalDays
        ]);



        return response()->json(['success' => true]);




    }
}
