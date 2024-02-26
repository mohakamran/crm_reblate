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
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="#14213d"
                                            d="M320 96H192L144.6 24.9C137.5 14.2 145.1 0 157.9 0H354.1c12.8 0 20.4 14.2 13.3 24.9L320 96zM192 128H320c3.8 2.5 8.1 5.3 13 8.4C389.7 172.7 512 250.9 512 416c0 53-43 96-96 96H96c-53 0-96-43-96-96C0 250.9 122.3 172.7 179 136.4l0 0 0 0c4.8-3.1 9.2-5.9 13-8.4zm84 88c0-11-9-20-20-20s-20 9-20 20v14c-7.6 1.7-15.2 4.4-22.2 8.5c-13.9 8.3-25.9 22.8-25.8 43.9c.1 20.3 12 33.1 24.7 40.7c11 6.6 24.7 10.8 35.6 14l1.7 .5c12.6 3.8 21.8 6.8 28 10.7c5.1 3.2 5.8 5.4 5.9 8.2c.1 5-1.8 8-5.9 10.5c-5 3.1-12.9 5-21.4 4.7c-11.1-.4-21.5-3.9-35.1-8.5c-2.3-.8-4.7-1.6-7.2-2.4c-10.5-3.5-21.8 2.2-25.3 12.6s2.2 21.8 12.6 25.3c1.9 .6 4 1.3 6.1 2.1l0 0 0 0c8.3 2.9 17.9 6.2 28.2 8.4V424c0 11 9 20 20 20s20-9 20-20V410.2c8-1.7 16-4.5 23.2-9c14.3-8.9 25.1-24.1 24.8-45c-.3-20.3-11.7-33.4-24.6-41.6c-11.5-7.2-25.9-11.6-37.1-15l0 0-.7-.2c-12.8-3.9-21.9-6.7-28.3-10.5c-5.2-3.1-5.3-4.9-5.3-6.7c0-3.7 1.4-6.5 6.2-9.3c5.4-3.2 13.6-5.1 21.5-5c9.6 .1 20.2 2.2 31.2 5.2c10.7 2.8 21.6-3.5 24.5-14.2s-3.5-21.6-14.2-24.5c-6.5-1.7-13.7-3.4-21.1-4.7V216z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="d-flex flex-column ms-2">
                                <div
                                    class="flex-grow-1 overflow-hidden d-flex align-items-center justify-content-between gap-5">
                                    <p class="text-dark text-truncate font-size-18 mb-0 fw-bold">Revenue</p>
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
        <!-- END ROW -->
        <!--
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex pb-0">
                            <h4 class="card-title mb-0 flex-grow-1">Expenses By Month</h4>
                            {{-- <div>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                ALL
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                1M
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                6M
                            </button>
                            <button type="button" class="btn btn-soft-primary btn-sm">
                                1Y
                            </button>
                        </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-xl-12 audiences-border">
                                    <div id="expenses-months" class="apex-charts"></div>
                                </div>
                                {{-- <div class="col-xl-4">
                                <div id="donut-chart" class="apex-charts"></div>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header border-0 align-items-center d-flex pb-0">
                            <h4 class="card-title mb-0 flex-grow-1">Expenses By Month</h4>
                            {{-- <div>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                ALL
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                1M
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                6M
                            </button>
                            <button type="button" class="btn btn-soft-primary btn-sm">
                                1Y
                            </button>
                        </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-xl-12 audiences-border">
                                    <div id="chart" class="apex-charts"></div>
                                </div>
                                {{-- <div class="col-xl-4">
                                <div id="donut-chart" class="apex-charts"></div>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        -->
        <!-- END ROW -->


        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex pb-0">
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


        </div>
        <!-- END ROW -->

        <div class="row">


            <div class="col-xl-6">
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
                        <div class="table-responsive simplebar-scrollable-y simplebar-scrollable-x" data-simplebar="init"
                            style="max-height: 358px;">
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
                                                            <td class="text-muted"><i
                                                                    class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$250.00
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
                                                            <td class="text-muted"><i
                                                                    class="mdi mdi-trending-down text-danger font-size-18 align-middle me-1"></i>$110.00
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
                                                            <td class="text-muted"><i
                                                                    class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$420.00
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
                                                            <td class="text-muted"><i
                                                                    class="mdi mdi-trending-down text-danger font-size-18 align-middle me-1"></i>$120.00
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
                                                            <td class="text-muted"><i
                                                                    class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$112.00
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
                                                            <td class="text-muted"><i
                                                                    class="mdi mdi-trending-down text-danger font-size-18 align-middle me-1"></i>$120.00
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
                                                            <td class="text-muted"><i
                                                                    class="mdi mdi-trending-up text-success font-size-18 align-middle me-1"></i>$112.00
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
                        </div> <!-- enbd table-responsive-->
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

        <script>
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
