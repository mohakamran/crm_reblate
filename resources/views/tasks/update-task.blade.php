@extends('layouts.master')
@section('title')
Update Tasks
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    Update Tasks
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row d-flex justify-content-between mb-2">
                            <h4 class="card-title" style="width:50%">Update Tasks</h4>
                            <div class="d-flex align-items-end">
                                <div>
                                    <a href="/create-new-task" class="btn btn-primary"
                                    ><span
                                        ></span> Assign New Task </a>
                                </div>
                                <div>
                                    <form action="/view-tasks-employees" method="post">
                                        @csrf
                                        <input type="hidden" name="hidden_emp_value" value="{{$emp_id}}">
                                        <div class="text-center mt-3 container">
                                            <button class="btn btn-primary">Go back</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- <p class="card-title-desc">The Buttons extension for DataTables
                            provides a common set of options, API methods and styling to display
                            buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p> --}}

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Emp ID</th>
                                    <th>Emp Name</th>
                                    <th>Task Title</th>
                                    <th>Day</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Task Status</th>
                                    {{-- <th>Task Percentage</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody id="table-body">

                                @foreach ($tasks as $task)
                                    <tr>
                                        @php
                                            $taskDate = new DateTime($task->task_date);
                                            $year = $taskDate->format('Y');
                                            $monthName = $taskDate->format('F');
                                            $day = $taskDate->format('d');
                                        @endphp
                                        <td>{{ $emp_id }}</td>
                                        <td>{{ $emp_name }}</td>
                                        <td>{{ $task->task_title }}</td>
                                        <td>{{ $day }}</td>
                                        <td>{{ $monthName }}</td>
                                        <td>{{ $year }}</td>
                                        <td>{{  $task->task_status }}</td>
                                        {{-- <td>{{  $task->task_percentage }}%</td> --}}
                                        <td>

                                            <form action="/update-each-task" method="post">
                                                @csrf
                                                <input type="hidden" value="{{$task->id}}" name="task_id">
                                                {{-- <input type="hidden" value="{{$task->task_title}}" name="task_title"> --}}
                                                <input type="hidden" value="{{$emp_id}}" name="emp_id">
                                                <button type="submit" class="btn btn-success btn-sm"><i class="mdi mdi-pencil"></i></button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>



                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <script></script>
    @endsection
    @section('scripts')
        <!-- Required datatable js -->
        <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

        <script src="{{ URL::asset('build/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
