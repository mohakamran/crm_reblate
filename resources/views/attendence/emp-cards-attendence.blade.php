@extends('layouts.master')
@section('title')
    Employee Attendence
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Employee Attendence
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

            .EmpStyle {
                font-size: 18px;
                color: #fca311;
                font-family: 'Poppins';
                font-weight: 300
            }

            .image-center {
                width: 100px;
                height: 100px;
                border-radius: 50%;
            }

            .card-text-center {
                font-size: 16px;
            }

            .emp-name {
                font-size: 17px;
                font-weight: 500;
                text-align: center;
                margin-top: 15px;
            }


            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-striped tbody tr:nth-of-type(2n+1) {
                background-color: #f5f6f7;
            }

            .custom-table td {
                padding: 10px 20px;
            }

            .table td {
                border-top: 1px solid #e9e9ea;
                white-space: nowrap;
                vertical-align: middle;
                padding: 3px;
                font-size: 12px;
            }

            .table th {
                font-size: 12px;
            }

            .table td h2 {
                display: inline-block;
                font-size: 12px;
                font-weight: 400;
                margin: 0;
                padding: 0;
                vertical-align: middle;
            }

            .avatar>img {
                width: 20px;
                height: 20px;
                -o-object-fit: cover;
                object-fit: cover;
                border-radius: 50%;
            }

            .stats-box {
                background-color: #f9f9f9;
                border: 1px solid #e2e4e6;
                margin: 0 0 15px;
                padding: 5px;
            }

            .modal-image {
                width: 100px;
                height: 100px;
                border-radius: 50%;
            }

            .punch-info .punch-hours {
                background-color: #f9f9f9;
                border: 5px solid #e2e4e6;
                font-size: 18px;
                height: 120px;
                width: 120px;
                margin: 0 auto;
                border-radius: 50%;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                align-items: center;
                -webkit-box-align: center;
                -ms-flex-align: center;
                justify-content: center;
                -webkit-justify-content: center;
                -ms-flex-pack: center;
            }

            .date_sect {
                background: #eee;
                display: inline;
                padding: 10px;
                border-radius: 5px;
                font-weight: 500;
                font-size: 15px;
            }

            .recent-activity .res-activity-list {
                height: 328px;
                list-style-type: none;
                overflow-y: auto;
                position: relative;
                margin: 0;
                padding: 0 0 0 30px;
            }

            .recent-activity .res-activity-list li {
                margin: 0 0 15px;
                position: relative;
            }

            .recent-activity .res-activity-list li:before {
                content: "";
                width: 10px;
                height: 10px;
                border: 2px solid #ff902f;
                z-index: 2;
                background: #fff;
                border-radius: 100%;
                margin: 0 0 0 15px;
                position: absolute;
                top: 0;
                left: -45px;
            }

            .recent-activity p {
                font-size: 13px;
                margin: 0;
            }

            .recent-activity .res-activity-time {
                color: #bcbebf;
                font-size: 12px;
            }

            .card .card-title {
                color: #212529;
                font-size: 20px;
                font-weight: 500;
                margin-bottom: 20px;
            }

            .punch-det {
                background-color: #f9f9f9;
                border: 1px solid #e2e4e6;
                border-radius: 4px;
                margin: 0 0 20px;
                padding: 10px 15px;
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

            .boxes {
                border: none;
                border-radius: 10px;
                background-color: #14213d;
                color: white;
            }

            .active {
                background-color: #fca311;
                color: #14213d;
            }
        </style>


        <div class="card">
            <div class="card-body bg-white">
                {{-- <form action="/filter_emp_date" method="post">
                    @csrf
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="col-md-9 col-lg-9 col-xl-9 d-flex align-items-center gap-2">
                            {{-- <div class="col-md-3 col-lg-3 col-xl-3 d-flex align-items-center"
                            style="border: 1px solid #c7c7c7; border-radius:10px;padding:10px; background-color: white;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#c7c7c7"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                            <input type="text" id="searchInput" class="form-control"
                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                placeholder="Search Employee Name" id="searchInput">
                        </div>
                            <div class="col-md-1"
                                style="border: 1px solid #c7c7c7; border-radius:10px;padding:10px; background-color: white;">
                                <select name="" id="" class="form-control"
                                    style="width: 100%; border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;">
                                    <option value="Day">Day</option>
                                    <option value="Night">Night</option>
                                </select>
                            </div>
                            <div class="col-md-2"
                                style="border: 1px solid #c7c7c7; border-radius:10px;padding:10px; background-color: white;">
                                <select name="" id="" class="form-control"
                                    style="width: 100%; border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;">
                                    <option value="Virtual Assistent">Virtual Assistent</option>
                                    <option value="webDev">Web Developer</option>
                                    <option value="opManager">Operation Manager</option>
                                    <option value="adManager">Admin Manager</option>
                                </select>

                            </div>
                            <div class="col-md-2">
                                <button class="px-3 py-2"
                                    style="border:none;border-radius: 10px;background-color: #14213d;color: white">Take
                                    Attendence</button>

                            </div>




                        </div>



                    </div>
                </form> --}}
                <div class="d-flex justify-content-between align-items-center">

                    <div class="col-md-3">
                        <input type="text" style="background: #e3e3e3;" id="searchInput" class="form-control"
                            placeholder="Search in table ">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                        <form action="/filter_emp_date" method="post" style="display: flex;margin-bottom: 0;">
                            @csrf
                            <input type="month" class="form-control "
                                style="  color: #14213d; font-family:'poppins'; font-weight: 700;" id="start"
                                name="date_controller" min="2018-03" value="{{ $currentyear }}-{{ $currentMonth }}" />
                            <button style="border: none;background-color:transparent;"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#14213d"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                            </button>
                        </form>
                    </div>


                </div>

                <div>


                    <script>
                        // Function to filter table rows based on search input
                        function filterTable() {
                            var input, filter, table, tr, td, i, j, txtValue;
                            input = document.getElementById("searchInput");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("myTable");
                            tr = table.getElementsByTagName("tr");
                            for (i = 0; i < tr.length; i++) {
                                // Loop through all cells in the row
                                var found = false;
                                for (j = 0; j < tr[i].cells.length; j++) {
                                    td = tr[i].cells[j];
                                    if (td) {
                                        txtValue = td.textContent || td.innerText;
                                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                            found = true;
                                            break; // Break out of the loop if a match is found in any cell
                                        }
                                    }
                                }
                                if (found) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }
                        }

                        // Attach event listener to search input
                        document.getElementById("searchInput").addEventListener("keyup", filterTable);
                    </script>

                    <div class="row" style="margin-top:30px;">
                        <div class="col-lg-12">
                            {{-- simplebar-scrollable-y simplebar-scrollable-x  data-simplebar="init"  --}}
                            <div class="table-responsive " >
                                <table class="table custom-table table-nowrap mb-0">
                                    <thead>
                                        <tr style="background-color: #14213d20">
                                            <td class="p-2 font-size-12 EmpStyle" style="color: #14213d;font-weight: 600"
                                                colspan="1">Emp Code</td>
                                            <td class="p-2 font-size-12 EmpStyle" style="color: #14213d;font-weight: 600">
                                                Employee</td>
                                            @php
                                                for ($count = 1; $count <= $numberOfDaysInMonth; $count++) {
                                                    echo '<td class="p-2 font-size-12 text-center EmpStyle" style="color: #14213d;font-weight: 600">' .
                                                        $count .
                                                        '</td>';
                                                }
                                            @endphp
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        @foreach ($emp as $employee)
                                            <tr style="border-bottom: 1px solid #c7c7c7">
                                                <td class="EmpStyle font-size-10"
                                                    style="text-align: center; padding:10px;color: #14213d;font-weight: 600">
                                                    {{ $employee->Emp_Code }}
                                                </td>

                                                <td>
                                                    <a class="EmpStyle font-size-10" style="color: #14213d;font-weight: 600"
                                                        href="/view-attendence-emp/{{ $employee->Emp_Code }}">

                                                        {{ $employee->Emp_Full_Name }}
                                                    </a>
                                                </td>


                                                <!-- Display attendance status for each day -->
                                                @foreach ($daysOfMonth as $day)
                                                    <td style="text-align: center;">
                                                        @php
                                                            $day = Carbon\Carbon::parse($day)->format('Y-m-d');
                                                            $formattedDate = Carbon\Carbon::parse($day)->format(
                                                                'm/d/Y',
                                                            );
                                                            $today = Carbon\Carbon::today()->format('Y-m-d');
                                                            $attendence_id = null;

                                                            $attendanceRecord = DB::table('attendence')
                                                                ->where('emp_id', $employee->Emp_Code)
                                                                ->whereDate('date', $day)
                                                                ->first();
                                                            $attendence_id = null;
                                                            if ($attendanceRecord) {
                                                                $attendence_id = $attendanceRecord->id;
                                                            }

                                                            $leaveRecord = DB::table('leaves')
                                                                ->where('emp_code', $employee->Emp_Code)
                                                                ->whereDate('date', $day)
                                                                ->first();

                                                            // Get the day name
                                                            $dayName = Carbon\Carbon::parse($day)->format('l');
                                                            $year_date_name = Carbon\Carbon::parse($day)->format(
                                                                'jS M Y',
                                                            );
                                                            // echo "<br> ".$dayName;
                                                        @endphp

                                                        @if (isset($datesForMonth) && $datesForMonth != null)
                                                            @php
                                                                $isHoliday = false;
                                                                foreach ($datesForMonth as $date) {
                                                                    if ($date == $formattedDate) {
                                                                        $isHoliday = true;
                                                                        break;
                                                                    }
                                                                }
                                                            @endphp
                                                            @if ($isHoliday)
                                                                <span title="Holidays" class="text-white rounded-pill font-size-10"
                                                                    style="padding:3px 5px;background-color: #0D6EFD">H</span
                                                                @elseif ($day > $today) @php
                                                                    $formattedDate = Carbon\Carbon::parse($day)->format(
                                                                        'm/d/Y',
                                                                    );
                                                                @endphp
                                                                @elseif ($attendanceRecord && $attendanceRecord->check_in_status == 'done')
                                                                    {{-- Display check mark or any indication of attendance   --}} <a
                                                                    href="#exampleModal_{{ $attendence_id }}"
                                                                    class="text-white rounded-pill"
                                                                    style="padding:3px 5px;;background-color: #06a503"
                                                                    data-toggle="modal">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="10px"
                                                                    height="10px" viewBox="0 0 24 24">
                                                                    <path fill="#fff"
                                                                        d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z" />
                                                                </svg>
                                                                </a>
                                                            @elseif ($dayName == 'Saturday' || $dayName == 'Sunday')
                                                                <div  >
                                                                    <span title="Weekend" class="text-white rounded-pill font-size-10"
                                                                        style="padding:3px 5px;background-color: #0D6EFD">W</span>
                                                                </div>
                                                            @elseif ($leaveRecord && $leaveRecord->status == 'approved')
                                                                <!-- Display Leave indication -->
                                                                <span title="Leave" class="text-white rounded-pill font-size-10"
                                                                    style="padding:5px 8px;background-color: #F4BA40">L</span>
                                                            @else
                                                                <!-- Display absence indication -->
                                                                <div class="text-white rounded-pill mx-2"
                                                                    style="padding:5px 5px;background-color: #f9010e">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="10px"
                                                                        height="10px" viewBox="0 0 24 24">
                                                                        <path fill="#fff"
                                                                            d="M18.36 19.78L12 13.41l-6.36 6.37l-1.42-1.42L10.59 12L4.22 5.64l1.42-1.42L12 10.59l6.36-6.36l1.41 1.41L13.41 12l6.36 6.36z" />
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                        @else
                                                            @if ($day > $today)
                                                                @php
                                                                    $formattedDate = Carbon\Carbon::parse($day)->format(
                                                                        'm/d/Y',
                                                                    );
                                                                @endphp
                                                            @elseif ($attendanceRecord && $attendanceRecord->check_in_status == 'done')
                                                                <!-- Display check mark or any indication of attendance -->
                                                                <a href="#exampleModal_{{ $attendence_id }}"
                                                                    class="text-white rounded-pill mx-2"
                                                                    style="padding:5px;background-color: #06a503"
                                                                    data-toggle="modal">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15px"
                                                                        height="15px" viewBox="0 0 24 24">
                                                                        <path fill="#fff"
                                                                            d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z" />
                                                                    </svg>
                                                                </a>
                                                            @elseif ($dayName == 'Saturday' || $dayName == 'Sunday')
                                                                <div >
                                                                    <span class="text-white rounded-pill"
                                                                        style="padding: 5px 8px;background-color: #0D6EFD">W</span>
                                                                </div>
                                                            @elseif ($leaveRecord && $leaveRecord->status == 'approved')
                                                                <!-- Display Leave indication -->
                                                                <div style="margin-left: 10px;">
                                                                    <span class="text-white rounded-pill bg-danger"
                                                                        style="padding: 5px 8px;">L</span>
                                                                </div>
                                                            @else
                                                                <!-- Display absence indication -->
                                                                <div class="text-white rounded-pill mx-2"
                                                                    style="padding:5px;background-color: #f9010e">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15px"
                                                                        height="15px" viewBox="0 0 24 24">
                                                                        <path fill="#fff"
                                                                            d="M18.36 19.78L12 13.41l-6.36 6.37l-1.42-1.42L10.59 12L4.22 5.64l1.42-1.42L12 10.59l6.36-6.36l1.41 1.41L13.41 12l6.36 6.36z" />
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                        @endif


                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal_{{ $attendence_id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Attendance Info
                                                                        </h5>
                                                                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span> --}}
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">

                                                                        @if ($employee->Emp_Image != null && file_exists(public_path($employee->Emp_Image)))
                                                                            {{-- <img style="width:50px;height:50px;border-radius:50%;" src="{{ asset($employee->Emp_Image) }}" alt=""> --}}
                                                                            <img class="modal-image"
                                                                                src="{{ asset($employee->Emp_Image) }}"
                                                                                alt="User Image">
                                                                        @else
                                                                            {{-- <img style="width:50px;height:50px;border-radius:50%;" src="{{ url('user.png') }}" alt=""> --}}
                                                                            <img class="modal-image"
                                                                                src="{{ url('user.png') }}"
                                                                                alt="{{ $employee->Emp_Full_Name }}">
                                                                        @endif
                                                                        <p
                                                                            style="margin-top: 12px;font-size:13px;font-weight:500;margin-bottom:25px;">
                                                                            {{ $employee->Emp_Full_Name }}
                                                                        </p>
                                                                        <div class="row mt-3">
                                                                            <div class="col-md-6">
                                                                                <div class="card punch-status">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title">Timesheet
                                                                                            <small
                                                                                                class="text-muted">{{ $year_date_name }}
                                                                                                ({{ $dayName }})
                                                                                            </small>
                                                                                        </h5>
                                                                                        <div class="punch-det">
                                                                                            <h6>Clock In at</h6>
                                                                                            <p>{{ isset($attendanceRecord->check_in_time) ? $attendanceRecord->check_in_time : 'No Check In' }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="punch-info">
                                                                                            <div class="punch-hours">
                                                                                                @if (isset($attendanceRecord->total_time))
                                                                                                    <span>{{ $attendanceRecord->total_time }}
                                                                                                        hrs</span>
                                                                                                @else
                                                                                                    <span>0 Hours</span>
                                                                                                @endif


                                                                                            </div>
                                                                                        </div>
                                                                                        <br>
                                                                                        <div class="punch-det">
                                                                                            <h6>Clock Out at</h6>
                                                                                            <p>{{ isset($attendanceRecord->check_out_time) ? $attendanceRecord->check_out_time : 'No Check Out' }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="statistics">
                                                                                            <div class="row">
                                                                                                <div
                                                                                                    class="col-md-6 col-6 text-center">
                                                                                                    <div class="stats-box">
                                                                                                        @if (isset($attendanceRecord->break_start) &&
                                                                                                                $attendanceRecord->break_start != '' &&
                                                                                                                isset($attendanceRecord->break_end) &&
                                                                                                                $attendanceRecord->break_end != '')
                                                                                                            <?php
                                                                                                            // Assuming $attendanceRecord->break_start and $attendanceRecord->break_end are in a valid format

                                                                                                            // Parse break start and end times
                                                                                                            $breakStart = \Carbon\Carbon::createFromFormat('h:i A', $attendanceRecord->break_start);
                                                                                                            $breakEnd = \Carbon\Carbon::createFromFormat('h:i A', $attendanceRecord->break_end);

                                                                                                            // Calculate break duration
                                                                                                            $breakDuration = $breakEnd->diff($breakStart);

                                                                                                            // Format break duration
                                                                                                            // Format break duration
                                                                                                            $hours = $breakDuration->h;
                                                                                                            $minutes = $breakDuration->i;
                                                                                                            $breakDurationFormatted = sprintf('%d hrs %02d min', $hours, $minutes);
                                                                                                            ?>
                                                                                                        @else
                                                                                                            @php
                                                                                                                $breakDurationFormatted =
                                                                                                                    '0 hrs 0 min';
                                                                                                            @endphp
                                                                                                        @endif
                                                                                                        <p>Break</p>
                                                                                                        <h6> {{ $breakDurationFormatted }}
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="col-md-6 col-6 text-center">
                                                                                                    @php
                                                                                                        if (
                                                                                                            $attendanceRecord &&
                                                                                                            $attendanceRecord->overtime_start !=
                                                                                                                null &&
                                                                                                            $attendanceRecord->overtime_end !=
                                                                                                                null
                                                                                                        ) {
                                                                                                            $overtime_start = \Carbon\Carbon::createFromFormat(
                                                                                                                'h:i A',
                                                                                                                $attendanceRecord->overtime_start,
                                                                                                            );
                                                                                                            $overtime_end = \Carbon\Carbon::createFromFormat(
                                                                                                                'h:i A',
                                                                                                                $attendanceRecord->overtime_end,
                                                                                                            );
                                                                                                            // caculate overtime
                                                                                                            $overTimeDuration = $overtime_end->diff(
                                                                                                                $overtime_start,
                                                                                                            );
                                                                                                            // Format break duration
                                                                                                            $overhours =
                                                                                                                $overTimeDuration->h;
                                                                                                            $overminutes =
                                                                                                                $overTimeDuration->i;
                                                                                                            $overDurationFormatted = sprintf(
                                                                                                                '%d hrs %02d min',
                                                                                                                $overhours,
                                                                                                                $overminutes,
                                                                                                            );
                                                                                                        } else {
                                                                                                            $overDurationFormatted =
                                                                                                                '0 hrs 0 min';
                                                                                                        }

                                                                                                    @endphp
                                                                                                    <div class="stats-box">
                                                                                                        <p>Overtime</p>
                                                                                                        <h6>{{ $overDurationFormatted }}
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        <h6 class="card-title"> Activity
                                                                                        </h6>
                                                                                        <div id="content">
                                                                                            <ul class="timeliner">
                                                                                                <li class="event mb-1">
                                                                                                    <h3 class="fs-4 font-size-18 mb-0"
                                                                                                        style="color: #14213d">
                                                                                                        Clock In</h3>
                                                                                                    <p>{{ isset($attendanceRecord->check_in_time) && $attendanceRecord->check_in_time != '' ? $attendanceRecord->check_in_time : 'No Check In' }}
                                                                                                    </p>
                                                                                                </li>
                                                                                                <li class="event mb-1">
                                                                                                    <h3 class="fs-4 font-size-18 mb-0"
                                                                                                        style="color: #14213d">
                                                                                                        Break Start Time
                                                                                                    </h3>
                                                                                                    <p>{{ isset($attendanceRecord->break_start) && $attendanceRecord->break_start != '' ? $attendanceRecord->break_start : 'No Break' }}
                                                                                                    </p>
                                                                                                </li>
                                                                                                <li class="event mb-1">
                                                                                                    <h3 class="fs-4 font-size-18 mb-0"
                                                                                                        style="color: #14213d">
                                                                                                        Break End Time</h3>
                                                                                                    <p>{{ isset($attendanceRecord->break_end) && $attendanceRecord->break_end != '' ? $attendanceRecord->break_end : 'No Break ' }}
                                                                                                    </p>
                                                                                                </li>
                                                                                                <li class="event mb-1">
                                                                                                    <h3 class="fs-4 font-size-18 mb-0"
                                                                                                        style="color: #14213d">
                                                                                                        Clock Out</h3>
                                                                                                    <p>{{ isset($attendanceRecord->check_out_time) && $attendanceRecord->check_out_time != '' ? $attendanceRecord->check_out_time : 'No Check Out' }}
                                                                                                    </p>

                                                                                                <li class="event mb-1">
                                                                                                    <h3 class="fs-4 font-size-18 mb-0"
                                                                                                        style="color: #14213d">
                                                                                                        Over Time Start</h3>
                                                                                                    <p>{{ isset($attendanceRecord->overtime_start) && $attendanceRecord->overtime_start != '' ? $attendanceRecord->overtime_start : 'No Over Time' }}
                                                                                                    </p>
                                                                                                </li>
                                                                                                <li class="event mb-1">
                                                                                                    <h3 class="fs-4 font-size-18 mb-0"
                                                                                                        style="color: #14213d">
                                                                                                        Over Time End</h3>
                                                                                                    <p>{{ isset($attendanceRecord->overtime_end) && $attendanceRecord->overtime_end != '' ? $attendanceRecord->overtime_end : 'No Over Time' }}
                                                                                                    </p>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>





                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-primary"
                                                                            data-dismiss="modal">Close</button>
                                                                        <!-- You can add additional buttons here -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                            </div>


                            </td>
                            @endforeach

                            </tr>
                            @endforeach

                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4 col-xl-4 col-lg-4">
                            <div class="card" style="box-shadow: none;">
                                <div class="card-body" style="border:1px solid #c7c7c7">
                                    <h2 class="EmpNameStyle" style="color: #fca311; font-size: 20px">Highest Attendence
                                    </h2>
                                    <table class="table table-nowrap table-responsive">
                                        <tr style="background-color: #14213d20;">
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Emp
                                                Code</td>
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Emp
                                                Name</td>
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Total
                                                Days</td>
                                        </tr>
                                        @if ($total_present && $total_present->isNotEmpty())
                                            @foreach ($total_present as $present)
                                                <tr>
                                                    <td style="padding:10px; font-weight:600;color:#14213d">
                                                        {{ $present->emp_id }}</td>
                                                    <td style="padding:10px; font-weight:600;color:#14213d">
                                                        {{ $present->Emp_Full_Name }}</td>
                                                    <td style="padding:10px; font-weight:600;color:#14213d">
                                                        {{ $present->present_count }}</td>
                                                </tr>
                                            @endforeach
                                        @endif


                                    </table>

                                </div>

                            </div>

                        </div>
                        <div class="col-md-4 col-xl-4 col-lg-4">
                            <div class="card" style="box-shadow: none;">
                                <div class="card-body" style="border:1px solid #c7c7c7">
                                    <h2 class="EmpNameStyle" style="color: #fca311; font-size: 20px">Lowest Attendence
                                    </h2>
                                    <table class="table table-nowrap table-responsive">
                                        <tr style="background-color: #14213d20;">
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Emp
                                                Code</td>
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Emp
                                                Name</td>
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Total
                                                Days</td>
                                        </tr>
                                        @if ($total_absent && $total_absent->isNotEmpty())
                                            @foreach ($total_absent as $present)
                                                <tr>
                                                    <td style="padding:10px; font-weight:600;color:#14213d">
                                                        {{ $present->emp_id }}</td>
                                                    <td style="padding:10px; font-weight:600;color:#14213d">
                                                        {{ $present->Emp_Full_Name }}</td>
                                                    <td style="padding:10px; font-weight:600;color:#14213d">
                                                        {{ $present->present_count }}</td>
                                                </tr>
                                            @endforeach
                                        @endif


                                    </table>

                                </div>

                            </div>

                        </div>
                        <div class="col-md-4 col-xl-4 col-lg-4">
                            <div class="card" style="box-shadow: none;">
                                <div class="card-body" style="border:1px solid #c7c7c7; min-height:225px;">
                                    <h2 class="EmpNameStyle" style="color: #fca311; font-size: 20px">Upcoming Leaves</h2>
                                    <table class="table table-nowrap table-responsive">

                                        <tr style="background-color: #14213d20;">
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Emp
                                                Code</td>
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Emp
                                                Name</td>
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Total
                                                Days</td>
                                        </tr>

                                        @if ($upcomingLeaves->isNotEmpty())
                                            @foreach ($upcomingLeaves as $leave)
                                                <tr style="background:#fff;">
                                                    <td class="EmpStyle"
                                                        style="padding: 10px;font-weight:600;color:#14213d">
                                                        {{ $leave['Emp_Code'] }}</td>
                                                    <td class="EmpStyle"
                                                        style="padding: 10px;font-weight:600;color:#14213d">
                                                        {{ $leave['Name'] }}</td>
                                                    <td class="EmpStyle"
                                                        style="padding: 10px;font-weight:600;color:#14213d">
                                                        {{ $leave['total_leaves'] }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr style='height:80px; text-align:center; font-size:25px;'>
                                                <td style='font-size:20px;font-family:'Poppins' ' rowspan='3' colspan="3">No Upcoming Leaves</td>
                                            </tr>
                                        @endif



                                    </table>
                                    <a href="/leave-requests" style="text-align: center;">Leaves Request</a>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        <!-- end col -->
        </div>
        <!-- end row -->


        <script>
            // Function to filter table rows based on search input


            // Attach event listener to search input
        </script>
        <script>
            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }
        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>


        <!-- Details Section -->
        <div id="details-section" style="display: none;">
            <!-- Details section will be shown here -->
            <!-- You can use JavaScript to populate this section dynamically -->
        </div>

        </div>
        </div>
        </div> <!-- end col -->
        </div> <!-- end row -->
    @endsection

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
        <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
