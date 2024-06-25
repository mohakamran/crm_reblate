@extends('layouts.master')
@section('title')
    Tasks {{ $emp_name }}
@endsection
@section('page-title')
    Tasks of {{ $emp_name }}
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            .empTitle {
                color: #14213d;
                font-weight: 600;
                font-size: 25px;
                font-family: 'Poppins';
            }

            .empSubTitle {
                color: #14213d;
                font-size: 15px;
                font-weight: 300;
                font-family: 'Poppins';
            }

            .empMenu {
                list-style: none;
                font-family: 'Poppins';
                color: gray;
                border-bottom: 1px solid #fff;
                cursor: pointer;

            }

            .empMenu:hover {
                color: #14213d;
                font-weight: 600;
                border-bottom: 1px solid #fca311;
            }

            .active {
                color: #14213d;
                font-weight: 600;
                border-bottom: 1px solid #fca311;
            }
        </style>

        <div class="row mt-2 align-items-center justify-content-center">
            <div class="col-md-6 col-lg-6 col-xl-6">
                <div class="card mb-3">
                    <div class="card-body bg-light"
                        style="box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.7); max-height: 400px;">
                        <div style="background-color: #fca311;width: 100%;height: 120px;border-radius: 10px;">
                        </div>
                        <!-- Using a dummy CDN link for the image -->
                        {{-- @if (Auth()->user()->user_type == 'admin')
                            <a href="/view-tasks" class="position-absolute pt-2" style="top: 15px; left: 30px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                                </svg>
                            </a>
                        @endif --}}
                        <div class="d-flex align-items-center justify-content-center position-relative" style="top:-70px;">
                            @if ($Emp_Image != '')
                                <img class="img-fluid "
                                    style="width:150px; object-fit:cover; height:150px; border-radius: 50%;"
                                    src="{{ $Emp_Image }}">
                            @else
                                <img class="img-fluid "
                                    style="width:150px; object-fit:cover; height:150px; border-radius: 50%;"
                                    src="{{ URL::asset('user.png') }}">
                            @endif

                        </div>

                        <div class="d-flex justify-content-center flex-column position-relative text-center"
                            style="top:-45px;">
                            <h5 class="empTitle mb-0">{{ $emp_name }}</h5>
                            <p class="empSubTitle mb-0 ">{{ $Emp_Designation }}</p>
                            <p class="empSubTitle mb-0">{{ $Emp_Shift_Time }}</p>
                        </div>
                        <div class="mt-4 position-relative" style="top:-35px;">
                            <ul
                                class="d-flex gap-4 align-items-center list-group list-group-flush account-settings-links flex-row">
                                <li style="list-style: none"><a href="#tasks" data-toggle="list"
                                        class="empMenu active">Tasks</a> </li>
                                <li style="list-style: none"><a href="#reports" data-toggle="list"
                                        class="empMenu">Report</a> </li>
                            </ul>
                        </div>

                        {{-- @if (Auth()->user()->user_type == 'admin')
                            <div class="d-flex flex-column align-items-center p-3 gap-2  >
                                <a href="/create-new-task" class="text-dark fw-bold p-2">Assign New</a>
                                <a href="/update-tasks/{{ $emp_id }}" class="text-dark fw-bold p-2">Update</a>
                            </div>

                        @endif --}}

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="container-fluid tab-pane fade active show" style="border-bottom: none" id="tasks">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="row">

                            <div class="col-md-4">
                                @php
                                    $pendingTasksCount = $tasks->where('task_status', 'pending')->count();
                                @endphp
                                <div class="card" style="box-shadow: 0px 0px 10px 10px #00000021;border-radius: 10px;">
                                    <p class="p-2 rounded-top text-white mb-0"
                                        style="font-size: 17px; background-color: red">Pending</p>
                                    <div class="p-2 rounded-bottom bg-white">
                                        @if ($pendingTasksCount == 0)
                                            <div class="text-center d-flex align-items-center justify-content-center"
                                                style="height: 100px">
                                                <p class="mb-0 empTitle font-size-18" style="color: gray">No Tasks Available
                                                </p>
                                            </div>
                                        @else
                                            @foreach ($tasks as $task)
                                                @if ($task->task_status == 'pending')
                                                    <div style="border-bottom: 1px solid #e3e3e3;margin-top:10px;">
                                                        <h5 style="font-size: 20px;">
                                                            @if (Auth()->user()->user_type == 'employee' || Auth()->user()->user_type == 'manager')
                                                                <a
                                                                    href="/task-update/{{ $task->id }}">{{ $task->task_title }}</a>
                                                            @else
                                                                {{ $task->task_title }}
                                                            @endif
                                                        </h5>
                                                        <p style="font-size: 15px; margin-bottom: 5px;">
                                                            {{ $task->task_description }}</p>
                                                        {{-- <div class="progress mb-2" style="height: 20px;">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                                role="progressbar" style="width: 50%;" aria-valuenow="100"
                                                                aria-valuemin="0" aria-valuemax="100">50% Complete</div>
                                                        </div> --}}
                                                        <p class="mb-0"
                                                            style="font-size:15px;margin-top:10px; color:gray;">Deadline:
                                                            {{ $task->task_date }}</p>
                                                        <p class="mb-0"
                                                            style="font-size:15px;margin-top:10px; color:gray;">Assigned By:
                                                            {{ $task->assigned_by }}</p>

                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                @php
                                    $inProgressTasksCount = $tasks->where('task_status', 'in-progress')->count();
                                @endphp
                                <div class="card" style="box-shadow: 0px 0px 10px 10px #00000021;border-radius: 10px;">
                                    <p class="p-2 rounded-top text-white mb-0"
                                        style="font-size: 17px;background-color: #e6b400">In Progress</p>
                                    <div class="p-2 rounded-bottom bg-white">
                                        @if ($inProgressTasksCount == 0)
                                            <div class="text-center d-flex align-items-center justify-content-center"
                                                style="height: 100px">
                                                <p class="mb-0 empTitle font-size-18" style="color: gray">No Tasks
                                                    Available</p>
                                            </div>
                                        @else
                                            @foreach ($tasks as $task)
                                                @if ($task->task_status == 'in-progress')
                                                    <div style="border-bottom: 1px solid #e3e3e3; margin-top:10px;">
                                                        <h5 style="font-size: 20px;">
                                                            @if (Auth()->user()->user_type == 'employee' || Auth()->user()->user_type == 'manager')
                                                                <a
                                                                    href="/task-update/{{ $task->id }}">{{ $task->task_title }}</a>
                                                            @else
                                                                {{ $task->task_title }}
                                                            @endif
                                                        </h5>
                                                        <P style="font-size: 15px; margin-bottom: 5px;">Task Desc:
                                                            {{ $task->task_description }}</P>
                                                        {{-- <div class="progress mb-2" style="height: 20px;">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                                role="progressbar" style="width: 80%;"
                                                                aria-valuenow="100" aria-valuemin="0"
                                                                aria-valuemax="100">{{ $task->task_percentage }}%
                                                                Complete</div>
                                                        </div> --}}
                                                        <p class="mb-0"
                                                        style="font-size:15px;margin-top:10px; color:gray;">Deadline:
                                                        {{ $task->task_date }}</p>
                                                    <p class="mb-0"
                                                        style="font-size:15px;margin-top:10px; color:gray;">Assigned By:
                                                        {{ $task->assigned_by }}</p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card" style="box-shadow: 0px 0px 10px 10px #00000021;border-radius: 10px;">
                                    @php
                                        $completedTasksCount = $tasks->where('task_status', 'completed')->count();
                                    @endphp
                                    <p class="p-2 rounded-top text-white mb-0"
                                        style="font-size: 17px; background-color: green">Completed</p>
                                    <div class="p-2 rounded-bottom bg-white">
                                        @if ($completedTasksCount == 0)
                                            <div class="text-center d-flex align-items-center justify-content-center"
                                                style="height: 100px">
                                                <p class="mb-0 empTitle font-size-18" style="color: gray">No Tasks Available
                                                </p>
                                            </div>
                                        @else
                                            @foreach ($tasks as $task)
                                                @if ($task->task_status == 'completed')
                                                    <div style="border-bottom: 1px solid #e3e3e3;margin-top:10px;">
                                                        <h5 style="font-size: 20px;">
                                                            @if (Auth()->user()->user_type == 'employee' || Auth()->user()->user_type == 'manager')
                                                                <a
                                                                    href="/task-update/{{ $task->id }}">{{ $task->task_title }}</a>
                                                            @else
                                                                {{ $task->task_title }}
                                                            @endif
                                                        </h5>
                                                        <P style="font-size: 15px; margin-bottom: 5px;">Task Desc:
                                                            {{ $task->task_description }}</P>

                                                        {{-- <div class="progress mb-2" style="height: 20px;">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                                role="progressbar" style="width: 90%;" aria-valuenow="100"
                                                                aria-valuemin="0" aria-valuemax="100">
                                                                {{ ($task->task_percentage !=null) ? $task->task_percentage : '0' }}% Complete</div>
                                                        </div> --}}
                                                        <p class="mb-0"
                                                            style="font-size:15px;margin-top:10px; color:gray;">Deadline:
                                                            {{ $task->task_date }}</p>
                                                        <p class="mb-0"
                                                            style="font-size:15px;margin-top:10px; color:gray;">Assigned By:
                                                            {{ $task->assigned_by }}</p>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid tab-pane fade" style="border-bottom: none" id="reports">
                <div class="card">
                    <div class="card-body gap-3 bg-light d-flex align-items-center justify-content-center"
                        style="height: 200px">
                        <h1>
                            This page is under Construction
                        </h1>
                        <lord-icon src="https://cdn.lordicon.com/mqvldalw.json" trigger="hover"
                            style="width:100px;height:100px">
                        </lord-icon>

                    </div>
                </div>

            </div>
        </div>




        <!-- end row -->
        <script>
            document.querySelectorAll('.task-description').forEach(function(element) {
                var truncated = true;
                var originalText = element.innerText;
                var truncatedText = originalText.slice(0, 50) + '...';

                element.innerText = truncatedText;

                element.addEventListener('click', function() {
                    truncated = !truncated;
                    element.innerText = truncated ? truncatedText : originalText;
                });
            });

            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }
        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        <script src="https://cdn.lordicon.com/lordicon.js"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
