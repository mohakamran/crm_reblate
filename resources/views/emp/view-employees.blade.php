@extends('layouts.master')
@section('title')
    {{ $emp }}
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
    {{ $emp }}
@endsection
@section('body')
    <style>
        .image-center {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;

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

        .options {
            display: grid;
            position: absolute;
        }

        .group-menu {
            cursor: pointer;
        }

        .dropdown {
            cursor: pointer;
            position: relative;
        }

        .dot {
            width: 4px;
            height: 4px;
            background-color: #000;
            border-radius: 50%;
            margin-bottom: 5px;
        }

        .style {
            background-color: #fff;
            box-shadow: 0px 0px 4px 4px #e3e3e3;
            margin-top: 5px;
            border-radius: 10px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 120px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .dropdown-content a:hover {
            background-color: #f2f2f2;
        }

        .dropdown .open .dropdown-content {
            display: block;
        }

        .frame1 {
            visibility: hidden;
        }

        .info {
            padding-left: 0;
            padding: 10px;
            margin-bottom: 0;
        }

        .info li {
            list-style: none;
            cursor: pointer;
        }
    </style>

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card" style="box-shadow: none">
                    <div class="card-body">
                        <form action="/search-emp-attendence" method="post">
                            <div class="row justify-content-center">

                                @csrf
                                <div class="col-md-2 inputboxcolor" style="border: 1px solid #c7c7c7;">
                                    <input class="form-control" type="text" name="emp_id" placeholder="Employee ID"
                                        style="background-color: transparent; border:none;">
                                </div>
                                <div class="col-md-2 inputboxcolor"style="border: 1px solid #c7c7c7;">
                                    <input class="form-control" type="text" name="emp_name" placeholder="Employee Name"
                                        style="background-color: transparent; border:none;">
                                </div>
                                <div class="col-md-2 inputboxcolor" style=" border: 1px solid #c7c7c7;">
                                    <select name="emp_designation" class="form-control" id=""
                                        style="background-color: transparent; border:none;">
                                        <option value="" selected disabled>Select a designation</option>
                                        <option value="Operations Manager">Operations Manager</option>
                                        <option value="Web Development">Web Development</option>
                                        <option value="Graphic Designer">Graphic Designer</option>
                                        <option value="Virtual Assistant">Virtual Assistant</option>
                                    </select>
                                </div>
                                <div class="col-md-2 inputboxcolor" style="border: 1px solid #c7c7c7;">
                                    <select name="emp_shift" class="form-control" id=""
                                        style="background-color: transparent; border:none;">
                                        <option value="" selected disabled>Select Shift</option>
                                        <option value="Morning">Morning</option>
                                        <option value="Night">Night</option>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex gap-2 justify-content-end">
                                    <button class="reblateBtn " style="padding: 10px 13px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg></button>
                                    <a href="/add-new" class="reblateBtn " style="padding: 10px 14px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                        </svg></a>
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
                <div class="row mt-5">
                    @foreach ($latestEmployees as $emp)
                        <div class="col-md-3">

                            <div class="card hovering"
                                style=" overflow: hidden; border-radius: 10px;">
                                <div
                                    style="width: 150px;height: 150px;position: absolute;z-index: 100;background-color: #fca311;border-radius: 100px;right: -75px;top: -70px;">
                                </div>
                                <div class="card-body" style="box-shadow: none; ">
                                    <div class="options">
                                        <div class="group-menu" onclick="toggleFun()">
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                            <div class="dot"></div>
                                        </div>
                                        <div id="frame1" class="frame1">
                                            <ul class="info">
                                                <li>Edit</li>
                                                <li>Delete</li>
                                            </ul>
                                        </div>

                                    </div>
                                    @if ($emp->Emp_Image != null && file_exists(public_path($emp->Emp_Image)))
                                        <a href="{{ $emp->Emp_Image }}" target="_blank"
                                            style="display: flex; justify-content: center;">
                                            <img class="image-center" src="{{ $emp->Emp_Image }}" alt="">
                                        </a>
                                    @else
                                        <a href="{{ url('user.png') }}" target="_blank"
                                            style="display: flex; justify-content: center;">
                                            <img class="image-center" src="{{ url('user.png') }}" alt=""
                                                style="display: flex; justify-content: center;">
                                        </a>
                                    @endif
                                    <div class="card-text-center">
                                        <p class="emp-name">
                                            <a href="/view_profile/{{ $emp->Emp_Code }}"
                                                style="color: #14213d;">{{ $emp->Emp_Full_Name }}</a>
                                        </p>
                                        <div class="d-flex gap-1 align-items-center mb-2">
                                            <p
                                                style="font-size: 17px; font-weight: 700; margin-bottom: 0px; color: #14213d;">
                                                Designation:</p>
                                            <span
                                                style="font-size: 14px; border-bottom: 1px solid #e3e3e3;">{{ $emp->Emp_Designation }}
                                            </span>
                                        </div>
                                        <div class="d-flex gap-1 align-items-center mb-2">
                                            <p
                                                style="font-size: 17px; font-weight: 700; margin-bottom: 0px; color: #14213d; ">
                                                Shift:</p>
                                            <span
                                                style="font-size: 14px; border-bottom: 1px solid #e3e3e3;">{{ $emp->Emp_Shift_Time }}
                                            </span>
                                        </div>
                                        <div class="d-flex gap-1 align-items-center mb-2">
                                            <p
                                                style="font-size: 17px; font-weight: 700; margin-bottom: 0px; color: #14213d; ">
                                                Employee Code:</p>
                                            <span
                                                style="font-size: 14px; border-bottom: 1px solid #e3e3e3;">{{ $emp->Emp_Code }}
                                            </span>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                </div>
            </div>
            <!-- end card body -->
        </div>



        <script>
            // Function to confirm deletion with SweetAlert
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'The Employee would be removed from the database!',
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
                            url: '/delete-employee/' + id,
                            method: 'GET', // Use the DELETE HTTP method
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'The employee has been deleted.',
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
                                    text: 'An error occurred while deleting the employee!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }

            function changeShiftEmp(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Shift of employee will be changed!',
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
                            url: '/change-shift/' + id,
                            method: 'GET', // Use the DELETE HTTP method
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Shift has been changed.',
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
                                    text: 'An error occurred while deleting the employee!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }

            function changeStatusEmp(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Status of employee will be changed!',
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
                            url: '/change-status/' + id,
                            method: 'GET', // Use the DELETE HTTP method
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Status has been changed.',
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
                                    text: 'An error occurred while deleting the employee!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }

            function deleteEmployee(id) {
                confirmDelete(id);
            }

            function changeShift(id) {
                changeShiftEmp(id);
            }

            function changeStatus(id) {
                changeStatusEmp(id);
            }

            function addNewEmployee() {
                window.location.href = "/add-new";
            }

            function toggleFun() {
                document.getElementById("frame1").style.visibility = "visible";
                document.getElementById("frame1").classList.add("style");

            }




            // Close dropdown when clicking outside
            // document.addEventListener('click', function(event) {
            //     var dropdowns = document.querySelectorAll('.dropdown-content');
            //     dropdowns.forEach(function(dropdown) {
            //         if (!dropdown.contains(event.target)) {
            //             dropdown.classList.remove('open');
            //         }
            //     });
            // });
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
        <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
