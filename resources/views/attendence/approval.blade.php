@extends('layouts.master')
@section('title')
    Today Leave Requests
@endsection
@section('page-title')
    Today Leave Requests
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
                position: relative;
                left: 32%;
            }

            .card-text-center {
                font-size: 16px;
            }

            .emp-name {
                font-size: 17px;
                font-weight: 500;
                text-align: center;
                margin-top: 15px;
            }
        </style>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        {{-- error message --}}
                        <div class="row container">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        {{-- employee and leave records --}}
                        @if ($records->isEmpty())
                        <div class="row mt-5">
                            {{-- Displaying employee cards --}}
                            <h3 class="text-center">No Leave Request today 😃</h3>
                        </div>

                        @else
                            <div class="row mt-5">
                                {{-- Displaying employee cards --}}
                                    @foreach ($emp as $employee)
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    @if ($employee->Emp_Image != null && file_exists(public_path($employee->Emp_Image)))
                                                        <img class="image-center" src="{{ $employee->Emp_Image }}"
                                                            alt="">
                                                    @else
                                                        <a href="{{ url('user.png') }}" target="_blank">
                                                            <img class="image-center" src="{{ url('user.png') }}"
                                                                alt="">
                                                        </a>
                                                    @endif
                                                    <div class="card-text-center">
                                                        <p class="emp-name">{{ $employee->Emp_Full_Name }}</p>
                                                        <p>Designation: {{ $employee->Emp_Designation }}</p>
                                                        <p>Shift: {{ $employee->Emp_Shift_Time }}</p>
                                                        <p>Employee Code: {{ $employee->Emp_Code }}</p>
                                                    </div>
                                                    {{-- Displaying leave records --}}
                                                    <div class="leave-records">
                                                        @foreach ($records as $record)
                                                            @if ($record->emp_code == $employee->Emp_Code)
                                                                <div class="leave-record">
                                                                    <p>Date: {{ $record->date }}</p>
                                                                    <p>Reason: {{ $record->reason }}</p>
                                                                    <p>Status: <b>{{ $record->status }}</b></p>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                    <a class="btn btn-primary" style="float:left;"
                                                        href="/leave-request/approve/{{ $employee->Emp_Code }}">Approve</a>
                                                    <a class="btn btn-danger"
                                                        href="/leave-request/decline/{{ $employee->Emp_Code }}"
                                                        style="float:right; background: red">Decline</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif


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
