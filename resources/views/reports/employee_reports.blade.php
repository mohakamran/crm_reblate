@extends('layouts.master')
@section('title')
View Reports
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
@section('page-title')
View Reports
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

            .EmpStyle {
                font-size: 18px;
                color: #fca311;
                font-family: 'Poppins';
                font-weight: 300
            }

            .borderingLeftTable {
                border-top-left-radius: 10px !important;
            }

            .borderingRightTable {
                border-top-right-radius: 10px !important;
            }

            .table-lines {
                font-family: 'Poppins';
                color: #000;
                font-weight: 700;
            }

            .att-statistics .stats-info {
                background-color: #fff;
                border: 1px solid #e5e5e5;
                text-align: center;
                border-radius: 4px;
                margin: 0 0 5px;
                padding: 15px;
            }

            .att-statistics .stats-info p {
                font-size: 12px;
                margin: 0 0 5px;
            }

            .modal-backdrop.show {
                opacity: var(--bs-backdrop-opacity);
                display: none;
            }
            .styleapproved{
                background: #fca311;
                padding: 5px 24px 7px 18px;
                width: 50%;
                border-radius: 30px;
                /* border: 1px solid #14213d; */
                color: #fff;
            }
            .stylenoaction{
                background: red;
                padding: 5px 24px 7px 18px;
                width: 50%;
                border-radius: 30px;
                color: #fff;
                text-decoration: underline;
            }
        </style>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body" style="background-color: #14213d;">
                        <div class="col-md-6 col-lg-6 col-xl-6 gap-3 d-flex align-items-center flex-wrap p-2">
                            @if ($emp->Emp_Image != '' && file_exists($emp->Emp_Image))
                                <img class="img-fluid rounded-circle"
                                    style="width:150px;height:150px;border-radius:100%; object-fit:cover;"
                                    src="{{ url($emp->Emp_Image) }}">
                            @else
                                <img class="img-fluid rounded-circle"
                                    style="width:150px;height:150px;border-radius:100%; object-fit:cover;"
                                    src="{{ url('user.png') }}">
                            @endif
                            <div class="welcome-det ms-3 text-dark fw-bolder">
                                <h2 class="EmpNameStyle">{{ $emp->Emp_Full_Name }}</h2>
                                <div class="d-flex justify-content-between align-items-center gap-5">
                                    <h3 class="mb-0 EmpStyle" style="">Designation:</h3>
                                    <span class="EmpStyle" style="color:#fff;">{{ $emp->Emp_Designation }}</span>
                                </div>
                                <div class="d-flex justify-content-start align-items-center gap-5">
                                    <h3 class="mb-0 EmpStyle" style="width:110px">Shift:</h3>
                                    <span class="EmpStyle" style="color:#fff;">{{ $emp->Emp_Shift_Time }}</span>
                                </div>
                            </div>

                        </div>
                        <div class="position-absolute p-2"
                            style="top:20px;right: 20px; border:1px solid #fca311; border-radius:10px">
                            <span style="color:#fff; font-size: 15px;font-weight: 300; font-family: 'Poppins';">
                                Today
                                <script>
                                    document.write(new Date().toUTCString().slice(5, 16))
                                </script>
                            </span>

                        </div>


                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body bg-white">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h4 class="EmpNameStyle" style="color: #14213d">{{$emp->Emp_Full_Name}} Reports</h4>
                            <form action="{{ route('employee-reports-search', $emp->Emp_Code) }}" class="d-flex" method="get">
                                @csrf
                                <div class="d-flex gap-1 mt-2">
                                    <div class="inputboxcolor d-flex" style="border: 1px solid #14213d;border-radius: 50px;padding: 10px;background-color: white;">
                                        <input type="date" name="start_date" class="form-control" placeholder="Start Date" 
                                            style="border: none;margin-left: 10px;background-color: transparent;outline: none;width: 100%;padding: 0;" />
                                    </div>
                                    <div class="inputboxcolor d-flex" style="border: 1px solid #14213d;border-radius: 50px;padding: 10px;background-color: white;">
                                        <input type="date" name="end_date" class="form-control" placeholder="End Date" 
                                            style="border: none;margin-left: 10px;background-color: transparent;outline: none;width: 100%;padding: 0;" />
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="reblateBtn px-3 py-2">Search</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                    <table id="datatable-buttons" class="table dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr style="background-color: #14213d;">
                                <th class="font-size-17" style="color:#fff"> Task Completed</th>
                                <th class="font-size-17" style="color:#fff"> Date</th>
                                <th class="font-size-17" style="color:#fff"> Approval Status</th>
                                <th class="font-size-17" style="color:#fff"> Action</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            @foreach($employeeReports as $employeeReport)
                            @php
                                $words = explode(' ', $employeeReport->task_title); 
                                $chunks = array_chunk($words, 10);
                            @endphp
                                <tr>
                                    <td>
                                    @foreach($chunks as $chunk)
                                    {{ implode(' ', $chunk) }}<br> 
                                    @endforeach
                                    </td>
                                    <td>{{ $employeeReport->date }}</td>
                                    <td>
                                    @if($employeeReport && $employeeReport->approval === 'approved')
                                    <p class="styleapproved">{{ $employeeReport->approval }}</p>
                                    @elseif($employeeReport && $employeeReport->approval === 'not approved')
                                    <span class="text-warning" style="font-size:18px;">{{ $employeeReport->disapproval_reason }}</span>
                                    @else
                                    <span class="text-danger" style="text-decoration: underline;cursor:pointer">No Action Taken</span>
                                    @endif
                                    </td>
                                    <td class="text-success" style="text-decoration: underline;cursor:pointer">{{$employeeReport->status  }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->



        <script>
            $(document).ready(function() {
                $('#datatable-buttons').DataTable({
                    dom: "<'container-fluid'" +
                        "<'row'" +
                        "<'col-md-8'l>" +
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
                        [10, 20, 30, 40, 50, -1],
                        [10, 20, 30, 40, 50, "All"]
                    ],


                });
            });

            function convertTo12Hour(time24) {
                if (!time24 || time24 === "") {
                    return ''; // If the time is null or empty, return an empty string
                }

                const [hours, minutes] = time24.split(':'); // Split the time string into hours and minutes
                const period = parseInt(hours) >= 12 ? 'PM' : 'AM'; // Determine if it's AM or PM
                let hours12 = parseInt(hours) % 12; // Convert hours to 12-hour format

                // Ensure 12-hour clock uses 12 for noon/midnight
                if (hours12 === 0) {
                    hours12 = 12;
                }

                // Return the time in 12-hour format with AM/PM
                return `${hours12}:${minutes} ${period}`;
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
        </script>
    @endsection
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
        {{-- <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script> --}}
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endsection
