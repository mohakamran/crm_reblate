<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Mail;

use PDF;



class QuotationController extends Controller
{
    // delete quotation
    public function delQuotation($id) {
        $services = DB::table('services')->where('service_id',$id)->get() ??  null;
        $quotes = DB::table('quotation')->where('service_id',$id)->first() ?? null;
        if($quotes !=null) {
            DB::table('quotation')->where('service_id',$id)->delete();
            if($services !=null) {
                DB::table('services')->where('service_id',$id)->delete();
            }

        }
        return response()->json(['message' => 'success'], 200);
     }

     public function viewQuotation($id)
     {
         try {
             $services = DB::table('services')->where('service_id', $id)->get();
             $quotes = DB::table('quotation')->where('service_id', $id)->first();

             if ($services->isEmpty() || !$quotes) {
                 return view('NotFound.index');
             }



             // Return PDF as inline response (view in browser)
            //  return $pdf->stream('quotation.pdf');
            return view('Quotation.view-page',compact('services', 'quotes'));

         } catch (\Exception $e) {
             return back()->with('error', 'Failed to generate PDF. ' . $e->getMessage());
         }
     }

    //  public function viewQuotation($id)
    //  {
    //      // Fetch services and quotes from the database
    //      $services = DB::table('services')->where('service_id', $id)->get();
    //      $quotes = DB::table('quotation')->where('service_id', $id)->first();

    //      if ($services->isEmpty() || !$quotes) {
    //          return view('NotFound.index');
    //      }

    //      try {
    //          // Load SnappyPdf service
    //          $pdf = app(SnappyPdf::class);

    //          // Load the view and pass data to it
    //          $pdf->loadView('Quotation.pdf_view', compact('services', 'quotes'))
    //              ->setOptions([
    //                  'default-font' => 'sans-serif', // Adjust option name if needed
    //                  'disable-external-links' => true, // Example of another option
    //                  'isHtml5ParserEnabled' => true,
    //                  'isPhpEnabled' => true,
    //                  'isFontSubsettingEnabled' => true
    //              ])
    //              ->setOptions(['public_path' => public_path()]); // Set the public path

    //          // Return PDF as inline response (view in browser)
    //          return $pdf->inline('quotation.pdf');

    //      } catch (\Exception $e) {
    //          return back()->with('error', 'Failed to generate PDF. ' . $e->getMessage());
    //      }
    //  }


    public function index() {
        $quo = DB::table('quotation')->orderBy('id','desc')->get();
        return view('Quotation.form',compact('quo'));
    }
    // create quotations
    public function createQuotation() {
        $users = DB::table('users')->where('user_type','admin')->select('user_type','user_name','user_code')->get();
        return view('Quotation.add',compact('users'));
    }

