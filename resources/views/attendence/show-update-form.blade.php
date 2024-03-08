@extends('layouts.master')
@section('title')
Employee Attendence Update
@endsection
@section('page-title')
    Employee Attendence Update
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
    <div class="row mt-2">
        <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <!-- Using a dummy CDN link for the image -->

                    @if (isset($Emp_Image) &&  $Emp_Image!= '')
                        <img class="img-fluid rounded-circle mb-3" style="width:100px;height:100px;"
                            src="{{ $Emp_Image }}">
                    @else
                        <img class="img-fluid rounded-circle mb-3" src="{{ URL::asset('user.png') }}">
                    @endif
                    <h5 class="card-title">{{ $emp_name }}</h5>
                    <p class="card-text">{{ $Emp_Designation }}</p>
                    <p class="card-text">{{ $Emp_Shift_Time }}</p>
                    <p class="card-text">{{ $formattedDate }}</p>
                    {{-- <p class="card-text">{{ $attendence_id }}</p> --}}
                </div>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/update-emp-attendence-details" >
                            @csrf
                            <input type="hidden" value="{{ $attendence_id }}" name="attendence_id">
                            @if (session('success'))
                            <div class="container-fluid d-flex justify-content-end">
                                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" style="max-width: 300px;" id="close-now">
                                    {{ session('success') }}

                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right; font-size:20px; margin-left:10px;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    @if (isset($index->check_in_time) && $index->check_in_time!=null)
                                    <div class="form-floating mb-3 inputboxcolor">
                                        <input class="form-control" style="background-color: transparent; border:none;" name="check_in_time" type="time" value="{{ isset($index->check_in_time) ?  date('H:i', strtotime($index->check_in_time)) : old('check_in_time') }}" min="00:00" max="23:59">
                                        @error('check_in_time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="check_in_time">Check In Time <span class="text-danger">*</span></label>
                                    </div>
                                @endif


                                </div>
                                <div class="col-md-6">
                                    @if (isset($index->check_out_time) && $index->check_out_time!=null)
                                        <div class="form-floating mb-3 inputboxcolor">
                                            <input class="form-control" style="background-color: transparent; border:none;" name="check_out_time" type="time" value="{{ isset($index->check_out_time) ?  date('H:i', strtotime($index->check_out_time)) : old('check_out_time') }}" min="00:00" max="23:59">
                                            @error('check_out_time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label for="check_out_time">Check Out Time <span class="text-danger">*</span></label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    @if (isset($index->break_start)  && $index->break_start!=null)
                                        <div class="form-floating mb-3 inputboxcolor">
                                            <input class="form-control" style="background-color: transparent; border:none;" name="break_start" type="time" value="{{ isset($index->break_start) ?  date('H:i', strtotime($index->break_start)) : old('break_start') }}" min="00:00" max="23:59">
                                            @error('break_start')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label for="break_start">Break Start Time<span class="text-danger">*</span></label>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if (isset($index->break_end) && $index->break_end!=null)
                                        <div class="form-floating mb-3 inputboxcolor">
                                            <input class="form-control" style="background-color: transparent; border:none;" name="break_end" type="time" value="{{ isset($index->break_end) ?  date('H:i', strtotime($index->break_end)) : old('break_end') }}" min="00:00" max="23:59">
                                            @error('break_end')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <label for="check_out_time">Break End <span class="text-danger">*</span></label>
                                        </div>
                                    @endif
                                </div>
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
