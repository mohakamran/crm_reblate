@extends('layouts.master-without-nav')
@section('title')
    Forget Password
@endsection
@section('content')
    <div class="d-flex align-items-center min-vh-100 background-circle" style="background-color:#F1F2F3 ">
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

                                    .card {
                                        margin-bottom: 24px;
                                        box-shadow: 0px 0px 25px 0px rgba(0, 0, 0, 0.7);
                                        border-radius: 22px;
                                        position: relative;
                                        z-index: 10;
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

                                    .go-back {
                                        position: absolute;
                                        top: 8px;
                                        right: 20px;
                                        color: #fca311;
                                    }

                                    .reblateText {
                                        color: #14213d;
                                        font-family: 'Poppins';
                                        font-size: 50px;
                                        font-weight: 800;
                                        /* letter-spacing: 5px; */
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
                                            <div class="d-flex flex-column " style="width: 80%">
                                                <h1 class="reblateText mb-0" style="color: #fca311;font-size: 42px">Forget
                                                    Password !</h1>
                                                <p class="reblateSubText "
                                                    style="color: #14213d; font-size: 18px;font-weight: 400">Please enter
                                                    your registered E-mail</p>
                                                <form method="post" action="/forget-password" class="auth-input">
                                                    @csrf


                                                    @if (session()->has('user_role'))
                                                        <div class="alert alert-danger alert-dismissible fade show"
                                                            id="close-now">
                                                            {{ session('user_role') }}

                                                        </div>
                                                    @endif
                                                    @if (session()->has('message'))
                                                        <div class="alert alert-success alert-dismissible fade show"
                                                            id="close-now">
                                                            {{ session('message') }}

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
                                                    <div class="mb-3">
                                                        <label for="user_type" class="mb-3" style="color: #14213d; font-weight:500;font-size:18px;">User Type:</label>
                                                        <div class="d-flex w-50 justify-content-between align-items-center">
                                                            <div class="w-25">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        id="client" name="user_type" value="client"
                                                                        {{ old('user_type') == 'client' ? 'checked' : '' }}>
                                                                    <label class="form-check-label reblateSubText ms-2" style="font-size:15px;font-weight:300; "
                                                                        for="client">Client</label>
                                                                </div>
                                                            </div>
                                                            <div class="w-25">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        id="admin" name="user_type" value="admin"
                                                                        {{ old('user_type') == 'admin' ? 'checked' : '' }}>
                                                                    <label class="form-check-label reblateSubText ms-2" style="font-size:15px;font-weight:300; "
                                                                        for="admin">Admin</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex w-50 justify-content-between align-items-center">
                                                            <div class="w-25">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        id="employee" name="user_type" value="employee"
                                                                        {{ old('user_type') == 'employee' ? 'checked' : '' }}>
                                                                    <label class="form-check-label reblateSubText ms-2" style="font-size:15px;font-weight:300; "
                                                                        for="employee">Employee</label>
                                                                </div>
                                                            </div>
                                                            <div class="w-25">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        id="manager" name="user_type" value="manager"
                                                                        {{ old('user_type') == 'manager' ? 'checked' : '' }}>
                                                                    <label class="form-check-label reblateSubText ms-2" style="font-size:15px;font-weight:300; "
                                                                        for="employee">Manager</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('user_type ')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-2 d-flex inputboxcolor mb-3 form-control @error('client_email') is-invalid @enderror" style="border: 1px solid #14213d; border-radius:50px; background-color: white;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#9e9e9e" class="bi bi-envelope" viewBox="0 0 16 16">
                                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                                                          </svg>
                                                        <input id="text" type="email"
                                                        style="border: none; margin-left: 10px; background-color:transparent; outline: none;width:100%"
                                                        placeholder="Enter your email"
                                                            name="client_email" value="{{ old('client_email') }}"
                                                            autocomplete="email">
                                                        @error('client_email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="mt-4">
                                                        <button class="card-box font-size-18 w-75 mx-auto px-4 py-2 "
                                                            type="submit">Send Me
                                                            Password!</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="position-absolute w-75" style="bottom: 10px; text-align:center;">
                                                <a class="mx-2" style="color: #14213d; font-weight:100;" href="https://reblatesols.com/privacy-policy">Privacy Policy</a>
                                                <a class="mx-2" style="color: #14213d; font-weight:100;" href="https://reblatesols.com/terms-and-condition">Terms & Conditions</a>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 p-3" style="backdrop-filter: blur(5px); background-color: #14213d;">
                                            <div class="stylingImage d-flex justify-content-center align-items-center">
                                                <img class="stylingImagePic" src="{{ url('forgetLogoFront.png') }}" alt="Employee Logo">
                                            </div>


                                                    <a href="/login" class="go-back"><svg
                                                            xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="#fca311"
                                                                d="m4 10l-.707.707L2.586 10l.707-.707zm17 8a1 1 0 1 1-2 0zM8.293 15.707l-5-5l1.414-1.414l5 5zm-5-6.414l5-5l1.414 1.414l-5 5zM4 9h10v2H4zm17 7v2h-2v-2zm-7-7a7 7 0 0 1 7 7h-2a5 5 0 0 0-5-5z" />
                                                        </svg> Main Login</a>

                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->

                                {{-- <div class="mt-5 text-center">
                                    <p class="mb-0">©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script> Tocly. Crafted with <i
                                            class="mdi mdi-heart text-danger"></i> by Themesdesign
                                    </p>
                                </div> --}}
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
        // function togglePasswordVisibility() {
        //     const passwordInput = document.getElementById('password');
        //     const checkbox = document.querySelector('input[type="checkbox"]');

        //     passwordInput.type = checkbox.checked ? 'text' : 'password';
        // }

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
