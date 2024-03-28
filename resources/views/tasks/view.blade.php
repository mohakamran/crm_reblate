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
        .image-center {
            width: 100px;
            height: 100px;
            border-radius: 50%;

        }

            .card-text-center {
                font-size: 16px;
            }
            .emp-name {
                font-size: 17px;
                font-weight: 500;
                text-align: center;
                margin-top:15px;
            }
        </style>
        <div class="row">
            <div class="col-xl-12">
                <div class="card" style="box-shadow:none;">
                    <div class="card-body">
                        <form action="/search-emp-tasks" method="post">
                            @csrf
                            <div class="row justify-content-center" >
                                <div class="col-md-2" style="padding: 5px; background-color: #e3e3e3; border-radius:10px; margin-right:5px;">
                                    <input class="form-control" type="text" name="emp_id" placeholder="Employee ID" style="background-color: transparent; border:none;">
                                </div>
                                <div class="col-md-2" style="padding: 5px; background-color: #e3e3e3; border-radius:10px; margin-right:5px;">
                                    <input class="form-control" type="text" name="emp_name" placeholder="Employee Name" style="background-color: transparent; border:none;">
                                </div>
                                <div class="col-md-2" style="padding: 5px; background-color: #e3e3e3; border-radius:10px; margin-right:5px;">
                                    <select name="emp_designation" class="form-control" id="" style="background-color: transparent; border:none;">
                                        <option value="" selected disabled>Select a designation</option>
                                        <option value="Operations Manager">Operations Manager</option>
                                        <option value="Web Development">Web Development</option>
                                        <option value="Graphic Designer">Graphic Designer</option>
                                        <option value="Virtual Assistant">Virtual Assistant</option>
                                    </select>
                                </div>
                                <div class="col-md-2" style="padding: 5px; background-color: #e3e3e3; border-radius:10px;">
                                    <select name="emp_shift" class="form-control" id="" style="background-color: transparent; border:none;">
                                        <option value="" selected disabled>Select Shift</option>
                                        <option value="Morning">Morning</option>
                                        <option value="Night">Night</option>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex justify-content-end gap-2">
                                    <button class="reblateBtn" style="padding: 10px 14px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                      </svg></button>

                                      <a href="/create-new-task" class="reblateBtn" style="padding:10px 14px;"><svg
                                              xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                              class="bi bi-plus-lg" viewBox="0 0 16 16">
                                              <path fill-rule="evenodd"
                                                  d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                          </svg></a>
                                </div>
                            </form>
                    </div>
                        </div>

                        {{-- error message --}}
                        <div class="row">
                            @if (isset($error) && $error!="")
                                <p style="color:red;">{{$error}}</p>
                            @endif
                        </div>
                        {{-- employee dashboards --}}
                        <div class="row mt-5">
                            @foreach ($latestEmployees as $emp)
                                <div class="col-md-3">

                                    <div class="card hovering" style="overflow: hidden; cursor: pointer; border-radius: 10px;">
                                        <div style="width: 150px;height: 150px;position: absolute;z-index: 100;background-color: #fca311;border-radius: 100px;right: -75px;top: -70px;"></div>
                                        <div class="card-body">
                                            @if ($emp->Emp_Image !=null &&  file_exists(public_path($emp->Emp_Image)))

                                            <a href="{{$emp->Emp_Image }}" target="_blank" style="display: flex; justify-content: center;">
                                                <img class="image-center" src="{{ $emp->Emp_Image }}" alt="" style="object-fit: cover;">
                                            </a>

                                                @else
                                                <a href="{{ url('user.png') }}" target="_blank" style="display: flex; justify-content: center;">
                                                    <img class="image-center" src="{{ url('user.png') }}" alt="" style="object-fit: cover;">
                                                </a>
                                            @endif
                                            <div class="card-text-center">
                                                <p class="emp-name"> {{ $emp->Emp_Full_Name }}</p>
                                                <div class="d-flex gap-1 align-items-center mb-2">
                                                    <p style="font-size: 17px; font-weight: 700; margin-bottom: 0px; color: #14213d;">Designation:</p>
                                                    <span style="font-size: 14px; border-bottom: 1px solid #e3e3e3;">{{ $emp->Emp_Designation }} </span>
                                                </div>
                                                <div class="d-flex gap-1 align-items-center mb-2">
                                                    <p style="font-size: 17px; font-weight: 700; margin-bottom: 0px; color: #14213d; ">Shift:</p>
                                                    <span style="font-size: 14px; border-bottom: 1px solid #e3e3e3;">{{ $emp->Emp_Shift_Time }} </span>
                                                </div>
                                                <div class="d-flex gap-1 align-items-center mb-2">
                                                    <p style="font-size: 17px; font-weight: 700; margin-bottom: 0px; color: #14213d; ">Employee Code:</p>
                                                    <span style="font-size: 14px; border-bottom: 1px solid #e3e3e3;">{{ $emp->Emp_Code }} </span>
                                                </div>
                                                {{-- <div class="d-flex gap-1 align-items-center mb-2">
                                                    <p style="font-size: 17px; font-weight: 700; margin-bottom: 0px; color: #14213d; ">Task 1:</p>
                                                    <span style="font-size: 14px; border-bottom: 1px solid #e3e3e3;">Pending </span>
                                                </div> --}}
                                            </div>


                                            <form action="/view-tasks-employees" method="post">
                                                @csrf


                                                <input type="hidden" name="hidden_emp_value" value="{{$emp->Emp_Code}}">


                                                <div class="text-center mt-3 container">
                                                    <button class="reblateBtn px-4 py-2">View Details</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

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
