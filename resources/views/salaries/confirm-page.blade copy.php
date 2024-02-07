@extends('layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('page-title')
    {{ $title }}
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" placeholder="User Name"
                                    disabled
                                    value="{{$emp_name}}" min="0" name="emp_name">

                                    <label for=""> Name <span class="text-danger">*</span></label>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="email" placeholder="email"
                                    disabled
                                    value="{{$emp_email}}" name="emp_email">
                                    @error('ex_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <label for=""> Email<span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" placeholder="User Name" name="emp_designation"

                                    disabled
                                        value="{{$emp_designation}}" min="0">

                                    <label for=""> Designation <span class="text-danger">*</span></label>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" placeholder="email" name="emp_shift_time"
                                    disabled
                                    value="{{$emp_shift_time}}">

                                    <label for=""> Shift Time<span class="text-danger">*</span></label>
                                </div>
                            </div>
                        </div> --}}
                        <br>
                        <h3> Employee Details</h3><hr>
                        <form method="post" action="{{ $route }}" enctype="multipart/form-data">
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
                            <div class="table-responsive">
                                <table  class="table  table-bordered"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                        <tr>
                                            <td> <strong> Name</strong> </td>
                                            <td> {{$emp_name}} </td>
                                            <td> <strong>  Email </strong> </td>
                                            <td> {{$emp_email}} </td>
                                        </tr>
                                        <tr>
                                            <td> <strong> Designation</strong> </td>
                                            <td> {{$emp_designation}} </td>
                                            <td> <strong>  Shift Time </strong> </td>
                                            <td> {{$emp_shift_time}} </td>
                                        </tr>

                                        <tr>
                                            <td> <strong> Basic Salary</strong> </td>
                                            <td> Rs. {{$emp_basic_salary}} </td>
                                            <td> <strong>  KPI Bonus </strong> </td>
                                            <td> Rs. {{$emp_kpi_bonus}} </td>
                                        </tr>
                                        <tr>
                                            <td> <strong> Project Bonus</strong> </td>
                                            <td> Rs. {{$emp_project_bonus}} </td>
                                            <td> <strong>  Absent </strong> </td>
                                            <td> {{$emp_absent}} </td>
                                        </tr>
                                        <tr>
                                            <td> <strong> Leaves</strong> </td>
                                            <td>  {{$emp_leave}} </td>
                                            <td> <strong>  Deduction </strong> </td>
                                            <td> Rs. {{$emp_deduction}} </td>
                                        </tr>
                                        <tr>
                                            <td> <strong>Reason of Deduction</strong> </td>
                                            <td colspan="3">  {{$emp_reason_deduction}} </td>
                                        </tr>

                                        <tr>
                                            <td> <strong> Total Salary</strong> </td>
                                            <td>  {{$emp_total_salary}} </td>
                                            <td> <strong>  Deduction </strong> </td>
                                            <td> Rs. {{$emp_deduction}} </td>

                                        </tr>

                                        <tr>
                                            <td> <strong>  Net Salary </strong> </td>
                                            <td> Rs. {{$emp_net_salary}} </td>
                                        </tr>


                                </table>


                            </div>

                            <br>

                            <div class="">
                                <input type="checkbox" class="checbox"> Send Email to {{$emp_name}} 😂😂
                            </div>

                            <br>


                            <div>
                                <button type="submit" class="btn btn-primary  w-md"
                                    style="background-color: #14213D ; border-color: #fff;">Send Receipt</button>
                                <a href="/generate-new/{{$id}}" class="btn btn-danger">Go Back</a>
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
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
