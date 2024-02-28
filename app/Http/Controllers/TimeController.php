<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeController extends Controller
{
    // view index page
    public function indexPage() {
        return view('time.index');
    }
}
