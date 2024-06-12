@extends('layouts.master')
@section('title')
    Employee Attendence
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Employee Attendence
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
            .image-center {
                width: 100px;
                height: 100px;
                border-radius: 50%;
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


            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-striped tbody tr:nth-of-type(2n+1) {
                background-color: #f5f6f7;
            }

            .custom-table td {
                padding: 10px 20px;
            }

            .table td {
                border-top: 1px solid #e9e9ea;
                white-space: nowrap;
                vertical-align: middle;
                padding: 3px;
                font-size: 12px;
            }

            /* .vertical-text {
                writing-mode: vertical-rl;
                text-orientation: mixed;
            } */

            .table th {
                font-size: 12px;
            }

            .table td h2 {
                display: inline-block;
                font-size: 12px;
                font-weight: 400;
                margin: 0;
                padding: 0;
                vertical-align: middle;
            }

            .avatar>img {
                width: 20px;
                height: 20px;
                -o-object-fit: cover;
                object-fit: cover;
                border-radius: 50%;
            }

            .stats-box {
                background-color: #f9f9f9;
                border: 1px solid #e2e4e6;
                margin: 0 0 15px;
                padding: 5px;
            }

            .modal-image {
                width: 100px;
                height: 100px;
                border-radius: 50%;
            }

            .punch-info .punch-hours {
                background-color: #f9f9f9;
                border: 5px solid #e2e4e6;
                font-size: 18px;
                height: 120px;
                width: 120px;
                margin: 0 auto;
                border-radius: 50%;
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                align-items: center;
                -webkit-box-align: center;
                -ms-flex-align: center;
                justify-content: center;
                -webkit-justify-content: center;
                -ms-flex-pack: center;
            }

            .date_sect {
                background: #eee;
                display: inline;
                padding: 10px;
                border-radius: 5px;
                font-weight: 500;
                font-size: 15px;
            }

            .recent-activity .res-activity-list {
                height: 328px;
                list-style-type: none;
                overflow-y: auto;
                position: relative;
                margin: 0;
                padding: 0 0 0 30px;
            }

            .recent-activity .res-activity-list li {
                margin: 0 0 15px;
                position: relative;
            }

            .recent-activity .res-activity-list li:before {
                content: "";
                width: 10px;
                height: 10px;
                border: 2px solid #ff902f;
                z-index: 2;
                background: #fff;
                border-radius: 100%;
                margin: 0 0 0 15px;
                position: absolute;
                top: 0;
                left: -45px;
            }

            .recent-activity p {
                font-size: 13px;
                margin: 0;
            }

            .recent-activity .res-activity-time {
                color: #bcbebf;
                font-size: 12px;
            }

            .card .card-title {
                color: #212529;
                font-size: 20px;
                font-weight: 500;
                margin-bottom: 20px;
            }

            .punch-det {
                background-color: #f9f9f9;
                border: 1px solid #e2e4e6;
                border-radius: 4px;
                margin: 0 0 20px;
                padding: 10px 15px;
            }

            .timeliner {
                border-left: 3px solid #14213d;
                border-bottom-right-radius: 4px;
                border-top-right-radius: 4px;
                background: rgba(114, 124, 245, 0.09);
                margin: 0 auto;
                letter-spacing: 0.2px;
                position: relative;
                line-height: 1.4em;
                font-size: 1.03em;
                padding: 20px;
                padding-bottom: 12px;
                list-style: none;
                text-align: left;

            }

            @media (max-width: 767px) {
                .timeliner {
                    max-width: 98%;
                    padding: 25px;
                }
            }

            .timeliner h1 {
                font-weight: 300;
                font-size: 1.4em;
            }

            .timeliner h2,
            .timeliner h3 {
                font-weight: 600;
                font-size: 1rem;
                margin-bottom: 10px;
            }

            .timeliner .event {
                border-bottom: 1px dashed #e8ebf1;
                position: relative;
            }

            @media (max-width: 767px) {
                .timeliner .event {
                    padding-top: 30px;
                }
            }

            .timeliner .event:last-of-type {
                padding-bottom: 0;
                margin-bottom: 0;
                border: none;
            }

            .timeliner .event:before,
            .timeliner .event:after {
                position: absolute;
                display: block;
                top: 0;
            }

            .timeliner .event:before {
                left: -207px;
                content: attr(data-date);
                text-align: right;
                font-weight: 100;
                font-size: 0.9em;
                min-width: 120px;
            }

            @media (max-width: 767px) {
                .timeliner .event:before {
                    left: 0px;
                    text-align: left;
                }
            }

            .timeliner .event:after {
                -webkit-box-shadow: 0 0 0 3px #fca311;
                box-shadow: 0 0 0 3px #fca311;
                left: -26.6px;
                background: #fff;
                border-radius: 50%;
                height: 9px;
                width: 9px;
                content: "";
                top: 5px;
            }

            @media (max-width: 767px) {
                .timeliner .event:after {
                    left: -31.8px;
                }
            }

            .rtl .timeliner {
                text-align: right;
                border-bottom-right-radius: 0;
                border-top-right-radius: 0;
                border-bottom-left-radius: 4px;
                border-top-left-radius: 4px;
                border-right: 3px solid #727cf5;
            }

            .rtl .timeliner .event::before {
                left: 0;
                right: -170px;
            }

            .rtl .timeliner .event::after {
                left: 0;
                right: -55.8px;
            }


            /* CSS for styling the chart container */
            #line_chart {
                width: 100%;
                height: 400px;
            }
            .boxes{
                border:none;
                border-radius: 10px;
                background-color: #14213d;
                color: white;
            }
            .active{
                background-color: #fca311;
                color: #14213d;
            }
        </style>


        <div class="card">
            <div class="card-body bg-white">

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="d-flex align-items-center gap-2 w-100">

                        <div class="col-md-3 col-lg-3 col-xl-3 d-flex align-items-center"
                            style="border: 1px solid #c7c7c7; border-radius:10px;padding:10px; background-color: white;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#c7c7c7"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                            <input type="text" id="searchInput" class="form-control"
                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                placeholder="Search Employee Name">
                        </div>
                        <div class="col-md-1"
                            style="border: 1px solid #c7c7c7; border-radius:10px;padding:10px; background-color: white;">
                            <select name="" id="" class="form-control"
                                style="width: 100%; border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;">
                                <option value="Day">Day</option>
                                <option value="Night">Night</option>
                            </select>

                        </div>
                        <div class="col-md-2"
                            style="border: 1px solid #c7c7c7; border-radius:10px;padding:10px; background-color: white;">
                            <select name="" id="" class="form-control"
                                style="width: 100%; border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;">
                                <option value="Virtual Assistent">Virtual Assistent</option>
                                <option value="webDev">Web Developer</option>
                                <option value="opManager">Operation Manager</option>
                                <option value="adManager">Admin Manager</option>
                            </select>

                        </div>
                        <div class="col-md-2">
                            <button class="px-3 py-2"
                                style="border:none;border-radius: 10px;background-color: #14213d;color: white">Take
                                Attendence</button>

                        </div>
                    </div>
                        <ul class="d-flex gap-1 align-items-center list-group list-group-flush account-settings-links flex-row">
                                <li style="list-style: none">
                                    <a href="#GridView" class="boxes empMenu active p-2" data-toggle="list">
                                    <svg width="20px" height="20px"viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M14 5.6C14 5.03995 14 4.75992 14.109 4.54601C14.2049 4.35785 14.3578 4.20487 14.546 4.10899C14.7599 4 15.0399 4 15.6 4H18.4C18.9601 4 19.2401 4 19.454 4.10899C19.6422 4.20487 19.7951 4.35785 19.891 4.54601C20 4.75992 20 5.03995 20 5.6V8.4C20 8.96005 20 9.24008 19.891 9.45399C19.7951 9.64215 19.6422 9.79513 19.454 9.89101C19.2401 10 18.9601 10 18.4 10H15.6C15.0399 10 14.7599 10 14.546 9.89101C14.3578 9.79513 14.2049 9.64215 14.109 9.45399C14 9.24008 14 8.96005 14 8.4V5.6Z"stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M4 5.6C4 5.03995 4 4.75992 4.10899 4.54601C4.20487 4.35785 4.35785 4.20487 4.54601 4.10899C4.75992 4 5.03995 4 5.6 4H8.4C8.96005 4 9.24008 4 9.45399 4.10899C9.64215 4.20487 9.79513 4.35785 9.89101 4.54601C10 4.75992 10 5.03995 10 5.6V8.4C10 8.96005 10 9.24008 9.89101 9.45399C9.79513 9.64215 9.64215 9.79513 9.45399 9.89101C9.24008 10 8.96005 10 8.4 10H5.6C5.03995 10 4.75992 10 4.54601 9.89101C4.35785 9.79513 4.20487 9.64215 4.10899 9.45399C4 9.24008 4 8.96005 4 8.4V5.6Z"stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M4 15.6C4 15.0399 4 14.7599 4.10899 14.546C4.20487 14.3578 4.35785 14.2049 4.54601 14.109C4.75992 14 5.03995 14 5.6 14H8.4C8.96005 14 9.24008 14 9.45399 14.109C9.64215 14.2049 9.79513 14.3578 9.89101 14.546C10 14.7599 10 15.0399 10 15.6V18.4C10 18.9601 10 19.2401 9.89101 19.454C9.79513 19.6422 9.64215 19.7951 9.45399 19.891C9.24008 20 8.96005 20 8.4 20H5.6C5.03995 20 4.75992 20 4.54601 19.891C4.35785 19.7951 4.20487 19.6422 4.10899 19.454C4 19.2401 4 18.9601 4 18.4V15.6Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14 15.6C14 15.0399 14 14.7599 14.109 14.546C14.2049 14.3578 14.3578 14.2049 14.546 14.109C14.7599 14 15.0399 14 15.6 14H18.4C18.9601 14 19.2401 14 19.454 14.109C19.6422 14.2049 19.7951 14.3578 19.891 14.546C20 14.7599 20 15.0399 20 15.6V18.4C20 18.9601 20 19.2401 19.891 19.454C19.7951 19.6422 19.6422 19.7951 19.454 19.891C19.2401 20 18.9601 20 18.4 20H15.6C15.0399 20 14.7599 20 14.546 19.891C14.3578 19.7951 14.2049 19.6422 14.109 19.454C14 19.2401 14 18.9601 14 18.4V15.6Z"stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                                    </a>
                                </li>
                                <li style="list-style: none">
                                    <a href="#ListView" class="boxes empMenu p-2" data-toggle="list">
                                        <svg width="20px"height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M8 6.00067L21 6.00139M8 12.0007L21 12.0015M8 18.0007L21 18.0015M3.5 6H3.51M3.5 12H3.51M3.5 18H3.51M4 6C4 6.27614 3.77614 6.5 3.5 6.5C3.22386 6.5 3 6.27614 3 6C3 5.72386 3.22386 5.5 3.5 5.5C3.77614 5.5 4 5.72386 4 6ZM4 12C4 12.2761 3.77614 12.5 3.5 12.5C3.22386 12.5 3 12.2761 3 12C3 11.7239 3.22386 11.5 3.5 11.5C3.77614 11.5 4 11.7239 4 12ZM4 18C4 18.2761 3.77614 18.5 3.5 18.5C3.22386 18.5 3 18.2761 3 18C3 17.7239 3.22386 17.5 3.5 17.5C3.77614 17.5 4 17.7239 4 18Z"stroke="#fff" stroke-width="2" stroke-linecap="round"stroke-linejoin="round"></path></g></svg>
                                    </a>
                                </li>

                        </ul>
                            {{-- <a class="p-2 empMenu active boxes"
                                href="#GridView" data-toggle="list">
                                <svg width="20px" height="20px"viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M14 5.6C14 5.03995 14 4.75992 14.109 4.54601C14.2049 4.35785 14.3578 4.20487 14.546 4.10899C14.7599 4 15.0399 4 15.6 4H18.4C18.9601 4 19.2401 4 19.454 4.10899C19.6422 4.20487 19.7951 4.35785 19.891 4.54601C20 4.75992 20 5.03995 20 5.6V8.4C20 8.96005 20 9.24008 19.891 9.45399C19.7951 9.64215 19.6422 9.79513 19.454 9.89101C19.2401 10 18.9601 10 18.4 10H15.6C15.0399 10 14.7599 10 14.546 9.89101C14.3578 9.79513 14.2049 9.64215 14.109 9.45399C14 9.24008 14 8.96005 14 8.4V5.6Z"stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M4 5.6C4 5.03995 4 4.75992 4.10899 4.54601C4.20487 4.35785 4.35785 4.20487 4.54601 4.10899C4.75992 4 5.03995 4 5.6 4H8.4C8.96005 4 9.24008 4 9.45399 4.10899C9.64215 4.20487 9.79513 4.35785 9.89101 4.54601C10 4.75992 10 5.03995 10 5.6V8.4C10 8.96005 10 9.24008 9.89101 9.45399C9.79513 9.64215 9.64215 9.79513 9.45399 9.89101C9.24008 10 8.96005 10 8.4 10H5.6C5.03995 10 4.75992 10 4.54601 9.89101C4.35785 9.79513 4.20487 9.64215 4.10899 9.45399C4 9.24008 4 8.96005 4 8.4V5.6Z"stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M4 15.6C4 15.0399 4 14.7599 4.10899 14.546C4.20487 14.3578 4.35785 14.2049 4.54601 14.109C4.75992 14 5.03995 14 5.6 14H8.4C8.96005 14 9.24008 14 9.45399 14.109C9.64215 14.2049 9.79513 14.3578 9.89101 14.546C10 14.7599 10 15.0399 10 15.6V18.4C10 18.9601 10 19.2401 9.89101 19.454C9.79513 19.6422 9.64215 19.7951 9.45399 19.891C9.24008 20 8.96005 20 8.4 20H5.6C5.03995 20 4.75992 20 4.54601 19.891C4.35785 19.7951 4.20487 19.6422 4.10899 19.454C4 19.2401 4 18.9601 4 18.4V15.6Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14 15.6C14 15.0399 14 14.7599 14.109 14.546C14.2049 14.3578 14.3578 14.2049 14.546 14.109C14.7599 14 15.0399 14 15.6 14H18.4C18.9601 14 19.2401 14 19.454 14.109C19.6422 14.2049 19.7951 14.3578 19.891 14.546C20 14.7599 20 15.0399 20 15.6V18.4C20 18.9601 20 19.2401 19.891 19.454C19.7951 19.6422 19.6422 19.7951 19.454 19.891C19.2401 20 18.9601 20 18.4 20H15.6C15.0399 20 14.7599 20 14.546 19.891C14.3578 19.7951 14.2049 19.6422 14.109 19.454C14 19.2401 14 18.9601 14 18.4V15.6Z"stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                            </a>
                            <a class="p-2 empMenu boxes"

                                href="#ListView" data-toggle="list" >
                                <svg width="20px"height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M8 6.00067L21 6.00139M8 12.0007L21 12.0015M8 18.0007L21 18.0015M3.5 6H3.51M3.5 12H3.51M3.5 18H3.51M4 6C4 6.27614 3.77614 6.5 3.5 6.5C3.22386 6.5 3 6.27614 3 6C3 5.72386 3.22386 5.5 3.5 5.5C3.77614 5.5 4 5.72386 4 6ZM4 12C4 12.2761 3.77614 12.5 3.5 12.5C3.22386 12.5 3 12.2761 3 12C3 11.7239 3.22386 11.5 3.5 11.5C3.77614 11.5 4 11.7239 4 12ZM4 18C4 18.2761 3.77614 18.5 3.5 18.5C3.22386 18.5 3 18.2761 3 18C3 17.7239 3.22386 17.5 3.5 17.5C3.77614 17.5 4 17.7239 4 18Z"stroke="#fff" stroke-width="2" stroke-linecap="round"stroke-linejoin="round"></path></g></svg>
                            </a> --}}

                </div>
                <div class="tab-content">
                    <div class="container-fluid tab-pane fade active show px-0" style="border-bottom: none; background-color: white"
                        id="GridView">
                        <div class="position-absolute" style="top: 10px; right: 10px; padding:5px 10px;">
                            <span style="color: #14213d; font-family:'poppins'; font-weight: 700;">
                                <svg fill="#14213d" width="17px" height="17px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" stroke="#14213d"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M2,19c0,1.7,1.3,3,3,3h14c1.7,0,3-1.3,3-3v-8H2V19z M19,4h-2V3c0-0.6-0.4-1-1-1s-1,0.4-1,1v1H9V3c0-0.6-0.4-1-1-1S7,2.4,7,3v1H5C3.3,4,2,5.3,2,7v2h20V7C22,5.3,20.7,4,19,4z"></path></g></svg>
                                Today
                                <script>
                                    document.write(new Date().toUTCString().slice(5, 16))
                                </script>
                            </span>
                        </div>
                        <div class="row my-3 flex-wrap gap-3 gap-md-0 gap-lg-0">
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <div class="rounded-4 d-flex flex-column justify-content-center align-items-center p-3" style="border: 1px solid #c7c7c7">
                                    <img src="{{ url('user.png') }}" alt="" style="width:70px; height:70px; object-fit:contain;border-radius: 50%">
                                    <div class="mt-2">
                                        <h2 class="EmpNameStyle mb-1" style="color: #14213d; font-size: 20px">Emp Name</h2>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="rounded-pill bg-success mb-0" style=" color: white; padding:5px 10px; border:1px solid #c7c7c7">P</p>
                                            <p class="rounded-pill bg-white mb-0" style=" color: #14213d; padding:5px 10px; border:1px solid #c7c7c7">A</p>
                                            <p class="rounded-pill bg-white mb-0" style=" color: #14213d; padding:5px 10px; border:1px solid #c7c7c7">L</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <div class="rounded-4 d-flex flex-column justify-content-center align-items-center p-3" style="border: 1px solid #c7c7c7">
                                    <img src="{{ url('user.png') }}" alt="" style="width:70px; height:70px; object-fit:contain;border-radius: 50%">
                                    <div class="mt-2">
                                        <h2 class="EmpNameStyle mb-1" style="color: #14213d; font-size: 20px">Emp Name</h2>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="rounded-pill bg-white mb-0" style=" color: #14213d; padding:5px 10px; border:1px solid #c7c7c7">P</p>
                                            <p class="rounded-pill bg-danger mb-0" style=" color: white; padding:5px 10px; border:1px solid #c7c7c7">A</p>
                                            <p class="rounded-pill bg-white mb-0" style=" color: #14213d; padding:5px 10px; border:1px solid #c7c7c7">L</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <div class="rounded-4 d-flex flex-column justify-content-center align-items-center p-3" style="border: 1px solid #c7c7c7">
                                    <img src="{{ url('user.png') }}" alt="" style="width:70px; height:70px; object-fit:contain;border-radius: 50%">
                                    <div class="mt-2">
                                        <h2 class="EmpNameStyle mb-1" style="color: #14213d; font-size: 20px">Emp Name</h2>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="rounded-pill bg-white mb-0" style=" color: #14213d; padding:5px 10px; border:1px solid #c7c7c7">P</p>
                                            <p class="rounded-pill bg-white mb-0" style=" color: #14213d; padding:5px 10px; border:1px solid #c7c7c7">A</p>
                                            <p class="rounded-pill bg-warning mb-0" style=" color: white; padding:5px 10px; border:1px solid #c7c7c7">L</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                                <div class="rounded-4 d-flex flex-column justify-content-center align-items-center p-3" style="border: 1px solid #c7c7c7">
                                    <img src="{{ url('user.png') }}" alt="" style="width:70px; height:70px; object-fit:contain;border-radius: 50%">
                                    <div class="mt-2">
                                        <h2 class="EmpNameStyle mb-1" style="color: #14213d; font-size: 20px">Emp Name</h2>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p class="rounded-pill bg-success mb-0" style=" color: white; padding:5px 10px; border:1px solid #c7c7c7">P</p>
                                            <p class="rounded-pill bg-white mb-0" style=" color: #14213d; padding:5px 10px; border:1px solid #c7c7c7">A</p>
                                            <p class="rounded-pill bg-white mb-0" style=" color: #14213d; padding:5px 10px; border:1px solid #c7c7c7">L</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="container-fluid tab-pane fade show px-0" style="border-bottom: none; background-color: white" id="ListView">
                        <div class="position-absolute d-flex gap-1" style="top: 10px; right: 10px; padding:5px 10px;">
                            <div>
                                <form action="/filter_emp_date" method="post">
                                    @csrf
                                    <input type="month" class="form-control p-0" style="border: none; color: #14213d; font-family:'poppins'; font-weight: 700;" id="start" name="date_controller"
                                        min="2018-03" value="{{ $currentyear }}-{{ $currentMonth }}" />
                            </div>
                            <div  >
                                <button style="border: none;background-color:transparent;"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#14213d"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg></button>
                            </div>
                            </form>
                        </div>

                <div class="row" style="margin-top:30px;">
                    <div class="col-lg-12">
                        <div class="table-responsive simplebar-scrollable-y simplebar-scrollable-x" data-simplebar="init" style="max-height: 450px;">
                            <table class="table custom-table table-nowrap mb-0">
                                <thead>
                                    <tr style="background-color: #14213d20">
                                        <td class="p-3 font-size-16 EmpStyle" style="color: #14213d;font-weight: 600" colspan="1">Emp Code</td>
                                        <td class="p-3 font-size-16 EmpStyle" style="color: #14213d;font-weight: 600">Employee</td>
                                        @php
                                            for ($count = 1; $count <= $numberOfDaysInMonth; $count++) {
                                                echo '<td class="p-3 font-size-16 EmpStyle" style="color: #14213d;font-weight: 600">' . $count . '</td>';
                                            }
                                        @endphp
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($emp as $employee)
                                        <tr style="border-bottom: 1px solid #c7c7c7">
                                            <td class="EmpStyle font-size-12" style="text-align: center; padding:15px;color: #14213d;font-weight: 600">
                                                201sols
                                            </td>

                                            <td>
                                                <a class="EmpStyle font-size-12" style="color: #14213d;font-weight: 600"
                                                    href="/view-attendence-emp/{{ $employee->Emp_Code }}">

                                                    {{ $employee->Emp_Full_Name }}
                                                </a>
                                            </td>


                                            <!-- Display attendance status for each day -->
                                            @foreach ($daysOfMonth as $day)
                                                <td style="text-align: center;">
                                                    @php
                                                        $day = Carbon\Carbon::parse($day)->format('Y-m-d');
                                                        $formattedDate = Carbon\Carbon::parse($day)->format('m/d/Y');
                                                        $today = Carbon\Carbon::today()->format('Y-m-d');
                                                        $attendence_id = null;

                                                        $attendanceRecord = DB::table('attendence')
                                                            ->where('emp_id', $employee->Emp_Code)
                                                            ->whereDate('date', $day)
                                                            ->first();
                                                        $attendence_id = null;
                                                        if ($attendanceRecord) {
                                                            $attendence_id = $attendanceRecord->id;
                                                        }

                                                        $leaveRecord = DB::table('leaves')
                                                            ->where('emp_code', $employee->Emp_Code)
                                                            ->whereDate('date', $day)
                                                            ->first();

                                                        // Get the day name
                                                        $dayName = Carbon\Carbon::parse($day)->format('l');
                                                        $year_date_name = Carbon\Carbon::parse($day)->format('jS M Y');
                                                        // echo "<br> ".$dayName;
                                                    @endphp

                                                    @if (isset($datesForMonth) && $datesForMonth != null)
                                                        @php
                                                            $isHoliday = false;
                                                            foreach ($datesForMonth as $date) {
                                                                if ($date == $formattedDate) {
                                                                    $isHoliday = true;
                                                                    break;
                                                                }
                                                            }
                                                        @endphp
                                                        @if ($isHoliday)
                                                            <span title="holiday">H</span>
                                                        @elseif ($day > $today)
                                                            @php
                                                                $formattedDate = Carbon\Carbon::parse($day)->format(
                                                                    'm/d/Y',
                                                                );
                                                            @endphp
                                                        @elseif ($attendanceRecord && $attendanceRecord->check_in_status == 'done')
                                                            <!-- Display check mark or any indication of attendance -->
                                                            <a href="#exampleModal_{{ $attendence_id }}" class="text-white rounded-pill mx-2" style="padding:5px;background-color: #06a503"
                                                                data-toggle="modal">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15px"
                                                                    height="10px" viewBox="0 0 24 24">
                                                                    <path fill="#fff"
                                                                        d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z" />
                                                                </svg>
                                                            </a>
                                                        @elseif ($dayName == 'Saturday' || $dayName == 'Sunday')
                                                        <div class="vertical-text " style="margin-left: 10px;">
                                                            <span class="text-white rounded-pill" style="padding: 5px 8px;background-color: #0D6EFD">W</span>
                                                        </div>
                                                        @elseif ($leaveRecord && $leaveRecord->status == 'approved')
                                                            <!-- Display Leave indication -->
                                                            <span style="font-size:12px;">L</span>
                                                        @else
                                                            <!-- Display absence indication -->
                                                            <div class="text-white rounded-pill mx-2" style="padding:5px;background-color: #f9010e">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15px"
                                                                    height="15px" viewBox="0 0 24 24">
                                                                    <path fill="#fff"
                                                                        d="M18.36 19.78L12 13.41l-6.36 6.37l-1.42-1.42L10.59 12L4.22 5.64l1.42-1.42L12 10.59l6.36-6.36l1.41 1.41L13.41 12l6.36 6.36z" />
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    @else
                                                        @if ($day > $today)
                                                            @php
                                                                $formattedDate = Carbon\Carbon::parse($day)->format(
                                                                    'm/d/Y',
                                                                );
                                                            @endphp
                                                        @elseif ($attendanceRecord && $attendanceRecord->check_in_status == 'done')
                                                            <!-- Display check mark or any indication of attendance -->
                                                            <a href="#exampleModal_{{ $attendence_id }}" class="text-white rounded-pill mx-2" style="padding:5px;background-color: #06a503"
                                                                data-toggle="modal">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15px"
                                                                    height="15px" viewBox="0 0 24 24">
                                                                    <path fill="#fff"
                                                                        d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z" />
                                                                </svg>
                                                            </a>
                                                        @elseif ($dayName == 'Saturday' || $dayName == 'Sunday')
                                                            <div class="vertical-text " style="margin-left: 10px;">
                                                                <span class="text-white rounded-pill" style="padding: 5px 8px;background-color: #0D6EFD">W</span>
                                                            </div>
                                                        @elseif ($leaveRecord && $leaveRecord->status == 'approved')
                                                            <!-- Display Leave indication -->
                                                            <div style="margin-left: 10px;">
                                                                <span class="text-white rounded-pill bg-danger" style="padding: 5px 8px;">L</span>
                                                            </div>
                                                        @else
                                                            <!-- Display absence indication -->
                                                            <div class="text-white rounded-pill mx-2" style="padding:5px;background-color: #f9010e">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15px"
                                                                    height="15px" viewBox="0 0 24 24">
                                                                    <path fill="#fff"
                                                                        d="M18.36 19.78L12 13.41l-6.36 6.37l-1.42-1.42L10.59 12L4.22 5.64l1.42-1.42L12 10.59l6.36-6.36l1.41 1.41L13.41 12l6.36 6.36z" />
                                                                </svg>
                                                            </div>
                                                        @endif
                                                    @endif






                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal_{{ $attendence_id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Attendance Info
                                                                    </h5>
                                                                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span> --}}
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    @if ($employee->Emp_Image != null && file_exists(public_path($employee->Emp_Image)))
                                                                        {{-- <img style="width:50px;height:50px;border-radius:50%;" src="{{ asset($employee->Emp_Image) }}" alt=""> --}}
                                                                        <img class="modal-image"
                                                                            src="{{ asset($employee->Emp_Image) }}"
                                                                            alt="User Image">
                                                                    @else
                                                                        {{-- <img style="width:50px;height:50px;border-radius:50%;" src="{{ url('user.png') }}" alt=""> --}}
                                                                        <img class="modal-image"
                                                                            src="{{ url('user.png') }}"
                                                                            alt="{{ $employee->Emp_Full_Name }}">
                                                                    @endif
                                                                    <p
                                                                        style="margin-top: 12px;font-size:13px;font-weight:500;margin-bottom:25px;">
                                                                        {{ $employee->Emp_Full_Name }}
                                                                    </p>
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-6">
                                                                            <div class="card punch-status">
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title">Timesheet <small
                                                                                            class="text-muted">{{ $year_date_name }}
                                                                                            ({{ $dayName }})
                                                                                        </small>
                                                                                    </h5>
                                                                                    <div class="punch-det">
                                                                                        <h6>Check In at</h6>
                                                                                        <p>{{ isset($attendanceRecord->check_in_time) ? $attendanceRecord->check_in_time : 'No Check In' }}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="punch-info">
                                                                                        <div class="punch-hours">
                                                                                            @if (isset($attendanceRecord->total_time))
                                                                                                <span>{{ $attendanceRecord->total_time }}
                                                                                                    hrs</span>
                                                                                            @else
                                                                                                <span>0 Hours</span>
                                                                                            @endif


                                                                                        </div>
                                                                                    </div>
                                                                                    <br>
                                                                                    <div class="punch-det">
                                                                                        <h6>Check Out at</h6>
                                                                                        <p>{{ isset($attendanceRecord->check_out_time) ? $attendanceRecord->check_out_time : 'No Check Out' }}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="statistics">
                                                                                        <div class="row">
                                                                                            <div
                                                                                                class="col-md-6 col-6 text-center">
                                                                                                <div class="stats-box">
                                                                                                    @if (isset($attendanceRecord->break_start) &&
                                                                                                            $attendanceRecord->break_start != '' &&
                                                                                                            isset($attendanceRecord->break_end) &&
                                                                                                            $attendanceRecord->break_end != '')
                                                                                                        <?php
                                                                                                        // Assuming $attendanceRecord->break_start and $attendanceRecord->break_end are in a valid format

                                                                                                        // Parse break start and end times
                                                                                                        $breakStart = \Carbon\Carbon::createFromFormat('h:i A', $attendanceRecord->break_start);
                                                                                                        $breakEnd = \Carbon\Carbon::createFromFormat('h:i A', $attendanceRecord->break_end);

                                                                                                        // Calculate break duration
                                                                                                        $breakDuration = $breakEnd->diff($breakStart);

                                                                                                        // Format break duration
                                                                                                        // Format break duration
                                                                                                        $hours = $breakDuration->h;
                                                                                                        $minutes = $breakDuration->i;
                                                                                                        $breakDurationFormatted = sprintf('%d hrs %02d min', $hours, $minutes);
                                                                                                        ?>
                                                                                                    @else
                                                                                                        @php
                                                                                                            $breakDurationFormatted =
                                                                                                                '0 hrs 0 min';
                                                                                                        @endphp
                                                                                                    @endif
                                                                                                    <p>Break</p>
                                                                                                    <h6> {{ $breakDurationFormatted }}
                                                                                                    </h6>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="col-md-6 col-6 text-center">
                                                                                                @php
                                                                                                    if (
                                                                                                        $attendanceRecord &&
                                                                                                        $attendanceRecord->overtime_start !=
                                                                                                            null &&
                                                                                                        $attendanceRecord->overtime_end !=
                                                                                                            null
                                                                                                    ) {
                                                                                                        $overtime_start = \Carbon\Carbon::createFromFormat(
                                                                                                            'h:i A',
                                                                                                            $attendanceRecord->overtime_start,
                                                                                                        );
                                                                                                        $overtime_end = \Carbon\Carbon::createFromFormat(
                                                                                                            'h:i A',
                                                                                                            $attendanceRecord->overtime_end,
                                                                                                        );
                                                                                                        // caculate overtime
                                                                                                        $overTimeDuration = $overtime_end->diff(
                                                                                                            $overtime_start,
                                                                                                        );
                                                                                                        // Format break duration
                                                                                                        $overhours =
                                                                                                            $overTimeDuration->h;
                                                                                                        $overminutes =
                                                                                                            $overTimeDuration->i;
                                                                                                        $overDurationFormatted = sprintf(
                                                                                                            '%d hrs %02d min',
                                                                                                            $overhours,
                                                                                                            $overminutes,
                                                                                                        );
                                                                                                    } else {
                                                                                                        $overDurationFormatted =
                                                                                                            '0 hrs 0 min';
                                                                                                    }

                                                                                                @endphp
                                                                                                <div class="stats-box">
                                                                                                    <p>Overtime</p>
                                                                                                    <h6>{{ $overDurationFormatted }}
                                                                                                    </h6>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <h6 class="card-title"> Activity</h6>
                                                                                    <div id="content">
                                                                                        <ul class="timeliner">
                                                                                            <li class="event mb-1">
                                                                                                <h3 class="fs-4 font-size-18 mb-0"
                                                                                                    style="color: #14213d">
                                                                                                    Check In</h3>
                                                                                                <p>{{ isset($attendanceRecord->check_in_time) && $attendanceRecord->check_in_time != '' ? $attendanceRecord->check_in_time : 'No Check In' }}
                                                                                                </p>
                                                                                            </li>
                                                                                            <li class="event mb-1">
                                                                                                <h3 class="fs-4 font-size-18 mb-0"
                                                                                                    style="color: #14213d">
                                                                                                    Break Start Time</h3>
                                                                                                <p>{{ isset($attendanceRecord->break_start) && $attendanceRecord->break_start != '' ? $attendanceRecord->break_start : 'No Break' }}
                                                                                                </p>
                                                                                            </li>
                                                                                            <li class="event mb-1">
                                                                                                <h3 class="fs-4 font-size-18 mb-0"
                                                                                                    style="color: #14213d">
                                                                                                    Break End Time</h3>
                                                                                                <p>{{ isset($attendanceRecord->break_end) && $attendanceRecord->break_end != '' ? $attendanceRecord->break_end : 'No Break ' }}
                                                                                                </p>
                                                                                            </li>
                                                                                            <li class="event mb-1">
                                                                                                <h3 class="fs-4 font-size-18 mb-0"
                                                                                                    style="color: #14213d">
                                                                                                    Check Out</h3>
                                                                                                <p>{{ isset($attendanceRecord->check_out_time) && $attendanceRecord->check_out_time != '' ? $attendanceRecord->check_out_time : 'No Check Out' }}
                                                                                                </p>

                                                                                            <li class="event mb-1">
                                                                                                <h3 class="fs-4 font-size-18 mb-0"
                                                                                                    style="color: #14213d">
                                                                                                    Over Time Start</h3>
                                                                                                <p>{{ isset($attendanceRecord->overtime_start) && $attendanceRecord->overtime_start != '' ? $attendanceRecord->overtime_start : 'No Over Time' }}
                                                                                                </p>
                                                                                            </li>
                                                                                            <li class="event mb-1">
                                                                                                <h3 class="fs-4 font-size-18 mb-0"
                                                                                                    style="color: #14213d">
                                                                                                    Over Time End</h3>
                                                                                                <p>{{ isset($attendanceRecord->overtime_end) && $attendanceRecord->overtime_end != '' ? $attendanceRecord->overtime_end : 'No Over Time' }}
                                                                                                </p>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>





                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <!-- You can add additional buttons here -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>



                        </div>



                        </td>
                        @endforeach

                        </tr>
                        @endforeach

                        </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4 col-xl-4 col-lg-4">
                        <div class="card" style="box-shadow: none;">
                            <div class="card-body" style="border:1px solid #c7c7c7">
                                <h2 class="EmpNameStyle" style="color: #fca311; font-size: 20px">Highest Attendence</h2>
                                <table class="table table-nowrap table-responsive">
                                        <tr style="background-color: #14213d20;">
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Emp Code</td>
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Emp Name</td>
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Total Days</td>
                                        </tr>
                                        <tr style="border-bottom: 1px solid #c7c7c7">
                                            <td style="padding:10px; font-weight:600;color:#14213d">201sols</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">Ahsan</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">21</td>
                                        </tr>
                                        <tr style="border-bottom: 1px solid #c7c7c7">
                                            <td style="padding:10px; font-weight:600;color:#14213d">201sols</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">Ahsan</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">21</td>
                                        </tr>
                                        <tr style="border-bottom: 1px solid #c7c7c7">
                                            <td style="padding:10px; font-weight:600;color:#14213d">201sols</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">Ahsan</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">21</td>
                                        </tr>

                                </table>

                            </div>

                        </div>

                    </div>
                    <div class="col-md-4 col-xl-4 col-lg-4">
                        <div class="card" style="box-shadow: none;">
                            <div class="card-body" style="border:1px solid #c7c7c7">
                                <h2 class="EmpNameStyle" style="color: #fca311; font-size: 20px">Lowest Attendence</h2>
                                <table class="table table-nowrap table-responsive">
                                        <tr style="background-color: #14213d20;">
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Emp Code</td>
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Emp Name</td>
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Total Days</td>
                                        </tr>
                                        <tr style="border-bottom: 1px solid #c7c7c7">
                                            <td style="padding:10px; font-weight:600;color:#14213d">201sols</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">Ahsan</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">21</td>
                                        </tr>
                                        <tr style="border-bottom: 1px solid #c7c7c7">
                                            <td style="padding:10px; font-weight:600;color:#14213d">201sols</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">Ahsan</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">21</td>
                                        </tr>
                                        <tr style="border-bottom: 1px solid #c7c7c7">
                                            <td style="padding:10px; font-weight:600;color:#14213d">201sols</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">Ahsan</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">21</td>
                                        </tr>

                                </table>

                            </div>

                        </div>

                    </div>
                    <div class="col-md-4 col-xl-4 col-lg-4">
                        <div class="card" style="box-shadow: none;">
                            <div class="card-body" style="border:1px solid #c7c7c7">
                                <h2 class="EmpNameStyle" style="color: #fca311; font-size: 20px">Upcoming leaves</h2>
                                <table class="table table-nowrap table-responsive">
                                        <tr style="background-color: #14213d20;">
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Emp Code</td>
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Emp Name</td>
                                            <td class="EmpStyle" style="padding: 10px;font-weight:600;color:#14213d">Total Days</td>
                                        </tr>
                                        <tr style="border-bottom: 1px solid #c7c7c7">
                                            <td style="padding:10px; font-weight:600;color:#14213d">201sols</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">Ahsan</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">21</td>
                                        </tr>
                                        <tr style="border-bottom: 1px solid #c7c7c7">
                                            <td style="padding:10px; font-weight:600;color:#14213d">201sols</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">Ahsan</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">21</td>
                                        </tr>
                                        <tr style="border-bottom: 1px solid #c7c7c7">
                                            <td style="padding:10px; font-weight:600;color:#14213d">201sols</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">Ahsan</td>
                                            <td style="padding:10px; font-weight:600;color:#14213d">21</td>
                                        </tr>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>
                    </div>
                </div>



