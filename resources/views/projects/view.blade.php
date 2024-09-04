@extends('layouts.master')
@section('title')
 View Announcement
@endsection

@section('page-title')
View Announcement
@endsection
@section('body')
    <style>
        .form-control {
            background-color: #fff;
            /* Set background color for the select box */
            color: #000;
            /* Set text color */
        }
    </style>

    <style>
        .service-container {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .task-container {
            margin-top: 10px;
        }
    </style>


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <body data-sidebar="colored">
    @endsection
    @section('content')
    <div class="container mt-5">
        <h1>Project Details</h1>
        <div class="card">
            <div class="card-header">
                <h4>{{ $project->name }}</h4>
            </div>
            <div class="card-body">
                <p><strong>Description:</strong> {{ $project->description }}</p>
                <p><strong>Start Date:</strong> {{ $project->start_date }}</p>
                <p><strong>End Date:</strong> {{ $project->end_date }}</p>
                <p><strong>Status:</strong> {{ $project->status }}</p>
                <p><strong>Budget:</strong> {{ $project->budget }}</p>
                <p><strong>Client:</strong> {{ $project->client }}</p>
                <p><strong>Priority:</strong> {{ $project->priority }}</p>
                <p><strong>Assigned Team Members:</strong></p>
                <ul>
                    @if($project->assigned_team_members)
                        @foreach(explode(',', $project->assigned_team_members) as $memberId)
                            @php
                                $member = \App\Models\Employee::find($memberId);
                            @endphp
                            <li>{{ $member->Emp_Full_Name ?? 'Unknown' }}</li>
                        @endforeach
                    @else
                        <li>No team members assigned.</li>
                    @endif
                </ul>
                <p><strong>Attachments:</strong></p>
                <ul>
                <a href="{{ asset($project->image) }}" target="_blank">View PDF</a>
                </ul>
            </div>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Back</a>
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



        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endsection
