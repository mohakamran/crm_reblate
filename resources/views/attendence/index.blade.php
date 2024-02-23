@extends('layouts.master')
@section('title')
    Attendence
@endsection
@section('page-title')
    Attendence
@endsection
@section('body')
    @php
        use Illuminate\Support\Str;
    @endphp

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
                background-color: #f0f0f0;
                /* Change background color */
                color: #333;
                /* Change text color */
            }

            .calendarjs .event {
                background-color: #ff0000;
                /* Change event background color */
                color: #fff;
                /* Change event text color */
            }
        </style>
        <div class="row">
            <div class="col-xl-1"></div>

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
            <div class="col-xl-1"></div>
        </div>
        <!-- end row -->
        <script>
            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }







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
