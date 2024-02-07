<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{

    public function resetPasswordClient($id) {
        $userEmp = DB::table('users')->where('user_code', $id)->first();

        if ($userEmp) {
            // Generate a random password
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=';
            $randomPassword = Str::random(12, $characters);

            // Update the user's password
            DB::table('users')
                ->where('user_code', $id)
                ->update(['password' => Hash::make($randomPassword)]);

            // Send email to relevant user
            $login_user_name = $userEmp->user_name;
            $login_user_email = $userEmp->user_email;
            $data = compact('login_user_name', 'login_user_email', 'randomPassword');
            $mail_subject = "Your Password has been reset!";

            Mail::send('client-login.update-email-template', $data, function ($message) use ($mail_subject, $login_user_email) {
                $message->to($login_user_email)
                    ->subject($mail_subject);
            });

            return response()->json(['success']);
        } else {
            return response()->json(['error']);
        }
    }

    // delete client credentials
    public function deleteClientLogin($id)
    {
        $check = DB::table('client_portal')->where('client_id', $id)->first();
        if ($check) {
            $check_user = DB::table('users')->where('user_code', $id)->first();
            if ($check_user) {
                DB::table('users')->where('user_code', $id)->delete();
            }
            DB::table('client_portal')->where('client_id', $id)->delete();
            return response()->json(['message' => 'success']);
        } else {
            // Return an error response if the record was not found
            return response()->json(['message' => 'error', 'error' => 'Record not found'], 404);
        }
    }

    // view created login clients
    public function viewClientLogins(){
        $rec = DB::table('client_portal')->orderBy('id','desc')->get();
        $title = "Logins Created";
        $data = compact('rec','title');
        return view('client-login.view-login',$data);

    }
    // send details to client
    public function sendDetails($id) {
        $client_data = DB::table('clients')->where('client_id',$id)->first();
        if($client_data) {
            $check_id= DB::table('client_portal')->where('client_id',$id)->first();
            // if client already exists then redirect to error message
            if($check_id) {
                session()->flash('error', 'Client ID Already Exists!');
                return redirect('/create-client-logins');
            }
            // send email to relevant user
            $client_email = $client_data->client_email;
            $client_name = $client_data->client_name;
            $project_name = $client_data->project_name;
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=';
            $randomPassword = Str::random(12, $characters);

            DB::table('client_portal')->insert([
                'name' => $client_name,
                // 'status' => 'created',
                'client_id' => $id,
                'status' => 'created',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('users')->insert([
                'user_name' => $client_name,
                'user_email' => $client_email,
                'user_type' => "client",
                'remember_token' => '',
                'user_code' => $id,
                'password' => Hash::make($randomPassword),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $data = compact('client_name', 'client_email', 'randomPassword','project_name' );
            $mail_subject = "Reblate Solutions have invited you on Client Portal!";
            Mail::send('client-login.email-template', $data, function ($message) use ($mail_subject, $client_email) {
                $message->to($client_email)
                        ->subject($mail_subject);
            });
            session()->flash('success', 'Login Invitation Sent successfully!');
            return redirect('/create-client-logins');

        } else {
            return redirect('/create-client-logins');
        }
    }
    // send client credentials to client
    public function sendDetailsClients($id) {
        $client_data = DB::table('clients')->where('client_id',$id)->first();
        if($client_data) {
            $data = compact('client_data');
            return view('client-login.view-client-login',$data);
        } else {
            return redirect('/create-client-logins');
        }
    }
    // create login view
    public function createClientLoginView() {
        $emp_data = Client::all();
        if($emp_data) {
            $data = compact('emp_data');
            return view('client-login.view')->with($data);
        }
        else {
            return redirect('/');
        }
    }
    // add client route
    public function addClientRoute() {
       $title = "Add New Client";
       $route = "/add-new-client";
       $btn_text = "Add New Client";
       return view('clients.add-new-client')->with(compact('title','route','btn_text'));
    }
    //get data and save in database
    public function addClientData(Request $req) {
        $randomNumber = mt_rand(100, 999); // Generates a random number between 100 and 999

        $validate = $req->validate([
            'client_name' => 'required',
            'project_client_name' => 'required',
            'project_start_date' => 'required',
            'client_project_type' => 'required',
            'client_email' => 'required'
        ]);

        $client_id = "cl".$randomNumber;
        $find_id = Client::where('client_id',$client_id)->first();
        if($find_id) {
            $randomNumber = mt_rand(100, 999);
            $client_id = "cl".$randomNumber;
        }

        if($req->client_phone == "") {
            $client_phone = "";
        } else {
            $client_phone = $req->client_phone;
        }

        if($req->client_description == "") {
            $client_description = "";
        } else {
            $client_description = $req->client_description;
        }
        $client = new Client();
        $client->client_name = $req->client_name;
        $client->client_id = $client_id;
        $client->project_name = $req->project_client_name;
        $client->project_start_date	 = $req->project_start_date;
        $client->project_type = $req->client_project_type;
        $client->client_email = $req->client_email;
        $client->client_phone = $client_phone;
        $client->project_description = $client_description;
        $client->save();
        session()->flash('success', 'Client added successfully!');
        return back();
    }
    public function viewClients() {
       $rec = Client::orderBy('id', 'desc')->get();
       if($rec !=null) {
           $title = "Reblate Solutions Clients";
           $data  = compact('rec','title');
           return view('clients.view-clients')->with($data);
       } else {
           return redirect('/');
       }
    }
    // client details
    public function viewClientDetail($id) {
        $client_data = Client::where('client_id',$id)->first();
        if($client_data) {
            $title = $client_data->client_name;
            $btn_text = 'Go back';
            $data = compact('title', 'client_data','btn_text');
            return view('clients.view-details')->with($data);
        }
        else {
            return redirect('manage-employees');
        }
    }
    // delete client id
    public function deleteClientData($id) {
        $client_data = Client::where('client_id',$id)->first();
        if($client_data) {
            $client_data->delete();
            return response()->json(['message' => 'success']);

        } else {
            // return redirect('manage-employees');
            return response()->json(['message' => 'failed']);
        }
    }
    //client route update
    public function updateClientRoute($id) {
        $client_data = Client::where('client_id',$id)->first();
        if($client_data) {
            $title = "Update Client Data";
            $route="/update-client/".$id;
            $btn_text = "Update Client";
            $data = compact('title', 'client_data', 'route','btn_text');
            return view('clients.add-new-client')->with($data);
        }
        else {
            return redirect('/');
        }
    }
    // update clients info and save in database
    public function updateClientData(Request $req, $id) {
        $client = Client::where('client_id',$id)->first();
        if($client) {
            $validate = $req->validate([
                'client_name' => 'required',
                'project_client_name' => 'required',
                'project_start_date' => 'required',
                'client_project_type' => 'required',
                'client_email' => 'required'
            ]);
            if($req->client_phone == "") {
                $client_phone = "";
            } else {
                $client_phone = $req->client_phone;
            }

            if($req->client_description == "") {
                $client_description = "";
            } else {
                $client_description = $req->client_description;
            }

            $client->client_name = $req->client_name;
            $client->project_name = $req->project_client_name;
            $client->project_start_date	 = $req->project_start_date;
            $client->project_type = $req->client_project_type;
            $client->client_email = $req->client_email;
            $client->client_phone = $client_phone;
            $client->project_description = $client_description;
            $client->save();
            session()->flash('success', 'Client updated successfully!');
            return back();

        } else {
            return redirect('/');
        }
    }
}
