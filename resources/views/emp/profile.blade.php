@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('page-title')
    Profile
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body d-flex w-100">
                            @if ($emp_data->Emp_Image !="" && file_exists($emp_data->Emp_Image))
                                <img src="{{  url($emp_data->Emp_Image)  }}"
                                style="width:120px; object-fit:cover; height:120px; border-radius: 50%;" alt="">
                                @else
                                <img src="{{ url('/user.png') }}" style="width:120px; object-fit:cover; height:120px; border-radius: 50%;" alt="">
                            @endif


                            <div class="ms-3">
                                <h2 class="mb-1" style="color: #14213d; font-weight: 600; font-size: 30px;">{{$emp_data->Emp_Full_Name}}
                                </h2>
                                <p style="color: gray; font-size: 15px; font-weight: 300;">{{$emp_data->Emp_Designation}}</p>
                                <p class="mb-0" style="color: #14213d; "><b>{{$emp_data->Emp_Code}}</b></p>
                                <p class="mb-0" style="color: #14213d; ">Male</p>
                                <p style="color: gray; font-size: 15px; font-weight: 300;">
                                    {{ \Carbon\Carbon::parse($emp_data->Emp_Joining_Date)->format('j F Y') }}
                                </p>
                                <p>
                                    @if(Session::has('employees_access'))
                                    @php
                                        $employees_access = Session::get('employees_access');
                                        // Convert to an array if it's a single value
                                        if (!is_array($employees_access)) {
                                            $employees_access = explode(',', $employees_access);
                                            // Remove any empty elements resulting from the explode function
                                            $employees_access = array_filter($employees_access);
                                        }
                                    @endphp
                                @endif

                                @if(auth()->user()->user_type == 'admin')
                                    <a href="/update-employee/{{$emp_data->Emp_Code}}" class="btn btn-primary">Edit</a>

                                    @if (isset($show_disable) && $show_disable == TRUE)
                                        {{-- <a href="/update-employee/{{$emp_data->Emp_Code}}" class="btn btn-primary">Disable</a> --}}
                                        @if (isset($emp_data->Emp_Status) && $emp_data->Emp_Status == "disable")
                                            <a href="javascript:void()" onclick="deleteEmployee('{{ $emp_data->Emp_Code }}')" class="btn btn-primary">Enable</a>
                                        @else
                                            <a href="javascript:void()" onclick="deleteEmployee('{{ $emp_data->Emp_Code }}')" class="btn btn-primary">Disable</a>
                                        @endif
                                    @endif

                                    @if (isset($emp_data->Emp_Status) && $emp_data->Emp_Status == "active")
                                        <a href="javascript:void()" onclick="statusChange('{{ $emp_data->Emp_Code }}')" class="btn btn-primary">Terminate</a>
                                    @else
                                        <a href="javascript:void()" onclick="statusChange('{{ $emp_data->Emp_Code }}')" class="btn btn-primary">Activate</a>
                                    @endif
                                @elseif( is_array($employees_access) && (in_array('all', $employees_access) || in_array('update', $employees_access) ) )
                                    <a href="/update-employee/{{$emp_data->Emp_Code}}" class="btn btn-primary">Edit</a>
                                    @if (isset($show_disable) && $show_disable == TRUE)
                                        {{-- <a href="/update-employee/{{$emp_data->Emp_Code}}" class="btn btn-primary">Disable</a> --}}
                                        @if (isset($emp_data->Emp_Status) && $emp_data->Emp_Status == "disable")
                                            <a href="javascript:void()" onclick="deleteEmployee('{{ $emp_data->Emp_Code }}')" class="btn btn-primary">Enable</a>
                                        @else
                                            <a href="javascript:void()" onclick="deleteEmployee('{{ $emp_data->Emp_Code }}')" class="btn btn-primary">Disable</a>
                                        @endif
                                    @endif
                                    @if (isset($emp_data->Emp_Status) && $emp_data->Emp_Status == "active")
                                        <a href="javascript:void()" onclick="statusChange('{{ $emp_data->Emp_Code }}')" class="btn btn-primary">Terminate</a>
                                    @else
                                        <a href="javascript:void()" onclick="statusChange('{{ $emp_data->Emp_Code }}')" class="btn btn-primary">Activate</a>
                                    @endif
                                @endif












                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>


        {{-- personal info --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body d-flex">
                            <div class="ms-3 w-100">
                                <h2 class="mb-1" style="color: #14213d; font-weight: 600; font-size: 25px;">Personal Information</h2>
                                <ul class="personal-info m-0 p-0" style="list-style: none; ">
                                    <li class="d-flex gap-4 align-items-center">
                                        <div style="float: left; width:25%;">Full Name:</div>
                                        <div class="text" style="color:#14213d;" >{{$emp_data->Emp_Full_Name}}</div>
                                    </li>
                                    <li class="d-flex gap-4 align-items-center">
                                        <div style="float: left; width:25%;">Email:</div>
                                        <div class="text" style="color:#14213d;">{{$emp_data->Emp_Email}}</div>
                                    </li>
                                    <li class="d-flex gap-4 align-items-center">
                                        <div style="float: left; width:25%;">Phone Number:</div>
                                        <div class="text" style="color:#14213d;">{{$emp_data->Emp_Relation_Phone}}</div>
                                    </li>
                                    <li class="d-flex gap-4 align-items-center" >
                                        <div style="float: left; width:25%;">Address:</div>
                                        <div class="text" style="color:#14213d;">{{$emp_data->Emp_Address}}</div>
                                    </li>
                                    <li class="d-flex gap-4 align-items-center">
                                        <div style="float: left; width:25%;">Material Status:</div>
                                        <div class="text" style="color:#14213d;">Single/ Married</div>
                                    </li>
                                    {{-- <li class="d-flex gap-4 align-items-center">
                                        <div style="float: left; width:25%;" >Reports to:</div>
                                        <div class="text d-flex align-items-center">
                                            <div class="avatar-box">
                                                <div class="avatar avatar-xs">
                                                    <img src="{{ asset(URL::asset('/user.png')) }}" style="width:30px; object-fit:cover; bordder-radius:50%" alt="User Image">
                                                </div>
                                            </div>
                                            <a href="profile.html" style="color:#14213d;">
                                                Jeffery Lalor
                                            </a>
                                        </div>
                                    </li> --}}

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body d-flex" style="height: 200px">
                            <div class="ms-3 w-full">
                                <h2 class="mb-1" style="color: #14213d; font-weight: 600; font-size: 25px;">Emergency Contact
                                </h2>
                                <ul class="personal-info m-0 p-0" style="list-style: none; ">
                                    <li class="d-flex gap-4 align-items-center">
                                        <div style="float: left; width:30%;">Name:</div>
                                        <div class="text" style="color:#14213d;" >{{$emp_data->Emp_Relation_Name}}</div>
                                    </li>
                                    <li class="d-flex gap-4 align-items-center">
                                        <div style="float: left; width:30%;">Relation:</div>
                                        <div class="text" style="color:#14213d;">{{$emp_data->Emp_Relation}}</div>
                                    </li>
                                    <li class="d-flex gap-4 align-items-center">
                                        <div style="float: left; width:30%;">Phone Number:</div>
                                        <div class="text" style="color:#14213d;">{{$emp_data->Emp_Relation_Phone}}</div>
                                    </li>
                                    <li class="d-flex gap-4 align-items-center" style="margin-top:10px;">
                                        <div style="float: left; width:30%;">Address:</div>
                                        <div class="text" style="color:#14213d;">{{$emp_data->Emp_Relation_Address}}</div>
                                    </li>

                                </ul>
                        </div>

                    </div>
                </div>


            </div>

        </div>
        {{-- bank details --}}
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6 ps-0">
                    <div class="card">
                        <div class="card-body w-100">
                            <h2 class="mb-1" style="color: #14213d; font-weight: 600; font-size: 25px;">Company Information</h2>
                            <ul class="personal-info m-0" style="list-style: none; ">
                                <li class="d-flex gap-4 align-items-center">
                                    <div style="float: left; width:25%;">Employee Code:</div>
                                    <div class="text" style="color:#14213d;" >{{$emp_data->Emp_Code}}</div>
                                </li>
                                <li class="d-flex gap-4 align-items-center">
                                    <div style="float: left; width:25%;">Department:</div>
                                    <div class="text" style="color:#14213d;">{{$emp_data->department}}</div>
                                </li>
                                <li class="d-flex gap-4 align-items-center">
                                    <div style="float: left; width:25%;">Designation:</div>
                                    <div class="text" style="color:#14213d;">{{$emp_data->Emp_Designation}}</div>
                                </li>
                                <li class="d-flex gap-4 align-items-center">
                                    <div style="float: left; width:25%;">Shift:</div>
                                    <div class="text" style="color:#14213d;">{{$emp_data->Emp_Shift_Time}}</div>
                                </li>
                                <li class="d-flex gap-4 align-items-center">
                                    <div style="float: left; width:25%;">Joining Date:</div>
                                    <div class="text" style="color:#14213d;">{{ \Carbon\Carbon::parse($emp_data->Emp_Joining_Date)->format('j F Y') }}</div>
                                </li>

                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="mb-1" style="color: #14213d; font-weight: 600; font-size: 25px;">Bank Information
                            </h2>
                            <ul class="personal-info m-0" style="list-style: none; ">
                                <li class="d-flex gap-4 align-items-center">
                                    <div style="float: left; width:15%;">Bank Name:</div>
                                    <div class="text" style="color:#14213d;" >
                                      @if ($emp_data->Emp_Bank_Name == "no_bank")
                                          Null
                                        @else
                                        {{$emp_data->Emp_Bank_Name}}
                                      @endif
                                    </div>
                                </li>
                                {{-- <li class="d-flex gap-4 align-items-center">
                                    <div style="float: left; width:15%;">Bank account No.:</div>
                                    <div class="text" style="color:#14213d;">25446843154168468</div>
                                </li> --}}
                                <li class="d-flex gap-4 align-items-center">
                                    <div style="float: left; width:15%;">Bank IBAN:</div>
                                    <div class="text" style="color:#14213d;">
                                        @if ($emp_data->Emp_Bank_IBAN == "no_iban")
                                          Null
                                        @else
                                        {{$emp_data->Emp_Bank_IBAN}}
                                      @endif
                                    </div>
                                </li>



                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <script>
                function confirmDelete(id) {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'Disable/Enable Employee!',
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

                function statusChangeFunc(id) {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'Terminate/Activate Employee!',
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

                function deleteEmployee(id) {
                    confirmDelete(id);
                }

                function statusChange(id) {
                    statusChangeFunc(id);
                }


        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
