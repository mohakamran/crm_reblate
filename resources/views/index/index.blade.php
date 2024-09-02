@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet">
@endsection
@section('page-title')
    CRM - Dashboard
@endsection
@section('body')

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




    .time-list .dash-stats-list {
        flex-flow: column wrap;
        flex-grow: 1;
        padding: 0 15px;
    }

    .time-list .dash-stats-list h4 {
        color: #1f1f1f;
        font-size: 21px;
        font-weight: 700;
        line-height: 1.5;
        margin-bottom: 0;
    }

    .time-list .dash-stats-list p {
        color: #777;
        font-size: 13px;
        font-weight: 600;
        line-height: 1.5;
        margin-bottom: 0;
        text-transform: uppercase;
    }

    ul li {
        list-style: none;
    }

    .timesheet-right {
        color: #8E8E8E;
        font-size: 13px;
        float: right;
        margin-top: 7px;

    }


    .punch-info .punch-hours {
        border: 3px solid #fca311;

        max-width: 250px;

        padding: 20px;
        margin: 0 auto;
        border-radius: 12px;
        position: relative;
        text-align: center;
    }



    .punch-hours span {
        font-weight: 500;
        transform: translate(-50%, -50%);
        font-size: 30px;
        color: #14213d;
    }

    .view-class-more {

        font-size: 16px;
        text-align: center;
        display: block;
        /* margin: 0px; */
        margin-top: 17px;

    }

    .timeliner {

        margin: 0 auto;
        letter-spacing: 0.2px;
        position: relative;
        padding-top: 20px;
        margin-left: 10px;
        padding-bottom: 0;

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
        left: -23.6px;
        background: #fff;
        border-radius: 50%;
        height: 6px;
        width: 6px;
        content: "";
        top: 10px;
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

    }

    .char-count {
        font-size: 0.8em;
        color: #666;
        text-align: right;
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

    .modal-fullscreen {
        width: 100vw;
        max-width: 100%;
        margin: 0;
    }

    .modal-dialog-scrollable {
        display: flex;
        max-height: calc(100vh - 60px);
        /* Adjust as needed based on your modal content */
        margin-top: 30px;
        /* Adjust top margin as needed */
    }

    .embed-responsive {
        position: relative;
        display: block;
        width: 100%;
        padding-top: 100%;
        /* This keeps the aspect ratio (height:width) */
        overflow: hidden;
    }

    .embed-responsive iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: none;
    }

    .closeBtn {
        position: absolute;
        top: 25px;
        right: 15px;
        cursor: pointer;
    }

    .active {
        color: #14213d;
        border-bottom: 1px solid #fca311;
    }

    .notification-hover:hover {
        background: #fca31130;
        transition: all 0.2s ease-in-out;
    }

    .to-do-form input,
    textarea {
        width: 100%;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .to-do-form textarea {
        height: 37px;
        resize: none;
    }


    button {
        padding: 5px 10px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #218838;
    }

    .container {
        width: 400px;
        padding: 20px;
        background-color: #f0f0f0;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
    }

    form {
        display: flex;
        margin-bottom: 10px;
    }

    input[type="text"] {
        flex: 1;
        padding: 8px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px 0 0 4px;
    }

    button {
        padding: 8px 16px;
        font-size: 16px;
        border: none;
        background-color: #4caf50;
        color: white;
        border-radius: 0 4px 4px 0;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .card {
        margin-bottom: 10px;
        padding: 10px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
    }

    .card.completed {
        text-decoration: line-through;
        opacity: 0.7;
    }
</style>

    <body data-sidebar="colored">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection
    @section('content')
        <style>
            .btn-apply {
                border: 0px;
                background: rgb(2 2 2 / 80%);
                color: white;
                padding: 5px 10px;
                font-size: 10px;
                text-transform: uppercase;
                letter-spacing: 1.2px;
                border-radius: 50px;
                margin: 10px;
            }
        </style>

        <div class="row" style="display: flex; flex-wrap: wrap;">
            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative; backdrop-filter: blur(5px);">
                        {{-- <div class="ag-courses-item_bg"></div> --}}
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:30px; color:white;"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M256 256a112 112 0 1 0-112-112a112 112 0 0 0 112 112m0 32c-69.42 0-208 42.88-208 128v64h416v-64c0-85.12-138.58-128-208-128" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden justify-content-between d-flex align-items-center gap-5">
                                    <p class="text-black font-size-18 mb-0 fw-bold">Employees</p>
                                    <h5 class="mb-0 text-black">{{ $emp_count }}
                                    </h5>
                                </div>
                                <p class=" mb-0 text-truncate text-black" style="color: lightgray" ><span
                                        class="badge bg-subtle-primary text-black font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 2.8% Increase</span> vs last month</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative; backdrop-filter: blur(5px);">
                        {{-- <div class="ag-courses-item_bg"></div> --}}
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path fill="#fff"
                                            d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <div
                                    class="flex-grow-1 overflow-hidden d-flex justify-content-between align-items-center gap-5 ">
                                    <p class="text-black font-size-18 mb-0 fw-bold"> Clients</p>
                                    <h5 class="mb-0 text-black">{{ $client_count }}
                                    </h5>
                                </div>

                                <p class="mb-0 text-truncate " style="color:black"><span
                                        class="badge bg-subtle-primary text-black font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-bottom-left"></i> 7.8% Loss</span> vs last month</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative; backdrop-filter: blur(5px);">
                        {{-- <div class="ag-courses-item_bg"></div> --}}
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:30px; color:#fff"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M4 21q-.825 0-1.412-.587T2 19V8q0-.825.588-1.412T4 6h4V4q0-.825.588-1.412T10 2h4q.825 0 1.413.588T16 4v2h4q.825 0 1.413.588T22 8v11q0 .825-.587 1.413T20 21zm6-15h4V4h-4z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden d-flex justify-content-between align-items-center gap-5">
                                    <p class="text-black text-truncate font-size-18 mb-0 fw-bold">Projects</p>
                                    <h5 class="mb-0 text-black">15 </h5>
                                </div>
                                <p class="mb-0 text-truncate" style="color: black"><span
                                        class="badge bg-subtle-primary text-black font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 4.6% Growth</span> vs last month</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative; backdrop-filter: blur(5px);">

                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#fff"
                                        class="bi bi-calendar-range" viewBox="0 0 16 16">
                                        <path d="M9 7a1 1 0 0 1 1-1h5v2h-5a1 1 0 0 1-1-1M1 9h4a1 1 0 0 1 0 2H1z" />
                                        <path
                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <div
                                    class="flex-grow-1 overflow-hidden d-flex align-items-center justify-content-between gap-5">
                                    <input type="text" id="date_range_picker" name="date_range_picker"
                                        style="width:135px;padding: 5px; background-color:transparent; border:none; color:black" />

                                </div>

                            </div>
                            <button id="submit_dates" class="btn-apply">Apply</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="row" style="display: flex; flex-wrap: wrap;">
            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative; backdrop-filter: blur(5px);">
                        {{-- <div class="ag-courses-item_bg"></div> --}}
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="#fff"
                                            d="M320 96H192L144.6 24.9C137.5 14.2 145.1 0 157.9 0H354.1c12.8 0 20.4 14.2 13.3 24.9L320 96zM192 128H320c3.8 2.5 8.1 5.3 13 8.4C389.7 172.7 512 250.9 512 416c0 53-43 96-96 96H96c-53 0-96-43-96-96C0 250.9 122.3 172.7 179 136.4l0 0 0 0c4.8-3.1 9.2-5.9 13-8.4zm84 88c0-11-9-20-20-20s-20 9-20 20v14c-7.6 1.7-15.2 4.4-22.2 8.5c-13.9 8.3-25.9 22.8-25.8 43.9c.1 20.3 12 33.1 24.7 40.7c11 6.6 24.7 10.8 35.6 14l1.7 .5c12.6 3.8 21.8 6.8 28 10.7c5.1 3.2 5.8 5.4 5.9 8.2c.1 5-1.8 8-5.9 10.5c-5 3.1-12.9 5-21.4 4.7c-11.1-.4-21.5-3.9-35.1-8.5c-2.3-.8-4.7-1.6-7.2-2.4c-10.5-3.5-21.8 2.2-25.3 12.6s2.2 21.8 12.6 25.3c1.9 .6 4 1.3 6.1 2.1l0 0 0 0c8.3 2.9 17.9 6.2 28.2 8.4V424c0 11 9 20 20 20s20-9 20-20V410.2c8-1.7 16-4.5 23.2-9c14.3-8.9 25.1-24.1 24.8-45c-.3-20.3-11.7-33.4-24.6-41.6c-11.5-7.2-25.9-11.6-37.1-15l0 0-.7-.2c-12.8-3.9-21.9-6.7-28.3-10.5c-5.2-3.1-5.3-4.9-5.3-6.7c0-3.7 1.4-6.5 6.2-9.3c5.4-3.2 13.6-5.1 21.5-5c9.6 .1 20.2 2.2 31.2 5.2c10.7 2.8 21.6-3.5 24.5-14.2s-3.5-21.6-14.2-24.5c-6.5-1.7-13.7-3.4-21.1-4.7V216z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden justify-content-between d-flex align-items-center gap-5">
                                    <p class="text-black font-size-18 mb-0 fw-bold">Revenue</p>
                                    <h5 class="mb-0 text-black">${{ $total_revenue }}
                                    </h5>
                                </div>
                                <p class="mb-0 text-truncate" style="color: black"><span
                                        class="badge bg-subtle-primary text-black font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 2.8% Increase</span> vs last month</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative; backdrop-filter: blur(5px);">
                        {{-- <div class="ag-courses-item_bg"></div> --}}
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="#fff"
                                            d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H80c-8.8 0-16-7.2-16-16s7.2-16 16-16H448c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zM416 272a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <div
                                    class="flex-grow-1 overflow-hidden d-flex justify-content-between align-items-center gap-5 ">
                                    <p class="text-black font-size-18 mb-0 fw-bold"> Salaries</p>
                                    <h5 class="mb-0 text-black">${{ $usd_pkr_salary }}
                                    </h5>
                                </div>

                                <p class="mb-0 text-truncate" style="color: black"><span
                                        class="badge bg-subtle-primary text-black font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-bottom-left"></i> 7.8% Loss</span> vs last month</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative; backdrop-filter: blur(5px);">
                        {{-- <div class="ag-courses-item_bg"></div> --}}
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#fff" d="M268.383 22.168l-55.918 84.482 29.717 3.733c-9.22 30.13-11.095 50.878-8.885 92.12 14.138-2.23 25.56-3.025 40.586 1.39-9.877-36.84-8.844-49.427-4.88-89.768l32.622 2.277-33.242-94.234zm218.482 2.21l-108.36 30.03 20.915 25.975c-49.512 31.019-80.331 55.548-104.74 123.164 13.201-.152 28.098 2.921 44.174 9.004 5.728-44.666 33.74-76.14 79.302-108.918l19.983 24.816 48.726-104.07zm-463.574 2.31L89.17 129.173l19.084-28.711c35.554 32.44 58.145 76.33 57.308 107.43 18.568-8.696 29.927-9.527 49.735-3.778-8.105-31.203-43.577-108.722-91.639-129.103l16.57-26.037L23.292 26.687zm276.117 214.667c-5.28.12-10.21 2.415-16.937 9.594l-6.565 6.969-6.812-6.72c-7.387-7.28-13.216-9.29-19.125-9.03-5.908.26-12.855 3.367-20.625 9.656l-6.217 5.03-5.906-5.374c-8.9-8.052-16.485-10.439-23.75-10.064-5.288.274-10.775 2.266-16.25 5.75l40.966 73.69c15.454 9.451 47.034 13.006 68.75 2.062l39.594-73.344c-7.51-3.062-14.26-6.202-20.094-7.406-2.112-.437-4.07-.756-5.968-.813-.354-.01-.71-.008-1.06 0zm-89.97 96.188v.002c-18.035 12.742-32.516 34.717-38.125 66.904-5.435 31.196 3.129 52.266 18.283 66.625 15.155 14.36 37.902 21.736 61 21.436 23.1-.3 46.136-8.31 61.625-22.936 15.49-14.627 24.249-35.425 19.281-65.187-5.137-30.757-18.4-52.148-35.19-65.094-28.482 15.056-64.095 11.856-86.875-1.75z"></path></g></svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden d-flex justify-content-between align-items-center gap-5">
                                    <p class="text-black text-truncate font-size-18 mb-0 fw-bold">Expenses</p>
                                    <h5 class="mb-0 text-black">${{ $usd_pkr_expenses }} </h5>
                                </div>
                                <p class="mb-0 text-truncate" style="color: black"><span
                                        class="badge bg-subtle-primary text-black font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 4.6% Growth</span> vs last month</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative; backdrop-filter: blur(5px);">
                        {{-- <div class="ag-courses-item_bg"></div> --}}
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                   <svg height="200px" width="200px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#fff" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g transform="translate(1 1)"> <path style="fill:#fffffffff200096E6;" d="M502.467,489.722H7.533c-5.12,0-8.533-3.413-8.533-8.533c0-5.12,3.413-8.533,8.533-8.533h494.933 c5.12,0,8.533,3.413,8.533,8.533C511,486.308,507.587,489.722,502.467,489.722z"></path> <polygon style="fill:#fffffffff20FFFFFF;" points="24.6,361.722 109.933,361.722 109.933,481.188 24.6,481.188 "></polygon> <path style="fill:#fffffffff200096E6;" d="M118.467,489.722h-102.4V353.188h102.4V489.722z M33.133,472.655H101.4v-102.4H33.133V472.655z"></path> <polygon style="fill:#fffffffff20FFFFFF;" points="152.6,284.922 237.933,284.922 237.933,481.188 152.6,481.188 "></polygon> <path style="fill:#fffffffff200096E6;" d="M246.467,489.722h-102.4V276.388h102.4V489.722z M161.133,472.655H229.4v-179.2h-68.267V472.655z"></path> <polygon style="fill:#fffffffff20FFFFFF;" points="280.6,216.655 365.933,216.655 365.933,481.188 280.6,481.188 "></polygon> <path style="fill:#fffffffff200096E6;" d="M374.467,489.722h-102.4v-281.6h102.4V489.722z M289.133,472.655H357.4V225.188h-68.267V472.655z"></path> <polygon style="fill:#fffffffff20;" points="408.6,148.388 493.933,148.388 493.933,481.188 408.6,481.188 "></polygon> <g> <path style="fill:#fffffffff200096E6;" d="M502.467,489.722h-102.4V139.855h102.4V489.722z M417.133,472.655H485.4V156.922h-68.267V472.655z"></path> <path style="fill:#fffffffff200096E6;" d="M67.267,236.282c-2.56,0-5.973-1.707-7.68-4.267c-2.56-4.267-0.853-9.387,3.413-11.947 L372.76,41.722l-46.933-4.267c-4.267-0.853-8.533-4.267-7.68-9.387c0.853-4.267,4.267-8.533,9.387-7.68l72.533,6.827 c0.853,0,0.853,0,1.707,0s1.707,0.853,2.56,0.853l0.853,0.853c0.853,0.853,0.853,0.853,1.707,1.707 c0,0.853,0.853,1.707,0.853,2.56s0,0.853,0,1.707c0,0.853,0,1.707,0,2.56s0,0.853-0.853,1.707l-30.72,66.56 c-1.707,4.267-6.827,5.973-11.093,4.267c-4.267-1.707-5.973-6.827-4.267-11.093l19.627-42.667l-308.907,179.2 C70.68,236.282,68.973,236.282,67.267,236.282z"></path> </g> </g> </g></svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <div
                                    class="flex-grow-1 overflow-hidden d-flex align-items-center justify-content-between gap-5">
                                    <p class="text-black text-truncate font-size-18 mb-0 fw-bold">Profit</p>
                                    <h5 class="mb-0 text-black"> ${{ $total_profit }}
                                    </h5>
                                </div>
                                <p class="mb-0 text-truncate" style="color: black"><span
                                        class="badge bg-subtle-primary text-black font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 4.6% Growth</span> vs last month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

         @if ($emp_birthday)
        <link rel="stylesheet" href="{{url('assets/css/b_whishes.css')}}">
        <script>
            // Function to create confetti
            function createConfetti(id) {
                var conf = "#confetti_"+id;
                console.log(conf);
                const confettiContainer = document.querySelector(conf);
                for (let i = 0; i < 100; i++) {
                    const confettiPiece = document.createElement('div');
                    confettiPiece.classList.add('confetti-piece');
                    confettiPiece.style.width = `${Math.random() * 10 + 5}px`;
                    confettiPiece.style.height = confettiPiece.style.width;
                    confettiPiece.style.backgroundColor = `hsl(${Math.random() * 360}, 70%, 60%)`;
                    confettiPiece.style.top = `${Math.random() * 100}vh`;
                    confettiPiece.style.left = `${Math.random() * 100}vw`;
                    confettiPiece.style.opacity = Math.random();
                    confettiPiece.style.transform = `rotate(${Math.random() * 360}deg)`;
                    confettiContainer.appendChild(confettiPiece);
                }

                const style = document.createElement('style');
                style.textContent = `
                .confetti-piece {
                    animation: confetti-fall 5s linear infinite;
                }
            `;
                document.head.appendChild(style);
            }


        </script>
            @foreach ($emp_birthday as $emp)
                <section class="birthday-section">
                    <div class="confetti" id="confetti_{{$emp->id}}"></div>
                    <div class="title-container">
                        <div class="typing-container">
                            <h1 class="typing-text">Happy Birthday!</h1>
                        </div>
                        <p>Wishing you a day filled with love, joy, and cake!</p>
                    </div>
                    <div class="content-wrapper">
                        <div class="left-section">
                            @if ($emp->Emp_Image && file_exists($emp->Emp_Image))
                            <img src="{{$emp->Emp_Image}}" alt="Employee" class="employee-img">
                            @else
                            <img src="{{url('user.png')}}" alt="Employee" class="employee-img">
                            @endif

                            <div class="employee-name">{{$emp->Emp_Full_Name}}</div>
                        </div>
                        <div style="color: #d32f2f;font-size:22px;">{{ \Carbon\Carbon::parse($emp->emp_birthday)->format('d F Y') }}</div>
                        <div class="right-section">
                            <div class="cake-icon"></div>
                        </div>
                    </div>
                    <script>
                        // Initialize animations
                        createConfetti({{$emp->id}});
                    </script>
                </section>
            @endforeach



        @endif

        <div class="row">

            {{-- <div class="col-xl-7">
                <div class="card">
                    <div class="card-body pt-2">
                        <div class="card-header border-0 align-items-center d-flex" >
                            <h4 class="card-title mb-0 flex-grow-1">Overall Performance </h4>
                        </div>
                          <div id="chart_div" style="width: 100%; height: 250px; position: relative; left:-15px;"></div>
                        <canvas id="myChartPerformance"
                            style="width:100%;width: 730px;
                        display: block;
                        height: 365px;
                        padding: 25px; color:#fff;"></canvas>

                    </div>
                </div>
            </div> --}}

                <div class="col-xl-7">
                    <div class="card" style="box-shadow: none">
                        <div class="card-body"
                            style="background-color: #fff; backdrop-filter: none; border:1px solid #c7c7c7; height: 450px; overflow-y: auto;">
                            <h3 class="EmpNameStyle mb-1" style="color: #14213d; font-weight: 800">Notfications</h3>
                            <div class="mt-3">
                                <ul
                                    class="d-flex gap-4 align-items-center list-group list-group-flush account-settings-links flex-row">
                                    <li style="list-style: none"><a href="#all"
                                            style="font-size:15px;font-family:'Poppins'; font-weight:500; color:#14213d"
                                            data-toggle="list" class="empMenu active">All</a> </li>
                                    <li style="list-style: none"><a href="#tasks"
                                            style="font-size:15px;font-family:'Poppins'; font-weight:500; color:#14213d"
                                            data-toggle="list" class="empMenu">Tasks</a> </li>
                                    <li style="list-style: none"><a href="#to-do"
                                            style="font-size:15px;font-family:'Poppins'; font-weight:500; color:#14213d"
                                            data-toggle="list" class="empMenu">To Do</a> </li>
                                </ul>
                            </div>
                            <div class="tab-content">

                                {{-- all notifications  --}}
                                <div class="container-fluid tab-pane fade active show px-0"
                                    style="border-bottom: none; min-height:350px" id="all">
                                    {{-- notifications  --}}

                                    @if ($notifications != null && $notifications->isNotEmpty())
                                        @foreach ($notifications as $notify)
                                            <div class="notification-hover mt-2 p-2"
                                                style="border-bottom: 1px solid lightgray"
                                                id="notifications_{{ $notify->id }}">
                                                <div class="d-flex">
                                                    <a href="{{ $notify->link }}">
                                                        <div class="avatar-sm me-3">

                                                                <img class="img-fluid rounded-circle"
                                                                    style="border-radius:100%; object-fit:cover;width:2.6rem;height:2.6rem;"
                                                                    src="{{ url('user.png') }}">

                                                        </div>
                                                        <div class="flex-1">
                                                            <h4 class="mb-1 EmpNameStyle"
                                                                style="color: #14213d;font-weight: 500; font-size:20px">
                                                                {{ $notify->title }}</h4>
                                                            <div class="font-size-14 text-muted d-flex gap-2">
                                                                <p class="mb-0 font-size-14"><i class="mdi mdi-clock-outline"></i>
                                                                    {{ date('d F Y', strtotime($notify->date)) }}
                                                                    {{ $notify->time }}</p>

                                                            </div>
                                                            <p class="mb-1 text-muted  font-size-14">{{ $notify->message }}</p>
                                                            <a href="javascript:void()"
                                                                onclick="markAsRead({{ $notify->id }},'all')">mark as
                                                                read</a>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="position-absolute" style="top: 50%; left: 30%;">
                                            <h4 class="mb-1 EmpNameStyle" style="color: #c7c7c7; font-size:35px">
                                                No Notifications</h4>
                                        </div>
                                    @endif



                                </div>

                                <div class="container-fluid tab-pane fade show px-0"
                                    style="border-bottom: none;min-height:350px" id="tasks">
                                    {{-- tasks notifications  --}}

                                    @if ($tasks_notifications != null && $tasks_notifications->isNotEmpty())
                                        @foreach ($tasks_notifications as $notify)
                                            <div class="notification-hover mt-2 p-2"
                                                style="border-bottom: 1px solid lightgray"
                                                id="notifications_tasks_{{ $notify->id }}">
                                                <div class="d-flex">
                                                    <a href="{{ $notify->link }}">
                                                        <div class="avatar-sm me-3">

                                                                <img class="img-fluid rounded-circle"
                                                                    style="border-radius:100%; object-fit:cover;width:2.6rem;height:2.6rem;"
                                                                    src="{{ url('user.png') }}">

                                                        </div>
                                                        <div class="flex-1">
                                                            <h4 class="mb-1 EmpNameStyle"
                                                                style="color: #14213d;font-weight: 500; font-size:20px">
                                                                {{ $notify->title }}</h4>
                                                            <div class="font-size-14 text-muted  d-flex gap-2">
                                                                <p class="mb-0"><i class="mdi mdi-clock-outline"></i>
                                                                    {{ date('d F Y', strtotime($notify->date)) }}
                                                                    {{ $notify->time }}</p>

                                                            </div>
                                                            <p class="mb-1 text-muted font-size-14">{{ $notify->message }}</p>
                                                            <a href="javascript:void()"
                                                                onclick="markAsRead({{ $notify->id }},'tasks')">mark as
                                                                read</a>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="position-absolute" style="top: 50%; left: 25%;">
                                            <h4 class="mb-1 EmpNameStyle" style="color: #c7c7c7; font-size:35px">
                                                No Tasks Notifications</h4>
                                        </div>
                                    @endif


                                </div>

                                <div class="tab-pane fade px-0 show" style="border-bottom: none; min-height:350px"
                                    id="to-do">
                                    <div class="mt-3">
                                        <div>
                                            <h1>To-Do List</h1>
                                            <form id="todo-form">
                                                <input type="text" id="task-title" placeholder="Enter task title"
                                                    required>
                                                <input type="hidden" id="user_code"
                                                    value="{{ auth()->user()->user_code }}">
                                                <input type="hidden" id="user_name"
                                                    value="{{ auth()->user()->user_name }}">
                                                <button type="submit">Add Task</button>
                                            </form>
                                            <div id="task-list">
                                                @if ($latest_to_do != null)
                                                    @foreach ($latest_to_do as $item)
                                                        <div class="card" data-id="{{ $item->id }}">
                                                            <h3>{{ $item->task_title }}</h3>
                                                            <p>Date: {{ $item->date }}</p>
                                                            <p>Time: {{ $item->time }}</p>
                                                            <input type="hidden" class="task-id"
                                                                value="{{ $item->id }}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                       document.addEventListener('DOMContentLoaded', function() {
                                                const taskList = document.getElementById('task-list');

                                                // Handle click on task cards to update status
                                                taskList.addEventListener('click', function(event) {
                                                    const task = event.target.closest('.card');
                                                    if (task) {
                                                        const taskId = task.getAttribute('data-id');
                                                        const isCompleted = task.classList.contains('completed');
                                                        const newStatus = isCompleted ? 'pending' : 'completed';

                                                        // Log the current task ID and new status
                                                        console.log('Updating Task ID:', taskId, 'New Status:', newStatus);

                                                        // Send a request to update the task status
                                                        fetch('/update-task-status', {
                                                            method: 'POST',
                                                            headers: {
                                                                'Content-Type': 'application/json',
                                                                'Accept': 'application/json',
                                                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                                            },
                                                            body: JSON.stringify({
                                                                id: taskId,
                                                                status: newStatus
                                                            })
                                                        })
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            console.log('Response Data:', data);
                                                            if (data.success) {
                                                                // Toggle completed class and update styling
                                                                task.classList.toggle('completed');
                                                                updateTaskStyle(task, !isCompleted); // Update style based on new status
                                                            } else {
                                                                console.error('Failed to update status:', data);
                                                            }
                                                        })
                                                        .catch(error => console.error('Error:', error));
                                                    }
                                                });

                                                // Handle task submission
                                                const form = document.getElementById('todo-form');
                                                form.addEventListener('submit', function(event) {
                                                    event.preventDefault();

                                                    const taskTitleInput = document.getElementById('task-title');
                                                    const taskTitle = taskTitleInput.value.trim();
                                                    const userNameInput = document.getElementById('user_name');
                                                    const user_name = userNameInput.value.trim();
                                                    const userCodeInput = document.getElementById('user_code');
                                                    const user_code = userCodeInput.value.trim();

                                                    if (taskTitle) {
                                                        fetch('/save-to-do-task', {
                                                            method: 'POST',
                                                            headers: {
                                                                'Content-Type': 'application/json',
                                                                'Accept': 'application/json',
                                                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                                            },
                                                            body: JSON.stringify({
                                                                title: taskTitle,
                                                                userName: user_name,
                                                                userCode: user_code,
                                                                date: getCurrentDate(),
                                                                time: getCurrentTime()
                                                            })
                                                        })
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            console.log('Response Data:', data);
                                                            if (data.id) {
                                                                const task = document.createElement('div');
                                                                task.className = 'card';
                                                                task.setAttribute('data-id', data.id);
                                                                task.innerHTML = `
                                                                    <h3>${taskTitle}</h3>
                                                                    <p class="task-date">Date: ${getCurrentDate()}</p>
                                                                    <p class="task-time">Time: ${getCurrentTime()}</p>
                                                                    <input type="hidden" class="task-id" value="${data.id}">
                                                                `;

                                                                // Append new task to the task list
                                                                taskList.insertBefore(task, taskList.firstChild);
                                                                taskTitleInput.value = ''; // Reset the input field
                                                            }
                                                        })
                                                        .catch(error => console.error('Error:', error));
                                                    } else {
                                                        alert('Please enter a task title.');
                                                    }
                                                });

                                                // Function to get the current date
                                                function getCurrentDate() {
                                                    const now = new Date();
                                                    const options = {
                                                        weekday: 'long',
                                                        year: 'numeric',
                                                        month: 'long',
                                                        day: 'numeric'
                                                    };
                                                    return now.toLocaleDateString('en-US', options);
                                                }

                                                // Function to get the current time
                                                function getCurrentTime() {
                                                    const now = new Date();
                                                    return now.toLocaleTimeString('en-US');
                                                }

                                                // Function to update task style based on status
                                                function updateTaskStyle(task, isCompleted) {
                                                    const title = task.querySelector('h3');
                                                    const date = task.querySelector('.task-date');
                                                    const time = task.querySelector('.task-time');

                                                    if (isCompleted) {
                                                        title.style.textDecoration = 'line-through';
                                                        date.style.textDecoration = 'line-through';
                                                        time.style.textDecoration = 'line-through';
                                                        title.style.color = '#aaa'; // Optional: Change color for completed tasks
                                                        date.style.color = '#aaa';
                                                        time.style.color = '#aaa';
                                                    } else {
                                                        title.style.textDecoration = 'none';
                                                        date.style.textDecoration = 'none';
                                                        time.style.textDecoration = 'none';
                                                        title.style.color = 'black'; // Reset color for pending tasks
                                                        date.style.color = 'black';
                                                        time.style.color = 'black';
                                                    }
                                                }
                                            });

                                    </script>




                                    {{-- <div class="position-absolute" style="top: 50%; left: 25%;">
                                            <h4 class="mb-1 EmpNameStyle" style="color: #c7c7c7; font-size:35px">
                                                No Tasks </h4>
                                        </div> --}}



                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                            <script>
                    function markAsRead(id, str) {
                        if (str === "all") {
                            var not = "notifications_" + id;
                        }

                        if (str === "tasks") {
                            var not = "notifications_tasks_" + id;
                        }

                        var dc = document.getElementById(not).style.display = "none";

                        // Get CSRF token from somewhere (meta tag or inline assignment)
                        var csrfToken = "{{ csrf_token() }}"; // Ensure this is correctly populated

                        // Make an AJAX request to mark notification as read
                        fetch('/mark-as-read', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                body: JSON.stringify({
                                    id: id
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Notification marked as read:', data);
                                // Handle success
                            })
                            .catch(error => {
                                console.error('Error marking notification as read:', error);
                                // Handle error
                            });
                    }
                </script>

            <div class="col-xl-5">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="card-header border-0 pb-1 align-items-center d-flex" >
                            <h4 class="card-title mb-0 flex-grow-1">Overall Attendence</h4>
                        </div>
                        {{-- <div id="donutchart" style="width: 400px; height: 260px;"></div> --}}
                        <canvas id="attendenceRecord" width="400" height="372"></canvas>
                        <div class="social-content text-center">
                            <p class="text-uppercase mb-1 text-light">Total Employees</p>
                            <h3 class="mb-0" style="color:#fca311">15</h3>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- END ROW -->

        <div class="row">


            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: transparent;">
                        <h4 class="card-title mb-0 flex-grow-1">Top Clients</h4>

                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive simplebar-scrollable-y simplebar-scrollable-x" data-simplebar="init"
                            style="max-height: 230px;">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content" style="height: auto; overflow: scroll;">
                                            <div class="simplebar-content" style="padding: 0px;">
                                                <table
                                                    class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                    <tbody>
                                                        <th>Client Name</th>
                                                        <th>Project Name</th>
                                                        @foreach ($total_clients as $client)
                                                        @endforeach
                                                        <tr>

                                                            <td>
                                                                <h6 class="font-size-15 mb-1">{{ $client->client_name }}
                                                                </h6>
                                                                <p class="text-muted mb-0 font-size-14">
                                                                    {{ $client->client_email }}</p>
                                                            </td>
                                                            <td>
                                                                {{-- <span class="badge badge-soft-danger font-size-12">Cancel</span>  --}}
                                                                {{ $client->project_name }}
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 440px; height: 469px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="width: 395px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 273px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>
                        <div class="text-center pt-3">
                            <a href="/view-clients" class=" w-md">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title text-black mb-0 flex-grow-1">Total Statistics</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="row mt-3">
                            <div class="col-md-6 col-6 text-center">
                                <div class="stats-box mb-4" style="border: 1px solid #e3e3e3; border-radius:5px;">
                                    <p>Total Tasks</p>
                                    <h3> @if ($tasks_count['total_tasks'] == null)
                                        0
                                    @else
                                    {{ $tasks_count['total_tasks'] }}</h3>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-6 text-center">
                                <div class="stats-box mb-4" style="border: 1px solid #e3e3e3; border-radius:5px;">
                                    <p>Incomplete Tasks</p>
                                    <h3> @if ($tasks_count['incomplete_tasks'] == null)
                                        0
                                        @else
                                        {{ $tasks_count['incomplete_tasks'] }}</h3>

                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="progress mb-4" style="height: 30px;">
                            @if ($tasks_count['complete_tasks'] == null)
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-purple "
                                    style="width:0%;" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100">
                                    0%
                                </div>
                            @else
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-purple "
                                    style="width:{{ number_format(($tasks_count['complete_tasks'] / $tasks_count['total_tasks']) * 100) }}%;"
                                    role="progressbar"
                                    aria-valuenow="{{ number_format(($tasks_count['complete_tasks'] / $tasks_count['total_tasks']) * 100) }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    {{ number_format(($tasks_count['complete_tasks'] / $tasks_count['total_tasks']) * 100) }}%
                                </div>
                            @endif

                            @if ($tasks_count['complete_tasks'] == null)
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-purple "
                                    style="width:0%;" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100">
                                    0%
                                </div>
                            @else
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning "
                                    style="width:{{ number_format(($tasks_count['incomplete_tasks'] / $tasks_count['total_tasks']) * 100) }}%;"
                                    role="progressbar"
                                    aria-valuenow="{{ number_format(($tasks_count['incomplete_tasks'] / $tasks_count['total_tasks']) * 100) }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    {{ number_format(($tasks_count['incomplete_tasks'] / $tasks_count['total_tasks']) * 100) }}%
                                </div>
                            @endif

                            @if ($tasks_count['complete_tasks'] == null)
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-purple "
                                    style="width:0%;" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100">
                                    0%
                                </div>
                            @else
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info "
                                    style="width:{{ number_format(($tasks_count['in_progress_tasks'] / $tasks_count['total_tasks']) * 100) }}%;"
                                    role="progressbar"
                                    aria-valuenow="{{ number_format(($tasks_count['in_progress_tasks'] / $tasks_count['total_tasks']) * 100) }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    {{ number_format(($tasks_count['in_progress_tasks'] / $tasks_count['total_tasks']) * 100) }}%
                                </div>
                            @endif


                            {{-- <div class="progress-bar progress-bar-striped progress-bar-animated bg-success w-50" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">24%</div>
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger w-25" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">21%</div> --}}

                        </div>
                        <div>
                            <p><svg class="text-purple me-2" xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-record-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                </svg>Completed Tasks <span class="float-end">{{ $tasks_count['complete_tasks'] }}</span>
                            </p>
                            <p><svg class="text-warning me-2" xmlns="http://www.w3.org/2000/svg" width="16"
                                    height="16" fill="currentColor" class="bi bi-record-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                </svg></i>Inprogress Tasks <span
                                    class="float-end">{{ $tasks_count['in_progress_tasks'] }}</span></p>
                            {{-- <p><svg class="text-success me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-record-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                  </svg>On Hold Tasks <span class="float-end">31</span></p>
                                <p><svg class="text-danger me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-record-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                  </svg>Pending Tasks <span class="float-end">47</span></p> --}}
                            <p class="mb-0"><svg class="text-primary me-2" xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-record-circle"
                                    viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                </svg>Incomplete Tasks <span
                                    class="float-end">{{ $tasks_count['incomplete_tasks'] }}</span></p>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title text-dark mb-0 flex-grow-1">Tasks</h4>

                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive simplebar-scrollable-y simplebar-scrollable-x" data-simplebar="init"
                            style="max-height: 220px;">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content" style="height: auto; overflow: scroll;">
                                            <div class="simplebar-content" style="padding: 0px;">
                                                <table
                                                    class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                    <tbody>
                                                        <tr style="border-bottom: 1px solid #e3e3e3;">
                                                            <th>EMP ID</th>
                                                            <th>Employee Name</th>
                                                            <th>Tasks</th>
                                                            <th>Shift</th>
                                                            <th>See Details</th>
                                                        </tr>
                                                        @foreach($currentTasks as $task)
                                                        <tr>
                                                            <td style="width: 20px;">#{{ $task['id'] }}</td>
                                                            <td>
                                                                <img src="{{ $task['image'] }}" class="avatar-xs rounded-circle me-2" alt="Employee Image">
                                                                {{ $task['name'] }}
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">{{ $task['task_title'] }}</h6>
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-{{ $task['shift_time'] == 'Morning' ? 'soft-primary' : 'soft-success' }} font-size-12">{{ $task['shift_time'] }}</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">See more</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 440px; height: 469px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="width: 395px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 273px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>
                        <div class="text-center pt-3">
                            <a href="/view-tasks" class=" w-md">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>

                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title text-black mb-0 flex-grow-1">Task Report</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive simplebar-scrollable-y simplebar-scrollable-x" data-simplebar="init"
                            style="max-height: 220px;">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content" style="height: auto; overflow: scroll;">
                                            <div class="simplebar-content" style="padding: 0px;">
                                                <table
                                                    class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                    <tbody>
                                                        <tr style="border-bottom: 1px solid #e3e3e3;">

                                                            <th>EMP ID</th>
                                                            <th>Employee Name</th>
                                                            <th>Tasks</th>
                                                            <th>Shift</th>
                                                            <th>See Details</th>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task1</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task2</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task3</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task4</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task5</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task6</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>





                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 440px; height: 469px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="width: 395px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 273px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>
                        <div class="text-center pt-3">
                            <a href="/view-clients" class=" w-md">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>
        </div>

        {{-- END ROW  --}}

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title text-black mb-0 flex-grow-1">Projects</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive simplebar-scrollable-y simplebar-scrollable-x" data-simplebar="init"
                            style="max-height: 220px;">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content" style="height: auto; overflow: scroll;">
                                            <div class="simplebar-content" style="padding: 0px;">
                                                <table
                                                    class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                    <tbody>
                                                        <tr style="border-bottom: 1px solid #e3e3e3;">

                                                            <th>EMP ID</th>
                                                            <th>Employee Name</th>
                                                            <th>Tasks</th>
                                                            <th>Shift</th>
                                                            <th>See Details</th>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task1</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task2</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task3</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task4</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task5</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task6</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>





                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 440px; height: 469px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="width: 395px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 273px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>
                        <div class="text-center pt-3">
                            <a href="/view-clients" class=" w-md">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title text-black mb-0 flex-grow-1">Project Report</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive simplebar-scrollable-y simplebar-scrollable-x" data-simplebar="init"
                            style="max-height: 220px;">
                            <div class="simplebar-wrapper" style="margin: 0px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                            aria-label="scrollable content" style="height: auto; overflow: scroll;">
                                            <div class="simplebar-content" style="padding: 0px;">
                                                <table
                                                    class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                                    <tbody>
                                                        <tr style="border-bottom: 1px solid #e3e3e3;">

                                                            <th>EMP ID</th>
                                                            <th>Employee Name</th>
                                                            <th>Tasks</th>
                                                            <th>Shift</th>
                                                            <th>See Details</th>
                                                        </tr>
                                                    </tbody>
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task1</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task2</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task3</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task4</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task5</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-primary font-size-12">Day</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 20px;">#MB2540</td>
                                                            <td>
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                                    class="avatar-xs rounded-circle me-2" alt="...">
                                                                Neal Matthews
                                                            </td>
                                                            <td>
                                                                <h6 class="text-muted mb-0 font-size-14">Task6</h6>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Night</span>
                                                            </td>
                                                            <td>
                                                                <a href="#">see more</a>
                                                            </td>
                                                        </tr>





                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 440px; height: 469px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="width: 395px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar"
                                    style="height: 273px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>
                        <div class="text-center pt-3">
                            <a href="/view-clients" class=" w-md">View All</a>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-xl-7">
                <div class="row">

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex pb-0">
                                <h4 class="card-title mb-0 flex-grow-1">Source of Purchases</h4>
                                <div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="fw-semibold">Sort By:</span>
                                            <span class="text-muted">Yearly<i
                                                    class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Yearly</a>
                                            <a class="dropdown-item" href="#">Monthly</a>
                                            <a class="dropdown-item" href="#">Weekly</a>
                                            <a class="dropdown-item" href="#">Today</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div id="social-source" class="apex-charts"></div>
                                <div class="social-content text-center">
                                    <p class="text-uppercase mb-1">Total Sales</p>
                                    <h3 class="mb-0">5,685</h3>
                                </div>
                                <p class="text-muted text-center w-75 mx-auto mt-4 mb-0">Magnis dis parturient montes
                                    nascetur ridiculus tincidunt lobortis.</p>
                                <div class="row gx-4 mt-1">
                                    <div class="col-md-4">
                                        <div class="mt-4">
                                            <div class="progress" style="height: 7px;">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 85%" aria-valuenow="85" aria-valuemin="0"
                                                    aria-valuemax="85">
                                                </div>
                                            </div>
                                            <p class="text-muted mt-2 pt-2 mb-0 text-uppercase font-size-13 text-truncate">
                                                E-Commerce
                                            </p>
                                            <h4 class="mt-1 mb-0 font-size-20">52,524</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mt-4">
                                            <div class="progress" style="height: 7px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                                    aria-valuemax="70">
                                                </div>
                                            </div>
                                            <p class="text-muted mt-2 pt-2 mb-0 text-uppercase font-size-13 text-truncate">
                                                Facebook
                                            </p>
                                            <h4 class="mt-1 mb-0 font-size-20">48,625</h4>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mt-4">
                                            <div class="progress" style="height: 7px;">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                    style="width: 60%" aria-valuenow="60" aria-valuemin="0"
                                                    aria-valuemax="60">
                                                </div>
                                            </div>
                                            <p class="text-muted mt-2 pt-2 mb-0 text-uppercase font-size-13 text-truncate">
                                                Instagram
                                            </p>
                                            <h4 class="mt-1 mb-0 font-size-20">85,745</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex pb-0">
                                <h4 class="card-title mb-0 flex-grow-1">Sales Statistics</h4>
                                <div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            Today<i class="mdi mdi-chevron-down ms-1"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Yearly</a>
                                            <a class="dropdown-item" href="#">Monthly</a>
                                            <a class="dropdown-item" href="#">Weekly</a>
                                            <a class="dropdown-item" href="#">Today</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="mb-0 mt-2">725,800</h4>
                                <p class="mb-0 mt-2 text-muted">
                                    <span class="badge badge-soft-success mb-0">
                                        <i class="ri-arrow-up-line align-middle"></i>
                                        15.72 % </span> vs. previous month
                                </p>

                                <div class="mt-3 pt-1">
                                    <div class="progress progress-lg rounded-pill px-0">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 48%"
                                            aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 26%"
                                            aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="table-responsive mt-3">
                                    <table class="table align-middle table-centered table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order Status</th>
                                                <th scope="col">Orders</th>
                                                <th scope="col">Returns</th>
                                                <th scope="col">Earnings</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0);" class="text-dark">Product Pending</a>
                                                </td>
                                                <td>17,351</td>
                                                <td>2,123</td>
                                                <td><span class="badge bg-subtle-primary text-primary font-size-11 ms-1"><i
                                                            class="mdi mdi-arrow-up"></i> 45.3%</span></td>
                                            </tr><!-- end -->

                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0);" class="text-dark">Product Cancelled</a>
                                                </td>
                                                <td>67,356</td>
                                                <td>3,652</td>
                                                <td><span class="badge bg-subtle-danger text-danger font-size-11 ms-1"><i
                                                            class="mdi mdi-arrow-down"></i> 14.6%</span></td>
                                            </tr><!-- end -->


                                            <tr>
                                                <td>
                                                    <a href="javascript:void(0);" class="text-dark">Product Delivered</a>
                                                </td>
                                                <td>67,356</td>
                                                <td>3,652</td>
                                                <td><span class="badge bg-subtle-primary text-primary font-size-11 ms-1"><i
                                                            class="mdi mdi-arrow-up"></i> 14.6%</span></td>
                                            </tr><!-- end -->
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>

                                <div class="text-center mt-4"><a href="javascript: void(0);"
                                        class="btn btn-primary waves-effect waves-light btn-sm">View More <i
                                            class="mdi mdi-arrow-right ms-1"></i></a></div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-xl-5">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex pb-0">
                        <h4 class="card-title mb-0 flex-grow-1">Top Users</h4>
                        <div>
                            <div class="dropdown">
                                <a class="dropdown-toggle text-reset" href="#" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="fw-semibold">Sort By:</span>
                                    <span class="text-muted">Yearly<i class="mdi mdi-chevron-down ms-1"></i></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Yearly</a>
                                    <a class="dropdown-item" href="#">Monthly</a>
                                    <a class="dropdown-item" href="#">Weekly</a>
                                    <a class="dropdown-item" href="#">Today</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive" data-simplebar style="max-height: 358px;">
                            <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                <tbody>
                                    <tr>
                                        <td style="width: 20px;"><img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}"
                                                class="avatar-sm rounded-circle " alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Glenn Holden</h6>
                                            <p class="text-muted mb-0 font-size-14">glennholden@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$250.00
                                        </td>
                                        <td><span class="badge badge-soft-danger font-size-12">Cancel</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" class="avatar-sm rounded-circle "
                                                alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Lolita Hamill</h6>
                                            <p class="text-muted mb-0 font-size-14">lolitahamill@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-down text-danger font-size-18 align-middle me-1"></i>$110.00
                                        </td>
                                        <td><span class="badge badge-soft-success font-size-12">Success</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" class="avatar-sm rounded-circle "
                                                alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Robert Mercer</h6>
                                            <p class="text-muted mb-0 font-size-14">robertmercer@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$420.00
                                        </td>
                                        <td><span class="badge badge-soft-info font-size-12">Active</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" class="avatar-sm rounded-circle "
                                                alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Marie Kim</h6>
                                            <p class="text-muted mb-0 font-size-14">mariekim@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-down text-danger font-size-18 align-middle me-1"></i>$120.00
                                        </td>
                                        <td><span class="badge badge-soft-warning font-size-12">Pending</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" class="avatar-sm rounded-circle "
                                                alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Sonya Henshaw</h6>
                                            <p class="text-muted mb-0 font-size-14">sonyahenshaw@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$112.00
                                        </td>
                                        <td><span class="badge badge-soft-info font-size-12">Active</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" class="avatar-sm rounded-circle "
                                                alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Marie Kim</h6>
                                            <p class="text-muted mb-0 font-size-14">marikim@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-down text-danger font-size-18 align-middle me-1"></i>$120.00
                                        </td>
                                        <td><span class="badge badge-soft-success font-size-12">Success</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" class="avatar-sm rounded-circle "
                                                alt="..."></td>
                                        <td>
                                            <h6 class="font-size-15 mb-1">Sonya Henshaw</h6>
                                            <p class="text-muted mb-0 font-size-14">sonyahenshaw@tocly.com</p>
                                        </td>
                                        <td class="text-muted"><i
                                                class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$112.00
                                        </td>
                                        <td><span class="badge badge-soft-danger font-size-12">Cancel</span></td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-20" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Another action</a>
                                                    <a class="dropdown-item" href="#">Something else here</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="#">Separated link</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- enbd table-responsive-->
                    </div>
                </div>
            </div>

        </div> --}}


        <!-- END ROW -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script>
            // Data returned by the controller function
            var chartData = {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    label: 'Sales',
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0, 0, 0, 0)', // Remove background color
                    data: {!! json_encode($chartData['sales']) !!}
                }, {
                    label: 'Expenses',
                    borderColor: 'red',
                    backgroundColor: 'rgba(0, 0, 0, 0)', // Remove background color
                    data: {!! json_encode($chartData['expenses']) !!}
                }, {
                    label: 'Profit',
                    borderColor: 'green',
                    backgroundColor: 'rgba(0, 0, 0, 0)', // Remove background color
                    data: {!! json_encode($chartData['profits']) !!}
                }]
            };

            // Configuration options
            var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            // Create the chart
            var ctx = document.getElementById('myChartPerformance').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: options
            });
        </script>



        <script>
            // Check if jQuery is properly loaded
            if (typeof jQuery === 'undefined') {
                console.error('jQuery is not loaded.');
            } else {
                // jQuery is loaded, initialize the datepicker
                $(document).ready(function() {
                    $('#datepicker').datepicker({
                        format: 'yyyy-mm-dd', // Format the date as you desire
                        todayBtn: 'linked',
                        clearBtn: true,
                        autoclose: true,
                        todayHighlight: true
                    });
                });
            }
        </script>


        <script>
            // Sample data for absent, present, and leaves
            var data = {
                labels: ['Absent', 'Present', 'Leaves'],
                datasets: [{
                    data: [<?php echo $emp_absent_count; ?>, <?php echo $emp_present_count; ?>, <?php echo $emp_leave_count; ?>],
                    backgroundColor: ['#dc3545', '#28a745', '#ffc107']
                }]
            };

            // Configuration options
            var options = {
                cutoutPercentage: 70,
                responsive: false, // Set to true for responsiveness
                legend: {
                    display: true,
                    position: 'right'
                }
            };

            // Create the chart
            var ctx = document.getElementById('attendenceRecord').getContext('2d');
            var myDonutChart = new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: options
            });
        </script>

        {{-- end of expense chart --}}
        <script type="text/javascript">
            $(document).ready(function() {
                $('#date_range_picker').daterangepicker({
                    opens: 'right',
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                });
            });

            $('#submit_dates').on('click', function() {
                var dateRange = $('#date_range_picker').val();

                $.ajax({
                    url: '/filtered-data',
                    type: 'get',
                    data: {
                        date_range: dateRange
                    },
                    success: function(response) {
                        // Redirect to the route with the date parameter
                        window.location.href = '/search-filtered-data/date_range=' + dateRange;
                    },
                    error: function(xhr, status, error) {
                        // Handle error if needed
                        window.location.href = '/unauthorized';
                    }
                });
            });

            google.charts.load("current", {
                packages: ["corechart"]
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Persent', <?php echo $emp_present_count; ?>],
                    ['Absent', <?php echo $emp_absent_count; ?>],
                    ['Leave', <?php echo $emp_leave_count; ?>],

                ]);

                var options = {
                    pieHole: 0.4,

                };

                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
            }

            // Dummy data for expenses by month
            var months = ["January", "February", "March", "April", "May"];
            var expensesData = [500, 800, 1200, 600, 900];

            // Options for the column chart
            var columnChartOptions = {
                chart: {
                    type: 'bar'
                },
                series: [{
                    name: 'Expenses',
                    data: expensesData
                }],
                xaxis: {
                    categories: months
                }
            };

            // Render the column chart
            var columnChart = new ApexCharts(document.querySelector("#expenses-months"), columnChartOptions);
            columnChart.render();
        </script>
    @endsection
    @section('scripts')
        <!-- apexcharts -->
        {{-- <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
         --}}

        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <!-- Vector map-->
        <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/dashboard.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
    @endsection