    // save database
    public function saveQuotation(Request $request)
    {

        // dd($sent_to);

       $random = (Str::random(10));
       $check = DB::table('services')->where('service_id', $random)->exists() ?? null;
       if($check) {
        $random = (Str::random(10));
       }

        // Validate the incoming request data
        $request->validate([
            'project_title' => 'required',
            'client_name' => 'required',
            'client_email' => 'required|email',
            'project_category' => 'required|in:Web Development,Digital Marketing,Business Development,Graphics,E-commerce',
            'project_deadline' => 'required|date|after_or_equal:' . now()->format('Y-m-d'),
            'quotation_expires' => 'required|date',
            'upfront_percentage' => 'required|integer|min:0|max:100',
            'amount_upfront' => 'required|numeric|min:0',
            'additional_notes' => 'nullable|string'
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            if(auth()->user()->user_type == "admin") {
                $sent_by = auth()->user()->user_code;
                $sent_to = auth()->user()->user_code;
                $sent_by_name = auth()->user()->user_name;
                $sent_to_name = auth()->user()->user_name;
            } else {
                $sent_to = $request->admin_select;
                if($sent_to == null) {
                    dd("Please Select an Admin");
                }
                $sent_by = auth()->user()->user_code;
                $sent_by_name = auth()->user()->user_name;

                $sent_to_name = DB::table('users')->where('user_code',$sent_to)->select('user_name')->first();
                $sent_to_name = $sent_to_name->user_name;

                $message = "Manager ".auth()->user()->user_name." has sent a quotation proposal for approval ";
                $link  = "/view-quotation/".$random;
                $title = "A New Quotation From ".auth()->user()->user_name;
                $type = "proposal";
                $date = date('y-m-d');
                $time = Carbon::now()->format('h:i A');
                DB::table('notifications')->insert([
                    'title' => $title,
                    'message' => $message,
                    'date' => $date,
                    'user_id' => $sent_to,
                    'status' => "unread",
                    'link' => $link,
                    'time' => $time,
                    'type' => $type,
                ]);
            }



            // Insert quotation details
            $quotationId = DB::table('quotation')->insertGetId([
                'project_title' => $request->project_title,
                'client_name' => $request->client_name,
                'client_email' => $request->client_email,
                'project_category' => $request->project_category,
                'project_deadline' => $request->project_deadline,
                'quotation_expires' => $request->quotation_expires,
                'currency' => $request->currency,
                'upfront_percentage' => $request->upfront_percentage,
                'amount_upfront' => $request->amount_upfront,
                'additional_notes' => $request->additional_notes,
                'date' => now()->format('Y-m-d'),
                'status' => 'pending',
                'total_amount' => $request->hidden_total_amount,
                'client_requirements' => $request->client_requirements,
                'service_id' => $random,
                'sent_by' => $sent_by,
                'sent_to' => $sent_to,
                'sent_by_name' => $sent_by_name,
                'sent_to_name' => $sent_to_name
            ]);

            // Insert each service with its amount and tasks
            $services = $request->input('services', []);
            $amounts = $request->input('amounts', []);
            $tasks = $request->input('tasks', []);

            if (!empty($services)) {
                foreach ($services as $serviceId => $service) {
                    $serviceName = $service['name'];
                    $serviceAmount = $amounts[$serviceId] ?? null;
                    $serviceTasks = $tasks[$serviceId] ?? [];

                    // Insert service into database
                    DB::table('services')->insert([
                        'service_id' => $random,
                        'service_name' => $serviceName,
                        'amount' => $serviceAmount,
                        'tasks' => json_encode($serviceTasks), // Store tasks as JSON
                    ]);
                }
            }

            // Commit the transaction
            DB::commit();

            // Redirect back with success message
            if (auth()->user()->user_type == "admin") {
                return back()->with('message', 'Quotation created. Go to Quotations Page and Accept/Approve Quotation!');
            } else {
                return back()->with('message', 'Quotation has been sent to admin. Wait for action by admin!');
            }
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Redirect back with error message
            return back()->with('error', 'Failed to save quotation. ' . $e->getMessage());
        }
    }


    public function sendQuotation($id, $status) {
        if ($status == 'decline') {
            // Update the quotation status to 'declined'
            DB::table('quotation')->where('service_id', $id)->update([
                'status' => 'declined'
            ]);

            $user = DB::table('quotation')->where('service_id',$id)->first();

            $admin = auth()->user()->user_code;
            if($user!=null && $user->sent_by != $admin) {
                $user_code = $user->sent_by;
                $message = "Admin ".auth()->user()->user_name." has declined quotation proposal";
                $link  = "/view-quotation/".$id;
                $title = "Quotation Declined By ".auth()->user()->user_name;
                $type = "all";
                $date = date('y-m-d');
                $time = Carbon::now()->format('h:i A');
                DB::table('notifications')->insert([
                    'title' => $title,
                    'message' => $message,
                    'date' => $date,
                    'user_id' => $user_code,
                    'status' => "unread",
                    'link' => $link,
                    'time' => $time,
                    'type' => $type,
                ]);
            }

            return response()->json(['message' => 'Quotation declined!'], 200);
        } else {
            // Handle the case where the status is not 'decline'
            $check = DB::table('quotation')->where('service_id', $id)->first();

            if ($check) {
                $email = $check->client_email;
                $sent_to = $check->sent_to;

                // Fetch services and quotes data
                $services = DB::table('services')->where('service_id', $id)->get();
                $quotes = DB::table('quotation')->where('service_id', $id)->first();

                // Define the email subject
                $subject = "New Quotation from Reblate Solutions";

                // Generate the PDF
                $pdf = PDF::loadView('Quotation.pdf_view', compact('services', 'quotes'))
                    ->setOptions([
                        'defaultFont' => 'sans-serif',
                        'isHtml5ParserEnabled' => true,
                        'enable_php' => false,  // Make sure PHP is disabled for security
                        'enable_javascript' => false,  // Make sure JavaScript is disabled
                        'enable_remote' => true,
                        'enable_font_subsetting' => true,
                    ]);

                // Define the file path for the PDF
                $filePath = public_path('quotations/quotation_' . $id . '.pdf');

                // Save the PDF to the public directory
                $pdf->save($filePath);

                // Send the email with the PDF attachment
                Mail::send('Quotation.quotation_email', ['quotes' => $quotes], function ($message) use ($email, $subject, $filePath) {
                    $message->to($email)
                        ->subject($subject)
                        ->attach($filePath, [
                            'as' => 'quotation_' . time() . '.pdf',
                            'mime' => 'application/pdf',
                        ]);
                });

                DB::table('quotation')->where('service_id', $id)->update([
                    'status' => 'approved'
                ]);

                $user = DB::table('quotation')->where('service_id',$id)->first();

                $admin = auth()->user()->user_code;
                if($user!=null && $user->sent_to != $admin) {
                $user_code = $user->sent_by;
                $message = "Admin ".auth()->user()->user_name." has approved quotation proposal";
                $link  = "/view-quotation/".$id;
                $title = "Quotation Approved By ".auth()->user()->user_name;
                $type = "all";
                $date = date('y-m-d');
                $time = Carbon::now()->format('h:i A');
                DB::table('notifications')->insert([
                    'title' => $title,
                    'message' => $message,
                    'date' => $date,
                    'user_id' => $user_code,
                    'status' => "unread",
                    'link' => $link,
                    'time' => $time,
                    'type' => $type,
                ]);


                // Delete the PDF file after sending the email
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                return response()->json(['message' => 'Quotation sent successfully'], 200);
            } else {
                return response()->json(['message' => 'Quotation not found'], 404);
            }
        }
    }



}
}
