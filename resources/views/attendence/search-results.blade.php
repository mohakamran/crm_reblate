@extends('layouts.master')
@section('title')
    Employee Attendence
@endsection
@section('page-title')
    Employee Attendence
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
                display: block;
                margin: 0 auto;
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
                <div class="card">
                    <div class="card-body">
                        <form action="/search-emp-attendence" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <input class="form-control" type="text" name="emp_id" placeholder="Employee ID">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" type="text" name="emp_name" placeholder="Employee Name">
                                </div>
                                <div class="col-md-3">
                                    <select name="emp_designation" class="form-control" id="">
                                        <option value="" selected disabled>Select a designation</option>
                                        <option value="Operations Manager">Operations Manager</option>
                                        <option value="Web Development">Web Development</option>
                                        <option value="Graphic Designer">Graphic Designer</option>
                                        <option value="Virtual Assistant">Virtual Assistant</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-success w-100">Search</button>
                                </div>
                            </div>
                        </form>
                        {{-- error message --}}
                        <div class="row">
                            @if (isset($error) && $error!="")
                                <p style="color:red;">{{$error}}</p>
                            @endif
                        </div>
                        {{-- employee dashboards --}}
                        <div class="row mt-5">

                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            {{-- <img class="image-center" src="{{ $Emp_Image }}" alt=""> --}}

                                            @if ($Emp_Image !=null && file_exists(public_path($Emp_Image)) )
                                                <a href="{{ $Emp_Image }}" target="_blank">
                                                    <img class="image-center" src="{{ $Emp_Image }}" alt="" >
                                                </a>
                                                @else
                                                <a href="{{ url('user.png') }}" target="_blank">
                                                    <img class="image-center" src="{{ url('user.png') }}" alt="" >
                                                </a>
                                            @endif
                                            <div class="card-text-center">
                                                <p class="emp-name"> {{ $full_name_emp }}</p>
                                                <p>Designation: {{ $Emp_Designation }}</p>
                                                <p>Shift: {{ $Emp_Shift_Time }}</p>
                                            </div>


                                            <form action="/view-attendence-emp" method="post">
                                                <input type="hidden" name="hidden_emp_value" value="{{$Emp_Code}}">
                                                <div class="text-center mt-3">
                                                    <button class="btn btn-success d-block">View Attendence</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                        </div>
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
