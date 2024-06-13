<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class HelpController extends Controller
{
    // delete file
    public function deleteFile($id) {
        $db = DB::table('uploads')->where('id',$id)->first();
        if($db) {
            $file = $db->fileInput;
            if(file_exists($file)) {
                unlink($file);
            }
            DB::table('uploads')->where('id',$id)->delete();
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'failed']);
        }
    }
    public function index() {
        // echo "i am fine!";
        $data = DB::table('uploads')->orderBy('id','desc')->get();
        return view('help.index',compact('data'));
    }

    // save file
    public function saveFile(Request $req) {
       $fileInput = $req->fileInput;
    //    $file = $fileInput;
       $file_type = $req->file_type;
       $file_name = $req->file_name;
       $file_description = $req->file_description;
       $randomFileName = substr(uniqid() . '_' . md5(uniqid()), 0, 15);

       $file_org = $randomFileName . '_file_.' . $fileInput->getClientOriginalExtension();

        // $newFileName = $emp_code_file . '.' . $file->getClientOriginalExtension();
        $fileInput->move(public_path('uploads'), $file_org);


       DB::table('uploads')->insert([
        'fileInput' => 'uploads/'.$file_org,
        'file_type' => $file_type,
        'file_description' => $file_description,
        'date' => today()->toDateString(),
        'file_name' => $file_name
       ]);

       return response()->json(['success' => true] );
    }
}
