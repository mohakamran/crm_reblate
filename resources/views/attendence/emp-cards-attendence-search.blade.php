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
                padding: .5rem;
                font-size: 14px;
            }

            .table td h2 {
                display: inline-block;
                font-size: 14px;
                font-weight: 400;
                margin: 0;
                padding: 0;
                vertical-align: middle;
            }

            .avatar>img {
                width: 30px;
                height: 30px;
                -o-object-fit: cover;
                object-fit: cover;
                border-radius: 50%;
            }

            .date_sect {
                background: #eee;
                display: inline;
                padding: 10px;
                border-radius: 5px;
                font-weight: 500;
                font-size: 15px;
            }
        </style>
        {{-- <div class="row">
            <div class="col-xl-12">
                <div class="card" style="box-shadow: none;">
                    <div class="card-body">
                        <form action="/filter_emp_date" method="post">
                            @csrf
                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-md-2"
                                    style="padding: 5px; background-color: #e3e3e3; border-radius:10px; margin-right:5px;">
                                    <input class="form-control" type="text" name="emp_name" placeholder="Employee Name"
                                        style="background-color: transparent; border:none;">
                                </div>
                                <div class="col-md-2"
                                    style="padding: 5px; background-color: #e3e3e3; border-radius:10px; margin-right:5px;">
                                    <select name="emp_attendence_month" class="form-control" id=""
                                        style="background-color: transparent; border:none;">
                                        <option value="" selected disabled>Select Month</option>
                                        <option value="1">Janaury</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-md-2"
                                    style="padding: 5px; background-color: #e3e3e3; border-radius:10px; margin-right:5px;">
                                    <select name="emp_attendance_year" class="form-control" id=""
                                        style="background-color: transparent; border:none;">
                                        <option value="" selected disabled>Select Year</option>
                                        @php
                                        $startYear = 2024;
                                        $endYear = 2034;
                                        @endphp
                                        @for ($year = $startYear; $year <= $endYear; $year++)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button class="reblateBtn mt-1" style="padding: 10px 14px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg></button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <!-- Employee dashboards -->
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td style="width: 350px;">Employee</td>
                                                    <!-- Display the days of the month -->
                                                    @foreach ($daysOfMonth as $day)
                                                        <td style="width: 350px;">{{ $day }}</td>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($emp as $employee)
                                                <tr>
                                                    <td>
                                                        @if ($employee->Emp_Image != null && file_exists(public_path($employee->Emp_Image)))
                                                            <img style="width:50px;height:50px;border-radius:50%;" src="{{ asset($employee->Emp_Image) }}" alt="">
                                                            @else
                                                            <img style="width:50px;height:50px;border-radius:50%;" src="{{ url('user.png') }}" alt="">
                                                        @endif
                                                        {{ $employee->Emp_Full_Name }}
                                                    </td>
                                                    <!-- Display attendance status for each day -->
                                                    @foreach ($daysOfMonth as $day)
                                                        <td>
                                                            @php
                                                                $day = Carbon\Carbon::parse($day)->format('Y-m-d');

                                                                $today = Carbon\Carbon::today()->format('Y-m-d');

                                                                $attendanceRecord = DB::table('attendence')
                                                                    ->where('emp_id', $employee->Emp_Code)
                                                                    ->whereDate('date', $day)
                                                                    ->first();

                                                                $leaveRecord = DB::table('leaves')
                                                                    ->where('emp_code', $employee->Emp_Code)
                                                                    ->whereDate('date', $day)
                                                                    ->first();
                                                            @endphp

                                                            @if ($day > $today)

                                                            @elseif ($attendanceRecord && $attendanceRecord->check_in_status == 'done')
                                                                <!-- Display check mark or any indication of attendance -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24"><path fill="#06a503" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z"/></svg>
                                                            @elseif($leaveRecord && $leaveRecord->status == "approved")
                                                                <!-- Display Leave indication -->
                                                                L
                                                            @elseif($leaveRecord)
                                                                <!-- Display Pending Leave indication or any other status -->
                                                                <span>Pending</span>
                                                            @else
                                                                <!-- Display absence indication -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24"><path fill="#f9010e" d="M18.36 19.78L12 13.41l-6.36 6.37l-1.42-1.42L10.59 12L4.22 5.64l1.42-1.42L12 10.59l6.36-6.36l1.41 1.41L13.41 12l6.36 6.36z"/></svg>
                                                            @endif
                                                        </td>
                                                    @endforeach

                                                </tr>
                                            @endforeach



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div> --}}

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="/filter_emp_date" method="post">
                            @csrf
                            <div class="row d-flex justify-content-center align-items-center">
                                {{-- <div class="col-md-2"
                                    style="padding: 5px; background-color: #e3e3e3; border-radius:10px; margin-right:5px;">
                                    <input class="form-control" type="text" name="emp_name" placeholder="Employee Name"
                                        style="background-color: transparent; border:none;">
                                </div> --}}
                                <div class="col-md-2"
                                    style="padding: 5px; background-color: #e3e3e3; border-radius:10px; margin-right:5px;">
                                    <select name="emp_attendence_month" class="form-control" id=""
                                        style="background-color: transparent; border:none;">
                                        <option value="" selected disabled>Select Month</option>
                                        <option value="1">Janaury</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-md-2"
                                    style="padding: 5px; background-color: #e3e3e3; border-radius:10px; margin-right:5px;">
                                    <select name="emp_attendance_year" class="form-control" id=""
                                        style="background-color: transparent; border:none;">
                                        <option value="" selected disabled>Select Year</option>
                                        @php
                                            $startYear = 2024;
                                            $endYear = 2034;
                                        @endphp
                                        @for ($year = $startYear; $year <= $endYear; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button class="reblateBtn mt-1" style="padding: 10px 14px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <p class="date_sect">Date: {{ $currentmonth }}, {{$currentyear}}</p>

                    </div>
                    <div class="col-md-5"></div>
                    <div class="col-md-3">
                        <input type="text" style="background: #e3e3e3;margin-top:-10px;"  id="searchInput" class="form-control" placeholder="Search Employee Name">
                    </div>
                </div>



                <div class="row" style="margin-top:30px;">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        @php
                                            for ($count = 1; $count <= $numberOfDaysInMonth; $count++) {
                                                echo '<th>' . $count . '</th>';
                                            }
                                        @endphp
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($emp as $employee)
                                        <tr>

                                            <td class="table-avatar">
                                                <a class="avatar avatar-xs" href="/view-attendence-emp/{{$employee->Emp_Code}}">
                                                    @if ($employee->Emp_Image != null && file_exists(public_path($employee->Emp_Image)))
                                                        {{-- <img style="width:50px;height:50px;border-radius:50%;" src="{{ asset($employee->Emp_Image) }}" alt=""> --}}
                                                        <img src="{{ asset($employee->Emp_Image) }}" alt="User Image">
                                                    @else
                                                        {{-- <img style="width:50px;height:50px;border-radius:50%;" src="{{ url('user.png') }}" alt=""> --}}
                                                        <img src="{{ url('user.png') }}"
                                                            alt="{{ $employee->Emp_Full_Name }}">
                                                    @endif
                                                    {{ $employee->Emp_Full_Name }}
                                                </a>
                                            </td>


                                            <!-- Display attendance status for each day -->
                                            @foreach ($daysOfMonth as $day)
                                                <td>
                                                    @php
                                                        $day = Carbon\Carbon::parse($day)->format('Y-m-d');

                                                        $today = Carbon\Carbon::today()->format('Y-m-d');

                                                        $attendanceRecord = DB::table('attendence')
                                                            ->where('emp_id', $employee->Emp_Code)
                                                            ->whereDate('date', $day)
                                                            ->first();

                                                        $leaveRecord = DB::table('leaves')
                                                            ->where('emp_code', $employee->Emp_Code)
                                                            ->whereDate('date', $day)
                                                            ->first();
                                                    @endphp

                                                    @if ($day > $today)
                                                    @elseif ($attendanceRecord && $attendanceRecord->check_in_status == 'done')
                                                        <!-- Display check mark or any indication of attendance -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem"
                                                            height="1rem" viewBox="0 0 24 24">
                                                            <path fill="#06a503"
                                                                d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z" />
                                                        </svg>
                                                    @elseif($leaveRecord && $leaveRecord->status == 'approved')
                                                        <!-- Display Leave indication -->
                                                        L
                                                    @elseif($leaveRecord)
                                                        <!-- Display Pending Leave indication or any other status -->
                                                        <span>Pending</span>
                                                    @else
                                                        <!-- Display absence indication -->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem"
                                                            height="1rem" viewBox="0 0 24 24">
                                                            <path fill="#f9010e"
                                                                d="M18.36 19.78L12 13.41l-6.36 6.37l-1.42-1.42L10.59 12L4.22 5.64l1.42-1.42L12 10.59l6.36-6.36l1.41 1.41L13.41 12l6.36 6.36z" />
                                                        </svg>
                                                    @endif
                                                </td>
                                            @endforeach

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
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
            function filterTable() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("tableBody");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0]; // Assuming the first column contains employee names
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }

            // Attach event listener to search input
            document.getElementById("searchInput").addEventListener("keyup", filterTable);

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
