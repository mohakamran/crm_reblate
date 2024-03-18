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

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body" style="display: flex; align-items: center; justify-content: space-between;">
                        <!-- Using a dummy CDN link for the image -->
                        @if (Auth()->user()->user_type == "admin")
                            <a href="/view-tasks" class="position-absolute top-0 start-1 pt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#14213d" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                                </svg>
                            </a>
                        @endif

                        <div class="d-flex align-items-center gap-3" style="margin-left: 15px;">
                            @if ($Emp_Image != '')
                            <img class="img-fluid rounded-circle" style="width:100px;height:100px; object-fit: cover;"
                                src="{{ $Emp_Image }}">
                        @else
                            <img class="img-fluid rounded-circle " src="{{ URL::asset('user.png') }}">
                        @endif
                        <div class="d-flex flex-column gap-1 ml-4">
                            <h5 class="card-title mb-0" style="font-size: 25px;">{{ $emp_name }}</h5>
                            <p class="card-text mb-1 ">{{ $Emp_Designation }}</p>
                            <p class="card-text">{{ $Emp_Shift_Time }}</p>

                        </div>
                        </div>
                        @if (Auth()->user()->user_type == "admin")
                                <div class="d-flex align-items-center p-3 gap-2" style="background-color: #14213d24; border-radius: 10px;">

                                    <a href="/create-new-task" class="reblateBtn p-2">Assign New</a>
                                    <a href="/update-tasks/{{$emp_id}}" class="reblateBtn p-2">Update</a>
                                </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4">
                <div class="card" style="box-shadow: 0px 0px 10px 10px #00000021;border-radius: 10px;">
                    @php
                        $completedTasksCount = $tasks->where('task_status', 'completed')->count();
                    @endphp
                    <p class="p-4 rounded-top bg-success text-white mb-0" style="font-size: 17px;">Completed</p>
                    <div class="p-4 rounded-bottom bg-white">
                        @if ($completedTasksCount == 0)
                            <p class="mb-0">No Tasks Available</p>
                        @else
                            @foreach ($tasks as $task)
                                @if ($task->task_status == 'completed')
                                    <div style="border-bottom: 1px solid #e3e3e3;margin-top:10px;">
                                        <h5 style="font-size: 20px;">
                                            @if (Auth()->user()->user_type == "employee" || Auth()->user()->user_type == "manager")
                                                <a href="/task-update/{{$task->id}}">{{ $task->task_title }}</a>
                                                @else
                                                {{ $task->task_title }}
                                            @endif
                                        </h5>
                                        <P style="font-size: 15px; margin-bottom: 5px;">Task Desc: {{ $task->task_description }}</P>

                                        <div class="progress mb-2" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 90%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$task->task_percentage}}% Complete</div>
                                        </div>
                                        <p class="mb-0"  style="font-size:15px;margin-top:10px; color:gray;">deadline: {{$task->task_date}}</p>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                @php
                    $pendingTasksCount = $tasks->where('task_status', 'pending')->count();
                @endphp
                <div class="card" style="box-shadow: 0px 0px 10px 10px #00000021;border-radius: 10px;">
                    <p class="p-4 rounded-top bg-danger text-white mb-0" style="font-size: 17px;">Pending</p>
                    <div class="p-4 rounded-bottom bg-white">
                        @if ($pendingTasksCount == 0)
                            <p class="mb-0">No Tasks Available</p>
                        @else
                            @foreach ($tasks as $task)
                                @if ($task->task_status == 'pending')
                                    <div style="border-bottom: 1px solid #e3e3e3;margin-top:10px;">
                                        <h5 style="font-size: 20px;">
                                            @if (Auth()->user()->user_type == "employee" || Auth()->user()->user_type == "manager")
                                               <a href="/task-update/{{$task->id}}">{{ $task->task_title }}</a>
                                               @else
                                               {{ $task->task_title }}
                                            @endif
                                        </h5>
                                        <p style="font-size: 15px; margin-bottom: 5px;">{{ $task->task_description }}</p>
                                        <div class="progress mb-2" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{$task->task_percentage}}%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$task->task_percentage}}% Complete</div>
                                        </div>
                                        <p class="mb-0"  style="font-size:15px;margin-top:10px; color:gray;">deadline: {{$task->task_date}}</p>

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
                    <p class="p-4 rounded-top bg-warning text-black mb-0" style="font-size: 17px;">In Progress</p>
                    <div class="p-4 rounded-bottom bg-white">
                        @if ($inProgressTasksCount == 0)
                            <p class="mb-0" >No Tasks Available</p>
                        @else
                            @foreach ($tasks as $task)
                                @if ($task->task_status == 'in-progress')
                                    <div style="border-bottom: 1px solid #e3e3e3; margin-top:10px;">
                                        <h5 style="font-size: 20px;">
                                            @if (Auth()->user()->user_type == "employee" || Auth()->user()->user_type == "manager")
                                               <a href="/task-update/{{$task->id}}">{{ $task->task_title }}</a>
                                            @else
                                            {{ $task->task_title }}
                                         @endif
                                        </h5>
                                        <P style="font-size: 15px; margin-bottom: 5px;">Task Desc: {{ $task->task_description }}</P>
                                        <div class="progress mb-2" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 80%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$task->task_percentage}}% Complete</div>
                                        </div>
                                        <p class="mb-0"  style="font-size:15px;margin-top:10px; color:gray;">deadline: {{$task->task_date}}</p>
                                    </div>
                                @endif
                            @endforeach
                        @endif
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

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
