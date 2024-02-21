@extends('layouts.master')
@section('title')
    Attendence
@endsection
@section('page-title')
    Attendence
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',

                    events: [{

                            backgroundColor: '#14213D', // Background color for the event
                            textColor: 'white' // Text color for the event
                        },
                        // Add more events as needed
                    ]
                });
                calendar.render();
            });
        </script>
        <style>
            /* Customize the event colors */
            .fc-event {
                background-color: blue;
                color: white;
            }

            /* Customize the current day cell color */
            .fc-day-today {
                background-color: green;
                color: white;
            }

            table tr,
            td {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            #clockContainer {
                position: relative;
                margin: auto;
                height: 40vw;
                /*to make the height and width responsive*/
                width: 40vw;
                background: url(clock.png) no-repeat;
                /*setting our background image*/
                background-size: 100%;
            }

            #hour,
            #minute,
            #second {
                position: absolute;
                background: black;
                border-radius: 10px;
                transform-origin: bottom;
            }

            #hour {
                width: 1.8%;
                height: 25%;
                top: 25%;
                left: 48.85%;
                opacity: 0.8;
            }

            #minute {
                width: 1.6%;
                height: 30%;
                top: 19%;
                left: 48.9%;
                opacity: 0.8;
            }

            #second {
                width: 1%;
                height: 40%;
                top: 9%;
                left: 49.25%;
                opacity: 0.8;
            }

            .clock-tower {
                background-color: #fff;
                width: 230px;
                /* text-align: center; */
                display: block;
                margin: 0 auto;
            }

            .text-center {
                text-align: center;
            }

            .font-size-big {
                font-size: 16px;
                margin-top: 10px;
            }

            .break-time {
                border: 1px solid black;
                padding: 10px;
                border-radius: 5px;
                margin: 15px 0px;
            }

            .my-btn {
                display: block;
                width: 100%;
            }

            .by-group {
                display: flex;
                align-content: center;
                justify-content: space-between;
            }

            .check_in_time {
                font-size: 14px;
                text-align: center;
            }

            .green-text {
                color: green;
            }

            #timer {
                font-size: 2em;
                margin: 20px;
            }
            .font-text {
                font-size: 16px;
            }

            /* Override default colors */
.calendarjs {
    background-color: #f0f0f0; /* Change background color */
    color: #333; /* Change text color */
}

