@extends('layouts.master')
@section('title')
Projects
@endsection

@section('page-title')
Projects
@endsection
@section('body')


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card bg-white p-3">
                <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <h4 style="color: black;">Edit Project</h4>
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name" style="color: black;">Project Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $project->name) }}" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="start_date" style="color: black;">Start Date <span class="text-danger">*</span></label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $project->start_date) }}" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="end_date" style="color: black;">End Date <span class="text-danger">*</span></label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $project->end_date) }}" required>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-group">
                <label for="status" style="color: black;">Project Status <span class="text-danger">*</span></label>
                <select name="status" id="file_shift" class="form-control" required>
                    <option value="Not Started" {{ old('status', $project->status) == 'Not Started' ? 'selected' : '' }}>Not Started</option>
                    <option value="In Progress" {{ old('status', $project->status) == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Completed" {{ old('status', $project->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="On Hold" {{ old('status', $project->status) == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group" style="color: black;">
                <label for="assigned_team_members">Assigned Team Members <span class="text-danger">*</span></label>
                <select name="assigned_team_members[]" id="assigned_team_members" class="form-control" required>
                    @foreach($employee as $employees)
                        <option value="{{ $employees->id }}" {{ in_array($employees->id, old('assigned_team_members', explode(',', $project->assigned_team_members))) ? 'selected' : '' }}>
                            {{ $employees->Emp_Full_Name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group" style="color: black;">
                <label for="budget">Budget <span class="text-danger">*</span></label>
                <input type="number" id="budget" name="budget" class="form-control" value="{{ old('budget', $project->budget) }}" required>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-group">
                <label for="client" style="color: black;">Client/Stakeholder <span class="text-danger">*</span></label>
                <select name="client" id="client" class="form-control" required>
                    @foreach($client as $data)
                        <option value="{{ $data->id }}" {{ old('client', $project->client) == $data->id ? 'selected' : '' }}>
                            {{ $data->client_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="priority" style="color: black;">Priority <span class="text-danger">*</span></label>
                <select id="priority" name="priority" class="form-control" required>
                    <option value="Low" {{ old('priority', $project->priority) == 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ old('priority', $project->priority) == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ old('priority', $project->priority) == 'High' ? 'selected' : '' }}>High</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="attachments" style="color: black;">Attachments/Files</label>
                <input type="file" class="form-control" id="image" name="image">
                @if($project->image)
                    <small>Current Image: <a href="{{ asset($project->image) }}" target="_blank">View Image</a></small>
                @endif
            </div>
        </div>
    </div>

    <h4 class="mt-3" style="color: black;">Description</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <textarea name="description" id="description" class="form-control p-3" style="width:100%;height:80px;">{!! old('description', $project->description) !!}</textarea>
            </div>
        </div>
    </div>

    <div class="form-group mt-4">
        <input type="submit" class="reblateBtn p-2" value="Update Project">
    </div>
</form>

                </div>
            </div>
        </div> 

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>

        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <script>
            $('#description').summernote({
                placeholder: 'Project Description',
                color:'black',
                tabsize: 2,
                height: 100
            });
        </script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endsection
