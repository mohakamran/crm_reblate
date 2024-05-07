@extends('layouts.master-without-nav')
@section('title')
    Login
@endsection
@section('content')
    <div class="d-flex align-items-center min-vh-100 background-circle" style="background-color:#161623 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="auth-full-page-content d-flex min-vh-100 py-sm-5 py-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">

                                <style>
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
                                        background:#fca311;
                                        clip-path: circle(30% at right 90%);
                                    }

                                    .card {
                                        margin-bottom: 24px;
                                        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.4);
                                        border-radius: 22px;
                                        position: relative;
                                        z-index: 10;
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

                                    .card-holder {
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        gap: 10px;
                                        flex-wrap: wrap;
                                        width: 100%;
                                    }
                                    .reblateText{
                                        color: white;
                                        font-size: 35px;
                                        font-weight: 500;
                                        letter-spacing: 5px;
                                    }
                                    .reblateSubText{
                                        color: white;
                                        font-size: 35px;
                                        letter-spacing: 3.5px;
                                    }

                                    .login-mine-way {
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        flex-direction: column;
                                        gap: 10px;
                                        flex-wrap: wrap;
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
                                    <div class="row g-0" style="min-height: 500px; ">
                                        <div class="col-lg-6 d-flex align-items-center justify-content-center"
                                            style="backdrop-filter: blur(5px); background-color: rgba(255, 255, 255, 0.1);">
                                            <img src="{{ url('reblate.png') }}" style="width:90%; object-fit:cover;"
                                                alt="Reblate Solutions Logo">
                                        </div>

                                        <div class="col-lg-6 d-flex align-items-center flex-column flex-wrap pb-5 justify-content-center"
                                            style="backdrop-filter: blur(5px); background-color: rgba(255, 255, 255, 0.1);">
                                            <div class="text-center  mt-2">
                                                <h1 class="reblateText">
                                                    Reblate Solutions </h1>
                                                <span class="reblateSubText">&
                                                    Service Providers</span>
                                                {{-- <a href="https://reblatesols.com" class="" target="_blank">
                                                    <img src="{{ url('fav-reblate.png') }}" alt="" height="60"
                                                        class="auth-logo logo-dark "
                                                        style="display: block; margin:20px auto; object-fit:contain;">
                                                </a> --}}
                                            </div>
                                            {{-- <div class="text-center">
                                                <div class="text-start">
                                                    <h1 style="color: black; font-size: 25px; font-weight: 200; letter-spacing: 5px; ">Welcome To <br> <span style="color: #14213d;font-size: 30px">Reblate </span><span style="color: #fca311; font-size: 30px">Solutions</span>  <br> & Service Providers</h1>
                                                </div>
                                            </div> --}}
                                            <div class="row container">
                                                <div class="col-md-6 col-sm-6 mt-2 mb-2">
                                                    <a href="/employee-login" style="font-size:17px;text-align:center;">
                                                        <button type="button" class="btn card-box">
                                                            Employee
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="col-md-6 col-sm-6 mt-2 mb-2">
                                                    <a href="/client-login" style="font-size:17px;text-align:center;">
                                                        <button type="button" class="btn card-box">
                                                            Client
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="col-md-6 col-sm-6 mt-2 mb-2">
                                                    <a href="/admin-login" style="font-size:17px;text-align:center;">
                                                        <button type="button" class="btn card-box">
                                                            Admin
                                                        </button>
                                                    </a>
                                                </div>
                                                <div class="col-md-6 col-sm-6 mt-2 mb-2">
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

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
