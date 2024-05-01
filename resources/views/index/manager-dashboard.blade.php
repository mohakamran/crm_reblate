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

            .btn-apply {
                border: 0px;
                background: #14213d;
                color: #fff;
                padding: 7px;
                font-size: 13px;
                text-transform: uppercase;
                letter-spacing: 1.2px;
                border-radius: 7px;
                margin: 10px;
            }

            .punch-info .punch-hours {
                border: 3px solid #fca311;
               max-width: 245px;
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
        </style>


        <div class="row mt-2">
            <div class="card">
                <div class="card-body d-flex justify-content-lg-between align-items-center flex-wrap" style="gap:10px;">
                    <div class="col-md-3 d-flex align-items-center">

                        @if ($emp_det->Emp_Image != '' && file_exists($emp_det->Emp_Image) )
                            <img src="{{ $emp_det->Emp_Image }}"
                                style="width:120px;height:120px;border-radius:100%; object-fit:cover;" alt="">
                        @else
                        <img class="img-fluid rounded-circle" style="width:100px;height:100px; object-fit: cover;"
                        src="{{ url('user.png') }}">
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
            <div class="col-md-4 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:30px; color:#14213d"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M256 256a112 112 0 1 0-112-112a112 112 0 0 0 112 112m0 32c-69.42 0-208 42.88-208 128v64h416v-64c0-85.12-138.58-128-208-128" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden justify-content-between d-flex align-items-center gap-5">
                                    <p class="text-truncate font-size-18 mb-0 fw-bold">Employees</p>
                                    <h5 class="mb-0">{{ $emp_count }}
                                    </h5>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path fill="#14213d"
                                            d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z" />
                                    </svg>
                                </span>
                            </div>

                            <div class="flex-grow-1 overflow-hidden ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden justify-content-between d-flex align-items-center gap-5">
                                    <p class="text-truncate font-size-18 mb-0 fw-bold">Clients</p>
                                    <h5 class="mb-0">{{ $client_count }}</h5>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:30px; color:#14213d"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M4 21q-.825 0-1.412-.587T2 19V8q0-.825.588-1.412T4 6h4V4q0-.825.588-1.412T10 2h4q.825 0 1.413.588T16 4v2h4q.825 0 1.413.588T22 8v11q0 .825-.587 1.413T20 21zm6-15h4V4h-4z" />
                                    </svg>
                                </span>
                            </div>

                            <div class="flex-grow-1 overflow-hidden ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden justify-content-between d-flex align-items-center gap-5">
                                    <p class="text-dark text-truncate font-size-18 mb-0 fw-bold">Projects</p>
                                    <h5 class="mb-0">15 </h5>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-md-4 col-xl-4">
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


                            <div class="flex-grow-1 overflow-hidden ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden justify-content-between d-flex align-items-center gap-5">
                                    <p class="text-truncate font-size-18 mb-0 fw-bold"> Salaries</p>
                                    <h5 class="mb-0">${{ $usd_pkr_salary }}
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-4">
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

                            <div class="flex-grow-1 overflow-hidden ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden justify-content-between d-flex align-items-center gap-5">
                                    <p class="text-dark text-truncate font-size-18 mb-0 fw-bold">Expenses</p>
                                    <h5 class="mb-0">${{ $usd_pkr_expenses }} </h5>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">

                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#14213d"
                                        class="bi bi-calendar-range" viewBox="0 0 16 16">
                                        <path d="M9 7a1 1 0 0 1 1-1h5v2h-5a1 1 0 0 1-1-1M1 9h4a1 1 0 0 1 0 2H1z" />
                                        <path
                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <form action="/filter-manager-date" method="post">
@csrf
                                    <div
                                        class="flex-grow-1 overflow-hidden d-flex align-items-center justify-content-between gap-5">

                                            <input type="text" name="daterange" value="" class="form-control" />
                                            <button id="submit_dates" class="btn-apply">Apply</button>



                                    </div>
                                </form>

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
                       <div class="position-relative" style="z-index: 10">
                           <div class="d-flex justify-content-between align-items-center mb-3">
                               <h3 class=" font-size-header mb-0" style='color:#000;'>Attendance </h3>

                           </div>
                           <div class="row px-2" >
                               <div class="col-md-4 col-sm-4" style='width:33%'>
                                   <h3 style="color: #14213d;">
                                       @if (isset($total_present_day) && $total_present_day != '')
                                           {{ $total_present_day }}
                                       @else
                                           0
                                       @endif
                                   </h3>
                                   <p style="color:#14213d;font-size: 16px;">Total <br> Present</p>
                               </div>
                               <div class="col-md-4 col-sm-4" style='width:33%'>
                                   <h3 style='color:red;'>
                                       @if (isset($absent_days) && $absent_days != '')
                                           {{ $absent_days }}
                                       @else
                                           0
                                       @endif
                                   </h3>
                                   <p style="color:#14213d; font-size: 16px;">Total <br> Absent </p>
                               </div>
                               <div class="col-md-4 col-sm-4" style='width:33%'>
                                   <h3 style='color:orange;'>{{ $total_leaves }}</h3>
                                   <p style="color:#14213d; font-size: 16px;">Total <br> Leaves</p>
                               </div>
                               <div class="col-md-4 col-sm-4" style='width:33%'>
                                   <h3 style='color:red;'>0</h3>
                                   <p style="color:#14213d; font-size: 16px;">Pending <br> Approval</p>
                               </div>
                               <div class="col-md-4 col-sm-4" style='width:33%'>
                                   <h3 style='color:#14213d;'>22</h3>
                                   <p style="color:#14213d; font-size: 16px;">Working <br> Days</p>
                               </div>
                               <div class="col-md-4 col-sm-4" style='width:33%'>
                                   <h3 style='color:red;'>

                                   @if ($salary_deduct !=null && $salary_deduct>=0)
                                         {{$salary_deduct}}
                                        @else
                                         0
                                    @endif
                                   <p style="color:#14213d; font-size: 16px;">Loss of <br> Pay</p>
                                   </h3>
                               </div>
                           </div>
                       </div>
                       <div class="d-flex flex-wrap gap-4 justify-content-between">
                           <div class="w-100 d-flex justify-content-between position-relative" style="z-index: 10;">
                               <button type="button" class="reblateBtn px-3 py-2" data-toggle="modal"
                                   data-target="#exampleModal">Apply for Leave</button>
                               <a href="/leave-records" class="reblateBtn px-3 py-2">Leave Records</a>
                           </div>
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
                                                   <input type="date" class="form-control inputboxcolor"
                                                       style="border: 1px solid #ced4da;" id="date" name="date">
                                                   <span class="text-danger" id="dateBox" style="display: none">Please
                                                       Select
                                                       a date!</span>
                                               </div>
                                               <div class="form-group mt-3">
                                                   <label for="reason">Reason:</label>
                                                   <textarea class="form-control inputboxcolor" style="border: 1px solid #ced4da; resize: none; height: 100px;"
                                                       id="reason" name="reason" placeholder="Reason:" rows="5"></textarea>
                                                   <span class="text-danger" id="reasonBox" style="display: none">Please
                                                       Write a
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
                   </div>
               </div>
           </div>
           <div class="col-md-4 col-xl-4 col-sm-12">
               <div class="card">
                   <div class="card-body">
                       <div class="d-flex justify-content-between align-items-center">
                           <h3 class=" font-size-header mb-0" style='color:#000;'>Today's Activity </h3>
                       </div>
                       <div id="content">
                           <ul class="timeliner d-grid gap-3" style="grid-template-columns: 1fr 1fr; margin-left:20px; padding-bottom:5px;" >
                               <li class="event mb-1">
                                   <h4 class="mb-1" style="color: #14213d">Check In</h4>
                                   @if (session()->has('check_in_time') && session('check_in_time') != '')
                                       <p class="mb-1">{{ session('check_in_time') }}</p>
                                   @else
                                       <p class="mb-1">No Check In</p>
                                   @endif
                               </li>
                               <li class="event mb-1">
                                   <h4 class="mb-1" style="color: #14213d">Break Start</h4>
                                   @if (session()->has('break_start_time') && session('break_start_time') != '')
                                       <p class="mb-1">{{ session('break_start_time') }}</p>
                                   @else
                                       <p class="mb-1">No Break Start</p>
                                   @endif
                               </li>
                               <li class="event mb-1">
                                   <h4 class="mb-1" style="color: #14213d">Break End</h4>
                                   @if (session()->has('break_end_time') && session('break_end_time') != '')
                                       <p class="mb-1">{{ session('break_end_time') }}</p>
                                   @else
                                       <p class="mb-1">No Break End Time</p>
                                   @endif
                               </li>
                               <li class="event mb-1">
                                   <h4 class="mb-1" style="color: #14213d">Check Out</h4>
                                   @if (session()->has('check_out_time') && session('check_out_time') != '')
                                       <p class="mb-1">{{ session('check_out_time') }}</p>
                                   @else
                                       <p class="mb-1">No Checkout</p>
                                   @endif
                               </li>
                               <li class="event mb-1">
                                   <h4 class="mb-1" style="color: #14213d">Overtime <br/> Start</h4>
                                   @if (session()->has('overtime_start') && session('overtime_start') != '')
                                       <p class="mb-1">{{ session('overtime_start') }}</p>
                                   @else
                                       <p class="mb-1">No Overtime Start</p>
                                   @endif
                               </li>
                               <li class="event mb-1">
                                   <h4 class="mb-1" style="color: #14213d">Overtime <br/> End</h4>
                                   @if (session()->has('overtime_end') && session('overtime_end') != '')
                                       <p class="mb-1">{{ session('overtime_end') }}</p>
                                   @else
                                       <p class="mb-1">No Overtime End</p>
                                   @endif
                               </li>
                           </ul>
                       </div>
                   </div>
               </div>

           </div>
           <div class="col-md-4 col-xl-4 col-sm-12">
               <div class="card">
                   <div class="card-body" >
                       <div class="d-flex justify-content-between align-items-center mb-3">
                           <h3 class=" font-size-header mb-0" style='color:#000;'>Timesheet </h3>

                       </div>
                       <div class="punch-info">
                           <div class="punch-hours">
                               @if(session()->has('total_over_time') && session('total_over_time')!='')
                                  <span>{{session('total_over_time')}}</span>
                               @elseif(session()->has('total_hours') && session('total_hours') != '')
                                   <span>{{ session('total_hours') }}</span>
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

                           <div class="break-time d-flex align-items-center justify-content-between mb-3" style='margin-top:25px;'>
                               <p class="mb-0 font-size-15" >Target Working Hours</p>
                               <p class="mb-0 font-size-15" >7:00 / Day</p>
                           </div>
                           @if (session()->has('attendence_status') && session('attendence_status') === true)
                                   <div>
                                       <span style="color:#3e7213;font-size:16px;"> <svg xmlns="http://www.w3.org/2000/svg"
                                           width="1em" height="1em" viewBox="0 0 24 24">
                                           <path fill="#3e7213"
                                               d="M.41 13.41L6 19l1.41-1.42L1.83 12m20.41-6.42L11.66 16.17L7.5 12l-1.43 1.41L11.66 19l12-12M18 7l-1.41-1.42l-6.35 6.35l1.42 1.41z" />
                                       </svg> Attendence Marked Successfully!</span>
                                   </div>

                                   @if ( session()->has('overtime_status') && session('overtime_status') === true)
                                   <div>
                                       <span style="color:#3e7213;font-size:16px;"> <svg xmlns="http://www.w3.org/2000/svg"
                                           width="1em" height="1em" viewBox="0 0 24 24">
                                           <path fill="#3e7213"
                                               d="M.41 13.41L6 19l1.41-1.42L1.83 12m20.41-6.42L11.66 16.17L7.5 12l-1.43 1.41L11.66 19l12-12M18 7l-1.41-1.42l-6.35 6.35l1.42 1.41z" />
                                       </svg> Over time marked!</span>
                                   </div>

                                       @elseif( session()->has('show_over_time_end') && session('show_over_time_end') === false)
                                       <div class="row" style="margin-top:20px;">
                                           <div class="col-md-12 d-flex justify-content-center">
                                               <a class="reblateBtn px-4 py-2 w-md" href="/overtime-start" >Overtime Start
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
                                           </div>

                                       </div>
                                       @elseif( session()->has('show_over_time_end') && session('show_over_time_end') === true)
                                       <div class="row" style="margin-top:20px;">
                                           <div class="col-md-12 d-flex justify-content-center">
                                               <a class="reblateBtn px-4 py-2 w-md" href="/overtime-end" >Overtime End
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
                                           </div>

                                   @endif



                           @else
                               <div class="d-flex flex-wrap justify-content-between gap-4 align-items-center">

                                       @if (session()->has('show_check_out') && session('show_check_out') === true)
                                           <a class="reblateBtn px-4 py-2 w-md" href="javascript:void()" onclick="checkOut()"   >Checking Out
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
                                           <a class="reblateBtn px-4 py-2" href="/check-in">Checking In
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
                                       <a class="reblateBtn px-4 py-2" href="/break-start" >BreakStart
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
                           @endif
                           <div class="view-class-more">
                               <a href="/view-attendence" style="color:#fca311;">View Attendence</a>
                           </div>


                       </div>



                   </div>
               </div>

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
                                                        <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">
                                                            {{-- {{count($latest_tasks)}} --}}
                                                            @if (count($latest_tasks) >= 1)
                                                                @foreach ($latest_tasks as $task)
                                                        <tr>
                                                            <td>{{ $task->task_title }}</td>
                                                            <td>{{ $task->task_date }}</td>
                                                            <td>
                                                                @if ($task->task_status == 'completed')
                                                                    <span
                                                                    class="badge badge-soft-success font-size-12">{{ $task->task_status }}</span>
                                                                @elseif ($task->task_status == 'in-progress')
                                                                    <span
                                                                    class="badge badge-soft-warning font-size-12">{{ $task->task_status }}</span>
                                                                @else
                                                                    <span
                                                                    class="badge badge-soft-danger font-size-12">{{ $task->task_status }}</span>

                                                                @endif
                                                                </td>
                                                            <td>{{ $task->assigned_by }}</td>
                                                            {{-- <td>{{$task->task_title}}</td> --}}
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="6" class="text-center" style="height: 175px">
                                                                <h3>No Task Assigned</h3>
                                                            </td>
                                                        </tr>
                                                        @endif
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
                            <a href="/view-clients" class=" w-md" style="color: #14213d">View All</a>
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
                            <a href="/view-clients" class=" w-md" style="color: #14213d">View All</a>
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
                            <a href="/view-clients" class=" w-md" style="color: #14213d">View All</a>
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
                            <a href="/view-clients" class=" w-md" style="color: #14213d">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const chartId = document.getElementById('chart_div');

            function checkOut() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to check out!',
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
                            url: '/check-out/',
                            method: 'GET', // Use the DELETE HTTP method
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'check out marked!',
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
                                    text: 'An error occurred while checking out the user!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }

            $(function() {
                $('input[name="daterange"]').daterangepicker({
                        opens: 'right'
                    },
                    function(start, end, label) {
                        var startDate = start.format('YYYY-MM-DD');
                        var endDate = end.format('YYYY-MM-DD');

                        // var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        // // alert(csrfToken);

                        // // AJAX request to send the selected dates to the controller
                        // $.ajax({
                        //     url: '/search-emp-details', // Update the URL to match your controller route
                        //     method: 'POST',
                        //     data: {
                        //         startDate: startDate,
                        //         endDate: endDate,
                        //         _token: csrfToken // Ensure CSRF token is included
                        //     },
                        //     success: function(response) {
                        //         // Handle success response if needed
                        //         console.log("Dates sent to controller successfully.");
                        //     },
                        //     error: function(xhr, status, error) {
                        //         // Handle error if any
                        //         console.error("Error sending dates to controller: " + error);
                        //     }
                        // });
                    });
            });



            new Chart(chartId, {
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

        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endsection
