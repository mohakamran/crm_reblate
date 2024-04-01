@extends('layouts.master')
@section('title')
    Projects
@endsection
@section('page-title')
    Projects
@endsection
@section('body')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <body data-sidebar="colored">
    @endsection
    @section('content')
    <style>
         .style {
            background-color: #fff;
            box-shadow: 0px 0px 4px 4px #e3e3e3;
            margin-top: 5px;
            border-radius: 10px;
        }
        .frame1 {
            visibility: hidden;

        }
    </style>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row justify-content-center">

                                @csrf
                                <div class="col-md-2 inputboxcolor" style="border: 1px solid #c7c7c7;">
                                    <input class="form-control" type="text" name="emp_id" placeholder="Employee ID"
                                        style="background-color: transparent; border:none;">
                                </div>
                                <div class="col-md-2 inputboxcolor"style="border: 1px solid #c7c7c7;">
                                    <input class="form-control" type="text" name="emp_name" placeholder="Employee Name"
                                        style="background-color: transparent; border:none;">
                                </div>
                                <div class="col-md-2 inputboxcolor" style=" border: 1px solid #c7c7c7;">
                                    <select name="emp_designation" class="form-control" id=""
                                        style="background-color: transparent; border:none;">
                                        <option value="" selected disabled>Select a designation</option>
                                        <option value="Operations Manager">Operations Manager</option>
                                        <option value="Web Development">Web Development</option>
                                        <option value="Graphic Designer">Graphic Designer</option>
                                        <option value="Virtual Assistant">Virtual Assistant</option>
                                    </select>
                                </div>
                                <div class="col-md-2 inputboxcolor" style="border: 1px solid #c7c7c7;">
                                    <select name="emp_shift" class="form-control" id=""
                                        style="background-color: transparent; border:none;">
                                        <option value="" selected disabled>Select Shift</option>
                                        <option value="Morning">Morning</option>
                                        <option value="Night">Night</option>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex gap-2 justify-content-end">
                                    <button class="reblateBtn " style="padding: 10px 13px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg></button>
                                    <a href="/add-new" class="reblateBtn " style="padding: 10px 14px;"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                        </svg></a>
                                </div>
                            </div>
                        </form>


                    </div>

                </div>

            </div>

        </div>
        <div class="row ">
            <div class="card">
                <div class="card-body">
                    <div class="row mx-4 gap-3">
                        <div class="col-sm-12 col-md-3 col-xl-3" style="border: 1px solid #959697; border-radius:10px">
                            <div class="w-100 d-flex justify-content-end position-absolute" style="right: 18px; top: 0;">
                                <div class="position-relative" style="right:-40px; top:6px"  onclick="toggleFun()">
                                    <svg fill="#000000" width="30" height="30" viewBox="0 0 256 256" id="Flat" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M116,64a12,12,0,1,1,12,12A12.01375,12.01375,0,0,1,116,64Zm12,52a12,12,0,1,0,12,12A12.01375,12.01375,0,0,0,128,116Zm0,64a12,12,0,1,0,12,12A12.01375,12.01375,0,0,0,128,180Z"></path> </g></svg>
                                    <div id="toggleID" class="frame1" style="  position: relative;
                                    left:-37px;">
                                        <ul class="info" style="padding: 10px; ">
                                            <li style="list-style: none;"><a href="javascript:void()" style="color: #000">Edit</a></li>
                                            <li style="list-style: none;"><a href="javascript:void()" style="color: #000">View</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="my-2 pb-3">
                                <h4 style="color: #000; mb-0">Project Title</h4>
                                <p style="color:#9c9c9c"> <span style="color:green">1</span> task complete, <span style="color:red">4</span> tasks pending </p>
                                <p style="color:#9c9c9c; font-weight: 500">
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Fuga placeat eum repudiandae sunt sapiente at. Praesentium natus recusandae, quisquam repellendus quidem odit eaque sequi voluptatum voluptate! Earum nulla laboriosam distinctio!
                                </p>
                                <h6 style="color: #000; margin-bottom:0">Deadline</h6>
                                <p>Deadline</p>
                                <h6 style="color: #000; margin-bottom:0">Client</h6>
                                <p>Client Name</p>
                                <h6 style="color: #000; margin-bottom:0">Team</h6>
                                <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" style="width: 25px; height: 25px; margin:10px 0; border-radius: 50%; " alt="">
                                <div class="progress" style="height: 20px" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 25%">25%</div>
                                  </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!-- end row -->

        <script>
            function toggleFun() {
                var card = document.getElementById('toggleID');
                if (card.classList.contains("frame1")) {
                    card.classList.remove("frame1");
                    card.classList.add("style");
                    console.log(card.classList);
                } else {
                    card.classList.add("frame1");
                    card.classList.remove("style");

                }
            }

        </script>

    @endsection
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
