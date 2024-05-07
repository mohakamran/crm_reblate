@extends('layouts.master-without-nav')
@section('title')
    Admin Login
@endsection
@section('content')
    <div class=" d-flex align-items-center min-vh-100 background-circle" style="background-color:#161623 ">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">

                                <style>
                                    /* Custom checkbox style */
                                    .background-circle::before {
                                        content: '';
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        width: 100%;
                                        height: 100%;
                                        background: #2196f3;
                                        clip-path: circle(20% at 10% 10%);
                                    }

                                    .background-circle::after {
                                        content: '';
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        width: 100%;
                                        height: 100%;
                                        background: #fca311;
                                        clip-path: circle(30% at right 90%);
                                    }

                                    /* Custom checkbox style */
                                    input[type="checkbox"] {
                                        appearance: none;
                                        -webkit-appearance: none;
                                        -moz-appearance: none;
                                        width: 15px;
                                        height: 15px;
                                        border: 1px solid rgba(255, 255, 255, 0.5);
                                        /* Border color */
                                        border-radius: 4px;
                                        /* Border radius */
                                        outline: none;
                                        cursor: pointer;
                                    }

                                    /* Checked state */
                                    input[type="checkbox"]:checked {
                                        background-color: rgba(255, 255, 255, 0.5);
                                        /* Background color when checked */
                                        border-color: #fff;
                                        color: black !important;
                                        /* Border color when checked */
                                    }

                                    /* Custom styles for the checkmark inside the checkbox */
                                    input[type="checkbox"]::before {
                                        content: '\2713';
                                        /* Unicode checkmark character */
                                        display: block;
                                        width: 20px;
                                        height: 20px;
                                        text-align: center;
                                        line-height: 16px;
                                        color: white;
                                        /* Checkmark color */
                                        font-size: 12px;
                                    }

                                    .go-back {
                                        position: absolute;
                                        top: 8px;
                                        right: 20px;
                                        color: #fff;
                                    }

                                    .card-box {

                                        background-color: rgba(255, 255, 255, 0.3);
                                        padding: 10px;
                                        color: #fff;
                                        width: 100%;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        transition: 0.3s;
                                        flex-wrap: wrap;
                                        border-radius: 50px;
                                        border: 1px solid rgba(255, 255, 255, 0.5);
                                    }

                                    .card-box:hover {
                                        background: rgba(255, 255, 255, 0.5);
                                        color: #fff;
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
                                        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.4);
                                        border-radius: 22px;
                                        position: relative;
                                        z-index: 10;
                                    }
                                    .reblateText{
                                        color: white;
                                        font-size: 30px;
                                        font-weight: 500;
                                        letter-spacing: 5px;
                                    }
                                    .reblateSubText{
                                        color: white;
                                        font-size: 35px;
                                        letter-spacing: 3.5px;
                                    }
                                    @media (max-width: 768px) {
                                        .reblateText{
                                            font-size: 25px;
                                        }
                                        .reblateSubText{
                                            font-size: 25px;
                                        }
                                    }
                                </style>


                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-lg-6 d-flex align-items-center justify-content-center"
                                        style="backdrop-filter: blur(5px); background-color: rgba(255, 255, 255, 0.1);">
                                            <img src="{{ url('reblate.png') }}" style="width:90%; object-fit:cover;" alt="Reblate Solutions Logo">
                                        </div>

                                        <div class="col-lg-6" style="backdrop-filter: blur(5px); background-color: rgba(255, 255, 255, 0.1);">

                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="text-center mt-1">
                                                        <h4 class="reblateText" style="color: #fff;"> Admin Dashboard!
                                                        </h4>
                                                        <p style="color: lightgray">Sign in to continue to Reblate Solutions
                                                            Admin Dashboard!
                                                        </p>
                                                    </div>

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
                                                            <input type="password" style="border: 1px solid rgba(255, 255, 255, 0.5);  background-color: rgba(255, 255, 255, 0.5);"
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
                                                            <label class="text-light" for="showPassword">Show Password</label>

                                                        </div>
                                                        <div class="form-check d-flex justify-content-between">
                                                            <div>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="remember" id="remember"
                                                                    {{ old('remember') ? 'checked' : '' }}>
                                                                <label class="form-check-label text-light" for="remember">Remember
                                                                    me</label>
                                                            </div>
                                                            <a href="/forget-password" class="text-end"
                                                                style="color: lightgray">Forget Password?</a>
                                                        </div>

                                                        <div class="mt-4">
                                                            <button class="card-box px-4 py-2 w-100" type="submit">Sign
                                                                In</button>
                                                        </div>

                                                    </form>
                                                </div>
                                                <a href="/login" class="go-back"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="1em" height="1em" viewBox="0 0 24 24">
                                                        <path fill="#fff"
                                                            d="m4 10l-.707.707L2.586 10l.707-.707zm17 8a1 1 0 1 1-2 0zM8.293 15.707l-5-5l1.414-1.414l5 5zm-5-6.414l5-5l1.414 1.414l-5 5zM4 9h10v2H4zm17 7v2h-2v-2zm-7-7a7 7 0 0 1 7 7h-2a5 5 0 0 0-5-5z" />
                                                    </svg> Go Back</a>

                                            </div>
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
