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
        </style>
        <div class="row">
            <div class="col-xl-12">
                <div class="card" style="box-shadow: none;">
                    <div class="card-body">
                        <form action="/search-emp-attendence" method="post">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-2"
                                    style="padding: 5px; background-color: #e3e3e3; border-radius:10px; margin-right:5px;">
                                    <input class="form-control" type="text" name="emp_id" placeholder="Employee ID"
                                        style="background-color: transparent; border:none;">
                                </div>
                                <div class="col-md-2"
                                    style="padding: 5px; background-color: #e3e3e3; border-radius:10px; margin-right:5px;">
                                    <input class="form-control" type="text" name="emp_name" placeholder="Employee Name"
                                        style="background-color: transparent; border:none;">
                                </div>
                                <div class="col-md-2"
                                    style="padding: 5px; background-color: #e3e3e3; border-radius:10px; margin-right:5px;">
                                    <select name="emp_designation" class="form-control" id=""
                                        style="background-color: transparent; border:none;">
                                        <option value="" selected disabled>Select a designation</option>
                                        <option value="Operations Manager">Operations Manager</option>
                                        <option value="Web Development">Web Development</option>
                                        <option value="Graphic Designer">Graphic Designer</option>
                                        <option value="Virtual Assistant">Virtual Assistant</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding: 5px; background-color: #e3e3e3; border-radius:10px;">
                                    <select name="emp_shift" class="form-control" id=""
                                        style="background-color: transparent; border:none;">
                                        <option value="" selected disabled>Select Shift</option>
                                        <option value="Morning">Morning</option>
                                        <option value="Night">Night</option>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex justify-content-end gap-2">
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
                    {{-- error message --}}
                    <div class="row">
                        @if (isset($error) && $error != '')
                            <p style="color:red;">{{ $error }}</p>
                        @endif
                    </div>
                    {{-- employee dashboards --}}
                    {{-- <div class="row mt-5"> --}}

                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        {{-- <table id="datatable-buttons"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Department</th>
                                                    <th>Designation</th>
                                                    <th>Shift time</th>

                                                    <th class="text-nowrap">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody id="table-body">
                                                @foreach ($latestEmployees as $employee)
                                                    <tr>
                                                        <td>{{ $employee->Emp_Full_Name }}</td>
                                                        <td>{{ $employee->department }}</td>
                                                        <td>{{ $employee->Emp_Designation }}</td>
                                                        <td>{{ $employee->Emp_Shift_Time }}</td>

                                                        <td class="text-nowrap">
                                                            <form action="/view-attendence-emp" method="post">
                                                                @csrf
                                                                <input type="hidden" name="hidden_emp_value"
                                                                    value="{{ $employee->Emp_Code }}">
                                                                <button type="submit" class="reblateBtn px-3 py-1">View</button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table> --}}

                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>Employee</td>
                                                        <!-- Display the days of the month -->
                                                        @foreach ($daysOfMonth as $day)
                                                            <td>{{ $day }}</td>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($emp as $employee)
                                                    <tr>
                                                        <td>
                                                            @if ($employee->Emp_Image != null && file_exists(public_path($employee->Emp_Image)))
                                                                <img style="width:50px;height:50px;border-radius:50%;" src="{{ asset($employee->Emp_Image) }}" alt="">
                                                            @endif
                                                            {{ $employee->Emp_Full_Name }}
                                                        </td>
                                                        <!-- Display attendance status for each day -->
                                                        @foreach ($daysOfMonth as $day)
                                                            <td>
                                                                <!-- Check attendance for the current employee and day from the database -->
                                                                @php
                                                                    $day = Carbon\Carbon::parse($day)->format('Y-m-d');

                                                                    $attendanceRecord = DB::table('attendence')
                                                                    ->where('emp_id', $employee->Emp_Code)
                                                                    ->whereDate('date', $day)
                                                                    ->first();
                                                                    // echo $attendanceRecord;
                                                                @endphp

                                                                <!-- Determine if the employee is present based on the presence of an attendance record -->
                                                                @if ($attendanceRecord && $attendanceRecord->check_in_status == 'done')
                                                                     <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 24 24"><path fill="#06a503" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z"/></svg>
                                                                @else
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

                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        </div>
        <!-- end row -->
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
