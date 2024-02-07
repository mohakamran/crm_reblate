<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
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
        $client_data = Client::find($id);
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
        $client_data = Client::find($id);
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
        $client_data = Client::find($id);
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
        $client = Client::find($id);
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
