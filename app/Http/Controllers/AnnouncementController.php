<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AnnouncementController extends Controller
{
    // check permission
    public function checkPermission() {
        $user_type = Auth()->user()->user_type;
        if($user_type == "admin") {
            $user = true;
        } else {
            $user = false;
        }
        return $user;
    }
    public function viewindexPage() {
        // dd($this->checkPermission());
        $type = $this->checkPermission();
        // $type="employee";
        if($type) {
            $latestAnnouncements = DB::table('announcement')->orderBy('id','desc')->get();
            return view('announcement.index',compact('latestAnnouncements'));
        } else {
            return view('errors.401');
        }

    }

    // add announcement and save data in database
    public function addAnnouncement() {
        // Retrieve data from the request object
        $title = $request->input('title');
        $recipient = $request->input('recipient');
        $description = $request->input('description');

        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        // Now you can do whatever you want with this data
        // For example, you can save it to the database using Eloquent ORM
       DB::table('announcement')->insert(
            [
                'title' => $title,
                'to_emp' => $recipient,
                'description' => $description,
                'date' => $date
            ]
       );

        // You can return a response to the client if needed
        return response()->json(['message' => 'Announcement added successfully']);
    }
}
