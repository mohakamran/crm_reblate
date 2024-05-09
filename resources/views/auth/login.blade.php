@extends('layouts.master-without-nav')
@section('title')
    Login
@endsection
@section('content')
    <div class="d-flex align-items-center min-vh-100 background-circle" style="background-color:#F1F2F3 ">
        <img src="{{ URL::asset('/Vector.svg') }}" class="vector" alt="logo" class="logo">
        <img src="{{ URL::asset('/Vector2.svg') }}" class="vector2" alt="logo" class="logo">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-11 col-lg-11 col-xl-11">
                    <div class="auth-full-page-content d-flex min-vh-100">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100 py-0 py-xl-3">

                                <style>
                                    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
                                    .vector2{
                                        position: absolute;
                                        left: 0;
                                        bottom: 0;
                                        width: 350px;
                                    }
                                    .vector{
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
                                        background:#fca311;
                                        clip-path: circle(4% at  94% 86%);
                                    }

                                    .card {
                                        margin-bottom: 24px;
                                        box-shadow: 0px 0px 25px 0px rgba(0, 0, 0, 0.7);
                                        border-radius: 22px;
                                        position: relative;
                                        z-index: 10;
                                    }

                                    .card-box {
                                        font-size: 18px;
                                        font-weight: 700;
                                        background-color: #14213d;
                                        padding: 5px 50px;
                                        color: #fca311;
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
                                        background: #fca311;
                                        color: #14213d;
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
                                        color: #14213d;
                                        font-family: 'Poppins';
                                        font-size: 50px;
                                        font-weight: 800;
                                        /* letter-spacing: 5px; */
                                    }
                                    .reblateSubText{
                                        color: #14213d;
                                        font-family: 'Poppins';
                                        font-size: 30px;
                                        font-weight: 200;
                                    }

                                    .login-mine-way {
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        flex-direction: column;
                                        gap: 10px;
                                        flex-wrap: wrap;
                                    }
                                    .stylingImage{
                                        left: -190px;
                                        bottom:-30px;
                                    }
                                    .stylingImagePic{
                                        width: 1200px; max-width: 680px;
                                    }
                                    @media (max-width: 768px) {
                                        .reblateText{
                                            font-size: 40px;
                                        }
                                        .reblateSubText{
                                            font-size: 25px;
                                        }
                                        .stylingImage{
                                        left: -80px;
                                        bottom:-30px;
                                    }
                                    .stylingImagePic{
                                        width: 1200px;
                                        max-width: 600px;
                                    }
                                    }
                                    .boxing{
                                        width: 500px;
                                        height: 500px;
                                        background-color: #fca31110;
                                        position: absolute;
                                        border-radius:50px;
                                        transform: rotate(-28deg);
                                        top: -400px;
                                        right: -340px;
                                    }
                                    .boxing2{
                                        width: 500px;
                                        height: 500px;
                                        background-color: #fca31110;
                                        position: absolute;
                                        border-radius:50px;
                                        transform: rotate(-28deg);
                                        bottom: 40px;
                                        top: 235px;
                                        left: -450px;
                                    }

                                </style>


                                <div class="card my-auto overflow-hidden">
                                    <div class="row g-0" style="min-height: 530px; ">
                                        <div class="col-lg-6 d-flex align-items-center justify-content-center"
                                            style="backdrop-filter: blur(5px); background-color: #F1F2F3;">
                                            <div class="boxing"></div>
                                            <div class="boxing2"></div>
                                            <div class="d-flex flex-column align-items-center p-sm-3">
                                                <img src="{{ url('reblate.png') }}" style="width:190px; object-fit:cover;"
                                                alt="Reblate Solutions Logo">
                                                <h1 class="reblateText mb-0" >Reblate Solutions</h1>
                                                <h1 class="reblateSubText" style="border-bottom: 1px solid #14213d">& Service Providers</h1>
                                                <div>
                                                    <div class="my-2">
                                                        <a href="/admin-login" style="font-size:17px;text-align:center;">
                                                            <button type="button" class="btn card-box">
                                                                Admin
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="my-2">
                                                        <a href="/manager-login" style="font-size:17px;text-align:center;">
                                                            <button type="button" class="btn card-box">
                                                                Manager
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="my-2">
                                                        <a href="/employee-login" style="font-size:17px;text-align:center;">
                                                            <button type="button" class="btn card-box">
                                                                Employee
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="my-2">
                                                        <a href="/client-login" style="font-size:17px;text-align:center;">
                                                            <button type="button" class="btn card-box">
                                                                Client
                                                            </button>
                                                        </a>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 d-flex align-items-left flex-column flex-wrap pb-5 justify-content-center"
                                            style="backdrop-filter: blur(5px); background-color: #14213d;">
                                            <div class="px-5 pt-3">
                                                <h1 class="reblateText mb-0 pt-4" style="color: #fca311; font-size: 60px;">Welcome</h1>
                                                <h1 class="reblateSubText my-0" style="color: #fff">Reblate CMS</h1>
                                            </div>

                                            <div class="row container" style="">
                                                <img class="" style="" src="{{ url('logoFront.png') }}" alt="">
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
