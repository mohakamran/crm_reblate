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
                font-size: 15px;

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

            .modal-backdrop.fade {
                opacity: 0;
                display: none;
            }

            .modal-backdrop.show {
                opacity: var(--bs-backdrop-opacity);
                display: none;
            }

            .popup {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, 0.5);
                width: 100%;
                height: 100%;
                z-index: 1000;
                backdrop-filter: blur(5px);
            }

            .popup-content {
                /* overflow-y: scroll;
                                                                                                                                scroll-behavior: smooth scroll; */
                display: flex;
                max-width: 700px;
                margin: auto auto;
                position: relative;
                top: 100px;
                justify-content: center;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                text-align: center;
            }

            .closeBtn {
                position: absolute;
                top: 25px;
                right: 15px;
                cursor: pointer;
            }
        </style>

        <div class="row mt-2 align-items-center justify-content-center">
            <div class="col-md-6 col-lg-6 col-xl-6">
                <div class="card mb-3">
                    <div class="card-body bg-white"
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
                            @if ($Emp_Image != '' || !file_exists($Emp_Image))
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
                        <div class="row">
                            <div class="col-md-6">
                                <ul
                                    class="d-flex gap-4 align-items-center list-group list-group-flush account-settings-links flex-row">
                                    <li style="list-style: none"><a href="#tasks" data-toggle="list"
                                            class="empMenu active">Tasks</a> </li>
                                    <li style="list-style: none"><a href="#to_tasks" data-toggle="list" class="empMenu">To
                                            Do Tasks</a> </li>
                                    @if (auth()->user()->user_type == 'admin')
                                    @else

                                        <li style="list-style: none"><a href="#create_tasks" data-toggle="list"
                                            class="empMenu">
                                            Create Task</a> </li>



                                    @endif

                                </ul>
                            </div>

                            <div class="col-md-6 mb-2" style="margin-top: -8px;">
                                <form action="/search-emp-tasks-date" method="post">
                                    @csrf

                                    <div class="form-group row">
                                        <input type="hidden" value="{{ $emp_code }}" name="emp_code">
                                        <div class="col">
                                            <input type="month" name="emp_month" class="form-control"
                                                value="{{ $year }}-{{ $month }}">
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-primary">View</button>
                                        </div>
                                    </div>

                                </form>
                            </div>


                        </div>




                        {{-- @if (Auth()->user()->user_type == 'admin')
                            <div class="d-flex flex-column align-items-center p-3 gap-2 position-absolute top-0"  >
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
                    <div class="card-body bg-white">
                        <div class="row">

                            <div class="col-md-4">
                                @php
                                    $pendingTasksCount = $tasks->where('task_status', 'pending')->count();
                                @endphp
                                <div class="card" style="box-shadow: 0px 0px 10px 10px #00000021;border-radius: 10px;">

                                    <p class="p-2 rounded-top text-white mb-0"
                                        style="font-size: 17px; background-color: red">Pending ({{ $pendingTasksCount }})
                                    </p>
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
                                                                <a href="#" onclick="openModel({{ $task->id }})"
                                                                    id="popupButton{{ $task->id }}">{{ $task->task_title }}</a>
                                                            @else
                                                                {{ $task->task_title }}
                                                            @endif
                                                        </h5>
                                                        <p style="font-size: 15px; margin-bottom: 1px;">
                                                            {{ $task->task_description }}</p>

                                                        <p class="mb-0"
                                                            style="font-size:12px;margin-top:10px; color:gray;">Assigned
                                                            Date:
                                                            {{ date('d F Y', strtotime($task->assigned_date)) }}

                                                        </p>

                                                        <?php
                                                        $today = date('Y-m-d'); // Get today's date in "YYYY-MM-DD" format
                                                        ?>



                                                        <p class="mb-0"
                                                            style="font-size:12px;margin-top:2px; color:gray;">Deadline:

                                                            @if ($task->task_date == $today)
                                                                <span
                                                                    style="color:red">{{ date('d F Y', strtotime($task->task_date)) }}</span>
                                                            @else
                                                                {{ date('d F Y', strtotime($task->task_date)) }}
                                                            @endif
                                                            <span style="margin-left:10px;">Assigned By:
                                                                {{ $task->assigned_by }}</span>
                                                        </p>
                                                        {{-- <p class="mb-0"
                                                            style="font-size:15px;margin-top:10px; color:gray;">Assigned By:
                                                            {{ $task->assigned_by }}</p> --}}

                                                    </div>

                                                    <div class="popup" id="popup_{{ $task->id }}">

                                                        <div class="popup-content flex-column">
                                                            <div
                                                                class="d-flex mb-3 align-items-center justify-content-between">
                                                                <h2 class="mb-0"
                                                                    style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                                                    {{ $task->task_title }}</h2>
                                                                <span class="closeBtn{{ $task->id }} p-2"
                                                                    style="border-radius: 50%; background-color:#14213d26"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" fill="#14213d50" class="bi bi-x-lg"
                                                                        viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                                    </svg></span>
                                                            </div>
                                                            <p id="success_message_{{ $task->id }}"
                                                                style="color:green;font-size:15px;display:none;">
                                                            </p>
                                                            <p id="error_message_{{ $task->id }}"
                                                                style="color:#ce3b3b;font-size:15px;display:none;"></p>
                                                            <form action="" class="text-start">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-lg-12 col-xl-12">

                                                                        <div class="d-flex flex-column">
                                                                            <label for="">Task Status <span
                                                                                    style="color:#ce3b3b;">*</span></label>
                                                                            <div class="mb-3 d-flex form-control inputboxcolor "
                                                                                style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">



                                                                                <select class="form-control"
                                                                                    style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                                    name=""
                                                                                    id="task_status_{{ $task->id }}">
                                                                                    <option value="" selected>Select
                                                                                        Task Status</option>
                                                                                    <option value="completed">Completed
                                                                                    </option>

                                                                                    <option value="in-progress">In Progress
                                                                                    </option>
                                                                                    <option value="pending">Pending
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                                        <div class="d-flex flex-column">
                                                                            <label for="">Anything to Write</label>
                                                                            <div class="mb-3 d-flex form-control inputboxcolor "
                                                                                style="border: 1px solid #14213d; padding:10px; background-color: white;">

                                                                                <textarea class="form-control" id="task_report_{{ $task->id }}"
                                                                                    style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                                    name=""></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>





                                                                    <div class="mt-2">
                                                                        <button type="button"
                                                                            onclick="taskUpdateEmp({{ $task->id }},'pending')"
                                                                            class="px-4 py-2 reblateBtn">Save
                                                                            Changes</button>
                                                                    </div>
                                                                </div>
                                                            </form>
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
                                    <p class="p-2 rounded-top text-white mb-0"
                                        style="font-size: 17px;background-color: #e6b400">In Progress
                                        ({{ $inProgressTasksCount }})</p>
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
                                                    <div style="border-bottom: 1px solid #e3e3e3;margin-top:10px;">
                                                        <h5 style="font-size: 20px;">
                                                            @if (Auth()->user()->user_type == 'employee' || Auth()->user()->user_type == 'manager')
                                                                <a href="#"
                                                                    onclick="openModel({{ $task->id }})"
                                                                    id="popupButton{{ $task->id }}">{{ $task->task_title }}</a>
                                                            @else
                                                                {{ $task->task_title }}
                                                            @endif
                                                        </h5>
                                                        <p style="font-size: 15px; margin-bottom: 1px;">
                                                            {{ $task->task_description }}</p>

                                                        <p class="mb-0"
                                                            style="font-size:12px;margin-top:10px; color:gray;">Assigned
                                                            Date:
                                                            {{ date('d F Y', strtotime($task->assigned_date)) }}

                                                        </p>

                                                        <?php
                                                        $today = date('Y-m-d'); // Get today's date in "YYYY-MM-DD" format
                                                        ?>



                                                        <p class="mb-0"
                                                            style="font-size:12px;margin-top:2px; color:gray;">Deadline:

                                                            @if ($task->task_date == $today)
                                                                <span
                                                                    style="color:red">{{ date('d F Y', strtotime($task->task_date)) }}</span>
                                                            @else
                                                                {{ date('d F Y', strtotime($task->task_date)) }}
                                                            @endif
                                                            <span style="margin-left:10px;">Assigned By:
                                                                {{ $task->assigned_by }}</span>
                                                        </p>
                                                        {{-- <p class="mb-0"
                                                        style="font-size:15px;margin-top:10px; color:gray;">Assigned By:
                                                        {{ $task->assigned_by }}</p> --}}

                                                    </div>

                                                    <div class="popup" id="popup_{{ $task->id }}">

                                                        <div class="popup-content flex-column">
                                                            <div
                                                                class="d-flex mb-3 align-items-center justify-content-between">
                                                                <h2 class="mb-0"
                                                                    style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                                                    {{ $task->task_title }}</h2>
                                                                <span class="closeBtn{{ $task->id }} p-2"
                                                                    style="border-radius: 50%; background-color:#14213d26"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" fill="#14213d50"
                                                                        class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                                    </svg></span>
                                                            </div>
                                                            <p id="success_message_{{ $task->id }}"
                                                                style="color:green;font-size:15px;display:none;">
                                                            </p>
                                                            <p id="error_message_{{ $task->id }}"
                                                                style="color:#ce3b3b;font-size:15px;display:none;"></p>
                                                            <form action="" class="text-start">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-lg-12 col-xl-12">

                                                                        <div class="d-flex flex-column">
                                                                            <label for="">Task Status <span
                                                                                    style="color:#ce3b3b;">*</span></label>
                                                                            <div class="mb-3 d-flex form-control inputboxcolor "
                                                                                style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">



                                                                                <select class="form-control"
                                                                                    style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                                    name=""
                                                                                    id="task_status_{{ $task->id }}">
                                                                                    <option value="" selected>Select
                                                                                        Task Status</option>
                                                                                    <option value="completed">Completed
                                                                                    </option>

                                                                                    <option value="in-progress">In Progress
                                                                                    </option>
                                                                                    <option value="pending">Pending
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                                        <div class="d-flex flex-column">
                                                                            <label for="">Anything to Write</label>
                                                                            <div class="mb-3 d-flex form-control inputboxcolor "
                                                                                style="border: 1px solid #14213d; padding:10px; background-color: white;">

                                                                                <textarea class="form-control" id="task_report_{{ $task->id }}"
                                                                                    style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                                    name=""></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>





                                                                    <div class="mt-2">
                                                                        <button type="button"
                                                                            onclick="taskUpdateEmp({{ $task->id }},'in progress')"
                                                                            class="px-4 py-2 reblateBtn">Save
                                                                            Changes</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
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
                                        style="font-size: 17px; background-color: green">Completed
                                        ({{ $completedTasksCount }})</p>
                                    <div class="p-2 rounded-bottom bg-white">
                                        @if ($completedTasksCount == 0)
                                            <div class="text-center d-flex align-items-center justify-content-center"
                                                style="height: 100px">
                                                <p class="mb-0 empTitle font-size-18" style="color: gray">No Tasks
                                                    Available
                                                </p>
                                            </div>
                                        @else
                                            @foreach ($tasks as $task)
                                                @if ($task->task_status == 'completed')
                                                    <div style="border-bottom: 1px solid #e3e3e3;margin-top:10px;">
                                                        <h5 style="font-size: 20px;">
                                                            @if (Auth()->user()->user_type == 'employee' || Auth()->user()->user_type == 'manager')
                                                                <a href="#"
                                                                    onclick="openModel({{ $task->id }})"
                                                                    id="popupButton{{ $task->id }}">{{ $task->task_title }}</a>
                                                            @else
                                                                {{ $task->task_title }}
                                                            @endif
                                                        </h5>
                                                        <p style="font-size: 15px; margin-bottom: 1px;">
                                                            {{ $task->task_description }}</p>

                                                        <p class="mb-0"
                                                            style="font-size:12px;margin-top:10px; color:gray;">Assigned
                                                            Date:
                                                            {{ date('d F Y', strtotime($task->assigned_date)) }}

                                                        </p>

                                                        <?php
                                                        $today = date('Y-m-d'); // Get today's date in "YYYY-MM-DD" format
                                                        ?>



                                                        <p class="mb-0"
                                                            style="font-size:12px;margin-top:2px; color:gray;">Deadline:



                                                            {{ date('d F Y', strtotime($task->task_date)) }}

                                                            <span style="margin-left:10px;">Assigned By:
                                                                {{ $task->assigned_by }}</span>
                                                        </p>
                                                        {{-- <p class="mb-0"
                                                        style="font-size:15px;margin-top:10px; color:gray;">Assigned By:
                                                        {{ $task->assigned_by }}</p> --}}

                                                    </div>

                                                    <div class="popup" id="popup_{{ $task->id }}">

                                                        <div class="popup-content flex-column">
                                                            <div
                                                                class="d-flex mb-3 align-items-center justify-content-between">
                                                                <h2 class="mb-0"
                                                                    style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                                                    {{ $task->task_title }}</h2>
                                                                <span class="closeBtn{{ $task->id }} p-2"
                                                                    style="border-radius: 50%; background-color:#14213d26"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="20"
                                                                        height="20" fill="#14213d50"
                                                                        class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                        <path
                                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                                    </svg></span>
                                                            </div>
                                                            <p id="success_message_{{ $task->id }}"
                                                                style="color:green;font-size:15px;display:none;">
                                                            </p>
                                                            <p id="error_message_{{ $task->id }}"
                                                                style="color:#ce3b3b;font-size:15px;display:none;"></p>
                                                            <form action="" class="text-start">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-lg-12 col-xl-12">

                                                                        <div class="d-flex flex-column">
                                                                            <label for="">Task Status <span
                                                                                    style="color:#ce3b3b;">*</span></label>
                                                                            <div class="mb-3 d-flex form-control inputboxcolor "
                                                                                style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">



                                                                                <select class="form-control"
                                                                                    style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                                    name=""
                                                                                    id="task_status_{{ $task->id }}">
                                                                                    <option value="" selected>Select
                                                                                        Task Status</option>
                                                                                    <option value="completed">Completed
                                                                                    </option>

                                                                                    <option value="in-progress">In Progress
                                                                                    </option>
                                                                                    <option value="pending">Pending
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                                        <div class="d-flex flex-column">
                                                                            <label for="">Anything to Write</label>
                                                                            <div class="mb-3 d-flex form-control inputboxcolor "
                                                                                style="border: 1px solid #14213d; padding:10px; background-color: white;">

                                                                                <textarea class="form-control" id="task_report_{{ $task->id }}"
                                                                                    style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                                    name=""></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>





                                                                    <div class="mt-2">
                                                                        <button type="button"
                                                                            onclick="taskUpdateEmp({{ $task->id }},'completed')"
                                                                            class="px-4 py-2 reblateBtn">Save
                                                                            Changes</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
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
            <div class="container-fluid tab-pane fade show" style="border-bottom: none" id="to_tasks">
                <div class="card">
                    <div class="card-body bg-white">
                        <h4>Tasks Added ({{ $to_do_task_count }})</h4>
                        @php
                            $count = 0;
                        @endphp
                        <div class="row">

                            @foreach ($to_do_tasks as $task)
                                <div class="col-md-4">
                                    <a data-toggle="modal" data-target="#popup_to_do_{{ $task->id }}"
                                        href="#"> {{ $loop->iteration }} - {{ $task->task_title }}</a>
                                </div>

                                <div class="popup" id="popup_to_do_{{ $task->id }}">
                                    <div class="popup-content flex-column">
                                        <div class="d-flex mb-3 align-items-center justify-content-between">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $task->task_title }}</h5>
                                        </div>

                                        <div class="modal-body">
                                            <h5 style="text-align:left;">Task Report: </h5>
                                            <p style="text-align:left;font-weight:400;">{{ $task->task_report }}</p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p style="text-align:left;font-weight:400;"> Date:
                                                    {{ $task->assigned_date }}
                                                <p>
                                                <p style="text-align:left;font-weight:400;"> Task Type:
                                                    {{ $task->task_type }}
                                                <p>
                                                <p style="text-align:left;font-weight:400;"> Task Status:
                                                    {{ $task->task_status }}
                                                <p>
                                            </div>

                                            <div class="modal-footer mt-3 d-flex gap-2">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $count++;
                                @endphp
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid tab-pane fade show" style="border-bottom: none" id="create_tasks">
                <div class="card">
                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-12 mt-2">

                                <p class="text-danger" style="display: none;" id="task_error"></p>
                                <p class="text-success" style="display: none;" id="task_green"></p>
                                <div class="form-group mt-2">
                                    <label for="">Task Title <span style="color:red">*</span></label>
                                    <input type="text" id="task_title" class="form-control"
                                        placeholder="task title" />
                                </div>
                                <div class="form-group mt-2">
                                    <label for="">Task Description / Report <span
                                            style="color:red">*</span></label>
                                    <textarea class="form-control" id="task_description" style="width:100%;height:100px;" name="task_desc"></textarea>
                                </div>
                                <button class="reblateBtn p-2 mt-2" onclick="addTaskEmp(event)">Add Task</button>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <h4>Task Created ({{ $to_do_task_count }}) in the month of
                                    {{ \Carbon\Carbon::create()->month($month)->format('F') }} , {{ $year }}</h4>
                                <table id="datatable-buttons" class="table dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr style="background-color: #14213d">
                                            <th class="borderingLeftTable font-size-20" style="color: white">ID</th>
                                            <th class="font-size-20" style="color: white">Tasks Title</th>
                                            <th class="font-size-20" style="color: white">Assigned Date</th>
                                            <th class="borderingRightTable font-size-20" style="color: white">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="table-body">
                                        @php
                                            $count = 0;
                                        @endphp

                                        @foreach ($to_do_tasks as $task)
                                            @php
                                                $count++;
                                            @endphp
                                            <tr style="border-bottom: 1px solid #c7c7c7">
                                                <td>{{ $count }}</td>
                                                <td>{{ $task->task_title }}</td>
                                                <td>{{ date('d F Y', strtotime($task->assigned_date)) }}</td>

                                                <td>
                                                    <a href="#popup_task_to_do_{{ $task->id }}"
                                                        onclick="openModal({{ $task->id }})" data-toggle="modal">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="m14.06 9.02l.92.92L5.92 19H5v-.92zM17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83a.996.996 0 0 0 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                    <a href="#" onclick="TaskEducation({{ $task->id }})">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="#d20f0f"
                                                                d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z">
                                                            </path>
                                                        </svg>
                                                    </a>

                                                </td>
                                            </tr>

                                            <div class="popup fade" id="popup_task_to_do_{{ $task->id }}"
                                                data-dismiss="dismiss_{{ $task->id }}">
                                                <div class="popup-content flex-column">
                                                    <div class="d-flex mb-3 align-items-center justify-content-between">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            Update Changes</h5>

                                                    </div>

                                                    <div class="modal-body">

                                                        <p class="text-danger" style="display: none;"
                                                            id="message_id_{{ $task->id }}"></p>
                                                        <p class="text-success" style="display: none;"
                                                            id="message_success_{{ $task->id }}">Task Updated!</p>
                                                        <form action="">
                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <div class="form-group" style="text-align: left;">
                                                                        <label for="">Task Title <span
                                                                                style="color:red">*</span></label>
                                                                        <input type="text"
                                                                            id="task_title_{{ $task->id }}"
                                                                            placeholder="task title" name=""
                                                                            value="{{ isset($task->task_title) ? $task->task_title : '' }}"
                                                                            class="form-control">
                                                                        <span style="color:red;display:none"
                                                                            id="task_title_message_{{ $task->id }}"></span>
                                                                    </div>
                                                                </div>


                                                            </div>



                                                            <div class="row mt-3">
                                                                <div class="col-md-12">
                                                                    <div class="form-group" style="text-align: left;">
                                                                        <label for="">Task Description / Report
                                                                            <span style="color:red">*</span></label>
                                                                        <textarea name="" class="form-control" id="task_description_{{ $task->id }}">{{ $task->task_description != null ? $task->task_description : '' }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                    </div>
                                                    <div class="modal-footer mt-3 d-flex gap-2">
                                                        <button type="button" class="btn btn-secondary"
                                                            onclick="hideModal({{ $task->id }})">Close</button>
                                                        <button type="button" onclick="updateTask({{ $task->id }})"
                                                            class="reblateBtn px-4 py-2">Update Changes</button>
                                                    </div>





                                                </div>

                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>




        <!-- end row -->
        <script>
            //update
            function updateTask(id) {


                var message = 'message_id_' + id;
                var message_success = 'message_success_' + id;
                var task_title = 'task_title_' + id;

                var task_desc = 'task_description_' + id;

                task_title = document.getElementById(task_title).value;

                task_desc = document.getElementById(task_desc).value;
                message = document.getElementById(message);
                message_success = document.getElementById(message_success);


                if (task_title == "") {
                    message.style.display = "block";
                    message.innerHTML = "task title required!";
                    return;
                } else {
                    message.style.display = "none";
                }


                if (task_desc == "") {
                    message.style.display = "block";
                    message.innerHTML = "task description required!";
                    return;
                } else {
                    message.style.display = "none";
                }



                var csrfToken = "{{ csrf_token() }}";



                var formData = {
                    id: id,
                    _token: csrfToken,
                    task_title: task_title,
                    task_desc: task_desc
                };

                $.ajax({
                    url: '/update-task-to-do', // The Laravel route
                    type: 'get', // POST request
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Add CSRF token to request headers
                    },
                    data: formData,
                    success: function(response) {


                        if (message.style.display == "block") {
                            message.style.display == "none";
                        }
                        var task_title_reset = 'task_title_' + id;

                        var task_desc_reset = 'task_description_' + id;
                        task_title_reset = document.getElementById(task_title_reset).value = "";

                        task_desc_reset = document.getElementById(task_desc_reset).value = "";
                        message_success.style.display = "block";
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400) {
                            if (message_success.style.display == "block") {
                                message_success.style.display == "none";
                            }
                            message.innerHTML = error;
                            message.style.display = "block";
                        }
                    },

                });

                return false; // Prevent form submission if within a form
            }

            function openModal(taskId) {
                var modalId = "popup_task_to_do_" + taskId;
                document.getElementById(modalId).style.display = "block";
            }

            function hideModal(taskId) {
                var modalId = "popup_task_to_do_" + taskId;
                document.getElementById(modalId).style.display = "none";

            }

            function TaskEducation(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'task will be deleted!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonColor: '#FF5733', // Red color for "Yes"
                    cancelButtonColor: '#4CAF50', // Green color for "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send an AJAX request to delete the task
                        $.ajax({
                            url: '/del-task/' + id,
                            method: 'GET', // Use the DELETE HTTP method
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'deleted!',
                                    icon: 'success'
                                }).then(() => {
                                    location.reload(); // Refresh the page
                                });
                            },
                            error: function(xhr, status, error) {
                                // Handle errors, you can display an error message to the user
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while deleting task!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }

            $(document).ready(function() {
                $('#datatable-buttons').DataTable({
                    dom: "<'container-fluid'" +
                        "<'row'" +
                        "<'col-md-8'lB>" +
                        "<'col-md-4 text-right'f>" +
                        ">" +
                        "<'row dt-table'" +
                        "<'col-md-12'tr>" +
                        ">" +
                        "<'row'" +
                        "<'col-md-7'i>" +
                        "<'col-md-5 text-right'p>" +
                        ">" +
                        ">",
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    buttons: [
                        '', ''
                    ],

                });
            })

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

            function addTaskEmp(event) {
                event.preventDefault();
                var task_title = document.getElementById('task_title');
                var task_green = document.getElementById('task_green');
                var task_error = document.getElementById('task_error');
                var task_description = document.getElementById('task_description');

                if (task_title.value == "") {
                    task_error.innerHTML = "Task title required!";
                    task_error.style.display = "block";
                    return;
                } else {
                    task_error.style.display = "none";
                }

                if (task_description.value == "") {
                    task_error.innerHTML = "Task description required!";
                    task_error.style.display = "block";
                    return;
                } else {
                    task_error.style.display = "none";
                }

                var csrfToken = "{{ csrf_token() }}";

                var formData = {
                    _token: csrfToken,
                    task_title: task_title.value,
                    task_description: task_description.value
                };

                $.ajax({
                    url: '/create-task-by-emp', // The Laravel route
                    type: 'get', // POST request
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Add CSRF token to request headers
                    },
                    data: formData,
                    success: function(response) {
                        // Show success message
                        console.log(response);

                        if (task_error.style.display == "block") {
                            task_error.style.display == "none";
                        }

                        task_title.value = "";
                        task_description.value = "";

                        task_green.innerHTML = "Task created!";
                        task_green.style.display = "block";

                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400) {
                            if (task_green.style.display == "block") {
                                task_green.style.display == "none";
                            }
                            task_error.innerHTML = error;
                            task_error.style.display = "block";
                        }
                    },

                });

                return false; // Prevent form submission if within a form


            }

            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }

            function openModel(id) {
                var popupButton = 'popupButton' + id;
                var popup = 'popup_' + id;
                var closeBtn = '.closeBtn' + id;


                const popupButtonControl = document.getElementById(popupButton);
                const popupControl = document.getElementById(popup);
                const closeBtnControl = document.querySelector(closeBtn);


                popupControl.style.display = 'block';


                closeBtnControl.addEventListener('click', function() {
                    popupControl.style.display = 'none';
                });

                window.addEventListener('click', function(e) {
                    if (e.target === popupControl) {
                        popupControl.style.display = 'none';
                    }
                });
            }

            function taskUpdateEmp(id, status) {

                var task_status = "task_status_" + id;
                var task_report = "task_report_" + id;
                var success_message = "success_message_" + id;
                var error_message = "error_message_" + id;

                task_status = document.getElementById(task_status);
                task_report = document.getElementById(task_report);
                success_message = document.getElementById(success_message);
                error_message = document.getElementById(error_message);

                if (task_status.value == "") {
                    error_message.innerHTML = "Please select task status!";
                    error_message.style.display = "block";
                    return;
                } else {
                    error_message.style.display = "none";
                }

                var csrfToken = "{{ csrf_token() }}";

                var formData = {
                    id: id,
                    _token: csrfToken,
                    task_status: task_status.value,
                    task_report: task_report.value,
                    old_status: status
                };

                $.ajax({
                    url: '/update-task-status', // The Laravel route
                    type: 'get', // POST request
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Add CSRF token to request headers
                    },
                    data: formData,
                    success: function(response) {
                        // Show success message
                        console.log(response);

                        if (error_message.style.display == "block") {
                            error_message.style.display == "none";
                        }

                        task_status.value = "";
                        task_report.value = "";

                        success_message.innerHTML = "Task Updated!";
                        success_message.style.display = "block";

                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400) {
                            if (success_message.style.display == "block") {
                                success_message.style.display == "none";
                            }
                            error_message.innerHTML = error;
                            error_message.style.display = "block";
                        }
                    },

                });

                return false; // Prevent form submission if within a form



            }
        </script>
    @endsection
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Required datatable js -->
        <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>


        <script src="{{ URL::asset('build/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->

        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endsection
