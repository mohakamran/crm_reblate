@extends('layouts.master-without-nav')
@section('title')
    Employee Login
@endsection
@section('content')
    <div class="auth-maintenance d-flex align-items-center min-vh-100">
        <div class="bg-overlay"></div>
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
                                        width: 16px;
                                        height: 16px;
                                        border: 2px solid #14213d;
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
                                        box-shadow: 0px 1px 18px 8px rgba(0, 0, 0, 0.4);
                                        border-radius: 22px;
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
                                            <img src="{{ url('emp-image.png') }}" class="img-left">
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="text-center  mt-2">
                                                <a href="https://reblatesols.com" class="" target="_blank">
                                                    <img src="{{ url('reblat-logo.png') }}" alt="" height="60"
                                                        class="auth-logo logo-dark mx-auto"
                                                        style="    margin-top: 30px;
                                                        object-fit: contain;">
                                                    <img src="{{ url('reblat-logo.png') }}" alt="" height="60"
                                                        class="auth-logo logo-light mx-auto">
                                                </a>
                                                {{-- <p class="text-muted mt-2">User Experience & Interface Design Strategy Saas Solution</p> --}}
                                            </div>
                                            <div class="p-lg-5 p-4">
                                                <div>
                                                    <div class="text-center mt-1">
                                                        <h4 class="font-size-18"> Employee Dashboard!</h4>
                                                        <p class="text-muted">Sign in to continue to Reblate Solutions
                                                            Employee Dashboard!
                                                        </p>
                                                    </div>

                                                    <form method="post" action="/employee-login" class="auth-input">
                                                        @csrf

                                                        @if (session()->has('error'))
                                                            <div class="alert alert-danger alert-dismissible fade show"
                                                                id="close-now">
                                                                {{ session('error') }}
                                                                {{-- <a type="button" class="close" data-dismiss="alert"
                                                                    aria-label="Close" style="float: right;">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </a> --}}
                                                            </div>
                                                        @endif

                                                        @if (session('error_login'))
                                                            <div class="alert alert-danger fade show" id="hideme">
                                                                {{ session('error_login') }}
                                                                {{-- <a type="button" class="close" data-dismiss="alert"
                                                                    onclick="hideNow()" aria-label="Close"
                                                                    style="float: right;">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </a> --}}
                                                            </div>
                                                        @endif

                                                        <div class="mb-2">
                                                            <label for="text" class="form-label">Emp Code</label>
                                                            <input id="text" type="text"
                                                                class="form-control @error('employee_code') is-invalid @enderror"
                                                                name="employee_code" value="{{ old('employee_code') }}"
                                                                placeholder="Emp Code" maxlength="8">
                                                            @error('employee_code')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label" for="password-input">Password</label>
                                                            <input type="password"
                                                                class="form-control @error('user_password') is-invalid @enderror"
                                                                placeholder="Enter password" id="password"
                                                                name="user_password" autocomplete="current-password">
                                                            @error('user_password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        {{-- <div class="mb-3">
                                                              <label for="password" class="form-label">Password</label>
                                                              <div class="input-group">
                                                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                                                                <div class="input-group-append">

                                                                </div>
                                                              </div>
                                                            </div> --}}

                                                        <div class="mb-3">

                                                            <input type="checkbox" onclick="togglePasswordVisibility()">
                                                            <label for="showPassword">Show Password</label>

                                                        </div>

                                                        {{--
                                                        <div class="mb-3">
                                                            <div class="form-floating mb-3">
                                                                <select name="employee_type" class="form-control @error('employee_type') is-invalid @enderror" id="">
                                                                    <option value="" disabled selected>Select Employee Type</option>
                                                                    <option value="employee" {{ old('employee_type') == 'employee' ? 'selected' : '' }}>Employee</option>
                                                                    <option value="manager" {{ old('employee_type') == 'manager' ? 'selected' : '' }}>Manager</option>
                                                                </select>
                                                                <label for="">Employee Type </label>
                                                            </div>
                                                            @error('employee_type')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div> --}}

                                                        <div class="form-check d-flex justify-content-between">
                                                            <div>
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="remember" id="remember"
                                                                    {{ old('remember') ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="remember">Remember
                                                                    me</label>
                                                            </div>
                                                            <a href="/forget-password" class="text-end">Forget Password?</a>
                                                        </div>

                                                        <div class="mt-4">
                                                            <button class="btn btn-primary w-100"
                                                                style="background:#14213d;" type="submit">Sign
                                                                In</button>
                                                        </div>

                                                        {{-- <div class="mt-4 pt-2 text-center">
                                                            <div class="signin-other-title">
                                                                <h5 class="font-size-14 mb-4 title">Sign In with</h5>
                                                            </div>
                                                            <div class="pt-2 hstack gap-2 justify-content-center">
                                                                <button type="button" class="btn btn-primary btn-sm"><i
                                                                        class="ri-facebook-fill font-size-16"></i></button>
                                                                <button type="button" class="btn btn-danger btn-sm"><i
                                                                        class="ri-google-fill font-size-16"></i></button>
                                                                <button type="button" class="btn btn-dark btn-sm"><i
                                                                        class="ri-github-fill font-size-16"></i></button>
                                                                <button type="button" class="btn btn-info btn-sm"><i
                                                                        class="ri-twitter-fill font-size-16"></i></button>
                                                            </div>
                                                        </div> --}}
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
