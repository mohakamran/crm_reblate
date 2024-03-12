@extends('layouts.master')
@section('title')
    Manager Dashboard
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
Manager Dashboard
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

            .timer {
                font-size: 22px;
                background: #eee;
                border-radius: 32px;
                padding: 8px;
                margin: 16px 0px;
            }

            .punch-info .punch-hours {
                background-color: #f9f9f9;
                border: 5px solid #e3e3e3;
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
                text-decoration: underline;
            }

            .timeliner {
                border-left: 3px solid #727cf5;
                border-bottom-right-radius: 4px;
                border-top-right-radius: 4px;
                background: rgba(114, 124, 245, 0.09);
                margin: 0 auto;
                letter-spacing: 0.2px;
                position: relative;
                line-height: 1.4em;
                font-size: 1.03em;
                padding: 50px;
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
                padding-bottom: 25px;
                margin-bottom: -35px;
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
                -webkit-box-shadow: 0 0 0 3px #727cf5;
                box-shadow: 0 0 0 3px #727cf5;
                left: -55.8px;
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
        </style>



        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    {{-- <div class="card-header border-0 align-items-center d-flex pb-0">
                    <h4 class="card-title mb-0 flex-grow-1">Audiences Metrics</h4>
                    <div>
                        <button type="button" class="btn btn-soft-secondary btn-sm">
                            ALL
                        </button>
                        <button type="button" class="btn btn-soft-secondary btn-sm">
                            1M
                        </button>
                        <button type="button" class="btn btn-soft-secondary btn-sm">
                            6M
                        </button>
                        <button type="button" class="btn btn-soft-primary btn-sm">
                            1Y
                        </button>
                    </div>
                </div> --}}



                    {{-- <div class="col-xl-8 audiences-border">
                            <div id="column-chart" class="apex-charts"></div>
                        </div>
                        <div class="col-xl-4">
                            <div id="donut-chart" class="apex-charts"></div>
                        </div> --}}

                    {{-- <div class="row">
                        <div class="col-md-4">
                            <div class="card-body">
                                @if (isset($emp_det) && $emp_det != '')
                                    <img src="{{ $emp_det->Emp_Image }}"
                                        style="width:100px;margin:0 auto;height:100px;border-radius:50%;display:block;"
                                        alt="">
                                @else
                                    <img src="{{ url('user.png') }}"
                                        style="width:100px;height:100px;margin:0 auto;border-radius:50%;display:block;"
                                        alt="">
                                @endif

                                <p style="font-size: 20px;text-align:center;margin-top:10px;">Welcome,
                                    {{ isset($emp_det->Emp_Full_Name) && $emp_det->Emp_Full_Name ? $emp_det->Emp_Full_Name : 'Guest' }}
                                </p>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="time-list">
                                        <div class="dash-stats-list">
                                            <h4>71</h4>
                                            <p>Total Tasks</p>
                                        </div>
                                        <div class="dash-stats-list">
                                            <h4>14</h4>
                                            <p>Pending Tasks</p>
                                        </div>
                                    </div>
                                    <div class="request-btn">
                                        <div class="dash-stats-list">
                                            <h4>2</h4>
                                            <p>Total Projects</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div> --}}






                </div>
            </div>



            {{-- <div class="col-xl-4">
            <div class="card">
                <div class="card-header border-0 align-items-center d-flex pb-1">
                    <h4 class="card-title mb-0 flex-grow-1">Live Users By Country</h4>
                    <div>
                        <button type="button" class="btn btn-soft-primary btn-sm">
                            Export Report
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="world-map-markers" style="height: 346px;"></div>
                </div>
            </div>
        </div> --}}
        </div>


        <div class="row">
            <div class="card">
                <div class="card-body d-flex justify-content-lg-between align-items-center">
                    <div class="col-md-3 d-flex align-items-center">

                        @if (isset($emp_det->Emp_Image) && $emp_det->Emp_Image != '')
                            <img src="{{ $emp_det->Emp_Image }}" style="width:8em;height:8em;border-radius:100%;"
                                alt="">
                        @else
                            <img src="{{ url('user.png') }}" style="width:8em;height:8em;border-radius:100%;"
                                alt="">
                        @endif
                        <div class="welcome-det ms-5 text-dark fw-bolder">
                            <h3 class="fs-2">Welcome, </h3>
                            <span
                                class="fw-bold text-dark fs-4">{{ isset($emp_det->Emp_Full_Name) && $emp_det->Emp_Full_Name ? $emp_det->Emp_Full_Name : 'Guest' }}</span>
                        </div>

                    </div>

                    <div class="col-md-2">
                        <h3>Designation:</h3>
                        <span class="px-2 py-1 fw-semibold rounded-2"
                            style="background-color: #e3e3e3">{{ isset($emp_det->Emp_Designation) && $emp_det->Emp_Designation ? $emp_det->Emp_Designation : '' }}</span>
                    </div>
                    <div class="col-md-2">
                        <h3>Shift:</h3>
                        <span class="px-2 py-1 fw-semibold rounded-2" style="background-color: #e3e3e3">
                            {{ isset($emp_det->Emp_Shift_Time) && $emp_det->Emp_Shift_Time ? $emp_det->Emp_Shift_Time : '' }}
                        </span>

                    </div>
                    <div class="col-md-3">

                        <span class="p-3 rounded-2" style="background-color: #e3e3e3">
                            {{ isset($t_date) ? $t_date : '' }}
                        </span>
                    </div>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                        viewBox="0 0 48 48">
                                        <g fill="none" stroke="#14213d" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="4">
                                            <path d="M42 20v19a3 3 0 0 1-3 3H9a3 3 0 0 1-3-3V9a3 3 0 0 1 3-3h21" />
                                            <path d="m16 20l10 8L41 7" />
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-4">
                                <p class="text-muted text-truncate font-size-15 mb-2"> Number of Present </p>
                                <h3 class="fs-4 flex-grow-1 mb-3">
                                    @if (isset($total_present_day) && $total_present_day!="")
                                        {{$total_present_day}}
                                        @else
                                        0
                                    @endif
                                </h3>
                                {{-- <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 2.8% Increase</span> vs last month</p> --}}
                            </div>
                            {{-- <div class="flex-shrink-0 align-self-start">
                                <div class="dropdown">
                                    <a class="dropdown-toggle btn-icon border rounded-circle" href="#"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-2-fill text-muted font-size-16"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
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
                            <div class="flex-grow-1 overflow-hidden ms-4">
                                <p class="text-muted text-truncate font-size-15 mb-2"> Number of Absent </p>
                                <h3 class="fs-4 flex-grow-1 mb-3">
                                    @if (isset($absent_days) && $absent_days!="")
                                    {{$absent_days}}
                                    @else
                                    0
                                @endif
                                </h3>
                                {{-- <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 2.8% Increase</span> vs last month</p> --}}
                            </div>
                            {{-- <div class="flex-shrink-0 align-self-start">
                                <div class="dropdown">
                                    <a class="dropdown-toggle btn-icon border rounded-circle" href="#"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-2-fill text-muted font-size-16"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem"
                                        viewBox="0 0 1024 1024">
                                        <path fill="#14213d"
                                            d="m960 95.888l-256.224.001V32.113c0-17.68-14.32-32-32-32s-32 14.32-32 32v63.76h-256v-63.76c0-17.68-14.32-32-32-32s-32 14.32-32 32v63.76H64c-35.344 0-64 28.656-64 64v800c0 35.343 28.656 64 64 64h896c35.344 0 64-28.657 64-64v-800c0-35.329-28.656-63.985-64-63.985m0 863.985H64v-800h255.776v32.24c0 17.679 14.32 32 32 32s32-14.321 32-32v-32.224h256v32.24c0 17.68 14.32 32 32 32s32-14.32 32-32v-32.24H960zM736 511.888h64c17.664 0 32-14.336 32-32v-64c0-17.664-14.336-32-32-32h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32m0 255.984h64c17.664 0 32-14.32 32-32v-64c0-17.664-14.336-32-32-32h-64c-17.664 0-32 14.336-32 32v64c0 17.696 14.336 32 32 32m-192-128h-64c-17.664 0-32 14.336-32 32v64c0 17.68 14.336 32 32 32h64c17.664 0 32-14.32 32-32v-64c0-17.648-14.336-32-32-32m0-255.984h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32h64c17.664 0 32-14.336 32-32v-64c0-17.68-14.336-32-32-32m-256 0h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32h64c17.664 0 32-14.336 32-32v-64c0-17.68-14.336-32-32-32m0 255.984h-64c-17.664 0-32 14.336-32 32v64c0 17.68 14.336 32 32 32h64c17.664 0 32-14.32 32-32v-64c0-17.648-14.336-32-32-32" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-4">
                                <p class="text-muted text-truncate font-size-15 mb-2"> Allowed Leaves Per Year: 15 </p>
                                <h3 class="fs-4 flex-grow-1 mb-3">15
                                </h3>
                                {{-- <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 2.8% Increase</span> vs last month</p> --}}
                            </div>

                            {{-- <div class="flex-shrink-0 align-self-start">
                                <div class="dropdown">
                                    <a class="dropdown-toggle btn-icon border rounded-circle" href="#"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-2-fill text-muted font-size-16"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    {{-- leave button  --}}
                    <div class="container d-flex justify-content-between">
                        <button type="button" class="btn btn-success mt-3 mr-2" data-toggle="modal"
                            data-target="#exampleModal">Apply for Leave</button>
                        <a href="/leave-records" class="btn btn-success mt-3 ml-2">Leave Records</a>
                    </div>

                    {{-- apply leave modal  --}}
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Leave Application form</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="leaveForm" action="">
                                        <div id="messageBox"></div>
                                        <div class="form-group mt-3">
                                            <label for="date">Date</label>
                                            <input type="date" class="form-control" id="date" name="date">
                                            <span class="text-danger" id="dateBox" style="display: none">Please Select
                                                a date!</span>
                                        </div>
                                        <div class="form-group mt-3">
                                            <label for="reason">Reason:</label>
                                            <textarea class="form-control" id="reason" name="reason" placeholder="Reason:" rows="5"></textarea>
                                            <span class="text-danger" id="reasonBox" style="display: none">Please Write a
                                                reason!</span>
                                        </div>

                                    </form>
                                    <button type="submit" class="btn btn-primary mt-3"
                                        onclick="submitForm(event)">Apply</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4  col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Today Activity</h6>
                        <div id="content">
                            <ul class="timeliner">
                                <li class="event">
                                    <h3>Check In</h3>
                                    @if (session()->has('check_in_time') && session('check_in_time') != '')
                                        <p>{{ session('check_in_time') }}</p>
                                    @else
                                        <p>No Check In</p>
                                    @endif
                                </li>
                                <li class="event">
                                    <h3>Break Start Time</h3>
                                    @if (session()->has('break_start_time') && session('break_start_time') != '')
                                        <p>{{ session('break_start_time') }}</p>
                                    @else
                                        <p>No Break Start</p>
                                    @endif
                                </li>
                                <li class="event">
                                    <h3>Break End Time</h3>
                                    @if (session()->has('break_end_time') && session('break_end_time') != '')
                                        <p>{{ session('break_end_time') }}</p>
                                    @else
                                        <p>No Break End Time</p>
                                    @endif
                                </li>
                                <li class="event">
                                    <h3>Check Out</h3>
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

            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class=" font-size-header">Timesheet <span
                                class="timesheet-right">{{ isset($t_date) ? $t_date : '' }}</span></h3>
                        {{-- show check in time if it is done  --}}
                        {{-- @if (session()->has('check_in_time') && session('check_in_time') != '')
                            <h3 class="check_in_time">Check In Time: {{ session('check_in_time') }}</h3>
                        @endif --}}




                        <div id="timer" class="text-center timer">00:00:00</div>
                        <div class="punch-info">
                            <div class="punch-hours">
                                @if (session()->has('total_hours') && session('total_hours') != '')
                                    <span style="float: right;">{{ session('total_hours') }}</span>
                                @else
                                    <span>0 hrs</span>
                                @endif


                            </div>
                        </div>




                        {{-- <button onclick="startStop()">Start/Stop</button> --}}
                        {{-- <button onclick="reset()">Reset</button> --}}


                        @if (isset($day_message) && $day_message != '')
                            <span class="text-center text-danger">{{ $day_message }}</span>
                        @endif
                        @if (isset($check_in_already_message) && $check_in_already_message != '')
                            <span class="font-text text-danger">{{ $check_in_already_message }}</span>
                        @endif
                        @if (isset($success_message) && $success_message != '')
                            <span class="text-center green-text">{{ $success_message }}</span>
                        @endif

                        <div class="break-time">
                            {{-- <h4>Instructions</h4> --}}
                            <ul>


                                {{-- @if (isset($shift_time) && $shift_time == 'morning')
                                    <li>For Morning Shift: 10:00 AM - 6:00 PM</li>
                                    <li>Break Time: 1:15 PM- 2:00 PM</li>
                                @else
                                    <li>For Evening Shift: 6:30 AM - 2:00 PM</li>
                                    <li>Break Time: 9:30 PM - 10:00 PM</li>
                                @endif
                                <li>When you Reach Office, Mark Check In and When you leave Office Mark Check Out</li>
                                <li>Make Sure When you go to break then click on break start and when you comeback then
                                    click break end!</li>
                                <li>Make sure to reach on time in office</li>
                                <li>If portal does not work, Please note down your time manually and forward it to your
                                    manager!</li> --}}

                            </ul>
                        </div>
                        <div class="break-time">
                            <p>Target Working Hours <span style="float: right;">7:00 / Day</span></p>

                            {{-- @if (session()->has('check_in_time') && session('check_in_time') != '')
                                <p>Check in Time: <span style="float: right;">{{ session('check_in_time') }}</span></p>
                            @endif

                            @if (session()->has('break_start_time') && session('break_start_time') != '')
                                <p>Break Start Time: <span style="float: right;">{{ session('break_start_time') }}</span>
                                </p>
                            @endif

                            @if (session()->has('break_end_time') && session('break_end_time') != '')
                                <p>Break End Time: <span style="float: right;">{{ session('break_end_time') }}</span></p>
                            @endif
                            @if (session()->has('check_out_time') && session('check_out_time') != '')
                                <p>Check Out Time: <span style="float: right;">{{ session('check_out_time') }}</span></p>
                            @endif --}}

                        </div>
                        {{-- {{$attendence_status}} --}}
                        {{-- @if (isset($attendence_status) && $attendence_status == 'complete')
                            <span style="color:#3e7213;font-size:16px;"> <svg xmlns="http://www.w3.org/2000/svg"
                                    width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="#3e7213"
                                        d="M.41 13.41L6 19l1.41-1.42L1.83 12m20.41-6.42L11.66 16.17L7.5 12l-1.43 1.41L11.66 19l12-12M18 7l-1.41-1.42l-6.35 6.35l1.42 1.41z" />
                                </svg> Attendence Marked Successfully!</span>
                        @elseif(isset($attendence_status) && $attendence_status == 'show-break-start')
                            <div class="row">
                                <div class="col-xl-6">
                                    <a class="btn btn-success my-btn" href="#">Break Start
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em"
                                            viewBox="0 0 16 16">
                                            <g fill="currentColor" fill-rule="evenodd">
                                                <path
                                                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                                <path
                                                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                                <div class="col-xl-6">
                                    <a class="btn btn-danger my-btn" href="/check-out">CheckOut
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
                                </div>




                            </div>
                        @elseif(isset($attendence_status) && $attendence_status == 'incomplete')
                            <div class="row">
                                <div class="col-xl-6">
                                    <a class="btn btn-success my-btn" href="#">Check In
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em"
                                            viewBox="0 0 16 16">
                                            <g fill="currentColor" fill-rule="evenodd">
                                                <path
                                                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                                <path
                                                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                                <div class="col-xl-6">
                                    <a class="btn btn-danger my-btn" href="/check-out">CheckOut
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
                                </div>




                            </div>
                        @endif --}}

                        {{-- timer update --}}
                        {{-- @if (isset($timer_update) && $timer_update == '')
                            <script>startTimer();</script>
                            @elseif(isset($timer_update) && $timer_update == 'start')
                            <script>startTimer();</script>
                            start
                            @elseif(isset($timer_update) && $timer_update == 'stop')
                            <script>startTimer();</script>
                        @endif --}}

                        {{-- @if (isset($show_button) && $show_button == 'check-in')
                            <div class="row">
                                <div class="col-xl-12">
                                    <a class="btn btn-success my-btn" onclick="startTimer()" href="/check-in">Check In
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em"
                                            viewBox="0 0 16 16">
                                            <g fill="currentColor" fill-rule="evenodd">
                                                <path
                                                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                                <path
                                                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @elseif(isset($show_button) && $show_button == 'break-start')
                            <div class="row">
                                <div class="col-xl-12">
                                    <a class="btn btn-success my-btn" href="#">Break Start
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
                                </div>
                            </div>
                        @endif --}}




                        @if (session()->has('attendence_status') && session('attendence_status') === true)
                            <span style="color:#3e7213;font-size:16px;"> <svg xmlns="http://www.w3.org/2000/svg"
                                    width="1em" height="1em" viewBox="0 0 24 24">
                                    <path fill="#3e7213"
                                        d="M.41 13.41L6 19l1.41-1.42L1.83 12m20.41-6.42L11.66 16.17L7.5 12l-1.43 1.41L11.66 19l12-12M18 7l-1.41-1.42l-6.35 6.35l1.42 1.41z" />
                                </svg> Attendence Marked Successfully!</span>
                        @else
                            <div class="row">
                                <div class="col-md-6">
                                    @if (session()->has('show_check_out') && session('show_check_out') === true)
                                        <a class="btn btn-danger my-btn" href="/check-out/" style="width:100%;">Check Out
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
                                        <a class="btn btn-success my-btn" href="/check-in" style="width:100%;">Check In
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
                                        <a class="btn btn-danger my-btn" href="/break-end" style="width:100%;">Break End
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
                                        <a class="btn btn-success my-btn" href="/break-start" style="width:100%;">Break
                                            Start
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

                        <a href="/view-attendence" class="view-class-more">View Attendence</a>

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>


            {{-- <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded fs-2">
                                    <i class="uim uim-airplay"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-4">
                                <p class="text-muted text-truncate font-size-15 mb-2"> Total Expense</p>
                                <h3 class="fs-4 flex-grow-1 mb-3">26,482.46 <span
                                        class="text-muted font-size-16">USD</span></h3>
                                <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 23% Increase</span> vs last month</p>
                            </div>
                            <div class="flex-shrink-0 align-self-start">
                                <div class="dropdown">
                                    <a class="dropdown-toggle btn-icon border rounded-circle" href="#"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-2-fill text-muted font-size-16"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                        <a class="dropdown-item" href="#">Today</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- END ROW -->

        {{-- <div class="row">
            <div class="col-md-4  col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Shift Time</h6>
                        <div id="content">
                            <ul class="timeliner">
                                <li class="event">
                                    <h3>Shift Start</h3>
                                   @if (isset($office_start_time) && $office_start_time!="")
                                       <p>{{$office_start_time}}</p>
                                       @else
                                       <p>Not Set</p>
                                   @endif
                                </li>
                                <li class="event">
                                    <h3>Break Start Time</h3>
                                    @if (isset($break_start) && $break_start!="")
                                    <p>{{$break_start}}</p>
                                    @else
                                    <p>Not Set</p>
                                @endif
                                </li>
                                <li class="event">
                                    <h3>Break End Time</h3>
                                    @if (isset($break_end) && $break_end!="")
                                    <p>{{$break_end}}</p>
                                    @else
                                    <p>Not Set</p>
                                @endif
                                </li>
                                <li class="event">
                                    <h3>Shift End </h3>
                                    @if (isset($office_end_time) && $office_end_time!="")
                                    <p>{{$office_end_time}}</p>
                                    @else
                                    <p>Not Set</p>
                                @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}


        {{-- <div class="row">
                <div class="col-md-12">
                    <div class="welcome-box">
                        <div class="welcome-img">
                            @if (isset($emp_det) && $emp_det != '')
                            <img src="{{$emp_det->Emp_Image}}" style="width:5em;height:5em;border-radius:8px;"  alt="">
                            @else
                            <img src="{{ url('user.png') }}" style="width:5em;height:5em;border-radius:8px;"
                            alt="">
                            @endif
                        </div>

                        <h3>Welcome, {{ ( isset($emp_det->Emp_Full_Name) && $emp_det->Emp_Full_Name ) ?  $emp_det->Emp_Full_Name : 'Guest' }}</h3>
                        <p>Monday, 20 May 2019</p>
                    </div>
                </div>
        </div> --}}





        {{-- <div class="row">
            <div class="col-xl-7">
                <div class="row">

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex pb-0">
                                <h4 class="card-title mb-0 flex-grow-1">Source of Purchases</h4>
                                <div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="fw-semibold">Sort By:</span>
                                            <span class="text-muted">Yearly<i
                                                    class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Yearly</a>
                                            <a class="dropdown-item" href="#">Monthly</a>
                                            <a class="dropdown-item" href="#">Weekly</a>
                                            <a class="dropdown-item" href="#">Today</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div id="social-source" class="apex-charts"></div>
                                <div class="social-content text-center">
                                    <p class="text-uppercase mb-1">Total Sales</p>
                                    <h3 class="mb-0">5,685</h3>
                                </div>
                                <p class="text-muted text-center w-75 mx-auto mt-4 mb-0">Magnis dis parturient montes
                                    nascetur ridiculus tincidunt lobortis.</p>
                                <div class="row gx-4 mt-1">
                                    <div class="col-md-4">
                                        <div class="mt-4">
                                            <div class="progress" style="height: 7px;">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 85%" aria-valuenow="85" aria-valuemin="0"
                                                    aria-valuemax="85">
                                                </div>
                                            </div>
                                            <p class="text-muted mt-2 pt-2 mb-0 text-uppercase font-size-13 text-truncate">
                                                E-Commerce
                                            </p>
                                            <h4 class="mt-1 mb-0 font-size-20">52,524</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mt-4">
                                            <div class="progress" style="height: 7px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                                    aria-valuemax="70">
                                                </div>
                                            </div>
                                            <p class="text-muted mt-2 pt-2 mb-0 text-uppercase font-size-13 text-truncate">
                                                Facebook
                                            </p>
                                            <h4 class="mt-1 mb-0 font-size-20">48,625</h4>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mt-4">
                                            <div class="progress" style="height: 7px;">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: 60%" aria-valuenow="60" aria-valuemin="0"
                                                    aria-valuemax="60">
                                                </div>
                                            </div>
                                            <p class="text-muted mt-2 pt-2 mb-0 text-uppercase font-size-13 text-truncate">
                                                Instagram
                                            </p>
                                            <h4 class="mt-1 mb-0 font-size-20">85,745</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex pb-0">
                                <h4 class="card-title mb-0 flex-grow-1">Sales Statistics</h4>
                                <div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Today<i class="mdi mdi-chevron-down ms-1"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Yearly</a>
                                            <a class="dropdown-item" href="#">Monthly</a>
                                            <a class="dropdown-item" href="#">Weekly</a>
                                            <a class="dropdown-item" href="#">Today</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="mb-0 mt-2">725,800</h4>
                                <p class="mb-0 mt-2 text-muted">
                                    <span class="badge badge-soft-success mb-0">
                                        <i class="ri-arrow-up-line align-middle"></i>
                                        15.72 % </span> vs. previous month
                                </p>

                                <div class="mt-3 pt-1">
                                    <div class="progress progress-lg rounded-pill px-0">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 48%"
                                            aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 26%"
                                            aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="table-responsive mt-3">
                                    <table class="table align-middle table-centered table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order Status</th>
                                                <th scope="col">Orders</th>
                                                <th scope="col">Returns</th>
                                                <th scope="col">Earnings</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0);" class="text-dark">Product Pending</a>
                                                </td>
                                                <td>17,351</td>
                                                <td>2,123</td>
                                                <td><span class="badge bg-subtle-primary text-primary font-size-11 ms-1"><i
                                                            class="mdi mdi-arrow-up"></i> 45.3%</span></td>
                                            </tr><!-- end -->

                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0);" class="text-dark">Product Cancelled</a>
                                                </td>
                                                <td>67,356</td>
                                                <td>3,652</td>
                                                <td><span class="badge bg-subtle-danger text-danger font-size-11 ms-1"><i
                                                            class="mdi mdi-arrow-down"></i> 14.6%</span></td>
                                            </tr><!-- end -->


                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0);" class="text-dark">Product Delivered</a>
                                                </td>
                                                <td>67,356</td>
                                                <td>3,652</td>
                                                <td><span class="badge bg-subtle-primary text-primary font-size-11 ms-1"><i
                                                            class="mdi mdi-arrow-up"></i> 14.6%</span></td>
                                            </tr><!-- end -->
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>

                                <div class="text-center mt-4"><a href="javascript: void(0);"
                                        class="btn btn-primary waves-effect waves-light btn-sm">View More <i
                                            class="mdi mdi-arrow-right ms-1"></i></a></div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-xl-5">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex pb-0">
                        <h4 class="card-title mb-0 flex-grow-1">Top Users</h4>
                        <div>
                            <div class="dropdown">
                                <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold">Sort By:</span>
                                    <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Yearly</a>
                                    <a class="dropdown-item" href="#">Monthly</a>
                                    <a class="dropdown-item" href="#">Weekly</a>
                                    <a class="dropdown-item" href="#">Today</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive" data-simplebar style="max-height: 358px;">
                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <td style="width: 20px;"><img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                class="avatar-sm rounded-circle " alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Glenn Holden</h6>
                                            <p class="text-muted mb-0 font-size-14">glennholden@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$250.00
                                        </td>
                                        <td><span class="badge badge-soft-danger font-size-12">Cancel</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" class="avatar-sm rounded-circle "
                                                alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Lolita Hamill</h6>
                                            <p class="text-muted mb-0 font-size-14">lolitahamill@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-down text-danger font-size-18 align-middle me-1"></i>$110.00
                                        </td>
                                        <td><span class="badge badge-soft-success font-size-12">Success</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" class="avatar-sm rounded-circle "
                                                alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Robert Mercer</h6>
                                            <p class="text-muted mb-0 font-size-14">robertmercer@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$420.00
                                        </td>
                                        <td><span class="badge badge-soft-info font-size-12">Active</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" class="avatar-sm rounded-circle "
                                                alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Marie Kim</h6>
                                            <p class="text-muted mb-0 font-size-14">mariekim@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-down text-danger font-size-18 align-middle me-1"></i>$120.00
                                        </td>
                                        <td><span class="badge badge-soft-warning font-size-12">Pending</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" class="avatar-sm rounded-circle "
                                                alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Sonya Henshaw</h6>
                                            <p class="text-muted mb-0 font-size-14">sonyahenshaw@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$112.00
                                        </td>
                                        <td><span class="badge badge-soft-info font-size-12">Active</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" class="avatar-sm rounded-circle "
                                                alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Marie Kim</h6>
                                            <p class="text-muted mb-0 font-size-14">marikim@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-down text-danger font-size-18 align-middle me-1"></i>$120.00
                                        </td>
                                        <td><span class="badge badge-soft-success font-size-12">Success</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" class="avatar-sm rounded-circle "
                                                alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Sonya Henshaw</h6>
                                            <p class="text-muted mb-0 font-size-14">sonyahenshaw@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$112.00
                                        </td>
                                        <td><span class="badge badge-soft-danger font-size-12">Cancel</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>

        </div> --}}
        <!-- END ROW -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    {{-- <div class="card-header border-0 align-items-center d-flex pb-0">
                        <h4 class="card-title mb-0 flex-grow-1">Latest Transaction</h4>
                        <div>
                            <div class="dropdown">
                                <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold">Sort By:</span>
                                    <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Yearly</a>
                                    <a class="dropdown-item" href="#">Monthly</a>
                                    <a class="dropdown-item" href="#">Weekly</a>
                                    <a class="dropdown-item" href="#">Today</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body pt-2">
                        <h4>Weekly Tasks</h4>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        {{-- <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th> --}}
                                        <th>Task</th>
                                        <th>Task Due Date</th>
                                        <th>Task Assigned By</th>
                                        <th>Status</th>
                                        {{-- <th>Order Date</th>
                                        <th>Total</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Task .... 1</td>
                                        <td>23, 12, 2023</td>
                                        <td>Fredrick</td>
                                        <td><a href="javascript:void()"
                                                style="display:block;text-align:center;width:120px"
                                                class="alert alert-danger">Pending</a></td>
                                        {{-- <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td> --}}
                                        {{-- <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>
                                        <td>
                                            <p class="mb-0">cs562xf452dd</p>
                                        </td>
                                        <td>
                                            07 Oct, 2022
                                        </td>
                                        <td>
                                            $400
                                        </td>
                                        <td>
                                            <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                        </td>
                                        <td>
                                            <span class="badge rounded badge-soft-success font-size-12">Completed</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm"><i
                                                        class="mdi mdi-pencil"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm"><i
                                                        class="mdi mdi-delete"></i></a>
                                            </div>
                                        </td> --}}
                                    </tr>

                                    <tr>
                                        <td>Task .... 1</td>
                                        <td>23, 12, 2023</td>
                                        <td>Fredrick</td>
                                        <td><a href="javascript:void()"
                                                style="display:block;text-align:center;width:120px"
                                                class="alert alert-success">Completed</a></td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    {{-- <div class="card-header border-0 align-items-center d-flex pb-0">
                        <h4 class="card-title mb-0 flex-grow-1">Latest Transaction</h4>
                        <div>
                            <div class="dropdown">
                                <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold">Sort By:</span>
                                    <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Yearly</a>
                                    <a class="dropdown-item" href="#">Monthly</a>
                                    <a class="dropdown-item" href="#">Weekly</a>
                                    <a class="dropdown-item" href="#">Today</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body pt-2">
                        <h4>Weekly Tasks</h4>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        {{-- <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th> --}}
                                        <th>Task</th>
                                        <th>Task Due Date</th>
                                        <th>Task Assigned By</th>
                                        <th>Status</th>
                                        {{-- <th>Order Date</th>
                                        <th>Total</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Task .... 1</td>
                                        <td>23, 12, 2023</td>
                                        <td>Fredrick</td>
                                        <td><a href="javascript:void()"
                                                style="display:block;text-align:center;width:120px"
                                                class="alert alert-danger">Pending</a></td>
                                        {{-- <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td> --}}
                                        {{-- <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>
                                        <td>
                                            <p class="mb-0">cs562xf452dd</p>
                                        </td>
                                        <td>
                                            07 Oct, 2022
                                        </td>
                                        <td>
                                            $400
                                        </td>
                                        <td>
                                            <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                        </td>
                                        <td>
                                            <span class="badge rounded badge-soft-success font-size-12">Completed</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm"><i
                                                        class="mdi mdi-pencil"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm"><i
                                                        class="mdi mdi-delete"></i></a>
                                            </div>
                                        </td> --}}
                                    </tr>

                                    <tr>
                                        <td>Task .... 1</td>
                                        <td>23, 12, 2023</td>
                                        <td>Fredrick</td>
                                        <td><a href="javascript:void()"
                                                style="display:block;text-align:center;width:120px"
                                                class="alert alert-success">Completed</a></td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END ROW -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    {{-- <div class="card-header border-0 align-items-center d-flex pb-0">
                        <h4 class="card-title mb-0 flex-grow-1">Latest Transaction</h4>
                        <div>
                            <div class="dropdown">
                                <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold">Sort By:</span>
                                    <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Yearly</a>
                                    <a class="dropdown-item" href="#">Monthly</a>
                                    <a class="dropdown-item" href="#">Weekly</a>
                                    <a class="dropdown-item" href="#">Today</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body pt-2">
                        <h4>Reports</h4>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        {{-- <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th> --}}
                                        <th>Task</th>
                                        <th>Task Due Date</th>
                                        {{-- <th>Task Assigned By</th> --}}
                                        <th>Status</th>
                                        {{-- <th>Order Date</th>
                                        <th>Total</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Task .... 1</td>
                                        <td>23, 12, 2023</td>
                                        {{-- <td>Fredrick</td> --}}
                                        <td><a href="javascript:void()" style="display:block;width:120px;"
                                                class="alert alert-danger">Pending</a></td>
                                        {{-- <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td> --}}
                                        {{-- <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>
                                        <td>
                                            <p class="mb-0">cs562xf452dd</p>
                                        </td>
                                        <td>
                                            07 Oct, 2022
                                        </td>
                                        <td>
                                            $400
                                        </td>
                                        <td>
                                            <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                        </td>
                                        <td>
                                            <span class="badge rounded badge-soft-success font-size-12">Completed</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm"><i
                                                        class="mdi mdi-pencil"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm"><i
                                                        class="mdi mdi-delete"></i></a>
                                            </div>
                                        </td> --}}
                                    </tr>

                                    <tr>
                                        <td>Task .... 1</td>
                                        <td>23, 12, 2023</td>
                                        {{-- <td>Fredrick</td> --}}
                                        <td><a href="javascript:void()" style="display:block;width:120px;"
                                                class="alert alert-success">Submitted</a></td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    {{-- <div class="card-header border-0 align-items-center d-flex pb-0">
                        <h4 class="card-title mb-0 flex-grow-1">Latest Transaction</h4>
                        <div>
                            <div class="dropdown">
                                <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold">Sort By:</span>
                                    <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Yearly</a>
                                    <a class="dropdown-item" href="#">Monthly</a>
                                    <a class="dropdown-item" href="#">Weekly</a>
                                    <a class="dropdown-item" href="#">Today</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="card-body pt-2">
                        <h4>Reports</h4>
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        {{-- <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th> --}}
                                        <th>Task</th>
                                        <th>Task Due Date</th>
                                        {{-- <th>Task Assigned By</th> --}}
                                        <th>Status</th>
                                        {{-- <th>Order Date</th>
                                        <th>Total</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Task .... 1</td>
                                        <td>23, 12, 2023</td>
                                        {{-- <td>Fredrick</td> --}}
                                        <td><a href="javascript:void()" style="display:block;width:120px;"
                                                class="alert alert-danger">Pending</a></td>
                                        {{-- <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td> --}}
                                        {{-- <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>
                                        <td>
                                            <p class="mb-0">cs562xf452dd</p>
                                        </td>
                                        <td>
                                            07 Oct, 2022
                                        </td>
                                        <td>
                                            $400
                                        </td>
                                        <td>
                                            <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                        </td>
                                        <td>
                                            <span class="badge rounded badge-soft-success font-size-12">Completed</span>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="javascript:void(0);" class="btn btn-success btn-sm"><i
                                                        class="mdi mdi-pencil"></i></a>
                                                <a href="javascript:void(0);" class="btn btn-danger btn-sm"><i
                                                        class="mdi mdi-delete"></i></a>
                                            </div>
                                        </td> --}}
                                    </tr>

                                    <tr>
                                        <td>Task .... 1</td>
                                        <td>23, 12, 2023</td>
                                        {{-- <td>Fredrick</td> --}}
                                        <td><a href="javascript:void()" style="display:block;width:120px;"
                                                class="alert alert-success">Submitted</a></td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        {{-- END ROW  --}}

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
                        console.log('AJAX request successful');

                        $('#messageBox').text(response.message);
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';

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
