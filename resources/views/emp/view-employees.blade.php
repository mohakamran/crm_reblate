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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        .image-center {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: auto;

        }

        .card-text-center {
            font-size: 16px;
        }

        .emp-name {
            font-size: 20px;
            font-weight: 700;
            text-align: center;
            font-family: 'Poppins';
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
        .searchInput{
            outline: none;
    border: none;
    border-radius: 30px;
    padding: 1rem 2rem;
    width: 0;
    transition: width .5s;
        }
        .searchInput:focus{
            width: 450px;
        }
        .searchIcon{
            position: absolute;
            top: 18px;
            left:30px;
        }
        .searchIcon:focus{
            left: 30px;
        }

    </style>

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="card" style="box-shadow: none">
                    <div class="card-body bg-light pt-1">
                        <form action="/search-emp-attendence" method="post">
                            <div class="row justify-content-between"  style="background-color: #14213d; border-radius:10px; padding:10px;">

                                @csrf

                                <div class="ms-2 w-50">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray"
                                        class="bi bi-search searchIcon" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg>
                                    <input class="form-control searchInput " type="text" name="emp_name"
                                        placeholder="Enter Employee Name...">


                                </div>


                                {{-- <div class="col-md-3 d-flex gap-2 justify-content-end">





                                    @if (auth()->user()->user_type == 'admin')
                                     <a href="/add-new" class="reblateBtn " style="padding: 10px 14px;"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                                    </svg></a>
                                        @elseif(Session::has('employees_access'))
                                        @php
                                            $employees_access = Session::get('employees_access');
                                            // Convert to an array if it's a single value
                                            if (!is_array($employees_access)) {
                                                $employees_access = explode(',', $employees_access);
                                                // Remove any empty elements resulting from the explode function
                                                $employees_access = array_filter($employees_access);
                                            }
                                         @endphp
                                            @if (is_array($employees_access) && (in_array('all', $employees_access) ||  in_array('create', $employees_access)  ) )
                                                <a href="/add-new" class="reblateBtn " style="padding: 10px 14px;"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                                    </svg></a>
                                          @endif

                                    @endif







                                </div> --}}
                                <div class="w-25 d-flex gap-2 justify-content-end align-items-center">
                                    <div class="row">
                                        @if (isset($error) && $error != '')
                                            <p style="color:red;">{{ $error }}</p>
                                        @endif
                                    </div>


                                    <div class="dropdown">
                                        <button class=" dropdown-toggle" style="border: none; background-color:transparent;" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <span style="color: #fff; font-size: 15px;">Filters</span>
                                            <svg style="cursor: pointer; width: 30px; height:30px; margin-left:10px;"
                                                viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#fca311">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <title>filter-horizontal</title>
                                                    <g id="Layer_2" data-name="Layer 2">
                                                        <g id="invisible_box" data-name="invisible box">
                                                            <rect width="48" height="48" fill="none"></rect>
                                                        </g>
                                                        <g id="icons_Q2" data-name="icons Q2">
                                                            <path
                                                                d="M41.8,8H21.7A6.2,6.2,0,0,0,16,4a6,6,0,0,0-5.6,4H6.2A2.1,2.1,0,0,0,4,10a2.1,2.1,0,0,0,2.2,2h4.2A6,6,0,0,0,16,16a6.2,6.2,0,0,0,5.7-4H41.8A2.1,2.1,0,0,0,44,10,2.1,2.1,0,0,0,41.8,8ZM16,12a2,2,0,1,1,2-2A2,2,0,0,1,16,12Z">
                                                            </path>
                                                            <path
                                                                d="M41.8,22H37.7A6.2,6.2,0,0,0,32,18a6,6,0,0,0-5.6,4H6.2a2,2,0,1,0,0,4H26.4A6,6,0,0,0,32,30a6.2,6.2,0,0,0,5.7-4h4.1a2,2,0,1,0,0-4ZM32,26a2,2,0,1,1,2-2A2,2,0,0,1,32,26Z">
                                                            </path>
                                                            <path
                                                                d="M41.8,36H24.7A6.2,6.2,0,0,0,19,32a6,6,0,0,0-5.6,4H6.2a2,2,0,1,0,0,4h7.2A6,6,0,0,0,19,44a6.2,6.2,0,0,0,5.7-4H41.8a2,2,0,1,0,0-4ZM19,40a2,2,0,1,1,2-2A2,2,0,0,1,19,40Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                        <ul class="dropdown-menu" style="background-color: #fca311">
                                            <li class="px-2"><a class="dropdown-item"
                                                    style="color: #14213d; font-size:15px; border-bottom:1px solid #14213d"
                                                    href="/show-all-employees">All</a></li>
                                            <li class="px-2"><a class="dropdown-item"
                                                    style="color: #14213d; font-size:15px; border-bottom:1px solid #14213d"
                                                    href="/manage-employees">Active</a></li>
                                            <li class="px-2 pb-2"><a class="dropdown-item"
                                                    style="color: #14213d; font-size:15px; "
                                                    href="/terminated-employees">Terminated</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </form>



                        {{-- <p>(Employees Count: {{ $totalCount }})</p> --}}
                        <div class="row mt-3">
                            @if (isset($totalCount) && $totalCount >= 1)
                            <div class="col-md-3">
                                <div class="card" style=" overflow: hidden; border-radius: 10px; box-shadow:none;">
                                    <div class="card-body" style="box-shadow: none; padding-top:9.5rem; padding-bottom:9.5rem; backdrop-filter: blur(0px); max-height: 350px;">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        @if (auth()->user()->user_type == 'admin')
                                        <a href="/add-new" class="reblateBtn " style="padding: 14px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                            fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                        </svg></a>
                                        <h3 style="color: lightgrey; font-family:'Poppins'; margin-top:5px; font-size:18px;">Add Members</h3>
                                        @elseif(Session::has('employees_access'))
                                        @php
                                            $employees_access = Session::get('employees_access');
                                            // Convert to an array if it's a single value
                                            if (!is_array($employees_access)) {
                                                $employees_access = explode(',', $employees_access);
                                                // Remove any empty elements resulting from the explode function
                                                $employees_access = array_filter($employees_access);
                                            }
                                         @endphp
                                          @if (is_array($employees_access) && (in_array('all', $employees_access) ||  in_array('create', $employees_access)  ) )
                                          <a href="/add-new" class="reblateBtn " style="padding: 10px 14px;"><svg
                                                      xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                      fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                      <path fill-rule="evenodd"
                                                          d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                              </svg></a>
                                    @endif

                                        @endif
                                    </div>
                                    </div>
                                </div>
                            </div>
                                @foreach ($latestEmployees as $emp)
                                    <div class="col-md-3">
                                        <div class="card hovering" style=" overflow: hidden; border-radius: 10px; ">
                                            <div class="card-body"
                                                style="box-shadow: none; backdrop-filter: blur(0px); padding:5px; max-height: 350px;">
                                                <img style="width: 18px; height: 18px; position: absolute; z-index: 100; left: 15px; top: 15px"
                                                    src="{{ url('/tick.png') }}" alt="">
                                                <div>
                                                    <svg style="width: 20px; height:20px; position:absolute; right:15px; top:15px; cursor:pointer"
                                                        viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                                                        fill="#14213d" class="bi bi-three-dots-vertical"
                                                        stroke="#14213d">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <div
                                                    style="background-color: #fca311; width:100%; height:120px; border-radius:10px;">

                                                </div>
                                                <div class="position-relative " style="z-index: 10; top:-90px;">
                                                    @if (isset($emp->Emp_Image) && $emp->Emp_Image != null && file_exists(public_path($emp->Emp_Image)))
                                                        <img class="image-center" src="{{ $emp->Emp_Image }}"
                                                            alt={{ $emp->Emp_Full_Name }}>
                                                    @else
                                                        <a href="{{ url('user.png') }}" target="_blank"
                                                            style="display: flex; justify-content: center;">
                                                            <img class="image-center" src="{{ url('user.png') }}"
                                                                alt={{ $emp->Emp_Full_Name }}
                                                                style="display: flex; justify-content: center;">
                                                        </a>
                                                    @endif
                                                    <div class="px-3">
                                                        <div class="card-text-center">
                                                            <div class="text-center">

                                                                <p class="emp-name mb-0">
                                                                    <a href="/view_profile/{{ $emp->Emp_Code }}"
                                                                        style="color: #14213d;">{{ $emp->Emp_Full_Name }}</a>
                                                                </p>
                                                                <span
                                                                    style="font-size: 14px; ">{{ $emp->Emp_Designation }}
                                                                </span>
                                                            </div>
                                                            <div class="d-flex gap-1 align-items-center mb-2">
                                                                <p
                                                                    style="font-size: 14px; font-weight: 700; margin-bottom: 0px; color: #14213d; ">
                                                                    Shift:</p>
                                                                <span style="font-size: 14px;">{{ $emp->Emp_Shift_Time }}
                                                                </span>
                                                            </div>
                                                            <div class="d-flex gap-1 align-items-center mb-2">
                                                                <p
                                                                    style="font-size: 14px; font-weight: 700; margin-bottom: 0px; color: #14213d; ">
                                                                    ID:</p>
                                                                <span style="font-size: 14px; ">{{ $emp->Emp_Code }}
                                                                </span>
                                                            </div>
                                                            <div class="d-flex gap-1 align-items-center mb-2">
                                                                <p
                                                                    style="font-size: 14px; font-weight: 700; margin-bottom: 0px; color: #14213d; ">
                                                                    DOB:</p>
                                                                <span style="font-size: 14px; ">11-10-2002
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            @else
                                <h2 class="mt-2">Employee Not Found! </h2>
                            @endif


                        </div>
                    </div>
                    {{-- error message --}}
                </div>
            </div>
            <!-- end card body -->
        </div>



        <script>
            // Function to confirm deletion with SweetAlert
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'The Employee would be Disabled! Employee Will not be able to Access Login Portal',
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
                                    text: 'The employee disabled successfully!',
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

            function toggleFun(id) {
                var card = document.getElementById(id);
                if (card.classList.contains("frame1")) {
                    card.classList.remove("frame1");
                    card.classList.add("style");
                    console.log(card.classList);
                } else {
                    card.classList.add("frame1");
                    card.classList.remove("style");

                }
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
