<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Mail;
use App\Models\Employee;
use App\Models\Client;

use Illuminate\Support\Facades\Response;


use Illuminate\Support\Str;



class AuthController extends Controller
{
    // forget password
    public function forgetPassword(){
       return view('auth.forget');
    }
    // client login
    public function loginClient(Request $request){
        $validate = $request->validate([
            'client_email' => 'required',
            'client_password' => 'required',
        ]);
        // $pass = Hash::make($request->client_password);
        // dd($pass);
         // $credentials = $request->only('user_email', 'password');
         $remember = $request->has('remember'); // Check if "Remember Me" is selected

         if (Auth::attempt(['user_email' => $request->client_email, 'password' => $request->client_password],$remember)) {
             // Authentication was successful
             return redirect('/'); // Redirect to the home page
         }

         // Authentication failed
         return redirect()->route('user.client')
                ->withInput(['client_email' => $request->input('client_email')])
                ->with('error', 'Email or Password Incorrect!');
    }
    //employee login
    public function loginEmployee(Request $request) {
        $validate = $request->validate([
            'employee_code' => 'required',
            'user_password' => 'required',
        ]);

        // $pass = Hash::make($request->user_password);
        // dd($pass);

        // $credentials = $request->only('user_email', 'password');
        $remember = $request->has('remember'); // Check if "Remember Me" is selected

        if (Auth::attempt(['user_code' => $request->employee_code, 'password' => $request->user_password],$remember)) {
            // Authentication was successful
            return redirect('/'); // Redirect to the home page
        }

        // Authentication failed
        return redirect()->route('user.emp')
               ->withInput(['employee_code' => $request->input('employee_code')])
               ->with('error', 'Employee Code or Password Incorrect!');

    }

    public function loginAdmin(Request $request) {
        $validate = $request->validate([
            'admin_email' => 'required',
            'user_password' => 'required',
        ]);

        // $pass = Hash::make($request->user_password);
        // dd($pass);

        // $credentials = $request->only('user_email', 'password');
        $remember = $request->has('remember'); // Check if "Remember Me" is selected

        if (Auth::attempt(['user_email' => $request->admin_email, 'password' => $request->user_password],$remember)) {
            // Authentication was successful
            return redirect('/'); // Redirect to the home page
        }

        // Authentication failed
        return redirect()->route('user.admin')
               ->withInput(['admin_email' => $request->input('admin_email')])
               ->with('error', 'Email or Password Incorrect!');
    }

    public function indexHomePage() {
        $user_type = auth()->user()->user_type;
        if($user_type == "employee") {
            $employees = Employee::all();
            $emp_count = count($employees);
            // dd($count);
            $clients = Client::all();
            $client_count = count($clients);
            $data = compact('emp_count','client_count');
            return view('index.emp-dashboard',$data);
        } else if($user_type == "admin") {
            $employees = Employee::all();
            $emp_count = count($employees);
            // dd($count);
            $clients = Client::all();
            $client_count = count($clients);
            $data = compact('emp_count','client_count');
            return view('index.index',$data);
        } else if($user_type == "client") {
            $employees = Employee::all();
            $emp_count = count($employees);
            // dd($count);
            $clients = Client::all();
            $client_count = count($clients);
            $data = compact('emp_count','client_count');
            return view('index.client-dashboard',$data);
        } else {
            return view('auth.login');
        }

    }

    public function index() {
        return view('auth.login');
    }
    public function loginIndex(Request $request) {
        $validate = $request->validate([
            'user_email' => 'required|string|email',
            'user_password' => 'required',
        ]);

        // $credentials = $request->only('user_email', 'password');
        $remember = $request->has('remember'); // Check if "Remember Me" is selected

        if (Auth::attempt(['user_email' => $request->user_email, 'password' => $request->user_password],$remember)) {
            // Authentication was successful
            return redirect('/'); // Redirect to the home page
        }

        // Authentication failed
        return redirect()->route('auth.user')
               ->withInput(['user_email' => $request->input('user_email')])
               ->with('error', 'Invalid credentials');


    }
    public function registerUser() {
        $title = "User Registeration";
        $route = "/user-register";
        $btn_text = "Add New User";
        return view('auth.user-register',compact('title','route','btn_text'));
    }

