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
                            <h1>Attendance Tracking</h1>
                            <table border="1">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        @foreach ($dates as $date)
                                            <th>{{ \Carbon\Carbon::parse($date)->format('d M') }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->Emp_Full_Name }}</td>
                                            @foreach ($dates as $date)
                                                <td>
                                                    @php
                                                        $attendanceStatus = isset($attendanceData[$employee->Emp_Code][$date]) ? $attendanceData[$employee->Emp_Code][$date]['check_out_status'] : 'N/A';
                                                    @endphp
                                                    @if ($attendanceStatus == 'done')
                                                    {{$attendanceStatus}}
                                                        <span style="color: green;">✔</span>
                                                    @else
                                                        <span style="color: red;">❌</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
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
