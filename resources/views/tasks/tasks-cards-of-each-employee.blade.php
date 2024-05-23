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

            .is-dragging {
                scale: 1.05;
                box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
                background: #fca311;
                color: white;
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

            .task-card {
                border-bottom: 1px solid #e3e3e3;
                margin-top: 10px;
                padding: 5px 10px;
                box-shadow: 0 0px 10px 0 rgba(0, 0, 0, 0.3);
                border-radius: 10px;
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
                        @if (Auth()->user()->user_type == 'admin')
                            <a href="/view-tasks" class="position-absolute pt-2" style="top: 15px; left: 30px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                                    class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                                </svg>
                            </a>
                        @endif
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
                            <div class="d-flex flex-column align-items-center p-3 gap-2"  >
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
                                    $inProgressTasksCount = $tasks->where('task_status', 'in-progress')->count();
                                @endphp
                                <div class="card" style="box-shadow: 0px 0px 10px 10px #00000021;border-radius: 10px;">
                                    <p class="p-2 rounded-top text-white mb-0"
                                        style="font-size: 17px;background-color: #e6b400">In Progress</p>
                                    <div class="p-2 rounded-bottom bg-white swim-lane">
                                        @if ($inProgressTasksCount == 0)
                                            <div class="text-center d-flex align-items-center justify-content-center"
                                                style="height: 100px">
                                                <a class="mb-0 empTitle font-size-18" style="color: gray"
                                                    id="popupButton">Add a New Task</a>

                                            </div>
                                        @else
                                            @foreach ($tasks as $task)
                                                @if ($task->task_status == 'in-progress')
                                                    <div class="task-card" draggable="true">
                                                        <h5 class="empTitle mb-0" style="text-transform: capitalize">
                                                            @if (Auth()->user()->user_type == 'employee' || Auth()->user()->user_type == 'manager')
                                                                <a
                                                                    href="/task-update/{{ $task->id }}">{{ $task->task_title }}</a>
                                                            @else
                                                                {{ $task->task_title }}
                                                            @endif
                                                        </h5>
                                                        <p class="empSubTitle mb-0">
                                                            {{ $task->task_description }}</p>
                                                        <div class="progress mb-2" style="height: 15px;">
                                                            <div class="progress-bar progress-bar-animated bg-success"
                                                                role="progressbar" style="width: 80%;" aria-valuenow="100"
                                                                aria-valuemin="0" aria-valuemax="100">
                                                                {{ $task->task_percentage }}%
                                                                Complete</div>
                                                        </div>

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                        stroke-linejoin="round"></g>
                                                                    <g id="SVGRepo_iconCarrier">
                                                                        <circle opacity="0.5" cx="12" cy="12"
                                                                            r="10" stroke="#9e9e9e" stroke-width="1.5">
                                                                        </circle>
                                                                        <path d="M12 8V12L14.5 14.5" stroke="#9e9e9e"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                    </g>
                                                                </svg>
                                                                <p class="mb-0"style="font-size:15px; color:gray;">
                                                                    {{ $task->task_date }}</p>
                                                            </div>
                                                            <div
                                                                style="background-color: #ff000020;
                                                            border-radius: 10px;
                                                            padding: 1px 5px;
                                                            font-size: 11px;">
                                                                <p class="mb-0 text-danger">High</p>
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
                                    <p class="p-2 rounded-top text-white mb-0"
                                        style="font-size: 17px; background-color: red">Pending</p>
                                    <div class="p-2 rounded-bottom bg-white swim-lane" id="todo-lane">
                                        @if ($pendingTasksCount == 0)
                                            <div class="text-center d-flex align-items-center justify-content-center"
                                                style="height: 100px">
                                                <a class="mb-0 empTitle font-size-18" style="color: gray"
                                                    href="#">Add
                                                    a New Task</a>
                                            </div>
                                        @else
                                            @foreach ($tasks as $task)
                                                @if ($task->task_status == 'pending')
                                                    <div class="task task-card" draggable="true">
                                                        <h5 class="empTitle mb-0" style="text-transform: capitalize">
                                                            @if (Auth()->user()->user_type == 'employee' || Auth()->user()->user_type == 'manager')
                                                                <a
                                                                    href="/task-update/{{ $task->id }}">{{ $task->task_title }}</a>
                                                            @else
                                                                {{ $task->task_title }}
                                                            @endif
                                                        </h5>
                                                        <p class="empSubTitle mb-0">
                                                            {{ $task->task_description }}</p>

                                                        <div class="progress mb-2" style="height: 15px;">
                                                            <div class="progress-bar progress-bar-animated bg-success"
                                                                role="progressbar" style="width: 50%;"
                                                                aria-valuenow="100" aria-valuemin="0"
                                                                aria-valuemax="100">50%</div>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                        stroke-linejoin="round"></g>
                                                                    <g id="SVGRepo_iconCarrier">
                                                                        <circle opacity="0.5" cx="12"
                                                                            cy="12" r="10" stroke="#9e9e9e"
                                                                            stroke-width="1.5"></circle>
                                                                        <path d="M12 8V12L14.5 14.5" stroke="#9e9e9e"
                                                                            stroke-width="1.5" stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                    </g>
                                                                </svg>
                                                                <p class="mb-0"style="font-size:15px; color:gray;">
                                                                    {{ $task->task_date }}</p>
                                                            </div>
                                                            <div
                                                                style="background-color: #ff000020;
                                                            border-radius: 10px;
                                                            padding: 1px 5px;
                                                            font-size: 11px;">
                                                                <p class="mb-0 text-danger">High</p>
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
                                <div class="card" style="box-shadow: 0px 0px 10px 10px #00000021;border-radius: 10px;">
                                    @php
                                        $completedTasksCount = $tasks->where('task_status', 'completed')->count();
                                    @endphp
                                    <p class="p-2 rounded-top text-white mb-0"
                                        style="font-size: 17px; background-color: green">Completed</p>
                                    <div class="p-2 rounded-bottom bg-white swim-lane">
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
                                                    <div class="swim-lane">
                                                        <div class="task-card" draggable="true">
                                                            <h5 class="empTitle mb-0" style="text-transform: capitalize">
                                                                @if (Auth()->user()->user_type == 'employee' || Auth()->user()->user_type == 'manager')
                                                                    <a
                                                                        href="/task-update/{{ $task->id }}">{{ $task->task_title }}</a>
                                                                @else
                                                                    {{ $task->task_title }}
                                                                @endif
                                                            </h5>
                                                            <p class="empSubTitle mb-0">
                                                                {{ $task->task_description }}</p>

                                                            <div class="progress mb-2" style="height: 15px;">
                                                                <div class="progress-bar progress-bar-animated bg-success"
                                                                    role="progressbar" style="width: 90%;"
                                                                    aria-valuenow="100" aria-valuemin="0"
                                                                    aria-valuemax="100">
                                                                    {{ $task->task_percentage }}% Complete</div>
                                                            </div>

                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <svg width="20px" height="20px"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                        <g id="SVGRepo_tracerCarrier"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"></g>
                                                                        <g id="SVGRepo_iconCarrier">
                                                                            <circle opacity="0.5" cx="12"
                                                                                cy="12" r="10" stroke="#9e9e9e"
                                                                                stroke-width="1.5"></circle>
                                                                            <path d="M12 8V12L14.5 14.5" stroke="#9e9e9e"
                                                                                stroke-width="1.5" stroke-linecap="round"
                                                                                stroke-linejoin="round"></path>
                                                                        </g>
                                                                    </svg>
                                                                    <p class="mb-0"style="font-size:15px; color:gray;">
                                                                        {{ $task->task_date }}</p>
                                                                </div>
                                                                <div
                                                                    style="background-color: #ff000020;
                                                            border-radius: 10px;
                                                            padding: 1px 5px;
                                                            font-size: 11px;">
                                                                    <p class="mb-0 text-danger">High</p>
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
                    </div>
                    <div class="popup" id="popup">
                        <div class="popup-content flex-column">
                            <div class="d-flex mb-3 align-items-center justify-content-between">
                                <h2 class="mb-0"
                                    style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                    Assign a New Task</h2>
                                <span class="closeBtn p-2" style="border-radius: 50%; background-color:#14213d26"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="#14213d50" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                    </svg></span>
                            </div>
                            <form id="todo-form" method="post" action="/view-tasks-employees" class="text-start"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="d-flex flex-column">
                                            <label for="">Emp Name:</label>
                                            <div class="mb-0 d-flex form-control inputboxcolor "
                                                style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                <svg height="20px" width="20px" version="1.1" id="_x32_"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                    xml:space="preserve" fill="#9e9e9e" stroke="#9e9e9e">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <style type="text/css">
                                                            .st0 {
                                                                fill: #9e9e9e;
                                                            }
                                                        </style>
                                                        <g>
                                                            <path class="st0"
                                                                d="M256,265.308c73.252,0,132.644-59.391,132.644-132.654C388.644,59.412,329.252,0,256,0 c-73.262,0-132.643,59.412-132.643,132.654C123.357,205.917,182.738,265.308,256,265.308z">
                                                            </path>
                                                            <path class="st0"
                                                                d="M425.874,393.104c-5.922-35.474-36-84.509-57.552-107.465c-5.829-6.212-15.948-3.628-19.504-1.427 c-27.04,16.672-58.782,26.399-92.819,26.399c-34.036,0-65.778-9.727-92.818-26.399c-3.555-2.201-13.675-4.785-19.505,1.427 c-21.55,22.956-51.628,71.991-57.551,107.465C71.573,480.444,164.877,512,256,512C347.123,512,440.427,480.444,425.874,393.104z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <input type="text" value="{{ $emp_name }}" name="emp_name"
                                                    style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                    placeholder="Name of Emp">
                                            </div>
                                            @error('emp_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="d-flex flex-column">
                                            <label for="">Task Name:</label>
                                            <div class="mb-0 d-flex form-control inputboxcolor "
                                                style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M3 5.25C3 4.00736 4.00736 3 5.25 3H18.75C19.9926 3 21 4.00736 21 5.25V12.0218C20.5368 11.7253 20.0335 11.4858 19.5 11.3135V5.25C19.5 4.83579 19.1642 4.5 18.75 4.5H5.25C4.83579 4.5 4.5 4.83579 4.5 5.25V18.75C4.5 19.1642 4.83579 19.5 5.25 19.5H11.3135C11.4858 20.0335 11.7253 20.5368 12.0218 21H5.25C4.00736 21 3 19.9926 3 18.75V5.25Z"
                                                            fill="#9e9e9e"></path>
                                                        <path
                                                            d="M10.7803 7.71967C11.0732 8.01256 11.0732 8.48744 10.7803 8.78033L8.78033 10.7803C8.48744 11.0732 8.01256 11.0732 7.71967 10.7803L6.71967 9.78033C6.42678 9.48744 6.42678 9.01256 6.71967 8.71967C7.01256 8.42678 7.48744 8.42678 7.78033 8.71967L8.25 9.18934L9.71967 7.71967C10.0126 7.42678 10.4874 7.42678 10.7803 7.71967Z"
                                                            fill="#9e9e9e"></path>
                                                        <path
                                                            d="M10.7803 13.2197C11.0732 13.5126 11.0732 13.9874 10.7803 14.2803L8.78033 16.2803C8.48744 16.5732 8.01256 16.5732 7.71967 16.2803L6.71967 15.2803C6.42678 14.9874 6.42678 14.5126 6.71967 14.2197C7.01256 13.9268 7.48744 13.9268 7.78033 14.2197L8.25 14.6893L9.71967 13.2197C10.0126 12.9268 10.4874 12.9268 10.7803 13.2197Z"
                                                            fill="#9e9e9e"></path>
                                                        <path
                                                            d="M17.5 12C20.5376 12 23 14.4624 23 17.5C23 20.5376 20.5376 23 17.5 23C14.4624 23 12 20.5376 12 17.5C12 14.4624 14.4624 12 17.5 12ZM18.0011 20.5035L18.0006 18H20.503C20.7792 18 21.003 17.7762 21.003 17.5C21.003 17.2239 20.7792 17 20.503 17H18.0005L18 14.4993C18 14.2231 17.7761 13.9993 17.5 13.9993C17.2239 13.9993 17 14.2231 17 14.4993L17.0005 17H14.4961C14.22 17 13.9961 17.2239 13.9961 17.5C13.9961 17.7762 14.22 18 14.4961 18H17.0006L17.0011 20.5035C17.0011 20.7797 17.225 21.0035 17.5011 21.0035C17.7773 21.0035 18.0011 20.7797 18.0011 20.5035Z"
                                                            fill="#9e9e9e"></path>
                                                        <path
                                                            d="M13.25 8.5C12.8358 8.5 12.5 8.83579 12.5 9.25C12.5 9.66421 12.8358 10 13.25 10H16.75C17.1642 10 17.5 9.66421 17.5 9.25C17.5 8.83579 17.1642 8.5 16.75 8.5H13.25Z"
                                                            fill="#9e9e9e"></path>
                                                    </g>
                                                </svg>
                                                <input type="text" value="" name="first_task_title"
                                                    style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                    placeholder="Enter the Task Title">
                                            </div>
                                            @error('first_task_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="d-flex flex-column">
                                            <label for="">Assign Date:</label>
                                            <div class="mb-3 d-flex form-control inputboxcolor "
                                                style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                            stroke="#9e9e9e" stroke-width="2" stroke-linecap="round">
                                                        </path>
                                                        <rect x="6" y="12" width="3" height="3" rx="0.5"
                                                            fill="#9e9e9e"></rect>
                                                        <rect x="10.5" y="12" width="3" height="3"
                                                            rx="0.5" fill="#9e9e9e"></rect>
                                                        <rect x="15" y="12" width="3" height="3" rx="0.5"
                                                            fill="#9e9e9e"></rect>
                                                    </g>
                                                </svg>
                                                <input type="date" value="" name="first_assign_date"
                                                    style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                    placeholder="Enter the Task Title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="d-flex flex-column">
                                            <label for="">Due Date:</label>
                                            <div class="mb-0 d-flex form-control inputboxcolor "
                                                style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                            stroke="#9e9e9e" stroke-width="2" stroke-linecap="round">
                                                        </path>
                                                        <rect x="6" y="12" width="3" height="3" rx="0.5"
                                                            fill="#9e9e9e"></rect>
                                                        <rect x="10.5" y="12" width="3" height="3"
                                                            rx="0.5" fill="#9e9e9e"></rect>
                                                        <rect x="15" y="12" width="3" height="3" rx="0.5"
                                                            fill="#9e9e9e"></rect>
                                                    </g>
                                                </svg>
                                                <input type="date" value="{{ old('first_task_deadline') }}"
                                                    name="first_task_deadline"
                                                    style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                    placeholder="Enter the Task Title">
                                            </div>
                                            @error('first_task_deadline')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <div class="d-flex flex-column">
                                            <label for="">Task Description:</label>
                                            <div class="mb-0 d-flex form-control inputboxcolor "
                                                style="border: 1px solid #14213d; border-radius:20px;padding:10px; background-color: white;">
                                                <textarea name="first_task_description"
                                                    style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0; resize:none"
                                                    name="" id="" cols="30" rows="10"></textarea>
                                            </div>
                                            @error('first_task_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" class="px-4 py-2 reblateBtn">Submit</button>
                                </div>
                            </form>
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
        {{-- Drag and Drop ki Js --}}
        <script>
            const draggables = document.querySelectorAll(".task");
            const droppables = document.querySelectorAll(".swim-lane");

            draggables.forEach((task) => {
                task.addEventListener("dragstart", () => {
                    task.classList.add("is-dragging");
                });
                task.addEventListener("dragend", () => {
                    task.classList.remove("is-dragging");
                });
            });

            droppables.forEach((zone) => {
                zone.addEventListener("dragover", (e) => {
                    e.preventDefault();

                    const bottomTask = insertAboveTask(zone, e.clientY);
                    const curTask = document.querySelector(".is-dragging");

                    if (!bottomTask) {
                        zone.appendChild(curTask);
                    } else {
                        zone.insertBefore(curTask, bottomTask);
                    }
                });
            });

            const insertAboveTask = (zone, mouseY) => {
                const els = zone.querySelectorAll(".task:not(.is-dragging)");

                let closestTask = null;
                let closestOffset = Number.NEGATIVE_INFINITY;

                els.forEach((task) => {
                    const {
                        top
                    } = task.getBoundingClientRect();

                    const offset = mouseY - top;

                    if (offset < 0 && offset > closestOffset) {
                        closestOffset = offset;
                        closestTask = task;
                    }
                });

                return closestTask;
            };
        </script>
        {{-- To Do list bnay ki JS --}}
        <script>
            const form = document.getElementById("todo-form");
            const input = document.getElementById("todo-input");
            const todoLane = document.getElementById("todo-lane");

            form.addEventListener("submit", (e) => {
                e.preventDefault();
                const value = input.value;

                if (!value) return;

                const newTask = document.createElement("p");
                newTask.classList.add("task");
                newTask.setAttribute("draggable", "true");
                newTask.innerText = value;

                newTask.addEventListener("dragstart", () => {
                    newTask.classList.add("is-dragging");
                });

                newTask.addEventListener("dragend", () => {
                    newTask.classList.remove("is-dragging");
                });

                todoLane.appendChild(newTask);

                input.value = "";
            });
        </script>
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const popupButton = document.getElementById('popupButton');
                const popup = document.getElementById('popup');
                const closeBtn = document.querySelector('.closeBtn');

                popupButton.addEventListener('click', function() {
                    popup.style.display = 'block';
                });

                closeBtn.addEventListener('click', function() {
                    popup.style.display = 'none';
                });

                window.addEventListener('click', function(e) {
                    if (e.target === popup) {
                        popup.style.display = 'none';
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });

            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }
            // Select the button and the container where inputs will be added
            const addInputButton = document.getElementById('addInputButton');
            const inputContainer = document.getElementById('inputContainer');

            // Function to create a task row
            function createTaskRow() {
                // Create a new row for task title and deadline
                const titleDateRow = document.createElement('div');
                titleDateRow.classList.add('row', 'mb-3', 'mt-2');

                // Create first column for task title
                const titleCol = document.createElement('div');
                titleCol.classList.add('col-md-6');

                // Create a new input element for task title
                const titleInput = document.createElement('div');
                titleInput.classList.add('task-input', 'form-floating');
                const titleInputElement = document.createElement('input');
                titleInputElement.type = 'text';
                titleInputElement.name = 'task_title[]'; // Assuming you want this input to be part of an array
                titleInputElement.classList.add('form-control');
                titleInputElement.placeholder = 'Enter task title';
                const titleLabelElement = document.createElement('label');
                titleLabelElement.textContent = 'Task Title';

                // Append input and label to the div
                titleInput.appendChild(titleInputElement);
                titleInput.appendChild(titleLabelElement);

                // Append task title input to the column
                titleCol.appendChild(titleInput);

                // Append first column to the row for task title and deadline
                titleDateRow.appendChild(titleCol);

                // Create second column for deadline date
                const deadlineCol = document.createElement('div');
                deadlineCol.classList.add('col-md-6');

                // Create a new input element for deadline date
                const deadlineInput = document.createElement('div');
                deadlineInput.classList.add('task-input', 'form-floating');
                const deadlineInputElement = document.createElement('input');
                deadlineInputElement.type = 'date';
                deadlineInputElement.name = 'task_deadline[]'; // Assuming you want this input to be part of an array
                deadlineInputElement.classList.add('form-control');
                deadlineInputElement.placeholder = 'Enter deadline date';
                const deadlineLabelElement = document.createElement('label');
                deadlineLabelElement.textContent = 'Deadline Date';

                // Append input and label to the div
                deadlineInput.appendChild(deadlineInputElement);
                deadlineInput.appendChild(deadlineLabelElement);

                // Append deadline date input to the column
                deadlineCol.appendChild(deadlineInput);

                // Append second column to the row for task title and deadline
                titleDateRow.appendChild(deadlineCol);

                // Append row for task title and deadline to the container
                inputContainer.appendChild(titleDateRow);

                // Create a new row for task description
                const descRow = document.createElement('div');
                descRow.classList.add('row', 'mb-3');

                // Create column for task description
                const descCol = document.createElement('div');
                descCol.classList.add('col-md-12');

                // Create a new input element for task description
                const descInput = document.createElement('div');
                descInput.classList.add('task-input', 'form-floating');
                const descInputElement = document.createElement('textarea');
                descInputElement.name = 'task_description[]'; // Assuming you want this input to be part of an array
                descInputElement.classList.add('form-control');
                descInputElement.placeholder = 'Enter task description';
                const descLabelElement = document.createElement('label');
                descLabelElement.textContent = 'Task Description';

                // Append input and label to the div
                descInput.appendChild(descInputElement);
                descInput.appendChild(descLabelElement);

                // Append task description input to the column
                descCol.appendChild(descInput);

                // Append column for task description to the row
                descRow.appendChild(descCol);

                // Append row for task description to the container
                inputContainer.appendChild(descRow);

                // Create a remove button
                const removeButtonCol = document.createElement('div');
                removeButtonCol.classList.add('col-md-12', 'text-center', 'mt-3');
                const removeButton = document.createElement('button');
                removeButton.type = 'button';
                removeButton.textContent = 'Remove Task';
                removeButton.classList.add('btn', 'btn-danger');
                removeButton.addEventListener('click', function() {
                    // Remove the task row
                    titleDateRow.remove();
                    descRow.remove();
                    removeButtonCol.remove();
                });
                removeButtonCol.appendChild(removeButton);

                // Append remove button column to the container
                inputContainer.appendChild(removeButtonCol);
            }

            // Add event listener to the button
            addInputButton.addEventListener('click', function() {
                // Create a new task row
                createTaskRow();
            });

            // Check if there are tasks stored in localStorage
            window.addEventListener('load', function() {
                const storedTasks = JSON.parse(localStorage.getItem('tasks'));
                if (storedTasks) {
                    storedTasks.forEach(task => {
                        // Create a task row
                        createTaskRow();
                        // Set the values of inputs
                        const taskInputs = inputContainer.querySelectorAll(
                            'input[name="task_title[]"], input[name="task_deadline[]"], textarea[name="task_description[]"]'
                        );
                        taskInputs.forEach((input, index) => {
                            input.value = task[index];
                        });
                    });
                }
            });

            // Save added tasks in localStorage before page refresh or close
            window.addEventListener('beforeunload', function() {
                const taskRows = inputContainer.querySelectorAll('.row.mb-3.mt-2');
                const tasks = [];
                taskRows.forEach(row => {
                    const titleInput = row.querySelector('input[name="task_title[]"]');
                    const deadlineInput = row.querySelector('input[name="task_deadline[]"]');
                    const descInput = row.nextElementSibling.querySelector(
                        'textarea[name="task_description[]"]');
                    if (titleInput && deadlineInput && descInput) {
                        tasks.push([titleInput.value, deadlineInput.value, descInput.value]);
                    }
                });
                localStorage.setItem('tasks', JSON.stringify(tasks));
            });
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
