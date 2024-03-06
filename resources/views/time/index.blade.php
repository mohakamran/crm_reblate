@extends('layouts.master')
@section('title')
   Office Times
@endsection
@section('page-title')
    Office Times
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/office-times-morning" enctype="multipart/form-data">
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


                            <h4 style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">Morning Shift </h4>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control inputboxcolor" style="border: none;" name="shift_start_morning" type="time"
                                            value=""  >
                                        <label for="">Shift Start <span class="text-danger">*</span></label>
                                        @error('shift_start_morning')
                                            <span style="color:red">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control inputboxcolor" style="border: none;" name="break_start_morning" type="time"
                                            value=""  >
                                        <label for="">Break Start <span class="text-danger">*</span></label>
                                        @error('break_start_morning')
                                        <span style="color:red">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control inputboxcolor" style="border: none;" name="break_end_morning" type="time"
                                            value=""  >
                                        <label for="">Break End <span class="text-danger">*</span></label>
                                        @error('break_end_morning')
                                        <span style="color:red">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control inputboxcolor" style="border: none;" name="shift_end_morning" type="time"
                                            value=""  >
                                        <label for="">Shift Start <span class="text-danger">*</span></label>
                                        @error('shift_end_morning')
                                        <span style="color:red">{{$message}}</span>
                                        @enderror
                                    </div>
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
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <form method="post" action="/office-times-night" enctype="multipart/form-data">
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


                            <h4 style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">Evening Shift</h4>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control inputboxcolor" style="border: none;" name="shift_start_night" type="time"
                                                value=""  >
                                            <label for="">Shift Start <span class="text-danger">*</span></label>
                                            @error('shift_start_night')
                                            <span style="color:red">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control inputboxcolor" style="border: none;" type="time" name="break_start_night"
                                                value=""  >
                                            <label for="">Break Start <span class="text-danger">*</span></label>
                                            @error('break_start_night')
                                            <span style="color:red">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control inputboxcolor" style="border: none;" type="time" name="break_end_night"
                                                value=""  >
                                            <label for="">Break End <span class="text-danger">*</span></label>
                                            @error('break_end_night')
                                            <span style="color:red">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control inputboxcolor" style="border: none;" type="time" name="shift_end_night"
                                                value=""  >
                                            <label for="">Shift End <span class="text-danger">*</span></label>
                                            @error('shift_end_night')
                                            <span style="color:red">{{$message}}</span>
                                            @enderror
                                        </div>
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


        <div class="row">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                     <thead>
                         <tr>
                             <th>Shift Type</th>
                             <th>Shift Start</th>
                             <th>Break Start</th>
                             <th>Break End</th>
                             <th>Shift End</th>
                         </tr>
                     </thead>

                     <tbody id="table-body">

                         @foreach ($data as $rec)
                             <tr>
                                 <td>{{$rec->shift_type}}</td>
                                 <td>{{$rec->shift_start}}</td>
                                 <td>{{$rec->break_start}}</td>
                                 <td>{{$rec->break_end}}</td>
                                 <td>{{$rec->shift_end}}</td>
                             </tr>
                         @endforeach
                     </tbody>
                </table>
                </div>

            </div>

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