.calendarjs .event {
    background-color: #ff0000; /* Change event background color */
    color: #fff; /* Change event text color */
}
        </style>
        <div class="row">
            <div class="col-xl-1"></div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center font-size-header">Your Attendence</h3>
                        {{-- show check in time if it is done  --}}
                        @if (isset($check_in_time) && $check_in_time != '')
                            <h3 class="check_in_time">Check In Time: {{ $check_in_time }}</h3>
                        @endif
                        @if (isset($check_out_time) && $check_out_time != '')
                            <h3 class="check_in_time">Check Out Time: {{ $check_out_time }}</h3>
                        @endif
                        @if (isset($total_time) && $total_time != '')
                            <h3 class="check_in_time">Total Worked Today: {{ $total_time }}</h3>
                        @endif
                        @if (isset($attendence_status) && $attendence_status == 'show-break-start')
                        @endif

                        <div id="timer" class="text-center">00:00:00</div>

                        {{-- <button onclick="startStop()">Start/Stop</button> --}}
                        {{-- <button onclick="reset()">Reset</button> --}}


                        @if (isset($day_message) && $day_message != '')
                            <span class="text-center text-danger" >{{ $day_message }}</span>
                        @endif
                        @if (isset($check_in_already_message) && $check_in_already_message != '')
                            <span class="font-text text-danger">{{ $check_in_already_message }}</span>
                        @endif
                        @if (isset($success_message) && $success_message != '')
                            <span class="text-center green-text">{{ $success_message }}</span>
                        @endif
                        <div class="break-time">
                            <h4>Instructions</h4>
                            <ul>


                                @if (isset($shift_time) && $shift_time == 'morning')
                                    <li>For Morning Shift: 10:00 AM - 6:00 PM</li>
                                @else
                                    <li>For Evening Shift: 6:30 AM - 2:00 PM</li>
                                @endif
                                <li>When you Reach Office, Mark Check In and When you leave Office Mark Check Out</li>
                                <li>Make Sure When you go to break then click on break start and when you comeback then click break end!</li>
                                <li>Make sure to reach on time in office</li>
                                <li>If portal does not work, Please note down your time manually and forward it to your
                                    manager!</li>

                            </ul>
                        </div>
                        <div class="break-time">
                            @if (isset($shift_time) && $shift_time == 'morning')
                                <p>Day Shift Break Time: <span style="float: right;">1:15 PM- 2:00 PM</span></p>
                            @else
                                <p>Night Shift Break Time: <span style="float: right;">9:30 PM - 10:00 PM</span></p>
                            @endif
                            <p>Target Working Hours: <span style="float: right;">7:00 / Day</span></p>
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




                            @if (isset($attendence_status) && $attendence_status == 'complete')
                                <span style="color:#3e7213;font-size:16px;"> <svg xmlns="http://www.w3.org/2000/svg"
                                        width="1em" height="1em" viewBox="0 0 24 24">
                                        <path fill="#3e7213"
                                            d="M.41 13.41L6 19l1.41-1.42L1.83 12m20.41-6.42L11.66 16.17L7.5 12l-1.43 1.41L11.66 19l12-12M18 7l-1.41-1.42l-6.35 6.35l1.42 1.41z" />
                                    </svg> Attendence Marked Successfully!</span>
                            @elseif (isset($show_check_out) && $show_check_out=="show")
                            <div class="row">
                                <div class="col-xl-6">
                                    <a class="btn btn-success my-btn" href="/check-out">Check Out
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
                                <div class="col-xl-6">
                                    <a class="btn btn-danger my-btn" href="/break-start">Break Start
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
                            @else
                                <div class="row">
                                    <div class="col-xl-6">
                                        <a class="btn btn-success my-btn" href="/check-in">CheckIn
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
                                        <a class="btn btn-danger my-btn" href="/check-out">Break Start
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
                            @endif


                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        {{-- <p class="card-title">Calendar</p> --}}
                        <br>

                        <div id='calendar'></div>

                        {{-- <form method="post" action="#" enctype="multipart/form-data">
                            @csrf

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" id="close-now">
                                    {{ session('success') }}
                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            @endif

                            <div>
                                <button type="submit" class="btn btn-primary  w-md"
                                    style="background-color: #14213D ; border-color: #fff;">Check In</button>
                            </div>
                        </form> --}}
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <div col-xl-1></div>
            <!-- end col -->
        </div>
        <!-- end row -->
        <script>
            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }

            // Function to update the current time
            function updateCurrentTime() {
                const now = new Date();
                let hours = now.getHours();
                const ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // 0 should be displayed as 12
                const minutes = pad(now.getMinutes());
                const seconds = pad(now.getSeconds());
                document.getElementById('timer').innerText =  hours + ":" + minutes + ":" + seconds +
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





            // function markAttendance() {
            //     markMyCheckIn();
            // }

            // function markCheckOutAttendance() {
            //     markCheckOutAttendanceNew();
            // }

            // Function to confirm deletion with SweetAlert
            // function markMyCheckIn() {
            //     Swal.fire({
            //         title: 'Make Sure for Check In!',
            //         text: '',
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonText: 'Yes',
            //         cancelButtonText: 'No',
            //         confirmButtonColor: '#4CAF50', // Red color for "Yes"
            //         cancelButtonColor: '#FF5733', // Green color for "No"
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             // Send an AJAX request to delete the task
            //             $.ajax({
            //                 url: '/check-in-time',
            //                 method: 'GET', // Use the DELETE HTTP method
            //                 success: function() {
            //                     // Provide user feedback
            //                     Swal.fire({
            //                         title: 'Success!',
            //                         text: 'Check In Time Marked!',
            //                         icon: 'success'
            //                     }).then(() => {
            //                         location.reload(); // Refresh the page
            //                     });
            //                 },
            //                 error: function(xhr, status, error) {
            //                     // Handle errors, you can display an error message to the user
            //                     console.error('Error:', error);
            //                     Swal.fire({
            //                         title: 'Error!',
            //                         text: 'An error occurred while check in time!',
            //                         icon: 'error'
            //                     });
            //                 }
            //             });

            //         }
            //     });
            // }
            // Function to confirm deletion with SweetAlert
            // function markCheckOutAttendanceNew() {
            //     Swal.fire({
            //         title: 'Make Sure for Check Out!',
            //         text: '',
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonText: 'Yes',
            //         cancelButtonText: 'No',
            //         confirmButtonColor: '#4CAF50', // Red color for "Yes"
            //         cancelButtonColor: '#FF5733', // Green color for "No"
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             // Send an AJAX request to delete the task
            //             $.ajax({
            //                 url: '/check-out-time',
            //                 method: 'GET', // Use the DELETE HTTP method
            //                 success: function() {
            //                     // Provide user feedback
            //                     Swal.fire({
            //                         title: 'Success!',
            //                         text: 'Check Out Time Marked!',
            //                         icon: 'success'
            //                     }).then(() => {
            //                         location.reload(); // Refresh the page
            //                     });
            //                 },
            //                 error: function(xhr, status, error) {
            //                     // Handle errors, you can display an error message to the user
            //                     console.error('Error:', error);
            //                     Swal.fire({
            //                         title: 'Error!',
            //                         text: 'An error occurred while check out time!',
            //                         icon: 'error'
            //                     });
            //                 }
            //             });

            //         }
            //     });
            // }

            // const canvas = document.getElementById("canvas");
            // const ctx = canvas.getContext("2d");
            // let radius = canvas.height / 2;
            // ctx.translate(radius, radius);
            // radius = radius * 0.90
            // setInterval(drawClock, 1000);

            // function drawClock() {
            //     drawFace(ctx, radius);
            //     drawNumbers(ctx, radius);
            //     drawTime(ctx, radius);
            // }

            // function drawFace(ctx, radius) {
            //     const grad = ctx.createRadialGradient(0, 0, radius * 0.95, 0, 0, radius * 1.05);
            //     grad.addColorStop(0, '#333');
            //     grad.addColorStop(0.5, 'white');
            //     grad.addColorStop(1, '#333');
            //     ctx.beginPath();
            //     ctx.arc(0, 0, radius, 0, 2 * Math.PI);
            //     ctx.fillStyle = 'white';
            //     ctx.fill();
            //     ctx.strokeStyle = grad;
            //     ctx.lineWidth = radius * 0.1;
            //     ctx.stroke();
            //     ctx.beginPath();
            //     ctx.arc(0, 0, radius * 0.1, 0, 2 * Math.PI);
            //     ctx.fillStyle = '#333';
            //     ctx.fill();
            // }

            // function drawNumbers(ctx, radius) {
            //     ctx.font = radius * 0.15 + "px arial";
            //     ctx.textBaseline = "middle";
            //     ctx.textAlign = "center";
            //     for (let num = 1; num < 13; num++) {
            //         let ang = num * Math.PI / 6;
            //         ctx.rotate(ang);
            //         ctx.translate(0, -radius * 0.85);
            //         ctx.rotate(-ang);
            //         ctx.fillText(num.toString(), 0, 0);
            //         ctx.rotate(ang);
            //         ctx.translate(0, radius * 0.85);
            //         ctx.rotate(-ang);
            //     }
            // }

            // function drawTime(ctx, radius) {
            //     const now = new Date();
            //     let hour = now.getHours();
            //     let minute = now.getMinutes();
            //     let second = now.getSeconds();
            //     //hour
            //     hour = hour % 12;
            //     hour = (hour * Math.PI / 6) +
            //         (minute * Math.PI / (6 * 60)) +
            //         (second * Math.PI / (360 * 60));
            //     drawHand(ctx, hour, radius * 0.5, radius * 0.07);
            //     //minute
            //     minute = (minute * Math.PI / 30) + (second * Math.PI / (30 * 60));
            //     drawHand(ctx, minute, radius * 0.8, radius * 0.07);
            //     // second
            //     second = (second * Math.PI / 30);
            //     drawHand(ctx, second, radius * 0.9, radius * 0.02);
            // }

            // function drawHand(ctx, pos, length, width) {
            //     ctx.beginPath();
            //     ctx.lineWidth = width;
            //     ctx.lineCap = "round";
            //     ctx.moveTo(0, 0);
            //     ctx.rotate(pos);
            //     ctx.lineTo(0, -length);
            //     ctx.stroke();
            //     ctx.rotate(-pos);
            // }
        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    @endsection
