@extends('layouts.master')
@section('title')
    File Uploads
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('body')
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
             {
                list-style-type: circle;
            }
            .formstyle{
            text-align: end;
            margin-top: 50px;
            }

            .EmpStyle {
                font-size: 18px;
                color: #fca311;
                font-family: 'Poppins';
                font-weight: 300
            }

            .badge {
                background-color: #179109;
                color: white;
                padding: 4px 6px;
                border-radius: 13px;
                margin-left: 20px;
            }
            .badgeTotalSalary{
                background-color: #fca311;
                color: white;
                padding: 0px 8px;
                border-radius: 28px;
                margin-left: -30px;
                margin-top: 19px;
            }
            .Greenbadge{
                background-color: #179109;
                color: white;
                padding: 4px 6px;
                border-radius: 13px;
                margin-left: 190px;
            }
            .badgeRed{
                background-color: red;
                color: white;
                padding: 4px 5px;
                border-radius: 13px;
                margin-left: 50px;
                font-size: 13px;
            }
            .badgeRedmetric{
                background-color: red;
                color: white;
                padding: 4px 5px;
                border-radius: 13px;
                margin-left: 50px;
                font-size: 13px;
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

            #todoList {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
                justify-content: center;
            }

            #todoList li {
                background-color: #14213d26;
                padding: 10px;
                border-radius: 10px;
            }

            #todoList li h3 {
                color: #14213d;
                font-size: 18px;
                font-family: 'Poppins'
            }

            #todoList li p {
                color: #14213d;
                font-size: 15px;
                font-family: 'Poppins';
                margin-bottom: 0;
            }
            .dateSet{
                text-align: end;
                /* margin-top: -31px; */
                /* margin-left: 13px; */
                margin: -34px -199px 0px 0px;
                color: white;
            }
        </style>

        <div class="row mt-2">
            <div class="card px-0">
                <div class="card-body flex-wrap" style="background-color: #14213d;min-height:270px">
                    <div class="col-md-6 col-lg-6 col-xl-6 gap-3 d-flex align-items-center flex-wrap p-2">
                        <div class="welcome-det ms-3 text-dark fw-bolder">
                            <h2 class="EmpNameStyle">
                                <H4 class="text-white">Total Salary</H4>
                            </h2>
                            <div class="d-flex justify-content-between align-items-center gap-5">
                                <h3 class="mb-0 EmpStyle" style="color:#fca311;font-size:60px;font-weight:600">${{ $usd_pkr_salary }}
                                </h3>
                                <span class="badgeTotalSalary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256" style="font-size: 18px;">
                                    <path fill="currentColor" d="M198 64v104a6 6 0 0 1-12 0V78.48L68.24 196.24a6 6 0 0 1-8.48-8.48L177.52 70H88a6 6 0 0 1 0-12h104a6 6 0 0 1 6 6"/></svg> 
                                    16 %</span>
                            </div>
                            <p class="dateSet">{{ $formattedStartDate }} - {{ $formattedEndDate }}</p>
                        </div>
                    </div>
                    
                    <div class="position-absolute p-2"
                        style="top:75px;right: 20px; border:1px solid #fca311; border-radius:10px">
                        <span style="color:#fff; font-size: 15px;font-weight: 300; font-family: 'Poppins';">
                        <select class="custom-select custom-select-lg mb-3" style="background:transparent; color:white;border:none;margin-bottom: 0rem !important;">
                            <option selected>Select Employee</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        </span>
                    </div>
                    <div class="position-absolute p-2"
                        style="top:75px;right: 190px; border:1px solid #fca311; border-radius:10px">
                        <span style="color:#fff; font-size: 15px;font-weight: 300; font-family: 'Poppins';">
                        <select class="custom-select custom-select-lg mb-3" style="background:transparent; color:white;border:none;margin-bottom: 0rem !important;">
                            <option selected>Select Month</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        </span>
                    </div>
                    
                </div>
            </div>

        </div>
        <div class="row flex-wrap" style="position: relative; top:-125px;">
            <div id="popupButton">
                <!-- <button type="button" class="position-absolute reblateBtn px-3 py-1 text-white"
                    style="background-color: #fca311; right: 35px; top:-45px;"> Apply for Leave</button> -->
                <div class="popup" id="popup">
                    <div class="popup-content flex-column">
                        <div class="d-flex mb-3 align-items-center justify-content-between">
                            <h2 class="mb-0"
                                style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                Appy For Leaves</h2>
                            <span class="closeBtn p-2" style="border-radius: 50%; background-color:#14213d26">
                                {{-- <svg
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#14213d50"
                                    class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path
                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                </svg> --}}
                            </span>
                        </div>
                        <form id="myForm" action="" method = "POST" class="text-start">
                            <div id="messageBox" style="font-size: 16px;" class="mt-2 mb-2"></div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 col-xl-12">

                                    <div class="form-group">
                                        <label class="EmpStyle font-size-14 fw-bolder" style="color:#14213d;"
                                            for="date">Leave Title <span style="color:red">*</span></label>
                                        <div class="d-flex"
                                            style="border: 1px solid #14213d;border-radius: 50px;padding: 10px;background-color: white;">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                        stroke="#9e9e9e" stroke-width="2" stroke-linecap="round"></path>
                                                    <rect x="6" y="12" width="3" height="3" rx="0.5"
                                                        fill="#9e9e9e"></rect>
                                                    <rect x="10.5" y="12" width="3" height="3" rx="0.5"
                                                        fill="#9e9e9e"></rect>
                                                    <rect x="15" y="12" width="3" height="3" rx="0.5"
                                                        fill="#9e9e9e"></rect>
                                                </g>
                                            </svg>
                                            <input type="text" class="form-control ms-2 p-0" style="border: none;"
                                                id="leave_title" name="leave_title" placeholder="Enter Leave Title">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-xl-6 mt-2">
                                    <div class="form-group">
                                        <label class="EmpStyle font-size-14 fw-bolder" style="color:#14213d;"
                                            for="date">Starting Date <span style="color:red">*</span></label>
                                        <div class="d-flex"
                                            style="border: 1px solid #14213d;border-radius: 50px;padding: 10px;background-color: white;">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                        stroke="#9e9e9e" stroke-width="2" stroke-linecap="round"></path>
                                                    <rect x="6" y="12" width="3" height="3" rx="0.5"
                                                        fill="#9e9e9e"></rect>
                                                    <rect x="10.5" y="12" width="3" height="3" rx="0.5"
                                                        fill="#9e9e9e"></rect>
                                                    <rect x="15" y="12" width="3" height="3" rx="0.5"
                                                        fill="#9e9e9e"></rect>
                                                </g>
                                            </svg>
                                            <input type="date" class="form-control ms-2 p-0"style="border:none;"
                                                id="date" name="date">
                                            <span class="text-danger" id="dateBox" style="display: none">Please Select
                                                a date!</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-xl-6 mt-2">
                                    <div class="form-group">
                                        <label class="EmpStyle font-size-14 fw-bolder" style="color:#14213d;"
                                            for="date">Ending Date <span style="color:red">*</span> </label>
                                        <div class="d-flex"
                                            style="border: 1px solid #14213d;border-radius: 50px;padding: 10px;background-color: white;">
                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                        stroke="#9e9e9e" stroke-width="2" stroke-linecap="round"></path>
                                                    <rect x="6" y="12" width="3" height="3" rx="0.5"
                                                        fill="#9e9e9e"></rect>
                                                    <rect x="10.5" y="12" width="3" height="3" rx="0.5"
                                                        fill="#9e9e9e"></rect>
                                                    <rect x="15" y="12" width="3" height="3" rx="0.5"
                                                        fill="#9e9e9e"></rect>
                                                </g>
                                            </svg>
                                            <input type="date" class="form-control ms-2 p-0"style="border:none;"
                                                id="Ending_date" name="Ending_date">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group mt-2">
                                <label class="EmpStyle font-size-14 fw-bolder" style="color:#14213d;"
                                    for="reason">Reason <span style="color:red">*</span> </label>
                                <textarea class="form-control inputboxcolor p-2 bg-white"
                                    style="border: 1px solid #14213d; resize: none; height: 100px;" id="reason" name="reason"
                                    oninput="updateCharCount()" placeholder="Write Reason within 200 characters" rows="5"></textarea>
                                <div class="char-count">
                                    <span id="charCount">0</span> / 200 characters
                                </div>

                            </div>

                        </form>
                        <div class="mt-2 text-start">
                            <button class="px-4 py-2 reblateBtn" type="submit"
                                onclick="submitForm(event)">Apply</button>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-3 col-lg-3 col-xl-3">
                <a href="/view-attendence">
                    <div class="card" style="border-radius:10px;">
                        <div class="card-body" style="background-color: #fca311">
                            <div class="d-flex align-items-start flex-column">
                                <div class="rounded-pill mb-3" style="padding: 10px;background-color: #14213d">
                                    <img src="{{ url('Group1.svg') }}"
                                        style="width:23px; height:23px; object-fit:contain;margin-left:2px"
                                        alt="User Icon Reblate Solutions">
                                </div>
                                <p class="mb-1 EmpStyle" style="color: #14213d; font-size:15px; font-weight: 600">TotalEmployees<span class="badge">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256" style="font-size: 18px;">
                                        <path fill="currentColor" d="M198 64v104a6 6 0 0 1-12 0V78.48L68.24 196.24a6 6 0 0 1-8.48-8.48L177.52 70H88a6 6 0 0 1 0-12h104a6 6 0 0 1 6 6"/></svg> 
                                        16 %</span>
                                </p>
                                <h2 class="mb-0 EmpNameStyle" style="color: #14213d; font-weight: 800">
                                   {{$TotalEmployees}}
                                </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3">
                <a href="/view-attendence">
                    <div class="card" style="border-radius:10px;">
                        <div class="card-body" style="background-color: #fca311">
                            <div class="d-flex align-items-start flex-column">
                                <div class="rounded-pill mb-3" style="padding: 10px;background-color: #14213d">
                                    <img src="{{ url('Group2.svg') }}"
                                        style="width:23px; height:23px; object-fit:contain;margin-left:2px"
                                        alt="User Icon Reblate Solutions">
                                </div>
                                <p class="mb-1 EmpStyle" style="color: #14213d; font-size:15px; font-weight: 600">Total Bonus<span class="badgeRed">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256" style="font-size: 18px;">
                                <path fill="currentColor" d="m204.24 148.24l-72 72a6 6 0 0 1-8.48 0l-72-72a6 6 0 0 1 8.48-8.48L122 201.51V40a6 6 0 0 1 12 0v161.51l61.76-61.75a6 6 0 0 1 8.48 8.48"/></svg>
                                    0.8 %</span>
                                </p>
                                <h2 class="mb-0 EmpNameStyle" style="color: #14213d; font-weight: 800">
                                   ${{$usd_pkr_salary_Bonus}}
                                </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3">
                <a href="#">
                    <div class="card" style="border-radius:10px;">
                        <div class="card-body" style="background-color: #fca311">
                            <div class="d-flex align-items-start flex-column">
                                <div class="rounded-pill mb-3" style="padding: 10px;background-color: #14213d">
                                    <img src="{{ url('Group1.svg') }}"
                                        style="width:23px; height:23px; object-fit:contain;margin-left:2px"
                                        alt="User Icon Reblate Solutions">
                                </div>
                                <p class="mb-1 EmpStyle" style="color: #14213d; font-size:15px; font-weight: 600">Net Pay<span class="badge">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256" style="font-size: 18px;">
                                    <path fill="currentColor" d="M198 64v104a6 6 0 0 1-12 0V78.48L68.24 196.24a6 6 0 0 1-8.48-8.48L177.52 70H88a6 6 0 0 1 0-12h104a6 6 0 0 1 6 6"/></svg> 
                                    11 %</span>
                                </p>
                                <h2 class="mb-0 EmpNameStyle" style="color: #14213d; font-weight: 800">
                                  ${{$usd_pkr_salary_Net}}
                                </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3">
                <a href="{{ route('leaves.record') }}">
                    <div class="card" style="border-radius:10px;">
                        <div class="card-body" style="background-color: #fca311">
                            <div class="d-flex align-items-start flex-column">
                                <div class="rounded-pill mb-3" style="padding: 10px;background-color: #14213d">
                                    <img src="{{ url('Group3.svg') }}"
                                        style="width:23px; height:23px; object-fit:contain;margin-left:2px"
                                        alt="User Icon Reblate Solutions">
                                </div>
                                <p class="mb-1 EmpStyle" style="color: #14213d; font-size:15px; font-weight: 600">Deduction Amount<span class="badgeRed">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256" style="font-size: 18px;">
                                    <path fill="currentColor" d="m204.24 148.24l-72 72a6 6 0 0 1-8.48 0l-72-72a6 6 0 0 1 8.48-8.48L122 201.51V40a6 6 0 0 1 12 0v161.51l61.76-61.75a6 6 0 0 1 8.48 8.48"/></svg>
                                    0.5 %</span>
                                </p>
                                <h2 class="mb-0 EmpNameStyle" style="color: #14213d; font-weight: 800">
                                    ${{$usd_pkr_salary_Ded}}
                                </h2>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row" style="margin-top: -120px;">
                <div class="col-sm-6">
                    <h1 style="color:#14213d;font-size:40px;font-weight:600">PayRoll {{$formattedPayRoll}}</h1>
                    <p style="font-size:25px;">Employees Payroll</p>
                </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card" style="box-shadow: none">
                    <div class="card-body bg-white">
                    <table id="datatable-buttons" class="table dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr style="background-color: #14213d">
                                    <th class="borderingLeftTable font-size-17" style="color: white">Name</th>
                                    <th class="font-size-17" style="color: white">Employee Code</th>
                                    <th class="font-size-17" style="color: white">Designation</th>
                                    <th class="font-size-17" style="color: white">Date of Join</th>
                                    <th class="borderingRightTable font-size-17" style="color: white">Status</th>
                                    <th class="borderingRightTable font-size-17" style="color: white">Sallary</th>
                                    <th class="borderingRightTable font-size-17" style="color: white">Total paid Salary This Year</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach($salaryGet as $payroll)
                                    <tr>
                                        <td>{{$payroll->emp_name}}</td>
                                        <td>{{$payroll->emp_id}}</td>
                                        <td>{{$payroll->Emp_Designation}}</td>
                                        <td>{{$payroll->Emp_Joining_Date}}</td>
                                        <td>{{$payroll->Emp_Status}}</td>
                                        <td>{{$payroll->total_salary}}/-</td>
                                        <td>
                                            @foreach ($salarysGet as $salary)
                                                @if ($salary->Emp_Code == $payroll->emp_id)
                                                    {{ $salary->total_salary }}
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card" style="width: 25rem; background:white;border-radius:15px;height:97%">
                            <div class="card-body">
                                <h5 class="card-title" style="color:#14213d; font-size:25px;font-weight:600;">Employees</h5>
                                <canvas id="myChartbar" style="width:100%;max-width:600px"></canvas>
                                <div class="row" style="margin-top:50px;">
                                    <div class="col-sm-4">
                                            <h5><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32" style="color:#fca311;"><circle cx="16" cy="16" r="8" fill="currentColor"/></svg>Full Time</h5>
                                            <p style="margin-left:20px;font-weight:bold;font-size:20px;color:black;">(110)</p>
                                    </div>
                                    <div class="col-sm-4">
                                            <h5><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32" style="color:#f88fff;"><circle cx="16" cy="16" r="8" fill="currentColor"/></svg>Part Time</h5>
                                            <p style="margin-left:20px;font-weight:bold;font-size:20px;color:black;">(110)</p>
                                    </div>
                                    <div class="col-sm-4">
                                            <h5><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32" style="color:#6ec3ff;"><circle cx="16" cy="16" r="8" fill="currentColor"/></svg>InterShip</h5>
                                            <p style="margin-left:20px;font-weight:bold;font-size:20px;color:black;">(110)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card" style="width: 25rem; background:white;border-radius:15px;height:97%">
                            <div class="card-body">
                                <h5 class="card-title" style="color:#14213d; font-size:25px;font-weight:600;">Evg.KPI</h5>
                                <div class="card" style="width: 18rem;margin-top:30px;">
                                    <div class="card-body" style="background:#14213d;">
                                        <span class="Greenbadge">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256" style="font-size: 18px;">
                                        <path fill="currentColor" d="M198 64v104a6 6 0 0 1-12 0V78.48L68.24 196.24a6 6 0 0 1-8.48-8.48L177.52 70H88a6 6 0 0 1 0-12h104a6 6 0 0 1 6 6"/></svg> 
                                        11 %</span>
                                            <h1 class="card-subtitle mb-2" style="color:white;margin-top:-31px">79.98%</h1>
                                            <p class="card-subtitle mb-2"style="color:white;">Last Month: 65.30%</p>
                                    </div>
                                </div>
                                <canvas id="myChart" style="width:100%;max-width:600px;height:70%"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card" style="width: 25rem; background:white;border-radius:15px;height:97%">
                            <div class="card-body">
                                <h5 class="card-title" style="color:#14213d; font-size:25px;font-weight:600;">Base Metrics</h5>
                                <!-- <h6 class="card-subtitle mb-2 text-muted">Net Pay</h6> -->
                                <p class="card-text">Net Pay</p>
                                <p class="card-link " style="margin-top: -27px;color:#14213d; font-size:35px;font-weight:600;">%560.70k
                                <span class="badgeRedmetric">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256" style="font-size: 18px;">
                                <path fill="currentColor" d="m204.24 148.24l-72 72a6 6 0 0 1-8.48 0l-72-72a6 6 0 0 1 8.48-8.48L122 201.51V40a6 6 0 0 1 12 0v161.51l61.76-61.75a6 6 0 0 1 8.48 8.48"/></svg>
                                    0.8 %</span></p>
                                <hr style="border: 1px solid #14213d;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5 style="color:#14213d;font-size:28px;">$940.48k</h5>
                                        <p style="margin-top:-12px;">Current Month</p>
                                    </div>
                                    <div class="col-sm-6">
                                    <h5 style="color:#14213d;font-size:28px;">$1940.48k</h5>
                                    <p style="margin-top:-12px;">Previous Month</p>
                                    </div>
                                </div>
                                <div class="row" style="margin-left:10px;margin-top:40px;">
                                    <div class="card" style="width: 22rem;background:#14213d;border-radius: 14px;">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item" style="background:#14213d;color:white;line-height:70px;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 36 36" style="color:#fca311;font-size:25px;">
                                                <ellipse cx="18" cy="11.28" fill="currentColor" rx="4.76" ry="4.7"/><path fill="currentColor" d="M10.78 11.75h.48v-.43a6.7 6.7 0 0 1 3.75-6a4.62 4.62 0 1 0-4.21 6.46Zm13.98-.47v.43h.48A4.58 4.58 0 1 0 21 5.29a6.7 6.7 0 0 1 3.76 5.99m-2.47 5.17a21.5 21.5 0 0 1 5.71 2a2.7 2.7 0 0 1 .68.53H34v-3.42a.72.72 0 0 0-.38-.64a18 18 0 0 0-8.4-2.05h-.66a6.66 6.66 0 0 1-2.27 3.58M6.53 20.92A2.76 2.76 0 0 1 8 18.47a21.5 21.5 0 0 1 5.71-2a6.66 6.66 0 0 1-2.27-3.55h-.66a18 18 0 0 0-8.4 2.05a.72.72 0 0 0-.38.64V22h4.53Zm14.93 5.77h5.96v1.4h-5.96z"/>
                                            <path fill="currentColor" d="M32.81 21.26h-6.87v-1a1 1 0 0 0-2 0v1H22v-2.83a20 20 0 0 0-4-.43a19.3 19.3 0 0 0-9.06 2.22a.76.76 0 0 0-.41.68v5.61h7.11v6.09a1 1 0 0 0 1 1h16.17a1 1 0 0 0 1-1V22.26a1 1 0 0 0-1-1m-1 10.36H17.64v-8.36h6.3v.91a1 1 0 0 0 2 0v-.91h5.87Z"/></svg>
                                               <span style="font-size:19px;font-weight:600;">&nbsp;&nbsp;15&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total Departments</span></li>
                                               <li class="list-group-item" style="background:#14213d;color:white;line-height:70px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 1024 1024" style="color:#fca311;font-size:25px;"><path fill="currentColor" d="M839.2 278.1a32 32 0 0 0-30.4-22.1H736V144c0-17.7-14.3-32-32-32H320c-17.7 0-32 14.3-32 32v112h-72.8a31.9 31.9 0 0 0-30.4 22.1L112 502v378c0 17.7 14.3 32 32 32h736c17.7 0 32-14.3 32-32V502zM660 628c0 4.4-3.6 8-8 8H544v108c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V636H372c-4.4 0-8-3.6-8-8v-48c0-4.4 3.6-8 8-8h108V464c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v108h108c4.4 0 8 3.6 8 8zm4-372H360v-72h304z"/></svg>
                                               <!-- <span style="font-size:30px;font-weight:600;">19</span><p></p> -->
                                               <span style="font-size:20px;font-weight:600;">&nbsp;&nbsp;19&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Avg. Sick Day</span></li>
                                            
                                            </li>
                                               <li class="list-group-item" style="background:#14213d;color:white;line-height:70px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" style="color:#fca311;font-size:25px;"><path fill="none" stroke="currentColor" stroke-width="2" d="M4.998 9V1H19.5L23 4.5V23H4M18 1v5h5M3 19l5-5l4 4l6.5-6.5M19 17v-6h-6"/></svg>
                                               <span style="font-size:20px;font-weight:600;">&nbsp;&nbsp;19&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Performance Score</span></li>
                                            
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
     

        <!-- END ROW -->


        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.min.js" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <script>
            const xValues = [50,60,70,80,90,100,110,120,130,140,150];
            const yValues = [7,8,8,9,9,9,10,11,14,14,15];

                    new Chart("myChart", {
                    type: "line",
                    data: {
                        labels: xValues,
                        datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,1.0)",
                        borderColor: "rgba(0,0,255,0.1)",
                        data: yValues
                        }]
                    },
                    options: {
                        legend: {display: false},
                        scales: {
                        yAxes: [{ticks: {min: 6, max:16}}],
                        }
                    }
                    });
            $(document).ready(function() {

                // Open modal
                $('a[data-toggle="modal"]').click(function() {
                    var target = $(this).attr('data-target');
                    $(target).addClass('show').attr('aria-hidden', 'false');
                    $('body').addClass('modal-open');
                });

                // Close modal
                $('.modal .close, .modal .btn-close').click(function() {
                    $(this).closest('.modal').removeClass('show').attr('aria-hidden', 'true');
                    $('body').removeClass('modal-open');
                });
            });

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
            });

            $(function() {
                $('input[name="daterange"]').daterangepicker({
                        opens: 'right',
                        isInvalidDate: function(date) {
                            // Disable Saturdays and Sundays
                            return (date.day() === 0 || date.day() === 6);
                        }
                    },
                    function(start, end, label) {
                        var startDate = start.format('YYYY-MM-DD');
                        var endDate = end.format('YYYY-MM-DD');
                    });
            });

            function delFile(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'file will be deleted!',
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
                            url: '/delete-help-file/' + id,
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



            function setOfficeHolidays() {



                var holiday_dates = document.getElementById('holiday_dates').value;
                var holiday_type = document.getElementById('holiday_type').value;

                var holiday_description = document.getElementById('holiday_description').value;


                var holiday_date_message = document.getElementById('holiday_date_message');
                var holiday_type_message = document.getElementById('holiday_type_message');
                // var holiday_desc_message = document.getElementById('holiday_desc_message');

                var datesArray = holiday_dates.split(' - ');


                if (holiday_dates == "") {
                    holiday_date_message.style.display = "block";
                    holiday_date_message.innerHTML = "Please Select Date!";
                    return;
                } else {
                    holiday_date_message.style.display = "none";
                }

                if (holiday_type == "") {
                    holiday_type_message.style.display = "block";
                    holiday_type_message.innerHTML = "required!";
                    return;
                } else {
                    holiday_type_message.style.display = "none";
                }

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var startDate = datesArray[0];
                var endDate = datesArray[1];

                var formData = {
                    _token: csrfToken,
                    holiday_type: holiday_type,
                    holiday_description: holiday_description,
                    startDate: startDate,
                    endDate: endDate
                };

                // console.log(formData);



                var success_message_id = document.getElementById('success_message_id');
                var error_message_id = document.getElementById('error_message_id');

                error_message_id.style.display = "none";
                success_message_id.style.display = "none";

                // AJAX call to send data to the Laravel controller
                $.ajax({
                    url: '/create-holidays', // The Laravel route
                    type: 'POST', // POST request
                    data: formData,
                    success: function(response) {
                        // Show success message
                        // console.log('Response');

                        if (error_message_id.style.display == "block") {
                            error_message_id.style.display == "none";
                        }
                        success_message_id.style.display = "block";


                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400) {
                            if (success_message_id.style.display == "block") {
                                success_message_id.style.display == "none";
                            }
                            error_message_id.style.display = "block";
                        }
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Add CSRF token to request headers
                    }
                });

                return false; // Prevent form submission if within a form
            }

            //update
            function updateOfficeHolidays(id) {
                var holiday_id = 'holiday_dates_' + id;
                var holiday_type_id = 'holiday_type_' + id;
                var holiday_des_id = 'holiday_description_' + id;
                var holiday_date_message_id = 'holiday_date_message_' + id;
                // console.log(holiday_date_message);
                var holiday_type_message_id = 'holiday_type_message_' + id;



                var holiday_dates = document.getElementById(holiday_id).value;
                var holiday_type = document.getElementById(holiday_type_id).value;

                var holiday_description = document.getElementById(holiday_des_id).value;


                var holiday_date_message = document.getElementById(holiday_date_message_id);
                var holiday_type_message = document.getElementById(holiday_type_message_id);

                // var holiday_desc_message = document.getElementById('holiday_desc_message');

                var datesArray = holiday_dates.split(' - ');

                if (holiday_type == "") {
                    holiday_type_message.style.display = "block";
                    holiday_type_message.innerHTML = "required!";
                    return;
                } else {
                    holiday_type_message.style.display = "none";
                }



                if (holiday_dates == "") {
                    holiday_date_message.style.display = "block";
                    holiday_date_message.innerHTML = "Please Select Date!";
                    return;
                } else {
                    holiday_date_message.style.display = "none";
                }



                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var startDate = datesArray[0];
                var endDate = datesArray[1];

                var formData = {
                    id: id,
                    _token: csrfToken,
                    holiday_type: holiday_type,
                    holiday_description: holiday_description,
                    startDate: startDate,
                    endDate: endDate,
                    status: 'update'
                };




                var success_message_id_id = 'success_message_id_' + id;
                var error_message_id_id = 'error_message_id_' + id;
                var success_message_id = document.getElementById(success_message_id_id);
                var error_message_id = document.getElementById(error_message_id_id);

                error_message_id.style.display = "none";
                success_message_id.style.display = "none";

                // AJAX call to send data to the Laravel controller
                $.ajax({
                    url: '/update-holidays', // The Laravel route
                    type: 'POST', // POST request
                    data: formData,
                    success: function(response) {
                        // Show success message
                        // console.log('Response');

                        if (error_message_id.style.display == "block") {
                            error_message_id.style.display == "none";
                        }
                        success_message_id.style.display = "block";


                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400) {
                            if (success_message_id.style.display == "block") {
                                success_message_id.style.display == "none";
                            }
                            error_message_id.style.display = "block";
                        }
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Add CSRF token to request headers
                    }
                });

                return false; // Prevent form submission if within a form
            }
            function saveFile(event) {
                event.preventDefault();

                var file_name = document.getElementById('file_name').value;
                var file_shift = document.getElementById('file_shift').value;
                var file_policy = document.getElementById('file_policy').value;
                var description = document.getElementById('description').value;
                var fileInput = document.getElementById('file-input');
                var error = document.getElementById('select-file');

                // Clear previous errors
                error.style.display = "none";

                // Validate file name
                if (file_name.trim() === "") {
                    error.innerHTML = "File name is required!";
                    error.style.display = "block";
                    return;
                }

                // Validate file shift
                if (file_shift.trim() === "") {
                    error.innerHTML = "Please select a shift!";
                    error.style.display = "block";
                    return;
                }

                // Validate file policy
                if (file_policy.trim() === "") {
                    error.innerHTML = "Please select a file type!";
                    error.style.display = "block";
                    return;
                }

                // Validate file input
                if (fileInput.files.length === 0) {
                    error.innerHTML = "Please select a file.";
                    error.style.display = "block";
                    return;
                }

                // Check file type
                var allowedTypes = ['application/pdf'];
                var fileType = fileInput.files[0].type;

                if (!allowedTypes.includes(fileType)) {
                    error.innerHTML = "Only PDF files are allowed.";
                    error.style.display = "block";
                    return;
                }

                // Check file size
                var maxSize = 2 * 1024 * 1024; // 2 MB in bytes
                var fileSize = fileInput.files[0].size;

                if (fileSize > maxSize) {
                    error.innerHTML = "File size exceeds the limit of 2 MB.";
                    error.style.display = "block";
                    return;
                }

                var formData = new FormData();
                 formData.append('fileInput', fileInput.files[0]); // Append file input to formData
                formData.append('file_name', file_name);
                formData.append('file_shift', file_shift);
                formData.append('file_policy', file_policy);
                formData.append('description', description);

                console.log(fileInput.files[0]);
                // CSRF token (replace with your actual token handling logic)
                var csrfToken = "{{ csrf_token() }}";

                // AJAX request using fetch API
                fetch('/save-help-file', {
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
                        // console.log(data);
                        if (data.success) {
                            var form_reset_upload = document.getElementById('form-reset-upload');
                            form_reset_upload.reset();
                            var success_message = document.getElementById('success_message_id');
                            success_message.innerHTML = "File Uploaded Successfully!";
                            success_message.style.display = "block";
                            setTimeout(function() {
                                success_message.style.display = "none";

                                document.getElementById('file-label').textContent = "Upload file here";
                            }, 5000); // 5 seconds

                        } else {
                            var error_message = document.getElementById('error_message_file');

                            error_message.innerHTML = "Something went wrong!";
                            error_message.style.display = "block";
                            setTimeout(function() {
                                error_message.style.display = "none";
                            }, 5000); // 5 seconds
                        }
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
            }
        </script>
        <script type="text/javascript">
            const xProgressBar = ["Full Time", "Half Time", "InterShip"];
            const yProgressBar = [55, 49, 44];
            const ProgressBarColors = [
            "#fca311",
            "#f88fff",
            "#6ec3ff"
            ];

            new Chart("myChartbar", {
            type: "doughnut",
            data: {
                // labels: xProgressBar,
                datasets: [{
                backgroundColor: ProgressBarColors,
                data: yProgressBar
                }]
            },
            options: {
                title: {
                display: true,
                text: "World Wide Wine Production 2018"
                }
            }
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection
    @section('scripts')
        <!-- Required datatable js -->
        <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

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
