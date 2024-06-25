@extends('layouts.master')
@section('title')
    View Leaves Details
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
    View Leaves Details
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
                .table-lines{
                    font-family: 'Poppins';
                    color:#000;
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
                            <h4 class="EmpNameStyle" style="color: #14213d">View Leaves Details</h4>
                            <form action="/search-emp-leaves" method="post">
                                @csrf
                                <div class="d-flex gap-2">
                                    <div class="inputboxcolor d-flex" style="border: 1px solid #14213d;border-radius: 50px;padding: 10px;background-color: white;">
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7" stroke="#9e9e9e" stroke-width="2" stroke-linecap="round"></path>
                                                <rect x="6" y="12" width="3" height="3" rx="0.5" fill="#9e9e9e"></rect>
                                                <rect x="10.5" y="12" width="3" height="3" rx="0.5" fill="#9e9e9e"></rect>
                                                <rect x="15" y="12" width="3" height="3" rx="0.5" fill="#9e9e9e"></rect>
                                            </g>
                                        </svg>
                                        {{-- <input placeholder="Select date" type="date" name="date_controller"
                                            class="form-control" value="{{ old('date_controller') }}">

                                            <span>
                                            @error('date_controller')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </span>
                                        --}}
                                        {{-- <input type="hidden" value=""> --}}
                                        <input type="text" name="daterange" value="" class="form-control" style="border: none;margin-left: 10px;background-color: transparent;outline: none;width: 100%;padding: 0;" />
                                    </div>



                                    {{-- @if (isset($id) && $id != '')
                                        <input type="hidden" name="emp_search_date" value="">
                                    @endif --}}



                                    <div class="col-md-3">
                                        <button class="reblateBtn px-3 py-2">Search</button>
                                    </div>
                            </form>

                        </div>

                        {{-- <p class="card-title-desc">The Buttons extension for DataTables
                                provides a common set of options, API methods and styling to display
                                buttons on a page that will interact with a DataTable. The core library
                                provides the based framework upon which plug-ins can built.
                            </p> --}}


                        {{-- <form method="post" action="/search-emp-leaves">
                            @csrf

                            <div class="row mt-3 mb-3">
                                <div class="col-md-3">
                                    <input placeholder="Select date" type="date" name="date_controller"
                                        class="form-control" value="{{ old('date_controller') }}">
                                    <span>
                                        @error('date_controller')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </span>
                                </div>

                                @if (isset($id) && $id != '')
                                    <input type="hidden" name="emp_search_date" value="{{ $id }}">
                                @endif



                                <div class="col-md-3">
                                    <button class="btn btn-success">Search</button>
                                    @if (isset($show_back) && $show_back == 'yes')
                                        <a href="/leave-records" class="btn btn-success">View All</a>
                                    @endif
                                </div>
                        </form> --}}

                        <!-- Bootstrap modal -->
                        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog"
                            aria-labelledby="updateModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateModalLabel">Update Attendance</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form fields for updating attendance -->
                                        <form id="updateForm">
                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input type="text" class="form-control" id="date" name="date"
                                                    readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="checkIn">Check In Time</label>
                                                <input type="text" class="form-control" id="checkIn" name="checkIn">
                                            </div>
                                            <!-- Add more form fields for other attendance data -->
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>






                        {{-- <div class="col-md-3">
                                    <div class="card att-statistics">
                                        <div class="card-body">
                                            <h5 class="card-title">Statistics</h5>
                                            <div class="stats-list">
                                                <div class="stats-info">
                                                    <p>Today <strong>3.45 <small>/ 8 hrs</small></strong></p>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-primary w-31" role="progressbar"
                                                            aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="stats-info">
                                                    <p>This Week <strong>28 <small>/ 40 hrs</small></strong></p>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning w-31" role="progressbar"
                                                            aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="stats-info">
                                                    <p>This Month <strong>90 <small>/ 160 hrs</small></strong></p>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success w-62" role="progressbar"
                                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="stats-info">
                                                    <p>Remaining <strong>90 <small>/ 160 hrs</small></strong></p>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-danger w-62" role="progressbar"
                                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="stats-info">
                                                    <p>Overtime <strong>4</strong></p>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info w-62" role="progressbar"
                                                            aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                    </div>

                    <table id="datatable-buttons" class="table dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr style="background-color: #14213d">
                                <th class="borderingLeftTable font-size-15 " style="color: #fff"> Emp ID</th>
                                <th class="font-size-15" style="color:#fff"> Date</th>
                                <th class="font-size-15" style="color:#fff"> Month</th>
                                <th class="font-size-15" style="color:#fff"> Year</th>
                                @if (auth()->user()->user_type == 'admin')
                                <th class="font-size-15" style="color:#fff"> Status</th>
                                @else
                                <th class="borderingRightTable font-size-15" style="color:#fff"> Status</th>
                                @endif

                                @if (auth()->user()->user_type == 'admin')
                                    <th class="borderingRightTable font-size-15" style="color:#fff"> Action</th>
                                @endif

                            </tr>
                        </thead>

                        <tbody id="table-body">

                            @foreach ($emp_records as $emp)
                                <tr style="border-bottom: 1px solid #c7c7c7">

                                    @php
                                        // Parse the date string into a Carbon instance
                                        $carbonDate = \Carbon\Carbon::parse($emp->date);
                                        // Extract month name and year
                                        $monthName = $carbonDate->monthName;
                                        $year = $carbonDate->year;
                                        // Output the month name and year
                                        // echo "$monthName $year";
                                    @endphp

                                    <td class="table-lines">{{ $emp->emp_code }}</td>
                                    <td class="table-lines">{{ $emp->date }}</td>
                                    <td class="table-lines">{{ $monthName }}</td>
                                    <td class="table-lines">{{ $year }}</td>
                                    <td class="table-lines">
                                        @if ($emp->status == "declined")
                                            <span style="color:red">{{$emp->status}}</span>
                                            @elseif($emp->status == "approved")
                                            <span style="color:green">{{$emp->status}}</span>
                                            @else
                                            <span >pending</span>
                                        @endif

                                    </td>
                                    @if (auth()->user()->user_type == 'admin')
                                        {{-- <td><a class="open-popup" href="#" data-emp-id="{{ $emp->emp_id }}"><svg xmlns="http://www.w3.org/2000/svg" width="1.2rem" height="1.2rem" viewBox="0 0 24 24"><path fill="currentColor" d="m14.06 9l.94.94L5.92 19H5v-.92zm3.6-6c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z"/></svg></a></td> --}}
                                        <td class="table-lines"><a href="#" class="open-popup" data-emp-id="{{ $emp->emp_id }}">Edit</a>
                                        </td>
                                    @endif


                                </tr>
                            @endforeach
                        </tbody>



                    </table>
                </div>
            </div>
        </div> <!-- end col -->

        <!-- Bootstrap modal for the popup form -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Employee Attendance</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Your form content goes here -->
                        <form id="editForm">
                            <div class="form-group">
                                <label for="editCheckIn">Check In Time</label>
                                <input type="text" class="form-control" id="editCheckIn" name="checkInTime">
                            </div>
                            <div class="form-group">
                                <label for="editCheckOut">Check Out Time</label>
                                <input type="text" class="form-control" id="editCheckOut" name="checkOutTime">
                            </div>
                            <div class="form-group">
                                <label for="editBreakStart">Break Start</label>
                                <input type="text" class="form-control" id="editBreakStart" name="breakStart">
                            </div>
                            <div class="form-group">
                                <label for="editBreakEnd">Break End</label>
                                <input type="text" class="form-control" id="editBreakEnd" name="breakEnd">
                            </div>
                            <!-- Add more fields as needed -->
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
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

                        // Populate the form fields with the extracted data
                        checkInField.value = checkIn;
                        checkOutField.value = checkOut;
                        breakStartField.value = breakStart;
                        breakEndField.value = breakEnd;

                        // Show the modal
                        $(modal).modal("show");
                    });
                });

                // Handle form submission
                var editForm = document.getElementById("editForm");
                editForm.addEventListener("submit", function(event) {
                    event.preventDefault();
                    // Perform form submission using AJAX or any other method you prefer
                    // You can access form data using editForm.elements
                    // For example:
                    // var formData = new FormData(editForm);
                    // fetch('your-update-url', {
                    //     method: 'POST',
                    //     body: formData
                    // })
                    // .then(response => response.json())
                    // .then(data => {
                    //     console.log('Success:', data);
                    // })
                    // .catch((error) => {
                    //     console.error('Error:', error);
                    // });

                    // Close the modal after submission
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

        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endsection