{{--
                <p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="0.6rem" height="0.6rem" viewBox="0 0 24 24">
                        <path fill="#06a503" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z" />
                    </svg> = Present,
                    <svg xmlns="http://www.w3.org/2000/svg" width="0.6rem" height="0.75rem" viewBox="0 0 24 24">
                        <path fill="#f9010e"
                            d="M18.36 19.78L12 13.41l-6.36 6.37l-1.42-1.42L10.59 12L4.22 5.64l1.42-1.42L12 10.59l6.36-6.36l1.41 1.41L13.41 12l6.36 6.36z" />
                    </svg> = Absent, H = Holiday, L = Leaves

                </p>
                <p>
                    Holidays = {{ $numberOfHolidays != null ? $numberOfHolidays : '0' }},
                    Total Working Days = {{ $total_days != null ? $total_days : '0' }},
                    Actual Days Worked = {{ $total_days - $numberOfHolidays }}
                </p> --}}


            </div>
        </div>
        </div>




        <!-- end col -->
        </div>
        <!-- end row -->


        <script>
            // Function to filter table rows based on search input
            function filterTable() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("searchInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("tableBody");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[0]; // Assuming the first column contains employee names
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }
                    }
                }
            }

            // Attach event listener to search input
            document.getElementById("searchInput").addEventListener("keyup", filterTable);
        </script>
        <script>
            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }
        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>


        <!-- Details Section -->
        <div id="details-section" style="display: none;">
            <!-- Details section will be shown here -->
            <!-- You can use JavaScript to populate this section dynamically -->
        </div>

        </div>
        </div>
        </div> <!-- end col -->
        </div> <!-- end row -->
    @endsection

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
