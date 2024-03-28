@extends('layouts.master')
@section('title')
    Today Leave Requests
@endsection
@section('page-title')
    Today Leave Requests
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <style>
            .image-center {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                position: relative;
                left: 32%;
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
        </style>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        {{-- error message --}}
                        <div class="row container">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))

                            <div class="container-fluid d-flex justify-content-end">
                                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" style="max-width: 300px;" id="close-now">
                                    {{ session('success') }}

                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right; font-size:20px; margin-left:10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                        {{-- employee and leave records --}}
                        @if ($records->isEmpty())
                        <div class="row mt-5" style="height: 70vh;">
                            {{-- Displaying employee cards --}}
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="d-flex gap-3 align-items-center justify-content-center">
                                    <h3 class="text-center">No Leave Request today </h3>
                                    <svg viewBox="0 0 1024 1024" style="width: 50px;" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M512.003 512.003m-491.986961 0a491.986961 491.986961 0 1 0 983.973922 0 491.986961 491.986961 0 1 0-983.973922 0Z" fill="#FDDF6D"></path><path d="M617.431206 931.355819c-271.716531 0-491.984961-220.26843-491.984961-491.984961 0-145.168284 62.886123-275.632538 162.888318-365.684714-159.280311 81.438159-268.320524 247.140483-268.320524 438.312856 0 271.716531 220.26843 491.984961 491.984961 491.984961 126.548247 0 241.924473-47.794093 329.096643-126.298247-67.100131 34.312067-143.12228 53.670105-223.664437 53.670105z" fill="#FCC56B"></path><path d="M426.846834 359.704703m-60.044118 0a60.044117 60.044117 0 1 0 120.088235 0 60.044117 60.044117 0 1 0-120.088235 0Z" fill="#FFFFFF"></path><path d="M764.881494 359.704703m-60.044117 0a60.044117 60.044117 0 1 0 120.088234 0 60.044117 60.044117 0 1 0-120.088234 0Z" fill="#FFFFFF"></path><path d="M300.574587 481.542941c-36.536071 0-66.158129 29.618058-66.158129 66.156129h132.312258c0.004-36.538071-29.618058-66.156129-66.154129-66.156129zM877.629714 472.680923c-36.536071 0-66.158129 29.618058-66.158129 66.156129h132.312258c0.002-36.538071-29.616058-66.156129-66.154129-66.156129z" fill="#F9A880"></path><path d="M604.06718 780.219524c-53.018104 0-101.998199-28.800056-127.81825-75.158147-5.380011-9.658019-1.914004-21.846043 7.744015-27.226053 9.652019-5.386011 21.846043-1.914004 27.222053 7.744015 18.764037 33.684066 54.344106 54.608107 92.852182 54.608107 37.528073 0 73.512144-21.136041 93.908183-55.160108 5.686011-9.478019 17.970035-12.562025 27.458054-6.874013 9.482019 5.684011 12.558025 17.976035 6.874013 27.458053-27.588054 46.02009-76.72415 74.608146-128.24025 74.608146z" fill="#7F184C"></path><path d="M941.751839 233.584456c-52.404102-80.728158-126.076246-144.906283-213.054416-185.592362-10.00802-4.684009-21.928043-0.362001-26.612052 9.650019-4.684009 10.01202-0.362001 21.926043 9.650019 26.608052 80.190157 37.510073 148.116289 96.686189 196.440384 171.128334 49.582097 76.386149 75.792148 165.124323 75.792148 256.622501 0 260.246508-211.726414 471.970922-471.970922 471.970922S40.030078 772.247508 40.030078 511.999 251.754492 40.030078 511.999 40.030078c11.056022 0 20.014039-8.962018 20.014039-20.014039S523.055022 0 511.999 0C229.680449 0 0 229.682449 0 511.999s229.680449 511.999 511.999 511.999 511.999-229.680449 511.999-511.999c0.004-99.250194-28.436056-195.524382-82.246161-278.414544z" fill=""></path><path d="M505.872988 359.712703c0-44.144086-35.91407-80.058156-80.058156-80.058157s-80.058156 35.91407-80.058157 80.058157 35.91407 80.058156 80.058157 80.058156 80.058156-35.91407 80.058156-80.058156z m-80.060156 40.028078c-22.072043 0-40.030078-17.958035-40.030079-40.030078s17.958035-40.030078 40.030079-40.030079 40.030078 17.958035 40.030078 40.030079-17.954035 40.030078-40.030078 40.030078zM763.859492 439.770859c44.144086 0 80.058156-35.91407 80.058156-80.058156s-35.91407-80.058156-80.058156-80.058157-80.058156 35.91207-80.058156 80.058157 35.91407 80.058156 80.058156 80.058156z m0-120.088235c22.072043 0 40.030078 17.958035 40.030078 40.030079s-17.958035 40.030078-40.030078 40.030078-40.030078-17.958035-40.030078-40.030078 17.958035-40.030078 40.030078-40.030079zM511.214998 685.583339c-5.380011-9.658019-17.570034-13.126026-27.222053-7.744015-9.658019 5.380011-13.124026 17.568034-7.744015 27.226053 25.82405 46.360091 74.802146 75.156147 127.81825 75.156147 51.512101 0 100.652197-28.586056 128.24425-74.606146 5.684011-9.478019 2.608005-21.774043-6.874013-27.458053a20.014039 20.014039 0 0 0-27.458054 6.874013c-20.39804 34.024066-56.38211 55.158108-93.908183 55.158108-38.512075 0.002-74.090145-20.922041-92.856182-54.606107z" fill=""></path><path d="M648.021266 41.978082m-20.014039 0a20.014039 20.014039 0 1 0 40.028078 0 20.014039 20.014039 0 1 0-40.028078 0Z" fill=""></path></g></svg>
                                </div>
                            </div>
                        </div>

                        @else
                            <div class="row mt-5">
                                {{-- Displaying employee cards --}}
                                    @foreach ($emp as $employee)
                                        <div class="col-md-3">
                                            <div class="card hovering" style="box-shadow:0px 0px 10px 10px #00000021; overflow: hidden; cursor: pointer; border-radius: 10px;">
                                                <div style="width: 150px;height: 150px;position: absolute;z-index: 100;background-color: #fca311;border-radius: 100px;right: -75px;top: -70px;"></div>
                                                <div class="card-body">
                                                    @if ($employee->Emp_Image != null && file_exists(public_path($employee->Emp_Image)))
                                                        <img class="image-center" src="{{ $employee->Emp_Image }}"
                                                            alt="">
                                                    @else
                                                        <a href="{{ url('user.png') }}" target="_blank">
                                                            <img class="image-center" src="{{ url('user.png') }}"
                                                                alt="">
                                                        </a>
                                                    @endif
                                                    <div class="card-text-center">
                                                        <p class="emp-name">{{ $employee->Emp_Full_Name }}</p>
                                                        <div class="d-flex gap-1 align-items-center mb-3">
                                                            <p class="mb-0" style="font-size: 17px; color:#14213d; font-weight: 600;">Designation:</p>
                                                            <span style="border-bottom:1px solid #e3e3e3;">{{ $employee->Emp_Designation }}</span>
                                                        </div>
                                                        <div class="d-flex gap-1 align-items-center mb-3">
                                                            <p class="mb-0" style="font-size: 17px; color:#14213d; font-weight: 600;">Shift:</p>
                                                            <span style="border-bottom:1px solid #e3e3e3;">{{ $employee->Emp_Shift_Time }}</span>
                                                        </div>
                                                        <div class="d-flex gap-1 align-items-center mb-3">
                                                            <p class="mb-0" style="font-size: 17px; color:#14213d; font-weight: 600;">Employee Code:</p>
                                                            <span style="border-bottom:1px solid #e3e3e3;">{{ $employee->Emp_Code }}</span>
                                                        </div>
                                                    </div>
                                                    {{-- Displaying leave records --}}
                                                    <div class="leave-records">
                                                        @foreach ($records as $record)
                                                            @if ($record->emp_code == $employee->Emp_Code)
                                                                <div class="leave-record">
                                                                    <div class="d-flex gap-1 align-items-center mb-3">
                                                                        <p class="mb-0" style="font-size: 17px; color:#14213d; font-weight: 600;">Date:</p>
                                                                        <span style="border-bottom:1px solid #e3e3e3;">{{ $record->date }}</span>
                                                                    </div>
                                                                    <div class="d-flex gap-1 align-items-center mb-3">
                                                                        <p class="mb-0" style="font-size: 17px; color:#14213d; font-weight: 600;">Reason:</p>
                                                                        <span style="border-bottom:1px solid #e3e3e3;">{{ $record->reason }}</span>
                                                                    </div>
                                                                    <div class="d-flex gap-1 align-items-center mb-3">
                                                                        <p class="mb-0" style="font-size: 17px; color:#14213d; font-weight: 600;">Status:</p>
                                                                        <span class="text-danger" style="border-bottom:1px solid #e3e3e3 ;">{{ $record->status }}</span>
                                                                    </div>

                                                                </div>
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <a class="reblateBtn px-3 py-1" style="float:left;"
                                                        href="/leave-request/approve/{{ $employee->Emp_Code }}">Approve</a>
                                                    <a class="reblateBtn px-3 py-1"
                                                        href="/leave-request/decline/{{ $employee->Emp_Code }}"
                                                        style="float:right; background: #fca311; border:#fca311;">Decline</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif


                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>

        <!-- end row -->
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
        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
