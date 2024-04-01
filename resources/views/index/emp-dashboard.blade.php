@extends('layouts.master')
@section('title')
    Employee Dashboard
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Employee Dashboard
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <style>
            .welcome-box {
                background-color: #ffffff;
                border-bottom: 1px solid #ededed;
                position: relative;
                margin: -30px -30px 30px;
                padding: 20px;
            }




            .time-list .dash-stats-list {
                flex-flow: column wrap;
                flex-grow: 1;
                padding: 0 15px;
            }

            .time-list .dash-stats-list h4 {
                color: #1f1f1f;
                font-size: 21px;
                font-weight: 700;
                line-height: 1.5;
                margin-bottom: 0;
            }

            .time-list .dash-stats-list p {
                color: #777;
                font-size: 13px;
                font-weight: 600;
                line-height: 1.5;
                margin-bottom: 0;
                text-transform: uppercase;
            }

            ul li {
                list-style: none;
            }

            .timesheet-right {
                color: #8E8E8E;
                font-size: 13px;
                float: right;
                margin-top: 7px;

            }


            .punch-info .punch-hours {
                border: 5px solid #fca311;
                font-size: 18px;
                height: 120px;
                width: 120px;
                margin: 0 auto;
                border-radius: 50%;
                position: relative;
            }

            .punch-hours span {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 14px;
            }

            .view-class-more {

                font-size: 16px;
                text-align: center;
                display: block;
                /* margin: 0px; */
                margin-top: 17px;

            }

            .timeliner {
                border-left: 3px solid #14213d;
                border-bottom-right-radius: 4px;
                border-top-right-radius: 4px;
                background: rgba(114, 124, 245, 0.09);
                margin: 0 auto;
                letter-spacing: 0.2px;
                position: relative;
                line-height: 1.4em;
                font-size: 1.03em;
                padding: 20px;
                padding-bottom: 12px;
                list-style: none;
                text-align: left;

            }

            @media (max-width: 767px) {
                .timeliner {
                    max-width: 98%;
                    padding: 25px;
                }
            }

            .timeliner h1 {
                font-weight: 300;
                font-size: 1.4em;
            }

            .timeliner h2,
            .timeliner h3 {
                font-weight: 600;
                font-size: 1rem;
                margin-bottom: 10px;
            }

            .timeliner .event {
                border-bottom: 1px dashed #e8ebf1;
                position: relative;
            }

            @media (max-width: 767px) {
                .timeliner .event {
                    padding-top: 30px;
                }
            }

            .timeliner .event:last-of-type {
                padding-bottom: 0;
                margin-bottom: 0;
                border: none;
            }

            .timeliner .event:before,
            .timeliner .event:after {
                position: absolute;
                display: block;
                top: 0;
            }

            .timeliner .event:before {
                left: -207px;
                content: attr(data-date);
                text-align: right;
                font-weight: 100;
                font-size: 0.9em;
                min-width: 120px;
            }

            @media (max-width: 767px) {
                .timeliner .event:before {
                    left: 0px;
                    text-align: left;
                }
            }

            .timeliner .event:after {
                -webkit-box-shadow: 0 0 0 3px #fca311;
                box-shadow: 0 0 0 3px #fca311;
                left: -26.6px;
                background: #fff;
                border-radius: 50%;
                height: 9px;
                width: 9px;
                content: "";
                top: 5px;
            }

            @media (max-width: 767px) {
                .timeliner .event:after {
                    left: -31.8px;
                }
            }

            .rtl .timeliner {
                text-align: right;
                border-bottom-right-radius: 0;
                border-top-right-radius: 0;
                border-bottom-left-radius: 4px;
                border-top-left-radius: 4px;
                border-right: 3px solid #727cf5;
            }

            .rtl .timeliner .event::before {
                left: 0;
                right: -170px;
            }

            .rtl .timeliner .event::after {
                left: 0;
                right: -55.8px;
            }


            /* CSS for styling the chart container */
            #line_chart {
                width: 100%;
                height: 400px;
            }
        </style>

        <div class="row mt-2">
            <div class="card">
                <div class="card-body d-flex justify-content-lg-between align-items-center">
                    <div class="col-md-3 d-flex align-items-center">

                        @if (isset($emp_det->Emp_Image) && $emp_det->Emp_Image != '')
                            <img src="{{ $emp_det->Emp_Image }}"
                                style="width:120px;height:120px;border-radius:100%; object-fit:cover;" alt="">
                        @else
                            <img src="{{ url('user.png') }}"
                                style="width:120px;height:120px;border-radius:100%; object-fit:cover;" alt="">
                        @endif
                        <div class="welcome-det ms-3 text-dark fw-bolder">
                            <h3 style="font-size: 20px; color:#14213d">Welcome, </h3>
                            <span class="fw-bolder"
                                style="font-size: 20px; color:#fca311;">{{ isset($emp_det->Emp_Full_Name) && $emp_det->Emp_Full_Name ? $emp_det->Emp_Full_Name : 'Guest' }}</span>
                        </div>

                    </div>

                    <div class="">
                        <h3 style="font-size: 20px; color:#14213d">Designation:</h3>
                        <span class="fw-semibold "
                            style="color:#fca311; font-size: 20px;">{{ isset($emp_det->Emp_Designation) && $emp_det->Emp_Designation ? $emp_det->Emp_Designation : '' }}</span>
                    </div>
                    <div class="">
                        <h3 style="font-size: 20px; color:#14213d">Shift:</h3>
                        <span class="fw-semibold" style="color:#fca311; font-size: 20px;">
                            {{ isset($emp_det->Emp_Shift_Time) && $emp_det->Emp_Shift_Time ? $emp_det->Emp_Shift_Time : '' }}
                        </span>

                    </div>
                    <div>
                        <h3 style="font-size: 20px; color:#14213d">Today's Date</h3>
                        <span class="fw-bold" style="color:#fca311; font-size: 15px;">
                            {{ isset($t_date) ? $t_date : '' }}
                        </span>

                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4 col-xl-4 col-sm-12">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:30px; color:#14213d"
                                        viewBox="0 0 48 48">
                                        <g fill="none" stroke="#14213d" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="4">
                                            <path d="M42 20v19a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3V9a3 3 0 0 1 3-3h21" />
                                            <path d="m16 20l10 8L41 7" />
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-4 d-flex align-items-center gap-3">
                                <h3 class="fs-4 font-size-18 mb-0" style="color:#14213d;">Total Present </h3>
                                <p class="font-size-15 mb-0 flex-grow-1">
                                    @if (isset($total_present_day) && $total_present_day != '')
                                        {{ $total_present_day }}
                                    @else
                                        0
                                    @endif
                                </p>

                            </div>

                        </div>
                        <div class="d-flex align-items-center mt-4 position-relative" style="z-index: 10;">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:30px; color:#14213d"
                                        viewBox="0 0 48 48">
                                        <defs>
                                            <mask id="ipTWrongUser0">
                                                <g fill="none" stroke="#fff" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="4">
                                                    <circle cx="24" cy="12" r="8" fill="#555" />
                                                    <path
                                                        d="M42 44c0-9.941-8.059-18-18-18S6 34.059 6 44m14-8l8 8m0-8l-8 8" />
                                                </g>
                                            </mask>
                                        </defs>
                                        <path fill="#14213d" d="M0 0h48v48H0z" mask="url(#ipTWrongUser0)" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-4 d-flex align-items-center gap-3">
                                <h3 class="fs-4 font-size-18 mb-0" style="color:#14213d;">Total Absent </h3>
                                <p class="font-size-15 mb-0 flex-grow-1">
                                    @if (isset($absent_days) && $absent_days != '')
                                        {{ $absent_days }}
                                    @else
                                        0
                                    @endif
                                </p>

                            </div>

                        </div>
                        <div class="d-flex align-items-center mt-4 position-relative" style="z-index: 10;">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:30px; color:#14213d"
                                        viewBox="0 0 1024 1024">
                                        <path fill="#14213d"
                                            d="m960 95.888l-256.224.001V32.113c0-17.68-14.32-32-32-32s-32 14.32-32 32v63.76h-256v-63.76c0-17.68-14.32-32-32-32s-32 14.32-32 32v63.76H64c-35.344 0-64 28.656-64 64v800c0 35.343 28.656 64 64 64h896c35.344 0 64-28.657 64-64v-800c0-35.329-28.656-63.985-64-63.985m0 863.985H64v-800h255.776v32.24c0 17.679 14.32 32 32 32s32-14.321 32-32v-32.224h256v32.24c0 17.68 14.32 32 32 32s32-14.32 32-32v-32.24H960zM736 511.888h64c17.664 0 32-14.336 32-32v-64c0-17.664-14.336-32-32-32h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32m0 255.984h64c17.664 0 32-14.32 32-32v-64c0-17.664-14.336-32-32-32h-64c-17.664 0-32 14.336-32 32v64c0 17.696 14.336 32 32 32m-192-128h-64c-17.664 0-32 14.336-32 32v64c0 17.68 14.336 32 32 32h64c17.664 0 32-14.32 32-32v-64c0-17.648-14.336-32-32-32m0-255.984h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32h64c17.664 0 32-14.336 32-32v-64c0-17.68-14.336-32-32-32m-256 0h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32h64c17.664 0 32-14.336 32-32v-64c0-17.68-14.336-32-32-32m0 255.984h-64c-17.664 0-32 14.336-32 32v64c0 17.68 14.336 32 32 32h64c17.664 0 32-14.32 32-32v-64c0-17.648-14.336-32-32-32" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-4 d-flex align-items-center gap-3">
                                <h3 class="fs-4 font-size-18 mb-0" style="color:#14213d;">Total Leaves</h3>
                                <p class="font-size-15 mb-0 flex-grow-1">0</p>

                                <p style="position: absolute;bottom: 5px; color:gray; font-size: 12px; margin-bottom: 0;">
                                    Total Allowed leaves are 15 per year</p>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="container d-flex justify-content-between">
                    <button type="button" class="reblateBtn px-3 py-2" data-toggle="modal"
                        data-target="#exampleModal">Apply for Leave</button>
                    <a href="/leave-records" class="reblateBtn px-3 py-2">Leave Records</a>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header pb-0">
                                <h5 class="modal-title" id="exampleModalLabel">Leave Application form</h5>
                                <button type="button" class="close"
                                    style="border: none; background-color: transparent;" data-dismiss="modal"
                                    aria-label="Close">
                                    <span class="fs-3" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="leaveForm" action="">
                                    <div id="messageBox"></div>
                                    <div class="form-group mt-3">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control inputboxcolor" style="border: none;"
                                            id="date" name="date">
                                        <span class="text-danger" id="dateBox" style="display: none">Please Select
                                            a date!</span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="reason">Reason:</label>
                                        <textarea class="form-control inputboxcolor" style="border: none; resize: none; height: 100px;" id="reason"
                                            name="reason" placeholder="Reason:" rows="5"></textarea>
                                        <span class="text-danger" id="reasonBox" style="display: none">Please Write a
                                            reason!</span>
                                    </div>

                                </form>
                                <button type="submit" class="reblateBtn px-3 py-2 mt-3"
                                    onclick="submitForm(event)">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4 col-xl-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Today Activity</h6>
                        <div id="content">
                            <ul class="timeliner">
                                <li class="event mb-1">
                                    <h3 class="fs-4 font-size-18 mb-0" style="color: #14213d">Check In</h3>
                                    @if (session()->has('check_in_time') && session('check_in_time') != '')
                                        <p>{{ session('check_in_time') }}</p>
                                    @else
                                        <p>No Check In</p>
                                    @endif
                                </li>
                                <li class="event mb-1">
                                    <h3 class="fs-4 font-size-18 mb-0" style="color: #14213d">Break Start Time</h3>
                                    @if (session()->has('break_start_time') && session('break_start_time') != '')
                                        <p>{{ session('break_start_time') }}</p>
                                    @else
                                        <p>No Break Start</p>
                                    @endif
                                </li>
                                <li class="event mb-1">
                                    <h3 class="fs-4 font-size-18 mb-0" style="color: #14213d">Break End Time</h3>
                                    @if (session()->has('break_end_time') && session('break_end_time') != '')
                                        <p>{{ session('break_end_time') }}</p>
                                    @else
                                        <p>No Break End Time</p>
                                    @endif
                                </li>
                                <li class="event mb-1">
                                    <h3 class="fs-4 font-size-18 mb-0" style="color: #14213d">Check Out</h3>
                                    @if (session()->has('check_out_time') && session('check_out_time') != '')
                                        <p>{{ session('check_out_time') }}</p>
                                    @else
                                        <p>No Checkout</p>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4 col-xl-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class=" font-size-header mb-0">Timesheet </h3>
                            <div id="timer" class="text-center timer">00:00:00</div>
                        </div>
                        {{-- show check in time if it is done  --}}
                        {{-- @if (session()->has('check_in_time') && session('check_in_time') != '')
                            <h3 class="check_in_time">Check In Time: {{ session('check_in_time') }}</h3>
                        @endif --}}
                        <div class="punch-info">
                            <div class="punch-hours">
                                @if (session()->has('total_hours') && session('total_hours') != '')
                                    <span style="float: right;">{{ session('total_hours') }}</span>
                                @else
                                    <span>0 hrs</span>
                                @endif


                            </div>
                        </div>

                        @if (isset($day_message) && $day_message != '')
                            <span class="text-center text-danger">{{ $day_message }}</span>
                        @endif
                        @if (isset($check_in_already_message) && $check_in_already_message != '')
                            <span class="font-text text-danger">{{ $check_in_already_message }}</span>
                        @endif
                        @if (isset($success_message) && $success_message != '')
                            <span class="text-center green-text">{{ $success_message }}</span>
                        @endif

                        <div class="break-time d-flex align-items-center justify-content-between my-3">
                            <p class="mb-0 font-size-15">Target Working Hours</p>
                            <p class="mb-0 font-size-15">7:00 / Day</p>
                        </div>
                        @if (session()->has('attendence_status') && session('attendence_status') === true)
                            <span style="color:#3e7213;font-size:16px;"> <svg xmlns="http://www.w3.org/2000/svg"
                                    width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="#3e7213"
                                        d="M.41 13.41L6 19l1.41-1.42L1.83 12m20.41-6.42L11.66 16.17L7.5 12l-1.43 1.41L11.66 19l12-12M18 7l-1.41-1.42l-6.35 6.35l1.42 1.41z" />
                                </svg> Attendence Marked Successfully!</span>
                        @else
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    @if (session()->has('show_check_out') && session('show_check_out') === true)
                                        <a class="reblateBtn px-4 py-2" href="/check-out/" style="width:100%;">Check Out
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em"
                                                viewBox="0 0 16 16">
                                                <g fill="currentColor" fill-rule="evenodd">
                                                    <path
                                                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                                    <path
                                                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                                </g>
                                            </svg>
                                        </a>
                                    @else
                                        <a class="reblateBtn px-4 py-2" href="/check-in" style="width:100%;">Check In
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em"
                                                viewBox="0 0 21 21">
                                                <g fill="none" fill-rule="evenodd" stroke="currentColor"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="m11.5 13.535l-3-3.035l3-3m7 3h-10" />
                                                    <path
                                                        d="M16.5 8.5V5.54a2 2 0 0 0-1.992-2l-8-.032A2 2 0 0 0 4.5 5.5v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-3" />
                                                </g>
                                            </svg>
                                        </a>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    @if (session()->has('show_break_end') && session('show_break_end') === true)
                                        <a class="reblateBtn px-4 py-2" href="/break-end" style="width:100%;">Break End
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em"
                                                viewBox="0 0 16 16">
                                                <g fill="currentColor" fill-rule="evenodd">
                                                    <path
                                                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                                    <path
                                                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                                </g>
                                            </svg>
                                        </a>
                                    @else
                                        <a class="reblateBtn px-4 py-2" href="/break-start"
                                            style="width:100%;">BreakStart
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em"
                                                viewBox="0 0 16 16">
                                                <g fill="currentColor" fill-rule="evenodd">
                                                    <path
                                                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                                    <path
                                                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                                </g>
                                            </svg>
                                        </a>
                                    @endif
                                </div>

                            </div>
                        @endif
                        <div class="view-class-more">
                            <a href="/view-attendence" style="color:#fca311;">View Attendence</a>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <!-- END ROW -->
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <canvas id="bar_chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <canvas id="chartDiv"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- END ROW -->
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title mb-0 flex-grow-1">Tasks</h4>

                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr style="border-bottom: 1px solid #e3e3e3;">

                                        <th>Task Title</th>
                                        <th>Task Date</th>
                                        {{-- <th>Tasks</th> --}}
                                        <th>Task Status</th>
                                        <th>Assigned By</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                    @if (!count($latest_tasks))
                                        @foreach ($latest_tasks as $task)
                                                <td>{{ $task->task_title }}</td>
                                                <td>{{ $task->task_date }}</td>
                                                <td>{{ $task->task_status }}</td>
                                                <td>{{ $task->assigned_by }}%</td>
                                                {{-- <td>{{$task->task_title}}</td> --}}

                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="4" class="text-center" style="height: 175px"><h3 >No Task Assigned</h3></td>
                                    </tr>
                                    @endif
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="text-center pt-3">
                            <a href="/view-emp-tasks-each" class="w-md">View All</a>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex " style="background-color: #e3e3e3">
                        <h4 class="card-title mb-0 flex-grow-1">Task Report</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive simplebar-scrollable-y simplebar-scrollable-x" data-simplebar="init"
                            style="max-height: 220px;">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content" style="height: auto; overflow: scroll;">
                                            <div class="simplebar-content" style="padding: 0px;">
                                                <table
                                                    class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                    <tbody>
                                                        <tr style="border-bottom: 1px solid #e3e3e3;">

                                                            <th>Project Name</th>
                                                            <th>Description</th>
                                                            <th>Deadline</th>
                                                            <th>Assigned By</th>
                                                            <th>See Details</th>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task1</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task2</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task3</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task4</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task5</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task6</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task7</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>






                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 440px; height: 469px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="width: 395px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 273px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>
                        <div class="text-center pt-3">
                            <a href="#" class=" w-md">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex " style="background-color: #e3e3e3">
                        <h4 class="card-title mb-0 flex-grow-1">Projects</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive simplebar-scrollable-y simplebar-scrollable-x" data-simplebar="init"
                            style="max-height: 220px;">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content" style="height: auto; overflow: scroll;">
                                            <div class="simplebar-content" style="padding: 0px;">
                                                <table
                                                    class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                    <tbody>
                                                        <tr style="border-bottom: 1px solid #e3e3e3;">

                                                            <th>Project Name</th>
                                                            <th>Description</th>
                                                            <th>Deadline</th>
                                                            <th>Assigned By</th>
                                                            <th>See Details</th>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task1</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task2</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task3</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task4</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task5</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task6</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task7</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 440px; height: 469px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="width: 395px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 273px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>
                        <div class="text-center pt-3">
                            <a href="#" class=" w-md">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex " style="background-color: #e3e3e3">
                        <h4 class="card-title mb-0 flex-grow-1">Projects Report</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive simplebar-scrollable-y simplebar-scrollable-x" data-simplebar="init"
                            style="max-height: 220px;">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content" style="height: auto; overflow: scroll;">
                                            <div class="simplebar-content" style="padding: 0px;">
                                                <table
                                                    class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                    <tbody>
                                                        <tr style="border-bottom: 1px solid #e3e3e3;">

                                                            <th>Project Name</th>
                                                            <th>Description</th>
                                                            <th>Deadline</th>
                                                            <th>Assigned By</th>
                                                            <th>See Details</th>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task1</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task2</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task3</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task4</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task5</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task6</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task7</h6>
                                                            </td>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Deadline</span>
                                                            </td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>






                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 440px; height: 469px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="width: 395px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 273px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>
                        <div class="text-center pt-3">
                            <a href="#" class=" w-md">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-xl-12">
                <div class="card">
                            <div class="col-md-2" style="display: flex;align-items:center">
                                <h6>See Who is Present Today</h6>
                            </div>
                            <div class="col-md-10">
                                <img src="{{ url('user.png') }}"
                                    class="img-fluid mr-2 header-profile-user rounded-circle" alt="">
                                <img src="{{ url('user.png') }}"
                                    class="img-fluid mr-2 header-profile-user rounded-circle" alt="">
                                <img src="{{ url('user.png') }}"
                                    class="img-fluid mr-2 header-profile-user rounded-circle" alt="">
                                <img src="{{ url('user.png') }}"
                                    class="img-fluid mr-2 header-profile-user rounded-circle" alt="">
                                <img src="{{ url('user.png') }}"
                                    class="img-fluid mr-2 header-profile-user rounded-circle" alt="">
                                <img src="{{ url('user.png') }}"
                                    class="img-fluid mr-2 header-profile-user rounded-circle" alt="">
                                <img src="{{ url('user.png') }}"
                                    class="img-fluid mr-2 header-profile-user rounded-circle" alt="">
                                <img src="{{ url('user.png') }}"
                                    class="img-fluid mr-2 header-profile-user rounded-circle" alt="">
                                <img src="{{ url('user.png') }}"
                                    class="img-fluid mr-2 header-profile-user rounded-circle" alt="">
                                <img src="{{ url('user.png') }}"
                                    class="img-fluid mr-2 header-profile-user rounded-circle" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- END ROW -->


        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript">
            const chartDiv = document.getElementById('chartDiv');

            new Chart(chartDiv, {
                type: 'bar',
                data: {
                    labels: ['Presents', 'Absents', 'Leaves'],
                    datasets: [{
                        label: 'Attendance',
                        data: [<?php echo $total_present_day ?>, <?php echo $absent_days ?>, 3],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(255, 205, 86, 0.5)',

                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'x',
                }
            });
            const chartId2 = document.getElementById('bar_chart');

            new Chart(chartId2, {
                type: 'bar',
                data: {
                    // labels: ['Completed', 'Pending', 'In Progress'],

                    // datasets: [{
                    //     label: 'Completed',
                    //     borderColor: 'rgba(75, 192, 192, 0.9)',
                    //     backgroundColor: 'rgba(75, 192, 192, 0.5)', // Remove background color
                    //     data: [12]
                    // }, {
                    //     label: 'In Progress',
                    //     borderColor: 'rgba(255, 99, 132, 0.9)',
                    //     backgroundColor: 'rgba(255, 99, 132, 0.5)', // Remove background color
                    //     data: []
                    // }, {
                    //     label: 'Profit',
                    //     borderColor: 'green',
                    //     backgroundColor: 'rgba(0, 0, 0, 0)', // Remove background color
                    //     data: [200, 600, 1000, 700, 1300, 900]
                    // }]
                    labels: ['Completed', 'Pending', 'In Progress'],

                    datasets: [{
                        label: 'Tasks',
                        data: [<?php echo $completed_count; ?>, <?php echo $pending_count ?>, <?php echo $in_progress_count; ?>],
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.5)',
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(255, 205, 86, 0.5)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                }
            });

            // google.charts.load('current', {
            //     'packages': ['corechart']
            // });
            // google.charts.setOnLoadCallback(drawChart);

            // function drawChart() {
            //     var data = new google.visualization.DataTable();
            //     data.addColumn('string', 'Task');
            //     data.addColumn('number', 'Count');
            //     data.addRows([
            //         ['Completed', <?php echo $completed_count; ?>],
            //         ['Pending', <?php echo $pending_count; ?>],
            //         ['In Progress', <?php echo $in_progress_count; ?>]
            //     ]);

            //     var options = {
            //         title: 'Tasks Status for Current Month',
            //         legend: {
            //             position: 'none'
            //         },
            //         bars: 'horizontal',
            //         colors: ['#008000', '#FF0000',
            //             '#FFFF00'] // Green for completed, Red for pending, Yellow for in-progress
            //     };

            //     var chart = new google.visualization.BarChart(document.getElementById('bar_chart'));

            //     chart.draw(data, options);
            // }

            // google.charts.load('current', {
            //     packages: ['corechart', 'bar']
            // });
            // google.charts.setOnLoadCallback(drawChartBar);

            // function drawChartBar() {
            //     var data = google.visualization.arrayToDataTable([
            //         ['Category', 'Count'],
            //         ['Present', <?php echo $total_present_day; ?>],
            //         ['Absent', <?php echo $absent_days; ?>],
            //         ['Leaves', <?php echo $total_leaves; ?>]
            //     ]);

            //     var options = {
            //         title: 'Attendance for Current Month',
            //         legend: {
            //             position: 'none'
            //         },
            //         bars: 'vertical',
            //         vAxis: {
            //             format: 'decimal'
            //         }
            //     };

            //     var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            //     chart.draw(data, options);
            // }
        </script>


        <script>
            // Function to update the current time
            function updateCurrentTime() {
                const now = new Date();
                let hours = now.getHours();
                const ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // 0 should be displayed as 12
                const minutes = pad(now.getMinutes());
                const seconds = pad(now.getSeconds());
                document.getElementById('timer').innerText = hours + ":" + minutes + ":" + seconds +
                    " " + ampm;
            }

            // Function to pad single digit numbers with leading zeros
            function pad(num) {
                return (num < 10) ? '0' + num : num;
            }

            // Update current time immediately when the page loads
            updateCurrentTime();

            // Update current time every second
            setInterval(updateCurrentTime, 1000);

            function submitForm(event) {
                event.preventDefault();

                var dateValue = document.getElementById('date').value;
                var reasonValue = document.getElementById('reason').value;
                var dateBox = document.getElementById('dateBox');
                var reasonBox = document.getElementById('reasonBox');
                var messageBox = document.getElementById('messageBox');

                dateBox.style.display = "none";
                reasonBox.style.display = "none"; // Corrected line

                if (dateValue === '') {
                    dateBox.style.display = "block";
                    return;
                }
                if (reasonValue === '') {
                    reasonBox.style.display = "block";
                    return;
                }

                var formData = {
                    _token: '{{ csrf_token() }}',
                    date: dateValue,
                    reason: reasonValue
                };

                $.ajax({
                    type: 'POST',
                    url: '/apply-for-leave',
                    data: formData,
                    success: function(response) {
                        // console.log('AJAX request successful');

                        $('#messageBox').text(response.message);
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message :
                            'An error occurred';

                        $('#messageBox').text(errorMessage); // Set the error message from the server response
                    }
                });
            }
        </script>
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        {{-- <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script> --}}

        <!-- Vector map-->
        {{-- <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script> --}}
        {{-- <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script> --}}

        <script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @endsection
