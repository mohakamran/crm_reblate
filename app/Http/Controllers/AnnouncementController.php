<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


use Illuminate\Support\Str;


class AnnouncementController extends Controller
{
    public function viewAnnouncements() {
        // Get the latest announcement for each unique file_id
        $latestAnnouncements = DB::table('announcement')
            ->select('file_id', DB::raw('MAX(id) as id'))
            ->groupBy('file_id')
            ->orderBy('id', 'desc') // Optional: Order by id if needed
            ->get();

        // Fetch the full records based on the latest ids
        $announcements = DB::table('announcement')
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('announcement')
                    ->groupBy('file_id');
            })
            ->orderBy('id', 'desc') // Optional: Order by id if needed
            ->get();

        // Pass the announcements data to the view
        return view('announcement.views', ['announcements' => $announcements]);
    }
    public function deleteAnnouncement($id) {
        $find = DB::table('announcement')->where('file_id',$id)->first();
        if($find) {
            DB::table('announcement')->where('file_id',$id)->delete();
        }
        return response()->json(['success','deleted successfully']);
    }
    public function changeAnnouncementSave($id, Request $request) {
        $request->validate([
            'announcement_title' => 'required', // Ensure that 'title' is required
            'file_shift' => 'required|in:Both,Morning,Evening',
            'file_description' => 'required'
        ]);

        $announcement_title = $request->announcement_title;
        $file_shift = $request->file_shift;
        $file_description = $request->file_description;


        $find = DB::table('announcement')->where('file_id',$id)->first();
        $date = Carbon::now();
        $date = $date->format('d F Y');


        if($find) {
            DB::table('announcement')->where('file_id',$id)->update([
                'title' => $announcement_title,
                'shift' => $file_shift,
                'description' => $file_description,
                'updated_date' => $date,
                'updated_by' => auth()->user()->user_name
            ]);
        } else {
            return view('errors.404');
        }

        return back()->with('message', 'announcement updated successfully!');
    }
    public function changeAnnouncement($id) {
        $find = DB::table('announcement')->where('file_id',$id)->first();
        if($find) {
            $btn = "Update";
            $route = "/change-annoucement/".$find->file_id;
            $title = "Update Announcement";
            return view('announcement.add', compact('find','title','route','btn'));
        } else {
            return view('errors.404');
        }
    }
    public function viewAnnouncement($id) {
        $find = DB::table('announcement')->where('file_id',$id)->first();
        if($find) {
            return view('announcement.view', compact('find'));
        } else {
            return view('errors.404');
        }
    }
    // check permission
    // public function checkPermission() {
    //     $user_type = Auth()->user()->user_type;
    //     if($user_type == "admin") {
    //         $user = true;
    //     } else {
    //         $user = false;
    //     }
    //     return $user;
    // }
    public function viewindexPage() {
     // Get the latest announcement for each unique file_id
        $latestAnnouncements = DB::table('announcement')
        ->select('file_id', DB::raw('MAX(id) as id'))
        ->groupBy('file_id')
        ->orderBy('id', 'desc') // Optional: Order by id if needed
        ->get();

        // Fetch the full records based on the latest ids
        $latestAnnouncements = DB::table('announcement')
        ->whereIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
                ->from('announcement')
                ->groupBy('file_id');
        })
        ->orderBy('id', 'desc') // Optional: Order by id if needed
        ->get();


        return view('announcement.index',compact('latestAnnouncements'));
    }

    public function addAnnouncement() {
        $btn = "Create";
        $route = "/add-annoucement";
        $title = "Create Announcement";
        return view('announcement.add',compact('btn','route','title'));
    }

    // add announcement and save data in database
    public function addAnnouncementSave(Request $request) {
        $request->validate([
            'announcement_title' => 'required', // Ensure that 'title' is required
            'file_shift' => 'required|in:Both,Morning,Evening',
            'file_description' => 'required'
        ]);

        $date = Carbon::now();
        $date = $date->format('d F Y');


        $randomString = Str::random(9);

        $announcement_title = $request->announcement_title;
        $file_shift = $request->file_shift;
        $file_description = $request->file_description;



        $title = "New Announcement";
        $message = auth()->user()->user_type . " " . auth()->user()->user_name . " has created a new announcement file";
        $date_notification = date('y-m-d');
        $status = "unread";
        $type = "all";
        $link = "/view-announcement/".$randomString;


        // Fetch employee codes based on shift
        $emp_code = [];
        if ($file_shift == "Morning") {
            $emp_code = DB::table('employees')->where('Emp_Shift_Time', 'Morning')->pluck('Emp_Code')->toArray();
        } elseif ($file_shift == "Night") {
            $emp_code = DB::table('employees')->where('Emp_Shift_Time', 'Night')->pluck('Emp_Code')->toArray();
        } elseif ($file_shift == "Both") {
            $emp_code = DB::table('employees')->pluck('Emp_Code')->toArray();
        }

        // Insert notifications for each employee code
        foreach ($emp_code as $emp) {

            DB::table('announcement')->insert([
                'title' => $announcement_title,
                'shift' => $file_shift,
                'to_emp' => $emp,
                'description' => $file_description,
                'date' => $date,
                'file_id' => $randomString,
                'created_by' => auth()->user()->user_name
            ]);

            DB::table('notifications')->insert([
                'title' => $title,
                'message' => $message,
                'user_id' => $emp,
                'status' => $status,
                'link' => $link,
                'type' => $type,
                'date' => $date_notification,
                'time' => date("g:i A")
            ]);
        }

        // You can return a response to the client if needed
        return back()->with('message', 'announcement created successfully!');
    }
}
