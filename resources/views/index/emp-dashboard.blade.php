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
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            .EmpNameStyle {
                font-size: 30px;
                color: #fff;
                font-weight: 600;
                font-family: 'Poppins';
            }
            .completed-badge {
                color: #fca311;
            display: inline-block;
            background: #14213d;
            height: 30px;
            padding: 5px 16px;
            border-radius: 50px;
            }

            .EmpStyle {
                font-size: 18px;
                color: #fca311;
                font-family: 'Poppins';
                font-weight: 300
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
                border: 3px solid #fca311;

                max-width: 250px;

                padding: 20px;
                margin: 0 auto;
                border-radius: 12px;
                position: relative;
                text-align: center;
            }



            .punch-hours span {
                font-weight: 500;
                transform: translate(-50%, -50%);
                font-size: 30px;
                color: #14213d;
            }

            .view-class-more {

                font-size: 16px;
                text-align: center;
                display: block;
                /* margin: 0px; */
                margin-top: 17px;

            }

            .timeliner {

                margin: 0 auto;
                letter-spacing: 0.2px;
                position: relative;
                padding-top: 20px;
                margin-left: 10px;
                padding-bottom: 0;

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
                left: -23.6px;
                background: #fff;
                border-radius: 50%;
                height: 6px;
                width: 6px;
                content: "";
                top: 10px;
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

            }

            .char-count {
                font-size: 0.8em;
                color: #666;
                text-align: right;
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

            .modal-fullscreen {
                width: 100vw;
                max-width: 100%;
                margin: 0;
            }

            .modal-dialog-scrollable {
                display: flex;
                max-height: calc(100vh - 60px);
                /* Adjust as needed based on your modal content */
                margin-top: 30px;
                /* Adjust top margin as needed */
            }

            .embed-responsive {
                position: relative;
                display: block;
                width: 100%;
                padding-top: 100%;
                /* This keeps the aspect ratio (height:width) */
                overflow: hidden;
            }

            .embed-responsive iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                border: none;
            }

            .closeBtn {
                position: absolute;
                top: 25px;
                right: 15px;
                cursor: pointer;
            }

            .active {
                color: #14213d;
                border-bottom: 1px solid #fca311;
            }

            .notification-hover:hover {
                background: #fca31130;
                transition: all 0.2s ease-in-out;
            }

            .to-do-form input,
            textarea {
                width: 100%;
                padding: 5px 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .to-do-form textarea {
                height: 37px;
                resize: none;
            }


            button {
                padding: 5px 10px;
                background-color: #28a745;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }

            button:hover {
                background-color: #218838;
            }

            .container {
                width: 400px;
                padding: 20px;
                background-color: #f0f0f0;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                text-align: center;
            }

            form {
                display: flex;
                margin-bottom: 10px;
            }

            input[type="text"] {
                flex: 1;
                padding: 8px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 4px 0 0 4px;
            }

            button {
                padding: 8px 16px;
                font-size: 16px;
                border: none;
                background-color: #4caf50;
                color: white;
                border-radius: 0 4px 4px 0;
                cursor: pointer;
            }

            button:hover {
                background-color: #45a049;
            }

            .card {
                margin-bottom: 10px;
                padding: 10px;
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 4px;
                cursor: pointer;
            }
        </style>

        <div class="row mt-2">
            <div class="card px-0">
                <div class="card-body flex-wrap" style="background-color: #14213d;min-height:270px">
                    <div class="col-md-6 col-lg-6 col-xl-6 gap-3 d-flex align-items-center flex-wrap p-2">

                        @if ($emp_det->Emp_Image != '' && file_exists($emp_det->Emp_Image))
                            <img src="{{ $emp_det->Emp_Image }}"
                                style="width:150px;height:150px;border-radius:100%; object-fit:cover;" alt="">
                        @else
                            <img class="img-fluid rounded-circle"
                                style="width:150px;height:150px;border-radius:100%; object-fit:cover;"
                                src="{{ url('user.png') }}">
                        @endif
                        <div class="welcome-det ms-3 text-dark fw-bolder">
                            <h2 class="EmpNameStyle">
                                {{ isset($emp_det->Emp_Full_Name) && $emp_det->Emp_Full_Name ? $emp_det->Emp_Full_Name : 'Guest' }}
                            </h2>
                            <div class="d-flex justify-content-between align-items-center gap-5">
                                <h3 class="mb-0 EmpStyle" style="">Designation:</h3>
                                <span class="EmpStyle"
                                    style="color:#fff;">{{ isset($emp_det->Emp_Designation) && $emp_det->Emp_Designation ? $emp_det->Emp_Designation : '' }}</span>
                            </div>
                            <div class="d-flex justify-content-start align-items-center gap-5">
                                <h3 class="mb-0 EmpStyle" style="width:110px">Shift:</h3>
                                <span class="EmpStyle" style="color:#fff;">
                                    {{ isset($emp_det->Emp_Shift_Time) && $emp_det->Emp_Shift_Time ? $emp_det->Emp_Shift_Time : '' }}
                                </span>

                            </div>
                        </div>

                    </div>

                    <div class="position-absolute p-2"
                        style="top:20px;right: 20px; border:1px solid #fca311; border-radius:10px">
                        <span style="color:#fff; font-size: 15px;font-weight: 300; font-family: 'Poppins';">
                            {{ isset($t_date) ? $t_date : '' }}
                        </span>

                    </div>
                </div>
            </div>

        </div>
        <div class="row flex-wrap" style="position: relative; top:-90px;">
            <div id="popupButton">
                <button type="button" onclick="openLeaveModal()" class="position-absolute reblateBtn px-3 py-1 text-white"
                    style="background-color: #fca311; right: 35px; top:-45px;"> Apply for Leave</button>
            </div>
            <div class="popup" id="popup_leave">
                <div class="popup-content flex-column">
                    <div class="d-flex mb-3 align-items-center justify-content-between">
                        <h2 class="mb-0"
                            style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom: 1px solid #c7c7c7;">
                            Apply For Leaves
                        </h2>
                        <span class="closeBtn p-2"
                            style="border-radius: 50%; background-color: #14213d26; cursor: pointer;" onclick="closeLeaveModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#14213d50"
                                class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path
                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                            </svg>
                        </span>
                    </div>
                    <form id="myForm" action="" method="POST" class="text-start">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="messageBox" class="mt-2 mb-2" style="font-size: 16px;display:none;"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="EmpStyle font-size-14 fw-bolder" style="color:#14213d;" for="leave_title">
                                        Leave Title <span style="color:red">*</span>
                                    </label>
                                    <div class="d-flex align-items-center"
                                        style="border: 1px solid #14213d; border-radius: 50px; padding: 10px; background-color: white;">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                stroke="#9e9e9e" stroke-width="2" stroke-linecap="round"></path>
                                            <rect x="6" y="12" width="3" height="3" rx="0.5" fill="#9e9e9e">
                                            </rect>
                                            <rect x="10.5" y="12" width="3" height="3" rx="0.5"
                                                fill="#9e9e9e"></rect>
                                            <rect x="15" y="12" width="3" height="3" rx="0.5" fill="#9e9e9e">
                                            </rect>
                                        </svg>
                                        <input type="text" class="form-control ms-2 p-0" style="border: none;"
                                            id="leave_title" name="leave_title" placeholder="Enter Leave Title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="EmpStyle font-size-14 fw-bolder" style="color:#14213d;" for="date">
                                        Starting Date <span style="color:red">*</span>
                                    </label>
                                    <div class="d-flex align-items-center"
                                        style="border: 1px solid #14213d; border-radius: 50px; padding: 10px; background-color: white;">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                stroke="#9e9e9e" stroke-width="2" stroke-linecap="round"></path>
                                            <rect x="6" y="12" width="3" height="3" rx="0.5"
                                                fill="#9e9e9e"></rect>
                                            <rect x="10.5" y="12" width="3" height="3" rx="0.5"
                                                fill="#9e9e9e"></rect>
                                            <rect x="15" y="12" width="3" height="3" rx="0.5"
                                                fill="#9e9e9e"></rect>
                                        </svg>
                                        <input type="date" class="form-control ms-2 p-0" style="border: none;"
                                            id="date" name="date">
                                        <span class="text-danger" id="dateBox_start" style="display: none;">Please Select
                                            a date!</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="EmpStyle font-size-14 fw-bolder" style="color:#14213d;"
                                        for="Ending_date">
                                        Ending Date <span style="color:red">*</span>
                                    </label>
                                    <div class="d-flex align-items-center"
                                        style="border: 1px solid #14213d; border-radius: 50px; padding: 10px; background-color: white;">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                stroke="#9e9e9e" stroke-width="2" stroke-linecap="round"></path>
                                            <rect x="6" y="12" width="3" height="3" rx="0.5"
                                                fill="#9e9e9e"></rect>
                                            <rect x="10.5" y="12" width="3" height="3" rx="0.5"
                                                fill="#9e9e9e"></rect>
                                            <rect x="15" y="12" width="3" height="3" rx="0.5"
                                                fill="#9e9e9e"></rect>
                                        </svg>
                                        <input type="date" class="form-control ms-2 p-0" style="border: none;"
                                            id="Ending_date" name="Ending_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label class="EmpStyle font-size-14 fw-bolder" style="color:#14213d;" for="reason">
                                        Reason <span style="color:red">*</span>
                                    </label>
                                    <textarea class="form-control inputboxcolor p-2 bg-white"
                                        style="border: 1px solid #14213d; resize: none; height: 100px;" id="reason" name="reason"
                                        oninput="updateCharCount()" placeholder="Write Reason within 200 characters" rows="5"></textarea>
                                    <div class="char-count mt-2">
                                        <span id="charCount">0</span> / 200 characters
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button class="px-4 py-2 reblateBtn" type="submit"
                                    onclick="submitForm(event)">Apply</button>
                            </div>

                        </div>


                    </form>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2">
                <a href="/view-attendence">
                    <div class="card" style="border-radius:10px;">
                        <div class="card-body" style="background-color: #fca311">
                            <div class="d-flex align-items-start flex-column">
                                <div class="rounded-pill mb-3" style="padding: 10px;background-color: #14213d">
                                    <img src="{{ url('Group1.svg') }}"
                                        style="width:23px; height:23px; object-fit:contain;margin-left:2px"
                                        alt="User Icon Reblate Solutions">
                                </div>
                                <p class="mb-1 EmpStyle" style="color: #14213d; font-size:15px; font-weight: 600">Total
                                    Presents
                                </p>
                                <h2 class="mb-0 EmpNameStyle" style="color: #14213d; font-weight: 800">
                                    @if (isset($total_present_day) && $total_present_day != '')
                                        {{ $total_present_day }}
                                    @else
                                        0
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2">
                <a href="/view-attendence">
                    <div class="card" style="border-radius:10px;">
                        <div class="card-body" style="background-color: #fca311">
                            <div class="d-flex align-items-start flex-column">
                                <div class="rounded-pill mb-3" style="padding: 10px;background-color: #14213d">
                                    <img src="{{ url('Group2.svg') }}"
                                        style="width:23px; height:23px; object-fit:contain;margin-left:2px"
                                        alt="User Icon Reblate Solutions">
                                </div>
                                <p class="mb-1 EmpStyle" style="color: #14213d; font-size:15px; font-weight: 600">Total
                                    Absents</p>
                                <h2 class="mb-0 EmpNameStyle" style="color: #14213d; font-weight: 800">
                                    @if (isset($absent_days) && $absent_days != '')
                                        {{ $absent_days }}
                                    @else
                                        0
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2">
                <a href="{{ route('leaves.record') }}">
                    <div class="card" style="border-radius:10px;">
                        <div class="card-body" style="background-color: #fca311">
                            <div class="d-flex align-items-start flex-column">
                                <div class="rounded-pill mb-3" style="padding: 10px;background-color: #14213d">
                                    <img src="{{ url('Group1.svg') }}"
                                        style="width:23px; height:23px; object-fit:contain;margin-left:2px"
                                        alt="User Icon Reblate Solutions">
                                </div>
                                <p class="mb-1 EmpStyle" style="color: #14213d; font-size:15px; font-weight: 600">Total
                                    Leaves
                                </p>
                                <h2 class="mb-0 EmpNameStyle" style="color: #14213d; font-weight: 800">
                                    @if (isset($total_leaves) && $total_leaves != '')
                                        {{ $total_leaves }}
                                    @else
                                        0
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2">
                <a href="{{ route('leaves.record') }}">
                    <div class="card" style="border-radius:10px;">
                        <div class="card-body" style="background-color: #fca311">
                            <div class="d-flex align-items-start flex-column">
                                <div class="rounded-pill mb-3" style="padding: 10px;background-color: #14213d">
                                    <img src="{{ url('Group3.svg') }}"
                                        style="width:23px; height:23px; object-fit:contain;margin-left:2px"
                                        alt="User Icon Reblate Solutions">
                                </div>
                                <p class="mb-1 EmpStyle" style="color: #14213d; font-size:15px; font-weight: 600">Pending
                                    Approvel</p>
                                <h2 class="mb-0 EmpNameStyle" style="color: #14213d; font-weight: 800">
                                    @if (isset($total_pending) && $total_pending != '')
                                        {{ $total_pending }}
                                    @else
                                        0
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2">
                <div class="card" style="border-radius:10px;">
                    <div class="card-body" style="background-color: #fca311">
                        <div class="d-flex align-items-start flex-column">
                            <div class="rounded-pill mb-3" style="padding: 10px;background-color: #14213d">
                                <img src="{{ url('Group4.svg') }}"
                                    style="width:23px; height:23px; object-fit:contain;margin-left:2px"
                                    alt="User Icon Reblate Solutions">
                            </div>
                            <p class="mb-1 EmpStyle" style="color: #14213d; font-size:15px; font-weight: 600">Working Days
                            </p>
                            <h2 class="mb-0 EmpNameStyle" style="color: #14213d; font-weight: 800">
                                {{ $total_work_days_in_month }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2">
                <div class="card" style="border-radius:10px;">
                    <div class="card-body" style="background-color: #fca311">
                        <div class="d-flex align-items-start flex-column">
                            <div class="rounded-pill mb-3" style="padding: 10px;background-color: #14213d">
                                <img src="{{ url('Group5.svg') }}"
                                    style="width:23px; height:23px; object-fit:contain;margin-left:2px"
                                    alt="User Icon Reblate Solutions">
                            </div>
                            <p class="mb-1 EmpStyle" style="color: #14213d; font-size:15px; font-weight: 600">Loss of Pay
                            </p>
                            <h2 class="mb-0 EmpNameStyle" style="color: #14213d; font-weight: 800">
                                @if (isset($salary_deduct) && $salary_deduct != '')
                                    {{ $salary_deduct }}
                                @else
                                    0
                                @endif
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @if ($emp_birthday)
            <link rel="stylesheet" href="{{ url('assets/css/b_whishes.css') }}">
            <script>
                // Function to create confetti
                function createConfetti(id) {
                    var conf = "#confetti_" + id;
                    console.log(conf);
                    const confettiContainer = document.querySelector(conf);
                    for (let i = 0; i < 100; i++) {
                        const confettiPiece = document.createElement('div');
                        confettiPiece.classList.add('confetti-piece');
                        confettiPiece.style.width = `${Math.random() * 10 + 5}px`;
                        confettiPiece.style.height = confettiPiece.style.width;
                        confettiPiece.style.backgroundColor = `hsl(${Math.random() * 360}, 70%, 60%)`;
                        confettiPiece.style.top = `${Math.random() * 100}vh`;
                        confettiPiece.style.left = `${Math.random() * 100}vw`;
                        confettiPiece.style.opacity = Math.random();
                        confettiPiece.style.transform = `rotate(${Math.random() * 360}deg)`;
                        confettiContainer.appendChild(confettiPiece);
                    }

                    const style = document.createElement('style');
                    style.textContent = `
                .confetti-piece {
                    animation: confetti-fall 5s linear infinite;
                }
            `;
                    document.head.appendChild(style);
                }
            </script>
            @foreach ($emp_birthday as $emp)
                <section class="birthday-section">
                    <div class="confetti" id="confetti_{{ $emp->id }}"></div>
                    <div class="title-container">
                        <div class="typing-container">
                            <h1 class="typing-text">Happy Birthday!</h1>
                        </div>
                        <p>Wishing you a day filled with love, joy, and cake!</p>
                    </div>
                    <div class="content-wrapper">
                        <div class="left-section">
                            @if ($emp->Emp_Image && file_exists($emp->Emp_Image))
                                <img src="{{ $emp->Emp_Image }}" alt="Employee" class="employee-img">
                            @else
                                <img src="{{ url('user.png') }}" alt="Employee" class="employee-img">
                            @endif

                            <div class="employee-name">{{ $emp->Emp_Full_Name }}</div>
                        </div>
                        <div style="color: #d32f2f;font-size:22px;">
                            {{ \Carbon\Carbon::parse($emp->emp_birthday)->format('d F Y') }}</div>
                        <div class="right-section">
                            <div class="cake-icon"></div>
                        </div>
                    </div>
                    <script>
                        // Initialize animations
                        createConfetti({{ $emp->id }});
                    </script>
                </section>
            @endforeach
        @endif


        <div class="row" style="position: relative; top: 40px;">
            <div class="col-md-7 col-xl-7 col-lg-7">
                <div class="card" style="box-shadow: none">
                    <div class="card-body"
                        style="background-color: #fff; backdrop-filter: none; border:1px solid #c7c7c7; height: 450px; overflow-y: auto;">
                        <h3 class="EmpNameStyle mb-1" style="color: #14213d; font-weight: 800">Notifications</h3>
                        <div class="mt-3">
                            <ul
                                class="d-flex gap-4 align-items-center list-group list-group-flush account-settings-links flex-row">
                                <li style="list-style: none"><a href="#all"
                                        style="font-size:15px;font-family:'Poppins'; font-weight:500; color:#14213d"
                                        data-toggle="list" class="empMenu active">All</a> </li>
                                <li style="list-style: none"><a href="#tasks"
                                        style="font-size:15px;font-family:'Poppins'; font-weight:500; color:#14213d"
                                        data-toggle="list" class="empMenu">Tasks</a> </li>
                                <li style="list-style: none"><a href="#to-do"
                                        style="font-size:15px;font-family:'Poppins'; font-weight:500; color:#14213d"
                                        data-toggle="list" class="empMenu">To Do</a> </li>
                            </ul>
                        </div>
                        <div class="tab-content">

                            {{-- all notifications  --}}
                            <div class="container-fluid tab-pane fade active show px-0"
                                style="border-bottom: none; min-height:350px" id="all">
                                {{-- notifications  --}}

                                @if ($notifications != null && $notifications->isNotEmpty())
                                    @foreach ($notifications as $notify)
                                        <div class="notification-hover mt-2 p-2"
                                            style="border-bottom: 1px solid lightgray"
                                            id="notifications_{{ $notify->id }}">
                                            <div class="d-flex">
                                                <a href="{{ $notify->link }}">
                                                    <div class="avatar-sm me-3">
                                                        @if ($emp_det->Emp_Image != '' && file_exists($emp_det->Emp_Image))
                                                            <img src="{{ $emp_det->Emp_Image }}"
                                                                style="border-radius:100%; object-fit:cover;width:2.6rem;height:2.6rem;"
                                                                alt="">
                                                        @else
                                                            <img class="img-fluid rounded-circle"
                                                                style="border-radius:100%; object-fit:cover;width:2.6rem;height:2.6rem;"
                                                                src="{{ url('user.png') }}">
                                                        @endif
                                                    </div>
                                                    <div class="flex-1">
                                                        <h4 class="mb-1 EmpNameStyle"
                                                            style="color: #14213d;font-weight: 500; font-size:20px">
                                                            {{ $notify->title }}</h4>
                                                        <div class=" text-muted d-flex gap-2">
                                                            <p class="mb-0 font-size-12"><i
                                                                    class="mdi mdi-clock-outline"></i>
                                                                {{ date('d F Y', strtotime($notify->date)) }}
                                                                {{ $notify->time }}</p>

                                                        </div>
                                                        <p class="mb-1 text-muted font-size-14 ">{{ $notify->message }}
                                                        </p>
                                                        <a href="javascript:void()"
                                                            onclick="markAsRead({{ $notify->id }},'all')">mark as
                                                            read</a>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="position-absolute" style="top: 50%; left: 30%;">
                                        <h4 class="mb-1 EmpNameStyle" style="color: #c7c7c7; font-size:35px">
                                            No Notifications</h4>
                                    </div>
                                @endif



                            </div>

                            <div class="container-fluid tab-pane fade show px-0"
                                style="border-bottom: none;min-height:350px" id="tasks">
                                {{-- tasks notifications  --}}

                                @if ($tasks_notifications != null && $tasks_notifications->isNotEmpty())
                                    @foreach ($tasks_notifications as $notify)
                                        <div class="notification-hover mt-2 p-2"
                                            style="border-bottom: 1px solid lightgray"
                                            id="notifications_tasks_{{ $notify->id }}">
                                            <div class="d-flex">
                                                <a href="{{ $notify->link }}">
                                                    <div class="avatar-sm me-3">
                                                        @if ($emp_det->Emp_Image != '' && file_exists($emp_det->Emp_Image))
                                                            <img src="{{ $emp_det->Emp_Image }}"
                                                                style="border-radius:100%; object-fit:cover;width:2.6rem;height:2.6rem;"
                                                                alt="">
                                                        @else
                                                            <img class="img-fluid rounded-circle"
                                                                style="border-radius:100%; object-fit:cover;width:2.6rem;height:2.6rem;"
                                                                src="{{ url('user.png') }}">
                                                        @endif
                                                    </div>
                                                    <div class="flex-1">
                                                        <h4 class="mb-1 EmpNameStyle"
                                                            style="color: #14213d;font-weight: 500; font-size:20px">
                                                            {{ $notify->title }}</h4>
                                                        <div class=" text-muted  d-flex gap-2">
                                                            <p class="mb-0 font-size-12"><i
                                                                    class="mdi mdi-clock-outline"></i>
                                                                {{ date('d F Y', strtotime($notify->date)) }}
                                                                {{ $notify->time }}</p>

                                                        </div>
                                                        <p class="mb-1 text-muted font-size-14">{{ $notify->message }}</p>
                                                        <a href="javascript:void()"
                                                            onclick="markAsRead({{ $notify->id }},'tasks')">mark as
                                                            read</a>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="position-absolute" style="top: 50%; left: 25%;">
                                        <h4 class="mb-1 EmpNameStyle" style="color: #c7c7c7; font-size:35px">
                                            No Tasks Notifications</h4>
                                    </div>
                                @endif


                            </div>

                            <div class="tab-pane fade px-0 show" style="border-bottom: none; min-height:350px"
                                id="to-do">
                                <div class="mt-3">
                                    <div>
                                        <h1>To-Do List</h1> 
                                        <form id="todo-form">
                                            <input type="text" id="task-title" placeholder="Enter task title"
                                                required>
                                            <input type="hidden" id="user_code"
                                                value="{{ auth()->user()->user_code }}">
                                            <input type="hidden" id="user_name"
                                                value="{{ auth()->user()->user_name }}">
                                            <button type="submit">Add Task</button>
                                        </form>
                                        <div id="task-list">
                                        @if ($latest_to_do != null)
                                            @foreach ($latest_to_do as $item)
                                                <div class="card" data-id="{{ $item->id }}">
                                                    <div class="card-content" style="display: flex;justify-content: space-between;">
                                                        <div>
                                                            <h3>{{ $item->task_title }}</h3>
                                                            <p>Date: {{ $item->date }}</p>
                                                            <p>Time: {{ $item->time }}</p>
                                                            <input type="hidden" class="task-id" value="{{ $item->id }}">
                                                        </div>
                                                        <div class="card-actions" style="padding-right: 20px;">
                                                            <button class="tick-btn">✔️</button>
                                                            <a href="#" onclick="delToDoList('{{$item->id}}')" class="cross-btn">❌</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const taskList = document.getElementById('task-list');
                                        // Handle click on task cards to update status
                                        taskList.addEventListener('click', function(event) {
                                            const task = event.target.closest('.card');
                                            if (task) {
                                                const taskId = task.getAttribute('data-id');
                                                let newStatus;
                                                if (event.target.classList.contains('cross-btn')) {
                                                    newStatus = 'pending';
                                                } else if (event.target.classList.contains('tick-btn')) {
                                                    newStatus = 'completed';
                                                } else {
                                                    return; 
                                                }
                                                console.log('Updating Task ID:', taskId, 'New Status:', newStatus);
                                                fetch('/update-task-status', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'Accept': 'application/json',
                                                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                                        },
                                                        body: JSON.stringify({
                                                            id: taskId,
                                                            status: newStatus
                                                        })
                                                    })
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        console.log('Response Data:', data);
                                                        if (data.success) {
                                                            if (newStatus === 'completed') {
                                                                task.classList.add('completed');
                                                                showCompletedBadge(task);
                                                                hideButtons(task);
                                                            } else {
                                                                task.classList.remove('completed');
                                                            }
                                                            updateTaskStyle(task, newStatus === 'completed');
                                                        } else {
                                                            console.error('Failed to update status:', data);
                                                        }
                                                    })
                                                    .catch(error => console.error('Error:', error));
                                            }
                                        });

                                        // Handle task submission
                                        const form = document.getElementById('todo-form');
                                        form.addEventListener('submit', function(event) {
                                            event.preventDefault();

                                            const taskTitleInput = document.getElementById('task-title');
                                            const taskTitle = taskTitleInput.value.trim();
                                            const userNameInput = document.getElementById('user_name');
                                            const user_name = userNameInput.value.trim();
                                            const userCodeInput = document.getElementById('user_code');
                                            const user_code = userCodeInput.value.trim();

                                            if (taskTitle) {
                                                fetch('/save-to-do-task', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'Accept': 'application/json',
                                                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                                        },
                                                        body: JSON.stringify({
                                                            title: taskTitle,
                                                            userName: user_name,
                                                            userCode: user_code,
                                                            date: getCurrentDate(),
                                                            time: getCurrentTime()
                                                        })
                                                    })
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        console.log('Response Data:', data);
                                                        if (data.id) {
                                                            const task = document.createElement('div');
                                                            task.className = 'card';
                                                            task.setAttribute('data-id', data.id);
                                                            task.innerHTML = `
                                                            <div class="card-content" style="display: flex;justify-content: space-between;">
                                                                <div>
                                                                    <h3>${taskTitle}</h3>
                                                                    <p class="task-date">Date: ${getCurrentDate()}</p>
                                                                    <p class="task-time">Time: ${getCurrentTime()}</p>
                                                                    <input type="hidden" class="task-id" value="${data.id}">
                                                                </div>
                                                                <div class="card-actions" style="padding-right: 20px;">
                                                                    <button class="tick-btn">✔️</button>
                                                                    <a href="#" onclick="delToDoList(${data.id})" class="cross-btn">❌</a>
                                                                </div>
                                                            </div>
                                                            `;

                                                            // Append new task to the task list
                                                            taskList.insertBefore(task, taskList.firstChild);
                                                            taskTitleInput.value = ''; // Reset the input field
                                                        }
                                                    })
                                                    .catch(error => console.error('Error:', error));
                                            } else {
                                                alert('Please enter a task title.');
                                            }
                                        });

                                        // Function to get the current date
                                        function getCurrentDate() {
                                            const now = new Date();
                                            const options = {
                                                weekday: 'long',
                                                year: 'numeric',
                                                month: 'long',
                                                day: 'numeric'
                                            };
                                            return now.toLocaleDateString('en-US', options);
                                        }

                                        // Function to get the current time
                                        function getCurrentTime() {
                                            const now = new Date();
                                            return now.toLocaleTimeString('en-US');
                                        }

                                        // Function to show the completed badge
                                        function showCompletedBadge(task) {
                                            // Create a badge element
                                            const badge = document.createElement('span');
                                            badge.classList.add('completed-badge');
                                            badge.textContent = 'Your Task has been Completed';
                                            
                                            // Add the badge to the card
                                            const cardContent = task.querySelector('.card-content');
                                            cardContent.appendChild(badge);
                                        }

                                        // Function to hide both tick and cross buttons
                                        function hideButtons(task) {
                                            const tickBtn = task.querySelector('.tick-btn');
                                            const crossBtn = task.querySelector('.cross-btn');

                                            // Hide both buttons
                                            tickBtn.style.display = 'none';
                                            crossBtn.style.display = 'none';
                                        }

                                        // Function to update task style based on status
                                        function updateTaskStyle(task, isCompleted) {
                                            const title = task.querySelector('h3');
                                            const date = task.querySelector('.task-date');
                                            const time = task.querySelector('.task-time');

                                            if (isCompleted) {
                                                title.style.textDecoration = 'line-through';
                                                date.style.textDecoration = 'line-through';
                                                time.style.textDecoration = 'line-through';
                                                title.style.color = 'black'; 
                                                date.style.color = 'black';
                                                time.style.color = 'black';
                                            } else {
                                                title.style.textDecoration = 'none';
                                                date.style.textDecoration = 'none';
                                                time.style.textDecoration = 'none';
                                                title.style.color = 'black'; // Reset color for pending tasks
                                                date.style.color = 'black';
                                                time.style.color = 'black';
                                            }
                                        }
                                    });
                                </script>
                                {{-- <div class="position-absolute" style="top: 50%; left: 25%;">
                                        <h4 class="mb-1 EmpNameStyle" style="color: #c7c7c7; font-size:35px">
                                            No Tasks </h4>
                                    </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                function markAsRead(id, str) {
                    if (str === "all") {
                        var not = "notifications_" + id;
                    }

                    if (str === "tasks") {
                        var not = "notifications_tasks_" + id;
                    }

                    var dc = document.getElementById(not).style.display = "none";

                    // Get CSRF token from somewhere (meta tag or inline assignment)
                    var csrfToken = "{{ csrf_token() }}"; // Ensure this is correctly populated

                    // Make an AJAX request to mark notification as read
                    fetch('/mark-as-read', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Notification marked as read:', data);
                            // Handle success
                        })
                        .catch(error => {
                            console.error('Error marking notification as read:', error);
                            // Handle error
                        });
                }
            </script>
            <script>
            function delToDoList(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You Want To Delete The to-do list',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonColor: '#FF5733', // Red color for "Yes"
                    cancelButtonColor: '#4CAF50', // Green color for "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send an AJAX request to delete the team member
                        $.ajax({
                            url: '/del-task/' + id,
                            method: 'DELETE', // Use the DELETE HTTP method
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                            },
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
                                    text: 'An error occurred while deleting quotation!',
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            }
        </script>

            <div class="col-md-5 col-xl-5 col-lg-5">
                <div class="card" style="box-shadow: none;">
                    <div class="card-body" style="background-color: #fff; backdrop-filter: none;border:1px solid #c7c7c7">
                        <div class="mb-2">
                            <h3 class="EmpNameStyle mb-0" style="color: #14213d; font-weight: 800">Clock In / Out </h3>
                        </div>
                        <div class="d-flex align-items-center">
                            <svg width="20px" height="20px" viewBox="0 0 1024 1024"
                                xmlns="http://www.w3.org/2000/svg" fill="#14213d">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill="#000000"
                                        d="M512 832a320 320 0 1 0 0-640 320 320 0 0 0 0 640zm0 64a384 384 0 1 1 0-768 384 384 0 0 1 0 768z">
                                    </path>
                                    <path fill="#000000"
                                        d="m292.288 824.576 55.424 32-48 83.136a32 32 0 1 1-55.424-32l48-83.136zm439.424 0-55.424 32 48 83.136a32 32 0 1 0 55.424-32l-48-83.136zM512 512h160a32 32 0 1 1 0 64H480a32 32 0 0 1-32-32V320a32 32 0 0 1 64 0v192zM90.496 312.256A160 160 0 0 1 312.32 90.496l-46.848 46.848a96 96 0 0 0-128 128L90.56 312.256zm835.264 0A160 160 0 0 0 704 90.496l46.848 46.848a96 96 0 0 1 128 128l46.912 46.912z">
                                    </path>
                                </g>
                            </svg>
                            <span class="ms-2" style="color: #14213d; font-family:'poppins';">Clock</span>
                            <span class="ms-2" style="color: #14213d; font-family:'poppins';">
                                <script>
                                    document.write(new Date().toUTCString().slice(5, 16))
                                </script>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center gap-4 mt-2">
                            <div class="p-2 w-50"
                                style="background-color: #14213d26;border-radius:10px; border: 1px solid #14213d30">
                                <p class="mb-0" style="color: #14213d; font-family:'poppins';">Clock In</p>
                                <h3 class="mb-0" style="color: #14213d; font-family:'poppins';font-weight:700">
                                    @if (session()->has('check_in_time') && session('check_in_time') != '')
                                        {{ session('check_in_time') }}
                                    @else
                                        _
                                    @endif
                                </h3>
                            </div>
                            <!-- <div class="p-2 w-50"
                                style="background-color: #14213d26;border-radius:10px; border: 1px solid #14213d30">
                                <p class="mb-0" style="color: #14213d; font-family:'poppins';">Clock Out</p>
                                <h3 class="mb-0" style="color: #14213d; font-family:'poppins';font-weight:700">
                                    @if (session()->has('check_out_time') && session('check_out_time') != '')
                                        {{ session('check_out_time') }}
                                    @else
                                        _
                                    @endif
                                </h3>
                            </div> -->
                            <div class="p-2 w-50" style="background-color: #14213d26;border-radius:10px; border: 1px solid #14213d30">
                                <p class="mb-0" style="color: #14213d; font-family:'poppins';">Clock Out</p>
                                <h3 class="mb-0" style="color: #14213d; font-family:'poppins';font-weight:700">
                                    @if (session()->has('check_out_time') && session('check_out_time') != '')
                                        {{ session('check_out_time') }}
                                    @else
                                        _
                                    @endif
                                </h3>
                            </div>
                            @if (session('error'))
                                <div style="color: red; font-family:'poppins';">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        <div class="d-flex justify-content-center align-items-center flex-column mt-3">
                            <img src="{{ url('Group6.svg') }}" alt="clock" style=" object-fit:contain; width: 50px;">
                            <h5 class="mb-0" style="color: #14213d; font-family:'Poppins'; font-weight:600">Lunch Break
                            </h5>

                            @if ($shift_emp_time == 'Morning')
                                <p class="mb-0" style="color: #14213d; font-family:'Poppins'; font-weight:300">1:15 pm -
                                    2:00 pm</p>
                            @else
                                <p class="mb-0" style="color: #14213d; font-family:'Poppins'; font-weight:300">9:30 pm -
                                    10:00 pm</p>
                            @endif

                        </div>
                        <div class="d-flex justify-content-between align-items-center gap-4 mt-2">
                            <div class="p-3 w-50 d-flex justify-content-center align-items-center flex-column">

                                @if (session()->has('total_over_time') && session('total_over_time') != '')
                                    <h3 class="mb-1" style="color: #14213d; font-family:'poppins';font-weight:700">
                                        <span>{{ session('total_over_time') }}</span>
                                    </h3>
                                    <p class="mb-0" style="color: #14213d; font-family:'poppins';">Total Over Time</p>
                                @elseif(session()->has('total_hours') && session('total_hours') != '')
                                    <h3 class="mb-1" style="color: #14213d; font-family:'poppins';font-weight:700">
                                        <span>{{ session('total_hours') }}</span>
                                    </h3>
                                    <p class="mb-0" style="color: #14213d; font-family:'poppins';">Total Hours</p>
                                @else
                                    <h3 class="mb-1" style="color: #14213d; font-family:'poppins';font-weight:700">
                                        <span id="timer" class="text-center timer">00:00:00</span>
                                    </h3>
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

                                        // Update current time immediately when the page loads
                                        updateCurrentTime();

                                        // Update current time every second
                                        setInterval(updateCurrentTime, 1000);

                                        function pad(num) {
                                            return (num < 10) ? '0' + num : num;
                                        }
                                    </script>
                                    <p class="mb-0" style="color: #14213d; font-family:'poppins';">Current Time</p>
                                @endif


                            </div>
                            <div class="p-3 w-50 d-flex justify-content-center align-items-center flex-column"
                                style="">


                                @if (session()->has('break_end_time') && session('break_end_time') != '')
                                    <h3 class="mb-1" style="color: #14213d; font-family:'poppins';font-weight:700">
                                        {{ session('break_end_time') }} </h3>
                                    <p class="mb-0" style="color: #14213d; font-family:'poppins';">Break End Time</p>
                                @elseif(session()->has('break_start_time') && session('break_start_time') != '')
                                    <h3 class="mb-1" style="color: #14213d; font-family:'poppins';font-weight:700">
                                        {{ session('break_start_time') }} </h3>
                                    <p class="mb-0" style="color: #14213d; font-family:'poppins';">Break Start Time</p>
                                @else
                                    _
                                @endif


                            </div>
                        </div>
                        <div class="punch-info d-flex flex-column align-items-center">
                            {{-- <div class="punch-hours">
                                @if (session()->has('total_over_time') && session('total_over_time') != '')
                                   <span>{{session('total_over_time')}}</span>
                                @elseif(session()->has('total_hours') && session('total_hours') != '')
                                    <span>{{ session('total_hours') }}</span>
                                @else

                                    <span id="timer" class="text-center timer">00:00:00</span>

                                @endif
                            </div> --}}



                            @if (isset($day_message) && $day_message != '')
                                <span class="text-center text-danger">{{ $day_message }}</span>
                            @endif
                            @if (isset($check_in_already_message) && $check_in_already_message != '')
                                <span class="font-text text-danger">{{ $check_in_already_message }}</span>
                            @endif
                            @if (isset($success_message) && $success_message != '')
                                <span class="text-center green-text">{{ $success_message }}</span>
                            @endif


                            {{-- <div class="break-time d-flex align-items-center justify-content-between my-3">
                                <p class="mb-0 font-size-15" >Target Working Hours</p>
                                <p class="mb-0 font-size-15" >7:00 / Day</p>
                            </div> --}}
                            @if (session()->has('attendence_status') && session('attendence_status') === true)
                                <span style="color:#3e7213;font-size:16px;"> <svg xmlns="http://www.w3.org/2000/svg"
                                        width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="#3e7213"
                                            d="M.41 13.41L6 19l1.41-1.42L1.83 12m20.41-6.42L11.66 16.17L7.5 12l-1.43 1.41L11.66 19l12-12M18 7l-1.41-1.42l-6.35 6.35l1.42 1.41z" />
                                    </svg> Attendence Marked Successfully!</span>

                                @if (session()->has('overtime_status') && session('overtime_status') === true)
                                    <span style="color:#3e7213;font-size:16px;"> <svg xmlns="http://www.w3.org/2000/svg"
                                            width="1em" height="1em" viewBox="0 0 24 24">
                                            <path fill="#3e7213"
                                                d="M.41 13.41L6 19l1.41-1.42L1.83 12m20.41-6.42L11.66 16.17L7.5 12l-1.43 1.41L11.66 19l12-12M18 7l-1.41-1.42l-6.35 6.35l1.42 1.41z" />
                                        </svg> Over time marked!</span>
                                @elseif(session()->has('show_over_time_end') && session('show_over_time_end') === false)
                                    <a class="reblateBtn px-4 py-2 w-md" style="border-radius: 10px;"
                                        href="/overtime-start">Overtime Start
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
                                @elseif(session()->has('show_over_time_end') && session('show_over_time_end') === true)
                                    <a class="reblateBtn px-4 py-2 w-md" style="border-radius: 10px;"
                                        href="/overtime-end">Overtime End
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
                            @else
                                <div class="d-flex flex-wrap justify-content-between gap-4 align-items-center">
                                    @if (session()->has('show_check_out') && session('show_check_out') === true)
                                    <a class="reblateBtn px-4 py-2 w-md" style="border-radius: 10px;"
                                            href="javascript:void()" onclick="checkOut()">Clock Out
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
                                        <a class="reblateBtn px-4 py-2" style="border-radius: 10px;"
                                            href="/check-in">Clock In
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
                                    @if (session()->has('show_break_end') && session('show_break_end') === true)
                                        <a class="reblateBtn px-4 py-2" href="/break-end">Break End
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
                                        <a class="reblateBtn px-4 py-2" style="border-radius: 10px;"
                                            href="/break-start">Break Start
                                            <svg height="20px" width="20px" version="1.1" id="Capa_1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 472.053 472.053"
                                                xml:space="preserve" fill="#000000">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <g>
                                                        <g>
                                                            <path style="fill:#fff;"
                                                                d="M181.423,12.772l-1.805,85.74c0,3.381-2.292,7.755-6.6,7.755l0,0h-2.309l0,0l0,0 c-4.308,0-6.6-4.804-6.6-8.275l-6.893-85.895c-1.764,0.008-3.568,0.008-5.454,0.008c-3.292,0-6.373-0.016-9.291-0.016 l-6.893,87.081c0.024,3.146-2.276,7.096-6.584,7.096l0,0h-2.309l0,0l0,0c-4.308,0-6.6-4.804-6.6-8.275l-1.788-84.879 c-22.866,3.601-22.858,19.647-22.858,89.935c0,23.711,9.421,44.358,26.247,55.453c2.3,1.52,4.731,2.861,7.308,4.007 c2.552,1.13,5.251,2.04,8.064,2.764l-7.73,295.571c0,6.17,13.136,11.209,19.305,11.209h10.161c6.17,0,19.305-5.023,19.305-11.193 l-7.755-296.677c2.837-0.967,5.495-2.211,8.039-3.609c3.13-1.715,6.023-3.739,8.689-6.04 c13.526-11.681,21.021-30.36,21.021-51.478C208.093,30.151,206.686,15.609,181.423,12.772z">
                                                            </path>
                                                            <path style="fill:#fff;"
                                                                d="M314.642,193.194v45.764c0,4.845,1.39,9.332,3.682,13.176c3.869-3.503,9.34-3.552,12.063-3.552 c1.967,0,4.113,0.122,6.381,0.244c2.398,0.13,4.934,0.268,7.584,0.268h2.552c2.642,0,5.186-0.146,7.584-0.268 c2.268-0.13,4.414-0.244,6.381-0.244c2.731,0,8.194,0.049,12.063,3.552c2.292-3.845,3.682-8.324,3.682-13.176V0.002 C323.787-0.713,314.642,179.278,314.642,193.194z">
                                                            </path>
                                                            <path style="fill:#fff;"
                                                                d="M360.869,256.711c-1.837,0-3.829,0.114-5.934,0.228c-2.536,0.146-5.235,0.285-8.023,0.285h-2.561 c-2.796,0-5.495-0.146-8.023-0.285c-2.113-0.122-4.105-0.228-5.934-0.228c-3.471,0-5.576,0.325-6.804,1.609 c-1.032,1.081-1.447,2.829-1.447,5.739v180.836c0,12.729,9.966,23.093,22.207,23.093h2.552c12.25,0,22.207-10.356,22.207-23.093 V264.059c0-2.91-0.423-4.658-1.447-5.739C366.445,257.036,364.348,256.711,360.869,256.711z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            @endif
                            <div class="view-class-more mt-2">
                                <a href="/view-attendence" style="color:#fca311;">View Attendence</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row" style="position: relative; margin-top:40px;">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card" style="box-shadow: none;">
                    <div class="card-body bg-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="EmpNameStyle" style="color: #14213d; font-weight:800">On Going Projects</h1>
                            <div class="d-flex gap-3">
                                <div class="p-2 rounded-pill" style="background-color: #14213d">
                                    <svg width="20px" height="20px" viewBox="0 0 1024 1024" class="icon"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#fff" stroke="#fff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M768 903.232l-50.432 56.768L256 512l461.568-448 50.432 56.768L364.928 512z"
                                                fill="#fff"></path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="p-2 rounded-pill" style="background-color: #14213d;">
                                    <svg width="20px" height="20px" viewBox="0 0 1024 1024" class="icon"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M256 120.768L306.432 64 768 512l-461.568 448L256 903.232 659.072 512z"
                                                fill="#fff"></path>
                                        </g>
                                    </svg>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="row " style="margin-top:40px;">
            <div class="col-md-6 col-lg-6 col-xl-6">
                <div class="card" style="box-shadow: none;">
                    <div class="card-body" style="background-color: #fca311">
                        <h1 class="EmpNameStyle" style="color: #14213d; font-weight:800">UpComing Holidays</h1>
                        <div class="d-flex align-items-start gap-2 my-5">
                            <svg fill="#fff" width="65px" height="65px" viewBox="0 0 1024 1024"
                                xmlns="http://www.w3.org/2000/svg" stroke="#fff">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M960 95.888l-256.224.001V32.113c0-17.68-14.32-32-32-32s-32 14.32-32 32v63.76h-256v-63.76c0-17.68-14.32-32-32-32s-32 14.32-32 32v63.76H64c-35.344 0-64 28.656-64 64v800c0 35.343 28.656 64 64 64h896c35.344 0 64-28.657 64-64v-800c0-35.329-28.656-63.985-64-63.985zm0 863.985H64v-800h255.776v32.24c0 17.679 14.32 32 32 32s32-14.321 32-32v-32.224h256v32.24c0 17.68 14.32 32 32 32s32-14.32 32-32v-32.24H960v799.984zM736 511.888h64c17.664 0 32-14.336 32-32v-64c0-17.664-14.336-32-32-32h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32zm0 255.984h64c17.664 0 32-14.32 32-32v-64c0-17.664-14.336-32-32-32h-64c-17.664 0-32 14.336-32 32v64c0 17.696 14.336 32 32 32zm-192-128h-64c-17.664 0-32 14.336-32 32v64c0 17.68 14.336 32 32 32h64c17.664 0 32-14.32 32-32v-64c0-17.648-14.336-32-32-32zm0-255.984h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32h64c17.664 0 32-14.336 32-32v-64c0-17.68-14.336-32-32-32zm-256 0h-64c-17.664 0-32 14.336-32 32v64c0 17.664 14.336 32 32 32h64c17.664 0 32-14.336 32-32v-64c0-17.68-14.336-32-32-32zm0 255.984h-64c-17.664 0-32 14.336-32 32v64c0 17.68 14.336 32 32 32h64c17.664 0 32-14.32 32-32v-64c0-17.648-14.336-32-32-32z">
                                    </path>
                                </g>
                            </svg>

                            @if (isset($holidays) && $holidays->isNotEmpty())
                                <div class="d-flex flex-column">
                                    @foreach ($holidays as $holiday)
                                        <h1 class="EmpNameStyle mb-0" style="font-weight: 800">
                                            {{ $holiday->holiday_type }}</h1>
                                        <h3 class="mb-0 EmpStyle text-white font-size-25">
                                            @if (\Carbon\Carbon::parse($holiday->startDate)->eq(\Carbon\Carbon::parse($holiday->endDate)))
                                                {{ \Carbon\Carbon::parse($holiday->startDate)->format('d F Y') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($holiday->startDate)->format('d F Y') }} -
                                                {{ \Carbon\Carbon::parse($holiday->endDate)->format('d F Y') }}
                                            @endif
                                            ({{ $holiday->total_days <= 1 ? $holiday->total_days . ' day' : $holiday->total_days . ' days' }})
                                        </h3>
                                    @endforeach
                                </div>
                            @else
                                <div class="d-flex flex-column">
                                    <h1 class="EmpNameStyle mb-0" style="font-weight: 800">No Holidays</h1>
                                    <h3 class="mb-0 EmpStyle text-white font-size-25"></h3>
                                </div>
                            @endif



                        </div>
                        <div class="mt-3 text-end">

                            <a href="{{ route('vacations.index') }}" class="reblateBtn px-4 py-2 rounded"
                                style="background-color: #14213d; color: #fff">
                                View All
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6">
                <div class="card" style="box-shadow: none;">
                    <div class="card-body bg-white pb-0">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h1 class="EmpNameStyle" style="color: #14213d; font-weight:800">Company Policy</h1>
                            <div class="d-flex gap-3">
                                <a class="p-2 rounded-pill" style="background-color: #14213d"
                                    href="#carouselExampleIndicators2" role="button" data-slide="prev">
                                    <svg width="20px" height="20px" viewBox="0 0 1024 1024" class="icon"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#fff" stroke="#fff">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M768 903.232l-50.432 56.768L256 512l461.568-448 50.432 56.768L364.928 512z"
                                                fill="#fff"></path>
                                        </g>
                                    </svg>
                                </a>
                                <a class="p-2 rounded-pill" style="background-color: #14213d;"
                                    href="#carouselExampleIndicators2" role="button" data-slide="next">
                                    <svg width="20px" height="20px" viewBox="0 0 1024 1024" class="icon"
                                        version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M256 120.768L306.432 64 768 512l-461.568 448L256 903.232 659.072 512z"
                                                fill="#fff"></path>
                                        </g>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="w-100 mb-2">
                            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">

                                <div class="carousel-inner">
                                    <div class="carousel-item active" style="border-bottom: none">
                                        <div class="row">

                                            <div class="col-md-6">
                                                @foreach ($files as $file)
                                                    <div class="card" style="box-shadow: none">
                                                        <a href="/view-page/{{ $file->file_id }}">
                                                            <div class="card-body" style="background-color: #AA336A30">
                                                                <div class="d-flex align-items-center text-start gap-2">
                                                                    <span class="p-2 rounded-pill mb-0 font-size-15"
                                                                        style="background-color: #AA336A40; color:#AA336A;font-weight: 600">Policy
                                                                        Page</span>
                                                                    <h5 class="mb-0 EmpStyle"
                                                                        style="color: #14213d; font-size:14px;font-weight: 600">
                                                                        {{ $file->file_type }}</h5>
                                                                </div>
                                                                <div class="mt-2">
                                                                    <div
                                                                        class="d-flex align-items-center text-start gap-2">
                                                                        <span
                                                                            style="font-family: 'Poppins'; font-weight:500; color:#14213d">Policy
                                                                            Name:</span>
                                                                        <span
                                                                            style="font-family: 'Poppins'; font-weight:500; color:#14213d">{{ $file->file_name }}</span>
                                                                    </div>
                                                                    <div>
                                                                        <span
                                                                            style="font-family: 'Poppins'; font-weight:500; color:#14213d">Updated
                                                                            On:</span>
                                                                        <span
                                                                            style="font-family: 'Poppins'; font-weight:500; color:#14213d">{{ $file->created_at }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="text-end">

                                                                </div>

                                                            </div>
                                                        </a>

                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>




        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card" style="box-shadow: none">
                    <div class="card-body bg-white">
                        <h1 class="EmpNameStyle" style="color: #14213d; font-weight:800">Last Month Performance Indicators
                        </h1>
                        <div class="row mt-4 justify-content-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <div class="card" style="box-shadow: none">
                                    <div class="card-body" style="background-color: #fca311">
                                        <div class="d-flex flex-column">
                                            <h4 class="EmpStyle" style="color: #14213d; font-weight:800">Attendence <br>
                                                Rate</h4>
                                            <div class="progress mt-3 text-center" role="progressbar"
                                                aria-label="Example with label"
                                                style="height: 30px; border-radius:50px; border:1px solid #14213d; background-color: #fff"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <span
                                                    style="position: absolute;width: 80%;text-align: center;background-color: transparent;
                                               color:#000; font-weight:700;font-size:15px; font-family:'Poppins';bottom: 18px;">
                                                    {{ $total_attendence_rate }}%</span>
                                                <div class="progress-bar"
                                                    style="width: {{ $total_attendence_rate }}%; background-color: #fca31150; color:#000; font-weight:700;font-size:15px; font-family:'Poppins'">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <div class="card" style="box-shadow: none">
                                    <div class="card-body" style="background-color: #fca311">
                                        <div class="d-flex flex-column">
                                            <h4 class="EmpStyle" style="color: #14213d; font-weight:800">Work <br>Progress
                                            </h4>
                                            <div class="progress mt-3" role="progressbar" aria-label="Example with label"
                                                style="height: 30px; border-radius:50px; border:1px solid #14213d; background-color: #fff"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">

                                                <div class="progress-bar"
                                                    style="width: 50%; background-color: #fca31150; color:#000; font-weight:700;font-size:15px; font-family:'Poppins'">
                                                    50%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <div class="card" style="box-shadow: none">
                                    <div class="card-body" style="background-color: #fca311">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h4 class="EmpStyle" style="color: #14213d; font-weight:800">Overtime</h4>
                                            <div class="w-100 d-flex justify-content-center" style="margin:20px 0">
                                                <div class="w-75 text-center" style="background-color: #14213d;">
                                                    <span class="text-white font-size-18">03:50:00</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <div class="card" style="box-shadow: none">
                                    <div class="card-body" style="background-color: #fca311">
                                        <div class="d-flex flex-column">
                                            <h4 class="EmpStyle" style="color: #14213d; font-weight:800">Professional
                                                <br>Growth
                                            </h4>
                                            <div class="progress mt-3" role="progressbar" aria-label="Example with label"
                                                style="height: 30px; border-radius:50px; border:1px solid #14213d; background-color: #fff"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <span
                                                    style="position: absolute;width: 80%;text-align: center;background-color: transparent;
                                               color:#000; font-weight:700;font-size:15px; font-family:'Poppins';bottom: 18px;">
                                                    {{ $professional_growth }}%</span>
                                                <div class="progress-bar"
                                                    style="width: {{ $professional_growth }}%; background-color: #fca31150; color:#000; font-weight:700;font-size:15px; font-family:'Poppins'">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <div class="card" style="box-shadow: none">
                                    <div class="card-body" style="background-color: #fca311">
                                        <div class="d-flex flex-column">
                                            <h4 class="EmpStyle" style="color: #14213d; font-weight:800">Overall <br>
                                                Assesment</h4>
                                            <div class="progress mt-3" role="progressbar" aria-label="Example with label"
                                                style="height: 30px; border-radius:50px; border:1px solid #14213d; background-color: #fff"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <span
                                                    style="position: absolute;width: 80%;text-align: center;background-color: transparent;
                                               color:#000; font-weight:700;font-size:15px; font-family:'Poppins';bottom: 18px;">
                                                    {{ $over_all_performance }}%</span>
                                                <div class="progress-bar"
                                                    style="width: {{ $over_all_performance }}%; background-color: #fca31150; color:#000; font-weight:700;font-size:15px; font-family:'Poppins'">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>


        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.getElementById('todoForm').addEventListener('submit', function(event) {
                event.preventDefault();

                const title = document.getElementById('taskTitle').value;
                const description = document.getElementById('taskDescription').value;

                if (title && description) {
                    addTask(title, description);
                    document.getElementById('taskTitle').value = '';
                    document.getElementById('taskDescription').value = '';
                } else {
                    alert('Please fill out both fields');
                }
            });

            function addTask(title, description) {
                const li = document.createElement('li');
                const h3 = document.createElement('h3');
                h3.textContent = title;
                const p = document.createElement('p');
                p.textContent = description;
                const small = document.createElement('small');
                const now = new Date();
                small.textContent = `Added on: ${now.toLocaleDateString(undefined, options)}`;

                li.appendChild(h3);
                li.appendChild(p);
                li.appendChild(small);
                document.getElementById('todoList').appendChild(li);
            }

            function openLeaveModal() {

                const popupButton = document.getElementById('popupButton');
                const popup = document.getElementById('popup_leave');
                const closeBtn = document.querySelector('.closeBtn');
                popup.style.display = 'block';

            }

            function closeLeaveModal() {
                const popup = document.getElementById('popup_leave');
                popup.style.display = 'none';
            }

            // document.addEventListener('DOMContentLoaded', function() {

            //     alert(popupButton);

            //     popupButton.addEventListener('click', function() {
            //         popup.style.display = 'block';
            //     });

            //     closeBtn.addEventListener('click', function() {
            //         popup.style.display = 'none';
            //     });

            //     window.addEventListener('click', function(e) {

            //     });
            // });

            const chartDiv = document.getElementById('chartDiv');

            new Chart(chartDiv, {
                type: 'bar',
                data: {
                    labels: ['Presents', 'Absents', 'Leaves'],
                    datasets: [{
                        label: 'Attendance',
                        data: [<?php echo $total_present_day; ?>, <?php echo $absent_days; ?>, <?php echo $total_leaves; ?>],
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
                    labels: ['Completed', 'Pending', 'In Progress'],

                    datasets: [{
                        label: 'Tasks',
                        data: [<?php echo $completed_count; ?>, <?php echo $pending_count; ?>, <?php echo $in_progress_count; ?>],
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



            // Function to pad single digit numbers with leading zeros
            function pad(num) {
                return (num < 10) ? '0' + num : num;
            }



            function updateCharCount() {
                var textarea = document.getElementById("reason");
                var charCountSpan = document.getElementById("charCount");
                var maxLength = 200;
                var currentCount = textarea.value.length;

                if (currentCount > maxLength) {
                    textarea.value = textarea.value.slice(0, maxLength); // Truncate the text
                    currentCount = maxLength; // Update current count
                }

                charCountSpan.textContent = currentCount;
            }

            function submitForm(event) {
                event.preventDefault();

                var leave_title = document.getElementById('leave_title');
                var Ending_date = document.getElementById('Ending_date');
                var Starting_date = document.getElementById('date');
                var reason = document.getElementById('reason');
                var messageBox = document.getElementById('messageBox');




                if (leave_title.value === '') {
                    messageBox.style.display = "block";
                    messageBox.style.color = "red";
                    messageBox.innerHTML = "Please Write Leave Title!";
                    return;
                } else {
                    messageBox.style.display = "none";
                }

                if (Starting_date.value === '') {
                    messageBox.style.display = "block";
                    messageBox.style.color = "red";
                    messageBox.innerHTML = "Please Select Start Date!";
                    return;
                } else {
                    messageBox.style.display = "none";
                }

                if (Ending_date.value === '') {
                    messageBox.style.display = "block";
                    messageBox.style.color = "red";
                    messageBox.innerHTML = "Please Select Ending Date!";
                    return;
                } else {
                    messageBox.style.display = "none";
                }

                if (reason.value === '') {
                    messageBox.style.display = "block";
                    messageBox.style.color = "red";
                    messageBox.innerHTML = "Please Write A Short Reason!";
                    return;
                } else {
                    messageBox.style.display = "none";
                }

                var formData = new FormData();
                formData.append('leave_title', leave_title.value);
                formData.append('Ending_date', Ending_date.value);
                formData.append('date', Starting_date.value);
                formData.append('reason', reason.value);


                // CSRF token (replace with your actual token handling logic)
                var csrfToken = "{{ csrf_token() }}";

                // AJAX request using fetch API
                fetch('/apply-for-leave', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                        },
                        body: formData // Send formData containing file and other fields
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log(data);
                        if (data.message) {
                            var form_reset_upload = document.getElementById('myForm');
                            form_reset_upload.reset();
                            var messageBox = document.getElementById('messageBox');
                            messageBox.style.display = "block";
                            messageBox.style.color = "green";
                            messageBox.innerHTML = data.message;
                        }

                    })
                    .catch(error => {
                        var messageBox = document.getElementById(
                            'messageBox'); // Ensure you have an element with id 'messageBox'
                        messageBox.style.display = "block";
                        messageBox.style.color = "red";
                        messageBox.innerHTML = error;
                    });



            }
            
            function checkOut() {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You want to clock out!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No',
                        confirmButtonColor: '#FF5733', // Red color for "Yes"
                        cancelButtonColor: '#4CAF50', // Green color for "No"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Validate daily report submission first
                            validateDailyReport();
                        }
                    });
                }

                // Function to validate the daily report submission
                function validateDailyReport() {
                    $.ajax({
                        url: '/check-out/validate-report',
                        method: 'GET',
                        success: function(response) {
                            if (response.reportSubmitted) {
                                // Daily report is submitted, now check if it's Friday
                                const currentDate = new Date();
                                const currentDay = currentDate.getDay(); // 0: Sunday, 1: Monday, ..., 5: Friday
                                
                                if (currentDay === 5) {  // If it's Friday
                                    validateWeeklyReport();
                                } else {
                                    // If it's not Friday, proceed with clock out
                                    clockOut();
                                }
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Please submit your daily report before clocking out.',
                                    icon: 'error'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while validating your daily report!',
                                icon: 'error'
                            });
                        }
                    });
                }

                // Function to validate weekly report submission if it's Friday
                function validateWeeklyReport() {
                    $.ajax({
                        url: '/check-out/validate-weekly-report',
                        method: 'GET',
                        success: function(response) {
                            if (response.weeklyReportSubmitted) {
                                // If weekly report is submitted, allow clock out
                                clockOut();
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Please submit your weekly report before clocking out on Friday.',
                                    icon: 'error'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while validating your weekly report!',
                                icon: 'error'
                            });
                        }
                    });
                }

                // Function to handle the actual clock out process
                function clockOut() {
                    $.ajax({
                        url: '/check-out/',
                        method: 'GET',
                        success: function() {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Clocked out successfully!',
                                icon: 'success'
                            }).then(() => {
                                location.reload();  // Refresh the page after successful clock out
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'An error occurred while clocking out!',
                                icon: 'error'
                            });
                        }
                    });
                }
        </script>
        <script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>

    @endsection
