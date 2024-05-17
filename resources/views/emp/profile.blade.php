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
            .popup {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, 0.5);
                width: 100%;
                height: 100%;
                z-index: 1000;
                backdrop-filter: blur(5px);
            }

            .popup-content {
                /* overflow-y: scroll;
                            scroll-behavior: smooth scroll; */
                display: flex;
                max-width: 700px;
                margin: auto auto;
                position: relative;
                top: 100px;
                justify-content: center;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
                text-align: center;
            }

            .closeBtn {
                position: absolute;
                top: 25px;
                right: 15px;
                cursor: pointer;
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
                                    <div id="popupButton"
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#14213d50" class="bi bi-pencil-fill" viewBox="0 0 16 16">
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
                    <div class="popup" id="popup">
                        <div class="popup-content flex-column">
                            <div class="d-flex mb-3 align-items-center justify-content-between">
                                <h2 class="mb-0" style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">Personal
                                    Information</h2>
                                <span class="closeBtn p-2" style="border-radius: 50%; background-color:#14213d26"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="20" height="20" fill="#14213d50"
                                        class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                    </svg></span>
                            </div>
                            <div>
                                <form action="" class="text-start">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex flex-column">
                                                <label for="">Passport No:</label>
                                                <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg fill="#9e9e9e" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 448 448" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M368,0H80C57.944,0,40,17.944,40,40v368c0,22.056,17.944,40,40,40h288c22.056,0,40-17.944,40-40V40 C408,17.944,390.056,0,368,0z M392,408c0,13.234-10.767,24-24,24H80c-13.233,0-24-10.766-24-24V40c0-13.234,10.767-24,24-24h288 c13.233,0,24,10.766,24,24V408z"></path> <path d="M224,64c-61.757,0-112,50.243-112,112s50.243,112,112,112s112-50.243,112-112S285.757,64,224,64z M311.259,216H283.94 c2.127-10.018,3.469-20.756,3.903-32h31.821C318.724,195.335,315.808,206.117,311.259,216z M136.741,136h27.319 c-2.127,10.018-3.469,20.756-3.903,32h-31.821C129.276,156.665,132.192,145.883,136.741,136z M192,120h-6.693 c7.291-19.879,18.259-34.219,30.693-38.595V168h-39.823c0.491-11.28,2.007-22.074,4.357-32H192c4.418,0,8-3.582,8-8 S196.418,120,192,120z M262.693,120H232V81.405C244.434,85.781,255.402,100.121,262.693,120z M128.336,184h31.821 c0.434,11.244,1.776,21.982,3.903,32h-27.319C132.192,206.117,129.276,195.335,128.336,184z M176.177,184H216v32h-35.466 C178.185,206.074,176.668,195.28,176.177,184z M216,232v38.595c-12.434-4.377-23.402-18.716-30.693-38.595H216z M232,270.595V232 h30.693C255.402,251.879,244.434,266.219,232,270.595z M232,216v-80h35.466c2.349,9.926,3.865,20.72,4.356,32H256 c-4.418,0-8,3.582-8,8s3.582,8,8,8h15.823c-0.491,11.28-2.007,22.074-4.356,32H232z M287.843,168 c-0.434-11.244-1.776-21.982-3.903-32h27.319c4.548,9.883,7.465,20.665,8.405,32H287.843z M301.927,120h-22.235 c-3.838-11.862-8.88-22.308-14.854-30.868C279.666,96.132,292.425,106.816,301.927,120z M183.163,89.132 c-5.975,8.559-11.016,19.005-14.855,30.868h-22.235C155.575,106.816,168.334,96.132,183.163,89.132z M146.073,232h22.235 c3.838,11.862,8.88,22.308,14.855,30.868C168.334,255.868,155.575,245.184,146.073,232z M264.837,262.868 c5.975-8.559,11.016-19.005,14.854-30.868h22.235C292.425,245.184,279.666,255.868,264.837,262.868z"></path> <path d="M326,328H120c-4.418,0-8,3.582-8,8s3.582,8,8,8h206c4.418,0,8-3.582,8-8S330.418,328,326,328z"></path> <path d="M193,360h-41c-4.418,0-8,3.582-8,8s3.582,8,8,8h41c4.418,0,8-3.582,8-8S197.418,360,193,360z"></path> <path d="M296,360h-72c-4.418,0-8,3.582-8,8s3.582,8,8,8h72c4.418,0,8-3.582,8-8S300.418,360,296,360z"></path> </g> </g></svg>
                                                    <input type="text"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Passport" id="passport" autocomplete="current-password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex flex-column">
                                                <label for="">Passport Exp No:</label>
                                                <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                     <svg fill="#9e9e9e" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 448 448" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M368,0H80C57.944,0,40,17.944,40,40v368c0,22.056,17.944,40,40,40h288c22.056,0,40-17.944,40-40V40 C408,17.944,390.056,0,368,0z M392,408c0,13.234-10.767,24-24,24H80c-13.233,0-24-10.766-24-24V40c0-13.234,10.767-24,24-24h288 c13.233,0,24,10.766,24,24V408z"></path> <path d="M224,64c-61.757,0-112,50.243-112,112s50.243,112,112,112s112-50.243,112-112S285.757,64,224,64z M311.259,216H283.94 c2.127-10.018,3.469-20.756,3.903-32h31.821C318.724,195.335,315.808,206.117,311.259,216z M136.741,136h27.319 c-2.127,10.018-3.469,20.756-3.903,32h-31.821C129.276,156.665,132.192,145.883,136.741,136z M192,120h-6.693 c7.291-19.879,18.259-34.219,30.693-38.595V168h-39.823c0.491-11.28,2.007-22.074,4.357-32H192c4.418,0,8-3.582,8-8 S196.418,120,192,120z M262.693,120H232V81.405C244.434,85.781,255.402,100.121,262.693,120z M128.336,184h31.821 c0.434,11.244,1.776,21.982,3.903,32h-27.319C132.192,206.117,129.276,195.335,128.336,184z M176.177,184H216v32h-35.466 C178.185,206.074,176.668,195.28,176.177,184z M216,232v38.595c-12.434-4.377-23.402-18.716-30.693-38.595H216z M232,270.595V232 h30.693C255.402,251.879,244.434,266.219,232,270.595z M232,216v-80h35.466c2.349,9.926,3.865,20.72,4.356,32H256 c-4.418,0-8,3.582-8,8s3.582,8,8,8h15.823c-0.491,11.28-2.007,22.074-4.356,32H232z M287.843,168 c-0.434-11.244-1.776-21.982-3.903-32h27.319c4.548,9.883,7.465,20.665,8.405,32H287.843z M301.927,120h-22.235 c-3.838-11.862-8.88-22.308-14.854-30.868C279.666,96.132,292.425,106.816,301.927,120z M183.163,89.132 c-5.975,8.559-11.016,19.005-14.855,30.868h-22.235C155.575,106.816,168.334,96.132,183.163,89.132z M146.073,232h22.235 c3.838,11.862,8.88,22.308,14.855,30.868C168.334,255.868,155.575,245.184,146.073,232z M264.837,262.868 c5.975-8.559,11.016-19.005,14.854-30.868h22.235C292.425,245.184,279.666,255.868,264.837,262.868z"></path> <path d="M326,328H120c-4.418,0-8,3.582-8,8s3.582,8,8,8h206c4.418,0,8-3.582,8-8S330.418,328,326,328z"></path> <path d="M193,360h-41c-4.418,0-8,3.582-8,8s3.582,8,8,8h41c4.418,0,8-3.582,8-8S197.418,360,193,360z"></path> <path d="M296,360h-72c-4.418,0-8,3.582-8,8s3.582,8,8,8h72c4.418,0,8-3.582,8-8S300.418,360,296,360z"></path> </g> </g></svg>
                                                    <input type="date"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Exp Passport" id="passportExp"
                                                         autocomplete="current-password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex flex-column">
                                                <label for="">Telephone No:</label>
                                                <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z" stroke="#9e9e9e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    <input type="number"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Telephone No" id="phoneNo" autocomplete="current-password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex flex-column">
                                                <label for="">Religion:</label>
                                                <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg style="width: 20px; height:20px;" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" width="64px" height="64px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:none;stroke:#9e9e9e;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;} .st1{fill:none;stroke:#9e9e9e;stroke-width:2;stroke-linejoin:round;stroke-miterlimit:10;} </style> <path class="st0" d="M17,5c-0.27,0-0.54,0.02-0.8,0.04C19.05,6.55,21,9.55,21,13c0,4.97-4.03,9-9,9c-2.74,0-5.19-1.23-6.85-3.17 C6.04,24.59,11,29,17,29c6.63,0,12-5.37,12-12S23.63,5,17,5z"></path> <g> <path class="st0" d="M11,9c-2.58,0.62-3.38,1.42-4,4c-0.62-2.58-1.42-3.38-4-4c2.58-0.62,3.38-1.42,4-4C7.62,7.58,8.42,8.38,11,9z"></path> </g> <line class="st0" x1="12" y1="14" x2="12" y2="16"></line> <line class="st0" x1="11" y1="15" x2="13" y2="15"></line> </g></svg>
                                                    <input type="text"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Religion" id="religion" autocomplete="current-password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex flex-column">
                                                <label for="">No of Childern:</label>
                                                <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg height="20px" width="20px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#9e9e9e;} </style> <g> <path class="st0" d="M201.932,253.38c1.451,5.29,6.918,8.388,12.19,6.933c5.29-1.462,8.387-6.918,6.933-12.202 c-2.24-8.112-7.06-15.11-13.508-20.104c-6.448-4.986-14.611-7.975-23.378-7.975c-8.702,0-16.815,2.938-23.238,7.867 c-6.429,4.928-11.256,11.846-13.547,19.88c-1.505,5.268,1.549,10.753,6.817,12.259c5.269,1.498,10.761-1.556,12.259-6.824 c1.09-3.828,3.412-7.179,6.532-9.56c3.115-2.381,6.936-3.777,11.177-3.784c4.273,0.007,8.112,1.426,11.25,3.836 C198.542,246.115,200.865,249.515,201.932,253.38z"></path> <path class="st0" d="M311.928,253.22c1.093-3.835,3.423-7.178,6.535-9.567c3.122-2.381,6.944-3.777,11.184-3.784 c4.27,0.007,8.109,1.426,11.246,3.836c3.122,2.41,5.446,5.81,6.513,9.675c1.455,5.29,6.911,8.388,12.194,6.933 c5.287-1.462,8.384-6.918,6.926-12.202c-2.237-8.112-7.053-15.11-13.508-20.104c-6.444-4.986-14.608-7.975-23.371-7.975 c-8.706,0-16.818,2.938-23.241,7.867c-6.43,4.928-11.253,11.846-13.551,19.88c-1.505,5.26,1.541,10.746,6.81,12.252 C304.934,261.536,310.426,258.49,311.928,253.22z"></path> <path class="st0" d="M494.006,217.703c-10.063-10.066-23.722-16.666-38.829-17.774c-9.434-44.376-33.185-83.455-66.17-112.156 c-36.047-31.35-83.231-50.368-134.746-50.368c-51.443,0-98.569,18.96-134.583,50.216c-33.188,28.795-57.047,68.076-66.43,112.676 c-13.692,1.788-26.013,8.134-35.28,17.405C6.886,228.782,0,244.226,0,261.145c0,16.891,6.886,32.334,17.969,43.414 c11.076,11.08,26.519,17.969,43.436,17.969c1.168,0,2.297-0.029,3.433-0.087c14.792,35.142,39.054,65.319,69.604,87.312 c14.054,10.117,29.472,18.505,45.907,24.851c-1.979-6.94-3.003-14.227-3.003-21.653c0-3.423,0.224-6.853,0.68-10.196 c-9.52-4.537-18.562-9.914-27.037-16.008c-29.078-20.921-51.58-50.476-63.735-84.852l-4.392-12.411l-12.697,3.488 c-2.92,0.789-5.808,1.216-8.76,1.216c-9.176,0-17.365-3.684-23.379-9.69c-6.003-6.014-9.69-14.199-9.69-23.354 c0-9.184,3.686-17.375,9.69-23.382c6.014-6.006,14.202-9.69,23.379-9.69c0.571,0,1.422,0.058,2.616,0.137l13.17,1.021l1.962-13.026 c6.401-42.574,27.995-80.176,59.085-107.155c7.769-6.738,16.131-12.809,24.985-18.136c0.767,4.805,1.951,9.307,3.6,13.439 c2.609,6.564,6.278,12.252,10.613,17.108c7.61,8.518,17.126,14.517,27.066,19.43c14.922,7.331,31.046,12.412,44.6,18.744 c6.77,3.141,12.864,6.557,17.868,10.494c5.015,3.958,8.923,8.343,11.705,13.684c1.502,2.888,4.494,4.654,7.744,4.581 c3.256-0.079,6.158-1.983,7.523-4.943c14.694-31.842,19.995-56.896,19.999-76.572c0.022-13.432-2.511-24.294-6.072-32.848 c23.295,7.396,44.502,19.452,62.548,35.127c31.118,27.073,52.655,64.763,59.002,107.438l2.102,14.054l14.054-2.15 c1.87-0.29,3.517-0.427,5.014-0.427c9.184,0,17.34,3.684,23.379,9.69c6.011,6.007,9.665,14.198,9.69,23.382 c-0.025,9.154-3.679,17.339-9.69,23.354c-6.039,6.006-14.195,9.69-23.379,9.69c-3.796,0-7.428-0.688-10.938-1.896l-13.432-4.74 l-4.679,13.431c-12.017,34.606-34.487,64.393-63.622,85.473c-7.624,5.522-15.697,10.458-24.172,14.713 c0.597,3.879,0.876,7.794,0.876,11.781c0,6.89-0.876,13.635-2.577,20.126c15.165-6.232,29.422-14.199,42.477-23.665 c30.413-22.022,54.551-52.148,69.267-87.283c2.208,0.253,4.506,0.398,6.799,0.398c16.924,0,32.334-6.89,43.418-17.969 C505.082,293.48,512,278.036,512,261.145C512,244.226,505.082,228.782,494.006,217.703z M221.634,130.007 c-12.328-5.196-23.143-11-30.474-18.736c-3.691-3.879-6.586-8.214-8.641-13.46c-1.708-4.364-2.794-9.459-3.13-15.465 c11.134-5.204,22.879-9.307,35.128-12.115c0.058,9.625,2.298,24.692,11.879,42.798c4.277,8.12,10.016,16.818,17.625,25.937 C236.419,135.898,228.795,133.04,221.634,130.007z M286.679,156.638c-23.918-19.236-37.534-36.936-45.252-51.548 c-8.388-15.906-9.896-28.202-9.911-35.323c0-0.955,0.032-1.795,0.076-2.554c7.421-0.948,14.98-1.469,22.669-1.469 c10.41,0,20.596,0.934,30.507,2.648c1.02,1.187,2.088,2.548,3.148,4.147c4.476,6.788,8.988,17.448,9.021,34.339 C296.941,119.637,294.256,136.021,286.679,156.638z"></path> <path class="st0" d="M255.995,351.33c-16.97-0.007-32.475,6.926-43.584,18.056c-11.126,11.102-18.052,26.61-18.048,43.58 c-0.004,16.97,6.922,32.479,18.048,43.58c11.108,11.131,26.613,18.056,43.584,18.049c16.974,0.007,32.479-6.918,43.584-18.049 c11.134-11.101,18.056-26.61,18.052-43.58c0.004-16.97-6.918-32.478-18.052-43.58C288.474,358.256,272.969,351.323,255.995,351.33z M284.667,425.074c-2.348,5.558-6.311,10.341-11.286,13.699c-4.99,3.358-10.888,5.298-17.386,5.304 c-4.335-0.007-8.391-0.875-12.1-2.446c-5.565-2.345-10.345-6.31-13.703-11.282c-3.358-4.986-5.294-10.891-5.301-17.383 c0-4.342,0.868-8.394,2.435-12.107c2.348-5.558,6.31-10.341,11.286-13.699c4.986-3.358,10.888-5.298,17.383-5.305 c4.342,0.007,8.391,0.876,12.104,2.439c5.569,2.352,10.349,6.318,13.706,11.29c3.358,4.979,5.294,10.891,5.298,17.383 C287.102,417.301,286.234,421.353,284.667,425.074z"></path> <path class="st0" d="M255.998,314.364c-41.854,0-75.809,20.292-75.809,45.339c0,7.483,3.036,14.546,8.424,20.777 c3.257-5.384,7.222-10.428,11.782-14.994c14.828-14.843,34.578-23.035,55.575-23.035c21.084,0,40.808,8.192,55.654,23.07 c4.563,4.531,8.507,9.574,11.764,14.959c5.388-6.231,8.416-13.294,8.416-20.777C331.804,334.657,297.882,314.364,255.998,314.364z"></path> </g> </g></svg>
                                                    <input type="text"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter No of Childern"
                                                        name="childern" autocomplete="current-password">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="mt-2">
                                        <button class="px-4 py-2 reblateBtn" type="button">Submit</button>

                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body bg-light" style="border: 1px solid #c7c7c7">
                                <div class="ms-3 w-full">
                                    <div id="popupButton2"
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#14213d50" class="bi bi-pencil-fill" viewBox="0 0 16 16">
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
                            <div class="popup" id="popup2">
                                <div class="popup-content flex-column">
                                    <div class="d-flex mb-3 align-items-center justify-content-between">
                                        <h2 class="mb-0" style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">Emergency Contact</h2>
                                        <span class="closeBtn2 p-2" style="border-radius: 50%; background-color:#14213d26"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="20" height="20" fill="#14213d50"
                                                class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                            </svg></span>
                                    </div>
                                    <form action="" class="text-start">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Primary Name:</label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg height="20px" width="20px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#9e9e9e;} </style> <g> <path class="st0" d="M256,265.308c73.252,0,132.644-59.391,132.644-132.654C388.644,59.412,329.252,0,256,0 c-73.262,0-132.643,59.412-132.643,132.654C123.357,205.917,182.738,265.308,256,265.308z"></path> <path class="st0" d="M425.874,393.104c-5.922-35.474-36-84.509-57.552-107.465c-5.829-6.212-15.948-3.628-19.504-1.427 c-27.04,16.672-58.782,26.399-92.819,26.399c-34.036,0-65.778-9.727-92.818-26.399c-3.555-2.201-13.675-4.785-19.505,1.427 c-21.55,22.956-51.628,71.991-57.551,107.465C71.573,480.444,164.877,512,256,512C347.123,512,440.427,480.444,425.874,393.104z"></path> </g> </g></svg>
                                                        <input type="text"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Primary Name" id="passport"  >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Relationship:</label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                         <svg fill="#9e9e9e" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 565.701 565.701" xml:space="preserve" stroke="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M47.567,164.346c0-37.285,30.225-67.504,67.504-67.504c37.279,0,67.504,30.228,67.504,67.504 c0,37.279-30.225,67.501-67.504,67.501C77.792,231.847,47.567,201.625,47.567,164.346z M450.637,231.847 c37.273,0,67.501-30.222,67.501-67.501c0-37.285-30.228-67.504-67.501-67.504c-37.279,0-67.507,30.228-67.507,67.504 C383.13,201.625,413.357,231.847,450.637,231.847z M565.701,308.258v70.072l-0.484-0.006l-4.521,2.294 c-2.199,1.123-36.907,18.098-96.824,19.162c-30.057,40.631-98.231,69.079-177.377,69.079c-79.266,0-147.532-28.531-177.523-69.269 c-13.134-0.531-27.26-1.844-42.327-4.196l-18.515-3.381c-13.716-2.79-28.059-6.378-43.113-11.077l-4.835-1.513L0,378.33v-70.072 c0-40.024,27.405-73.695,64.41-83.469c13.293,12.401,31.076,20.059,50.655,20.059c19.579,0,37.356-7.658,50.655-20.059 c15.439,4.079,29.093,12.425,39.874,23.555c24.639-6.777,52.03-10.592,80.895-10.592c26.581,0,51.927,3.215,75.014,9.014 c10.568-10.362,23.738-18.087,38.468-21.977c13.299,12.401,31.073,20.059,50.655,20.059c19.576,0,37.355-7.658,50.655-20.059 c28.773,7.602,51.672,29.675,60.461,57.929l3.6,17.928C565.577,303.151,565.701,305.692,565.701,308.258z M446.162,399.639 c-13.601-0.485-28.254-1.797-43.946-4.244l-18.519-3.381c-13.713-2.802-28.059-6.384-43.119-11.089l-4.829-1.513l-0.184-1.088 v-70.066c0-18.418,5.864-35.443,15.723-49.461c-20.108-4.407-41.942-6.851-64.787-6.851c-25.301,0-49.373,2.976-71.222,8.328 c4.631,6.871,8.399,14.363,10.917,22.443l3.603,17.928c0.225,2.512,0.346,5.053,0.346,7.612v70.072l-0.485-0.006l-4.522,2.294 c-2.222,1.123-37.418,18.358-98.154,19.186c29.912,32.557,90.166,54.87,159.517,54.87 C355.952,454.674,416.283,432.284,446.162,399.639z"></path> </g> </g></svg>
                                                        <input type="text"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Relationship" id="passportExp"
                                                            >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Phone No:</label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z" stroke="#9e9e9e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                        <input type="number"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Telephone No" id="phoneNo" autocomplete="current-password">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Secoundary Name:</label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg height="20px" width="20px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#9e9e9e;} </style> <g> <path class="st0" d="M256,265.308c73.252,0,132.644-59.391,132.644-132.654C388.644,59.412,329.252,0,256,0 c-73.262,0-132.643,59.412-132.643,132.654C123.357,205.917,182.738,265.308,256,265.308z"></path> <path class="st0" d="M425.874,393.104c-5.922-35.474-36-84.509-57.552-107.465c-5.829-6.212-15.948-3.628-19.504-1.427 c-27.04,16.672-58.782,26.399-92.819,26.399c-34.036,0-65.778-9.727-92.818-26.399c-3.555-2.201-13.675-4.785-19.505,1.427 c-21.55,22.956-51.628,71.991-57.551,107.465C71.573,480.444,164.877,512,256,512C347.123,512,440.427,480.444,425.874,393.104z"></path> </g> </g></svg>
                                                        <input type="text"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Primary Name" id="passport"  >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Relationship:</label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                         <svg fill="#9e9e9e" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 565.701 565.701" xml:space="preserve" stroke="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M47.567,164.346c0-37.285,30.225-67.504,67.504-67.504c37.279,0,67.504,30.228,67.504,67.504 c0,37.279-30.225,67.501-67.504,67.501C77.792,231.847,47.567,201.625,47.567,164.346z M450.637,231.847 c37.273,0,67.501-30.222,67.501-67.501c0-37.285-30.228-67.504-67.501-67.504c-37.279,0-67.507,30.228-67.507,67.504 C383.13,201.625,413.357,231.847,450.637,231.847z M565.701,308.258v70.072l-0.484-0.006l-4.521,2.294 c-2.199,1.123-36.907,18.098-96.824,19.162c-30.057,40.631-98.231,69.079-177.377,69.079c-79.266,0-147.532-28.531-177.523-69.269 c-13.134-0.531-27.26-1.844-42.327-4.196l-18.515-3.381c-13.716-2.79-28.059-6.378-43.113-11.077l-4.835-1.513L0,378.33v-70.072 c0-40.024,27.405-73.695,64.41-83.469c13.293,12.401,31.076,20.059,50.655,20.059c19.579,0,37.356-7.658,50.655-20.059 c15.439,4.079,29.093,12.425,39.874,23.555c24.639-6.777,52.03-10.592,80.895-10.592c26.581,0,51.927,3.215,75.014,9.014 c10.568-10.362,23.738-18.087,38.468-21.977c13.299,12.401,31.073,20.059,50.655,20.059c19.576,0,37.355-7.658,50.655-20.059 c28.773,7.602,51.672,29.675,60.461,57.929l3.6,17.928C565.577,303.151,565.701,305.692,565.701,308.258z M446.162,399.639 c-13.601-0.485-28.254-1.797-43.946-4.244l-18.519-3.381c-13.713-2.802-28.059-6.384-43.119-11.089l-4.829-1.513l-0.184-1.088 v-70.066c0-18.418,5.864-35.443,15.723-49.461c-20.108-4.407-41.942-6.851-64.787-6.851c-25.301,0-49.373,2.976-71.222,8.328 c4.631,6.871,8.399,14.363,10.917,22.443l3.603,17.928c0.225,2.512,0.346,5.053,0.346,7.612v70.072l-0.485-0.006l-4.522,2.294 c-2.222,1.123-37.418,18.358-98.154,19.186c29.912,32.557,90.166,54.87,159.517,54.87 C355.952,454.674,416.283,432.284,446.162,399.639z"></path> </g> </g></svg>
                                                        <input type="text"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Relationship" id="passportExp"
                                                            >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Phone No:</label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z" stroke="#9e9e9e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                        <input type="number"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Telephone No" id="phoneNo" autocomplete="current-password">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mt-2">
                                            <button class="px-4 py-2 reblateBtn" type="button">Submit</button>

                                        </div>

                                    </form>
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
                                    <div id="popupButton3"
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#14213d50" class="bi bi-pencil-fill" viewBox="0 0 16 16">
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
                                <div class="popup" id="popup3">
                                    <div class="popup-content flex-column">
                                        <div class="d-flex mb-3 align-items-center justify-content-between">
                                            <h2 class="mb-0" style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">Education Information</h2>
                                            <span class="closeBtn3 p-2" style="border-radius: 50%; background-color:#14213d26"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="20" height="20" fill="#14213d50"
                                                    class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                </svg></span>
                                        </div>
                                        <form action="" class="text-start">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Title:</label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg height="20px" width="20px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#9e9e9e;} </style> <g> <path class="st0" d="M256,265.308c73.252,0,132.644-59.391,132.644-132.654C388.644,59.412,329.252,0,256,0 c-73.262,0-132.643,59.412-132.643,132.654C123.357,205.917,182.738,265.308,256,265.308z"></path> <path class="st0" d="M425.874,393.104c-5.922-35.474-36-84.509-57.552-107.465c-5.829-6.212-15.948-3.628-19.504-1.427 c-27.04,16.672-58.782,26.399-92.819,26.399c-34.036,0-65.778-9.727-92.818-26.399c-3.555-2.201-13.675-4.785-19.505,1.427 c-21.55,22.956-51.628,71.991-57.551,107.465C71.573,480.444,164.877,512,256,512C347.123,512,440.427,480.444,425.874,393.104z"></path> </g> </g></svg>
                                                            <input type="text"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Primary Name" id="passport"  >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Relationship:</label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                             <svg fill="#9e9e9e" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 565.701 565.701" xml:space="preserve" stroke="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M47.567,164.346c0-37.285,30.225-67.504,67.504-67.504c37.279,0,67.504,30.228,67.504,67.504 c0,37.279-30.225,67.501-67.504,67.501C77.792,231.847,47.567,201.625,47.567,164.346z M450.637,231.847 c37.273,0,67.501-30.222,67.501-67.501c0-37.285-30.228-67.504-67.501-67.504c-37.279,0-67.507,30.228-67.507,67.504 C383.13,201.625,413.357,231.847,450.637,231.847z M565.701,308.258v70.072l-0.484-0.006l-4.521,2.294 c-2.199,1.123-36.907,18.098-96.824,19.162c-30.057,40.631-98.231,69.079-177.377,69.079c-79.266,0-147.532-28.531-177.523-69.269 c-13.134-0.531-27.26-1.844-42.327-4.196l-18.515-3.381c-13.716-2.79-28.059-6.378-43.113-11.077l-4.835-1.513L0,378.33v-70.072 c0-40.024,27.405-73.695,64.41-83.469c13.293,12.401,31.076,20.059,50.655,20.059c19.579,0,37.356-7.658,50.655-20.059 c15.439,4.079,29.093,12.425,39.874,23.555c24.639-6.777,52.03-10.592,80.895-10.592c26.581,0,51.927,3.215,75.014,9.014 c10.568-10.362,23.738-18.087,38.468-21.977c13.299,12.401,31.073,20.059,50.655,20.059c19.576,0,37.355-7.658,50.655-20.059 c28.773,7.602,51.672,29.675,60.461,57.929l3.6,17.928C565.577,303.151,565.701,305.692,565.701,308.258z M446.162,399.639 c-13.601-0.485-28.254-1.797-43.946-4.244l-18.519-3.381c-13.713-2.802-28.059-6.384-43.119-11.089l-4.829-1.513l-0.184-1.088 v-70.066c0-18.418,5.864-35.443,15.723-49.461c-20.108-4.407-41.942-6.851-64.787-6.851c-25.301,0-49.373,2.976-71.222,8.328 c4.631,6.871,8.399,14.363,10.917,22.443l3.603,17.928c0.225,2.512,0.346,5.053,0.346,7.612v70.072l-0.485-0.006l-4.522,2.294 c-2.222,1.123-37.418,18.358-98.154,19.186c29.912,32.557,90.166,54.87,159.517,54.87 C355.952,454.674,416.283,432.284,446.162,399.639z"></path> </g> </g></svg>
                                                            <input type="text"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Relationship" id="passportExp"
                                                                >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Phone No:</label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor " style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z" stroke="#9e9e9e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                            <input type="number"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Telephone No" id="phoneNo" autocomplete="current-password">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <button class="px-4 py-2 reblateBtn" type="button">Submit</button>

                                            </div>

                                        </form>
                                    </div>
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
             document.addEventListener('DOMContentLoaded', function() {
                const popupButton = document.getElementById('popupButton');
                const popup = document.getElementById('popup');
                const closeBtn = document.querySelector('.closeBtn');

                popupButton.addEventListener('click', function() {
                    popup.style.display = 'block';
                });

                closeBtn.addEventListener('click', function() {
                    popup.style.display = 'none';
                });

                window.addEventListener('click', function(e) {
                    if (e.target === popup) {
                        popup.style.display = 'none';
                    }
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                const popupButton = document.getElementById('popupButton2');
                const popup = document.getElementById('popup2');
                const closeBtn = document.querySelector('.closeBtn2');

                popupButton.addEventListener('click', function() {
                    popup.style.display = 'block';
                });

                closeBtn.addEventListener('click', function() {
                    popup.style.display = 'none';
                });

                window.addEventListener('click', function(e) {
                    if (e.target === popup) {
                        popup.style.display = 'none';
                    }
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                const popupButton = document.getElementById('popupButton3');
                const popup = document.getElementById('popup3');
                const closeBtn = document.querySelector('.closeBtn3');

                popupButton.addEventListener('click', function() {
                    popup.style.display = 'block';
                });

                closeBtn.addEventListener('click', function() {
                    popup.style.display = 'none';
                });

                window.addEventListener('click', function(e) {
                    if (e.target === popup) {
                        popup.style.display = 'none';
                    }
                });
            });
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
