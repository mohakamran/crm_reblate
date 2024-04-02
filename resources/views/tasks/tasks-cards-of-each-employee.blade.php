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
                        @if (Auth()->user()->user_type == 'admin')
                            <a href="/view-tasks" class="position-absolute top-0 start-1 pt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#14213d"
                                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
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
                        @if (Auth()->user()->user_type == 'admin' || Auth()->user()->user_type == 'manager')
                            <div class="d-flex flex-column align-items-center p-3 gap-2" style="">

                                <a href="/create-new-task" class="text-dark fw-bold p-2">Assign New</a>
                                <a href="/update-tasks/{{ $emp_id }}" class="text-dark fw-bold p-2">Update</a>
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
                                            @if (Auth()->user()->user_type == 'employee' || Auth()->user()->user_type == 'manager')
                                                <a style="color: #14213d;" href="#" data-toggle="modal"
                                                    data-target="#taskModal{{ $task->id }}">
                                                    {{ $task->task_title }}
                                                </a>
                                            @else
                                                {{ $task->task_title }}
                                            @endif
                                        </h5>
                                        <P style="font-size: 15px; margin-bottom: 5px;">Task Desc:
                                            {{ $task->task_description }}</P>

                                        {{-- <div class="progress mb-2" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 90%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$task->task_percentage}}% Complete</div>
                                        </div> --}}
                                        <p class="mb-0" style="font-size:15px;margin-top:10px; color:gray;">deadline:
                                            {{ $task->task_date }}</p>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="taskModal{{ $task->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="taskModal{{ $task->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ $task->task_title }}
                                                    </h5>
                                                    {{-- <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button> --}}
                                                </div>
                                                <div class="modal-body">
                                                    <strong>Task Description:</strong> <br>
                                                    <p>
                                                        {{ $task->task_description }}
                                                    </p>
                                                    <b>Task DeadLine</b>
                                                    <p>
                                                        {{ $task->task_date }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-primary" style="display: none" id="success_message_{{$task->id}}">Task Updated Successfully!</p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="">Task Update</label>
                                                            <textarea name="" required id="task_update_{{ $task->id }}" class="form-control" id=""
                                                                cols="20" rows="5"></textarea>
                                                                <p class="text-danger" style="display: none;" id="task_update_message_{{ $task->id }}">Task Update is required!</p>
                                                        </div>

                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <label for="">Task Status</label>
                                                            <select name="task_status" id="task_status_{{ $task->id }}"
                                                                class="form-control">

                                                                <option value="completed " selected="selected">Completed</option>
                                                                <option value="pending" >Pending</option>
                                                                <option value="in-progress">In Progress</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="saveChanges({{ $task->id }})">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
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
                                            @if (Auth()->user()->user_type == 'employee' || Auth()->user()->user_type == 'manager')
                                                <a style="color: #14213d;" href="#" data-toggle="modal"
                                                    data-target="#taskModal{{ $task->id }}">
                                                    {{ $task->task_title }}
                                                </a>
                                            @else
                                                {{ $task->task_title }}
                                            @endif
                                        </h5>
                                        <p style="font-size: 15px; margin-bottom: 5px;">{{ $task->task_description }}</p>
                                        {{-- <div class="progress mb-2" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{$task->task_percentage}}%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$task->task_percentage}}% Complete</div>
                                        </div> --}}
                                        <p class="mb-0" style="font-size:15px;margin-top:10px; color:gray;">deadline:
                                            {{ $task->task_date }}</p>

                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="taskModal{{ $task->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="taskModal{{ $task->id }}Label"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ $task->task_title }}</h5>
                                                    {{-- <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button> --}}
                                                </div>
                                                <div class="modal-body">
                                                    <strong>Task Description:</strong> <br>
                                                    <p>
                                                        {{ $task->task_description }}
                                                    </p>
                                                    <b>Task DeadLine</b>
                                                    <p>
                                                        {{ $task->task_date }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-primary" style="display: none" id="success_message_{{$task->id}}">Task Updated Successfully!</p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="">Task Update</label>
                                                            <textarea name="" required id="task_update_{{ $task->id }}" class="form-control" id=""
                                                                cols="20" rows="5"></textarea>
                                                                <p class="text-danger" style="display: none;" id="task_update_message_{{ $task->id }}">Task Update is required!</p>

                                                        </div>

                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <label for="">Task Status</label>
                                                            <select name="task_status"
                                                                id="task_status_{{ $task->id }}"
                                                                class="form-control">

                                                                    <option value="pending" selected="selected">Pending</option>
                                                                <option value="completed">Completed</option>

                                                                <option value="in-progress">In Progress</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="saveChanges({{ $task->id }})">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
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
                            <p class="mb-0">No Tasks Available</p>
                        @else
                            @foreach ($tasks as $task)
                                @if ($task->task_status == 'in-progress')
                                    <div style="border-bottom: 1px solid #e3e3e3; margin-top:10px;">
                                        <h5 style="font-size: 20px;">
                                            @if (Auth()->user()->user_type == 'employee' || Auth()->user()->user_type == 'manager')
                                                <a style="color: #14213d;" href="#" data-toggle="modal"
                                                    data-target="#taskModal{{ $task->id }}">
                                                    {{ $task->task_title }}
                                                </a>
                                            @else
                                                {{ $task->task_title }}
                                            @endif
                                        </h5>
                                        <P style="font-size: 15px; margin-bottom: 5px;">Task Desc:
                                            {{ $task->task_description }}</P>
                                        {{-- <div class="progress mb-2" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 80%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$task->task_percentage}}% Complete</div>
                                        </div> --}}
                                        <p class="mb-0" style="font-size:15px;margin-top:10px; color:gray;">deadline:
                                            {{ $task->task_date }}</p>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="taskModal{{ $task->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="taskModal{{ $task->id }}Label"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ $task->task_title }}</h5>
                                                    {{-- <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button> --}}
                                                </div>
                                                <div class="modal-body">
                                                    <strong>Task Description:</strong> <br>
                                                    <p>
                                                        {{ $task->task_description }}
                                                    </p>
                                                    <b>Task DeadLine</b>
                                                    <p>
                                                        {{ $task->task_date }}
                                                    </p>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-primary" style="display: none" id="success_message_{{$task->id}}">Task Updated Successfully!</p>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label for="">Task Update</label>
                                                            <textarea name="" required class="form-control" id="task_update_{{ $task->id }}" cols="20"
                                                                rows="5"></textarea>
                                                                <p class="text-danger" style="display: none;" id="task_update_message_{{ $task->id }}">Task Update is required!</p>
                                                        </div>

                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-md-12">
                                                            <label for="">Task Status</label>
                                                            <select name="task_status"
                                                                id="task_status_{{ $task->id }}"
                                                                class="form-control">

                                                                    <option value="in-progress" selected="selected">In Progress</option>
                                                                <option value="completed">Completed</option>
                                                                <option value="pending" >Pending</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="saveChanges({{ $task->id }})">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>


        {{-- if the user is employee or manager the show below  --}}
        {{-- @if (auth()->user()->user_type == 'manager' || auth()->user()->user_type == 'employee')
            <div class="row mt-5">
                <div class="col md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="fw-bold" style="color: #14213d">Daily Repoting</h3>
                            <textarea class="w-100 p-3 inputboxcolor" placeholder="Enter Your Daily Report"
                                style="resize: none; height:150px;border: 1px solid #e3e3e3" name="DailtReport" id="DailyReport"></textarea>
                            <div class="w-25 mt-2">
                                <button type="submit" class="reblateBtn px-4 py-2">
                                    Submit
                                </button>
                                <a href="/view_reports" class="reblateBtn px-4 py-2">
                                    View Reporting
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @endif --}}



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

            function saveChanges(id) {
                var task_status_id = "task_status_" + id; // Corrected concatenation
                var task_update_id = "task_update_" + id; // Corrected concatenation
                var task_update_message_id = "task_update_message_" + id;
                var success_message_id = "success_message_" + id;
                var task_status = document.getElementById(task_status_id).value;
                var task_update = document.getElementById(task_update_id).value;
                // alert(success_message_id);
                var task_update_message = document.getElementById(task_update_message_id);
                // alert(task_update_message_id);


                // Assuming your controller URL is '/your_controller/save_data'
                var url = '/save_task_database';

                if (task_update.trim() === "") { // Check if task_update is empty or contains only whitespace
                    task_update_message.style.display = "block";
                    return; // Exit the function
                } else {
                    task_update_message.style.display = "none"; // Hide the error message if task_update is not empty
                }

                // Data to be sent to the controller
                var dataToSend = {
                    task_status: task_status,
                    task_update: task_update,
                    id: id,
                    _token: '{{ csrf_token() }}'
                };

                // $.ajax({
                //     type: 'POST',
                //     url: url,
                //     data: dataToSend,
                //     success: function(response) {
                //         // Handle success
                //         console.log("Data saved successfully.");
                //     },
                //     error: function(xhr, status, error) {
                //         // Handle errors
                //         console.error("Error occurred while saving data:", error);
                //     }
                // });

                fetch(url, {
                        method: 'POST', // Ensure this is set to 'POST'
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(dataToSend),
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Handle success
                        var success_message_id = "success_message_" + id;

                        var success_message_element = document.getElementById(success_message_id);
                        if (success_message_element) {
                            success_message_element.style.display = "block";
                            document.getElementById(task_update_id).value = "";
                            location.reload();
                        } else {
                            console.error("Success message element not found!");
                            document.getElementById(task_update_id).value = "";
                        }
                    })
                    .catch(error => {
                        // Handle errors
                        console.error("Error occurred while saving data:", error);
                    });

            }

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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <!-- Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection
