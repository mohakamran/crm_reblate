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
                            @if ($emp_data->Emp_Image !="")
                                <img src="{{  asset(URL::asset($emp_data->Emp_Image)) }}"
                                style="width:120px; object-fit:cover; height:120px; border-radius: 50%;" alt="">
                                @else
                                <img src="{{ asset(URL::asset('/user.png')) }}" style="width:120px; object-fit:cover; height:120px; border-radius: 50%;" alt="">
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
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
