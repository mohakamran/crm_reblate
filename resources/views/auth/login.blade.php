@extends('layouts.master-without-nav')
@section('title')
    Login
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
                                    .card {
                                        margin-bottom: 24px;
                                        box-shadow: 0px 1px 18px 8px rgba(0, 0, 0, 0.4);
                                        border-radius: 22px;
                                    }

                                    .card-box {
                                        background: #fff;
                                        box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.3);
                                        padding: 10px;
                                        /* height: 80px; */
                                        width: 160px;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        transition: 0.3s;
                                        flex-wrap: wrap;
                                        border-radius: 10px;
                                        border: 1px solid #14213d;
                                    }

                                    .card-box:hover {
                                        background: #14213d;
                                        color: #fff;
                                        box-shadow: none;
                                        cursor: pointer;
                                    }

                                    .card-holder {
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        gap: 10px;
                                        flex-wrap: wrap;
                                        width: 100%;
                                    }

                                    /* a:hover {
                                            color: #fff;
                                        } */

                                    .login-mine-way {
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        flex-direction: column;
                                        gap: 10px;
                                        flex-wrap: wrap;
                                    }
                                </style>


                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0" style="min-height: 500px;">
                                        <div class="col-lg-6">
                                            <img src="{{ url('generalLogin.jpg') }}"
                                                style="width:100%; object-fit:cover;height:100%;" alt="">
                                        </div>

                                        <div class="col-lg-6"
                                            style=" background-color:#fff;   display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        flex-direction: column;
                                        flex-wrap: wrap;
                                        padding-bottom:20px;">
                                            <div class="text-center  mt-2">
                                                <a href="https://reblatesols.com" class="" target="_blank">
                                                    <img src="{{ url('reblat-logo.png') }}" alt="" height="60"
                                                        class="auth-logo logo-dark "
                                                        style="display: block; margin:20px auto; object-fit:contain;">
                                                </a>
                                                {{-- <p class="text-muted mt-2">User Experience & Interface Design Strategy Saas Solution</p> --}}
                                            </div>
                                            <div class="row container">
                                                <div class="col-md-6 col-sm-12  mt-2 mb-2">
                                                    <a href="/employee-login" style="font-size:17px;text-align:center;">
                                                        <button type="button" class="btn card-box">
                                                            Employee
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="col-md-6 col-sm-12  mt-2 mb-2">
                                                    <a href="/client-login" style="font-size:17px;text-align:center;">
                                                        <button type="button" class="btn card-box">
                                                            Client
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row container">
                                                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                                                    <a href="/admin-login" style="font-size:17px;text-align:center;">
                                                        <button type="button" class="btn card-box">
                                                            Admin
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="col-md-6 col-sm-12 mt-2 mb-2">
                                                    <a href="/manager-login" style="font-size:17px;text-align:center;">
                                                        <button type="button" class="btn card-box">
                                                            Manager
                                                        </button>
                                                    </a>
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
    </script>
@endsection
@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
