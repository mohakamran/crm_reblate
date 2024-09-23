<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Models\Project;
use App\Models\User; 
use Carbon\Carbon;
use App\Notifications\ProjectAssigned; 
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProjectController extends Controller
{
    public function index() {
       $project = Project::all();
        return view('projects.index',compact('project'));
    }

    public function add_Project_Page(){

        $employee = Employee::where('Emp_Status','active')->get();
        $client = Client::all();
        return view('projects.addProjectsPage',compact('employee','client'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
            'team_members.*' => 'exists:employees,id',
            'budget' => 'nullable|numeric',
            'client' => 'nullable|string|max:255',
            'priority' => 'nullable|string|max:255',
            'image' => 'required|file|mimes:pdf|max:2048',
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('ProjectFiles'), $imageName);

        $project = new Project();
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        $project->status = $request->input('status'); 
        $project->budget = $request->input('budget'); 
        $project->client = $request->input('client'); 
        $project->priority = $request->input('priority'); 
        $project->image = 'ProjectFiles/' . $imageName;
        $project->assigned_team_members  = $request->input('assigned_team_members'); 
        $project->save();

        $teamMemberIds = explode(',', $project->assigned_team_members);
        foreach ($teamMemberIds as $userId) {
            $userId = trim($userId);
            DB::table('notifications')->insert([
                'title' => 'New Project is assigned to You',
                'message' => "A new project has been added for {$project->name}.",
                'date' => date('Y-m-d'),
                'user_id' => $userId, 
                'time' => Carbon::now()->format('h:i A'), 
                'status' => "unread",
                'type' => "all",
                'link' => "/project-assign-records",
            ]);
        }

        return redirect()->route('projects.index')->with('success', 'Project created and team members notified!');
    }

    public function delete($id){

        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(['message' => 'success'], 200);
    }

    public function edit($id){
        $project = Project::findOrFail($id);
        $employee = Employee::where('Emp_Status','active')->get();
        $client = Client::all();
        return view('projects.update', compact('project','employee','client'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string',
            'team_members.*' => 'exists:employees,id',
            'budget' => 'nullable|numeric',
            'client' => 'nullable|string|max:255',
            'priority' => 'nullable|string|max:255',
            'image' => 'nullable|image|file|mimes:jpg,png,webp,pdf,docx,txt|max:2048',
        ]);
    
        $project = Project::findOrFail($id);
    
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image && file_exists(public_path($project->image))) {
                unlink(public_path($project->image));
            }
    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('ProjectImage'), $imageName);
            $project->image = 'ProjectImage/' . $imageName;
        }
    
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        $project->status = $request->input('status'); 
        $project->budget = $request->input('budget'); 
        $project->client = $request->input('client'); 
        $project->priority = $request->input('priority'); 
        $project->assigned_team_members = $request->input('assigned_team_members'); 
        $project->save();
    
        $teamMemberIds = explode(',', $project->assigned_team_members);
        foreach ($teamMemberIds as $userId) {
            $userId = trim($userId);
            DB::table('notifications')->insert([
                'title' => 'Updated Project assigned to You',
                'message' => "The project {$project->name} has been updated.",
                'date' => date('Y-m-d'),
                'user_id' => $userId, 
                'time' => Carbon::now()->format('h:i A'), 
                'status' => "unread",
                'type' => "all",
                'link' => "/project-assign-records",
            ]);
        }
    
        return redirect()->back()->with('success', 'Project updated and team members notified!');
    }
    
    public function show($id){
        
        $project = Project::findOrFail($id);
        return view('projects.view', compact('project'));
    }

    public function empProjectRecords() {
        $user_code = Auth()->user()->user_code;
        $emp_assign_projects = DB::table('projects')
        ->where('assigned_team_members', 'LIKE', "%$user_code%")
        ->orderBy('id', 'desc')
        ->get();
        return view('projects.ShowRecords',compact('user_code','emp_assign_projects'));
    }

}
