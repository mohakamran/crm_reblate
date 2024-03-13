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
        if($type == "admin") {
            return view('announcement.index');
        } else {
            return view('errors.404');
        }

    }
}
