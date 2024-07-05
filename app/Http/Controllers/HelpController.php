<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; // Import Storage facade if using for file deletion


use DB;

class HelpController extends Controller
{
    public function viewPage($id) {
        $file = DB::table('uploads')->where('id',$id)->first();
        $file_path = $file->file_path;
        $data = compact('file_path');
        return view('help.view-page',$data);
    }
    public function index() {
        $files = DB::table('uploads')->orderBy('id','desc')->get();
        return view('help.index',compact('files'));
    }

    public function deleteFile($id) {

        // Retrieve the file record from the database
        $file = DB::table('uploads')->where('id', $id)->first();

        if ($file) {

            // Check if the file exists
            if (file_exists($file->file_path)) {
                // Attempt to delete the file
                if (unlink($file->file_path)) {
                    // Delete the record from the database
                    DB::table('uploads')->where('id', $id)->delete();

                    // Return success response
                    return response()->json(['success' => true]);
                } else {
                    // Return error response if unlink fails
                    return response()->json(['success' => false, 'message' => 'Failed to delete file.'], 500);
                }
            } else {
                // Return error response if file does not exist
                return response()->json(['success' => false, 'message' => 'File not found.'], 404);
            }
        }

        // Return error response if file record not found
        return response()->json(['success' => false, 'message' => 'File record not found.'], 404);

    }



    public function saveFile(Request $request) {
        $file = $request->file('fileInput');
        $file_name = $request->input('file_name');
        $file_shift = $request->input('file_shift');
        $file_policy = $request->input('file_policy');
        $description = $request->input('description');
        // Check if file was retrieved successfully
        if (!$file) {
            return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
        }

        $newFileName = uniqid().'.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $newFileName);
        $relativeFilePath = 'uploads/'.$newFileName;

        DB::table('uploads')->insert([
            'file_name' => $file_name,
            'shift' => $file_shift,
            'file_type' => $file_policy,
            'description' => $description,
            'file_path' => $relativeFilePath, // You can add file_path here if you handle file uploads
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $title = "Polices File Uploaded";
        $message = auth()->user()->user_type . " " . auth()->user()->user_name . " has uploaded a new policy file";
        $date = date('y-m-d');
        $status = "unread";
        $type = "policy-file";


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
            DB::table('notifications')->insert([
                'title' => $title,
                'message' => $message,
                'user_id' => $emp,
                'status' => $status,
                'link' => "#",
                'type' => $type,
                'date' => $date,
                'time' => date("g:i A")
            ]);
        }


        return response()->json(['success' => true]);

    }
}
