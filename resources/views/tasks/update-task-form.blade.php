@extends('layouts.master')
@section('title')
    Tasks {{ $emp_name }}
@endsection
@section('page-title')
    Tasks of {{ $emp_name }}
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body" style="display: flex; align-items: center; justify-content: space-between;">
                        <!-- Using a dummy CDN link for the image -->
                        {{-- @if (Auth()->user()->user_type == "admin")
                            <a href="/view-tasks" class="position-absolute top-0 start-1 pt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#14213d" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                                </svg>
                            </a>
                        @endif --}}

                        <div class="d-flex align-items-center gap-3" style="margin-left: 15px;">
                            @if ($Emp_Image != '')
                            <img class="img-fluid rounded-circle" style="width:100px;height:100px; object-fit: cover;"
                                src="{{ $Emp_Image }}">
                        @else
                            <img class="img-fluid rounded-circle " src="{{ URL::asset('user.png') }}">
                        @endif
                        <div class="d-flex flex-column gap-1 ml-4">
                            <h5 class="card-title mb-0" style="font-size: 25px;">{{ $emp_name }}</h5>
                            <p class="card-text mb-1 ">{{ $Emp_Designation }}</p>
                            <p class="card-text">{{ $Emp_Shift_Time }}</p>

                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4">
                <div class="card" style="box-shadow: 0px 0px 10px 10px #00000021;border-radius: 10px;">
                    <p class="p-4 rounded-top bg-success text-white mb-0" style="font-size: 17px;">Task Details</p>
                    <div class="p-4 rounded-bottom bg-white">

                                    <div style="border-bottom: 1px solid #e3e3e3;margin-top:10px;">
                                        <h5 style="font-size: 20px;">
                                            @if (Auth()->user()->user_type == "employee" || Auth()->user()->user_type == "manager")
                                               {{$task->task_title}}
                                            @endif
                                        </h5>
                                        <P style="font-size: 15px; margin-bottom: 5px;">Task Desc: {{ $task->task_description }}</P>

                                        {{-- <div class="progress mb-2" style="height: 20px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 90%;"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{$task->task_percentage}}% Complete</div>
                                        </div> --}}
                                        <p>Task Statue: {{$task->task_status}}</p>
                                        <p class="mb-0"  style="font-size:15px;margin-top:10px; color:gray;">deadline: {{$task->task_date}}</p>
                                    </div>

                    </div>
                </div>
            </div>



            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/task-save-update/{{$task->id}}">
                            @csrf

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" id="close-now">
                                    {{ session('success') }}
                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            @endif


                            <h4 style="font-size: 16px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">Task Update </h4>

                            <div class="form-floating mb-3">
                                    <textarea class="form-control inputboxcolor" name="task_desc" style="height:180px;" name="" id="" cols="30" rows="30"></textarea>
                                <label for="">Task Update <span class="text-danger">*</span></label>
                                @error('task_desc')
                                    <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                {{-- <input id="slider" type="range" style="width:100%;" min="0" max="100" value="{{$task->task_percentage}}" class="custom-range">
                                <p id="sliderValue">Task Progress (%): {{$task->task_percentage}}</p> --}}
                                {{-- <label for="">Task Update (%) <span class="text-danger">*</span></label> --}}
                                @error('shift_start_morning')
                                    <span style="color:red">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <select name="task_status" id="" class="form-control">
                                    <option value="" disabled selected>Select Task Status</option>
                                    <option value="completed" {{(isset($task->task_status) && $task->task_status == "completed") ? 'selected' : ''}}>Completed</option>
                                    <option value="pending" {{(isset($task->task_status) && $task->task_status == "pending") ? 'selected' : ''}}>Pending</option>
                                    <option value="in-progress" {{(isset($task->task_status) && $task->task_status == "in-progress") ? 'selected' : ''}}>In Progress</option>
                                </select>
                                <label for="">Task Status<span class="text-danger">*</span></label>
                                @error('task_status')
                                <span style="color:red">{{$message}}</span>
                            @enderror
                            </div>


                            <div>
                                <button type="submit" class="reblateBtn w-md py-2 px-4">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>



        </div>


        <!-- end row -->
        <script>
            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }
            $(document).ready(function(){
      $('#slider').on('input', function(){
        var value = $(this).val();
        $('#sliderValue').text('Task Progress: ' + value+' % ');
      });
    });
        </script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
