<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; // Import Storage facade if using for file deletion


use DB;

use Illuminate\Support\Str;

class HelpController extends Controller
{
    // view File Page
    public function viewFile($id) {
        $db = DB::table('uploads')->where('file_id',$id)->first();
        if($db) {
            return view('help.page-view',compact('db'));
        }
        return back()->with('error','File Not Found!');
    }
    // delete file
    public function delFile($id) {
        $db = DB::table('uploads')->where('file_id',$id)->first();
        if($db) {
            // Delete the record from the database
            DB::table('uploads')->where('file_id', $id)->delete();
        }
        return response()->json(['message' => 'File deleted successfully.'], 200);
    }
    // save file in database
    public function updateFileDatabase(Request $request,$id) {

        $request->validate([
            'file_name' => 'required',
            'file_type' => 'required',
            'file_shift' => 'required',
            'file_description' => 'required',
        ]);
        $check  = DB::table('uploads')->where('file_id',$id)->first();
        if($check) {
            $file_name = $request->input('file_name');
            $file_type = $request->input('file_type');
            $file_shift = $request->input('file_shift');
            $file_description = $request->input('file_description');
        }

        DB::table('uploads')->where('file_id',$id)->update([
            'file_name' => $file_name,
            'shift' => $file_shift,
            'file_type' => $file_type,
            'description' => $file_description,
            'updated_at' => now(),
        ]);

        return back()->with('message', 'file updated successfully!');

    }
    // show update file update
    function updateFile($id) {
        $file = DB::table('uploads')->where('file_id',$id)->first();
        $route = "/update-file/".$file->id;
        $title = "Update File";
        $text_btn = "Save File";
        if(!$id) {
          return back()->with('error','File Not Found!');
        }

        return view('help.upload',compact('file','route','title','text_btn'));
    }
    // new form file upload blade
    function showNewFileForm() {
        $title = "Create New File";
        $text_btn = "Create File";
      $route = "/save-file";
       return view('help.upload',compact('route','title','text_btn'));
    }

    public function upload(Request $request)
    {


        // Check if there is a file in the 'upload' field
        if ($request->hasFile('upload')) {
            $uploadedFile = $request->file('upload');

            // Validate the file
            $validated = $request->validate([
                'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'  // Add appropriate validation rules
            ]);

            if ($validated) {
                // Define the folder path where you want to store uploaded images
                $folderPath = public_path('ckeditor_images');

                // Create the folder if it doesn't exist
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0755, true);
                }

                // Generate a unique file name
                $fileName = uniqid() . '_' . $uploadedFile->getClientOriginalName();

                // Move the uploaded file to the specified folder
                $uploadedFile->move($folderPath, $fileName);

                // CKEditor callback response
                $url = asset('ckeditor_images/' . $fileName);
                $response = [
                    'uploaded' => true,
                    'url' => $url
                ];

                \Log::info('Upload Successful:', $response);  // Log successful upload

                return response()->json($response);
            }
        }

        // Log errors and return upload failure response
        \Log::error('Upload failed or no file found');
        return response()->json(['uploaded' => false], 400);
    }



    public function viewPage($id) {
        $file = DB::table('uploads')->where('file_id',$id)->first();
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
        $file = DB::table('uploads')->where('file_id', $id)->first();

        if ($file) {

            // Check if the file exists
            if (file_exists($file->file_path)) {
                // Attempt to delete the file
                if (unlink($file->file_path)) {
                    // Delete the record from the database
                    DB::table('uploads')->where('file_id', $id)->delete();

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
        $request->validate([
            'file_name' => 'required',
            'file_type' => 'required',
            'file_shift' => 'required|in:Both,Morning,Evening',
            'file_description' => 'required',
        ]);


        // dd($request->all());
        $file_name = $request->input('file_name');

        $random = (Str::random(10));

        $file_type = $request->input('file_type');
        $file_shift = $request->input('file_shift');
        $file_description = $request->input('file_description');
        // Check if file was retrieved successfully
        // if (!$file) {
        //     return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
        // }

        // dd($request->all());


        DB::table('uploads')->insert([
            'file_name' => $file_name,
            'shift' => $file_shift,
            'file_type' => $file_type,
            'description' => $file_description,
            'file_id' => $random,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $title = "Polices File Uploaded";
        $message = auth()->user()->user_type . " " . auth()->user()->user_name . " has uploaded a new policy file";
        $date = date('y-m-d');
        $status = "unread";
        $type = "policy-file";
        $link = "/page-view/".$random;


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
                'link' => $link,
                'type' => $type,
                'date' => $date,
                'time' => date("g:i A")
            ]);
        }


        return back()->with('message', 'file created successfully!');

    }
}
