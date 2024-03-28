@extends('layouts.master-without-nav')
@section('title')
    Client Login
@endsection
@section('content')
    <div class="d-flex align-items-center min-vh-100" style="background-color:lightgray">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">

                                <style>
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
                                        background-color: #14213d;
                                        /* Background color when checked */
                                        border-color: #14213d;
                                        /* Border color when checked */
                                    }

                                    /* Custom styles for the checkmark inside the checkbox */
                                    input[type="checkbox"]::before {
                                        content: '\2713';
                                        /* Unicode checkmark character */
                                        display: block;
                                        width: 16px;
                                        height: 16px;
                                        text-align: center;
                                        line-height: 16px;
                                        color: white;
                                        /* Checkmark color */
                                        font-size: 12px;
                                    }

                                    .card {
                                        margin-bottom: 24px;
                                        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.4);
                                        border-radius: 22px;
                                        position: relative;
                                    }

                                    .card-box {
                                        background: #fff;
                                        box-shadow: 1px 1px 1px 2px rgba(0, 0, 0, 0.3);
                                        /* padding: 10px; */
                                        height: 80px;
                                        border-radius: 3px;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        transition: 0.3s;
                                    }

                                    .card-box:hover {
                                        background: #14213d;
                                        color: #fff;
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
                                        color:#14213d;
                                    }

                                </style>


                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0">
                                        <div class="col-lg-6">
                                            <img src="{{ url('client.png') }}" class="img-left">
                                        </div>

                                        <div class="col-lg-6" style="background-color: #fff;">
                                            <div class="text-center  mt-2">
                                                <a href="https://reblatesols.com" class="" target="_blank">
                                                    <img src="{{ url('reblat-logo.png') }}" alt="" height="60"
                                                        class="auth-logo logo-dark mx-auto"
                                                        style="    margin-top: 30px;
                                                        object-fit: contain;">
                                                    <img src="{{ url('reblat-logo.png') }}" alt="" height="60"
                                                        class="auth-logo logo-light mx-auto">
                                                </a>
                                            </div>
                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="text-center mt-1">
                                                        <h4 class="font-size-18" style="color: #14213d;"> Client Dashboard!</h4>
                                                        <p class="text-muted">Sign in to continue to Reblate Solutions
                                                            Client  Dashboard!
                                                        </p>
                                                    </div>

                                                    <form method="post" action="/client-login" class="auth-input">
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
                                                                class="form-control inputboxcolor @error('client_email') is-invalid @enderror"
                                                                name="client_email" value="{{ old('client_email') }}" style="border: 1px solid gray"
                                                                autocomplete="email">
                                                            @error('client_email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" for="password-input">Password</label>
                                                            <input type="password"
                                                                class="form-control inputboxcolor @error('client_password') is-invalid @enderror"
                                                                placeholder="Enter password" id="password" style="border: 1px solid gray"
                                                                name="client_password" autocomplete="current-password">
                                                            @error('client_password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-3">

                                                            <input type="checkbox" onclick="togglePasswordVisibility()">
                                                            <label for="showPassword">Show Password</label>

                                                        </div>
                                                        <div class="form-check d-flex justify-content-between">
                                                            <div>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="remember" id="remember"
                                                                    {{ old('remember') ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="remember">Remember
                                                                    me</label>
                                                            </div>
                                                            <a href="/forget-password" class="text-end" style="color: gray">Forget Password?</a>
                                                        </div>

                                                        <div class="mt-4">
                                                            <button class="reblateBtn px-4 py-2 w-100" type="submit">Sign
                                                                In</button>

                                                        </div>


                                                    </form>

                                                    <a href="/login" class="go-back"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="#14213d" d="m4 10l-.707.707L2.586 10l.707-.707zm17 8a1 1 0 1 1-2 0zM8.293 15.707l-5-5l1.414-1.414l5 5zm-5-6.414l5-5l1.414 1.414l-5 5zM4 9h10v2H4zm17 7v2h-2v-2zm-7-7a7 7 0 0 1 7 7h-2a5 5 0 0 0-5-5z"/></svg> Go Back</a>
                                                </div>

                                                {{-- <div class="mt-4 text-center">
                                                    <p class="mb-0">Don't have an account ? <a
                                                            href="{{ route('register') }}" class="fw-medium text-primary">
                                                            Register </a> </p>
                                                </div> --}}
                                            </div>
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
