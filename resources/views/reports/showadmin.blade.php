@extends('layouts.master')
@section('title')
    Reports
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
Reports
@endsection
@section('body')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <body data-sidebar="colored">
    @endsection
    @section('content')
        <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

.borderingLeftTable {
      border-top-left-radius: 10px !important;
  }

  .borderingRightTable {
      border-top-right-radius: 10px !important;
  }
  .table-lines{
      font-family: 'Poppins';
      color:#000;
      font-weight: 700;
  }
            /* Adjust layout of DataTable components */
            .dataTables_length,
            .dataTables_filter,
            .dataTables_buttons {
                display: inline-block;
                margin-right: 10px;
                /* Adjust margin as needed */
            }

            .dataTables_filter {
                float: right;
                /* Align search bar to the right */
            }

            .modal-backdrop {

    position: fixed;
    top: 0;
    left: 0;
    z-index: -1;
    width: 100vw;
    height: 100vh;
    background-color: var(--bs-backdrop-bg);
}

            .popup {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, 0.5);
                width: 100%;
                height: 100%;
                z-index: 1000;
            }

            .popup-content {
                /* overflow-y: scroll;
                                    scroll-behavior: smooth scroll; */
                display: flex;
                max-width: 700px;
                margin: auto auto;
                position: relative;
                top: 100px;
                justify-content: center;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

            }

            .closeBtn {
                position: absolute;
                top: 25px;
                right: 15px;
                cursor: pointer;
            }
        </style>
        <div class="row">
            <div class="col-12">
                <div class="card" style="box-shadow: none">
                    <div class="card-body bg-white">
                        <div class="d-flex justify-content-end mb-5">
                            <a href="#" class="reblateBtn p-2"> {{ $report->id }}</a>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h3>{{ $report->emp_id }}</h3>
                                <h3>{{ $report->report }}</h3>
                                <h3>{{ $report->date }}</h3>
                                <h3>{{ $report->emp_name }}</h3>
                                <h3>{{ $report->tasks_completed }}</h3>
                                <h3>{{ $report->projects_worked_on }}</h3>
                                <h3>{{ $report->goals_achieved }}</h3>
                                <h3>{{ $report->challenges_faced }}</h3>
                                <h3>{{ $report->goals_for_next_month }}</h3>
                            </div>
                        </div>
                        <h1>Add Comment</h1>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(auth()->user()->user_type == 'admin')
                            <form action="{{ route('report.update.admin', $report->id) }}" method="POST" >
                                @csrf
                                <div class="form-group">
                                    <label for="admin_comments">Admin Comments:</label>
                                    <textarea id="admin_comments" name="admin_comments" rows="4" class="form-control">{{ old('admin_comments', $report->admin_comments) }}</textarea>
                                    @error('admin_comments')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            </form>
                        @elseif(auth()->user()->user_type == 'manager')
                        <form action="{{ route('report.update.manager', $report->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="manager_comments">Manager Comments:</label>
                                    <textarea id="manager_comments" name="manager_comments" rows="4" class="form-control">{{ old('manager_comments', $report->admin_comments) }}</textarea>
                                    @error('manager_comments')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Comment</button>
                            </form>
                            @else
                            @endif
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endsection
