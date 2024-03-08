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
        <div class="float-right">
            <a href="/view-tasks" class="btn btn-primary ">Go back</a>
            <a href="/create-new-task" class="btn btn-primary ">Assign New Task</a>
            <a href="/update-tasks/{{ $emp_id }}" class="btn btn-primary ">Update Tasks</a>
        </div>
        <div class="row mt-2">
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <!-- Using a dummy CDN link for the image -->

                        @if (isset($Emp_Image) && $Emp_Image != '')
                            <img class="img-fluid rounded-circle mb-3" style="width:100px;height:100px;"
                                src="{{ $Emp_Image }}">
                        @else
                            <img class="img-fluid rounded-circle mb-3" src="{{ URL::asset('user.png') }}">
                        @endif
                        <h5 class="card-title">{{ $emp_name }}</h5>
                        <p class="card-text">{{ $Emp_Designation }}</p>
                        <p class="card-text">{{ $Emp_Shift_Time }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4">
                <div class="card float-left">
                    @php
                        $completedTasksCount = $tasks->where('task_status', 'completed')->count();
                    @endphp
                    <div class="card-header bg-success text-white">Completed</div>
                    <div class="card-body">
                        @if ($completedTasksCount == 0)
                            <p>No Tasks Available</p>
                        @else
                            @foreach ($tasks as $task)
                                @if ($task->task_status == 'completed')
                                    <div class="mt-3">
                                        <h5 class="card-title ">{{ $task->task_title }}</h5>
                                        <P class="task-description">Task Desc: {{ $task->task_description }}</P>

                                        <div class="progress mb-2">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 90%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                {{ $task->task_percentage }}% Complete</div>
                                        </div>
                                        <p style="font-size:12px;margin-top:10x;">deadline: {{ $task->task_date }}</p>
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
                <div class="card float-left">
                    <div class="card-header bg-danger text-white">Pending</div>
                    <div class="card-body">
                        @if ($pendingTasksCount == 0)
                            <p>No Tasks Available</p>
                        @else
                            @foreach ($tasks as $task)
                                @if ($task->task_status == 'pending')
                                    <div class="mt-3">
                                        <h5 class="card-title ">{{ $task->task_title }}</h5>
                                        <P class="task-description">{{ $task->task_description }}</P>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $task->task_percentage }}%;" aria-valuenow="100"
                                                aria-valuemin="0" aria-valuemax="100">{{ $task->task_percentage }}%
                                                Complete</div>
                                        </div>
                                        <p style="font-size:12px;margin-top:10x;">deadline: {{ $task->task_date }}</p>

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
                <div class="card float-left">
                    <div class="card-header bg-success text-white">In Progress</div>
                    <div class="card-body">
                        @if ($inProgressTasksCount == 0)
                            <p>No Tasks Available</p>
                        @else
                            @foreach ($tasks as $task)
                                @if ($task->task_status == 'in-progress')
                                    <div class="mt-3">
                                        <h5 class="card-title ">{{ $task->task_title }}</h5>
                                        <P class="task-description">Task Desc: {{ $task->task_description }}</P>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 80%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                {{ $task->task_percentage }}% Complete</div>
                                        </div>
                                        <p style="font-size:12px;margin-top:10x;">deadline: {{ $task->task_date }}</p>
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
