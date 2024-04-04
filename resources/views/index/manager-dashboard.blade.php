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
                padding: 8px;

            }

            .punch-info .punch-hours {
                border: 5px solid #fca311;
                /* font-size: 20px; */
                height: 74px;
                width: 275px;
                margin: 0 auto;
                border-radius: 2%;
                position: relative;
            }



            .punch-hours span {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 19px;
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
                            <h3  style="font-size: 20px; color:#14213d">Welcome, </h3>
                            <span class="fw-bold"
                                style="font-size: 20px; color:#fca311;">{{ isset($emp_det->Emp_Full_Name) && $emp_det->Emp_Full_Name ? $emp_det->Emp_Full_Name : 'Guest' }}</span>
                        </div>

                    </div>

                    <div class="">
                        <h3 style="font-size: 20px; color:#14213d">Designation</h3>
                        <span class="fw-semibold "
                            style="color:#fca311; font-size: 20px;">{{ isset($emp_det->Emp_Designation) && $emp_det->Emp_Designation ? $emp_det->Emp_Designation : '' }}</span>
                    </div>
                    <div class="">
                        <h3 style="font-size: 20px; color:#14213d">Shift</h3>
                        <span class="fw-semibold" style="color:#fca311; font-size: 20px;">
                            {{ isset($emp_det->Emp_Shift_Time) && $emp_det->Emp_Shift_Time ? $emp_det->Emp_Shift_Time : '' }}
                        </span>

                    </div>
                    <div>
                        <h3 style="font-size: 20px; color:#14213d">Today's Date</h3>
                        <span class="" style="color:#fca311; font-size: 15px;">
                            {{ isset($t_date) ? $t_date : '' }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <div class="row" style="display: flex; flex-wrap: wrap;">
            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="#14213d"
                                            d="M320 96H192L144.6 24.9C137.5 14.2 145.1 0 157.9 0H354.1c12.8 0 20.4 14.2 13.3 24.9L320 96zM192 128H320c3.8 2.5 8.1 5.3 13 8.4C389.7 172.7 512 250.9 512 416c0 53-43 96-96 96H96c-53 0-96-43-96-96C0 250.9 122.3 172.7 179 136.4l0 0 0 0c4.8-3.1 9.2-5.9 13-8.4zm84 88c0-11-9-20-20-20s-20 9-20 20v14c-7.6 1.7-15.2 4.4-22.2 8.5c-13.9 8.3-25.9 22.8-25.8 43.9c.1 20.3 12 33.1 24.7 40.7c11 6.6 24.7 10.8 35.6 14l1.7 .5c12.6 3.8 21.8 6.8 28 10.7c5.1 3.2 5.8 5.4 5.9 8.2c.1 5-1.8 8-5.9 10.5c-5 3.1-12.9 5-21.4 4.7c-11.1-.4-21.5-3.9-35.1-8.5c-2.3-.8-4.7-1.6-7.2-2.4c-10.5-3.5-21.8 2.2-25.3 12.6s2.2 21.8 12.6 25.3c1.9 .6 4 1.3 6.1 2.1l0 0 0 0c8.3 2.9 17.9 6.2 28.2 8.4V424c0 11 9 20 20 20s20-9 20-20V410.2c8-1.7 16-4.5 23.2-9c14.3-8.9 25.1-24.1 24.8-45c-.3-20.3-11.7-33.4-24.6-41.6c-11.5-7.2-25.9-11.6-37.1-15l0 0-.7-.2c-12.8-3.9-21.9-6.7-28.3-10.5c-5.2-3.1-5.3-4.9-5.3-6.7c0-3.7 1.4-6.5 6.2-9.3c5.4-3.2 13.6-5.1 21.5-5c9.6 .1 20.2 2.2 31.2 5.2c10.7 2.8 21.6-3.5 24.5-14.2s-3.5-21.6-14.2-24.5c-6.5-1.7-13.7-3.4-21.1-4.7V216z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden justify-content-between d-flex align-items-center gap-5">
                                    <p class="text-truncate font-size-18 mb-0 fw-bold">Revenue</p>
                                    <h5 class="mb-0"> ${{$total_revenue}}
                                    </h5>
                                </div>
                                {{-- <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 2.8% Increase</span> vs last month</p> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="#14213d"
                                            d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H80c-8.8 0-16-7.2-16-16s7.2-16 16-16H448c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zM416 272a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <div
                                    class="flex-grow-1 overflow-hidden d-flex justify-content-between align-items-center gap-5 ">
                                    <p class="text-truncate font-size-18 mb-0 fw-bold"> Salaries</p>
                                    <h5 class="mb-0"> ${{$total_salary}}
                                    </h5>
                                </div>

                                {{-- <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-danger text-danger font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-bottom-left"></i> 7.8% Loss</span> vs last month</p> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="#142134"
                                        stroke="#142134">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill="#14213d"
                                                d="M268.383 22.168l-55.918 84.482 29.717 3.733c-9.22 30.13-11.095 50.878-8.885 92.12 14.138-2.23 25.56-3.025 40.586 1.39-9.877-36.84-8.844-49.427-4.88-89.768l32.622 2.277-33.242-94.234zm218.482 2.21l-108.36 30.03 20.915 25.975c-49.512 31.019-80.331 55.548-104.74 123.164 13.201-.152 28.098 2.921 44.174 9.004 5.728-44.666 33.74-76.14 79.302-108.918l19.983 24.816 48.726-104.07zm-463.574 2.31L89.17 129.173l19.084-28.711c35.554 32.44 58.145 76.33 57.308 107.43 18.568-8.696 29.927-9.527 49.735-3.778-8.105-31.203-43.577-108.722-91.639-129.103l16.57-26.037L23.292 26.687zm276.117 214.667c-5.28.12-10.21 2.415-16.937 9.594l-6.565 6.969-6.812-6.72c-7.387-7.28-13.216-9.29-19.125-9.03-5.908.26-12.855 3.367-20.625 9.656l-6.217 5.03-5.906-5.374c-8.9-8.052-16.485-10.439-23.75-10.064-5.288.274-10.775 2.266-16.25 5.75l40.966 73.69c15.454 9.451 47.034 13.006 68.75 2.062l39.594-73.344c-7.51-3.062-14.26-6.202-20.094-7.406-2.112-.437-4.07-.756-5.968-.813-.354-.01-.71-.008-1.06 0zm-89.97 96.188v.002c-18.035 12.742-32.516 34.717-38.125 66.904-5.435 31.196 3.129 52.266 18.283 66.625 15.155 14.36 37.902 21.736 61 21.436 23.1-.3 46.136-8.31 61.625-22.936 15.49-14.627 24.249-35.425 19.281-65.187-5.137-30.757-18.4-52.148-35.19-65.094-28.482 15.056-64.095 11.856-86.875-1.75z">
                                            </path>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden d-flex justify-content-between align-items-center gap-5">
                                    <p class="text-dark text-truncate font-size-18 mb-0 fw-bold">Expenses</p>
                                    <h5 class="mb-0">$ {{$usd_expenses}} </h5>
                                </div>
                                {{-- <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 4.6% Growth</span> vs last month</p> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg viewBox="0 0 512 512" id="svg2793"
                                        style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"
                                        version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:cc="http://creativecommons.org/ns#"
                                        xmlns:dc="http://purl.org/dc/elements/1.1/"
                                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                        xmlns:serif="http://www.serif.com/" xmlns:svg="http://www.w3.org/2000/svg"
                                        fill="#14213d" stroke="#14213d">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <defs id="defs2797"></defs>
                                            <g id="_03-Profit" style="display:inline"
                                                transform="translate(-2048,7.53847e-4)">
                                                <g id="g2756" transform="translate(2132.93,29.6336)">
                                                    <path
                                                        d="m 0,166.206 c 1.848,0 3.727,-0.344 5.548,-1.069 L 245.19,69.65 234.235,95.126 c -3.272,7.61 0.244,16.433 7.855,19.706 1.931,0.83 3.941,1.224 5.919,1.224 5.812,0 11.345,-3.4 13.787,-9.079 l 25.26,-58.739 c 0.019,-0.046 0.032,-0.092 0.05,-0.137 0.172,-0.41 0.33,-0.825 0.464,-1.249 0.073,-0.226 0.123,-0.455 0.184,-0.682 0.065,-0.245 0.139,-0.487 0.191,-0.735 0.056,-0.26 0.09,-0.521 0.132,-0.781 0.035,-0.222 0.078,-0.443 0.104,-0.668 0.029,-0.258 0.039,-0.515 0.054,-0.773 0.014,-0.233 0.036,-0.463 0.038,-0.696 0.003,-0.246 -0.012,-0.488 -0.02,-0.732 -0.009,-0.246 -0.012,-0.492 -0.032,-0.739 -0.021,-0.239 -0.06,-0.475 -0.091,-0.711 -0.033,-0.248 -0.059,-0.496 -0.106,-0.744 -0.048,-0.267 -0.119,-0.53 -0.183,-0.793 -0.051,-0.212 -0.092,-0.425 -0.153,-0.636 -0.136,-0.475 -0.294,-0.941 -0.478,-1.4 V 36.76 c -0.183,-0.459 -0.391,-0.908 -0.617,-1.348 -0.104,-0.2 -0.224,-0.387 -0.335,-0.581 -0.132,-0.229 -0.258,-0.463 -0.403,-0.686 -0.141,-0.219 -0.298,-0.423 -0.451,-0.633 -0.134,-0.186 -0.262,-0.376 -0.406,-0.557 -0.161,-0.201 -0.335,-0.389 -0.506,-0.582 -0.155,-0.174 -0.304,-0.354 -0.467,-0.521 -0.171,-0.176 -0.354,-0.337 -0.534,-0.504 -0.179,-0.167 -0.353,-0.339 -0.543,-0.498 -0.185,-0.157 -0.381,-0.297 -0.574,-0.444 -0.196,-0.15 -0.387,-0.305 -0.592,-0.447 -0.23,-0.158 -0.471,-0.297 -0.71,-0.442 -0.179,-0.11 -0.352,-0.227 -0.538,-0.33 -0.434,-0.24 -0.88,-0.46 -1.336,-0.656 L 220.461,3.272 C 212.854,0 204.028,3.516 200.755,11.126 c -3.273,7.61 0.244,16.433 7.854,19.706 l 25.468,10.952 -239.634,95.484 c -7.695,3.066 -11.448,11.791 -8.382,19.487 2.341,5.874 7.979,9.451 13.939,9.451"
                                                        id="path2754" style="fill-rule:nonzero"></path>
                                                </g>
                                                <g id="g2760" transform="translate(2078,242.827)">
                                                    <path
                                                        d="m 0,104.978 c 0,-9.826 7.994,-17.819 17.82,-17.819 9.826,0 17.82,7.993 17.82,17.819 V 207.489 H 0 Z M 138.79,41.869 c 0,-4.77 1.85,-9.243 5.225,-12.613 3.353,-3.358 7.826,-5.208 12.595,-5.208 4.763,0 9.232,1.85 12.602,5.226 3.365,3.359 5.218,7.832 5.218,12.595 v 165.62 h -35.64 z m 138.78,-52.88 c 0,-9.826 7.994,-17.821 17.82,-17.821 9.826,0 17.82,7.995 17.82,17.821 v 218.5 h -35.64 z m 138.79,-73.681 c 0,-9.826 7.994,-17.819 17.82,-17.819 9.826,0 17.82,7.993 17.82,17.819 v 292.181 h -35.64 z m 17.82,-47.819 c -26.368,0 -47.82,21.452 -47.82,47.819 v 292.181 h -43.15 v -218.5 c 0,-26.368 -21.452,-47.821 -47.82,-47.821 -26.368,0 -47.82,21.453 -47.82,47.821 v 218.5 H 204.43 V 41.869 c 0,-12.786 -4.98,-24.799 -14.005,-33.808 -9.02,-9.036 -21.029,-14.013 -33.815,-14.013 -12.792,0 -24.805,4.977 -33.808,13.995 -9.036,9.022 -14.012,21.035 -14.012,33.826 v 165.62 H 65.64 V 104.978 C 65.64,78.611 44.188,57.159 17.82,57.159 -8.548,57.159 -30,78.611 -30,104.978 v 117.511 c 0,8.284 6.716,15 15,15 h 482 c 8.284,0 15,-6.716 15,-15 V -84.692 c 0,-26.367 -21.452,-47.819 -47.82,-47.819"
                                                        id="path2758" style="fill-rule:nonzero"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <div
                                    class="flex-grow-1 overflow-hidden d-flex align-items-center justify-content-between gap-5">
                                    <p class="text-dark text-truncate font-size-18 mb-0 fw-bold">Profit</p>
                                    <h5 class="mb-0">  {{$total_profit}}
                                    </h5>
                                </div>
                                {{-- <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 4.6% Growth</span> vs last month</p> --}}
                            </div>
                        </div>
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
                                        <g fill="none" stroke="#14213d" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="4">
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
                                <p class="font-size-15 mb-0 flex-grow-1">{{$total_leaves}}</p>

                                <p style="position: absolute;bottom: 5px; color:gray; font-size: 12px; margin-bottom: 0;">
                                    Total Allowed leaves are 15 per year</p>
                            </div>


                        </div>
                    </div>
                </div>
                {{-- leave button  --}}
                <div class="container d-flex justify-content-between">
                    <button type="button" class="reblateBtn px-3 py-2" data-toggle="modal"
                        data-target="#exampleModal">Apply for Leave</button>
                    <a href="/leave-records" class="reblateBtn px-3 py-2">Leave Records</a>
                </div>

                {{-- apply leave modal  --}}
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <div class="col-md-4  col-sm-12">
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
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body" style="min-height: 340px;">
                        <div class="d-flex justify-content-between align-items-center ">
                            <h3 class=" font-size-header mb-0">Timesheet </h3>
                            {{-- <div id="timer" class="text-center timer">00:00:00</div> --}}
                        </div>
                        {{-- show check in time if it is done  --}}
                        {{-- @if (session()->has('check_in_time') && session('check_in_time') != '')
                                <h3 class="check_in_time">Check In Time: {{ session('check_in_time') }}</h3>
                            @endif --}}
                            <div class="punch-info" style="margin-top: 15px;">
                                <div class="punch-hours">
                                @if (session()->has('total_hours') && session('total_hours') != '')

                                       <span style="float: right;">{{ session('total_hours') }}</span>

                                @else
                                    {{-- <span>0 hrs</span> --}}

                                        <span id="timer" class="text-center timer">00:00:00</span>

                                    {{-- <div id="timer" class="text-center timer">00:00:00</div> --}}
                                @endif
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

                        <div class="break-time d-flex align-items-center justify-content-between my-3 " >
                            <p class="mb-0 font-size-15" style="margin-top:45px;">Target Working Hours</p>
                            <p class="mb-0 font-size-15" style="margin-top:45px;">7:00 / Day</p>
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
                            <a href="/view-attendence" style="color:#fca311; border-bottom:1px solid #14213d;">View
                                Attendence</a>
                        </div>


                            </div>
                        </div>



                    </div>
                </div>
                <!-- end card -->
            </div>



        </div>

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
                        <canvas id="chart_div" style="height: 200px;"></canvas>
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

                                                            <th>EMP ID</th>
                                                            <th>Employee Name</th>
                                                            <th>Task</th>
                                                            <th>Deadline</th>
                                                            <th>Status</th>
                                                            <th>Progress</th>

                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        @foreach ($latest_tasks as $task)
                                                            <tr>
                                                                <td>
                                                                    <h6>EmpID</h6>
                                                                </td>
                                                                <td>
                                                                    <h6 class="text-muted mb-0 font-size-14">Name</h6>
                                                                </td>
                                                                <td>{{ $task->task_title }}</td>
                                                                <td>
                                                                    <h6 class="text-muted mb-0 font-size-14">
                                                                        {{ $task->task_date }}</h6>
                                                                </td>
                                                                <td><span
                                                                        class="badge badge-soft-danger font-size-12">{{ $task->task_status }}</span>
                                                                </td>
                                                                <td> <span
                                                                        class="badge badge-soft-primary font-size-12">{{ $task->task_percentage }}%</span>
                                                                </td>
                                                                {{-- <td>{{$task->task_title}}</td> --}}
                                                            </tr>
                                                        @endforeach
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
                            <a href="/view-clients" class=" w-md">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
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

                                                            <th>EMP ID</th>
                                                            <th>Employee Name</th>
                                                            <th>Tasks</th>
                                                            <th>Shift</th>
                                                            <th>See Details</th>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task1</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task2</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task3</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task4</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task5</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task6</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
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
                            <a href="/view-clients" class=" w-md">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
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

                                                            <th>EMP ID</th>
                                                            <th>Employee Name</th>
                                                            <th>Tasks</th>
                                                            <th>Shift</th>
                                                            <th>See Details</th>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task1</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task2</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task3</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task4</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task5</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task6</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
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
                            <a href="/view-clients" class=" w-md">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title mb-0 flex-grow-1">Projects Reports</h4>
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

                                                            <th>EMP ID</th>
                                                            <th>Employee Name</th>
                                                            <th>Tasks</th>
                                                            <th>Shift</th>
                                                            <th>See Details</th>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task1</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task2</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task3</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task4</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task5</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task6</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
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
                            <a href="/view-clients" class=" w-md">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const chartId = document.getElementById('chart_div');

            new Chart(chartId, {
              type: 'bar',
              data: {
                labels: ['Presents', 'Absents', 'Leaves'],
                datasets: [{
                  label: 'Attendance',
                  data: [<?php echo $total_present_day; ?>, <?php echo $absent_days; ?>, <?php echo $total_leaves; ?>],
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
                  data: [<?php echo $completed_count ?>, <?php echo $pending_count ?>, <?php echo $in_progress_count ?>],
                  borderWidth: 1
                }]
              },
              options: {
                indexAxis: 'y',
              }
            });


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
