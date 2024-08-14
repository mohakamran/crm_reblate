@extends('layouts.master')
@section('title')
    Today Leave Requests
@endsection
@section('page-title')
    Today Leave Requests
@endsection
@section('body')
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

    <body data-sidebar="colored">
    @endsection
    @section('content')

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            .empTitle {
                color: #14213d;
                font-weight: 600;
                font-size: 25px;
                font-family: 'Poppins';
            }

            .empSubTitle {
                color: #14213d;
                font-size: 15px;
                font-weight: 300;
                font-family: 'Poppins';
            }

            .borderingLeftTable {
                border-top-left-radius: 10px !important;
            }

            .borderingRightTable {
                border-top-right-radius: 10px !important;
            }

            .image-center {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                position: relative;
                left: 32%;
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

            .approval-process {
                display: flex;
                align-items: center;
            }

            .step {
                padding: 5px 10px;
                border-radius: 25px;
                margin: 0 5px;
                color: white;
                font-weight: bold;
                text-align: center;
                cursor: pointer;
                font-size: 13px;
            }

            .submitted {
                background-color: #4CAF50;
                border: 1px solid #4CAF50;
            }

            .pending {
                background-color: #FF9800;
                border: 1px solid #FF9800;
                color: white;
            }

            .reject {
                background-color: white;
                border: 1px solid #FF0000;
                color: #FF0000;
            }
        </style>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body bg-white">
                        {{-- error message --}}
                        <div class="row container">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <script>
                                function hideNow() {
                                    console.log("hideNow function called");
                                    document.getElementById('close_now').style.display = 'none';
                                }
                            </script>

                            @if (session('message'))
                                <div class="container-fluid d-flex justify-content-end">
                                    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center"
                                        onclick="this.style.display = 'none'" style="max-width: 300px;" id="close-now">
                                        {{ session('message') }}

                                        {{-- <a type="button"  class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right; font-size:20px; margin-left:10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </a> --}}
                                    </div>
                                </div>
                            @endif
                        </div>
                        {{-- employee and leave records --}}
                        @if ($records_pending <=0)
                            <div class="row pt-5 bg-white" style="height: 250px;">
                                {{-- Displaying employee cards --}}
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="d-flex gap-3 align-items-center justify-content-center">
                                        <h3 class="text-center">No Leave Request today </h3>

                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row mt-2">
                                {{-- Displaying employee cards --}}
                                    @foreach ($empLeaveRequests as $empCode => $leaveRequests)
                                        @foreach ($leaveRequests as $request)
                                            @if ($request['leave_record']->status == 'pending')
                                                <div class="col-md-3">
                                                    <div class="card mb-0"
                                                        style="box-shadow:none; overflow: hidden; border:1px solid #c7c7c7; border-radius: 10px;">

                                                        <div class="card-body p-0">
                                                            <div class="p-3 pb-0">
                                                                <h2 class="empTitle font-size-18 mb-1">
                                                                    {{ $request['leave_record']->leave_title }}</h2>
                                                                <p class="empSubTitle font-size-14">
                                                                    {{ $request['employee']->Emp_Full_Name }}
                                                                    {{-- <span class="bold">2 days ago</span> --}}
                                                                </p>

                                                            </div>

                                                            <div class="d-flex align-items-center px-3 flex-column py-3 text-center justify-content-center"
                                                                style="background-color: #14213d">
                                                                <h1 class="empTitle mb-0"
                                                                    style="font-size: 35px; color:#fca311; font-weight:900">
                                                                    {{ $request['leave_record']->totalNumber }} Days</h1>
                                                                <p class="empSubTitle font-size-14 text-white mb-0">
                                                                    {{ $request['leave_record']->date }}</p>
                                                            </div>

                                                            <div class="card-text-center p-3 pb-0">
                                                                <div class="leave-record">
                                                                    <div
                                                                        class="d-flex gap-1 align-items-start mb-1 flex-column">
                                                                        <p class="mb-0 empTitle font-size-18 fw-bolder ">
                                                                            Reason:</p>
                                                                        <span class="font-size-14"
                                                                            style="color: #14213d; font-family: 'Poppins';">{{ $request['leave_record']->reason }}</span>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex gap-1 align-items-start mb-3 flex-column">
                                                                        <p class="mb-0 font-size-14 empSubTitle fw-bold">
                                                                            Approvel Process</p>
                                                                        <div class="approval-process">
                                                                            <div class="step submitted">Submitted</div>
                                                                            <div class="step pending">
                                                                                {{ $request['leave_record']->status }}</div>
                                                                            <div class="step reject">Reject</div>
                                                                        </div>
                                                                        <span class="text-danger"
                                                                            style="border-bottom:1px solid #e3e3e3 ;"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex p-3 pt-0 align-items-center">

                                                                @if ($request['employee']->Emp_Image != null && file_exists(public_path($request['employee']->Emp_Image)))
                                                                    <img src="{{ $request['employee']->Emp_Image }}"
                                                                        style="width: 30px; height: 30px" alt="">
                                                                @else
                                                                    <img style="width: 30px; height: 30px"
                                                                        src="{{ url('user.png') }}" alt="">
                                                                @endif
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center gap-4">
                                                                    <form action="/leave-status" method="post">

                                                                    </form>
                                                                    <a class="bg-success text-white rounded fw-bold px-3 py-1"
                                                                        style=""
                                                                        href="{{ route('leave.handle', ['action' => 'approve', 'id' => $request['leave_record']->id]) }}">Approve</a>

                                                                    <a class="bg-danger text-white rounded fw-bold px-3 py-1"
                                                                        href="{{ route('leave.handle', ['action' => 'decline', 'id' => $request['leave_record']->id]) }}"
                                                                        style="">Decline</a>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            @endforeach

                                    @endforeach
                            </div>
                    </div>
                    @endif


                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-body bg-white">
                    <table id="datatable-buttons" class="table dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr style="background-color: #14213d">
                                <th class="borderingLeftTable font-size-20" style="color: white">#</th>
                                <th class="font-size-20" style="color: white">Shift</th>
                                <th class="font-size-20" style="color: white">Emp Name</th>
                                <th class="font-size-20" style="color: white">Leave Dates</th>
                                <th class="font-size-20" style="color: white">Status</th>
                            </tr>
                        </thead>

                        @php
                            $id = 1;
                        @endphp

                        <tbody id="table-body">
                            @foreach ($empLeaveRequests as $empCode => $leaveRequests)
                                @foreach ($leaveRequests as $request)
                                    <tr>
                                        <td>{{ $id++ }}</td>
                                        <td>{{ $request['employee']->Emp_Shift_Time }}</td>
                                        <td>{{ $request['employee']->Emp_Full_Name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($request['leave_record']->date)->format('d F Y') }} -
                                            {{ \Carbon\Carbon::parse($request['leave_record']->Ending_date)->format('d F Y') }}
                                        </td>
                                        <td>
                                            @if ($request['leave_record']->status == 'pending')
                                                <button class="px-3 py-0.5 bg-warning text-white"
                                                    style="border: none; font-family: 'Poppins';">Pending</button>
                                            @endif
                                            @if ($request['leave_record']->status == 'declined')
                                                <button class="px-3 py-0.5 bg-danger text-white"
                                                    style="border: none; font-family: 'Poppins';">Declined</button>
                                            @endif
                                            @if ($request['leave_record']->status == 'approved')
                                                <button class="px-3 py-0.5 bg-primary text-white"
                                                    style="border: none; font-family: 'Poppins';">Approved</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>

        </div>



        <!-- end row -->
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
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],


                });
            });
        </script>
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
        {{-- <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script> --}}

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
