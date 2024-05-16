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

            .empMenu {
                list-style: none;
                font-family: 'Poppins';
                color: gray;
                border-bottom: 1px solid #fff;
                cursor: pointer;

            }

            .empMenu:hover {
                color: #14213d;
                font-weight: 600;
                border-bottom: 1px solid #fca311;
            }

            .active {
                color: #14213d;
                font-weight: 600;
                border-bottom: 1px solid #fca311;
            }

            .ui-w-80 {
                width: 80px !important;
                height: auto;
            }

            .btn-default {
                border-color: rgba(24, 28, 33, 0.1);
                background: rgba(0, 0, 0, 0);
                color: #4E5155;
            }

            label.btn {
                margin-bottom: 0;
            }

            .btn-outline-primary {
                border-color: #26B4FF;
                background: transparent;
                color: #26B4FF;
            }

            .btn {
                cursor: pointer;
            }

            .text-light {
                color: #babbbc !important;
            }

            .btn-facebook {
                border-color: rgba(0, 0, 0, 0);
                background: #3B5998;
                color: #fff;
            }

            .btn-instagram {
                border-color: rgba(0, 0, 0, 0);
                background: #000;
                color: #fff;
            }

            .card {
                background-clip: padding-box;
                box-shadow: 0 1px 4px rgba(24, 28, 33, 0.012);
            }

            .row-bordered {
                overflow: hidden;
            }

            .account-settings-fileinput {
                position: absolute;
                visibility: hidden;
                width: 1px;
                height: 1px;
                opacity: 0;
            }

            .account-settings-links .list-group-item.active {
                font-weight: bold !important;
            }

            html:not(.dark-style) .account-settings-links .list-group-item.active {
                background: transparent !important;
            }

            .account-settings-multiselect~.select2-container {
                width: 100% !important;
            }

            .light-style .account-settings-links .list-group-item {
                padding: 0.85rem 1.5rem;
                border-color: rgba(24, 28, 33, 0.03) !important;
            }

            .light-style .account-settings-links .list-group-item.active {
                color: #4e5155 !important;
            }

            .material-style .account-settings-links .list-group-item {
                padding: 0.85rem 1.5rem;
                border-color: rgba(24, 28, 33, 0.03) !important;
            }

            .material-style .account-settings-links .list-group-item.active {
                color: #4e5155 !important;
            }

            .dark-style .account-settings-links .list-group-item {
                padding: 0.85rem 1.5rem;
                border-color: rgba(255, 255, 255, 0.03) !important;
            }

            .dark-style .account-settings-links .list-group-item.active {
                color: #fff !important;
            }

            .light-style .account-settings-links .list-group-item.active {
                color: #4E5155 !important;
            }

            .light-style .account-settings-links .list-group-item {
                padding: 0.85rem 1.5rem;
                border-color: rgba(24, 28, 33, 0.03) !important;
            }

            .detailLabel {
                float: left;
                width: 35%;
                color: #14213d;
                font-size: 16px;
                font-family: 'Poppins';
                font-weight: 700

            }

            .detailInfo {
                color: #14213d;
                font-weight: 500;
                font-family: 'Poppins';

            }

            .dotting {
                width: 100%;

            }

            .dotting::before {
                content: '';
                position: absolute;
                width: 10px;
                left: 10px;
                height: 10px;
                border-radius: 50%;
                background-color: lightgray;
            }

            .borderingLeftTable {
                border-top-left-radius: 10px !important;
            }

            .borderingRightTable {
                border-top-right-radius: 10px !important;
            }
        </style>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12 col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-body bg-light" style="box-shadow:0px 0px 10px 0px rgba(0, 0, 0, 0.7)">
                            <div class="d-flex justify-content-between alignitems-center">
                                <div class="d-flex pt-3">
                                    @if ($emp_data->Emp_Image != '' && file_exists($emp_data->Emp_Image))
                                        <img src="{{ url($emp_data->Emp_Image) }}"
                                            style="width:150px; object-fit:cover; height:150px; border-radius: 50%;"
                                            alt={{ $emp_data->Emp_Full_Name }}>
                                    @else
                                        <img src="{{ url('/user.png') }}"
                                            style="width:120px; object-fit:cover; height:120px; border-radius: 50%;"
                                            alt={{ $emp_data->Emp_Full_Name }}>
                                    @endif
                                    <div class="ms-4">
                                        <h2 class="mb-0 empTitle">{{ $emp_data->Emp_Full_Name }}</h2>
                                        <p class="empSubTitle">{{ $emp_data->Emp_Designation }}</p>
                                        <div class="d-flex gap-2 align-items-center">
                                            <h2 class="mb-0 empTitle font-size-18">EMP ID:</h2>
                                            <p class="mb-0 font-size-18" style="color: #14213d; ">{{ $emp_data->Emp_Code }}
                                            </p>
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <h2 class="mb-0 empTitle font-size-18">Date of Joining:</h2>
                                            <p class="font-size-18 empSubTitle mb-0">
                                                {{ \Carbon\Carbon::parse($emp_data->Emp_Joining_Date)->format('j F Y') }}
                                            </p>

                                        </div>
                                        {{-- <p class="mb-0" style="color: #14213d; ">Male</p> --}}
                                        <div class="mt-4">
                                            @if (Session::has('employees_access'))
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

                                            @if (auth()->user()->user_type == 'admin')
                                                {{-- <a href="/update-employee/{{$emp_data->Emp_Code}}" class="btn btn-primary">Edit</a> --}}

                                                {{-- @if (isset($show_disable) && $show_disable == true)

                                                @if (isset($emp_data->Emp_Status) && $emp_data->Emp_Status == 'disable')
                                                    <a href="javascript:void()" onclick="deleteEmployee('{{ $emp_data->Emp_Code }}')" class="btn btn-primary">Enable</a>
                                                @else
                                                    <a href="javascript:void()" onclick="deleteEmployee('{{ $emp_data->Emp_Code }}')" class="btn btn-primary">Disable</a>
                                                @endif
                                            @endif --}}

                                                @if (isset($emp_data->Emp_Status) && $emp_data->Emp_Status == 'active')
                                                    <a href="javascript:void()"
                                                        onclick="statusChange('{{ $emp_data->Emp_Code }}')"
                                                        class="reblateBtn px-4 py-2"
                                                        style="border-radius: 10px;">Terminate</a>
                                                @else
                                                    <a href="javascript:void()"
                                                        onclick="statusChange('{{ $emp_data->Emp_Code }}')"
                                                        class="btn btn-primary">Activate</a>
                                                @endif
                                            @elseif(is_array($employees_access) && (in_array('all', $employees_access) || in_array('update', $employees_access)))
                                                <a href="/update-employee/{{ $emp_data->Emp_Code }}"
                                                    class="btn btn-primary">Edit</a>
                                                @if (isset($show_disable) && $show_disable == true)
                                                    {{-- <a href="/update-employee/{{$emp_data->Emp_Code}}" class="btn btn-primary">Disable</a> --}}
                                                    @if (isset($emp_data->Emp_Status) && $emp_data->Emp_Status == 'disable')
                                                        <a href="javascript:void()"
                                                            onclick="deleteEmployee('{{ $emp_data->Emp_Code }}')"
                                                            class="btn btn-primary">Enable</a>
                                                    @else
                                                        <a href="javascript:void()"
                                                            onclick="deleteEmployee('{{ $emp_data->Emp_Code }}')"
                                                            class="btn btn-primary">Disable</a>
                                                    @endif
                                                @endif
                                                @if (isset($emp_data->Emp_Status) && $emp_data->Emp_Status == 'active')
                                                    <a href="javascript:void()"
                                                        onclick="statusChange('{{ $emp_data->Emp_Code }}')"
                                                        class="btn btn-primary">Terminate</a>
                                                @else
                                                    <a href="javascript:void()"
                                                        onclick="statusChange('{{ $emp_data->Emp_Code }}')"
                                                        class="btn btn-primary">Activate</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-3 mt-3 w-50" style="border-left: 3px dashed #c7c7c7">
                                    <ul class="personal-info m-0 ms-5 p-0" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Phone No:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">{{ $emp_data->Emp_Relation_Phone }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Email:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">{{ $emp_data->Emp_Email }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Birthday</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">12-02-2003</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Address:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">{{ $emp_data->Emp_Address }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Gender:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">Male</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Marital Status:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">Single</p>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <div class="mt-4">
                                <ul
                                    class="d-flex gap-4 align-items-center list-group list-group-flush account-settings-links flex-row">
                                    <li style="list-style: none"><a href="#profile" data-toggle="list"
                                            class="empMenu active">Profile</a> </li>
                                    <li style="list-style: none"><a href="#companyDetails" data-toggle="list"
                                            class="empMenu">Company Detail</a> </li>
                                    <li style="list-style: none"><a href="#projects" data-toggle="list"
                                            class="empMenu">Projects</a> </li>
                                    <li style="list-style: none"><a href="#bankDetails" data-toggle="list"
                                            class="empMenu">Bank
                                            Details</a> </li>
                                    <li style="list-style: none"><a href="#assests" data-toggle="list"
                                            class="empMenu">Assests</a> </li>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>


        <div class="tab-content">
            <div class="container-fluid tab-pane fade active show" style="border-bottom: none" id="profile">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body bg-light" style="border: 1px solid #c7c7c7; min-height: 270px">
                                <div class="ms-3 w-100">
                                    <div
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">Personal
                                        Information</h2>
                                    <ul class="personal-info m-0 p-0" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1" style="">Passport No:</h2>
                                            <p class="text detailInfo mb-0" style="">98761240
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Passport Exp Date:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">11-04-24</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Tel No:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation_Phone }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Religion:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">Islam</p>
                                        </li>
                                        <li class="d-flex gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">No of Childern</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">0</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body bg-light" style="border: 1px solid #c7c7c7">
                                <div class="ms-3 w-full">
                                    <div
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">
                                        Emergency Contact
                                    </h2>
                                    <ul class="personal-info m-0 p-0" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Primary Name:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation_Name }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Relationship:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center"
                                            style="border-bottom: 1px solid #14213d">
                                            <h2 class="detailLabel mb-1">Phone No:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation_Phone }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center" style="margin-top:10px;">
                                            <h2 class="detailLabel mb-1">Secoundary Name:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                ______
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center" style="margin-top:10px;">
                                            <h2 class="detailLabel mb-1">Relationship:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                ______
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center" style="margin-top:10px;">
                                            <h2 class="detailLabel mb-1">Phone No:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                ______
                                            </p>
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

                        <div class="col-md-6 col-lg-6 col-xl-6 ps-0">
                            <div class="card">
                                <div class="card-body bg-light w-100" style="border: 1px solid #c7c7c7">
                                    <div
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">
                                        Education Information</h2>
                                    <ul class="personal-info m-0 p-0 ps-3" style="list-style: none; ">
                                        <li class=" dotting">
                                            <div class="position-relative d-flex flex-column" style="top: -8px;">
                                                <h2 class="detailLabel mb-0">University Name</h2>
                                                <p class="text detailInfo mb-0" style="color:#14213d;">Computer Science
                                                </p>
                                                <p class="detailInfo font-size-12">2018 - 2022</p>

                                            </div>
                                        </li>
                                        <li class=" dotting">
                                            <div class="d-flex flex-column position-relative" style="top: -8px;">
                                                <h2 class="detailLabel mb-0">Collage Name</h2>
                                                <p class="text detailInfo mb-0" style="color:#14213d;">FSc (Pre-Engg)</p>
                                                <p class="detailInfo font-size-12">2018 - 2022</p>

                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-body bg-light" style="border: 1px solid #c7c7c7">
                                    <div
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">Work
                                        Experience</h2>
                                    <ul class="personal-info m-0 p-0 ps-3" style="list-style: none; ">
                                        <li class="dotting">
                                            <div class="position-relative d-flex flex-column">
                                                <h2 class="detailLabel mb-0 w-100">Reblate Solutions and Servce Providers
                                                </h2>
                                                <p class="text detailInfo mb-0" style="color:#14213d;">FSc (Pre-Engg)</p>
                                                <p class="detailInfo font-size-12">2018 - 2022</p>

                                            </div>

                                        </li>
                                        <li class="dotting">
                                            <div class="position-relative d-flex flex-column">
                                                <h2 class="detailLabel mb-0 w-100">Reblate Solutions and Servce Providers
                                                </h2>
                                                <p class="text detailInfo mb-0" style="color:#14213d;">FSc (Pre-Engg)</p>
                                                <p class="detailInfo font-size-12">2018 - 2022</p>

                                            </div>

                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container-fluid tab-pane fade" style="border-bottom: none" id="companyDetails">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body bg-light d-flex" style="border: 1px solid #c7c7c7">
                                <div class="ms-3 w-100">
                                    <div
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">Company
                                        Details</h2>
                                    <ul class="personal-info m-0 p-0" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Employee Code:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Code }}</p>

                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Department:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">DropShipping</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Designation:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Designation }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Shift:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Shift_Time }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Joinging Date:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Joining_Date }}</p>
                                        </li>


                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>

            </div>
            <div class="container-fluid tab-pane fade" style="border-bottom: none" id="projects">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body bg-light d-flex" style="border: 1px solid #c7c7c7">
                                <div class="ms-3 w-100">
                                    <div
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">Projects
                                    </h2>
                                    <ul class="personal-info m-0 p-0" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Full Name:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Full_Name }}
                                            </p>
                                        </li>
                                        <li class="d-flex gap-4 mb-1 align-items-center">
                                            <h2 class="detailLabel mb-1">Email:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Email }}</p>
                                        </li>
                                        <li class="d-flex gap-4 mb-1 align-items-center">
                                            <h2 class="detailLabel mb-1">Phone Number:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation_Phone }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Address:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Address }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Material Status:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">Single/ Married</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body bg-light d-flex" style="border: 1px solid #c7c7c7">
                                <div class="ms-3 w-full">
                                    <div
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">
                                        Emergency
                                        Contact
                                    </h2>
                                    <ul class="personal-info m-0 p-0" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Name:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation_Name }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Relation:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Phone Number:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation_Phone }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center" style="margin-top:10px;">
                                            <h2 class="detailLabel mb-1">Address:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation_Address }}
                                            </p>
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

                        <div class="col-md-6 col-lg-6 col-xl-6 ps-0">
                            <div class="card">
                                <div class="card-body bg-light w-100" style="border: 1px solid #c7c7c7">
                                    <div
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">Company
                                        Information</h2>
                                    <ul class="personal-info m-0" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Employee Code:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Code }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Department:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->department }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Designation:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Designation }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Shift:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Shift_Time }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Joining Date:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ \Carbon\Carbon::parse($emp_data->Emp_Joining_Date)->format('j F Y') }}
                                            </p>
                                        </li>

                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-body bg-light" style="border: 1px solid #c7c7c7">
                                    <div
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">Bank
                                        Information
                                    </h2>
                                    <ul class="personal-info m-0" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Bank Name:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                @if ($emp_data->Emp_Bank_Name == 'no_bank')
                                                    Null
                                                @else
                                                    {{ $emp_data->Emp_Bank_Name }}
                                                @endif
                                            </p>
                                        </li>
                                        {{-- <li class="d-flex gap-4 align-items-center">
                                            <div style="float: left; width:15%;">Bank account No.:</div>
                                            <div class="text" style="color:#14213d;">25446843154168468</div>
                                        </li> --}}
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Bank IBAN:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                @if ($emp_data->Emp_Bank_IBAN == 'no_iban')
                                                    Null
                                                @else
                                                    {{ $emp_data->Emp_Bank_IBAN }}
                                                @endif
                                            </p>
                                        </li>



                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container-fluid tab-pane fade" style="border-bottom: none" id="bankDetails">
                {{-- bank details --}}
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 ps-0">
                            <div class="card">
                                <div class="card-body bg-light w-100" style="border: 1px solid #c7c7c7">
                                    <div
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#14213d50" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">Bank
                                        Detail</h2>
                                    <ul class="personal-info m-0 p-0 ps-3" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Bank Name:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">Bank Alfalah</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Account Title:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Full_Name }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Account No</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">098715142532523528
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">IBAN:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                @if ($emp_data->Emp_Bank_IBAN == 'no_iban')
                                                    Null
                                                @else
                                                    {{ $emp_data->Emp_Bank_IBAN }}
                                                @endif
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Branch Name:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                Citi Hosuing, Jhelum
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Branch Code:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                0678
                                            </p>
                                        </li>

                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-body bg-light" style="border: 1px solid #c7c7c7; min-height: 242px">
                                    <div
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#14213d50" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">Salary
                                        Detail</h2>
                                    <ul class="personal-info m-0" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Basic Salary:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                30000/-
                                            </p>
                                        </li>
                                        {{-- <li class="d-flex gap-4 align-items-center">
                                            <div style="float: left; width:15%;">Bank account No.:</div>
                                            <div class="text" style="color:#14213d;">25446843154168468</div>
                                        </li> --}}
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Designation Bouns:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                5000/-
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Travel Allounce:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                5000/-
                                            </p>
                                        </li>



                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container-fluid tab-pane fade" style="border-bottom: none" id="assests">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body bg-light d-flex" style="border: 1px solid #c7c7c7" id="profile">
                                <table class="table  ">
                                    <tr style="background-color: #14213d">
                                        <td class="borderingLeftTable text-light font-size-20">#</td>
                                        <td class="font-size-20" style="color: white">Name</td>
                                        <td class="font-size-20" style="color: white">Asset ID</td>
                                        <td class="font-size-20" style="color: white">Assign Date</td>
                                        <td class="font-size-20" style="color: white">Assignee</td>
                                        <td class="borderingRightTable font-size-20" style="color: white">Action</td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #c7c7c7">
                                        <td style="font-family: 'Poppins'; color:#000">1</td>
                                        <td style="font-family: 'Poppins'; color:#000">Laptop</td>
                                        <td style="font-family: 'Poppins'; color:#000">AST-001</td>
                                        <td style="font-family: 'Poppins'; color:#000">22 April,2024</td>
                                        <td style="font-family: 'Poppins'; color:#000">{{ $emp_data->Emp_Full_Name }}</td>
                                        <td style="font-family: 'Poppins'; color:#000"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="#14213d" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg></td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #c7c7c7">
                                        <td style="font-family: 'Poppins'; color:#000">2</td>
                                        <td style="font-family: 'Poppins'; color:#000">Keyboard</td>
                                        <td style="font-family: 'Poppins'; color:#000">AST-002</td>
                                        <td style="font-family: 'Poppins'; color:#000">22 April,2024</td>
                                        <td style="font-family: 'Poppins'; color:#000">{{ $emp_data->Emp_Full_Name }}</td>
                                        <td style="font-family: 'Poppins'; color:#000"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="#14213d" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg></td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #c7c7c7">
                                        <td style="font-family: 'Poppins'; color:#000">3</td>
                                        <td style="font-family: 'Poppins'; color:#000">Mouse</td>
                                        <td style="font-family: 'Poppins'; color:#000">AST-003</td>
                                        <td style="font-family: 'Poppins'; color:#000">22 April,2024</td>
                                        <td style="font-family: 'Poppins'; color:#000">{{ $emp_data->Emp_Full_Name }}</td>
                                        <td style="font-family: 'Poppins'; color:#000"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="#14213d" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg></td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #c7c7c7">
                                        <td style="font-family: 'Poppins'; color:#000">4</td>
                                        <td style="font-family: 'Poppins'; color:#000">Wifi</td>
                                        <td style="font-family: 'Poppins'; color:#000">AST-004</td>
                                        <td style="font-family: 'Poppins'; color:#000">22 April,2024</td>
                                        <td style="font-family: 'Poppins'; color:#000">{{ $emp_data->Emp_Full_Name }}</td>
                                        <td style="font-family: 'Poppins'; color:#000"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="#14213d" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg></td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #c7c7c7">
                                        <td style="font-family: 'Poppins'; color:#000">5</td>
                                        <td style="font-family: 'Poppins'; color:#000">Handfrees</td>
                                        <td style="font-family: 'Poppins'; color:#000">AST-005</td>
                                        <td style="font-family: 'Poppins'; color:#000">22 April,2024</td>
                                        <td style="font-family: 'Poppins'; color:#000">{{ $emp_data->Emp_Full_Name }}</td>
                                        <td style="font-family: 'Poppins'; color:#000"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="#14213d" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                <path
                                                    d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg></td>
                                    </tr>



                                </table>
                            </div>

                        </div>
                    </div>


                </div>
                {{-- bank details --}}

            </div>
        </div>




        {{-- personal info --}}

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
        <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
