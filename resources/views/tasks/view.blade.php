@extends('layouts.master')
@section('title')
    Employee Tasks
@endsection
@section('page-title')
    Employee Tasks
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            .image-center {
                width: 140px;
                height: 140px;
                border-radius: 50%;
                object-fit: cover;
                display: block;
                margin: auto;

            }

            .card-text-center {
                font-size: 16px;
            }

            .emp-name {
                font-size: 20px;
                font-weight: 700;
                text-align: center;
                font-family: 'Poppins';
                margin-top: 15px;
            }

            .form {
            position: relative;
            top: 50%;
            left: 30px;
            transform: translate(-50%, -50%);
            transition: all 1s;
            width: 50px;
            height: 50px;
            background: white;
            box-sizing: border-box;
            border-radius: 25px;
            border: 4px solid white;
            padding: 5px;
        }

        input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;

            height: 42.5px;
            line-height: 30px;
            outline: 0;
            border: 0;
            display: none;
            font-size: 1em;
            border-radius: 20px;
            padding: 0 20px;
        }

        .form .bi {
            box-sizing: border-box;
            padding: 10px;
            width: 42.5px;
            height: 42.5px;
            position: absolute;
            top: 0;
            right: 0;
            border-radius: 50%;
            color: #07051a;
            text-align: center;
            font-size: 1.2em;
            transition: all 1s;
        }

        .form:hover,
        .form:valid {
            width: 300px;
            cursor: pointer;
            transform: translate(-39px, -26px)
        }

        .form:hover input,
        .form:valid input {
            display: block;
        }

        .form:hover .bi,
        .form:valid .bi {
            background: #fca311;
            color: #14213d;
        }
        </style>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body bg-light">
                        <form action="/search-emp-attendence" method="post">
                            <div class="row justify-content-between mx-1 "
                                style="background-color: #14213d; border-radius:10px; padding:10px;">

                                @csrf
                                <div class="ms-2 w-50">
                                    <div class="form">
                                        <input class="" type="text" name="emp_name"
                                            placeholder="Enter Employee Name...">
                                            <input type="hidden" value="task-page" name="emp_page">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black"
                                            class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg>
                                    </div>

                                </div>
                                <div class="w-25 d-flex gap-2 justify-content-end align-items-center">
                                    <div class="row">
                                        @if (isset($error) && $error != '')
                                            <p style="color:red;">{{ $error }}</p>
                                        @endif
                                    </div>


                                    {{-- <div class="dropdown">
                                        <button class=" dropdown-toggle" style="border: none; background-color:transparent;"
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span style="color: #fff; font-size: 15px;">Filters</span>
                                            <svg style="cursor: pointer; width: 30px; height:30px; margin-left:10px;"
                                                viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#fca311">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <title>filter-horizontal</title>
                                                    <g id="Layer_2" data-name="Layer 2">
                                                        <g id="invisible_box" data-name="invisible box">
                                                            <rect width="48" height="48" fill="none"></rect>
                                                        </g>
                                                        <g id="icons_Q2" data-name="icons Q2">
                                                            <path
                                                                d="M41.8,8H21.7A6.2,6.2,0,0,0,16,4a6,6,0,0,0-5.6,4H6.2A2.1,2.1,0,0,0,4,10a2.1,2.1,0,0,0,2.2,2h4.2A6,6,0,0,0,16,16a6.2,6.2,0,0,0,5.7-4H41.8A2.1,2.1,0,0,0,44,10,2.1,2.1,0,0,0,41.8,8ZM16,12a2,2,0,1,1,2-2A2,2,0,0,1,16,12Z">
                                                            </path>
                                                            <path
                                                                d="M41.8,22H37.7A6.2,6.2,0,0,0,32,18a6,6,0,0,0-5.6,4H6.2a2,2,0,1,0,0,4H26.4A6,6,0,0,0,32,30a6.2,6.2,0,0,0,5.7-4h4.1a2,2,0,1,0,0-4ZM32,26a2,2,0,1,1,2-2A2,2,0,0,1,32,26Z">
                                                            </path>
                                                            <path
                                                                d="M41.8,36H24.7A6.2,6.2,0,0,0,19,32a6,6,0,0,0-5.6,4H6.2a2,2,0,1,0,0,4h7.2A6,6,0,0,0,19,44a6.2,6.2,0,0,0,5.7-4H41.8a2,2,0,1,0,0-4ZM19,40a2,2,0,1,1,2-2A2,2,0,0,1,19,40Z">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                        <ul class="dropdown-menu" style="background-color: #fca311">
                                            <li class="px-2"><a class="dropdown-item"
                                                    style="color: #14213d; font-size:15px; border-bottom:1px solid #14213d"
                                                    href="/show-all-employees">All</a></li>
                                            <li class="px-2"><a class="dropdown-item"
                                                    style="color: #14213d; font-size:15px; border-bottom:1px solid #14213d"
                                                    href="/manage-employees">Active</a></li>
                                            <li class="px-2 pb-2"><a class="dropdown-item"
                                                    style="color: #14213d; font-size:15px; "
                                                    href="/terminated-employees">Terminated</a></li>
                                        </ul>
                                    </div> --}}
                                </div>
                            </div>
                        </form>
                        {{-- <form action="/search-emp-tasks" method="post">

                            @csrf
                            <div class="row justify-content-between"
                                style="background-color: #14213d; border-radius:10px; padding:10px;">

                                <div class="ms-2 w-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray"
                                        class="bi bi-search searchIcon" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg>
                                    <input class="form-control searchInput" type="text" name="emp_name"
                                        placeholder="Enter Employee Name..." style=" border:none;">
                                </div>


                                <div class="dropdown">
                                    <button class=" dropdown-toggle" style="border: none; background-color:transparent;" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span style="color: #fff; font-size: 15px;">Filters</span>
                                        <svg style="cursor: pointer; width: 30px; height:30px; margin-left:10px;"
                                            viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" fill="#fca311">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <title>filter-horizontal</title>
                                                <g id="Layer_2" data-name="Layer 2">
                                                    <g id="invisible_box" data-name="invisible box">
                                                        <rect width="48" height="48" fill="none"></rect>
                                                    </g>
                                                    <g id="icons_Q2" data-name="icons Q2">
                                                        <path
                                                            d="M41.8,8H21.7A6.2,6.2,0,0,0,16,4a6,6,0,0,0-5.6,4H6.2A2.1,2.1,0,0,0,4,10a2.1,2.1,0,0,0,2.2,2h4.2A6,6,0,0,0,16,16a6.2,6.2,0,0,0,5.7-4H41.8A2.1,2.1,0,0,0,44,10,2.1,2.1,0,0,0,41.8,8ZM16,12a2,2,0,1,1,2-2A2,2,0,0,1,16,12Z">
                                                        </path>
                                                        <path
                                                            d="M41.8,22H37.7A6.2,6.2,0,0,0,32,18a6,6,0,0,0-5.6,4H6.2a2,2,0,1,0,0,4H26.4A6,6,0,0,0,32,30a6.2,6.2,0,0,0,5.7-4h4.1a2,2,0,1,0,0-4ZM32,26a2,2,0,1,1,2-2A2,2,0,0,1,32,26Z">
                                                        </path>
                                                        <path
                                                            d="M41.8,36H24.7A6.2,6.2,0,0,0,19,32a6,6,0,0,0-5.6,4H6.2a2,2,0,1,0,0,4h7.2A6,6,0,0,0,19,44a6.2,6.2,0,0,0,5.7-4H41.8a2,2,0,1,0,0-4ZM19,40a2,2,0,1,1,2-2A2,2,0,0,1,19,40Z">
                                                        </path>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu" style="background-color: #fca311">
                                        <li class="px-2"><a class="dropdown-item"
                                                style="color: #14213d; font-size:15px; border-bottom:1px solid #14213d"
                                                href="/show-all-employees">All</a></li>
                                        <li class="px-2"><a class="dropdown-item"
                                                style="color: #14213d; font-size:15px; border-bottom:1px solid #14213d"
                                                href="/manage-employees">Active</a></li>
                                        <li class="px-2 pb-2"><a class="dropdown-item"
                                                style="color: #14213d; font-size:15px; "
                                                href="/terminated-employees">Terminated</a></li>
                                    </ul>
                                </div>
                            </div>


                        </form> --}}
                        {{-- <a href="/create-new-task" class="reblateBtn w-75" style="padding:10px;text-align:center"><span
                                style="width: 15px; height: 15px; margin-right: 5px;"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                </svg></span> Add New</a> --}}
                        <div class="row">
                            @if (isset($error) && $error != '')
                                <p style="color:red;">{{ $error }}</p>
                            @endif
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="card" style=" overflow: hidden; border-radius: 10px; box-shadow:none;">
                                    <div class="card-body"
                                        style="box-shadow: none; padding-top:9.5rem; padding-bottom:9.5rem; backdrop-filter: blur(0px); max-height: 350px;">
                                        <div class="d-flex flex-column justify-content-center align-items-center">
                                            <a href="/create-new-task" class="reblateBtn " style="padding: 14px;background-color: transparent;color:black"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="35" height="35"
                                                    fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                                </svg></a>
                                            <h3
                                                style="color: lightgrey; font-family:'Poppins'; margin-top:5px; font-size:18px;">
                                                Assign New Task</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach ($latestEmployees as $emp)
                                <div class="col-md-3">

                                    <div class="card hovering" style=" overflow: hidden; border-radius: 10px; ">
                                        <div class="card-body"
                                            style="box-shadow: none; backdrop-filter: blur(0px); padding:5px; max-height: 385px;">
                                            <img style="width: 18px; height: 18px; position: absolute; z-index: 100; left: 15px; top: 15px"
                                                src="{{ url('/tick.png') }}" alt="">
                                            <div>
                                                <svg style="width: 20px; height:20px; position:absolute; right:15px; top:15px; cursor:pointer"
                                                    viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#14213d"
                                                    class="bi bi-three-dots-vertical" stroke="#14213d">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z">
                                                        </path>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div
                                                style="background-color: #fca311; width:100%; height:120px; border-radius:10px;">

                                            </div>
                                            <div class="position-relative " style="z-index: 10; top:-90px;">
                                                @if ($emp->Emp_Image != null && file_exists(public_path($emp->Emp_Image)))
                                                    <a href="{{ $emp->Emp_Image }}" target="_blank"
                                                        style="display: flex; justify-content: center;">
                                                        <img class="image-center" src="{{ $emp->Emp_Image }}"
                                                            alt={{ $emp->Emp_Full_Name }} style="object-fit: cover;">
                                                    </a>
                                                @else
                                                    <a href="{{ url('user.png') }}" target="_blank"
                                                        style="display: flex; justify-content: center;">
                                                        <img class="image-center" src="{{ url('user.png') }}"
                                                            alt={{ $emp->Emp_Full_Name }} style="object-fit: cover;">
                                                    </a>
                                                @endif
                                                <div class="px-3">
                                                    <div class="card-text-center">
                                                        <div class="text-center">
                                                            <p class="emp-name mb-0" style="color: #14213d;">
                                                                {{ $emp->Emp_Full_Name }}</p>
                                                            <span style="font-size: 14px; ">{{ $emp->Emp_Designation }}
                                                            </span>
                                                        </div>
                                                        <div class="d-flex gap-1 align-items-center mb-2">
                                                            <p
                                                                style="ont-size: 14px; font-weight: 700; margin-bottom: 0px; color: #14213d; ">
                                                                Shift:</p>
                                                            <span style="font-size: 14px;">{{ $emp->Emp_Shift_Time }}
                                                            </span>
                                                        </div>
                                                        <div class="d-flex gap-1 align-items-center mb-2">
                                                            <p
                                                                style="font-size: 14px; font-weight: 700; margin-bottom: 0px; color: #14213d; ">
                                                                ID:</p>
                                                            <span style="font-size: 14px; ">{{ $emp->Emp_Code }}
                                                            </span>
                                                        </div>
                                                        <div class="d-flex gap-1 align-items-center mb-2">
                                                            <p
                                                                style="font-size: 14px; font-weight: 700; margin-bottom: 0px; color: #14213d; ">
                                                                DOB:</p>
                                                            <span style="font-size: 14px; ">01-11-2004
                                                            </span>
                                                        </div>
                                                        <form action="/view-tasks-employees" method="post">
                                                            @csrf
                                                            <input type="hidden" name="hidden_emp_value"
                                                                value="{{ $emp->Emp_Code }}">


                                                            <div class="text-center mt-3 container">
                                                                <button style="border:none;color:#14213d; background-color:transparent" >View Details</button>
                                                            </div>
                                                        </form>
                                                        {{-- <div class="d-flex gap-1 align-items-center mb-2">
                                                                    <p style="font-size: 17px; font-weight: 700; margin-bottom: 0px; color: #14213d; ">Task 1:</p>
                                                                    <span style="font-size: 14px; border-bottom: 1px solid #e3e3e3;">Pending </span>
                                                                </div> --}}
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- error message --}}

                {{-- employee dashboards --}}

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
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
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
