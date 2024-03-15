@extends('layouts.master')
@section('title')
    Update Task
@endsection
@section('page-title')
    Update Task
@endsection
@section('body')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row mt-2">
            <div class="col-md-3">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <!-- Using a dummy CDN link for the image -->

                        @if ($Emp_Image != '')
                            <img class="img-fluid rounded-circle mb-3" style="width:100px;height:100px;"
                                src="{{ $Emp_Image }}">
                        @else
                            <img class="img-fluid rounded-circle mb-3" src="{{ URL::asset('user.png') }}">
                        @endif
                        <h5 class="card-title">{{ $emp_name }}</h5>
                        <p class="card-text">{{ $Emp_Designation }}</p>
                        <p class="card-text">{{ $Emp_Shift_Time }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card float-left">
                    <div class="card-header bg-success text-white">Task Details</div>
                    <div class="card-body">
                        <div class="mt-3">
                            <h5 class="card-title ">{{ $tasks->task_title }}</h5>
                            <P class="task-description">Task Desc: {{ $tasks->task_description }}</P>

                            <div class="progress mb-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 90%;"
                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">{{ $tasks->task_percentage }}%
                                    Complete</div>
                            </div>
                            <p style="font-size:12px;margin-top:10x;">deadline: {{ $tasks->task_date }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">


                        <form  action="/update-each-task-emp" method="post">
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

                            <input type="hidden" value="{{$task_id}}" name="task_id">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 inputboxcolor">
                                        <input class="form-control" style="background-color: transparent; border:none;"
                                            type="text" name="task_title"
                                            value="{{ isset($tasks->task_title) ? $tasks->task_title : old('task_title') }}"
                                            min="0">
                                        @error('task_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Task Title <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3 inputboxcolor">
                                        <input class="form-control" style="background-color: transparent; border:none;"
                                            type="text" name="task_date"
                                            value="{{ isset($tasks->task_date) ? $tasks->task_date : old('task_date') }}"
                                            min="0">
                                        @error('task_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="">Task Deadline <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-floating inputboxcolor">
                                            <textarea class="form-control " style="background-color: transparent; border:none;" name="task_description" placeholder="task description">{{ isset($tasks->task_description) ? $tasks->task_description : old('task_description') }}</textarea>
                                            @error('task_description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary mt-2"> Update Task</button>
                        </form>
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
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
