@extends('layouts.master')
@section('title')
    Employee Attendence Sheet
@endsection
@section('page-title')
    Employee Attendence Sheet
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>  Employee Name </th>
                                    <?php $date = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31]; ?>
                                    @foreach ($date as $day)
                                        <th>{{ $day }} </th>
                                    @endforeach
                                </tr>

                                @foreach ($active_employees as $emp)
                                <tr>
                                    <td style="white-space: nowrap;">
                                        <img src="{{ $emp->Emp_Image }}" style="width:30px;height:30px;border-radius:50%;" alt="">
                                        {{ $emp->Emp_Full_Name }}
                                    </td>
                                    @foreach ($date as $day)
                                    <td>
                                        <?php
                                        $empCode = $emp->Emp_Code;
                                        $attendanceStatus = isset($attendanceData[$empCode][$day]) ? $attendanceData[$empCode][$day] : "N/A";
                                        echo "Employee Code: $empCode, Day: $day, Status: $attendanceStatus";
                                        ?>
                                        @if ($attendanceStatus == "done" && isset($attendanceCheckInData[$empCode][$day]) && $attendanceCheckInData[$empCode][$day] == "done")
                                            <!-- Both check_in_status and check_out_status are done -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="0.4rem" height="0.4rem" viewBox="0 0 24 24">
                                                <path fill="#06a503" d="M21 7L9 19l-5.5-5.5l1.41-1.41L9 16.17L19.59 5.59z"/>
                                            </svg>
                                        @else
                                            <!-- Either check_in_status or check_out_status is not done -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="0.4rem" height="0.4rem" viewBox="0 0 36 36">
                                                <path fill="#dd2e44" d="M21.533 18.002L33.768 5.768a2.5 2.5 0 0 0-3.535-3.535L17.998 14.467L5.764 2.233a2.498 2.498 0 0 0-3.535 0a2.498 2.498 0 0 0 0 3.535l12.234 12.234L2.201 30.265a2.498 2.498 0 0 0 1.768 4.267c.64 0 1.28-.244 1.768-.732l12.262-12.263l12.234 12.234a2.493 2.493 0 0 0 1.768.732a2.5 2.5 0 0 0 1.768-4.267z"/>
                                            </svg>
                                        @endif
                                    </td>
                                @endforeach
                                </tr>
                            @endforeach



                            </table>
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
