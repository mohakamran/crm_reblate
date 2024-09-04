@extends('layouts.master')
@section('title')
    View Project Details
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
    View Project Details
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
        </style>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body bg-white">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="EmpNameStyle" style="color: #14213d">View Project Details</h4>
                            <form action="/search-emp-leaves" method="post">
                                @csrf
                                <div class="d-flex gap-2">
                            </form>
                        </div>
                    </div>

                    <table id="datatable-buttons" class="table dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr style="background-color: #14213d">
                                <th class="borderingLeftTable font-size-15 " style="color: #fff"> Emp ID</th>
                                <th class="font-size-15" style="color:#fff"> Starting Date</th>
                                <th class="font-size-15" style="color:#fff"> Ending Date</th>
                                <th class="font-size-15" style="color:#fff"> Status</th>
                                <th class="font-size-15" style="color:#fff"> Priority</th>
                                <th class="font-size-15" style="color:#fff"> File</th>
                                @if (auth()->user()->user_type == 'employee')
                                    <th class="borderingRightTable font-size-15" style="color:#fff"> </th>
                                @endif
                                @if (auth()->user()->user_type == 'manager')
                                    <th class="borderingRightTable font-size-15" style="color:#fff"> Action</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody id="table-body">
                            @foreach($emp_assign_projects as $data)
                                <tr style="border-bottom: 1px solid #c7c7c7">
                                    <td class="table-lines">{{ str_replace('"', '', $data->assigned_team_members) }}</td>
                                    <td class="table-lines">{{$data->start_date}}</td>
                                    <td class="table-lines">{{$data->end_date}}</td>
                                    <td class="table-lines">
                                        @if ($data->status == 'Not Started')
                                            <span style="color:purple">{{ $data->status }}</span>
                                        @elseif($data->status == 'In Progress')
                                            <span style="color:green">{{ $data->status }}</span>
                                        @elseif($data->status == 'Completed')
                                            <span style="color:#ff9b00">{{ $data->status }}</span>
                                        @elseif($data->status == 'On Hold')
                                            <span style="color:red">{{ $data->status }}</span>
                                        @endif
                                    </td>
                                    <td class="table-lines">
                                        @if ($data->priority == 'Low')
                                            <span style="color:purple">{{ $data->priority }}</span>
                                        @elseif($data->priority == 'Medium')
                                            <span style="color:green">{{ $data->priority }}</span>
                                        @elseif($data->priority == 'High')
                                            <span style="color:red">{{ $data->priority }}</span>
                                        @endif
                                    </td>
                                    <td class="table-lines">
                                    <a href="{{ asset($data->image) }}" target="_blank">View PDF</a>
                                    </td>
                                    <td class="table-lines">
                                        @if((auth()->user()->user_type == 'manager'))
                                        <a href="/update-leave/{{$data->id}}">
                                            View
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Get the modal element
                var modal = document.getElementById("editModal");

                // Get the form fields within the modal
                var checkInField = document.getElementById("editCheckIn");
                var checkOutField = document.getElementById("editCheckOut");
                var breakStartField = document.getElementById("editBreakStart");
                var breakEndField = document.getElementById("editBreakEnd");

                // Get all edit links
                var editLinks = document.querySelectorAll(".edit-link");

                // Add click event listener to each edit link
                editLinks.forEach(function(link) {
                    link.addEventListener("click", function(event) {
                        event.preventDefault();

                        // Extract data from the clicked link's parent row
                        var row = link.closest("tr");
                        var empId = row.querySelector("td:nth-child(1)").innerText.trim();
                        var checkIn = row.querySelector("td:nth-child(5)").innerText.trim();
                        var checkOut = row.querySelector("td:nth-child(6)").innerText.trim();
                        var breakStart = row.querySelector("td:nth-child(7)").innerText.trim();
                        var breakEnd = row.querySelector("td:nth-child(8)").innerText.trim();
                        checkInField.value = checkIn;
                        checkOutField.value = checkOut;
                        breakStartField.value = breakStart;
                        breakEndField.value = breakEnd;
                        $(modal).modal("show");
                    });
                });
                var editForm = document.getElementById("editForm");
                editForm.addEventListener("submit", function(event) {
                    event.preventDefault();
                    $(modal).modal("hide");
                });
            });
        </script>
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
                    buttons: [
                        'excel', 'print'
                    ],

                });
            });

            $(function() {
                $('input[name="daterange"]').daterangepicker({
                        opens: 'right'
                    },
                    function(start, end, label) {
                        var startDate = start.format('YYYY-MM-DD');
                        var endDate = end.format('YYYY-MM-DD');
                    });
            });
        </script>
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
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
        <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
         <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script> 
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endsection
