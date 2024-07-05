@extends('layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('page-title')
    {{ $title }}
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
    </style>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body bg-white">
                        <div style="margin-bottom: 20px;">
                            <p class="card-title font-size-14 text-black">Fill below form to add your data as new employee in our
                                database system. Fields with(<span style="color:red;">*</span>) are mandatory to fill,
                                remaining are optional.</p>
                        </div>




                        @if (session('success'))
                            <div class="container-fluid d-flex justify-content-end" id="container">
                                <div class="alert alert-success " style="max-width: 300px;" id="close-alert">
                                    {{ session('success') }}

                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right; font-size:20px; margin-left:10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="container-fluid d-flex justify-content-end" id="container">
                                <div class="alert alert-danger " style="max-width: 300px;" id="close-alert">
                                    {{ session('error') }}

                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right; font-size:20px; margin-left:10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            </div>
                        @endif


                        <form method="post" action="{{ $route }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 style="color: #fca311; font-weight: 600; font-size: 35px;">
                                        Personal Details</h2>
                                    <div class="form-floating mb-3">
                                        {{-- @isset($emp_data->Emp_Image)

                                                <a href="{{ asset($emp_data->Emp_Image) }}" target="_blank">
                                                    <img src="{{ asset($emp_data->Emp_Image) }}" style="width:150px;height:150px">
                                                </a>
                                            @endisset --}}

                                        @if (isset($emp_data->Emp_Image) && $emp_data->Emp_Image != null && file_exists($emp_data->Emp_Image))
                                            <img src="{{ url($emp_data->Emp_Image) }}" style="width:120px;height:120px; border-radius: 100%;"
                                                alt="">
                                        @else
                                            <img src="{{ url('/user.png') }}" style="width:120px;height:120px; border-radius: 100%;"
                                                alt="">
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Image <span class="text-danger">*</span></label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg height="20px" width="20px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#9e9e9e;} </style> <g> <path class="st0" d="M194.651,414.476c16.23,0,61.349,0,61.349,0s45.111,0,61.35,0c16.222,0,23.587-23.603,14.198-40.285 c-7.072-12.572-18.659-26.826-37.516-34.921c-10.793,7.556-23.905,12-38.032,12c-14.143,0-27.238-4.444-38.032-12 c-18.864,8.095-30.444,22.349-37.523,34.921C171.064,390.873,178.421,414.476,194.651,414.476z"></path> <path class="st0" d="M256,335.476c27.714,0,50.167-22.444,50.167-50.159v-12.016c0-27.714-22.452-50.174-50.167-50.174 c-27.714,0-50.174,22.46-50.174,50.174v12.016C205.826,313.032,228.286,335.476,256,335.476z"></path> <path class="st0" d="M404.977,56.889h-75.834v16.254c0,31.365-25.524,56.889-56.889,56.889h-32.508 c-31.365,0-56.889-25.524-56.889-56.889V56.889h-75.833c-25.445,0-46.072,20.627-46.072,46.071v362.969 c0,25.444,20.627,46.071,46.072,46.071h297.952c25.444,0,46.071-20.627,46.071-46.071V102.96 C451.048,77.516,430.421,56.889,404.977,56.889z M402.286,463.238H109.714V150.349h292.572V463.238z"></path> <path class="st0" d="M239.746,113.778h32.508c22.406,0,40.635-18.23,40.635-40.635V40.635C312.889,18.23,294.659,0,272.254,0 h-32.508c-22.405,0-40.635,18.23-40.635,40.635v32.508C199.111,95.547,217.341,113.778,239.746,113.778z M231.619,40.635 c0-4.492,3.635-8.127,8.127-8.127h32.508c4.493,0,8.127,3.635,8.127,8.127v16.254c0,4.492-3.634,8.127-8.127,8.127h-32.508 c-4.492,0-8.127-3.635-8.127-8.127V40.635z"></path> </g> </g></svg>
                                                    <input
                                                    class="form-control"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Employee Email"
                                                        value="{{ isset($emp_data->Emp_Email) ? $emp_data->Emp_Email : old('employee_email') }}"
                                                        type="file" name="employee_img" accept="image/*">
                                                    </div>
                                                    @error('employee_img')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Full Name <span class="text-danger">*</span></label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg height="20px" width="20px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <style type="text/css">
                                                                .st0 {
                                                                    fill: #9e9e9e;
                                                                }
                                                            </style>
                                                            <g>
                                                                <path class="st0" d="M256,265.308c73.252,0,132.644-59.391,132.644-132.654C388.644,59.412,329.252,0,256,0 c-73.262,0-132.643,59.412-132.643,132.654C123.357,205.917,182.738,265.308,256,265.308z">
                                                                </path>
                                                                <path class="st0" d="M425.874,393.104c-5.922-35.474-36-84.509-57.552-107.465c-5.829-6.212-15.948-3.628-19.504-1.427 c-27.04,16.672-58.782,26.399-92.819,26.399c-34.036,0-65.778-9.727-92.818-26.399c-3.555-2.201-13.675-4.785-19.505,1.427 c-21.55,22.956-51.628,71.991-57.551,107.465C71.573,480.444,164.877,512,256,512C347.123,512,440.427,480.444,425.874,393.104z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <input type="text"
                                                    class="form-control"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Employee Name"
                                                        value="{{ isset($emp_data->Emp_Full_Name) ? $emp_data->Emp_Full_Name : old('employee_name') }}"
                                                        id="floatingFirstnameInput">
                                                    </div>
                                                    @error('employee_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Phone Number <span class="text-danger">*</span></label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#9e9e9e">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z" stroke="#9e9e9e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </g>
                                                    </svg>
                                                    <input
                                                    class="form-control"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Phone Number"
                                                        value="{{ isset($emp_data->Emp_Phone) ? $emp_data->Emp_Phone : old('employee_phone') }}"
                                                        type="tel" name="employee_phone">
                                                    </div>
                                                    @error('employee_phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Email <span class="text-danger">*</span></label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg fill="#9e9e9e" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 469.2 469.2" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M22.202,77.023C25.888,75.657,29.832,74.8,34,74.8h401.2c4.168,0,8.112,0.857,11.798,2.224L267.24,246.364 c-18.299,17.251-46.975,17.251-65.28,0L22.202,77.023z M464.188,377.944c3.114-5.135,5.012-11.098,5.012-17.544V108.8 c0-4.569-0.932-8.915-2.57-12.899L298.411,254.367L464.188,377.944z M283.2,268.464c-13.961,11.961-31.253,18.027-48.6,18.027 c-17.347,0-34.64-6.06-48.6-18.027L20.692,391.687c4.094,1.741,8.582,2.714,13.308,2.714h401.2c4.726,0,9.214-0.973,13.308-2.714 L283.2,268.464z M2.571,95.9C0.932,99.885,0,104.23,0,108.8V360.4c0,6.446,1.897,12.409,5.012,17.544l165.777-123.577L2.571,95.9z"></path> </g> </g></svg>
                                                    <input
                                                    class="form-control"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Employee Email"
                                                        value="{{ isset($emp_data->Emp_Email) ? $emp_data->Emp_Email : old('employee_email') }}"
                                                        type="email" name="employee_email">
                                                    </div>
                                                    @error('employee_email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Gender <span class="text-danger">*</span></label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg fill="#9e9e9e" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 247.582 247.582" xml:space="preserve" stroke="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M196.666,93.047V76.445h10v-21h-10v-15h-25v15h-11v21h11v16.424c-29,5.64-51.581,31.564-51.581,62.617 c0,35.162,28.69,63.769,63.852,63.769c35.163,0,63.645-28.606,63.645-63.769C247.582,124.769,225.666,99.059,196.666,93.047z M184.021,194.254c-21.377,0-38.769-17.392-38.769-38.769c0-21.378,17.392-38.77,38.769-38.77c21.378,0,38.77,17.392,38.77,38.77 C222.79,176.863,205.399,194.254,184.021,194.254z"></path> <path d="M127.581,91.404c0-35.162-28.523-63.769-63.686-63.769S0,56.242,0,91.404c0,31.068,22.666,57.003,51.666,62.625v27.99 l-8.184-7.057l-13.471,16.039l34.295,28.945l35.335-28.831l-13.437-16.268l-9.537,7.658v-28.674 C105.666,147.804,127.581,122.105,127.581,91.404z M25.208,91.404c0-21.377,17.392-38.769,38.77-38.769s38.77,17.392,38.77,38.769 c0,21.378-17.392,38.77-38.77,38.77S25.208,112.782,25.208,91.404z"></path> </g> </g></svg>

                                                <select class="w-100 ms-2 form-control p-0"
                                                style="background-color: transparent; border:none;" name="Emp_Gender"
                                                id="Emp_Gender">
                                                <option value="" selected disabled>Select Emp Gender</option>
                                                <option value="Male"
                                                    {{ old('Emp_Gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female"
                                                    {{ old('Emp_Gender') == 'Female' ? 'selected' : '' }}>Female
                                                </option>
                                                <option value="Other"
                                                    {{ old('Emp_Gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                                    </div>
                                                    @error('employee_email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>
                                        {{-- marital status  --}}
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Marital Status <span class="text-danger">*</span></label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg width="20px" height="20px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>rings [#909]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-100.000000, -4199.000000)" fill="#9e9e9e"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M46,4046.5 C46,4043.467 48.467,4041 51.5,4041 C53.634,4041 55.484,4042.225 56.396,4044.006 C55.862,4044.013 55.341,4044.077 54.84,4044.191 C52.032,4044.826 49.826,4047.032 49.191,4049.84 C49.74,4050.221 50.392,4050.454 51.092,4050.525 C51.497,4048.274 53.274,4046.497 55.525,4046.092 C55.842,4046.035 56.167,4046 56.5,4046 C56.662,4046 56.819,4046.02 56.977,4046.036 C56.989,4046.189 57,4046.343 57,4046.5 C57,4049.533 54.533,4052 51.5,4052 C48.467,4052 46,4049.533 46,4046.5 M60.379,4045.09 C60.451,4045.55 60.5,4046.019 60.5,4046.5 C60.5,4046.89 60.467,4047.271 60.419,4047.647 C61.395,4048.641 62,4050 62,4051.5 C62,4054.533 59.533,4057 56.5,4057 C55,4057 53.641,4056.395 52.647,4055.419 C52.228,4055.007 51.884,4054.522 51.613,4053.994 C55.703,4053.933 59,4050.604 59,4046.5 C59,4042.358 55.642,4039 51.5,4039 C47.358,4039 44,4042.358 44,4046.5 C44,4049.891 46.252,4052.754 49.341,4053.681 C49.523,4054.281 49.771,4054.853 50.09,4055.379 C51.405,4057.547 53.779,4059 56.5,4059 C60.642,4059 64,4055.642 64,4051.5 C64,4048.779 62.547,4046.405 60.379,4045.09" id="rings-[#909]"> </path> </g> </g> </g> </g></svg>
                                                    <select class="form-control ms-2 p-0"
                                                    style="background-color: transparent; border:none;"
                                                    name="Emp_Marital_Status" id="">
                                                    <option value="" selected disabled>Select Marital Status</option>
                                                    <option value="Married"
                                                        {{ old('Emp_Marital_Status') == 'Married' ? 'selected' : '' }}>
                                                        Married</option>
                                                    <option value="Single"
                                                        {{ old('Emp_Marital_Status') == 'Single' ? 'selected' : '' }}>
                                                        Single</option>

                                                </select>
                                                    </div>
                                                    @error('Emp_Marital_Status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Passport Number <span class="text-danger">*</span></label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <rect x="4" y="3" width="16" height="18" rx="1" stroke="#9e9e9e" stroke-width="2" stroke-linecap="round"></rect> <path d="M9 17H15" stroke="#9e9e9e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <circle cx="12" cy="10" r="4.25" stroke="#9e9e9e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle> <path d="M13.25 10C13.25 11.3097 13.0363 12.4609 12.7179 13.257C12.5578 13.6571 12.386 13.9306 12.2336 14.0917C12.0837 14.2502 12.0046 14.25 12.0001 14.25H12H11.9999C11.9954 14.25 11.9163 14.2502 11.7664 14.0917C11.614 13.9306 11.4422 13.6571 11.2821 13.257C10.9637 12.4609 10.75 11.3097 10.75 10C10.75 8.69028 10.9637 7.53908 11.2821 6.74301C11.4422 6.34289 11.614 6.06943 11.7664 5.90826C11.9163 5.7498 11.9954 5.74999 11.9999 5.75L12 5.75L12.0001 5.75C12.0046 5.74999 12.0837 5.7498 12.2336 5.90826C12.386 6.06943 12.5578 6.34289 12.7179 6.74301C13.0363 7.53908 13.25 8.69028 13.25 10Z" stroke="#9e9e9e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M8 10H16" stroke="#9e9e9e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                    <input
                                                    class="form-control"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Passport Number"
                                                        value="{{ old('Emp_Passport_Number') }}"
                                                        type="text" name="Emp_Passport_Number">
                                                    </div>
                                                    @error('Emp_Passport_Number')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee CNIC Number <span class="text-danger">*</span></label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg width="20px" height="20px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 7V17C3.5 18.1046 4.39543 19 5.5 19H19.5C20.6046 19 21.5 18.1046 21.5 17V7C21.5 5.89543 20.6046 5 19.5 5H5.5C4.39543 5 3.5 5.89543 3.5 7Z" stroke="#9e9e9e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M15.5 10H18.5" stroke="#9e9e9e" stroke-width="1.5" stroke-linecap="round"></path> <path d="M15.5 13H18.5" stroke="#9e9e9e" stroke-width="1.5" stroke-linecap="round"></path> <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5 10C11.5 11.1046 10.6046 12 9.5 12C8.39543 12 7.5 11.1046 7.5 10C7.5 8.89543 8.39543 8 9.5 8C10.0304 8 10.5391 8.21071 10.9142 8.58579C11.2893 8.96086 11.5 9.46957 11.5 10Z" stroke="#9e9e9e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M5.5 16C8.283 12.863 11.552 13.849 13.5 16" stroke="#9e9e9e" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                                                    <input
                                                    class="form-control"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter CINC Number"
                                                        value="{{ isset($emp_data->emp_cnic) ? $emp_data->emp_cnic : old('emp_cnic') }}"
                                                        type="text" name="emp_cnic">
                                                    </div>
                                                    @error('emp_cnic')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Birthday <span class="text-danger">*</span></label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg fill="#9e9e9e" width="20px" height="20px" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" stroke="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M25 0.09375L24.21875 1.09375C23.515625 1.992188 20 6.578125 20 9C20 11.414063 21.722656 13.441406 24 13.90625L24 10C24 9.449219 24.449219 9 25 9C25.550781 9 26 9.449219 26 10L26 13.90625C28.277344 13.441406 30 11.414063 30 9C30 6.578125 26.484375 1.992188 25.78125 1.09375 Z M 23 15C21.347656 15 20 16.347656 20 18L20 26L30 26L30 18C30 16.347656 28.652344 15 27 15 Z M 11 28C8.179688 28 5.761719 29.683594 4.65625 32.09375C5.226563 33.597656 5.804688 34.398438 5.8125 34.40625C6.703125 35.59375 8.390625 37 11.40625 37C13.863281 37 15.6875 36.15625 17 34.40625L17.75 33.375L18.5625 34.375C20.042969 36.152344 22.152344 37 25 37C27.769531 37 30 36.101563 31.4375 34.375L32.25 33.375L33 34.40625C34.3125 36.15625 36.136719 37 38.59375 37C41.050781 37 42.875 36.15625 44.1875 34.40625C44.214844 34.371094 44.964844 33.414063 45.375 32.125C44.277344 29.691406 41.839844 28 39 28 Z M 4 35.3125L4 42L46 42L46 35.34375C45.875 35.523438 45.792969 35.609375 45.78125 35.625C44.113281 37.847656 41.679688 39 38.59375 39C35.941406 39 33.785156 38.167969 32.15625 36.5C30.753906 37.785156 28.5 39 25 39C22.039063 39 19.640625 38.164063 17.84375 36.5C16.214844 38.164063 14.054688 39 11.40625 39C7.5625 39 5.351563 37.144531 4.1875 35.59375C4.175781 35.578125 4.113281 35.484375 4 35.3125 Z M 0 44L0 45C0 50 4.890625 50 6.5 50L43.5 50C45.105469 50 50 50 50 45L50 44Z"></path></g></svg>
                                                    <input
                                                    class="form-control"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"
                                                        placeholder="Enter Employee Birthday"
                                                        value="{{ isset($emp_data->emp_birthday) ? $emp_data->Emp_Joining_Date : old('emp_birthday') }}"
                                                        type="date" name="emp_birthday">
                                                    </div>
                                                    @error('emp_birthday')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Home address <span class="text-danger">*</span></label>
                                                <div class="mb-3 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg width="20px" height="20px" viewBox="0 0 1024 1024" fill="#9e9e9e" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" stroke="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M512 1012.8c-253.6 0-511.2-54.4-511.2-158.4 0-92.8 198.4-131.2 283.2-143.2h3.2c12 0 22.4 8.8 24 20.8 0.8 6.4-0.8 12.8-4.8 17.6-4 4.8-9.6 8.8-16 9.6-176.8 25.6-242.4 72-242.4 96 0 44.8 180.8 110.4 463.2 110.4s463.2-65.6 463.2-110.4c0-24-66.4-70.4-244.8-96-6.4-0.8-12-4-16-9.6-4-4.8-5.6-11.2-4.8-17.6 1.6-12 12-20.8 24-20.8h3.2c85.6 12 285.6 50.4 285.6 143.2 0.8 103.2-256 158.4-509.6 158.4z m-16.8-169.6c-12-11.2-288.8-272.8-288.8-529.6 0-168 136.8-304.8 304.8-304.8S816 145.6 816 313.6c0 249.6-276.8 517.6-288.8 528.8l-16 16-16-15.2zM512 56.8c-141.6 0-256.8 115.2-256.8 256.8 0 200.8 196 416 256.8 477.6 61.6-63.2 257.6-282.4 257.6-477.6C768.8 172.8 653.6 56.8 512 56.8z m0 392.8c-80 0-144.8-64.8-144.8-144.8S432 160 512 160c80 0 144.8 64.8 144.8 144.8 0 80-64.8 144.8-144.8 144.8zM512 208c-53.6 0-96.8 43.2-96.8 96.8S458.4 401.6 512 401.6c53.6 0 96.8-43.2 96.8-96.8S564.8 208 512 208z" fill=""></path></g></svg>
                                                    <textarea name="employee_address" style="background-color: transparent; border:none; resize: none; height: 20px"
                                                    placeholder="Employee Address" class="form-control p-0 ms-3">{{ isset($emp_data->Emp_Address) ? $emp_data->Emp_Address : old('employee_address') }}</textarea>
                                                    </div>
                                                    @error('employee_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h2 style="color: #fca311; font-weight: 600; font-size: 35px;">
                                        Company Details</h2>
                                    <div class="row" style="margin-top: 15px;">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee code <span class="text-danger">*</span></label>
                                                <div class="mb-2 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg fill="#9e9e9e" height="20px" width="20px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 452.232 452.232" xml:space="preserve" stroke="#9e9e9e">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g>
                                                                <path d="M169.88,186.918l-55.987,0.007c-1.565,0-2.195-0.921-6.659-8.134c-1.591-2.571-4.052-6.547-5.455-8.358 c-1.396,1.766-3.838,5.61-5.419,8.1c-4.661,7.338-5.434,8.393-7.008,8.393h-7.893c-0.138,0-0.194,0.016-0.197,0.016l-0.215,0.061 c-0.333,2.228-0.501,4.461-0.501,6.662v12.387c0,24.834,20.204,45.038,45.038,45.038s45.038-20.204,45.038-45.038v-12.387 c0-2.202-0.168-4.438-0.502-6.668L169.88,186.918z">
                                                                </path>
                                                                <path d="M432.232,72.765H20c-11.028,0-20,8.972-20,20v266.703c0,11.028,8.972,20,20,20h316.635c9.654,0,22.293-5.606,28.774-12.764 l75.464-83.357c6.37-7.037,11.359-19.984,11.359-29.476V92.765C452.232,81.736,443.261,72.765,432.232,72.765z M246.298,148.935 h151.558v28.183H246.298V148.935z M192.685,212.709c0,17.361-5.303,32.579-15.356,44.129c6.076,8.541,9.405,19.061,9.405,29.813 l-0.003,12.077l-0.065,24.594l-122.307-0.025l-0.068-37.285c0-13.879,2.595-23.744,8.145-30.847 C63.3,243.696,58.48,229.057,58.48,212.709v-20.694c0-37.001,30.102-67.104,67.103-67.104c37,0,67.102,30.103,67.102,67.104 V212.709z M315.549,256.193h-69.251V228.01h69.251V256.193z M420.301,260.714l-79.363,87.919c-3.685,4.083-6.703,2.923-6.706-2.577 l-0.043-82.818c-0.003-5.5,4.495-9.997,9.995-9.994l72.818,0.042C422.501,253.289,423.986,256.631,420.301,260.714z">
                                                                </path>
                                                                <polygon points="125.583,299.354 158.391,264.556 92.775,264.556 ">
                                                                </polygon>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <input class="ms-2 w-100" placeholder="Enter Employee code"
                                                    style="background-color: transparent; border:none;"
                                                    value="{{ isset($emp_data->Emp_Code) ? $emp_data->Emp_Code : old('employee_code') }}"
                                                    type="text" name="employee_code">
                                                    </div>
                                                    @error('employee_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Department <span class="text-danger">*</span></label>
                                                <div class="mb-2 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <title>group_line</title>
                                                            <g id="页面-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <g id="Development" transform="translate(-768.000000, 0.000000)">
                                                                    <g id="group_line" transform="translate(768.000000, 0.000000)">
                                                                        <path d="M24,0 L24,24 L0,24 L0,0 L24,0 Z M12.5934901,23.257841 L12.5819402,23.2595131 L12.5108777,23.2950439 L12.4918791,23.2987469 L12.4918791,23.2987469 L12.4767152,23.2950439 L12.4056548,23.2595131 C12.3958229,23.2563662 12.3870493,23.2590235 12.3821421,23.2649074 L12.3780323,23.275831 L12.360941,23.7031097 L12.3658947,23.7234994 L12.3769048,23.7357139 L12.4804777,23.8096931 L12.4953491,23.8136134 L12.4953491,23.8136134 L12.5071152,23.8096931 L12.6106902,23.7357139 L12.6232938,23.7196733 L12.6232938,23.7196733 L12.6266527,23.7031097 L12.609561,23.275831 C12.6075724,23.2657013 12.6010112,23.2592993 12.5934901,23.257841 L12.5934901,23.257841 Z M12.8583906,23.1452862 L12.8445485,23.1473072 L12.6598443,23.2396597 L12.6498822,23.2499052 L12.6498822,23.2499052 L12.6471943,23.2611114 L12.6650943,23.6906389 L12.6699349,23.7034178 L12.6699349,23.7034178 L12.678386,23.7104931 L12.8793402,23.8032389 C12.8914285,23.8068999 12.9022333,23.8029875 12.9078286,23.7952264 L12.9118235,23.7811639 L12.8776777,23.1665331 C12.8752882,23.1545897 12.8674102,23.1470016 12.8583906,23.1452862 L12.8583906,23.1452862 Z M12.1430473,23.1473072 C12.1332178,23.1423925 12.1221763,23.1452606 12.1156365,23.1525954 L12.1099173,23.1665331 L12.0757714,23.7811639 C12.0751323,23.7926639 12.0828099,23.8018602 12.0926481,23.8045676 L12.108256,23.8032389 L12.3092106,23.7104931 L12.3186497,23.7024347 L12.3186497,23.7024347 L12.3225043,23.6906389 L12.340401,23.2611114 L12.337245,23.2485176 L12.337245,23.2485176 L12.3277531,23.2396597 L12.1430473,23.1473072 Z" id="MingCute" fill-rule="nonzero">
                                                                        </path>
                                                                        <path d="M15,6 C15,7.30622 14.1652,8.41746 13,8.82929 L13,11 L16,11 C17.6569,11 19,12.3431 19,14 L19,15.1707 C20.1652,15.5825 21,16.6938 21,18 C21,19.6569 19.6569,21 18,21 C16.3431,21 15,19.6569 15,18 C15,16.6938 15.8348,15.5825 17,15.1707 L17,14 C17,13.4477 16.5523,13 16,13 L8,13 C7.44772,13 7,13.4477 7,14 L7,15.1707 C8.16519,15.5825 9,16.6938 9,18 C9,19.6569 7.65685,21 6,21 C4.34315,21 3,19.6569 3,18 C3,16.6938 3.83481,15.5825 5,15.1707 L5,14 C5,12.3431 6.34315,11 8,11 L11,11 L11,8.82929 C9.83481,8.41746 9,7.30622 9,6 C9,4.34315 10.3431,3 12,3 C13.6569,3 15,4.34315 15,6 Z M12,5 C11.4477,5 11,5.44772 11,6 C11,6.55228 11.4477,7 12,7 C12.5523,7 13,6.55228 13,6 C13,5.44772 12.5523,5 12,5 Z M6,17 C5.44772,17 5,17.4477 5,18 C5,18.5523 5.44772,19 6,19 C6.55228,19 7,18.5523 7,18 C7,17.4477 6.55228,17 6,17 Z M18,17 C17.4477,17 17,17.4477 17,18 C17,18.5523 17.4477,19 18,19 C18.5523,19 19,18.5523 19,18 C19,17.4477 18.5523,17 18,17 Z" id="形状" fill="#9e9e9e"> </path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <input class="ms-2 w-100" placeholder="Enter Employee department"
                                                    style="background-color: transparent; border:none;"
                                                    value="{{ isset($emp_data->department) ? $emp_data->department : old('employee_department') }}"
                                                    type="text" name="employee_department">
                                                    </div>
                                                    @error('employee_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Designation <span class="text-danger">*</span></label>
                                                <div class="mb-2 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg fill="#9e9e9e" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 472.615 472.615" xml:space="preserve" width="20px" height="20px" stroke="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g><g><path d="M328.776,104.453V39.385H143.839v65.068h-41.097v164.386h106.595l-3.853-30.821h61.645l-3.853,30.821h106.595V104.453 H328.776z M308.227,104.453H164.388V59.934h143.839V104.453z"></path></g></g><g><g><polygon points="260.709,289.388 256.857,320.213 215.759,320.213 211.906,289.388 102.743,289.388 102.743,433.229 369.873,433.229 369.873,289.388 "></polygon></g></g><g><g><rect x="410.969" y="104.457" width="61.647" height="328.773"></rect></g></g><g><g><rect y="104.457" width="61.647" height="328.773"></rect></g></g></g></svg>
                                                    <input class="ms-2 w-100"  placeholder="Employee Designation" name="employee_designation"
                                                    style="background-color: transparent; border:none;"
                                                    value="{{ isset($emp_data->Emp_Designation) ? $emp_data->Emp_Designation : old('employee_designation') }}"
                                                    type="text">
                                                    </div>
                                                    @error('employee_designation')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Shift <span class="text-danger">*</span></label>
                                                <div class="mb-2 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg fill="#9e9e9e" height="20px" width="20px" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" stroke="#9e9e9e"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M8.2,9.6c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3c0.4-0.4,0.4-1,0-1.4L7.5,6.1c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4L8.2,9.6 z"></path> <path d="M7,16c0-0.6-0.4-1-1-1H3c-0.6,0-1,0.4-1,1s0.4,1,1,1h3C6.6,17,7,16.6,7,16z"></path> <path d="M8.2,22.4l-2.1,2.1c-0.4,0.4-0.4,1,0,1.4c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l2.1-2.1c0.4-0.4,0.4-1,0-1.4 S8.6,22,8.2,22.4z"></path> </g> <path d="M29.4,16.2c-0.4-0.2-0.9-0.1-1.2,0.3c-0.8,1-2,1.5-3.2,1.5c-2.3,0-4.3-1.9-4.3-4.3c0-1.6,0.9-3,2.3-3.8 c0.4-0.2,0.6-0.7,0.5-1.1C23.4,8.4,23,8,22.5,8c-0.1,0-0.3,0-0.4,0c-1.9,0-3.7,0.7-5.1,1.8V3c0-0.6-0.4-1-1-1s-1,0.4-1,1v5.1 c-3.9,0.5-7,3.9-7,7.9s3.1,7.4,7,7.9V29c0,0.6,0.4,1,1,1s1-0.4,1-1v-6.8c1.4,1.2,3.2,1.8,5.1,1.8c4,0,7.3-2.9,7.9-6.8 C30.1,16.8,29.8,16.3,29.4,16.2z M17,20c0,0.6-0.4,1-1,1s-1-0.4-1-1v-8c0-0.6,0.4-1,1-1s1,0.4,1,1V20z"></path> </g></svg>
                                                    <select class="w-100 ms-2"
                                                    style="background-color: transparent; border:none;"
                                                    name="employee_shift_time" id="">
                                                    <option value="" selected disabled>Select Time Shift</option>
                                                    <option value="Morning"
                                                        {{ old('employee_shift_time') == 'Morning' ? 'selected' : '' }}>
                                                        Morning Shift</option>
                                                    <option value="Night"
                                                        {{ old('employee_shift_time') == 'Night' ? 'selected' : '' }}>
                                                        Night
                                                        Shift</option>
                                                </select>
                                                    </div>
                                                    @error('employee_shift_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex flex-column">
                                                <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Joining Date <span class="text-danger">*</span></label>
                                                <div class="mb-2 d-flex form-control inputboxcolor "
                                                    style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M20 10V7C20 5.89543 19.1046 5 18 5H6C4.89543 5 4 5.89543 4 7V10M20 10V19C20 20.1046 19.1046 21 18 21H6C4.89543 21 4 20.1046 4 19V10M20 10H4M8 3V7M16 3V7" stroke="#9e9e9e" stroke-width="2" stroke-linecap="round"></path><rect x="6" y="12" width="3" height="3" rx="0.5" fill="#9e9e9e"></rect><rect x="10.5" y="12" width="3" height="3" rx="0.5" fill="#9e9e9e"></rect><rect x="15" y="12" width="3" height="3" rx="0.5" fill="#9e9e9e"></rect></g></svg>
                                                    <input class="ms-2 w-100"  placeholder="Employee Joining Date" name="employee_designation"
                                                    style="background-color: transparent; border:none;"
                                                    value="{{ isset($emp_data->Emp_Joining_Date) ? $emp_data->Emp_Joining_Date : old('employee_joining_date') }}"
                                                    type="date">
                                                    </div>
                                                    @error('employee_joining_date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <h2 style="color: #fca311; font-weight: 600; font-size: 35px;">
                                            Salary Details</h2>
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column">
                                                    <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Basic Salary <span class="text-danger">*</span></label>
                                                    <div class="mb-2 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M6 9.5V14.5M18 9.5V14.5M3.11111 6H20.8889C21.5025 6 22 6.53726 22 7.2V16.8C22 17.4627 21.5025 18 20.8889 18H3.11111C2.49746 18 2 17.4627 2 16.8V7.2C2 6.53726 2.49746 6 3.11111 6ZM14.5 12C14.5 13.3807 13.3807 14.5 12 14.5C10.6193 14.5 9.5 13.3807 9.5 12C9.5 10.6193 10.6193 9.5 12 9.5C13.3807 9.5 14.5 10.6193 14.5 12Z" stroke="#9e9e9e" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>
                                                        <input class="ms-2 w-100"  placeholder="Employee Basic Salary" name="basic_salary"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->basic_salary) ? $emp_data->basic_salary : '25000' }}"
                                                        type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column">
                                                    <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Designation Bonus <span class="text-danger">*</span></label>
                                                    <div class="mb-2 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg width="20px" height="20px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--gis" preserveAspectRatio="xMidYMid meet" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M68.913 48.908l-.048.126c.015-.038.027-.077.042-.115l.006-.011z" fill="#9e9e9e"></path><path d="M63.848 73.354l-1.383 1.71c1.87.226 3.68.491 5.375.812l-5.479 1.623l7.313 1.945l5.451-1.719c3.348 1.123 7.984 2.496 9.52 4.057h-10.93l1.086 3.176h11.342c-.034 1.79-3.234 3.244-6.29 4.422l-7.751-1.676l-7.303 2.617l7.8 1.78c-4.554 1.24-12.2 1.994-18.53 2.341l-.266-3.64h-7.606l-.267 3.64c-6.33-.347-13.975-1.1-18.53-2.34l7.801-1.781l-7.303-2.617l-7.752 1.676c-3.012-.915-6.255-2.632-6.289-4.422H25.2l1.086-3.176h-10.93c1.536-1.561 6.172-2.934 9.52-4.057l5.451 1.719l7.313-1.945l-5.479-1.623a82.552 82.552 0 0 1 5.336-.807l-1.363-1.713c-14.785 1.537-27.073 4.81-30.295 9.979C.7 91.573 19.658 99.86 49.37 99.989c.442.022.878.006 1.29 0c29.695-.136 48.636-8.42 43.501-16.654c-3.224-5.171-15.52-8.445-30.314-9.981z" fill="#9e9e9e"></path><path d="M49.855 0A10.5 10.5 0 0 0 39.5 10.5A10.5 10.5 0 0 0 50 21a10.5 10.5 0 0 0 10.5-10.5A10.5 10.5 0 0 0 50 0a10.5 10.5 0 0 0-.145 0zm-.057 23.592c-7.834.002-15.596 3.368-14.78 10.096l2 14.625c.351 2.573 2.09 6.687 4.687 6.687h.185l2.127 24.531c.092 1.105.892 2 2 2h8c1.108 0 1.908-.895 2-2l2.127-24.53h.186c2.597 0 4.335-4.115 4.687-6.688l2-14.625c.524-6.734-7.384-10.097-15.219-10.096z" fill="#9e9e9e"></path><path d="M-159.25 61.817l-.048.126c.016-.038.027-.076.043-.115c0-.004.004-.007.006-.01z" fill="#9e9e9e"></path></g></svg>
                                                        <input class="ms-2 w-100"  placeholder="Employee Designation Bonus" name="designation_bonus"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->designation_bonus) ? $emp_data->designation_bonus : '5000' }}"
                                                        type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column">
                                                    <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Travel Allowance <span class="text-danger">*</span></label>
                                                    <div class="mb-2 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="#9e9e9e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <circle cx="5.5" cy="17.5" r="3.5">
                                                                </circle>
                                                                <circle cx="18.5" cy="17.5" r="3.5">
                                                                </circle>
                                                                <path d="M15 6a1 1 0 100-2 1 1 0 000 2zm-3 11.5V14l-3-3 4-3 2 3h2">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <input class="ms-2 w-100"  placeholder="Employee Travel Allowance" name="travel_allowance"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->travel_allowance) ? $emp_data->travel_allowance : '5000' }}"
                                                        type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 style="color: #fca311; font-weight: 600; font-size: 35px;">
                                            Emergency Contact Details</h2>
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col-md-6">
                                                <div class="d-flex flex-column">
                                                    <label class="empSubTitle font-size-13 fw-bolder" for="">Employee Travel Allowance <span class="text-danger">*</span></label>
                                                    <div class="mb-2 d-flex form-control inputboxcolor "
                                                        style="border: 1px solid #14213d; border-radius:50px;padding:10px; background-color: white;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="#9e9e9e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <circle cx="5.5" cy="17.5" r="3.5">
                                                                </circle>
                                                                <circle cx="18.5" cy="17.5" r="3.5">
                                                                </circle>
                                                                <path d="M15 6a1 1 0 100-2 1 1 0 000 2zm-3 11.5V14l-3-3 4-3 2 3h2">
                                                                </path>
                                                            </g>
                                                        </svg>
                                                        <input class="ms-2 w-100"  placeholder="Employee Travel Allowance" name="travel_allowance"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->travel_allowance) ? $emp_data->travel_allowance : '5000' }}"
                                                        type="text">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control " placeholder="Employee code: 200sols"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->Emp_Relation) ? $emp_data->Emp_Relation : old('employee_relation') }}"
                                                        type="text" name="employee_relation">
                                                    @error('employee_relation')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <label for="">Relation <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control " placeholder="department"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->Emp_Relation_Name) ? $emp_data->Emp_Relation_Name : old('employee_relative_name') }}"
                                                        type="text" name="employee_relative_name">

                                                    @error('employee_relative_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <label for="">Name <span class="text-danger">*</span></label>
                                                </div>
                                            </div>





                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->Emp_Relation_Phone) ? $emp_data->Emp_Relation_Phone : old('employee_relative_phone_num') }}"
                                                        placeholder="0333-3333333" name="employee_relative_phone_num"
                                                        type="tel">
                                                    @error('employee_relative_phone_num')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <label for="">Phone # <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <textarea name="employee_relative_address" style="background-color: transparent; border:none;"
                                                        placeholder="Employee Address" class="form-control">{{ isset($emp_data->Emp_Relation_Address) ? $emp_data->Emp_Relation_Address : old('employee_relative_address') }}</textarea>
                                                    @error('employee_relative_address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <label for=""> Address <span
                                                            class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- secondary phone number data  --}}
                                        <h4>Secondary Emergancy Details</h4>

                                        {{-- name and relationship --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="0333-3333333" name="secondary_employee_relation"
                                                        type="tel" value="{{ old('secondary_employee_relation') }}">

                                                    <label for=""> Relation </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="0333-3333333" name="secondary_employee_relation_name"
                                                        type="tel"
                                                        value="{{ old('secondary_employee_relation_name') }}">

                                                    <label for=""> Name </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="0333-3333333"
                                                        name="secondary_employee_relative_phone_num" type="tel"
                                                        value="{{ old('secondary_employee_relative_phone_num') }}">

                                                    <label for=""> Phone # </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <textarea name="secondary_employee_relative_address" style="background-color: transparent; border:none;"
                                                        placeholder="Employee Address" class="form-control">{{ old('secondary_employee_relative_address') }}</textarea>

                                                    <label for=""> Address </label>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="col-md-6">
                                        <h4
                                            style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                            Back Account Details</h4>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->Emp_Bank_Name) ? $emp_data->Emp_Bank_Name : old('employee_bank_name') }}"
                                                        placeholder="0333-3333333" name="employee_bank_name"
                                                        type="text">

                                                    <label for="">Bank Name </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        value="{{ isset($emp_data->Emp_Bank_IBAN) ? $emp_data->Emp_Bank_IBAN : old('employee_bank_iban') }}"
                                                        placeholder="0333-3333333" name="employee_bank_iban"
                                                        type="text">

                                                    <label for="">Bank IBAN # </label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="bank title" value="{{ old('account_title') }}"
                                                        name="account_title" type="text">

                                                    <label for="">Account Title</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="bank number" value="{{ old('account_number') }}"
                                                        name="account_number" type="text">

                                                    <label for="">Account No</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="branch name" value="{{ old('branch_name') }}"
                                                        name="branch_name" type="text">

                                                    <label for="">Branch Name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 inputboxcolor"
                                                    style="border: 1px solid #c7c7c7;">
                                                    <input class="form-control"
                                                        style="background-color: transparent; border:none;"
                                                        placeholder="bank number" value="{{ old('branch_code') }}"
                                                        name="branch_code" type="text">

                                                    <label for="">Branch Code</label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>


                                {{-- education and work experience --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4
                                            style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                            Education Details
                                        </h4>

                                        <!-- Education details section -->
                                        <div id="educationDetails">
                                            <div class="education-section mb-4">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_education.0') }}"
                                                                placeholder="Educational Institute" name="emp_education[]"
                                                                type="text">
                                                            <label for="">Education Institute</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_degree.0') }}"
                                                                placeholder="Educational Degree" name="emp_degree[]"
                                                                type="text">
                                                            <label for="">Educational Degree</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_education_start.0') }}"
                                                                placeholder="Start Date" name="emp_education_start[]"
                                                                type="date">
                                                            <label for="">Start Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_education_end.0') }}"
                                                                placeholder="End Date" name="emp_education_end[]"
                                                                type="date">
                                                            <label for="">End Date</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add more link -->
                                        <div class="row">
                                            <div class="col-md-12 text-right mb-5">
                                                <a href="#" class="add-more">Add More</a>
                                            </div>
                                        </div>
                                        <!-- Existing code for task submission -->
                                    </div>

                                    <script>

                                        // Function to create education details section
                                        function createEducationSection() {
                                            var educationSection = document.querySelector('.education-section').cloneNode(true);
                                            educationSection.classList.remove('education-section');
                                            // Add remove link
                                            var removeLink = document.createElement('a');
                                            removeLink.href = '#';
                                            removeLink.className = 'remove-education';
                                            removeLink.textContent = 'Remove';
                                            removeLink.addEventListener('click', function(e) {
                                                e.preventDefault();
                                                educationSection.remove();
                                            });
                                            educationSection.appendChild(removeLink);
                                            return educationSection;
                                        }

                                        // Event listener for the Add More Education link
                                        document.querySelector('.add-more').addEventListener('click', function(e) {
                                            e.preventDefault();
                                            var clonedSection = createEducationSection();
                                            document.getElementById('educationDetails').appendChild(clonedSection);
                                        });


                                    </script>




                                    <div class="col-md-6">
                                        <h4
                                            style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">
                                            Work Experience
                                        </h4>

                                        <!-- Work experience section -->
                                        <div id="workExperience">
                                            <div class="work-experience-section mb-4">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_company.0') }}" placeholder="Company"
                                                                name="emp_company[]" type="text">
                                                            <label for="">Company</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_position.0') }}"
                                                                placeholder="Position" name="emp_position[]"
                                                                type="text">
                                                            <label for="">Position</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_work_start.0') }}"
                                                                placeholder="Start Date" name="emp_work_start[]"
                                                                type="date">
                                                            <label for="">Start Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-floating inputboxcolor">
                                                            <input class="form-control"
                                                                style="background-color: transparent; border:none;"
                                                                value="{{ old('emp_work_end.0') }}"
                                                                placeholder="End Date" name="emp_work_end[]"
                                                                type="date">
                                                            <label for="">End Date</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Add more link -->
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <a href="#" class="add-more-work float-right">Add More</a>
                                            </div>
                                        </div>
                                        <!-- Existing code for task submission -->
                                    </div>
                                    <script>
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
                                    </script>
                                    <script>
                                        // Function to create work experience section with remove link
                                        function createWorkExperienceSection() {
                                            var workExperienceSection = document.querySelector('.work-experience-section').cloneNode(true);
                                            workExperienceSection.classList.remove('work-experience-section');

                                            // Add remove link
                                            var removeLink = document.createElement('a');
                                            removeLink.href = '#';
                                            removeLink.className = 'remove-work float-right ml-2';
                                            removeLink.textContent = 'Remove';
                                            removeLink.addEventListener('click', function(e) {
                                                e.preventDefault();
                                                workExperienceSection.remove();
                                            });
                                            workExperienceSection.appendChild(removeLink);

                                            return workExperienceSection;
                                        }

                                        // Event listener for the Add More Work Experience link
                                        document.querySelector('.add-more-work').addEventListener('click', function(e) {
                                            e.preventDefault();
                                            var clonedSection = createWorkExperienceSection();
                                            document.getElementById('workExperience').appendChild(clonedSection);

                                            // Remove the remove link from the first section
                                            if (document.querySelectorAll('.work-experience-section').length > 1) {
                                                document.querySelector('.work-experience-section').querySelector('.remove-work').remove();
                                            }
                                        });
                                    </script>




                                </div>


                                <div>
                                    <button type="submit" class="reblateBtn w-md py-2 px-4">{{ $btn_text }}</button>
                                </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
        <script>
            function hideNow() {
                // console.log('good');
                document.getElementById('close-alert').style.display = 'none';
                // divElement.style.display = 'none';
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
