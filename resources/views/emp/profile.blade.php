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

            .upload-btn-wrapper {
                position: relative;
                overflow: hidden;
                display: inline-block;
            }

            .upload-btn-wrapper input[type=file] {
                font-size: 100px;
                position: absolute;
                left: 0;
                top: 0;
                opacity: 0;
            }

            #file_modal:hover {
                cursor: pointer;
            }

            .file-upload {
                display: inline-block;
                position: relative;
                overflow: hidden;
            }

            .file-upload-label {
                display: inline-block;
                padding: 20px;
                border: 2px dashed #ccc;
                border-radius: 5px;
                cursor: pointer;
                text-align: center;
                font-size: 16px;
            }

            .file-upload-label span {
                display: block;
            }

            #file-input {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                opacity: 0;
                cursor: pointer;
            }
            .remove-file {
                position: absolute;
                top: 5px;
                right: 5px;
                cursor: pointer;
                font-size: 14px;
                color: #f00;
                display: none;
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
                                    <a id="file_modal" onclick="openFileModal()"
                                        style="color:#fca311; text-decoration:underline; position: absolute;left: 50px;top: 190px;">Change
                                        Photo</a>
                                    {{-- <div class="upload-btn-wrapper" style="position: absolute;left: 50px;top: 190px;">
                                        <button class="btn">Upload a file</button>
                                        <input type="file" name="myfile" accept="image/png, image/gif, image/jpeg" />
                                      </div> --}}
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


                                                @if (isset($emp_data->Emp_Status) && $emp_data->Emp_Status == 'active')
                                                    <a href="javascript:void()"
                                                        onclick="statusChange('{{ $emp_data->Emp_Code }}')"
                                                        class="reblateBtn px-4 py-2"
                                                        style="border-radius: 10px;">Disable</a>
                                                @else
                                                    <a href="javascript:void()"
                                                        onclick="statusChange('{{ $emp_data->Emp_Code }}')"
                                                        class="reblateBtn px-4 py-2"
                                                        style="border-radius: 10px;">Activate</a>
                                                @endif
                                            @elseif(is_array($employees_access) && (in_array('all', $employees_access) || in_array('update', $employees_access)))
                                                <a href="/update-employee/{{ $emp_data->Emp_Code }}"
                                                    class="btn btn-primary">Edit</a>
                                                @if (isset($show_disable) && $show_disable == true)
                                                    {{-- <a href="/update-employee/{{$emp_data->Emp_Code}}" class="btn btn-primary">Disable</a> --}}
                                                    @if (isset($emp_data->Emp_Status) && $emp_data->Emp_Status == 'disable')
                                                        <a href="javascript:void()"
                                                            onclick="deleteEmployee('{{ $emp_data->Emp_Code }}')"
                                                            class="reblateBtn px-4 py-2"
                                                            style="border-radius: 10px;">Activate</a>
                                                    @else
                                                        <a href="javascript:void()"
                                                            onclick="deleteEmployee('{{ $emp_data->Emp_Code }}')"
                                                            class="reblateBtn px-4 py-2"
                                                            style="border-radius: 10px;">Disable</a>
                                                    @endif
                                                @endif

                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-3 mt-3 w-50" style="border-left: 3px dashed #c7c7c7">
                                    <ul class="personal-info m-0 ms-5 p-0" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Phone No:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation_Phone }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Email:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Email }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Birthday</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->emp_birthday }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Address:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Address }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Gender:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Gender }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Marital Status:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Marital_Status }}</p>
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

            <input type="hidden" id="emp_code_file" value="{{$emp_data->Emp_Code}}">

            <div class="popup" id="popup_file">
                <div class="popup-content flex-column">
                    <div class="d-flex mb-3 align-items-center justify-content-between">
                        <h2 class="mb-0"
                            style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                            File Upload</h2>
                        <span class="closeBtn p-2" style="border-radius: 50%; background-color:#14213d26"><svg
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#14213d50"
                                class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path
                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                            </svg></span>
                    </div>
                    <div>
                        <form action="" class="text-start">
                            <p id="success_message_file" style="color:green;font-size:15px;display:none;">Image Saved</p>
                            <p id="error_message_file" style="color:red;font-size:15px;display:none;">Image Saved</p>
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="file-upload">
                                        <label for="file-input" class="file-upload-label">
                                            <span id="file-label">Upload file here</span>
                                            <input id="file-input" accept="image/png, image/gif, image/jpeg" type="file" onchange="updateFileName(this)">
                                            {{-- <span class="remove-file"  id="remove" onclick="removeFile()">x</span> --}}
                                        </label>
                                    </div>

                                    <script>
                                        function updateFileName(input) {
                                            var file = document.getElementById('remove');

                                            var fileName = input.files[0].name;
                                            var error = document.getElementById('select-file');

                                            if (fileName == "") {

                                                error.style.display = "block";
                                                file.style.display = "block";
                                                return;
                                            } else {
                                                document.querySelector('.remove-file').style.display = fileName !== '' ? 'inline' : 'none'; // Show or hide remove button based on file selection
                                                error.style.display = "none";
                                                file.style.display = "none";
                                            }
                                            document.getElementById('file-label').textContent = 'Selected file: ' + fileName;
                                        }

                                        function removeFile() {
                                            var fileInput = document.getElementById('file-input');
                                            fileInput.value = ''; // Clear the file input value
                                            document.getElementById('file-label').textContent = 'Upload file here'; // Reset file label text
                                            document.querySelector('.remove-file').style.display = 'none'; // Hide remove button
                                        }
                                    </script>

                                    <p style="color:red;display:none;" id="select-file">Please Select A file</p>
                                </div>

                            </div>
                            <div class="mt-2">
                                <button class="px-4 py-2 reblateBtn" onclick="saveImage()" type="button">Upload
                                    Now</button>
                            </div>
                        </form>
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
                                            <h2 class="detailLabel mb-1">Passport No:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Passport_Number }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">CNIC:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->emp_cnic }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Tel No:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation_Phone }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Gender:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Gender }}</p>
                                        </li>
                                        <li class="d-flex gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Marital Status</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Marital_Status }}</p>
                                        </li>
                                        <li class="d-flex gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Birthday</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->emp_birthday }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="popup" id="popup">
                        <div class="popup-content flex-column">
                            <div class="d-flex mb-3 align-items-center justify-content-between">
                                <h2 class="mb-0"
                                    style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                    Personal
                                    Information</h2>
                                <span class="closeBtn p-2" id="closeClass" style="border-radius: 50%; background-color:#14213d26"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        fill="#14213d50" class="bi bi-x-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                    </svg></span>
                            </div>
                            <div>
                                <form action="" class="text-start">
                                    <p id="success_message" style="color:green;font-size:15px; display:none;"></p>
                                    <p id="error_message" style="color:#ce3b3b;font-size:15px; display:none;"></p>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex flex-column">
                                                <label for="">Passport No:</label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg fill="#9e9e9e" height="20px" width="20px" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 448 448"
                                                        xml:space="preserve">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g>
                                                                <path
                                                                    d="M368,0H80C57.944,0,40,17.944,40,40v368c0,22.056,17.944,40,40,40h288c22.056,0,40-17.944,40-40V40 C408,17.944,390.056,0,368,0z M392,408c0,13.234-10.767,24-24,24H80c-13.233,0-24-10.766-24-24V40c0-13.234,10.767-24,24-24h288 c13.233,0,24,10.766,24,24V408z">
                                                                </path>
                                                                <path
                                                                    d="M224,64c-61.757,0-112,50.243-112,112s50.243,112,112,112s112-50.243,112-112S285.757,64,224,64z M311.259,216H283.94 c2.127-10.018,3.469-20.756,3.903-32h31.821C318.724,195.335,315.808,206.117,311.259,216z M136.741,136h27.319 c-2.127,10.018-3.469,20.756-3.903,32h-31.821C129.276,156.665,132.192,145.883,136.741,136z M192,120h-6.693 c7.291-19.879,18.259-34.219,30.693-38.595V168h-39.823c0.491-11.28,2.007-22.074,4.357-32H192c4.418,0,8-3.582,8-8 S196.418,120,192,120z M262.693,120H232V81.405C244.434,85.781,255.402,100.121,262.693,120z M128.336,184h31.821 c0.434,11.244,1.776,21.982,3.903,32h-27.319C132.192,206.117,129.276,195.335,128.336,184z M176.177,184H216v32h-35.466 C178.185,206.074,176.668,195.28,176.177,184z M216,232v38.595c-12.434-4.377-23.402-18.716-30.693-38.595H216z M232,270.595V232 h30.693C255.402,251.879,244.434,266.219,232,270.595z M232,216v-80h35.466c2.349,9.926,3.865,20.72,4.356,32H256 c-4.418,0-8,3.582-8,8s3.582,8,8,8h15.823c-0.491,11.28-2.007,22.074-4.356,32H232z M287.843,168 c-0.434-11.244-1.776-21.982-3.903-32h27.319c4.548,9.883,7.465,20.665,8.405,32H287.843z M301.927,120h-22.235 c-3.838-11.862-8.88-22.308-14.854-30.868C279.666,96.132,292.425,106.816,301.927,120z M183.163,89.132 c-5.975,8.559-11.016,19.005-14.855,30.868h-22.235C155.575,106.816,168.334,96.132,183.163,89.132z M146.073,232h22.235 c3.838,11.862,8.88,22.308,14.855,30.868C168.334,255.868,155.575,245.184,146.073,232z M264.837,262.868 c5.975-8.559,11.016-19.005,14.854-30.868h22.235C292.425,245.184,279.666,255.868,264.837,262.868z">
                                                                </path>
                                                                <path
                                                                    d="M326,328H120c-4.418,0-8,3.582-8,8s3.582,8,8,8h206c4.418,0,8-3.582,8-8S330.418,328,326,328z">
                                                                </path>
                                                                <path
                                                                    d="M193,360h-41c-4.418,0-8,3.582-8,8s3.582,8,8,8h41c4.418,0,8-3.582,8-8S197.418,360,193,360z">
                                                                </path>
                                                                <path
                                                                    d="M296,360h-72c-4.418,0-8,3.582-8,8s3.582,8,8,8h72c4.418,0,8-3.582,8-8S300.418,360,296,360z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <input type="text"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Passport"
                                                        value="{{ $emp_data->Emp_Passport_Number }}"
                                                        id="passport_number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex flex-column">
                                                <label for="">CNIC <span style="color:#ce3b3b;">*</span> </label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg fill="#9e9e9e" height="20px" width="20px" version="1.1"
                                                        id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 448 448"
                                                        xml:space="preserve">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g>
                                                                <path
                                                                    d="M368,0H80C57.944,0,40,17.944,40,40v368c0,22.056,17.944,40,40,40h288c22.056,0,40-17.944,40-40V40 C408,17.944,390.056,0,368,0z M392,408c0,13.234-10.767,24-24,24H80c-13.233,0-24-10.766-24-24V40c0-13.234,10.767-24,24-24h288 c13.233,0,24,10.766,24,24V408z">
                                                                </path>
                                                                <path
                                                                    d="M224,64c-61.757,0-112,50.243-112,112s50.243,112,112,112s112-50.243,112-112S285.757,64,224,64z M311.259,216H283.94 c2.127-10.018,3.469-20.756,3.903-32h31.821C318.724,195.335,315.808,206.117,311.259,216z M136.741,136h27.319 c-2.127,10.018-3.469,20.756-3.903,32h-31.821C129.276,156.665,132.192,145.883,136.741,136z M192,120h-6.693 c7.291-19.879,18.259-34.219,30.693-38.595V168h-39.823c0.491-11.28,2.007-22.074,4.357-32H192c4.418,0,8-3.582,8-8 S196.418,120,192,120z M262.693,120H232V81.405C244.434,85.781,255.402,100.121,262.693,120z M128.336,184h31.821 c0.434,11.244,1.776,21.982,3.903,32h-27.319C132.192,206.117,129.276,195.335,128.336,184z M176.177,184H216v32h-35.466 C178.185,206.074,176.668,195.28,176.177,184z M216,232v38.595c-12.434-4.377-23.402-18.716-30.693-38.595H216z M232,270.595V232 h30.693C255.402,251.879,244.434,266.219,232,270.595z M232,216v-80h35.466c2.349,9.926,3.865,20.72,4.356,32H256 c-4.418,0-8,3.582-8,8s3.582,8,8,8h15.823c-0.491,11.28-2.007,22.074-4.356,32H232z M287.843,168 c-0.434-11.244-1.776-21.982-3.903-32h27.319c4.548,9.883,7.465,20.665,8.405,32H287.843z M301.927,120h-22.235 c-3.838-11.862-8.88-22.308-14.854-30.868C279.666,96.132,292.425,106.816,301.927,120z M183.163,89.132 c-5.975,8.559-11.016,19.005-14.855,30.868h-22.235C155.575,106.816,168.334,96.132,183.163,89.132z M146.073,232h22.235 c3.838,11.862,8.88,22.308,14.855,30.868C168.334,255.868,155.575,245.184,146.073,232z M264.837,262.868 c5.975-8.559,11.016-19.005,14.854-30.868h22.235C292.425,245.184,279.666,255.868,264.837,262.868z">
                                                                </path>
                                                                <path
                                                                    d="M326,328H120c-4.418,0-8,3.582-8,8s3.582,8,8,8h206c4.418,0,8-3.582,8-8S330.418,328,326,328z">
                                                                </path>
                                                                <path
                                                                    d="M193,360h-41c-4.418,0-8,3.582-8,8s3.582,8,8,8h41c4.418,0,8-3.582,8-8S197.418,360,193,360z">
                                                                </path>
                                                                <path
                                                                    d="M296,360h-72c-4.418,0-8,3.582-8,8s3.582,8,8,8h72c4.418,0,8-3.582,8-8S300.418,360,296,360z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <input type="text"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Exp Passport"
                                                        value="{{ $emp_data->emp_cnic }}" id="passportExp">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex flex-column">
                                                <label for="">Telephone No <span style="color:#ce3b3b;">*</span></label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        stroke="#9e9e9e">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path
                                                                d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z"
                                                                stroke="#9e9e9e" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                    <input type="number" value="{{ $emp_data->Emp_Relation_Phone }}"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Telephone No" id="phoneNo"
                                                        autocomplete="current-password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex flex-column">
                                                <label for="">Gender <span style="color:#ce3b3b;">*</span></label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg style="width: 20px; height:20px;" version="1.1" id="Icons"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32"
                                                        xml:space="preserve" width="64px" height="64px"
                                                        fill="#000000">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <style type="text/css">
                                                                .st0 {
                                                                    fill: none;
                                                                    stroke: #9e9e9e;
                                                                    stroke-width: 2;
                                                                    stroke-linecap: round;
                                                                    stroke-linejoin: round;
                                                                    stroke-miterlimit: 10;
                                                                }

                                                                .st1 {
                                                                    fill: none;
                                                                    stroke: #9e9e9e;
                                                                    stroke-width: 2;
                                                                    stroke-linejoin: round;
                                                                    stroke-miterlimit: 10;
                                                                }
                                                            </style>
                                                            <path class="st0"
                                                                d="M17,5c-0.27,0-0.54,0.02-0.8,0.04C19.05,6.55,21,9.55,21,13c0,4.97-4.03,9-9,9c-2.74,0-5.19-1.23-6.85-3.17 C6.04,24.59,11,29,17,29c6.63,0,12-5.37,12-12S23.63,5,17,5z">
                                                            </path>
                                                            <g>
                                                                <path class="st0"
                                                                    d="M11,9c-2.58,0.62-3.38,1.42-4,4c-0.62-2.58-1.42-3.38-4-4c2.58-0.62,3.38-1.42,4-4C7.62,7.58,8.42,8.38,11,9z">
                                                                </path>
                                                            </g>
                                                            <line class="st0" x1="12" y1="14"
                                                                x2="12" y2="16"></line>
                                                            <line class="st0" x1="11" y1="15"
                                                                x2="13" y2="15"></line>
                                                        </g>
                                                    </svg>
                                                    <select id="emp_gender"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        id="">
                                                        <option value="" {{ $emp_data->Emp_Gender == '' ? 'selected' : '' }}
                                                            >Select Gender
                                                        </option>
                                                        <option value="Male"
                                                            {{ $emp_data->Emp_Gender == 'Male' ? 'selected' : '' }}>Male
                                                        </option>
                                                        <option value="Female"
                                                            {{ $emp_data->Emp_Gender == 'Female' ? 'selected' : '' }}>
                                                            Female</option>
                                                        <option value="Other"
                                                            {{ $emp_data->Emp_Gender == 'Other' ? 'selected' : '' }}>Other
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex flex-column">
                                                <label for="">Marital Status <span style="color:#ce3b3b;">*</span> </label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg height="20px" width="20px" version="1.1" id="_x32_"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                        xml:space="preserve" fill="#000000">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <style type="text/css">
                                                                .st0 {
                                                                    fill: #9e9e9e;
                                                                }
                                                            </style>
                                                            <g>
                                                                <path class="st0"
                                                                    d="M201.932,253.38c1.451,5.29,6.918,8.388,12.19,6.933c5.29-1.462,8.387-6.918,6.933-12.202 c-2.24-8.112-7.06-15.11-13.508-20.104c-6.448-4.986-14.611-7.975-23.378-7.975c-8.702,0-16.815,2.938-23.238,7.867 c-6.429,4.928-11.256,11.846-13.547,19.88c-1.505,5.268,1.549,10.753,6.817,12.259c5.269,1.498,10.761-1.556,12.259-6.824 c1.09-3.828,3.412-7.179,6.532-9.56c3.115-2.381,6.936-3.777,11.177-3.784c4.273,0.007,8.112,1.426,11.25,3.836 C198.542,246.115,200.865,249.515,201.932,253.38z">
                                                                </path>
                                                                <path class="st0"
                                                                    d="M311.928,253.22c1.093-3.835,3.423-7.178,6.535-9.567c3.122-2.381,6.944-3.777,11.184-3.784 c4.27,0.007,8.109,1.426,11.246,3.836c3.122,2.41,5.446,5.81,6.513,9.675c1.455,5.29,6.911,8.388,12.194,6.933 c5.287-1.462,8.384-6.918,6.926-12.202c-2.237-8.112-7.053-15.11-13.508-20.104c-6.444-4.986-14.608-7.975-23.371-7.975 c-8.706,0-16.818,2.938-23.241,7.867c-6.43,4.928-11.253,11.846-13.551,19.88c-1.505,5.26,1.541,10.746,6.81,12.252 C304.934,261.536,310.426,258.49,311.928,253.22z">
                                                                </path>
                                                                <path class="st0"
                                                                    d="M494.006,217.703c-10.063-10.066-23.722-16.666-38.829-17.774c-9.434-44.376-33.185-83.455-66.17-112.156 c-36.047-31.35-83.231-50.368-134.746-50.368c-51.443,0-98.569,18.96-134.583,50.216c-33.188,28.795-57.047,68.076-66.43,112.676 c-13.692,1.788-26.013,8.134-35.28,17.405C6.886,228.782,0,244.226,0,261.145c0,16.891,6.886,32.334,17.969,43.414 c11.076,11.08,26.519,17.969,43.436,17.969c1.168,0,2.297-0.029,3.433-0.087c14.792,35.142,39.054,65.319,69.604,87.312 c14.054,10.117,29.472,18.505,45.907,24.851c-1.979-6.94-3.003-14.227-3.003-21.653c0-3.423,0.224-6.853,0.68-10.196 c-9.52-4.537-18.562-9.914-27.037-16.008c-29.078-20.921-51.58-50.476-63.735-84.852l-4.392-12.411l-12.697,3.488 c-2.92,0.789-5.808,1.216-8.76,1.216c-9.176,0-17.365-3.684-23.379-9.69c-6.003-6.014-9.69-14.199-9.69-23.354 c0-9.184,3.686-17.375,9.69-23.382c6.014-6.006,14.202-9.69,23.379-9.69c0.571,0,1.422,0.058,2.616,0.137l13.17,1.021l1.962-13.026 c6.401-42.574,27.995-80.176,59.085-107.155c7.769-6.738,16.131-12.809,24.985-18.136c0.767,4.805,1.951,9.307,3.6,13.439 c2.609,6.564,6.278,12.252,10.613,17.108c7.61,8.518,17.126,14.517,27.066,19.43c14.922,7.331,31.046,12.412,44.6,18.744 c6.77,3.141,12.864,6.557,17.868,10.494c5.015,3.958,8.923,8.343,11.705,13.684c1.502,2.888,4.494,4.654,7.744,4.581 c3.256-0.079,6.158-1.983,7.523-4.943c14.694-31.842,19.995-56.896,19.999-76.572c0.022-13.432-2.511-24.294-6.072-32.848 c23.295,7.396,44.502,19.452,62.548,35.127c31.118,27.073,52.655,64.763,59.002,107.438l2.102,14.054l14.054-2.15 c1.87-0.29,3.517-0.427,5.014-0.427c9.184,0,17.34,3.684,23.379,9.69c6.011,6.007,9.665,14.198,9.69,23.382 c-0.025,9.154-3.679,17.339-9.69,23.354c-6.039,6.006-14.195,9.69-23.379,9.69c-3.796,0-7.428-0.688-10.938-1.896l-13.432-4.74 l-4.679,13.431c-12.017,34.606-34.487,64.393-63.622,85.473c-7.624,5.522-15.697,10.458-24.172,14.713 c0.597,3.879,0.876,7.794,0.876,11.781c0,6.89-0.876,13.635-2.577,20.126c15.165-6.232,29.422-14.199,42.477-23.665 c30.413-22.022,54.551-52.148,69.267-87.283c2.208,0.253,4.506,0.398,6.799,0.398c16.924,0,32.334-6.89,43.418-17.969 C505.082,293.48,512,278.036,512,261.145C512,244.226,505.082,228.782,494.006,217.703z M221.634,130.007 c-12.328-5.196-23.143-11-30.474-18.736c-3.691-3.879-6.586-8.214-8.641-13.46c-1.708-4.364-2.794-9.459-3.13-15.465 c11.134-5.204,22.879-9.307,35.128-12.115c0.058,9.625,2.298,24.692,11.879,42.798c4.277,8.12,10.016,16.818,17.625,25.937 C236.419,135.898,228.795,133.04,221.634,130.007z M286.679,156.638c-23.918-19.236-37.534-36.936-45.252-51.548 c-8.388-15.906-9.896-28.202-9.911-35.323c0-0.955,0.032-1.795,0.076-2.554c7.421-0.948,14.98-1.469,22.669-1.469 c10.41,0,20.596,0.934,30.507,2.648c1.02,1.187,2.088,2.548,3.148,4.147c4.476,6.788,8.988,17.448,9.021,34.339 C296.941,119.637,294.256,136.021,286.679,156.638z">
                                                                </path>
                                                                <path class="st0"
                                                                    d="M255.995,351.33c-16.97-0.007-32.475,6.926-43.584,18.056c-11.126,11.102-18.052,26.61-18.048,43.58 c-0.004,16.97,6.922,32.479,18.048,43.58c11.108,11.131,26.613,18.056,43.584,18.049c16.974,0.007,32.479-6.918,43.584-18.049 c11.134-11.101,18.056-26.61,18.052-43.58c0.004-16.97-6.918-32.478-18.052-43.58C288.474,358.256,272.969,351.323,255.995,351.33z M284.667,425.074c-2.348,5.558-6.311,10.341-11.286,13.699c-4.99,3.358-10.888,5.298-17.386,5.304 c-4.335-0.007-8.391-0.875-12.1-2.446c-5.565-2.345-10.345-6.31-13.703-11.282c-3.358-4.986-5.294-10.891-5.301-17.383 c0-4.342,0.868-8.394,2.435-12.107c2.348-5.558,6.31-10.341,11.286-13.699c4.986-3.358,10.888-5.298,17.383-5.305 c4.342,0.007,8.391,0.876,12.104,2.439c5.569,2.352,10.349,6.318,13.706,11.29c3.358,4.979,5.294,10.891,5.298,17.383 C287.102,417.301,286.234,421.353,284.667,425.074z">
                                                                </path>
                                                                <path class="st0"
                                                                    d="M255.998,314.364c-41.854,0-75.809,20.292-75.809,45.339c0,7.483,3.036,14.546,8.424,20.777 c3.257-5.384,7.222-10.428,11.782-14.994c14.828-14.843,34.578-23.035,55.575-23.035c21.084,0,40.808,8.192,55.654,23.07 c4.563,4.531,8.507,9.574,11.764,14.959c5.388-6.231,8.416-13.294,8.416-20.777C331.804,334.657,297.882,314.364,255.998,314.364z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>

                                                    <select id="emp_marital_status"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        id="">
                                                        <option value=""
                                                            {{ $emp_data->Emp_Marital_Status == '' ? 'selected' : '' }}>
                                                            Select Option</option>
                                                        <option value="Single"
                                                            {{ $emp_data->Emp_Marital_Status == 'Male' ? 'selected' : '' }}>
                                                            Single</option>
                                                        <option value="Married"
                                                            {{ $emp_data->Emp_Marital_Status == 'Married' ? 'selected' : '' }}>
                                                            Married</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <div class="d-flex flex-column">
                                                <label for="">Birthday  <span style="color:#ce3b3b;">*</span> </label>
                                                @php
                                                    // Assuming $emp_data->emp_birthday contains the date in YYYY-MM-DD format
                                                    $emp_birthday = $emp_data->emp_birthday;

                                                    // Convert the date to the format expected by <input type="date">
                                                    $formatted_birthday = date('Y-m-d', strtotime($emp_birthday));

                                                @endphp

                                                <input type="hidden" value="{{ $emp_data->Emp_Code }}" id="emp_code">

                                                <input value="{{ $formatted_birthday }}" id="emp_birthday"
                                                    type="date"
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;"
                                                    class="mb-3 form-control inputboxcolor">


                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <button class="px-4 py-2 reblateBtn" onclick="updatePersonal()"
                                            type="button">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        function updatePersonal() {


                            var csrfToken = "{{ csrf_token() }}";

                            var passport_number = document.getElementById('passport_number').value;
                            var passportExp = document.getElementById('passportExp').value;
                            var phoneNo = document.getElementById('phoneNo').value;
                            var emp_gender = document.getElementById('emp_gender').value;
                            var emp_marital_status = document.getElementById('emp_marital_status').value;
                            var emp_birthday = document.getElementById('emp_birthday').value;
                            var emp_code = document.getElementById('emp_code').value;
                            var error_message = document.getElementById('error_message');



                            if(passportExp == "") {
                                error_message.innerHTML = "Employee CNIC required!";
                                error_message.style.display = "block";
                                return;
                            } else {
                                error_message.style.display = "none";
                            }

                            if(phoneNo == "") {
                                error_message.innerHTML = "Phone Number Required!";
                                error_message.style.display = "block";
                                return;
                            } else {
                                error_message.style.display = "none";
                            }

                            if(emp_gender == "") {
                                error_message.innerHTML = "Select A Gender!";
                                error_message.style.display = "block";
                                return;
                            } else {
                                error_message.style.display = "none";
                            }

                            if(emp_marital_status == "") {
                                error_message.innerHTML = "Select Marital Status!";
                                error_message.style.display = "block";
                                return;
                            } else {
                                error_message.style.display = "none";
                            }

                            if(emp_birthday == "") {
                                error_message.innerHTML = "Birthday of Employee Required!";
                                error_message.style.display = "block";
                                return;
                            } else {
                                error_message.style.display = "none";
                            }

                            var formData = new FormData();
                            formData.append('passport_number', passport_number);
                            formData.append('passportExp', passportExp);
                            formData.append('phoneNo', phoneNo);
                            formData.append('emp_gender', emp_gender);
                            formData.append('emp_marital_status', emp_marital_status);
                            formData.append('emp_birthday', emp_birthday);
                            formData.append('emp_code', emp_code);



                            fetch('/update-info-emp', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                                    },
                                    body: formData
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                    var success_message = document.getElementById('success_message');
                                    success_message.innerHTML = "Data Updatede Successfully!";
                                    success_message.style.display = "block";
                                })
                                .then(data => {
                                    if (data.message === 'Data received successfully') {
                                        var success_message = document.getElementById('success_message');
                                        success_message.innerHTML = "Data Updated Successfully!";
                                        // Hide the success message after 5 seconds
                                        success_message.style.display = "block";
                                        setTimeout(function() {
                                            success_message.style.display = "none";
                                        }, 1000); // 5000 milliseconds = 5 seconds
                                    }
                                })
                                .catch(error => {
                                    console.error('There was a problem with the fetch operation:', error);
                                });
                        }
                    </script>
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
                                        <li class="d-flex mb-1 gap-4 ">
                                            <h2 class="detailLabel mb-1">Phone No:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation_Phone }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center"
                                            style="border-bottom: 1px solid #14213d">
                                            <h2 class="detailLabel mb-1"> Address:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Relation_Address }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center" style="margin-top:10px;">
                                            <h2 class="detailLabel mb-1">Secoundary Name:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->secondary_employee_relation_name ? $emp_data->secondary_employee_relation_name : '______' }}

                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center" style="margin-top:10px;">
                                            <h2 class="detailLabel mb-1">Relationship:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->secondary_employee_relation ? $emp_data->secondary_employee_relation : '______' }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center" style="margin-top:10px;">
                                            <h2 class="detailLabel mb-1">Phone No:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->secondary_employee_relative_phone_num ? $emp_data->secondary_employee_relative_phone_num : '______' }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center" style="margin-top:10px;">
                                            <h2 class="detailLabel mb-1">Address:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->secondary_employee_relative_address ? $emp_data->secondary_employee_relative_address : '______' }}
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="popup" id="popup2">
                                <div class="popup-content flex-column">
                                    <div class="d-flex mb-3 align-items-center justify-content-between">
                                        <h2 class="mb-0"
                                            style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                            Emergency Contact</h2>
                                        <span class="closeBtn2 p-2"
                                            style="border-radius: 50%; background-color:#14213d26"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="#14213d50" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                            </svg></span>
                                    </div>
                                    <p id="success_message_em_contact" style="color:green;font-size:15px; display:none;">
                                    </p>
                                    <p id="success_message_em_contact" style="color:green;font-size:15px; display:none;">
                                    <p id="error_em_contact" style="color:#ce3b3b;font-size:15px; display:none;">
                                    </p>
                                    <form action="" class="text-start">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Primary Name <span style="color:#ce3b3b;">*</span> </label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg height="20px" width="20px" version="1.1" id="_x32_"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <style type="text/css">
                                                                    .st0 {
                                                                        fill: #9e9e9e;
                                                                    }
                                                                </style>
                                                                <g>
                                                                    <path class="st0"
                                                                        d="M256,265.308c73.252,0,132.644-59.391,132.644-132.654C388.644,59.412,329.252,0,256,0 c-73.262,0-132.643,59.412-132.643,132.654C123.357,205.917,182.738,265.308,256,265.308z">
                                                                    </path>
                                                                    <path class="st0"
                                                                        d="M425.874,393.104c-5.922-35.474-36-84.509-57.552-107.465c-5.829-6.212-15.948-3.628-19.504-1.427 c-27.04,16.672-58.782,26.399-92.819,26.399c-34.036,0-65.778-9.727-92.818-26.399c-3.555-2.201-13.675-4.785-19.505,1.427 c-21.55,22.956-51.628,71.991-57.551,107.465C71.573,480.444,164.877,512,256,512C347.123,512,440.427,480.444,425.874,393.104z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <input type="text" value="{{ $emp_data->Emp_Relation_Name }}"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Primary Name" id="Emp_Relation_Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Relationship <span style="color:#ce3b3b;">*</span> </label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg fill="#9e9e9e" version="1.1" id="Capa_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20px"
                                                            height="20px" viewBox="0 0 565.701 565.701"
                                                            xml:space="preserve" stroke="#9e9e9e">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path
                                                                        d="M47.567,164.346c0-37.285,30.225-67.504,67.504-67.504c37.279,0,67.504,30.228,67.504,67.504 c0,37.279-30.225,67.501-67.504,67.501C77.792,231.847,47.567,201.625,47.567,164.346z M450.637,231.847 c37.273,0,67.501-30.222,67.501-67.501c0-37.285-30.228-67.504-67.501-67.504c-37.279,0-67.507,30.228-67.507,67.504 C383.13,201.625,413.357,231.847,450.637,231.847z M565.701,308.258v70.072l-0.484-0.006l-4.521,2.294 c-2.199,1.123-36.907,18.098-96.824,19.162c-30.057,40.631-98.231,69.079-177.377,69.079c-79.266,0-147.532-28.531-177.523-69.269 c-13.134-0.531-27.26-1.844-42.327-4.196l-18.515-3.381c-13.716-2.79-28.059-6.378-43.113-11.077l-4.835-1.513L0,378.33v-70.072 c0-40.024,27.405-73.695,64.41-83.469c13.293,12.401,31.076,20.059,50.655,20.059c19.579,0,37.356-7.658,50.655-20.059 c15.439,4.079,29.093,12.425,39.874,23.555c24.639-6.777,52.03-10.592,80.895-10.592c26.581,0,51.927,3.215,75.014,9.014 c10.568-10.362,23.738-18.087,38.468-21.977c13.299,12.401,31.073,20.059,50.655,20.059c19.576,0,37.355-7.658,50.655-20.059 c28.773,7.602,51.672,29.675,60.461,57.929l3.6,17.928C565.577,303.151,565.701,305.692,565.701,308.258z M446.162,399.639 c-13.601-0.485-28.254-1.797-43.946-4.244l-18.519-3.381c-13.713-2.802-28.059-6.384-43.119-11.089l-4.829-1.513l-0.184-1.088 v-70.066c0-18.418,5.864-35.443,15.723-49.461c-20.108-4.407-41.942-6.851-64.787-6.851c-25.301,0-49.373,2.976-71.222,8.328 c4.631,6.871,8.399,14.363,10.917,22.443l3.603,17.928c0.225,2.512,0.346,5.053,0.346,7.612v70.072l-0.485-0.006l-4.522,2.294 c-2.222,1.123-37.418,18.358-98.154,19.186c29.912,32.557,90.166,54.87,159.517,54.87 C355.952,454.674,416.283,432.284,446.162,399.639z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <input type="text" value="{{ $emp_data->Emp_Relation }}"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Relationship" id="Emp_Relation">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Phone No <span style="color:#ce3b3b;">*</span> </label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            stroke="#9e9e9e">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z"
                                                                    stroke="#9e9e9e" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </g>
                                                        </svg>
                                                        <input type="number" value="{{ $emp_data->Emp_Relation_Phone }}"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Phone No" id="Emp_Relation_Phone">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Address <span style="color:#ce3b3b;">*</span> </label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            stroke="#9e9e9e">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z"
                                                                    stroke="#9e9e9e" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </g>
                                                        </svg>
                                                        <input type="text"
                                                            value="{{ $emp_data->Emp_Relation_Address }}"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Phone No" id="Emp_Relation_Address">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Secoundary Name:</label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg height="20px" width="20px" version="1.1" id="_x32_"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <style type="text/css">
                                                                    .st0 {
                                                                        fill: #9e9e9e;
                                                                    }
                                                                </style>
                                                                <g>
                                                                    <path class="st0"
                                                                        d="M256,265.308c73.252,0,132.644-59.391,132.644-132.654C388.644,59.412,329.252,0,256,0 c-73.262,0-132.643,59.412-132.643,132.654C123.357,205.917,182.738,265.308,256,265.308z">
                                                                    </path>
                                                                    <path class="st0"
                                                                        d="M425.874,393.104c-5.922-35.474-36-84.509-57.552-107.465c-5.829-6.212-15.948-3.628-19.504-1.427 c-27.04,16.672-58.782,26.399-92.819,26.399c-34.036,0-65.778-9.727-92.818-26.399c-3.555-2.201-13.675-4.785-19.505,1.427 c-21.55,22.956-51.628,71.991-57.551,107.465C71.573,480.444,164.877,512,256,512C347.123,512,440.427,480.444,425.874,393.104z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <input type="text"
                                                            value="{{ $emp_data->secondary_employee_relation_name }}"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Secoundary Name"
                                                            id="secondary_employee_relation_name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Relationship:</label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg fill="#9e9e9e" version="1.1" id="Capa_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20px"
                                                            height="20px" viewBox="0 0 565.701 565.701"
                                                            xml:space="preserve" stroke="#9e9e9e">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path
                                                                        d="M47.567,164.346c0-37.285,30.225-67.504,67.504-67.504c37.279,0,67.504,30.228,67.504,67.504 c0,37.279-30.225,67.501-67.504,67.501C77.792,231.847,47.567,201.625,47.567,164.346z M450.637,231.847 c37.273,0,67.501-30.222,67.501-67.501c0-37.285-30.228-67.504-67.501-67.504c-37.279,0-67.507,30.228-67.507,67.504 C383.13,201.625,413.357,231.847,450.637,231.847z M565.701,308.258v70.072l-0.484-0.006l-4.521,2.294 c-2.199,1.123-36.907,18.098-96.824,19.162c-30.057,40.631-98.231,69.079-177.377,69.079c-79.266,0-147.532-28.531-177.523-69.269 c-13.134-0.531-27.26-1.844-42.327-4.196l-18.515-3.381c-13.716-2.79-28.059-6.378-43.113-11.077l-4.835-1.513L0,378.33v-70.072 c0-40.024,27.405-73.695,64.41-83.469c13.293,12.401,31.076,20.059,50.655,20.059c19.579,0,37.356-7.658,50.655-20.059 c15.439,4.079,29.093,12.425,39.874,23.555c24.639-6.777,52.03-10.592,80.895-10.592c26.581,0,51.927,3.215,75.014,9.014 c10.568-10.362,23.738-18.087,38.468-21.977c13.299,12.401,31.073,20.059,50.655,20.059c19.576,0,37.355-7.658,50.655-20.059 c28.773,7.602,51.672,29.675,60.461,57.929l3.6,17.928C565.577,303.151,565.701,305.692,565.701,308.258z M446.162,399.639 c-13.601-0.485-28.254-1.797-43.946-4.244l-18.519-3.381c-13.713-2.802-28.059-6.384-43.119-11.089l-4.829-1.513l-0.184-1.088 v-70.066c0-18.418,5.864-35.443,15.723-49.461c-20.108-4.407-41.942-6.851-64.787-6.851c-25.301,0-49.373,2.976-71.222,8.328 c4.631,6.871,8.399,14.363,10.917,22.443l3.603,17.928c0.225,2.512,0.346,5.053,0.346,7.612v70.072l-0.485-0.006l-4.522,2.294 c-2.222,1.123-37.418,18.358-98.154,19.186c29.912,32.557,90.166,54.87,159.517,54.87 C355.952,454.674,416.283,432.284,446.162,399.639z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <input type="text"
                                                            value=" {{ $emp_data->secondary_employee_relation }}"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Relationship "
                                                            id="secondary_employee_relation">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Phone No:</label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            stroke="#9e9e9e">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z"
                                                                    stroke="#9e9e9e" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </g>
                                                        </svg>
                                                        <input type="number"
                                                            value="{{ $emp_data->secondary_employee_relative_phone_num }}"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Telephone No"
                                                            autocomplete="current-password"
                                                            id="secondary_employee_relative_phone_num">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Address:</label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            stroke="#9e9e9e">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z"
                                                                    stroke="#9e9e9e" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </g>
                                                        </svg>
                                                        <input type="text"
                                                            value="{{ $emp_data->secondary_employee_relative_address }}"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Phone No"
                                                            id="secondary_employee_relative_address">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{ $emp_data->Emp_Code }}" id="emp_code_hidden">
                                        <div class="mt-2">
                                            <button class="px-4 py-2 reblateBtn" onclick="updateEmergency()"
                                                type="button">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function updateEmergency() {


                        var csrfToken = "{{ csrf_token() }}";

                        var secondary_employee_relative_address = document.getElementById('secondary_employee_relative_address').value;
                        var secondary_employee_relative_phone_num = document.getElementById('secondary_employee_relative_phone_num').value;
                        var secondary_employee_relation = document.getElementById('secondary_employee_relation').value;

                        var secondary_employee_relation_name = document.getElementById('secondary_employee_relation_name').value;

                        var Emp_Relation_Address = document.getElementById('Emp_Relation_Address').value;
                        var Emp_Relation_Phone = document.getElementById('Emp_Relation_Phone').value;
                        var Emp_Relation = document.getElementById('Emp_Relation').value;
                        var Emp_Relation_Name = document.getElementById('Emp_Relation_Name').value;
                        var emp_code_hidden = document.getElementById('emp_code_hidden').value;

                        var error_em_contact = document.getElementById('error_em_contact');

                        if(Emp_Relation_Name == "") {
                            error_em_contact.innerHTML = "Employee Relation Name Required";
                            error_em_contact.style.display = "block";
                            return;
                        } else {
                            error_em_contact.style.display = "none";
                        }

                        if(Emp_Relation == "") {
                            error_em_contact.innerHTML = "Employee Relation Required";
                            error_em_contact.style.display = "block";
                            return;
                        } else {
                            error_em_contact.style.display = "none";
                        }

                        if(Emp_Relation_Phone == "") {
                            error_em_contact.innerHTML = "Employee Relation Phone Required";
                            error_em_contact.style.display = "block";
                            return;
                        } else {
                            error_em_contact.style.display = "none";
                        }

                        if(Emp_Relation_Address == "") {
                            error_em_contact.innerHTML = "Employee Relation Address Required";
                            error_em_contact.style.display = "block";
                            return;
                        } else {
                            error_em_contact.style.display = "none";
                        }


                        var formData = new FormData();
                        formData.append('secondary_employee_relative_address', secondary_employee_relative_address);
                        formData.append('secondary_employee_relative_phone_num', secondary_employee_relative_phone_num);
                        formData.append('secondary_employee_relation', secondary_employee_relation);
                        formData.append('secondary_employee_relation_name', secondary_employee_relation_name);

                        formData.append('Emp_Relation_Address', Emp_Relation_Address);
                        formData.append('Emp_Relation_Phone', Emp_Relation_Phone);
                        formData.append('Emp_Relation', Emp_Relation);
                        formData.append('Emp_Relation_Name', Emp_Relation_Name);

                        formData.append('emp_code', emp_code_hidden);
                        // Log all the contents of the FormData object to the console
                        for (var pair of formData.entries()) {
                            console.log(pair[0] + ': ' + pair[1]);
                        }
                        console.log(formData);


                        fetch('/update-info-contact', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                                },
                                body: formData
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                                var success_message = document.getElementById('success_message_em_contact');
                                success_message.innerHTML = "Data Updatede Successfully!";
                                success_message.style.display = "block";
                            })
                            .then(data => {

                                if (data.message === 'Data received successfully') {
                                    var success_message = document.getElementById('success_message_em_contact');
                                    success_message.innerHTML = "Data Updated Successfully!";
                                    // Hide the success message after 5 seconds
                                    success_message.style.display = "block";
                                    setTimeout(function() {
                                        success_message.style.display = "none";
                                    }, 1000); // 5000 milliseconds = 5 seconds
                                } else {

                                    var success_message = document.getElementById('error_message_em_contact');
                                    success_message.innerHTML = "Something went wrong!";
                                    // Hide the success message after 5 seconds
                                    success_message.style.display = "block";
                                    setTimeout(function() {
                                        success_message.style.display = "none";
                                    }, 1000); // 5000 milliseconds = 5 seconds
                                }
                            })
                            .catch(error => {
                                console.error('There was a problem with the fetch operation:', error);
                            });
                    }
                </script>


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6 ps-0">
                            <div class="card">
                                <div class="card-body bg-light w-100" style="border: 1px solid #c7c7c7">
                                    <div id="popupButton3"
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        {{-- <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#14213d50" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg> --}}
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            style="position: relative;right:-6px;top:4px;" width="16" height="16"
                                            viewBox="0 0 50 50">
                                            <path fill="currentColor"
                                                d="M25 42c-9.4 0-17-7.6-17-17S15.6 8 25 8s17 7.6 17 17s-7.6 17-17 17m0-32c-8.3 0-15 6.7-15 15s6.7 15 15 15s15-6.7 15-15s-6.7-15-15-15" />
                                            <path fill="currentColor" d="M16 24h18v2H16z" />
                                            <path fill="currentColor" d="M24 16h2v18h-2z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">
                                        Education Information</h2>
                                    <ul class="personal-info m-0 p-0 ps-3" style="list-style: none; ">
                                        @foreach ($education as $ed)
                                            <li class=" dotting">
                                                <div class="position-relative d-flex flex-column" style="top: -8px;">
                                                    <h2 class="detailLabel mb-0">{{ $ed->institute_name }}
                                                        <a id="popupButton{{ $ed->id }}"
                                                            onclick="openModel({{ $ed->id }})"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" viewBox="0 0 24 24">
                                                                <path fill="currentColor"
                                                                    d="m14.06 9.02l.92.92L5.92 19H5v-.92zM17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83a.996.996 0 0 0 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z" />
                                                            </svg></a>
                                                        <a onclick="removeEducation({{ $ed->id }})"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" viewBox="0 0 24 24">
                                                                <path fill="#d20f0f"
                                                                    d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z" />
                                                            </svg></a>
                                                    </h2>
                                                    <p class="text detailInfo mb-0" style="color:#14213d;">
                                                        {{ $ed->degree }}</p>
                                                    @php
                                                        $start_year = date('Y', strtotime($ed->start_date));
                                                        $end_year = date('Y', strtotime($ed->end_date));
                                                    @endphp
                                                    <p class="detailInfo font-size-12">{{ $start_year }} -
                                                        {{ $end_year }}</p>
                                                </div>

                                                <div class="popup" id="popup{{ $ed->id }}">
                                                    <div class="popup-content flex-column">
                                                        <div
                                                            class="d-flex mb-3 align-items-center justify-content-between">
                                                            <h2 class="mb-0"
                                                                style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                                                Education Information</h2>
                                                            <span class="closeBtn{{ $ed->id }} p-2"
                                                                style="border-radius: 50%; background-color:#14213d26">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" fill="#14213d50" class="bi bi-x-lg"
                                                                    viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <form action="" class="text-start">
                                                            <p id="success_message_emp_education_{{ $ed->id }}"
                                                                style="color:green;font-size:15px; display:none;"></p>
                                                            <p id="error_message_emp_education_{{ $ed->id }}"
                                                                style="color:#ce3b3b;font-size:15px; display:none;"></p>
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                                    <div class="d-flex flex-column">
                                                                        <label for="">Institute Name:</label>
                                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                                            <svg width="20px" height="20px"
                                                                                viewBox="0 0 24 24"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="#9e9e9e">
                                                                                <g id="SVGRepo_bgCarrier"
                                                                                    stroke-width="0"></g>
                                                                                <g id="SVGRepo_tracerCarrier"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></g>
                                                                                <g id="SVGRepo_iconCarrier">
                                                                                    <rect x="0" fill="none"
                                                                                        width="24" height="24">
                                                                                    </rect>
                                                                                    <g>
                                                                                        <path
                                                                                            d="M2 19h20v3H2zM12 2L2 6v2h20V6M17 10h3v7h-3zM10.5 10h3v7h-3zM4 10h3v7H4z">
                                                                                        </path>
                                                                                    </g>
                                                                                </g>
                                                                            </svg>
                                                                            <input type="text"
                                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                                placeholder="Enter Your Institute"
                                                                                value="{{ $ed->institute_name }}"
                                                                                id="education_institute_name_{{ $ed->id }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                                    <div class="d-flex flex-column">
                                                                        <label for="">Degree:</label>
                                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                                            <svg height="20px" width="20px"
                                                                                version="1.1" id="_x32_"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                viewBox="0 0 512 512" xml:space="preserve"
                                                                                fill="#000000">
                                                                                <g id="SVGRepo_bgCarrier"
                                                                                    stroke-width="0"></g>
                                                                                <g id="SVGRepo_tracerCarrier"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></g>
                                                                                <g id="SVGRepo_iconCarrier">
                                                                                    <style type="text/css">
                                                                                        .st0 {
                                                                                            fill: #9e9e9e;
                                                                                        }
                                                                                    </style>
                                                                                    <g>
                                                                                        <path class="st0"
                                                                                            d="M81.876,169.851v-68.266l67.776,43.851v55.916c0,0,0.351-0.157,0.942-0.416 c1.042,29.01,13.236,55.26,32.406,74.413c20.057,20.075,47.858,32.517,78.474,32.508c30.616,0.01,58.427-12.432,78.474-32.508 c19.179-19.153,31.373-45.403,32.407-74.413c0.599,0.259,0.95,0.416,0.95,0.416v-55.916l86.412-55.906L261.473,0L63.24,89.531 v80.32c-6.277,1.486-10.956,7.089-10.956,13.817v4.07H92.84v-4.07C92.84,176.94,88.151,171.337,81.876,169.851z M170.889,194.385 c22.282-5.345,58.454-8.464,90.584,14.02c32.13-22.484,68.312-19.365,90.593-14.02c0.018,0.831,0.055,1.66,0.055,2.491 c0,25.07-10.125,47.664-26.546,64.104c-16.438,16.42-39.033,26.546-64.102,26.554c-25.059-0.008-47.655-10.134-64.093-26.554 c-16.42-16.439-26.546-39.034-26.555-64.104C170.825,196.045,170.871,195.216,170.889,194.385z">
                                                                                        </path>
                                                                                        <path class="st0"
                                                                                            d="M52.284,219.592c0,7.864,6.368,14.232,14.233,14.232h12.091c7.854,0,14.232-6.369,14.232-14.232v-23.38H52.284 V219.592z">
                                                                                        </path>
                                                                                        <path class="st0"
                                                                                            d="M326.989,314.024c0,0-3.185,2.547-8.926,5.861l-56.589,95.761l-56.589-95.761 c-5.741-3.314-8.925-5.861-8.925-5.861c-51.209,22.586-72.29,76.812-72.29,119.732c0,42.929,0,78.244,0,78.244h275.619 c0,0,0-35.315,0-78.244C399.288,390.836,378.197,336.61,326.989,314.024z">
                                                                                        </path>
                                                                                    </g>
                                                                            </svg>
                                                                            <input type="text"
                                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                                placeholder="Enter Your Degree"
                                                                                value="{{ $ed->degree }}"
                                                                                id="education_degree_name_{{ $ed->id }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                                    <div class="d-flex flex-column">
                                                                        <label for="">Starting Date:</label>
                                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                                            <svg width="20px" height="20px"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <g id="SVGRepo_bgCarrier"
                                                                                    stroke-width="0"></g>
                                                                                <g id="SVGRepo_tracerCarrier"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></g>
                                                                                <g id="SVGRepo_iconCarrier">
                                                                                    <path
                                                                                        d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                                                        stroke="#9e9e9e" stroke-width="2"
                                                                                        stroke-linecap="round"></path>
                                                                                    <rect x="6" y="12" width="3"
                                                                                        height="3" rx="0.5"
                                                                                        fill="#9e9e9e"></rect>
                                                                                    <rect x="10.5" y="12" width="3"
                                                                                        height="3" rx="0.5"
                                                                                        fill="#9e9e9e"></rect>
                                                                                    <rect x="15" y="12" width="3"
                                                                                        height="3" rx="0.5"
                                                                                        fill="#9e9e9e"></rect>
                                                                                </g>
                                                                            </svg>
                                                                            <input type="date"
                                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                                placeholder="Enter Starting Date"
                                                                                value="{{ $ed->start_date }}"
                                                                                id="education_start_date_{{ $ed->id }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                                    <div class="d-flex flex-column">
                                                                        <label for="">Ending Date:</label>
                                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                                            <svg width="20px" height="20px"
                                                                                viewBox="0 0 24 24" fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <g id="SVGRepo_bgCarrier"
                                                                                    stroke-width="0"></g>
                                                                                <g id="SVGRepo_tracerCarrier"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"></g>
                                                                                <g id="SVGRepo_iconCarrier">
                                                                                    <path
                                                                                        d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                                                        stroke="#9e9e9e" stroke-width="2"
                                                                                        stroke-linecap="round"></path>
                                                                                    <rect x="6" y="12" width="3"
                                                                                        height="3" rx="0.5"
                                                                                        fill="#9e9e9e"></rect>
                                                                                    <rect x="10.5" y="12" width="3"
                                                                                        height="3" rx="0.5"
                                                                                        fill="#9e9e9e"></rect>
                                                                                    <rect x="15" y="12" width="3"
                                                                                        height="3" rx="0.5"
                                                                                        fill="#9e9e9e"></rect>
                                                                                </g>
                                                                            </svg>
                                                                            <input type="date"
                                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                                placeholder="Enter Ending Date"
                                                                                value="{{ $ed->end_date }}"
                                                                                id="education_end_date_{{ $ed->id }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- <div class="row">
                                                                <div id="input-container"></div>
                                                            </div> --}}
                                                            <div class="mt-2 d-flex gap-3">
                                                                <button class="px-4 py-2 reblateBtn"
                                                                    onclick="updateEducation({{ $ed->id }})"
                                                                    id="add-more-btn" type="button">Update
                                                                    Education</button>
                                                                {{-- <button class="px-4 py-2 reblateBtn" type="button">Add Education</button> --}}
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>


                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="popup" id="popup3">
                                    <div class="popup-content flex-column">
                                        <div class="d-flex mb-3 align-items-center justify-content-between">
                                            <h2 class="mb-0"
                                                style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                                Education Information</h2>
                                            <span class="closeBtn3 p-2"
                                                style="border-radius: 50%; background-color:#14213d26">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#14213d50" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                </svg>
                                            </span>
                                        </div>
                                        <form action="" id="education-add-form" class="text-start">

                                            <div class="row">
                                                <p id="success_message_emp_education_once_added"
                                                    style="color:green;font-size:15px;  display:none;"></p>
                                                <p id="error_message_emp_education_once_added"
                                                    style="color: rgb(206, 59, 59); font-size:15px; display:none;"></p>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Institute Name <span style="color:#ce3b3b">*</span> </label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg" fill="#9e9e9e">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <rect x="0" fill="none" width="24"
                                                                        height="24"></rect>
                                                                    <g>
                                                                        <path
                                                                            d="M2 19h20v3H2zM12 2L2 6v2h20V6M17 10h3v7h-3zM10.5 10h3v7h-3zM4 10h3v7H4z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                            <input type="text"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Your Institute"
                                                                id="education_institute_name_add">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Degree <span style="color:#ce3b3b">*</span> </label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg height="20px" width="20px" version="1.1"
                                                                id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                viewBox="0 0 512 512" xml:space="preserve"
                                                                fill="#000000">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <style type="text/css">
                                                                        .st0 {
                                                                            fill: #9e9e9e;
                                                                        }
                                                                    </style>
                                                                    <g>
                                                                        <path class="st0"
                                                                            d="M81.876,169.851v-68.266l67.776,43.851v55.916c0,0,0.351-0.157,0.942-0.416 c1.042,29.01,13.236,55.26,32.406,74.413c20.057,20.075,47.858,32.517,78.474,32.508c30.616,0.01,58.427-12.432,78.474-32.508 c19.179-19.153,31.373-45.403,32.407-74.413c0.599,0.259,0.95,0.416,0.95,0.416v-55.916l86.412-55.906L261.473,0L63.24,89.531 v80.32c-6.277,1.486-10.956,7.089-10.956,13.817v4.07H92.84v-4.07C92.84,176.94,88.151,171.337,81.876,169.851z M170.889,194.385 c22.282-5.345,58.454-8.464,90.584,14.02c32.13-22.484,68.312-19.365,90.593-14.02c0.018,0.831,0.055,1.66,0.055,2.491 c0,25.07-10.125,47.664-26.546,64.104c-16.438,16.42-39.033,26.546-64.102,26.554c-25.059-0.008-47.655-10.134-64.093-26.554 c-16.42-16.439-26.546-39.034-26.555-64.104C170.825,196.045,170.871,195.216,170.889,194.385z">
                                                                        </path>
                                                                        <path class="st0"
                                                                            d="M52.284,219.592c0,7.864,6.368,14.232,14.233,14.232h12.091c7.854,0,14.232-6.369,14.232-14.232v-23.38H52.284 V219.592z">
                                                                        </path>
                                                                        <path class="st0"
                                                                            d="M326.989,314.024c0,0-3.185,2.547-8.926,5.861l-56.589,95.761l-56.589-95.761 c-5.741-3.314-8.925-5.861-8.925-5.861c-51.209,22.586-72.29,76.812-72.29,119.732c0,42.929,0,78.244,0,78.244h275.619 c0,0,0-35.315,0-78.244C399.288,390.836,378.197,336.61,326.989,314.024z">
                                                                        </path>
                                                                    </g>
                                                            </svg>
                                                            <input type="text"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Your Degree"
                                                                id="education_degree_name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Starting Date <span style="color:#ce3b3b">*</span> </label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path
                                                                        d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                                        stroke="#9e9e9e" stroke-width="2"
                                                                        stroke-linecap="round"></path>
                                                                    <rect x="6" y="12" width="3" height="3"
                                                                        rx="0.5" fill="#9e9e9e"></rect>
                                                                    <rect x="10.5" y="12" width="3" height="3"
                                                                        rx="0.5" fill="#9e9e9e"></rect>
                                                                    <rect x="15" y="12" width="3" height="3"
                                                                        rx="0.5" fill="#9e9e9e"></rect>
                                                                </g>
                                                            </svg>
                                                            <input type="date"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Starting Date"
                                                                id="education_start_date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Ending Date <span style="color:#ce3b3b">*</span> </label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path
                                                                        d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                                        stroke="#9e9e9e" stroke-width="2"
                                                                        stroke-linecap="round"></path>
                                                                    <rect x="6" y="12" width="3" height="3"
                                                                        rx="0.5" fill="#9e9e9e"></rect>
                                                                    <rect x="10.5" y="12" width="3" height="3"
                                                                        rx="0.5" fill="#9e9e9e"></rect>
                                                                    <rect x="15" y="12" width="3" height="3"
                                                                        rx="0.5" fill="#9e9e9e"></rect>
                                                                </g>
                                                            </svg>
                                                            <input type="date"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Ending Date" id="education_end_date">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- <div class="row">
                                                <div id="input-container"></div>
                                            </div> --}}
                                            <div class="mt-2 d-flex gap-3">
                                                <button class="px-4 py-2 reblateBtn" onclick="addEducation()"
                                                    id="add-more-btn" type="button">Add Education</button>
                                                {{-- <button class="px-4 py-2 reblateBtn" type="button">Add Education</button> --}}
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <script>
                            //  JS Popup Delete Code Sweart Alert
                            function removeEducation(id) {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: 'Education details will be deleted!',
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
                                            url: '/del-emp-edu/' + id,
                                            method: 'GET', // Use the DELETE HTTP method
                                            success: function() {
                                                // Provide user feedback
                                                Swal.fire({
                                                    title: 'Success!',
                                                    text: 'deleted!',
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
                                                    text: 'An error occurred while checking out the user!',
                                                    icon: 'error'
                                                });
                                            }
                                        });

                                    }
                                });
                            }

                            function addEducation() {


                                var csrfToken = "{{ csrf_token() }}";

                                var education_institute_name = document.getElementById('education_institute_name_add').value;

                                var education_degree_name = document.getElementById('education_degree_name').value;
                                var education_start_date = document.getElementById('education_start_date').value;
                                var education_end_date = document.getElementById('education_end_date').value;

                                var emp_code = document.getElementById('emp_code').value;

                                var error_message_emp_education_once_added = document.getElementById('error_message_emp_education_once_added');

                                if(education_institute_name == "") {
                                    error_message_emp_education_once_added.innerHTML = "Education Institute Required";
                                    error_message_emp_education_once_added.style.display = "block";
                                    return;
                                } else {
                                    error_message_emp_education_once_added.style.display = "none";
                                }

                                if(education_degree_name == "") {
                                    error_message_emp_education_once_added.innerHTML = "Education Degree Required";
                                    error_message_emp_education_once_added.style.display = "block";
                                    return;
                                } else {
                                    error_message_emp_education_once_added.style.display = "none";
                                }

                                if(education_start_date == "") {
                                    error_message_emp_education_once_added.innerHTML = "Education Start Date Required";
                                    error_message_emp_education_once_added.style.display = "block";
                                    return;
                                } else {
                                    error_message_emp_education_once_added.style.display = "none";
                                }

                                if(education_end_date == "") {
                                    error_message_emp_education_once_added.innerHTML = "Education End Date Required";
                                    error_message_emp_education_once_added.style.display = "block";
                                    return;
                                } else {
                                    error_message_emp_education_once_added.style.display = "none";
                                }



                                var formData = new FormData();
                                formData.append('education_institute_name', education_institute_name);
                                formData.append('education_degree_name', education_degree_name);
                                formData.append('education_start_date', education_start_date);
                                formData.append('education_end_date', education_end_date);
                                formData.append('emp_code', emp_code);


                                fetch('/add-emp-edu', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                                        },
                                        body: formData
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        return response.json();
                                        var success_message = document.getElementById('success_message_salary');
                                        success_message.innerHTML = "Data Added Successfully!";
                                        success_message.style.display = "block";
                                    })
                                    .then(data => {



                                        if (data.message === 'Data received successfully') {
                                            document.getElementById("education-add-form").reset();
                                            var success_message = document.getElementById('success_message_emp_education_once_added');
                                            success_message.innerHTML = "Data Added Successfully!";
                                            // Hide the success message after 5 seconds
                                            success_message.style.display = "block";
                                            setTimeout(function() {
                                                success_message.style.display = "none";
                                            }, 1000); // 5000 milliseconds = 5 seconds
                                            // Display the returned data

                                        } else {

                                            var success_message = document.getElementById('error_message_emp_education_once_added');
                                            success_message.innerHTML = "Something went wrong!";
                                            // Hide the success message after 5 seconds
                                            success_message.style.display = "block";
                                            setTimeout(function() {
                                                success_message.style.display = "none";
                                            }, 1000); // 5000 milliseconds = 5 seconds
                                        }
                                    })
                                    .catch(error => {
                                        console.error('There was a problem with the fetch operation:', error);
                                    });
                            }
                            // update educatino

                            function updateEducation(id) {


                                var csrfToken = "{{ csrf_token() }}";

                                var education_institute_name_add = 'education_institute_name_' + id;


                                var education_degree_name = 'education_degree_name_' + id;
                                var education_start_date = 'education_start_date_' + id;
                                var education_end_date = 'education_end_date_' + id;
                                var error_message_emp_education = 'error_message_emp_education_' + id;


                                var education_institute_name = document.getElementById(education_institute_name_add).value;
                                var education_degree_name = document.getElementById(education_degree_name).value;
                                var education_start_date = document.getElementById(education_start_date).value;
                                var education_end_date = document.getElementById(education_end_date).value;

                                var error_message_emp_education_once_added = document.getElementById(error_message_emp_education);

                                if(education_institute_name == "") {
                                    error_message_emp_education_once_added.innerHTML = "Education Institute Required";
                                    error_message_emp_education_once_added.style.display = "block";
                                    return;
                                } else {
                                    error_message_emp_education_once_added.style.display = "none";
                                }

                                if(education_degree_name == "") {
                                    error_message_emp_education_once_added.innerHTML = "Education Degree Required";
                                    error_message_emp_education_once_added.style.display = "block";
                                    return;
                                } else {
                                    error_message_emp_education_once_added.style.display = "none";
                                }

                                if(education_start_date == "") {
                                    error_message_emp_education_once_added.innerHTML = "Education Start Date Required";
                                    error_message_emp_education_once_added.style.display = "block";
                                    return;
                                } else {
                                    error_message_emp_education_once_added.style.display = "none";
                                }

                                if(education_end_date == "") {
                                    error_message_emp_education_once_added.innerHTML = "Education End Date Required";
                                    error_message_emp_education_once_added.style.display = "block";
                                    return;
                                } else {
                                    error_message_emp_education_once_added.style.display = "none";
                                }


                                var formData = new FormData();
                                formData.append('education_institute_name', education_institute_name);
                                formData.append('education_degree_name', education_degree_name);
                                formData.append('education_start_date', education_start_date);
                                formData.append('education_end_date', education_end_date);
                                formData.append('update_id', id);


                                var url = '/update-emp-edu';
                                var success = 'success_message_emp_education_' + id;
                                var error = 'error_message_emp_education_' + id;

                                fetch(url, {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                                        },
                                        body: formData
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        return response.json();
                                        var success_message = document.getElementById('success_message_salary');
                                        success_message.innerHTML = "Data Added Successfully!";
                                        success_message.style.display = "block";
                                    })
                                    .then(data => {

                                        if (data.success == true) {
                                            var success_message = document.getElementById(success);
                                            success_message.innerHTML = "Data Updated Successfully!";
                                            // Hide the success message after 5 seconds
                                            success_message.style.display = "block";
                                            setTimeout(function() {
                                                success_message.style.display = "none";
                                            }, 1000); // 5000 milliseconds = 5 seconds
                                            // Display the returned data

                                        }
                                        if (data.success == false) {

                                            var success_message = document.getElementById(error);
                                            success_message.innerHTML = "Record Not Found!";
                                            // Hide the success message after 5 seconds
                                            success_message.style.display = "block";
                                            setTimeout(function() {
                                                success_message.style.display = "none";
                                            }, 1000); // 5000 milliseconds = 5 seconds
                                        }
                                    })
                                    .catch(error => {
                                        console.error('There was a problem with the fetch operation:', error);
                                    });
                            }
                        </script>


                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-body bg-light" style="border: 1px solid #c7c7c7">
                                    <div id="popupButton4"
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        {{-- <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#14213d50" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg> --}}
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            style="position: relative;right:-6px;top:4px;" width="16"
                                            height="16" viewBox="0 0 50 50">
                                            <path fill="currentColor"
                                                d="M25 42c-9.4 0-17-7.6-17-17S15.6 8 25 8s17 7.6 17 17s-7.6 17-17 17m0-32c-8.3 0-15 6.7-15 15s6.7 15 15 15s15-6.7 15-15s-6.7-15-15-15">
                                            </path>
                                            <path fill="currentColor" d="M16 24h18v2H16z"></path>
                                            <path fill="currentColor" d="M24 16h2v18h-2z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">Work
                                        Experience</h2>
                                    <ul class="personal-info m-0 p-0 ps-3" style="list-style: none; ">
                                        @foreach ($experience as $ed)
                                            <li class=" dotting">
                                                <div class="position-relative d-flex flex-column" style="top: -8px;">
                                                    <h2 class="detailLabel mb-0">{{ $ed->company_name }}
                                                        <a id="openWorkPopup{{ $ed->id }}"
                                                            onclick="openWorkModel({{ $ed->id }})"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" viewBox="0 0 24 24">
                                                                <path fill="currentColor"
                                                                    d="m14.06 9.02l.92.92L5.92 19H5v-.92zM17.66 3c-.25 0-.51.1-.7.29l-1.83 1.83l3.75 3.75l1.83-1.83a.996.996 0 0 0 0-1.41l-2.34-2.34c-.2-.2-.45-.29-.71-.29m-3.6 3.19L3 17.25V21h3.75L17.81 9.94z" />
                                                            </svg></a>
                                                        <a onclick="removeWorkEmp({{ $ed->id }})"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" viewBox="0 0 24 24">
                                                                <path fill="#d20f0f"
                                                                    d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z" />
                                                            </svg></a>
                                                    </h2>
                                                    <p class="text detailInfo mb-0" style="color:#14213d;">
                                                        {{ $ed->position }}</p>
                                                    @php
                                                        $start_year = date('Y', strtotime($ed->start_date));
                                                        $end_year = date('Y', strtotime($ed->end_date));
                                                    @endphp
                                                    <p class="detailInfo font-size-12">{{ $start_year }} -
                                                        {{ $end_year }}</p>
                                                </div>
                                            </li>

                                            <div class="popup" id="popup_work{{ $ed->id }}">
                                                <div class="popup-content flex-column">
                                                    <div class="d-flex mb-3 align-items-center justify-content-between">
                                                        <h2 class="mb-0"
                                                            style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                                            Education Information</h2>
                                                        <span class="closeBtn{{ $ed->id }} p-2"
                                                            style="border-radius: 50%; background-color:#14213d26">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" fill="#14213d50" class="bi bi-x-lg"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <form action="" class="text-start">
                                                        <p id="success_message_emp_work_{{ $ed->id }}"
                                                            style="color:green;font-size:15px; display:none;"></p>
                                                        <p id="error_message_emp_work_{{ $ed->id }}"
                                                            style="color:#ce3b3b;;font-size:15px; display:none;"></p>
                                                        <div class="row">
                                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                                <div class="d-flex flex-column">
                                                                    <label for="">Company Name:</label>
                                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                                        <svg width="20px" height="20px"
                                                                            viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            fill="#9e9e9e">
                                                                            <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                                            </g>
                                                                            <g id="SVGRepo_tracerCarrier"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"></g>
                                                                            <g id="SVGRepo_iconCarrier">
                                                                                <rect x="0" fill="none"
                                                                                    width="24" height="24">
                                                                                </rect>
                                                                                <g>
                                                                                    <path
                                                                                        d="M2 19h20v3H2zM12 2L2 6v2h20V6M17 10h3v7h-3zM10.5 10h3v7h-3zM4 10h3v7H4z">
                                                                                    </path>
                                                                                </g>
                                                                            </g>
                                                                        </svg>
                                                                        <input type="text"
                                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                            placeholder="Enter Your Institute"
                                                                            value="{{ $ed->company_name }}"
                                                                            id="work_emp_company_{{ $ed->id }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                                <div class="d-flex flex-column">
                                                                    <label for="">Position:</label>
                                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                                        <svg height="20px" width="20px"
                                                                            version="1.1" id="_x32_"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            viewBox="0 0 512 512" xml:space="preserve"
                                                                            fill="#000000">
                                                                            <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                                            </g>
                                                                            <g id="SVGRepo_tracerCarrier"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"></g>
                                                                            <g id="SVGRepo_iconCarrier">
                                                                                <style type="text/css">
                                                                                    .st0 {
                                                                                        fill: #9e9e9e;
                                                                                    }
                                                                                </style>
                                                                                <g>
                                                                                    <path class="st0"
                                                                                        d="M81.876,169.851v-68.266l67.776,43.851v55.916c0,0,0.351-0.157,0.942-0.416 c1.042,29.01,13.236,55.26,32.406,74.413c20.057,20.075,47.858,32.517,78.474,32.508c30.616,0.01,58.427-12.432,78.474-32.508 c19.179-19.153,31.373-45.403,32.407-74.413c0.599,0.259,0.95,0.416,0.95,0.416v-55.916l86.412-55.906L261.473,0L63.24,89.531 v80.32c-6.277,1.486-10.956,7.089-10.956,13.817v4.07H92.84v-4.07C92.84,176.94,88.151,171.337,81.876,169.851z M170.889,194.385 c22.282-5.345,58.454-8.464,90.584,14.02c32.13-22.484,68.312-19.365,90.593-14.02c0.018,0.831,0.055,1.66,0.055,2.491 c0,25.07-10.125,47.664-26.546,64.104c-16.438,16.42-39.033,26.546-64.102,26.554c-25.059-0.008-47.655-10.134-64.093-26.554 c-16.42-16.439-26.546-39.034-26.555-64.104C170.825,196.045,170.871,195.216,170.889,194.385z">
                                                                                    </path>
                                                                                    <path class="st0"
                                                                                        d="M52.284,219.592c0,7.864,6.368,14.232,14.233,14.232h12.091c7.854,0,14.232-6.369,14.232-14.232v-23.38H52.284 V219.592z">
                                                                                    </path>
                                                                                    <path class="st0"
                                                                                        d="M326.989,314.024c0,0-3.185,2.547-8.926,5.861l-56.589,95.761l-56.589-95.761 c-5.741-3.314-8.925-5.861-8.925-5.861c-51.209,22.586-72.29,76.812-72.29,119.732c0,42.929,0,78.244,0,78.244h275.619 c0,0,0-35.315,0-78.244C399.288,390.836,378.197,336.61,326.989,314.024z">
                                                                                    </path>
                                                                                </g>
                                                                        </svg>
                                                                        <input type="text"
                                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                            placeholder="Enter Your Degree"
                                                                            value="{{ $ed->position }}"
                                                                            id="work_emp_position_{{ $ed->id }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                                <div class="d-flex flex-column">
                                                                    <label for="">Starting Date:</label>
                                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                                        <svg width="20px" height="20px"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                                            </g>
                                                                            <g id="SVGRepo_tracerCarrier"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"></g>
                                                                            <g id="SVGRepo_iconCarrier">
                                                                                <path
                                                                                    d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                                                    stroke="#9e9e9e" stroke-width="2"
                                                                                    stroke-linecap="round"></path>
                                                                                <rect x="6" y="12" width="3"
                                                                                    height="3" rx="0.5"
                                                                                    fill="#9e9e9e"></rect>
                                                                                <rect x="10.5" y="12" width="3"
                                                                                    height="3" rx="0.5"
                                                                                    fill="#9e9e9e"></rect>
                                                                                <rect x="15" y="12" width="3"
                                                                                    height="3" rx="0.5"
                                                                                    fill="#9e9e9e"></rect>
                                                                            </g>
                                                                        </svg>
                                                                        <input type="date"
                                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                            placeholder="Enter Starting Date"
                                                                            value="{{ $ed->start_date }}"
                                                                            id="work_start_date_{{ $ed->id }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                                <div class="d-flex flex-column">
                                                                    <label for="">Ending Date:</label>
                                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                                        <svg width="20px" height="20px"
                                                                            viewBox="0 0 24 24" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <g id="SVGRepo_bgCarrier" stroke-width="0">
                                                                            </g>
                                                                            <g id="SVGRepo_tracerCarrier"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"></g>
                                                                            <g id="SVGRepo_iconCarrier">
                                                                                <path
                                                                                    d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                                                    stroke="#9e9e9e" stroke-width="2"
                                                                                    stroke-linecap="round"></path>
                                                                                <rect x="6" y="12" width="3"
                                                                                    height="3" rx="0.5"
                                                                                    fill="#9e9e9e"></rect>
                                                                                <rect x="10.5" y="12" width="3"
                                                                                    height="3" rx="0.5"
                                                                                    fill="#9e9e9e"></rect>
                                                                                <rect x="15" y="12" width="3"
                                                                                    height="3" rx="0.5"
                                                                                    fill="#9e9e9e"></rect>
                                                                            </g>
                                                                        </svg>
                                                                        <input type="date"
                                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                            placeholder="Enter Ending Date"
                                                                            value="{{ $ed->end_date }}"
                                                                            id="work_end_date_{{ $ed->id }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- <div class="row">
                                                            <div id="input-container"></div>
                                                        </div> --}}
                                                        <div class="mt-2 d-flex gap-3">
                                                            <button class="px-4 py-2 reblateBtn"
                                                                onclick="updateWork({{ $ed->id }})"
                                                                id="add-more-btn" type="button">Update Work</button>
                                                            {{-- <button class="px-4 py-2 reblateBtn" type="button">Add Education</button> --}}
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="popup" id="popup4">
                                    <div class="popup-content flex-column">
                                        <div class="d-flex mb-3 align-items-center justify-content-between">
                                            <h2 class="mb-0"
                                                style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                                Work Experience</h2>
                                            <span class="closeBtn4 p-2"
                                                style="border-radius: 50%; background-color:#14213d26"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#14213d50" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                </svg></span>
                                        </div>
                                        <p id="success_message_work"></p>
                                        <p id="success_message_work" style="color:green;font-size:15px; display:none;">
                                        </p>
                                        <p id="error_message_work" style="color:#ce3b3b;font-size:15px; display:none;"></p>
                                        <form action="" id="work-add-form" class="text-start">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Company <span style="color:#ce3b3b;">*</span></label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg fill="#9e9e9e" width="20px" height="20px"
                                                                viewBox="-2 0 16 16" id="company-16px"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path id="Path_133" data-name="Path 133"
                                                                        d="M323.5-192h-9a1.5,1.5,0,0,0-1.5,1.5V-176h12v-14.5A1.5,1.5,0,0,0,323.5-192ZM318-177v-3h2v3Zm6,0h-3v-3.5a.5.5,0,0,0-.5-.5h-3a.5.5,0,0,0-.5.5v3.5h-3v-13.5a.5.5,0,0,1,.5-.5h9a.5.5,0,0,1,.5.5Zm-8-12h2v2h-2Zm4,0h2v2h-2Zm-4,4h2v2h-2Zm4,0h2v2h-2Z"
                                                                        transform="translate(-313 192)"></path>
                                                                </g>
                                                            </svg>
                                                            <input type="text" value=""
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Your Company" id="work_emp_company">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Position <span style="color:#ce3b3b;">*</span> </label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 100 100"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                aria-hidden="true" role="img"
                                                                class="iconify iconify--gis"
                                                                preserveAspectRatio="xMidYMid meet" fill="#000000">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path
                                                                        d="M68.913 48.908l-.048.126c.015-.038.027-.077.042-.115l.006-.011z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M63.848 73.354l-1.383 1.71c1.87.226 3.68.491 5.375.812l-5.479 1.623l7.313 1.945l5.451-1.719c3.348 1.123 7.984 2.496 9.52 4.057h-10.93l1.086 3.176h11.342c-.034 1.79-3.234 3.244-6.29 4.422l-7.751-1.676l-7.303 2.617l7.8 1.78c-4.554 1.24-12.2 1.994-18.53 2.341l-.266-3.64h-7.606l-.267 3.64c-6.33-.347-13.975-1.1-18.53-2.34l7.801-1.781l-7.303-2.617l-7.752 1.676c-3.012-.915-6.255-2.632-6.289-4.422H25.2l1.086-3.176h-10.93c1.536-1.561 6.172-2.934 9.52-4.057l5.451 1.719l7.313-1.945l-5.479-1.623a82.552 82.552 0 0 1 5.336-.807l-1.363-1.713c-14.785 1.537-27.073 4.81-30.295 9.979C.7 91.573 19.658 99.86 49.37 99.989c.442.022.878.006 1.29 0c29.695-.136 48.636-8.42 43.501-16.654c-3.224-5.171-15.52-8.445-30.314-9.981z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M49.855 0A10.5 10.5 0 0 0 39.5 10.5A10.5 10.5 0 0 0 50 21a10.5 10.5 0 0 0 10.5-10.5A10.5 10.5 0 0 0 50 0a10.5 10.5 0 0 0-.145 0zm-.057 23.592c-7.834.002-15.596 3.368-14.78 10.096l2 14.625c.351 2.573 2.09 6.687 4.687 6.687h.185l2.127 24.531c.092 1.105.892 2 2 2h8c1.108 0 1.908-.895 2-2l2.127-24.53h.186c2.597 0 4.335-4.115 4.687-6.688l2-14.625c.524-6.734-7.384-10.097-15.219-10.096z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M-159.25 61.817l-.048.126c.016-.038.027-.076.043-.115c0-.004.004-.007.006-.01z"
                                                                        fill="#9e9e9e"></path>
                                                                </g>
                                                            </svg>
                                                            <input type="text" value=""
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Your Position"
                                                                id="work_emp_position">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Starting Date <span style="color:#ce3b3b;">*</span> </label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path
                                                                        d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                                        stroke="#9e9e9e" stroke-width="2"
                                                                        stroke-linecap="round"></path>
                                                                    <rect x="6" y="12" width="3" height="3"
                                                                        rx="0.5" fill="#9e9e9e"></rect>
                                                                    <rect x="10.5" y="12" width="3" height="3"
                                                                        rx="0.5" fill="#9e9e9e"></rect>
                                                                    <rect x="15" y="12" width="3" height="3"
                                                                        rx="0.5" fill="#9e9e9e"></rect>
                                                                </g>
                                                            </svg>
                                                            <input type="date"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Starting Date" id="work_start_date">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Ending Date <span style="color:#ce3b3b;">*</span> </label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path
                                                                        d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                                        stroke="#9e9e9e" stroke-width="2"
                                                                        stroke-linecap="round"></path>
                                                                    <rect x="6" y="12" width="3" height="3"
                                                                        rx="0.5" fill="#9e9e9e"></rect>
                                                                    <rect x="10.5" y="12" width="3" height="3"
                                                                        rx="0.5" fill="#9e9e9e"></rect>
                                                                    <rect x="15" y="12" width="3" height="3"
                                                                        rx="0.5" fill="#9e9e9e"></rect>
                                                                </g>
                                                            </svg>
                                                            <input type="date"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Ending Date" id="work_end_date">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div id="input-container2"></div>
                                            </div>
                                            <div class="mt-2 d-flex gap-3">
                                                <button class="px-4 py-2 reblateBtn" onclick="addWorkExp()"
                                                    id="add-more-btn2" type="button">Add More</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <script>
                function removeWorkEmp(id) {

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Work Experience details will be deleted!',
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
                                url: '/del-emp-work/' + id,
                                method: 'GET', // Use the DELETE HTTP method
                                success: function() {
                                    // Provide user feedback
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'deleted!',
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
                                        text: 'An error occurred while checking out the user!',
                                        icon: 'error'
                                    });
                                }
                            });

                        }
                    });
                }

                function addWorkExp() {


                    var csrfToken = "{{ csrf_token() }}";

                    var work_emp_company = document.getElementById('work_emp_company').value;
                    var work_emp_position = document.getElementById('work_emp_position').value;
                    var work_start_date = document.getElementById('work_start_date').value;
                    var work_end_date = document.getElementById('work_end_date').value;

                    var emp_code = document.getElementById('emp_code').value;

                    var error_message_work = document.getElementById('error_message_work');

                    if(work_emp_company == "") {
                        error_message_work.innerHTML = "Company Name Required";
                        error_message_work.style.display = "block";
                        return;
                    } else {
                        error_message_work.style.display = "none";
                    }

                    if(work_emp_position == "") {
                        error_message_work.innerHTML = "Position Required";
                        error_message_work.style.display = "block";
                        return;
                    } else {
                        error_message_work.style.display = "none";
                    }

                    if(work_start_date == "") {
                        error_message_work.innerHTML = "Start Date Required";
                        error_message_work.style.display = "block";
                        return;
                    } else {
                        error_message_work.style.display = "none";
                    }

                    if(work_end_date == "") {
                        error_message_work.innerHTML = "End Date Required";
                        error_message_work.style.display = "block";
                        return;
                    } else {
                        error_message_work.style.display = "none";
                    }


                    var formData = new FormData();
                    formData.append('work_emp_company', work_emp_company);
                    formData.append('work_emp_position', work_emp_position);
                    formData.append('work_start_date', work_start_date);
                    formData.append('work_end_date', work_end_date);
                    formData.append('emp_code', emp_code);


                    fetch('/add-emp-work', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                            },
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                            var success_message = document.getElementById('success_message_work');
                            success_message.innerHTML = "Data Added Successfully!";
                            success_message.style.display = "block";
                        })
                        .then(data => {



                            if (data.message === 'Data received successfully') {
                                document.getElementById("work-add-form").reset();
                                var success_message = document.getElementById('success_message_work');
                                success_message.innerHTML = "Data Added Successfully!";
                                // Hide the success message after 5 seconds
                                success_message.style.display = "block";
                                setTimeout(function() {
                                    success_message.style.display = "none";
                                }, 1000); // 5000 milliseconds = 5 seconds
                                // Display the returned data

                            } else {

                                var success_message = document.getElementById('error_message_work');
                                success_message.innerHTML = "Something went wrong!";
                                // Hide the success message after 5 seconds
                                success_message.style.display = "block";
                                setTimeout(function() {
                                    success_message.style.display = "none";
                                }, 1000); // 5000 milliseconds = 5 seconds
                            }
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                }

                function updateWork(id) {



                    var csrfToken = "{{ csrf_token() }}";

                    var work_emp_company = 'work_emp_company_' + id;
                    var work_emp_position = 'work_emp_position_' + id;
                    var work_start_date = 'work_start_date_' + id;
                    var work_end_date = 'work_end_date_' + id;
                    var error_message_emp_work = 'error_message_emp_work_' + id;

                    var work_emp_company = document.getElementById(work_emp_company).value;
                    var work_emp_position = document.getElementById(work_emp_position).value;
                    var work_start_date = document.getElementById(work_start_date).value;
                    var work_end_date = document.getElementById(work_end_date).value;

                    var emp_code = document.getElementById('emp_code').value;

                    var error_message_emp_work = document.getElementById(error_message_emp_work);

                    if(work_emp_company == "" ) {
                        error_message_emp_work.innerHTML = "Company Name Required";
                        error_message_emp_work.style.display = "block";
                        return;
                    } else {
                        error_message_emp_work.style.display = "none";
                    }

                    if(work_emp_position == "" ) {
                        error_message_emp_work.innerHTML = "Position Name Required";
                        error_message_emp_work.style.display = "block";
                        return;
                    } else {
                        error_message_emp_work.style.display = "none";
                    }

                    if(work_start_date == "" ) {
                        error_message_emp_work.innerHTML = "Start Date Required";
                        error_message_emp_work.style.display = "block";
                        return;
                    } else {
                        error_message_emp_work.style.display = "none";
                    }

                    if(work_end_date == "" ) {
                        error_message_emp_work.innerHTML = "End Date Required";
                        error_message_emp_work.style.display = "block";
                        return;
                    } else {
                        error_message_emp_work.style.display = "none";
                    }


                    var formData = new FormData();
                    formData.append('work_emp_company', work_emp_company);
                    formData.append('work_emp_position', work_emp_position);
                    formData.append('work_start_date', work_start_date);
                    formData.append('work_end_date', work_end_date);
                    formData.append('update_id', id);

                    var url = '/update-emp-work';
                    var success = 'success_message_emp_work_' + id;
                    var error = 'error_message_emp_work_' + id;


                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                            },
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                            var success_message = document.getElementById('success_message_work');
                            success_message.innerHTML = "Data Added Successfully!";
                            success_message.style.display = "block";
                        })
                        .then(data => {



                            if (data.success == true) {
                                var success_message = document.getElementById(success);
                                success_message.innerHTML = "Data Updated Successfully!";
                                // Hide the success message after 5 seconds
                                success_message.style.display = "block";
                                setTimeout(function() {
                                    success_message.style.display = "none";
                                }, 1000); // 5000 milliseconds = 5 seconds
                                // Display the returned data

                            }
                            if (data.success == false) {

                                var success_message = document.getElementById(error);
                                success_message.innerHTML = "Record Not Found!";
                                // Hide the success message after 5 seconds
                                success_message.style.display = "block";
                                setTimeout(function() {
                                    success_message.style.display = "none";
                                }, 1000); // 5000 milliseconds = 5 seconds
                            }
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                }
            </script>

            <div class="container-fluid tab-pane fade" style="border-bottom: none" id="companyDetails">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body bg-light d-flex" style="border: 1px solid #c7c7c7">
                                <div class="ms-3 w-100">
                                    @if (Auth()->user()->user_type == "admin" || Auth()->user()->user_type == "manager")
                                        <div id="popupButton5"
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#14213d50" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                </div>
                                    @endif

                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">
                                        Company
                                        Details</h2>
                                    <ul class="personal-info m-0 p-0" style="list-style: none; ">
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
                            <div class="popup" id="popup5">

                                <div class="popup-content flex-column">

                                    <div class="d-flex mb-3 align-items-center justify-content-between">
                                        <h2 class="mb-0"
                                            style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                            Company Details</h2>
                                        <span class="closeBtn5 p-2"
                                            style="border-radius: 50%; background-color:#14213d26"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                fill="#14213d50" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                            </svg></span>
                                    </div>
                                    <form action="" class="text-start">
                                        <p id="success_message_company" style="color:green;font-size:15px;display:none;">
                                        </p>
                                        <p id="error_message_company" style="color:#ce3b3b;font-size:15px;display:none;"></p>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Employee Code <span style="color:#ce3b3b">*</span> </label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg fill="#9e9e9e" height="20px" width="20px"
                                                            version="1.1" id="Capa_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            viewBox="0 0 452.232 452.232" xml:space="preserve"
                                                            stroke="#9e9e9e">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path
                                                                        d="M169.88,186.918l-55.987,0.007c-1.565,0-2.195-0.921-6.659-8.134c-1.591-2.571-4.052-6.547-5.455-8.358 c-1.396,1.766-3.838,5.61-5.419,8.1c-4.661,7.338-5.434,8.393-7.008,8.393h-7.893c-0.138,0-0.194,0.016-0.197,0.016l-0.215,0.061 c-0.333,2.228-0.501,4.461-0.501,6.662v12.387c0,24.834,20.204,45.038,45.038,45.038s45.038-20.204,45.038-45.038v-12.387 c0-2.202-0.168-4.438-0.502-6.668L169.88,186.918z">
                                                                    </path>
                                                                    <path
                                                                        d="M432.232,72.765H20c-11.028,0-20,8.972-20,20v266.703c0,11.028,8.972,20,20,20h316.635c9.654,0,22.293-5.606,28.774-12.764 l75.464-83.357c6.37-7.037,11.359-19.984,11.359-29.476V92.765C452.232,81.736,443.261,72.765,432.232,72.765z M246.298,148.935 h151.558v28.183H246.298V148.935z M192.685,212.709c0,17.361-5.303,32.579-15.356,44.129c6.076,8.541,9.405,19.061,9.405,29.813 l-0.003,12.077l-0.065,24.594l-122.307-0.025l-0.068-37.285c0-13.879,2.595-23.744,8.145-30.847 C63.3,243.696,58.48,229.057,58.48,212.709v-20.694c0-37.001,30.102-67.104,67.103-67.104c37,0,67.102,30.103,67.102,67.104 V212.709z M315.549,256.193h-69.251V228.01h69.251V256.193z M420.301,260.714l-79.363,87.919c-3.685,4.083-6.703,2.923-6.706-2.577 l-0.043-82.818c-0.003-5.5,4.495-9.997,9.995-9.994l72.818,0.042C422.501,253.289,423.986,256.631,420.301,260.714z">
                                                                    </path>
                                                                    <polygon
                                                                        points="125.583,299.354 158.391,264.556 92.775,264.556 ">
                                                                    </polygon>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <input type="text" id="emp_code"
                                                            value="{{ $emp_data->Emp_Code }}"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Your Emp Code">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Department <span style="color:#ce3b3b">*</span> </label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                            version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <title>group_line</title>
                                                                <g id="页面-1" stroke="none" stroke-width="1"
                                                                    fill="none" fill-rule="evenodd">
                                                                    <g id="Development"
                                                                        transform="translate(-768.000000, 0.000000)">
                                                                        <g id="group_line"
                                                                            transform="translate(768.000000, 0.000000)">
                                                                            <path
                                                                                d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z"
                                                                                id="MingCute" fill-rule="nonzero">
                                                                            </path>
                                                                            <path
                                                                                d="M15,6 C15,7.30622 14.1652,8.41746 13,8.82929 L13,11 L16,11 C17.6569,11 19,12.3431 19,14 L19,15.1707 C20.1652,15.5825 21,16.6938 21,18 C21,19.6569 19.6569,21 18,21 C16.3431,21 15,19.6569 15,18 C15,16.6938 15.8348,15.5825 17,15.1707 L17,14 C17,13.4477 16.5523,13 16,13 L8,13 C7.44772,13 7,13.4477 7,14 L7,15.1707 C8.16519,15.5825 9,16.6938 9,18 C9,19.6569 7.65685,21 6,21 C4.34315,21 3,19.6569 3,18 C3,16.6938 3.83481,15.5825 5,15.1707 L5,14 C5,12.3431 6.34315,11 8,11 L11,11 L11,8.82929 C9.83481,8.41746 9,7.30622 9,6 C9,4.34315 10.3431,3 12,3 C13.6569,3 15,4.34315 15,6 Z M12,5 C11.4477,5 11,5.44772 11,6 C11,6.55228 11.4477,7 12,7 C12.5523,7 13,6.55228 13,6 C13,5.44772 12.5523,5 12,5 Z M6,17 C5.44772,17 5,17.4477 5,18 C5,18.5523 5.44772,19 6,19 C6.55228,19 7,18.5523 7,18 C7,17.4477 6.55228,17 6,17 Z M18,17 C17.4477,17 17,17.4477 17,18 C17,18.5523 17.4477,19 18,19 C18.5523,19 19,18.5523 19,18 C19,17.4477 18.5523,17 18,17 Z"
                                                                                id="形状" fill="#9e9e9e"> </path>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <input type="text" value="{{ $emp_data->department }}"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Your Department" id="department">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Designation <span style="color:#ce3b3b">*</span> </label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg fill="#9e9e9e" version="1.1" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            viewBox="0 0 472.615 472.615" xml:space="preserve"
                                                            width="20px" height="20px" stroke="#9e9e9e">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <g>
                                                                        <path
                                                                            d="M328.776,104.453V39.385H143.839v65.068h-41.097v164.386h106.595l-3.853-30.821h61.645l-3.853,30.821h106.595V104.453 H328.776z M308.227,104.453H164.388V59.934h143.839V104.453z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                                <g>
                                                                    <g>
                                                                        <polygon
                                                                            points="260.709,289.388 256.857,320.213 215.759,320.213 211.906,289.388 102.743,289.388 102.743,433.229 369.873,433.229 369.873,289.388 ">
                                                                        </polygon>
                                                                    </g>
                                                                </g>
                                                                <g>
                                                                    <g>
                                                                        <rect x="410.969" y="104.457" width="61.647"
                                                                            height="328.773"></rect>
                                                                    </g>
                                                                </g>
                                                                <g>
                                                                    <g>
                                                                        <rect y="104.457" width="61.647"
                                                                            height="328.773"></rect>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <input type="text" id="Emp_Designation"
                                                            value="{{ $emp_data->Emp_Designation }}"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Your Designation">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Shift <span style="color:#ce3b3b">*</span> </label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        @if ($emp_data->Emp_Shift_Time == 'Night')
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path d="M8 22H16" stroke="#9e9e9e"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path d="M5 19H19" stroke="#9e9e9e"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path d="M2 16H22" stroke="#9e9e9e"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path
                                                                        d="M21.0672 11.8568L20.4253 11.469L21.0672 11.8568ZM12.1432 2.93276L11.7553 2.29085V2.29085L12.1432 2.93276ZM20.4806 15.6997C20.3148 16.0793 20.4881 16.5214 20.8676 16.6873C21.2472 16.8531 21.6893 16.6798 21.8552 16.3003L20.4806 15.6997ZM2.14482 16.3003C2.31066 16.6798 2.7528 16.8531 3.13237 16.6873C3.51193 16.5214 3.68519 16.0793 3.51935 15.6997L2.14482 16.3003ZM3.98703 7.37554C4.19443 7.017 4.07191 6.5582 3.71337 6.3508C3.35482 6.14339 2.89602 6.26591 2.68862 6.62446L3.98703 7.37554ZM6.62446 2.68862C6.26591 2.89602 6.14339 3.35482 6.3508 3.71337C6.5582 4.07191 7.017 4.19443 7.37554 3.98703L6.62446 2.68862ZM15.5 14.25C12.3244 14.25 9.75 11.6756 9.75 8.5H8.25C8.25 12.5041 11.4959 15.75 15.5 15.75V14.25ZM20.4253 11.469C19.4172 13.1373 17.5882 14.25 15.5 14.25V15.75C18.1349 15.75 20.4407 14.3439 21.7092 12.2447L20.4253 11.469ZM9.75 8.5C9.75 6.41182 10.8627 4.5828 12.531 3.57467L11.7553 2.29085C9.65609 3.5593 8.25 5.86509 8.25 8.5H9.75ZM21.25 12C21.25 13.3169 20.9752 14.5677 20.4806 15.6997L21.8552 16.3003C22.431 14.9824 22.75 13.5275 22.75 12H21.25ZM3.51935 15.6997C3.02475 14.5677 2.75 13.3169 2.75 12H1.25C1.25 13.5275 1.56904 14.9824 2.14482 16.3003L3.51935 15.6997ZM12 2.75C11.9115 2.75 11.8077 2.71008 11.7324 2.63168C11.6686 2.56527 11.6538 2.50244 11.6503 2.47703C11.6461 2.44587 11.6482 2.35557 11.7553 2.29085L12.531 3.57467C13.0342 3.27065 13.196 2.71398 13.1368 2.27627C13.0754 1.82126 12.7166 1.25 12 1.25V2.75ZM21.7092 12.2447C21.6444 12.3518 21.5541 12.3539 21.523 12.3497C21.4976 12.3462 21.4347 12.3314 21.3683 12.2676C21.2899 12.1923 21.25 12.0885 21.25 12H22.75C22.75 11.2834 22.1787 10.9246 21.7237 10.8632C21.286 10.804 20.7293 10.9658 20.4253 11.469L21.7092 12.2447ZM2.75 12C2.75 10.3139 3.20043 8.73533 3.98703 7.37554L2.68862 6.62446C1.77351 8.2064 1.25 10.0432 1.25 12H2.75ZM7.37554 3.98703C8.73533 3.20043 10.3139 2.75 12 2.75V1.25C10.0432 1.25 8.2064 1.77351 6.62446 2.68862L7.37554 3.98703Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M19.9001 2.30719C19.7392 1.8976 19.1616 1.8976 19.0007 2.30719L18.5703 3.40247C18.5212 3.52752 18.4226 3.62651 18.298 3.67583L17.2067 4.1078C16.7986 4.26934 16.7986 4.849 17.2067 5.01054L18.298 5.44252C18.4226 5.49184 18.5212 5.59082 18.5703 5.71587L19.0007 6.81115C19.1616 7.22074 19.7392 7.22074 19.9001 6.81116L20.3305 5.71587C20.3796 5.59082 20.4782 5.49184 20.6028 5.44252L21.6941 5.01054C22.1022 4.849 22.1022 4.26934 21.6941 4.1078L20.6028 3.67583C20.4782 3.62651 20.3796 3.52752 20.3305 3.40247L19.9001 2.30719Z"
                                                                        stroke="#9e9e9e"></path>
                                                                    <path
                                                                        d="M16.0328 8.12967C15.8718 7.72009 15.2943 7.72009 15.1333 8.12967L14.9764 8.52902C14.9273 8.65407 14.8287 8.75305 14.7041 8.80237L14.3062 8.95987C13.8981 9.12141 13.8981 9.70107 14.3062 9.86261L14.7041 10.0201C14.8287 10.0694 14.9273 10.1684 14.9764 10.2935L15.1333 10.6928C15.2943 11.1024 15.8718 11.1024 16.0328 10.6928L16.1897 10.2935C16.2388 10.1684 16.3374 10.0694 16.462 10.0201L16.8599 9.86261C17.268 9.70107 17.268 9.12141 16.8599 8.95987L16.462 8.80237C16.3374 8.75305 16.2388 8.65407 16.1897 8.52902L16.0328 8.12967Z"
                                                                        stroke="#9e9e9e"></path>
                                                                </g>
                                                            </svg>
                                                        @else
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path d="M8 22H16" stroke="#9e9e9e"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path d="M5 19H19" stroke="#9e9e9e"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path d="M2 16H22" stroke="#9e9e9e"
                                                                        stroke-width="1.5" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path
                                                                        d="M12 6C8.68629 6 6 8.68629 6 12C6 13.5217 6.56645 14.911 7.5 15.9687H16.5C17.4335 14.911 18 13.5217 18 12C18 8.68629 15.3137 6 12 6Z"
                                                                        stroke="#9e9e9e" stroke-width="1.5"></path>
                                                                    <path d="M12 2V3" stroke="#9e9e9e"
                                                                        stroke-width="1.5" stroke-linecap="round">
                                                                    </path>
                                                                    <path d="M22 12L21 12" stroke="#9e9e9e"
                                                                        stroke-width="1.5" stroke-linecap="round">
                                                                    </path>
                                                                    <path d="M3 12L2 12" stroke="#9e9e9e"
                                                                        stroke-width="1.5" stroke-linecap="round">
                                                                    </path>
                                                                    <path d="M19.0708 4.92969L18.678 5.32252"
                                                                        stroke="#9e9e9e" stroke-width="1.5"
                                                                        stroke-linecap="round"></path>
                                                                    <path d="M5.32178 5.32227L4.92894 4.92943"
                                                                        stroke="#9e9e9e" stroke-width="1.5"
                                                                        stroke-linecap="round"></path>
                                                                </g>
                                                            </svg>
                                                        @endif

                                                        <select name="emp_shift_time" id="emp_shift_time"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;">
                                                            <option value=""
                                                                {{ $emp_data->Emp_Shift_Time == '' ? 'selected' : '' }}>
                                                                Select Option</option>
                                                            <option value="Morning"
                                                                {{ $emp_data->Emp_Shift_Time == 'Morning' ? 'selected' : '' }}>
                                                                Morning</option>
                                                            <option value="Night"
                                                                {{ $emp_data->Emp_Shift_Time == 'Night' ? 'selected' : '' }}>
                                                                Night</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <input type="hidden" id="emp_code_database"
                                                    value="{{ $emp_data->Emp_Code }}">
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6">
                                                <div class="d-flex flex-column">
                                                    <label for="">Joining Date <span style="color:#ce3b3b">*</span> </label>
                                                    <div class="mb-3 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <path
                                                                    d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7"
                                                                    stroke="#9e9e9e" stroke-width="2"
                                                                    stroke-linecap="round"></path>
                                                                <rect x="6" y="12" width="3" height="3"
                                                                    rx="0.5" fill="#9e9e9e"></rect>
                                                                <rect x="10.5" y="12" width="3" height="3"
                                                                    rx="0.5" fill="#9e9e9e"></rect>
                                                                <rect x="15" y="12" width="3" height="3"
                                                                    rx="0.5" fill="#9e9e9e"></rect>
                                                            </g>
                                                        </svg>
                                                        <input type="date"
                                                            value="{{ $emp_data->Emp_Joining_Date }}"
                                                            style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                            placeholder="Enter Joining Date" id="emp_joining_date">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button class="px-4 py-2 reblateBtn" onclick="updateCompanyDetails()"
                                                type="button">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>


                <script>
                    function updateCompanyDetails() {


                        var csrfToken = "{{ csrf_token() }}";

                        var emp_joining_date = document.getElementById('emp_joining_date').value;
                        var emp_shift_time = document.getElementById('emp_shift_time').value;
                        var Emp_Designation = document.getElementById('Emp_Designation').value;
                        var department = document.getElementById('department').value;
                        var emp_code_input = document.getElementById('emp_code').value;
                        var emp_code = document.getElementById('emp_code_database').value;



                        var error_message_company = document.getElementById('error_message_company');

                        if(emp_code_input == "") {
                            error_message_company.innerHTML = "Emp Code Required!";
                            error_message_company.style.display = "block";
                            return;
                        } else {
                            error_message_company.style.display = "none";
                        }

                        if(department == "") {
                            error_message_company.innerHTML = "Department Required!";
                            error_message_company.style.display = "block";
                            return;
                        } else {
                            error_message_company.style.display = "none";
                        }

                        if(Emp_Designation == "") {
                            error_message_company.innerHTML = "Designation Required!";
                            error_message_company.style.display = "block";
                            return;
                        } else {
                            error_message_company.style.display = "none";
                        }

                        if(emp_shift_time == "") {
                            error_message_company.innerHTML = "Shift Required!";
                            error_message_company.style.display = "block";
                            return;
                        } else {
                            error_message_company.style.display = "none";
                        }


                        if(emp_joining_date == "") {
                            error_message_company.innerHTML = "Joining Date Required!";
                            error_message_company.style.display = "block";
                            return;
                        } else {
                            error_message_company.style.display = "none";
                        }


                        var formData = new FormData();
                        formData.append('emp_joining_date', emp_joining_date);
                        formData.append('emp_shift_time', emp_shift_time);
                        formData.append('Emp_Designation', Emp_Designation);
                        formData.append('department', department);
                        formData.append('emp_code_input', emp_code_input);
                        formData.append('emp_code', emp_code);




                        fetch('/update-info-company', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                                },
                                body: formData
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                                var success_message = document.getElementById('success_message_company');
                                success_message.innerHTML = "Data Updatede Successfully!";
                                success_message.style.display = "block";
                            })
                            .then(data => {

                                if (data.message === 'Data received successfully') {
                                    var success_message = document.getElementById('success_message_company');
                                    success_message.innerHTML = "Data Updated Successfully!";
                                    // Hide the success message after 5 seconds
                                    success_message.style.display = "block";
                                    setTimeout(function() {
                                        success_message.style.display = "none";
                                    }, 1000); // 5000 milliseconds = 5 seconds
                                } else {

                                    var success_message = document.getElementById('error_message_company');
                                    success_message.innerHTML = "Something went wrong!";
                                    // Hide the success message after 5 seconds
                                    success_message.style.display = "block";
                                    setTimeout(function() {
                                        success_message.style.display = "none";
                                    }, 1000); // 5000 milliseconds = 5 seconds
                                }
                            })
                            .catch(error => {
                                console.error('There was a problem with the fetch operation:', error);
                            });
                    }
                </script>

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
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">
                                        Projects
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
                                    <h2 class="mb-3" style="color: #fca311; font-weight: 600; font-size: 25px;">
                                        Company
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
                                    <div id="popupButton6"
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#14213d50" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    <h2 class="mb-3 ms-3" style="color: #fca311; font-weight: 600; font-size: 25px;">
                                        Bank
                                        Details</h2>
                                    <ul class="personal-info m-0 p-0 ps-3" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Bank Name:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->Emp_Bank_Name }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Account Title:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->account_title }}</p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Account No</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->account_number }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">IBAN:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">

                                                {{ $emp_data->Emp_Bank_IBAN }}

                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Branch Name:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->branch_name }}
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Branch Code:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->branch_code }}
                                            </p>
                                        </li>

                                    </ul>
                                </div>
                                <div class="popup" id="popup6">

                                    <div class="popup-content flex-column">
                                        <div class="d-flex mb-3 align-items-center justify-content-between">
                                            <h2 class="mb-0"
                                                style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                                Bank Details</h2>
                                            <span class="closeBtn6 p-2"
                                                style="border-radius: 50%; background-color:#14213d26"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#14213d50" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                </svg></span>
                                        </div>
                                        <p id="success_message_bank" style="color:green;font-size:15px;display:none;">
                                        </p>
                                        <p id="error_message_bank" style="color:#ce3b3b;font-size:15px;display:none;"></p>
                                        <form action="" class="text-start">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Bank Name <span style="color:#ce3b3b;">*</span></label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M10.8321 1.24802C11.5779 0.917327 12.4221 0.917327 13.1679 1.24802L21.7995 5.0754C23.7751 5.95141 23.1703 9 21.0209 9H2.97906C0.829669 9 0.224891 5.9514 2.20047 5.0754L10.8321 1.24802ZM12.3893 3.12765C12.1407 3.01742 11.8593 3.01742 11.6107 3.12765L3.41076 6.76352C3.31198 6.80732 3.34324 6.95494 3.45129 6.95494H20.5487C20.6568 6.95494 20.688 6.80732 20.5892 6.76352L12.3893 3.12765Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M2 22C2 21.4477 2.44772 21 3 21H21C21.5523 21 22 21.4477 22 22C22 22.5523 21.5523 23 21 23H3C2.44772 23 2 22.5523 2 22Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V11C13 10.4477 12.5523 10 12 10C11.4477 10 11 10.4477 11 11V19Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M6 20C5.44772 20 5 19.5523 5 19L5 11C5 10.4477 5.44771 10 6 10C6.55228 10 7 10.4477 7 11L7 19C7 19.5523 6.55229 20 6 20Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M17 19C17 19.5523 17.4477 20 18 20C18.5523 20 19 19.5523 19 19V11C19 10.4477 18.5523 10 18 10C17.4477 10 17 10.4477 17 11V19Z"
                                                                        fill="#9e9e9e"></path>
                                                                </g>
                                                            </svg>
                                                            <input type="text"
                                                                value="{{ $emp_data->Emp_Bank_Name }}"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Your Bank Name" id="bank_name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Account Title <span style="color:#ce3b3b;">*</span> </label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg height="20px" width="20px" version="1.1"
                                                                id="_x32_" xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                viewBox="0 0 512 512" xml:space="preserve"
                                                                fill="#000000">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <style type="text/css">
                                                                        .st0 {
                                                                            fill: #9e9e9e;
                                                                        }
                                                                    </style>
                                                                    <g>
                                                                        <path class="st0"
                                                                            d="M256,265.308c73.252,0,132.644-59.391,132.644-132.654C388.644,59.412,329.252,0,256,0 c-73.262,0-132.643,59.412-132.643,132.654C123.357,205.917,182.738,265.308,256,265.308z">
                                                                        </path>
                                                                        <path class="st0"
                                                                            d="M425.874,393.104c-5.922-35.474-36-84.509-57.552-107.465c-5.829-6.212-15.948-3.628-19.504-1.427 c-27.04,16.672-58.782,26.399-92.819,26.399c-34.036,0-65.778-9.727-92.818-26.399c-3.555-2.201-13.675-4.785-19.505,1.427 c-21.55,22.956-51.628,71.991-57.551,107.465C71.573,480.444,164.877,512,256,512C347.123,512,440.427,480.444,425.874,393.104z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                            <input type="text"
                                                                value="{{ $emp_data->account_title }}"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Account User" id="account_title">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Account No <span style="color:#ce3b3b;">*</span> </label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg" fill="#9e9e9e"
                                                                stroke="">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <g>
                                                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                                                        <path
                                                                            d="M3 4.995C3 3.893 3.893 3 4.995 3h14.01C20.107 3 21 3.893 21 4.995v14.01A1.995 1.995 0 0 1 19.005 21H4.995A1.995 1.995 0 0 1 3 19.005V4.995zM6.357 18h11.49a6.992 6.992 0 0 0-5.745-3 6.992 6.992 0 0 0-5.745 3zM12 13a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                            <input type="number"
                                                                value="{{ $emp_data->account_number }}"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Your Account No" id="account_number">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">IBAN <span style="color:#ce3b3b;">*</span> </label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <g id="Interface / Credit_Card_01">
                                                                        <path id="Vector"
                                                                            d="M3 11V15.8002C3 16.9203 3 17.4801 3.21799 17.9079C3.40973 18.2842 3.71547 18.5905 4.0918 18.7822C4.5192 19 5.07899 19 6.19691 19H17.8031C18.921 19 19.48 19 19.9074 18.7822C20.2837 18.5905 20.5905 18.2842 20.7822 17.9079C21 17.4805 21 16.9215 21 15.8036V11M3 11V9M3 11H21M3 9V8.2002C3 7.08009 3 6.51962 3.21799 6.0918C3.40973 5.71547 3.71547 5.40973 4.0918 5.21799C4.51962 5 5.08009 5 6.2002 5H17.8002C18.9203 5 19.4796 5 19.9074 5.21799C20.2837 5.40973 20.5905 5.71547 20.7822 6.0918C21 6.5192 21 7.07899 21 8.19691V9M3 9H21M7 15H11M21 11V9"
                                                                            stroke="#9e9e9e" stroke-width="2"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round"></path>
                                                                    </g>
                                                                </g>
                                                            </svg>
                                                            <input type="number"
                                                                value="{{ $emp_data->Emp_Bank_IBAN }}"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Your IBAN No" id="bank_iban">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Branch Name <span style="color:#ce3b3b;">*</span> </label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M10.8321 1.24802C11.5779 0.917327 12.4221 0.917327 13.1679 1.24802L21.7995 5.0754C23.7751 5.95141 23.1703 9 21.0209 9H2.97906C0.829669 9 0.224891 5.9514 2.20047 5.0754L10.8321 1.24802ZM12.3893 3.12765C12.1407 3.01742 11.8593 3.01742 11.6107 3.12765L3.41076 6.76352C3.31198 6.80732 3.34324 6.95494 3.45129 6.95494H20.5487C20.6568 6.95494 20.688 6.80732 20.5892 6.76352L12.3893 3.12765Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M2 22C2 21.4477 2.44772 21 3 21H21C21.5523 21 22 21.4477 22 22C22 22.5523 21.5523 23 21 23H3C2.44772 23 2 22.5523 2 22Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V11C13 10.4477 12.5523 10 12 10C11.4477 10 11 10.4477 11 11V19Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M6 20C5.44772 20 5 19.5523 5 19L5 11C5 10.4477 5.44771 10 6 10C6.55228 10 7 10.4477 7 11L7 19C7 19.5523 6.55229 20 6 20Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M17 19C17 19.5523 17.4477 20 18 20C18.5523 20 19 19.5523 19 19V11C19 10.4477 18.5523 10 18 10C17.4477 10 17 10.4477 17 11V19Z"
                                                                        fill="#9e9e9e"></path>
                                                                </g>
                                                            </svg>
                                                            <input type="text" value="{{ $emp_data->branch_name }}"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Your Branch Name" id="branch_name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Branch Code <span style="color:#ce3b3b;">*</span> </label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M10.8321 1.24802C11.5779 0.917327 12.4221 0.917327 13.1679 1.24802L21.7995 5.0754C23.7751 5.95141 23.1703 9 21.0209 9H2.97906C0.829669 9 0.224891 5.9514 2.20047 5.0754L10.8321 1.24802ZM12.3893 3.12765C12.1407 3.01742 11.8593 3.01742 11.6107 3.12765L3.41076 6.76352C3.31198 6.80732 3.34324 6.95494 3.45129 6.95494H20.5487C20.6568 6.95494 20.688 6.80732 20.5892 6.76352L12.3893 3.12765Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M2 22C2 21.4477 2.44772 21 3 21H21C21.5523 21 22 21.4477 22 22C22 22.5523 21.5523 23 21 23H3C2.44772 23 2 22.5523 2 22Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V11C13 10.4477 12.5523 10 12 10C11.4477 10 11 10.4477 11 11V19Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M6 20C5.44772 20 5 19.5523 5 19L5 11C5 10.4477 5.44771 10 6 10C6.55228 10 7 10.4477 7 11L7 19C7 19.5523 6.55229 20 6 20Z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M17 19C17 19.5523 17.4477 20 18 20C18.5523 20 19 19.5523 19 19V11C19 10.4477 18.5523 10 18 10C17.4477 10 17 10.4477 17 11V19Z"
                                                                        fill="#9e9e9e"></path>
                                                                </g>
                                                            </svg>
                                                            <input type="number" value="{{ $emp_data->branch_code }}"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Your Branch Code" id="branch_code">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <button type="button" onclick="updateBank()"
                                                        class="px-4 py-2 reblateBtn">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function updateBank() {


                                var csrfToken = "{{ csrf_token() }}";

                                var branch_code = document.getElementById('branch_code').value;
                                var branch_name = document.getElementById('branch_name').value;
                                var bank_iban = document.getElementById('bank_iban').value;
                                var bank_name = document.getElementById('bank_name').value;
                                var account_number = document.getElementById('account_number').value;
                                var account_title = document.getElementById('account_title').value;

                                var emp_code = document.getElementById('emp_code').value;

                                var error_message_bank = document.getElementById('error_message_bank');

                                if(bank_name == "") {
                                    error_message_bank.innerHTML = "Bank Name Required";
                                    error_message_bank.style.display = "block";
                                    return;
                                } else {
                                    error_message_bank.style.display = "none";
                                }

                                if(account_title == "") {
                                    error_message_bank.innerHTML = "Bank Account Title Required";
                                    error_message_bank.style.display = "block";
                                    return;
                                } else {
                                    error_message_bank.style.display = "none";
                                }

                                if(account_number == "") {
                                    error_message_bank.innerHTML = "Bank Account Number Required";
                                    error_message_bank.style.display = "block";
                                    return;
                                } else {
                                    error_message_bank.style.display = "none";
                                }

                                if(bank_iban == "") {
                                    error_message_bank.innerHTML = "Bank IBAN Required";
                                    error_message_bank.style.display = "block";
                                    return;
                                } else {
                                    error_message_bank.style.display = "none";
                                }

                                if(branch_name == "") {
                                    error_message_bank.innerHTML = "Branch Name Required";
                                    error_message_bank.style.display = "block";
                                    return;
                                } else {
                                    error_message_bank.style.display = "none";
                                }

                                if(branch_code == "") {
                                    error_message_bank.innerHTML = "Branch Code Required";
                                    error_message_bank.style.display = "block";
                                    return;
                                } else {
                                    error_message_bank.style.display = "none";
                                }



                                var formData = new FormData();
                                formData.append('branch_code', branch_code);
                                formData.append('branch_name', branch_name);
                                formData.append('account_number', account_number);
                                formData.append('bank_name', bank_name);
                                formData.append('bank_iban', bank_iban);
                                formData.append('account_title', account_title);
                                formData.append('emp_code', emp_code);




                                fetch('/update-info-bank', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                                        },
                                        body: formData
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Network response was not ok');
                                        }
                                        return response.json();
                                        var success_message = document.getElementById('success_message_salary');
                                        success_message.innerHTML = "Data Updatede Successfully!";
                                        success_message.style.display = "block";
                                    })
                                    .then(data => {

                                        if (data.message === 'Data received successfully') {
                                            var success_message = document.getElementById('success_message_bank');
                                            success_message.innerHTML = "Data Updated Successfully!";
                                            // Hide the success message after 5 seconds
                                            success_message.style.display = "block";
                                            setTimeout(function() {
                                                success_message.style.display = "none";
                                            }, 1000); // 5000 milliseconds = 5 seconds
                                        } else {

                                            var success_message = document.getElementById('error_message_bank');
                                            success_message.innerHTML = "Something went wrong!";
                                            // Hide the success message after 5 seconds
                                            success_message.style.display = "block";
                                            setTimeout(function() {
                                                success_message.style.display = "none";
                                            }, 1000); // 5000 milliseconds = 5 seconds
                                        }
                                    })
                                    .catch(error => {
                                        console.error('There was a problem with the fetch operation:', error);
                                    });
                            }
                        </script>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-body bg-light" style="border: 1px solid #c7c7c7; min-height: 242px">
                                    @if (Auth()->user()->user_type == "admin" || Auth()->user()->user_type == "manager")
                                        <div id="popupButton7"
                                        style="width: 30px; height:30px; background-color:#14213d26; border-radius:50%; position: absolute;right:10px; cursor:pointer">
                                        <svg style="position: relative;right:-6px;top:4px;"
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="#14213d50" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </div>
                                    @endif

                                    <h2 class="mb-3 ms-3" style="color: #fca311; font-weight: 600; font-size: 25px;">
                                        Salary
                                        Details</h2>
                                    <ul class="personal-info m-0 p-0 ps-3" style="list-style: none; ">
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Basic Salary:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->basic_salary }}/-
                                            </p>
                                        </li>
                                        {{-- <li class="d-flex gap-4 align-items-center">
                                            <div style="float: left; width:15%;">Bank account No.:</div>
                                            <div class="text" style="color:#14213d;">25446843154168468</div>
                                        </li> --}}
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Designation Bouns:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->designation_bonus }}/-
                                            </p>
                                        </li>
                                        <li class="d-flex mb-1 gap-4 align-items-center">
                                            <h2 class="detailLabel mb-1">Travel Allounce:</h2>
                                            <p class="text detailInfo mb-0" style="color:#14213d;">
                                                {{ $emp_data->travel_allowance }}/-
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="popup" id="popup7">
                                    <div class="popup-content flex-column">
                                        <p id="success_message_salary" style="color:green;font-size:15px;display:none;">
                                        </p>
                                        <p id="error_message_salary" style="color:red;font-size:15px;display:none;"></p>
                                        <div class="d-flex mb-3 align-items-center justify-content-between">

                                            <h2 class="mb-0"
                                                style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                                Salary Details</h2>
                                            <span class="closeBtn7 p-2"
                                                style="border-radius: 50%; background-color:#14213d26"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="#14213d50" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                </svg></span>
                                        </div>
                                        <form action="" class="text-start">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Basic Salary:</label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 24 24"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path
                                                                        d="M6 9.5V14.5M18 9.5V14.5M3.11111 6H20.8889C21.5025 6 22 6.53726 22 7.2V16.8C22 17.4627 21.5025 18 20.8889 18H3.11111C2.49746 18 2 17.4627 2 16.8V7.2C2 6.53726 2.49746 6 3.11111 6ZM14.5 12C14.5 13.3807 13.3807 14.5 12 14.5C10.6193 14.5 9.5 13.3807 9.5 12C9.5 10.6193 10.6193 9.5 12 9.5C13.3807 9.5 14.5 10.6193 14.5 12Z"
                                                                        stroke="#9e9e9e" stroke-width="1.5"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                            <input type="number"
                                                                value="{{ $emp_data->basic_salary }}"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Your Basic Salary"
                                                                id="emp_basic_salary">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Designation Bonus:</label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg width="20px" height="20px" viewBox="0 0 100 100"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                aria-hidden="true" role="img"
                                                                class="iconify iconify--gis"
                                                                preserveAspectRatio="xMidYMid meet" fill="#000000">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <path
                                                                        d="M68.913 48.908l-.048.126c.015-.038.027-.077.042-.115l.006-.011z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M63.848 73.354l-1.383 1.71c1.87.226 3.68.491 5.375.812l-5.479 1.623l7.313 1.945l5.451-1.719c3.348 1.123 7.984 2.496 9.52 4.057h-10.93l1.086 3.176h11.342c-.034 1.79-3.234 3.244-6.29 4.422l-7.751-1.676l-7.303 2.617l7.8 1.78c-4.554 1.24-12.2 1.994-18.53 2.341l-.266-3.64h-7.606l-.267 3.64c-6.33-.347-13.975-1.1-18.53-2.34l7.801-1.781l-7.303-2.617l-7.752 1.676c-3.012-.915-6.255-2.632-6.289-4.422H25.2l1.086-3.176h-10.93c1.536-1.561 6.172-2.934 9.52-4.057l5.451 1.719l7.313-1.945l-5.479-1.623a82.552 82.552 0 0 1 5.336-.807l-1.363-1.713c-14.785 1.537-27.073 4.81-30.295 9.979C.7 91.573 19.658 99.86 49.37 99.989c.442.022.878.006 1.29 0c29.695-.136 48.636-8.42 43.501-16.654c-3.224-5.171-15.52-8.445-30.314-9.981z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M49.855 0A10.5 10.5 0 0 0 39.5 10.5A10.5 10.5 0 0 0 50 21a10.5 10.5 0 0 0 10.5-10.5A10.5 10.5 0 0 0 50 0a10.5 10.5 0 0 0-.145 0zm-.057 23.592c-7.834.002-15.596 3.368-14.78 10.096l2 14.625c.351 2.573 2.09 6.687 4.687 6.687h.185l2.127 24.531c.092 1.105.892 2 2 2h8c1.108 0 1.908-.895 2-2l2.127-24.53h.186c2.597 0 4.335-4.115 4.687-6.688l2-14.625c.524-6.734-7.384-10.097-15.219-10.096z"
                                                                        fill="#9e9e9e"></path>
                                                                    <path
                                                                        d="M-159.25 61.817l-.048.126c.016-.038.027-.076.043-.115c0-.004.004-.007.006-.01z"
                                                                        fill="#9e9e9e"></path>
                                                                </g>
                                                            </svg>
                                                            <input type="number"
                                                                value="{{ $emp_data->designation_bonus }}"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Your Designation Bouns"
                                                                id="emp_designation_bonus">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="d-flex flex-column">
                                                        <label for="">Travel Allounce:</label>
                                                        <div class="mb-3 d-flex form-control inputboxcolor "
                                                            style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px"
                                                                height="20px" viewBox="0 0 24 24" fill="none"
                                                                stroke="#9e9e9e" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round">
                                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                    stroke-linejoin="round"></g>
                                                                <g id="SVGRepo_iconCarrier">
                                                                    <circle cx="5.5" cy="17.5" r="3.5">
                                                                    </circle>
                                                                    <circle cx="18.5" cy="17.5" r="3.5">
                                                                    </circle>
                                                                    <path
                                                                        d="M15 6a1 1 0 100-2 1 1 0 000 2zm-3 11.5V14l-3-3 4-3 2 3h2">
                                                                    </path>
                                                                </g>
                                                            </svg>
                                                            <input type="number"
                                                                value="{{ $emp_data->travel_allowance }}"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                                placeholder="Enter Your Bank Name"
                                                                id="emp_travel_allowance">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" value="{{ $emp_data->Emp_Code }}" id="emp_code">
                                            <div class="mt-2">
                                                <button type="button" onclick="updateSalary()"
                                                    class="px-4 py-2 reblateBtn">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                    <script>
                        function updateSalary() {


                            var csrfToken = "{{ csrf_token() }}";

                            var emp_basic_salary = document.getElementById('emp_basic_salary').value;
                            var emp_designation_bonus = document.getElementById('emp_designation_bonus').value;
                            var emp_travel_allowance = document.getElementById('emp_travel_allowance').value;
                            var emp_code = document.getElementById('emp_code').value;

                            if(emp_basic_salary == "" ) {
                                emp_basic_salary = 0;
                            }

                            if(emp_designation_bonus == "" ) {
                                emp_designation_bonus = 0;
                            }

                            if(emp_travel_allowance == "" ) {
                                emp_travel_allowance = 0;
                            }



                            var formData = new FormData();
                            formData.append('emp_basic_salary', emp_basic_salary);
                            formData.append('emp_designation_bonus', emp_designation_bonus);
                            formData.append('emp_travel_allowance', emp_travel_allowance);
                            formData.append('emp_code', emp_code);




                            fetch('/update-info-salary', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                                    },
                                    body: formData
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        throw new Error('Network response was not ok');
                                    }
                                    return response.json();
                                    var success_message = document.getElementById('success_message_salary');
                                    success_message.innerHTML = "Data Updatede Successfully!";
                                    success_message.style.display = "block";
                                })
                                .then(data => {

                                    if (data.message === 'Data received successfully') {
                                        var success_message = document.getElementById('success_message_salary');
                                        success_message.innerHTML = "Data Updated Successfully!";
                                        // Hide the success message after 5 seconds
                                        success_message.style.display = "block";
                                        setTimeout(function() {
                                            success_message.style.display = "none";
                                        }, 1000); // 5000 milliseconds = 5 seconds
                                    } else {

                                        var success_message = document.getElementById('error_message_salary');
                                        success_message.innerHTML = "Something went wrong!";
                                        // Hide the success message after 5 seconds
                                        success_message.style.display = "block";
                                        setTimeout(function() {
                                            success_message.style.display = "none";
                                        }, 1000); // 5000 milliseconds = 5 seconds
                                    }
                                })
                                .catch(error => {
                                    console.error('There was a problem with the fetch operation:', error);
                                });
                        }
                    </script>



                </div>
            </div>
            <div class="container-fluid tab-pane fade" style="border-bottom: none" id="assests">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-body bg-light d-flex" style="border: 1px solid #c7c7c7" id="profile">
                                <table class="table ">

                                    <tr style="background-color: #14213d">
                                        <td class="borderingLeftTable font-size-20" style="color: white">#</td>
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
                                        <td style="font-family: 'Poppins'; color:#000">{{ $emp_data->Emp_Full_Name }}
                                        </td>
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
                                        <td style="font-family: 'Poppins'; color:#000">{{ $emp_data->Emp_Full_Name }}
                                        </td>
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
                                        <td style="font-family: 'Poppins'; color:#000">{{ $emp_data->Emp_Full_Name }}
                                        </td>
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
                                        <td style="font-family: 'Poppins'; color:#000">{{ $emp_data->Emp_Full_Name }}
                                        </td>
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
                                        <td style="font-family: 'Poppins'; color:#000">{{ $emp_data->Emp_Full_Name }}
                                        </td>
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
            // save image
            function saveImage() {
                var fileInput = document.getElementById('file-input');
                var img = fileInput.value;
                var error = document.getElementById('select-file');
                var emp_code_file = document.getElementById('emp_code_file').value;

                // Check if a file is attached
                if (img === "") {
                    error.textContent = "Please select a file.";
                    error.style.display = "block";
                    return;
                } else {
                        error.style.display = "none";
                    }


                // Check file size
                var fileSize = fileInput.files[0].size; // in bytes
                var maxSize = 2 * 1024 * 1024; // 5 MB in bytes
                if (fileSize > maxSize) {
                    error.textContent = "File size exceeds the limit of 2 MB.";
                    error.style.display = "block";
                    return;
                }

                // Check file type
                var allowedTypes = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];
                var fileType = fileInput.files[0].type;
                if (!allowedTypes.includes(fileType)) {
                    error.textContent = "Only PNG, JPEG, JPG, and WEBP file types are allowed.";
                    error.style.display = "block";
                    return;
                }

                var csrfToken = "{{ csrf_token() }}";

                var formData = new FormData();
                formData.append('fileInput', fileInput.files[0]); // Append the actual file
                formData.append('emp_code_file', emp_code_file);

                fetch('/update-photo-emp', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }


                        return response.json();
                    })

                    .then(data => {

                        if (data.success) {
                            var success_message = document.getElementById('success_message_file');
                            success_message.innerHTML = "Image Uploaded Successfully!";
                            // Hide the success message after 5 seconds
                            success_message.style.display = "block";
                            setTimeout(function() {
                                success_message.style.display = "none";
                                document.getElementById('file-input').value = "";
                                document.getElementById('file-label').textContent = "Upload file here";
                            }, 5000); // 5000 milliseconds = 5 seconds

                        } else {
                            var success_message = document.getElementById('error_message_file');
                            success_message.innerHTML = "Something Went Wrong!";
                            // Hide the success message after 5 seconds
                            success_message.style.display = "block";
                            setTimeout(function() {
                                success_message.style.display = "none";
                            }, 5000); // 5000 milliseconds = 5 seconds
                        }
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });


            }
            // file modal
            function openFileModal() {

                var popupButton = 'file_modal';
                var popup = 'popup_file';
                var closeBtn = '.closeBtn';


                const popupButtonControl = document.getElementById(popupButton);
                const popupControl = document.getElementById(popup);
                const closeBtnControl = document.querySelector(closeBtn);

                popupButtonControl.addEventListener('click', function() {
                    popupControl.style.display = 'block';
                });

                closeBtnControl.addEventListener('click', function() {
                    popupControl.style.display = 'none';
                });

                window.addEventListener('click', function(e) {
                    if (e.target === popupControl) {
                        popupControl.style.display = 'none';
                    }
                });
            }

            function openModel(id) {
                var popupButton = 'popupButton' + id;
                var popup = 'popup' + id;
                var closeBtn = '.closeBtn' + id;


                const popupButtonControl = document.getElementById(popupButton);
                const popupControl = document.getElementById(popup);
                const closeBtnControl = document.querySelector(closeBtn);

                popupButtonControl.addEventListener('click', function() {
                    popupControl.style.display = 'block';
                });

                closeBtnControl.addEventListener('click', function() {
                    popupControl.style.display = 'none';
                });

                window.addEventListener('click', function(e) {
                    if (e.target === popupControl) {
                        popupControl.style.display = 'none';
                    }
                });
            }

            function openWorkModel(id) {
                var popupButton = 'openWorkPopup' + id;
                var popup = 'popup_work' + id;
                var closeBtn = '.closeBtn' + id;


                const popupButtonControl = document.getElementById(popupButton);
                const popupControl = document.getElementById(popup);
                const closeBtnControl = document.querySelector(closeBtn);

                popupButtonControl.addEventListener('click', function() {
                    popupControl.style.display = 'block';
                });

                closeBtnControl.addEventListener('click', function() {
                    popupControl.style.display = 'none';
                });

                window.addEventListener('click', function(e) {
                    if (e.target === popupControl) {
                        popupControl.style.display = 'none';
                    }
                });
            }


            document.addEventListener('DOMContentLoaded', function() {
                const popupButton = document.getElementById('popupButton');
                const popup = document.getElementById('popup');
                const closeBtn = document.querySelector('#closeClass');

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
            document.addEventListener('DOMContentLoaded', function() {
                const popupButton = document.getElementById('popupButton4');
                const popup = document.getElementById('popup4');
                const closeBtn = document.querySelector('.closeBtn4');

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
                const popupButton = document.getElementById('popupButton5');
                const popup = document.getElementById('popup5');
                const closeBtn = document.querySelector('.closeBtn5');

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
                const popupButton = document.getElementById('popupButton6');
                const popup = document.getElementById('popup6');
                const closeBtn = document.querySelector('.closeBtn6');

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
                const popupButton = document.getElementById('popupButton7');
                const popup = document.getElementById('popup7');
                const closeBtn = document.querySelector('.closeBtn7');

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
