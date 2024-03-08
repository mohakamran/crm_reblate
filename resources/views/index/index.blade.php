@extends('layouts.master')
@section('title')
    Dashboard
@endsection
@section('css')
    <!-- jsvectormap css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    CRM - Dashboard
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row" style="display: flex; flex-wrap: wrap;">
            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:30px; color:#14213d"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M256 256a112 112 0 1 0-112-112a112 112 0 0 0 112 112m0 32c-69.42 0-208 42.88-208 128v64h416v-64c0-85.12-138.58-128-208-128" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden justify-content-between d-flex align-items-center gap-5">
                                    <p class="text-truncate font-size-18 mb-0 fw-bold">Employees</p>
                                    <h5 class="mb-0">{{ $emp_count }}
                                    </h5>
                                </div>
                                <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 2.8% Increase</span> vs last month</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path fill="#14213d"
                                            d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <div
                                    class="flex-grow-1 overflow-hidden d-flex justify-content-between align-items-center gap-5 ">
                                    <p class="text-truncate font-size-18 mb-0 fw-bold"> Clients</p>
                                    <h5 class="mb-0">{{ $client_count }}
                                    </h5>
                                </div>

                                <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-danger text-danger font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-bottom-left"></i> 7.8% Loss</span> vs last month</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:30px; color:#14213d"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M4 21q-.825 0-1.412-.587T2 19V8q0-.825.588-1.412T4 6h4V4q0-.825.588-1.412T10 2h4q.825 0 1.413.588T16 4v2h4q.825 0 1.413.588T22 8v11q0 .825-.587 1.413T20 21zm6-15h4V4h-4z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden d-flex justify-content-between align-items-center gap-5">
                                    <p class="text-dark text-truncate font-size-18 mb-0 fw-bold">Projects</p>
                                    <h5 class="mb-0">15 </h5>
                                </div>
                                <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 4.6% Growth</span> vs last month</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#14213d"
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
                                    <input type="text" name="datetimes"
                                        style="padding: 5px; background-color:transparent; border:none;" />

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row" style="display: flex; flex-wrap: wrap;">
            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="#14213d"
                                            d="M320 96H192L144.6 24.9C137.5 14.2 145.1 0 157.9 0H354.1c12.8 0 20.4 14.2 13.3 24.9L320 96zM192 128H320c3.8 2.5 8.1 5.3 13 8.4C389.7 172.7 512 250.9 512 416c0 53-43 96-96 96H96c-53 0-96-43-96-96C0 250.9 122.3 172.7 179 136.4l0 0 0 0c4.8-3.1 9.2-5.9 13-8.4zm84 88c0-11-9-20-20-20s-20 9-20 20v14c-7.6 1.7-15.2 4.4-22.2 8.5c-13.9 8.3-25.9 22.8-25.8 43.9c.1 20.3 12 33.1 24.7 40.7c11 6.6 24.7 10.8 35.6 14l1.7 .5c12.6 3.8 21.8 6.8 28 10.7c5.1 3.2 5.8 5.4 5.9 8.2c.1 5-1.8 8-5.9 10.5c-5 3.1-12.9 5-21.4 4.7c-11.1-.4-21.5-3.9-35.1-8.5c-2.3-.8-4.7-1.6-7.2-2.4c-10.5-3.5-21.8 2.2-25.3 12.6s2.2 21.8 12.6 25.3c1.9 .6 4 1.3 6.1 2.1l0 0 0 0c8.3 2.9 17.9 6.2 28.2 8.4V424c0 11 9 20 20 20s20-9 20-20V410.2c8-1.7 16-4.5 23.2-9c14.3-8.9 25.1-24.1 24.8-45c-.3-20.3-11.7-33.4-24.6-41.6c-11.5-7.2-25.9-11.6-37.1-15l0 0-.7-.2c-12.8-3.9-21.9-6.7-28.3-10.5c-5.2-3.1-5.3-4.9-5.3-6.7c0-3.7 1.4-6.5 6.2-9.3c5.4-3.2 13.6-5.1 21.5-5c9.6 .1 20.2 2.2 31.2 5.2c10.7 2.8 21.6-3.5 24.5-14.2s-3.5-21.6-14.2-24.5c-6.5-1.7-13.7-3.4-21.1-4.7V216z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="flex-grow-1 overflow-hidden ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden justify-content-between d-flex align-items-center gap-5">
                                    <p class="text-truncate font-size-18 mb-0 fw-bold">Revenue</p>
                                    <h5 class="mb-0">{{ $emp_count }}
                                    </h5>
                                </div>
                                <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 2.8% Increase</span> vs last month</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="#14213d"
                                            d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H80c-8.8 0-16-7.2-16-16s7.2-16 16-16H448c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zM416 272a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <div
                                    class="flex-grow-1 overflow-hidden d-flex justify-content-between align-items-center gap-5 ">
                                    <p class="text-truncate font-size-18 mb-0 fw-bold"> Salery</p>
                                    <h5 class="mb-0">{{ $client_count }}
                                    </h5>
                                </div>

                                <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-danger text-danger font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-bottom-left"></i> 7.8% Loss</span> vs last month</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="#142134"
                                        stroke="#142134">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path fill="#14213d"
                                                d="M268.383 22.168l-55.918 84.482 29.717 3.733c-9.22 30.13-11.095 50.878-8.885 92.12 14.138-2.23 25.56-3.025 40.586 1.39-9.877-36.84-8.844-49.427-4.88-89.768l32.622 2.277-33.242-94.234zm218.482 2.21l-108.36 30.03 20.915 25.975c-49.512 31.019-80.331 55.548-104.74 123.164 13.201-.152 28.098 2.921 44.174 9.004 5.728-44.666 33.74-76.14 79.302-108.918l19.983 24.816 48.726-104.07zm-463.574 2.31L89.17 129.173l19.084-28.711c35.554 32.44 58.145 76.33 57.308 107.43 18.568-8.696 29.927-9.527 49.735-3.778-8.105-31.203-43.577-108.722-91.639-129.103l16.57-26.037L23.292 26.687zm276.117 214.667c-5.28.12-10.21 2.415-16.937 9.594l-6.565 6.969-6.812-6.72c-7.387-7.28-13.216-9.29-19.125-9.03-5.908.26-12.855 3.367-20.625 9.656l-6.217 5.03-5.906-5.374c-8.9-8.052-16.485-10.439-23.75-10.064-5.288.274-10.775 2.266-16.25 5.75l40.966 73.69c15.454 9.451 47.034 13.006 68.75 2.062l39.594-73.344c-7.51-3.062-14.26-6.202-20.094-7.406-2.112-.437-4.07-.756-5.968-.813-.354-.01-.71-.008-1.06 0zm-89.97 96.188v.002c-18.035 12.742-32.516 34.717-38.125 66.904-5.435 31.196 3.129 52.266 18.283 66.625 15.155 14.36 37.902 21.736 61 21.436 23.1-.3 46.136-8.31 61.625-22.936 15.49-14.627 24.249-35.425 19.281-65.187-5.137-30.757-18.4-52.148-35.19-65.094-28.482 15.056-64.095 11.856-86.875-1.75z">
                                            </path>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">

                                <div
                                    class="flex-grow-1 overflow-hidden d-flex justify-content-between align-items-center gap-5">
                                    <p class="text-dark text-truncate font-size-18 mb-0 fw-bold">Expence</p>
                                    <h5 class="mb-0">15 </h5>
                                </div>
                                <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 4.6% Growth</span> vs last month</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body overflow-hidden" style="position: relative;">
                        <div class="ag-courses-item_bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 10">
                            <div class="avatar-md flex-shrink-0">
                                <span class="avatar-title bg-subtle-primary text-primary rounded-pill fs-2">
                                    <svg viewBox="0 0 512 512" id="svg2793"
                                        style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"
                                        version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:cc="http://creativecommons.org/ns#"
                                        xmlns:dc="http://purl.org/dc/elements/1.1/"
                                        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                        xmlns:serif="http://www.serif.com/" xmlns:svg="http://www.w3.org/2000/svg"
                                        fill="#14213d" stroke="#14213d">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <defs id="defs2797"></defs>
                                            <g id="_03-Profit" style="display:inline"
                                                transform="translate(-2048,7.53847e-4)">
                                                <g id="g2756" transform="translate(2132.93,29.6336)">
                                                    <path
                                                        d="m 0,166.206 c 1.848,0 3.727,-0.344 5.548,-1.069 L 245.19,69.65 234.235,95.126 c -3.272,7.61 0.244,16.433 7.855,19.706 1.931,0.83 3.941,1.224 5.919,1.224 5.812,0 11.345,-3.4 13.787,-9.079 l 25.26,-58.739 c 0.019,-0.046 0.032,-0.092 0.05,-0.137 0.172,-0.41 0.33,-0.825 0.464,-1.249 0.073,-0.226 0.123,-0.455 0.184,-0.682 0.065,-0.245 0.139,-0.487 0.191,-0.735 0.056,-0.26 0.09,-0.521 0.132,-0.781 0.035,-0.222 0.078,-0.443 0.104,-0.668 0.029,-0.258 0.039,-0.515 0.054,-0.773 0.014,-0.233 0.036,-0.463 0.038,-0.696 0.003,-0.246 -0.012,-0.488 -0.02,-0.732 -0.009,-0.246 -0.012,-0.492 -0.032,-0.739 -0.021,-0.239 -0.06,-0.475 -0.091,-0.711 -0.033,-0.248 -0.059,-0.496 -0.106,-0.744 -0.048,-0.267 -0.119,-0.53 -0.183,-0.793 -0.051,-0.212 -0.092,-0.425 -0.153,-0.636 -0.136,-0.475 -0.294,-0.941 -0.478,-1.4 V 36.76 c -0.183,-0.459 -0.391,-0.908 -0.617,-1.348 -0.104,-0.2 -0.224,-0.387 -0.335,-0.581 -0.132,-0.229 -0.258,-0.463 -0.403,-0.686 -0.141,-0.219 -0.298,-0.423 -0.451,-0.633 -0.134,-0.186 -0.262,-0.376 -0.406,-0.557 -0.161,-0.201 -0.335,-0.389 -0.506,-0.582 -0.155,-0.174 -0.304,-0.354 -0.467,-0.521 -0.171,-0.176 -0.354,-0.337 -0.534,-0.504 -0.179,-0.167 -0.353,-0.339 -0.543,-0.498 -0.185,-0.157 -0.381,-0.297 -0.574,-0.444 -0.196,-0.15 -0.387,-0.305 -0.592,-0.447 -0.23,-0.158 -0.471,-0.297 -0.71,-0.442 -0.179,-0.11 -0.352,-0.227 -0.538,-0.33 -0.434,-0.24 -0.88,-0.46 -1.336,-0.656 L 220.461,3.272 C 212.854,0 204.028,3.516 200.755,11.126 c -3.273,7.61 0.244,16.433 7.854,19.706 l 25.468,10.952 -239.634,95.484 c -7.695,3.066 -11.448,11.791 -8.382,19.487 2.341,5.874 7.979,9.451 13.939,9.451"
                                                        id="path2754" style="fill-rule:nonzero"></path>
                                                </g>
                                                <g id="g2760" transform="translate(2078,242.827)">
                                                    <path
                                                        d="m 0,104.978 c 0,-9.826 7.994,-17.819 17.82,-17.819 9.826,0 17.82,7.993 17.82,17.819 V 207.489 H 0 Z M 138.79,41.869 c 0,-4.77 1.85,-9.243 5.225,-12.613 3.353,-3.358 7.826,-5.208 12.595,-5.208 4.763,0 9.232,1.85 12.602,5.226 3.365,3.359 5.218,7.832 5.218,12.595 v 165.62 h -35.64 z m 138.78,-52.88 c 0,-9.826 7.994,-17.821 17.82,-17.821 9.826,0 17.82,7.995 17.82,17.821 v 218.5 h -35.64 z m 138.79,-73.681 c 0,-9.826 7.994,-17.819 17.82,-17.819 9.826,0 17.82,7.993 17.82,17.819 v 292.181 h -35.64 z m 17.82,-47.819 c -26.368,0 -47.82,21.452 -47.82,47.819 v 292.181 h -43.15 v -218.5 c 0,-26.368 -21.452,-47.821 -47.82,-47.821 -26.368,0 -47.82,21.453 -47.82,47.821 v 218.5 H 204.43 V 41.869 c 0,-12.786 -4.98,-24.799 -14.005,-33.808 -9.02,-9.036 -21.029,-14.013 -33.815,-14.013 -12.792,0 -24.805,4.977 -33.808,13.995 -9.036,9.022 -14.012,21.035 -14.012,33.826 v 165.62 H 65.64 V 104.978 C 65.64,78.611 44.188,57.159 17.82,57.159 -8.548,57.159 -30,78.611 -30,104.978 v 117.511 c 0,8.284 6.716,15 15,15 h 482 c 8.284,0 15,-6.716 15,-15 V -84.692 c 0,-26.367 -21.452,-47.819 -47.82,-47.819"
                                                        id="path2758" style="fill-rule:nonzero"></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <div
                                    class="flex-grow-1 overflow-hidden d-flex align-items-center justify-content-between gap-5">
                                    <p class="text-dark text-truncate font-size-18 mb-0 fw-bold">Profit</p>
                                    <h5 class="mb-0">$5000
                                    </h5>
                                </div>
                                <p class="text-muted mb-0 text-truncate"><span
                                        class="badge bg-subtle-success text-success font-size-12 fw-normal me-1"><i
                                            class="mdi mdi-arrow-top-right"></i> 4.6% Growth</span> vs last month</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title mb-0 flex-grow-1">Attendance </h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr style="border-bottom: 1px solid #e3e3e3;">

                                        <th>EMP ID</th>
                                        <th>Employee Name</th>
                                        <th>Status</th>
                                        <th>Shift</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>
                                        <td><span class="text-danger">Absent</span></td>
                                        <td><span class="text-dark fw-bold">Morning</span></td>
                                    </tr>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>
                                        <td><span class="text-success">Present</span></td>
                                        <td><span class="text-dark fw-bold">Evening</span></td>
                                    </tr>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>
                                        <td><span class="text-success">Present</span></td>
                                        <td><span class="text-dark fw-bold">Morning</span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="text-center pt-3">
                            <a href="javascript:void()" class=" w-md">View All</a>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title mb-0 flex-grow-1">Overall Attendence</h4>
                    </div>
                    <div class="card-body pt-0">
                        <div id="social-source" class="apex-charts" style="min-height: 200.7px;">
                            <div id="apexcharts8rop0virk"
                                class="apexcharts-canvas apexcharts8rop0virk apexcharts-theme-light"
                                style="width: 291px; height: 200.7px;">
                                <svg id="SvgjsSvg1682" width="291" height="200.7" xmlns="http://www.w3.org/2000/svg"
                                    version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS"
                                    transform="translate(0, 0)" style="background: transparent;">

                                    <g id="SvgjsG1684" class="apexcharts-inner apexcharts-graphical"
                                        transform="translate(-42.5, 10)">
                                        <defs id="SvgjsDefs1683">
                                            <clipPath id="gridRectMask8rop0virk">
                                                <rect id="SvgjsRect1685" width="384" height="592" x="-3" y="-1"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <clipPath id="forecastMask8rop0virk"></clipPath>
                                            <clipPath id="nonForecastMask8rop0virk"></clipPath>
                                            <clipPath id="gridRectMarkerMask8rop0virk">
                                                <rect id="SvgjsRect1686" width="382" height="594" x="-2" y="-2"
                                                    rx="0" ry="0" opacity="1" stroke-width="0"
                                                    stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                            </clipPath>
                                            <filter id="SvgjsFilter1695" filterUnits="userSpaceOnUse" width="200%"
                                                height="200%" x="-50%" y="-50%">
                                                <feFlood id="SvgjsFeFlood1696" flood-color="#000000" flood-opacity="0.45"
                                                    result="SvgjsFeFlood1696Out" in="SourceGraphic"></feFlood>
                                                <feComposite id="SvgjsFeComposite1697" in="SvgjsFeFlood1696Out"
                                                    in2="SourceAlpha" operator="in" result="SvgjsFeComposite1697Out">
                                                </feComposite>
                                                <feOffset id="SvgjsFeOffset1698" dx="1" dy="1"
                                                    result="SvgjsFeOffset1698Out" in="SvgjsFeComposite1697Out"></feOffset>
                                                <feGaussianBlur id="SvgjsFeGaussianBlur1699" stdDeviation="1 "
                                                    result="SvgjsFeGaussianBlur1699Out" in="SvgjsFeOffset1698Out">
                                                </feGaussianBlur>
                                                <feMerge id="SvgjsFeMerge1700" result="SvgjsFeMerge1700Out"
                                                    in="SourceGraphic">
                                                    <feMergeNode id="SvgjsFeMergeNode1701"
                                                        in="SvgjsFeGaussianBlur1699Out"></feMergeNode>
                                                    <feMergeNode id="SvgjsFeMergeNode1702" in="[object Arguments]">
                                                    </feMergeNode>
                                                </feMerge>
                                                <feBlend id="SvgjsFeBlend1703" in="SourceGraphic"
                                                    in2="SvgjsFeMerge1700Out" mode="normal"
                                                    result="SvgjsFeBlend1703Out"></feBlend>
                                            </filter>
                                            <filter id="SvgjsFilter1708" filterUnits="userSpaceOnUse" width="200%"
                                                height="200%" x="-50%" y="-50%">
                                                <feFlood id="SvgjsFeFlood1709" flood-color="#000000" flood-opacity="0.45"
                                                    result="SvgjsFeFlood1709Out" in="SourceGraphic"></feFlood>
                                                <feComposite id="SvgjsFeComposite1710" in="SvgjsFeFlood1709Out"
                                                    in2="SourceAlpha" operator="in" result="SvgjsFeComposite1710Out">
                                                </feComposite>
                                                <feOffset id="SvgjsFeOffset1711" dx="1" dy="1"
                                                    result="SvgjsFeOffset1711Out" in="SvgjsFeComposite1710Out"></feOffset>
                                                <feGaussianBlur id="SvgjsFeGaussianBlur1712" stdDeviation="1 "
                                                    result="SvgjsFeGaussianBlur1712Out" in="SvgjsFeOffset1711Out">
                                                </feGaussianBlur>
                                                <feMerge id="SvgjsFeMerge1713" result="SvgjsFeMerge1713Out"
                                                    in="SourceGraphic">
                                                    <feMergeNode id="SvgjsFeMergeNode1714"
                                                        in="SvgjsFeGaussianBlur1712Out"></feMergeNode>
                                                    <feMergeNode id="SvgjsFeMergeNode1715" in="[object Arguments]">
                                                    </feMergeNode>
                                                </feMerge>
                                                <feBlend id="SvgjsFeBlend1716" in="SourceGraphic"
                                                    in2="SvgjsFeMerge1713Out" mode="normal"
                                                    result="SvgjsFeBlend1716Out"></feBlend>
                                            </filter>
                                            <filter id="SvgjsFilter1721" filterUnits="userSpaceOnUse" width="200%"
                                                height="200%" x="-50%" y="-50%">
                                                <feFlood id="SvgjsFeFlood1722" flood-color="#000000" flood-opacity="0.45"
                                                    result="SvgjsFeFlood1722Out" in="SourceGraphic"></feFlood>
                                                <feComposite id="SvgjsFeComposite1723" in="SvgjsFeFlood1722Out"
                                                    in2="SourceAlpha" operator="in" result="SvgjsFeComposite1723Out">
                                                </feComposite>
                                                <feOffset id="SvgjsFeOffset1724" dx="1" dy="1"
                                                    result="SvgjsFeOffset1724Out" in="SvgjsFeComposite1723Out"></feOffset>
                                                <feGaussianBlur id="SvgjsFeGaussianBlur1725" stdDeviation="1 "
                                                    result="SvgjsFeGaussianBlur1725Out" in="SvgjsFeOffset1724Out">
                                                </feGaussianBlur>
                                                <feMerge id="SvgjsFeMerge1726" result="SvgjsFeMerge1726Out"
                                                    in="SourceGraphic">
                                                    <feMergeNode id="SvgjsFeMergeNode1727"
                                                        in="SvgjsFeGaussianBlur1725Out"></feMergeNode>
                                                    <feMergeNode id="SvgjsFeMergeNode1728" in="[object Arguments]">
                                                    </feMergeNode>
                                                </feMerge>
                                                <feBlend id="SvgjsFeBlend1729" in="SourceGraphic"
                                                    in2="SvgjsFeMerge1726Out" mode="normal"
                                                    result="SvgjsFeBlend1729Out"></feBlend>
                                            </filter>
                                        </defs>
                                        <g id="SvgjsG1687" class="apexcharts-pie">
                                            <g id="SvgjsG1688" transform="translate(0, 0) scale(1)">
                                                <circle id="SvgjsCircle1689" r="142.71219512195123" cx="189"
                                                    cy="189" fill="transparent"></circle>
                                                <g id="SvgjsG1690" class="apexcharts-slices">
                                                    <g id="SvgjsG1691" class="apexcharts-series apexcharts-pie-series"
                                                        seriesName="Present" rel="1" data:realIndex="0">
                                                        <path id="SvgjsPath1692"
                                                            d="M 10.609756097560961 188.99999999999997 A 178.39024390243904 178.39024390243904 0 0 1 181.81694912292042 10.754430911539998 L 183.25355929833634 46.40354472923198 A 142.71219512195123 142.71219512195123 0 0 0 46.287804878048775 188.99999999999997 L 10.609756097560961 188.99999999999997 z"
                                                            fill="rgb(1, 50, 32)" fill-opacity="1" stroke-opacity="1"
                                                            stroke-linecap="butt" stroke-width="2" stroke-dasharray="0"
                                                            class="apexcharts-pie-area apexcharts-donut-slice-0"
                                                            index="0" j="0" data:angle="87.6923076923077"
                                                            data:startAngle="-90" data:strokeWidth="2" data:value="8"
                                                            data:pathOrig="M 10.609756097560961 188.99999999999997 A 178.39024390243904 178.39024390243904 0 0 1 181.81694912292042 10.754430911539998 L 183.25355929833634 46.40354472923198 A 142.71219512195123 142.71219512195123 0 0 0 46.287804878048775 188.99999999999997 L 10.609756097560961 188.99999999999997 z"
                                                            stroke="#ffffff"></path>
                                                    </g>
                                                    <g id="SvgjsG1704" class="apexcharts-series apexcharts-pie-series"
                                                        seriesName="Facebook" rel="2" data:realIndex="1">
                                                        <path id="SvgjsPath1705"
                                                            d="M 181.81694912292042 10.754430911539998 A 178.39024390243904 178.39024390243904 0 0 1 331.61278954959045 81.83344096008348 L 303.09023163967237 103.26675276806678 A 142.71219512195123 142.71219512195123 0 0 0 183.25355929833634 46.40354472923198 L 181.81694912292042 10.754430911539998 z"
                                                            fill="rgba(56,199,134,1)" fill-opacity="1" stroke-opacity="1"
                                                            stroke-linecap="butt" stroke-width="2" stroke-dasharray="0"
                                                            class="apexcharts-pie-area apexcharts-donut-slice-1"
                                                            index="0" j="1" data:angle="55.38461538461539"
                                                            data:startAngle="-2.3076923076923066" data:strokeWidth="2"
                                                            data:value="24"
                                                            data:pathOrig="M 181.81694912292042 10.754430911539998 A 178.39024390243904 178.39024390243904 0 0 1 331.61278954959045 81.83344096008348 L 303.09023163967237 103.26675276806678 A 142.71219512195123 142.71219512195123 0 0 0 183.25355929833634 46.40354472923198 L 181.81694912292042 10.754430911539998 z"
                                                            stroke="#ffffff"></path>
                                                    </g>
                                                    <g id="SvgjsG1717" class="apexcharts-series apexcharts-pie-series"
                                                        seriesName="Leave" rel="3" data:realIndex="2">
                                                        <path id="SvgjsPath1718"
                                                            d="M 331.61278954959045 81.83344096008348 A 178.39024390243904 178.39024390243904 0 0 1 367.39024118540027 188.96886502906273 L 331.7121929483202 188.97509202325017 A 142.71219512195123 142.71219512195123 0 0 0 303.09023163967237 103.26675276806678 L 331.61278954959045 81.83344096008348 z"
                                                            fill="rgba(218,234,238,1)" fill-opacity="1"
                                                            stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                                            stroke-dasharray="0"
                                                            class="apexcharts-pie-area apexcharts-donut-slice-2"
                                                            index="0" j="2" data:angle="36.92307692307692"
                                                            data:startAngle="53.07692307692308" data:strokeWidth="2"
                                                            data:value="16"
                                                            data:pathOrig="M 331.61278954959045 81.83344096008348 A 178.39024390243904 178.39024390243904 0 0 1 367.39024118540027 188.96886502906273 L 331.7121929483202 188.97509202325017 A 142.71219512195123 142.71219512195123 0 0 0 303.09023163967237 103.26675276806678 L 331.61278954959045 81.83344096008348 z"
                                                            stroke="#ffffff"></path>
                                                    </g>
                                                    <g id="SvgjsG1693" class="apexcharts-datalabels"><text
                                                            id="SvgjsText1694" font-family="Helvetica, Arial, sans-serif"
                                                            x="73.21006756377089" y="77.78226025823683"
                                                            text-anchor="middle" dominant-baseline="auto"
                                                            font-size="12px" font-weight="600" fill="#ffffff"
                                                            class="apexcharts-text apexcharts-pie-label"
                                                            filter="url(#SvgjsFilter1695)"
                                                            style="font-family: Helvetica, Arial, sans-serif;">8</text>
                                                    </g>
                                                    <g id="SvgjsG1706" class="apexcharts-datalabels"><text
                                                            id="SvgjsText1707" font-family="Helvetica, Arial, sans-serif"
                                                            x="257.82711352906693" y="43.949930954480436"
                                                            text-anchor="middle" dominant-baseline="auto"
                                                            font-size="12px" font-weight="600" fill="#ffffff"
                                                            class="apexcharts-text apexcharts-pie-label"
                                                            filter="url(#SvgjsFilter1708)"
                                                            style="font-family: Helvetica, Arial, sans-serif;">5</text>
                                                    </g>
                                                    <g id="SvgjsG1719" class="apexcharts-datalabels"><text
                                                            id="SvgjsText1720" font-family="Helvetica, Arial, sans-serif"
                                                            x="341.2886825063727" y="138.15856741469338"
                                                            text-anchor="middle" dominant-baseline="auto"
                                                            font-size="12px" font-weight="600" fill="#ffffff"
                                                            class="apexcharts-text apexcharts-pie-label"
                                                            filter="url(#SvgjsFilter1721)"
                                                            style="font-family: Helvetica, Arial, sans-serif;">3</text>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                        <line id="SvgjsLine1730" x1="0" y1="0" x2="378"
                                            y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                            stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                                        <line id="SvgjsLine1731" x1="0" y1="0" x2="378"
                                            y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt"
                                            class="apexcharts-ycrosshairs-hidden"></line>
                                    </g>
                                </svg>
                                <div class="apexcharts-tooltip apexcharts-theme-dark">
                                    <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                            class="apexcharts-tooltip-marker"
                                            style="background-color: rgb(1, 50, 32);"></span>
                                        <div class="apexcharts-tooltip-text"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-y-label"></span><span
                                                    class="apexcharts-tooltip-text-y-value"></span></div>
                                            <div class="apexcharts-tooltip-goals-group"><span
                                                    class="apexcharts-tooltip-text-goals-label"></span><span
                                                    class="apexcharts-tooltip-text-goals-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                    <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                            class="apexcharts-tooltip-marker"
                                            style="background-color: rgb(56, 199, 134);"></span>
                                        <div class="apexcharts-tooltip-text"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-y-label"></span><span
                                                    class="apexcharts-tooltip-text-y-value"></span></div>
                                            <div class="apexcharts-tooltip-goals-group"><span
                                                    class="apexcharts-tooltip-text-goals-label"></span><span
                                                    class="apexcharts-tooltip-text-goals-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                    <div class="apexcharts-tooltip-series-group" style="order: 3;"><span
                                            class="apexcharts-tooltip-marker"
                                            style="background-color: rgb(218, 234, 238);"></span>
                                        <div class="apexcharts-tooltip-text"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                            <div class="apexcharts-tooltip-y-group"><span
                                                    class="apexcharts-tooltip-text-y-label"></span><span
                                                    class="apexcharts-tooltip-text-y-value"></span></div>
                                            <div class="apexcharts-tooltip-goals-group"><span
                                                    class="apexcharts-tooltip-text-goals-label"></span><span
                                                    class="apexcharts-tooltip-text-goals-value"></span></div>
                                            <div class="apexcharts-tooltip-z-group"><span
                                                    class="apexcharts-tooltip-text-z-label"></span><span
                                                    class="apexcharts-tooltip-text-z-value"></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="social-content text-center">
                            <p class="text-uppercase mb-1">Total Employees</p>
                            <h3 class="mb-0">15</h3>
                        </div>
                        <div class="row gx-4 mt-1">
                            <div class="col-md-4">
                                <div class="mt-4">
                                    <div class="progress" style="height: 7px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 85%"
                                            aria-valuenow="85" aria-valuemin="0" aria-valuemax="85">
                                        </div>
                                    </div>
                                    <p class="text-muted mt-2 pt-2 mb-0 text-uppercase font-size-13 text-truncate">Present
                                    </p>
                                    <h4 class="mt-1 mb-0 font-size-20">8</h4>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mt-4">
                                    <div class="progress" style="height: 7px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 70%"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="70">
                                        </div>
                                    </div>
                                    <p class="text-muted mt-2 pt-2 mb-0 text-uppercase font-size-13 text-truncate">Absent
                                    </p>
                                    <h4 class="mt-1 mb-0 font-size-20">4</h4>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mt-4">
                                    <div class="progress" style="height: 7px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="60">
                                        </div>
                                    </div>
                                    <p class="text-muted mt-2 pt-2 mb-0 text-uppercase font-size-13 text-truncate">Leave
                                    </p>
                                    <h4 class="mt-1 mb-0 font-size-20">3</h4>
                                </div>
                            </div>
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
                            style="max-height: 300px;">
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
                                                        <tr>
                                                            <td style="width: 20px;"><img
                                                                    src="assets/images/users/avatar-4.jpg"
                                                                    class="avatar-sm rounded-circle " alt="..."></td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1">Glenn Holden</h6>
                                                                <p class="text-muted mb-0 font-size-14">
                                                                    glennholden@tocly.com</p>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Cancel</span>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-20"
                                                                        role="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another
                                                                            action</a>
                                                                        <a class="dropdown-item" href="#">Something
                                                                            else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated
                                                                            link</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><img src="assets/images/users/avatar-5.jpg"
                                                                    class="avatar-sm rounded-circle " alt="..."></td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1">Lolita Hamill</h6>
                                                                <p class="text-muted mb-0 font-size-14">
                                                                    lolitahamill@tocly.com</p>
                                                            </td>

                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Success</span>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-20"
                                                                        role="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another
                                                                            action</a>
                                                                        <a class="dropdown-item" href="#">Something
                                                                            else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated
                                                                            link</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><img src="assets/images/users/avatar-6.jpg"
                                                                    class="avatar-sm rounded-circle " alt="..."></td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1">Robert Mercer</h6>
                                                                <p class="text-muted mb-0 font-size-14">
                                                                    robertmercer@tocly.com</p>
                                                            </td>

                                                            <td><span
                                                                    class="badge badge-soft-info font-size-12">Active</span>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-20"
                                                                        role="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another
                                                                            action</a>
                                                                        <a class="dropdown-item" href="#">Something
                                                                            else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated
                                                                            link</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><img src="assets/images/users/avatar-7.jpg"
                                                                    class="avatar-sm rounded-circle " alt="..."></td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1">Marie Kim</h6>
                                                                <p class="text-muted mb-0 font-size-14">mariekim@tocly.com
                                                                </p>
                                                            </td>

                                                            <td><span
                                                                    class="badge badge-soft-warning font-size-12">Pending</span>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-20"
                                                                        role="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another
                                                                            action</a>
                                                                        <a class="dropdown-item" href="#">Something
                                                                            else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated
                                                                            link</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><img src="assets/images/users/avatar-8.jpg"
                                                                    class="avatar-sm rounded-circle " alt="..."></td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1">Sonya Henshaw</h6>
                                                                <p class="text-muted mb-0 font-size-14">
                                                                    sonyahenshaw@tocly.com</p>
                                                            </td>

                                                            <td><span
                                                                    class="badge badge-soft-info font-size-12">Active</span>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-20"
                                                                        role="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another
                                                                            action</a>
                                                                        <a class="dropdown-item" href="#">Something
                                                                            else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated
                                                                            link</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><img src="assets/images/users/avatar-2.jpg"
                                                                    class="avatar-sm rounded-circle " alt="..."></td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1">Marie Kim</h6>
                                                                <p class="text-muted mb-0 font-size-14">marikim@tocly.com
                                                                </p>
                                                            </td>

                                                            <td><span
                                                                    class="badge badge-soft-success font-size-12">Success</span>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-20"
                                                                        role="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another
                                                                            action</a>
                                                                        <a class="dropdown-item" href="#">Something
                                                                            else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated
                                                                            link</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><img src="assets/images/users/avatar-1.jpg"
                                                                    class="avatar-sm rounded-circle " alt="..."></td>
                                                            <td>
                                                                <h6 class="font-size-15 mb-1">Sonya Henshaw</h6>
                                                                <p class="text-muted mb-0 font-size-14">
                                                                    sonyahenshaw@tocly.com</p>
                                                            </td>

                                                            <td><span
                                                                    class="badge badge-soft-danger font-size-12">Cancel</span>
                                                            </td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="text-muted dropdown-toggle font-size-20"
                                                                        role="button" data-bs-toggle="dropdown"
                                                                        aria-haspopup="true">
                                                                        <i class="mdi mdi-dots-vertical"></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <a class="dropdown-item" href="#">Action</a>
                                                                        <a class="dropdown-item" href="#">Another
                                                                            action</a>
                                                                        <a class="dropdown-item" href="#">Something
                                                                            else here</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="#">Separated
                                                                            link</a>
                                                                    </div>
                                                                </div>
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
                        <h4 class="card-title mb-0 flex-grow-1">Total Statistics</h4>
                    </div>
                    <div class="card-body pt-2">
                        <div class="row mt-3">
                            <div class="col-md-6 col-6 text-center">
                                <div class="stats-box mb-4" style="border: 1px solid #e3e3e3; border-radius:5px;">
                                    <p>Total Tasks</p>
                                    <h3>385</h3>
                                </div>
                            </div>
                            <div class="col-md-6 col-6 text-center">
                                <div class="stats-box mb-4" style="border: 1px solid #e3e3e3; border-radius:5px;">
                                    <p>Overdue Tasks</p>
                                    <h3>19</h3>
                                </div>
                            </div>
                        </div>
                        <div class="progress mb-4" style="height: 30px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-purple w-25" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30%</div>
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning w-25" role="progressbar" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">22%</div>
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success w-50" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">24%</div>
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger w-25" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">21%</div>
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info w-25" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100">10%</div>
                            </div>
                            <div>
                                <p><svg class="text-purple me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-record-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                  </svg>Completed Tasks <span class="float-end">166</span></p>
                                <p><svg class="text-warning me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-record-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                  </svg></i>Inprogress Tasks <span class="float-end">115</span></p>
                                <p><svg class="text-success me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-record-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                  </svg>On Hold Tasks <span class="float-end">31</span></p>
                                <p><svg class="text-danger me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-record-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                  </svg>Pending Tasks <span class="float-end">47</span></p>
                                <p class="mb-0"><svg class="text-primary me-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-record-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                  </svg>Review Tasks <span class="float-end">5</span></p>
                                </div>

                    </div>
                </div>

            </div>

        </div>







        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title mb-0 flex-grow-1">Tasks - Day Shift</h4>
                        <div>
                            {{-- <div class="dropdown">
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
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr style="border-bottom: 1px solid #e3e3e3;">

                                        <th>EMP ID</th>
                                        <th>Employee Name</th>
                                        <th>Tasks</th>
                                        <th>See Details</th>
                                        {{-- <th>Order Date</th>
                                        <th>Total</th> --}}
                                        {{-- <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>
                                        <td>Task 1 ....</td>
                                        <td><a href="#">see more</a></td>
                                    </tr>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>

                                        <td>Task 1 ....</td>
                                        <td><a href="#">see more</a></td>
                                    </tr>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>

                                        <td>Task 1 ....</td>
                                        <td><a href="#">see more</a></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="text-center pt-3">
                            <a href="javascript:void()" class="w-md">View All</a>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title mb-0 flex-grow-1">Tasks - Night Shift</h4>
                        <div>
                            {{-- <div class="dropdown">
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
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr style="border-bottom: 1px solid #e3e3e3;">

                                        <th>EMP ID</th>
                                        <th>Employee Name</th>
                                        <th>Tasks</th>
                                        <th>See Details</th>
                                        {{-- <th>Order Date</th>
                                        <th>Total</th> --}}
                                        {{-- <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>
                                        <td>Task 1 ....</td>
                                        <td><a href="#">see more</a></td>
                                    </tr>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>

                                        <td>Task 1 ....</td>
                                        <td><a href="#">see more</a></td>
                                    </tr>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>

                                        <td>Task 1 ....</td>
                                        <td><a href="#">see more</a></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="text-center pt-3">
                            <a href="javascript:void()" class=" w-md">View All</a>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>

        {{-- END ROW  --}}

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title mb-0 flex-grow-1">Reports - Day Shift</h4>
                        <div>
                            {{-- <div class="dropdown">
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
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <th>EMP ID</th>
                                        <th>Employee Name</th>
                                        <th>Tasks</th>
                                        <th>See Details</th>
                                        {{-- <th>Order Date</th>
                                        <th>Total</th> --}}
                                        {{-- <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>
                                        <td>Task 1 ....</td>
                                        <td><a href="#">see more</a></td>
                                    </tr>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>

                                        <td>Task 1 ....</td>
                                        <td><a href="#">see more</a></td>
                                    </tr>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>

                                        <td>Task 1 ....</td>
                                        <td><a href="#">see more</a></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="text-center pt-3">
                            <a href="javascript:void()" class=" w-md">View All</a>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex" style="background-color: #e3e3e3">
                        <h4 class="card-title mb-0 flex-grow-1">Reports - Night Shift</h4>
                        <div>
                            {{-- <div class="dropdown">
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
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <th>EMP ID</th>
                                        <th>Employee Name</th>
                                        <th>Tasks</th>
                                        <th>See Details</th>
                                        {{-- <th>Order Date</th>
                                        <th>Total</th> --}}
                                        {{-- <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>
                                        <td>Task 1 ....</td>
                                        <td><a href="#">see more</a></td>
                                    </tr>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>

                                        <td>Task 1 ....</td>
                                        <td><a href="#">see more</a></td>
                                    </tr>
                                    <tr class="row-hover" style="border-bottom: 1px solid #e3e3e3;">

                                        <td><a href="javascript: void(0);" class="text-body">#MB2540</a> </td>
                                        <td><img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}"
                                                class="avatar-xs rounded-circle me-2" alt="..."> Neal Matthews</td>

                                        <td>Task 1 ....</td>
                                        <td><a href="#">see more</a></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="text-center pt-3">
                            <a href="javascript:void()" class=" w-md">View All</a>
                        </div>
                        <!-- end table-responsive -->
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
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script>
            $('input[name="datetimes"]').daterangepicker();
            $(function() {
                $('input[name="datetimes"]').daterangepicker({
                    timePicker: true,
                    startDate: moment().startOf('hour'),
                    endDate: moment().startOf('hour').add(32, 'hour'),
                    locale: {
                        format: 'M/DD hh:mm A'
                    }
                });
            });

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

            // You can repeat the process for the second chart if needed
            /*
            var chartOptions = {
                // Options for the second chart
                // ...
            };

            var chart = new ApexCharts(document.querySelector("#chart"), chartOptions);
            chart.render();
            */
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
    @endsection
