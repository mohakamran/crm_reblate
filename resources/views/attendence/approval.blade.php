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
             .borderingLeftTable {
                border-top-left-radius: 10px !important;
            }

            .borderingRightTable {
                border-top-right-radius: 10px !important;
            }
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
            .approval-process {
    display: flex;
    align-items: center;
}

.step {
    padding: 5px 10px;
    border-radius: 25px;
    margin: 0 5px;
    color: white;
    font-weight: bold;
    text-align: center;
    cursor: pointer;
    font-size: 13px;
}
.submitted {
    background-color: #4CAF50;
    border: 1px solid #4CAF50;
}

.pending {
    background-color: #FF9800;
    border: 1px solid #FF9800;
    color: white;
}

.reject {
    background-color: white;
    border: 1px solid #FF0000;
    color: #FF0000;
}
        </style>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body bg-white">
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

                            <script>
                                function hideNow() {
                                    console.log("hideNow function called");
                                    document.getElementById('close_now').style.display = 'none';
                                }
                            </script>

                            @if (session('message'))
                                <div class="container-fluid d-flex justify-content-end">
                                    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center"
                                        onclick="this.style.display = 'none'" style="max-width: 300px;" id="close-now">
                                        {{ session('message') }}

                                        {{-- <a type="button"  class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right; font-size:20px; margin-left:10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </a> --}}
                                    </div>
                                </div>
                            @endif
                        </div>
                        {{-- employee and leave records --}}
                        @if ($records->isEmpty())
                            <div class="row pt-5 bg-white" style="height: 250px;">
                                {{-- Displaying employee cards --}}
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="d-flex gap-3 align-items-center justify-content-center">
                                        <h3 class="text-center">No Leave Request today </h3>
                                        <svg viewBox="0 0 1024 1024" style="width: 50px;" class="icon" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M512.003 512.003m-491.986961 0a491.986961 491.986961 0 1 0 983.973922 0 491.986961 491.986961 0 1 0-983.973922 0Z"
                                                    fill="#FDDF6D"></path>
                                                <path
                                                    d="M617.431206 931.355819c-271.716531 0-491.984961-220.26843-491.984961-491.984961 0-145.168284 62.886123-275.632538 162.888318-365.684714-159.280311 81.438159-268.320524 247.140483-268.320524 438.312856 0 271.716531 220.26843 491.984961 491.984961 491.984961 126.548247 0 241.924473-47.794093 329.096643-126.298247-67.100131 34.312067-143.12228 53.670105-223.664437 53.670105z"
                                                    fill="#FCC56B"></path>
                                                <path
                                                    d="M426.846834 359.704703m-60.044118 0a60.044117 60.044117 0 1 0 120.088235 0 60.044117 60.044117 0 1 0-120.088235 0Z"
                                                    fill="#FFFFFF"></path>
                                                <path
                                                    d="M764.881494 359.704703m-60.044117 0a60.044117 60.044117 0 1 0 120.088234 0 60.044117 60.044117 0 1 0-120.088234 0Z"
                                                    fill="#FFFFFF"></path>
                                                <path
                                                    d="M300.574587 481.542941c-36.536071 0-66.158129 29.618058-66.158129 66.156129h132.312258c0.004-36.538071-29.618058-66.156129-66.154129-66.156129zM877.629714 472.680923c-36.536071 0-66.158129 29.618058-66.158129 66.156129h132.312258c0.002-36.538071-29.616058-66.156129-66.154129-66.156129z"
                                                    fill="#F9A880"></path>
                                                <path
                                                    d="M604.06718 780.219524c-53.018104 0-101.998199-28.800056-127.81825-75.158147-5.380011-9.658019-1.914004-21.846043 7.744015-27.226053 9.652019-5.386011 21.846043-1.914004 27.222053 7.744015 18.764037 33.684066 54.344106 54.608107 92.852182 54.608107 37.528073 0 73.512144-21.136041 93.908183-55.160108 5.686011-9.478019 17.970035-12.562025 27.458054-6.874013 9.482019 5.684011 12.558025 17.976035 6.874013 27.458053-27.588054 46.02009-76.72415 74.608146-128.24025 74.608146z"
                                                    fill="#7F184C"></path>
                                                <path
                                                    d="M941.751839 233.584456c-52.404102-80.728158-126.076246-144.906283-213.054416-185.592362-10.00802-4.684009-21.928043-0.362001-26.612052 9.650019-4.684009 10.01202-0.362001 21.926043 9.650019 26.608052 80.190157 37.510073 148.116289 96.686189 196.440384 171.128334 49.582097 76.386149 75.792148 165.124323 75.792148 256.622501 0 260.246508-211.726414 471.970922-471.970922 471.970922S40.030078 772.247508 40.030078 511.999 251.754492 40.030078 511.999 40.030078c11.056022 0 20.014039-8.962018 20.014039-20.014039S523.055022 0 511.999 0C229.680449 0 0 229.682449 0 511.999s229.680449 511.999 511.999 511.999 511.999-229.680449 511.999-511.999c0.004-99.250194-28.436056-195.524382-82.246161-278.414544z"
                                                    fill=""></path>
                                                <path
                                                    d="M505.872988 359.712703c0-44.144086-35.91407-80.058156-80.058156-80.058157s-80.058156 35.91407-80.058157 80.058157 35.91407 80.058156 80.058157 80.058156 80.058156-35.91407 80.058156-80.058156z m-80.060156 40.028078c-22.072043 0-40.030078-17.958035-40.030079-40.030078s17.958035-40.030078 40.030079-40.030079 40.030078 17.958035 40.030078 40.030079-17.954035 40.030078-40.030078 40.030078zM763.859492 439.770859c44.144086 0 80.058156-35.91407 80.058156-80.058156s-35.91407-80.058156-80.058156-80.058157-80.058156 35.91207-80.058156 80.058157 35.91407 80.058156 80.058156 80.058156z m0-120.088235c22.072043 0 40.030078 17.958035 40.030078 40.030079s-17.958035 40.030078-40.030078 40.030078-40.030078-17.958035-40.030078-40.030078 17.958035-40.030078 40.030078-40.030079zM511.214998 685.583339c-5.380011-9.658019-17.570034-13.126026-27.222053-7.744015-9.658019 5.380011-13.124026 17.568034-7.744015 27.226053 25.82405 46.360091 74.802146 75.156147 127.81825 75.156147 51.512101 0 100.652197-28.586056 128.24425-74.606146 5.684011-9.478019 2.608005-21.774043-6.874013-27.458053a20.014039 20.014039 0 0 0-27.458054 6.874013c-20.39804 34.024066-56.38211 55.158108-93.908183 55.158108-38.512075 0.002-74.090145-20.922041-92.856182-54.606107z"
                                                    fill=""></path>
                                                <path
                                                    d="M648.021266 41.978082m-20.014039 0a20.014039 20.014039 0 1 0 40.028078 0 20.014039 20.014039 0 1 0-40.028078 0Z"
                                                    fill=""></path>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row mt-2">
                                {{-- Displaying employee cards --}}
                                @foreach ($empLeaveRequests as $empCode => $leaveRequests)
                                    @foreach ($leaveRequests as $request)
                                        <div class="col-md-3">
                                            <div class="card mb-0"
                                                style="box-shadow:none; overflow: hidden; border:1px solid #c7c7c7; border-radius: 10px;">

                                                <div class="card-body p-0">
                                                    <div class="p-3 pb-0">
                                                        <h2 class="empTitle font-size-18 mb-1">Leave Title</h2>
                                                        <p class="empSubTitle font-size-14">{{ $request['employee']->Emp_Full_Name }}
                                                            <span class="bold">2 days ago</span>
                                                        </p>

                                                    </div>

                                                    <div class="d-flex align-items-center px-3 flex-column py-3 text-center justify-content-center" style="background-color: #14213d">
                                                        <h1 class="empTitle mb-0" style="font-size: 35px; color:#fca311; font-weight:900">2 Days</h1>
                                                        <p class="empSubTitle font-size-14 text-white mb-0">{{ $request['leave_record']->date }}</p>
                                                    </div>

                                                    <div class="card-text-center p-3 pb-0">
                                                        <div class="leave-record">
                                                            <div class="d-flex gap-1 align-items-start mb-1 flex-column">
                                                                <p class="mb-0 empTitle font-size-18 fw-bolder ">
                                                                    Reason:</p>
                                                                <span class="font-size-14" style="color: #14213d; font-family: 'Poppins';">{{ $request['leave_record']->reason }}</span>
                                                            </div>
                                                            <div class="d-flex gap-1 align-items-start mb-3 flex-column">
                                                                <p class="mb-0 font-size-14 empSubTitle fw-bold">Approvel Process</p>
                                                                <div class="approval-process">
                                                                    <div class="step submitted">Submitted</div>
                                                                    <div class="step pending">{{ $request['leave_record']->status }}</div>
                                                                    <div class="step reject">Reject</div>
                                                                </div>
                                                                <span class="text-danger"
                                                                    style="border-bottom:1px solid #e3e3e3 ;"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex p-3 pt-0 align-items-center">

                                                        @if ($request['employee']->Emp_Image != null && file_exists(public_path($request['employee']->Emp_Image)))
                                                        <img
                                                            src="{{ $request['employee']->Emp_Image }}" style="width: 30px; height: 30px" alt="">
                                                    @else

                                                            <img  style="width: 30px; height: 30px" src="{{ url('user.png') }}"
                                                                alt="">

                                                    @endif
                                                    <div class="d-flex justify-content-between align-items-center gap-4">
                                                        <form action="/leave-status" method="post">

                                                        </form>
                                                        <a class="bg-success text-white rounded fw-bold px-3 py-1" style=""
                                                            href="{{ route('leave.handle', ['action' => 'approve', 'id' => $request['leave_record']->id]) }}">Approve</a>

                                                        <a class="bg-danger text-white rounded fw-bold px-3 py-1"
                                                            href="{{ route('leave.handle', ['action' => 'decline', 'id' => $request['leave_record']->id]) }}"
                                                            style="">Decline</a>

                                                    </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
            <div class="col-md-12 col-lg-12 col-xl-12">
               <div class="card">
                <div class="card-body bg-white">
                    <table class="table ">

                        <tr style="background-color: #14213d">
                            <td class="borderingLeftTable font-size-20" style="color: white">#</td>
                            <td class="font-size-20" style="color: white">Shift</td>
                            <td class="font-size-20" style="color: white">Emp Name</td>
                            <td class="font-size-20" style="color: white">Leaves Date</td>
                            <td class="font-size-20" style="color: white">Date</td>
                            <td class="borderingRightTable font-size-20" style="color: white">Badge</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #c7c7c7">
                            <td style="font-family: 'Poppins'; color:#000">1</td>
                            <td style="font-family: 'Poppins'; color:#000">Morning</td>
                            <td style="font-family: 'Poppins'; color:#000">Abdullah</td>
                            <td style="font-family: 'Poppins'; color:#000">22 April,2024 - 23 April,2024</td>
                            <td style="font-family: 'Poppins'; color:#000">1 day</td>
                            <td style="font-family: 'Poppins'; color:#000"><button class="px-3 py-0.5 bg-success text-white" style="border: none; font-family: 'Poppins';">Approved</button></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #c7c7c7">
                            <td style="font-family: 'Poppins'; color:#000">2</td>
                            <td style="font-family: 'Poppins'; color:#000">Evening</td>
                            <td style="font-family: 'Poppins'; color:#000">Abdullah</td>
                            <td style="font-family: 'Poppins'; color:#000">22 April,2024 - 23 April,2024</td>
                            <td style="font-family: 'Poppins'; color:#000">1 day</td>
                            <td style="font-family: 'Poppins'; color:#000"><button class="px-4 py-0.5 bg-danger text-white"  style="border: none; font-family: 'Poppins';">Reject</button></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #c7c7c7">
                            <td style="font-family: 'Poppins'; color:#000">3</td>
                            <td style="font-family: 'Poppins'; color:#000">Morning</td>
                            <td style="font-family: 'Poppins'; color:#000">Abdullah</td>
                            <td style="font-family: 'Poppins'; color:#000">22 April,2024 - 23 April,2024</td>
                            <td style="font-family: 'Poppins'; color:#000">1 day</td>
                            <td style="font-family: 'Poppins'; color:#000"><button class="px-3 py-0.5 bg-success text-white" style="border: none; font-family: 'Poppins';">Approved</button></td>
                        </tr>
                        <tr style="border-bottom: 1px solid #c7c7c7">
                            <td style="font-family: 'Poppins'; color:#000">4</td>
                            <td style="font-family: 'Poppins'; color:#000">Morning</td>
                            <td style="font-family: 'Poppins'; color:#000">Abdullah</td>
                            <td style="font-family: 'Poppins'; color:#000">22 April,2024 - 23 April,2024</td>
                            <td style="font-family: 'Poppins'; color:#000">1 day</td>
                            <td style="font-family: 'Poppins'; color:#000"><button class="px-4 py-0.5 bg-danger text-white" style="border: none; font-family: 'Poppins';">Reject</button></td>
                        </tr>




                    </table>

                </div>

               </div>

            </div>



        <!-- end row -->
        <script></script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
