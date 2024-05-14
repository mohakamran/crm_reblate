@extends('layouts.master-without-nav')
@section('title')
    Admin Login
@endsection
@section('content')
    <div class=" d-flex align-items-center min-vh-100 background-circle" style="background-color:#F1F2F3 ">
        <img src="{{ URL::asset('/Vector.svg') }}" class="vector" alt="logo" class="logo">
        <img src="{{ URL::asset('/Vector2.svg') }}" class="vector2" alt="logo" class="logo">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-11 col-lg-11 col-xl-11">
                    <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">

                                <style>
                                    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

                                    /* Custom checkbox style */
                                    .vector2 {
                                        position: absolute;
                                        left: 0;
                                        bottom: 0;
                                        width: 350px;
                                    }

                                    .vector {
                                        position: absolute;
                                        right: 0;
                                        top: 0;
                                        width: 308px;
                                        height: 213px;
                                    }

                                    .background-circle::before {
                                        content: '';
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        width: 100%;
                                        height: 100%;
                                        background: #14213d;
                                        clip-path: circle(11% at 3% 5%);
                                    }

                                    .background-circle::after {
                                        content: '';
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        width: 100%;
                                        height: 100%;
                                        background: #fca311;
                                        clip-path: circle(4% at 94% 86%);
                                    }

                                    /* Custom checkbox style */
                                    input[type="checkbox"] {
                                        appearance: none;
                                        -webkit-appearance: none;
                                        -moz-appearance: none;
                                        width: 15px;
                                        height: 15px;
                                        border: 1px solid #14213d;
                                        /* Border color */
                                        border-radius: 4px;
                                        /* Border radius */
                                        outline: none;
                                        cursor: pointer;
                                    }

                                    /* Checked state */
                                    input[type="checkbox"]:checked {
                                        background-color: #fca311;
                                        border: 1px solid #14213d;
                                        color: #14213d !important;
                                    }

                                    /* Custom styles for the checkmark inside the checkbox */
                                    input[type="checkbox"]::before {
                                        display: block;
                                        width: 20px;
                                        height: 20px;
                                        text-align: center;
                                        line-height: 16px;

                                        /* Checkmark color */
                                        font-size: 12px;
                                    }

                                    .go-back {
                                        position: absolute;
                                        top: 8px;
                                        right: 20px;
                                        color: #fca311;
                                    }

                                    .card-box {
                                        background-color: #fca311;
                                        padding: 10px;
                                        color: #14213d;
                                        width: 100%;
                                        font-weight: 500;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        transition: 0.3s;
                                        flex-wrap: wrap;
                                        border-radius: 50px;
                                        border: 1px solid rgba(255, 255, 255, 0.5);
                                    }

                                    .card-box:hover {
                                        background-color: #14213d;
                                        color: #fca311;
                                        box-shadow: none;
                                        cursor: pointer;
                                    }

                                    .img-left {
                                        width: 100%;
                                        object-fit: cover;
                                        height: 100%;
                                    }

                                    .card {
                                        margin-bottom: 24px;
                                        box-shadow: 0px 0px 25px 0px rgba(0, 0, 0, 0.7);
                                        border-radius: 22px;
                                        position: relative;
                                        z-index: 10;
                                    }

                                    .reblateText {
                                        color: #14213d;
                                        font-family: 'Poppins';
                                        font-size: 50px;
                                        font-weight: 800;
                                    }

                                    .reblateSubText {
                                        color: #14213d;
                                        font-family: 'Poppins';
                                        font-size: 30px;
                                        font-weight: 200;
                                    }

                                    .stylingImage {
                                        left: -190px;
                                        bottom: -30px;
                                    }

                                    .stylingImagePic {
                                        width: 1200px;
                                        max-width: 450px;
                                    }

                                    @media (max-width: 768px) {
                                        .reblateText {
                                            font-size: 40px;
                                        }

                                        .reblateSubText {
                                            font-size: 25px;
                                        }

                                        .stylingImage {
                                            left: -80px;
                                            bottom: -30px;
                                        }

                                        .stylingImagePic {
                                            width: 1200px;
                                            max-width: 600px;
                                        }
                                    }

                                    .boxing {
                                        width: 500px;
                                        height: 500px;
                                        background-color: #fca31110;
                                        position: absolute;
                                        border-radius: 50px;
                                        transform: rotate(-28deg);
                                        top: -400px;
                                        right: -340px;
                                    }

                                    .boxing2 {
                                        width: 500px;
                                        height: 500px;
                                        background-color: #fca31110;
                                        position: absolute;
                                        border-radius: 50px;
                                        transform: rotate(-28deg);
                                        bottom: 40px;
                                        top: 80px;
                                        left: -450px;
                                    }
                                </style>


                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0" style="min-height: 530px; ">
                                        <div class="col-lg-6 d-flex align-items-center justify-content-left p-5"
                                            style="backdrop-filter: blur(5px); background-color: #F1F2F3;">
                                            <div class="boxing"></div>
                                            <div class="boxing2"></div>

                                            <div class="d-flex flex-column" style="width: 80%">
                                                <h1 class="reblateText mb-0" style="color: #fca311;font-size: 45px">Welcome Back !</h1>
                                                <p class="reblateSubText " style="color: #14213d; font-size: 18px;font-weight: 400">Please enter your detials</p>
                                                    <form method="post" action="/admin-login" class="auth-input">
                                                        @csrf


                                                        @if (session()->has('error'))
                                                            <div class="alert alert-danger alert-dismissible fade show"
                                                                id="close-now">
                                                                {{ session('error') }}
                                                            </div>
                                                        @endif

                                                        @if (session('error_login'))
                                                            <div class="alert alert-danger alert-dismissible fade show"
                                                                id="hideme">
                                                                {{ session('error_login') }}
                                                                <a type="button" class="close" data-dismiss="alert"
                                                                    onclick="hideNow()" aria-label="Close"
                                                                    style="float: right;">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </a>
                                                            </div>
                                                        @endif

                                                        <div class="mb-2 d-flex inputboxcolor mb-3 form-control @error('admin_email') is-invalid @enderror" style="border: 1px solid #14213d; border-radius:50px; background-color: white;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#9e9e9e" class="bi bi-envelope" viewBox="0 0 16 16">
                                                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                                                              </svg>
                                                            <input id="text" type="email"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%; padding:0;"

                                                                name="admin_email" value="{{ old('admin_email') }}"
                                                                placeholder="Enter Email" autocomplete="email">
                                                            @error('admin_email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3 d-flex form-control inputboxcolor @error('user_password') is-invalid @enderror" style="border: 1px solid #14213d; border-radius:50px; background-color: white;">
                                                            <svg fill="#9e9e9e" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="XMLID_509_"> <path id="XMLID_510_" d="M65,330h200c8.284,0,15-6.716,15-15V145c0-8.284-6.716-15-15-15h-15V85c0-46.869-38.131-85-85-85 S80,38.131,80,85v45H65c-8.284,0-15,6.716-15,15v170C50,323.284,56.716,330,65,330z M180,234.986V255c0,8.284-6.716,15-15,15 s-15-6.716-15-15v-20.014c-6.068-4.565-10-11.824-10-19.986c0-13.785,11.215-25,25-25s25,11.215,25,25 C190,223.162,186.068,230.421,180,234.986z M110,85c0-30.327,24.673-55,55-55s55,24.673,55,55v45H110V85z"></path> </g> </g></svg>
                                                            <input type="password"
                                                                style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%;padding:0;"

                                                                placeholder="Enter password" id="password"
                                                                name="user_password" autocomplete="current-password">
                                                            @error('user_password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                        <div class="form-check mb-1 ms-3">

                                                            <input class="form-check-input" type="checkbox" onclick="togglePasswordVisibility()">
                                                            <label style="color: #14213d;" for="showPassword">Show
                                                                Password</label>

                                                        </div>
                                                        <div class="form-check d-flex justify-content-between">
                                                            <div class="ms-3">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="remember" id="remember"
                                                                    {{ old('remember') ? 'checked' : '' }}>
                                                                <label class="form-check-label" style="color: #14213d"
                                                                    for="remember">Remember
                                                                    me</label>
                                                            </div>
                                                            <a href="/forget-password" class="text-end"
                                                            style="color: #fca311">Forget Password?</a>
                                                        </div>

                                                        <div class="mt-4">
                                                            <button class="card-box font-size-18 w-50 mx-auto px-4 py-2" type="submit">Sign
                                                                In</button>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="position-absolute w-75" style="bottom: 10px; text-align:center;">
                                                    <a class="mx-2" style="color: #14213d; font-weight:100;" href="https://reblatesols.com/privacy-policy">Privacy Policy</a>
                                                    <a class="mx-2" style="color: #14213d; font-weight:100;" href="https://reblatesols.com/terms-and-condition">Terms & Conditions</a>
                                                </div>
                                        </div>

                                        <div class="col-lg-6"
                                            style="backdrop-filter: blur(5px); background-color: #14213d;">

                                            <div class="px-5 pt-3">
                                                <div class="">
                                                    <h1 class="reblateText mb-0 pt-4" style="color: #fca311; font-size: 60px;">Admin</h1>
                                                    <h1 class="reblateSubText my-0" style="color: #fff">Login Detail</h1>
                                                </div>

                                                <div class="stylingImage d-flex justify-content-center">
                                                    <img class="stylingImagePic" src="{{ url('adminLogoFront.png') }}" alt="Employee Logo">
                                                </div>
{{--
                                                    <form method="post" action="/admin-login" class="auth-input">
                                                        @csrf


                                                        @if (session()->has('error'))
                                                            <div class="alert alert-danger alert-dismissible fade show"
                                                                id="close-now">
                                                                {{ session('error') }}
                                                            </div>
                                                        @endif

                                                        @if (session('error_login'))
                                                            <div class="alert alert-danger alert-dismissible fade show"
                                                                id="hideme">
                                                                {{ session('error_login') }}
                                                                <a type="button" class="close" data-dismiss="alert"
                                                                    onclick="hideNow()" aria-label="Close"
                                                                    style="float: right;">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </a>
                                                            </div>
                                                        @endif

                                                        <div class="mb-2">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input id="text" type="email"
                                                                style="border: 1px solid rgba(255, 255, 255, 0.5);  background-color: rgba(255, 255, 255, 0.5);"
                                                                class="form-control inputboxcolor @error('admin_email') is-invalid @enderror"
                                                                name="admin_email" value="{{ old('admin_email') }}"
                                                                placeholder="" autocomplete="email">
                                                            @error('admin_email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" for="password-input">Password</label>
                                                            <input type="password"
                                                                style="border: 1px solid rgba(255, 255, 255, 0.5);  background-color: rgba(255, 255, 255, 0.5);"
                                                                class="form-control inputboxcolor @error('user_password') is-invalid @enderror"
                                                                placeholder="Enter password" id="password"
                                                                name="user_password" autocomplete="current-password">
                                                            @error('user_password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>


                                                        <div class="mb-3">

                                                            <input type="checkbox" onclick="togglePasswordVisibility()">
                                                            <label class="text-light" for="showPassword">Show
                                                                Password</label>

                                                        </div>
                                                        <div class="form-check d-flex justify-content-between">
                                                            <div>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="remember" id="remember"
                                                                    {{ old('remember') ? 'checked' : '' }}>
                                                                <label class="form-check-label text-light"
                                                                    for="remember">Remember
                                                                    me</label>
                                                            </div>
                                                            <a href="/forget-password" class="text-end"
                                                                style="color: lightgray">Forget Password?</a>
                                                        </div>

                                                        <div class="mt-4">
                                                            <button class="card-box px-4 py-2 w-100" type="submit">Sign
                                                                In</button>
                                                        </div>

                                                    </form> --}}
                                                </div>
                                                <a href="/login" class="go-back"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1em" height="1em" viewBox="0 0 24 24">
                                                        <path fill="#fca311"
                                                            d="m4 10l-.707.707L2.586 10l.707-.707zm17 8a1 1 0 1 1-2 0zM8.293 15.707l-5-5l1.414-1.414l5 5zm-5-6.414l5-5l1.414 1.414l-5 5zM4 9h10v2H4zm17 7v2h-2v-2zm-7-7a7 7 0 0 1 7 7h-2a5 5 0 0 0-5-5z" />
                                                    </svg> Go Back</a>

                                            </div>
                                        </div>

                                </div>
                                <!-- end card -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const checkbox = document.querySelector('input[type="checkbox"]');

            passwordInput.type = checkbox.checked ? 'text' : 'password';
        }

        function hideNow() {
            var divElement = document.getElementById('close-now');
            divElement.style.display = 'none';
        }
    </script>
@endsection
@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
