<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Carbon;

use Illuminate\Support\Str;


class QuotationController extends Controller
{
    // view browser based quotation
    public function viewQuotation($id) {
        $services = DB::table('services')->where('service_id',$id)->get();
        $quotes = DB::table('quotation')->where('service_id',$id)->first();
        // dd($services, $quotes);
        return view('Quotation.view-page',compact('services','quotes'));
    }
    public function index() {
        $quo = DB::table('quotation')->orderBy('id','desc')->get();
        return view('Quotation.form',compact('quo'));
    }
    // create quotations
    public function createQuotation() {
        return view('Quotation.add');
    }

    // save database
    public function saveQuotation(Request $request)
    {

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
            'additional_notes' => 'nullable|string',
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

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
}