    public function registerUserData(Request $req) {

        $validate = $req->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required |string |email|max:255| unique:users',
            'user_role' => 'required|in:admin,super_admin',
        ]);

        // Define the set of characters to use in the password
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=';
        $randomPassword = Str::random(12, $characters);
        $userEmail  = $req->user_email;
        $userName  = $req->user_name;
        $userRole  = $req->user_role;
        //dd($randomPassword);
        $mail_subject = "New Account Creation";
        if($userRole == "super_admin") {
            $userRole = "Super Admin";
        }
        $data = compact('userName', 'userEmail', 'userRole','randomPassword');

         Mail::send('auth.email-template',$data , function ($message) use ($mail_subject, $userEmail) {
            $message->to($userEmail)
                ->subject($mail_subject);
        });


        // hash password
        $hash_password = Hash::make($randomPassword);
        // saving data to database
        $authModel = new User();
        $authModel->user_name = $req->user_name;
        $authModel->user_email = $req->user_email;
        $authModel->password = $hash_password;
        $authModel->user_type = $req->user_role;
        $authModel->save();

        // success message
        session()->flash('success', 'Invitation Sent Successfully!');
        return redirect('/user-register');
    }

    public function logout()
    {
        Auth::logout();
        $url = route('auth.login'); // 'login' is the name of the route
        return redirect($url);
    }

    public function changePassword($id) {
        $user = User::find($id);
        if($user) {
            $title= "Change Password";
            $route = "/change-password/".$user->id;
            $btn_text = "Update Account";
            $data = compact('title','user','route','btn_text');
            return view('auth.change-password')->with($data);
        }
        else {
            return redirect('/');
        }

    }

    public function changePasswordData($id, Request $req){
        $validate = $req->validate([
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string |email|max:255',
            'user_password' => 'sometimes|confirmed',
            'user_password_confirmation' => 'sometimes',
        ]);
        $user = User::find($id);
        if($id) {
            if($req->user_password == "") {
                $hash_password = $user->password;
            } else {
               // hash password
               $hash_password = Hash::make($req->user_password);
            }

            // udpating data to database
            $user->user_name = $req->user_name;
            $user->user_email = $req->user_email;
            $user->password = $hash_password;
            $user->save();
             // success message
            session()->flash('success', 'Account Updated Successfully!');
            return back();
        }
        else {
            return redirect('/');
        }

    }

    public function sendUserResetPassword($id) {

        $user = User::find($id);
        // Define the set of characters to use in the password
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_+=';
        $randomPassword = Str::random(12, $characters);
        $userName = $user->user_name;
        $userEmail = $user->user_email;
        $mail_subject = "Password Update From Reblate Solutions";
        $data = compact('userName', 'userEmail','randomPassword');
        Mail::send('auth.change-password-template',$data , function ($message) use ($mail_subject, $userEmail) {
        $message->to($userEmail)
            ->subject($mail_subject);
        });
        // hash password
        $hash_password = Hash::make($randomPassword);

        $user->password = $hash_password;
        $user->save();

        return response()->json(['message' => 'success']);

    }

    public function viewUsersData($id) {
       $id = User::find($id);
       if($id) {
            if($id->user_type == "super_admin") {
                $users = User::where('user_type', 'admin')->orderBy('id', 'desc')->get();
                if($users !=null) {
                    $title="All Users";
                    return view('auth.users',compact('users','title'));
                } else {
                    return redirect('/');
                }
            }
            else {
                return redirect('/');
            }
       } else {
          return redirect('/');
       }
    }

    public function deleteUser($id) {
        $user_data = User::find($id);
        if($user_data) {
            $user_data->delete();
            return response()->json(['message' => 'success']);
        } else {
            // return redirect('manage-employees');
            return response()->json(['message' => 'failed']);
        }
    }

    public function changeUserDetails($id) {
        $user = User::find($id);
        if($user) {
            $title= "Account Details";
            $route = "/user-details/".$user->id;
            $btn_text = "Update User";
            $data = compact('title','user','route','btn_text');
            return view('auth.details')->with($data);
        }
        else {
            return redirect('/');
        }
    }

    public function changeUserDetailsData($id, Request $req) {
        $validate = $req->validate([
            'user_role' => 'required|in:admin,super_admin'
        ]);
        $user = User::find($id);
        if($user) {

            $mail_subject = "Reblate Solutions Account Update";
            $userRole = $req->user_role;
            $userRoleOld = $user->user_type;
            if($userRoleOld == "super_admin") {
                $userRoleOld = "Super Admin";
            }
            if($userRole == "super_admin") {
                $userRole = "Super Admin";
            }

            $userName = $user->user_name;
            $userEmail = $req->user_hidden_email;
            $data = compact('userName', 'userEmail', 'userRole','userRoleOld');


              Mail::send('auth.change-role-template',$data , function ($message) use ($mail_subject, $userEmail) {
            $message->to($userEmail)
                ->subject($mail_subject);
           });


            // udpating data to database
            $user->user_type = $userRole;
            $user->save();
             // success message
            session()->flash('success', 'Role Updated Successfully!');
            return back();
        }
        else {
            return redirect('/');
        }
    }

    // login employee view
    public function viewLoginEmployee() {
        return view('auth.emp-login');
    }

    //  client login
    public function viewLoginClient() {
        return view('auth.client-login');
    }
    // admin login view
    public function viewLoginAdmin() {
        return view('auth.admin-login');
    }

}
