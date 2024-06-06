<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ApiController extends Controller
{
    public function index() {
        $employee = DB::table('employees')->get();
        return response()->json($employee, 200);
    }

    public function getOne($id) {
        $employee = DB::table('employees')->where('Emp_Code',$id)->first();
        if(!$employee) {
            $employee = "Employee not found!";
        }
        return response()->json($employee, 200);
    }
}
