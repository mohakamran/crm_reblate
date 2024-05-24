@extends('layouts.master')
@section('title')
{{ $emp_name }} Slips
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
    {{ $emp_name }} Slips
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">{{ $emp_name }} Slips</h4>
                        {{-- <p class="card-title-desc">The Buttons extension for DataTables
                            provides a common set of options, API methods and styling to display
                            buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p> --}}



                        @if (isset($view_slips))
                                <div class="alert alert-danger alert-dismissible fade show" id="close-now">
                                    {{ $view_slips }}
                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                        @endif

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th> Emp ID</th>
                                    <th> Emp Name</th>
                                    <th> Amount</th>
                                    <th> Date</th>
                                    <th> View</th>
                                    {{-- <th> Month</th> --}}
                                    {{-- <th> Status</th> --}}
                                </tr>
                            </thead>
                            <tbody id="table-body">

                                @foreach ($info as $emp)
                                    <tr>
                                        <td>{{ $emp->emp_id }}</td>
                                        <td>{{ $emp->emp_name }}</td>

                                        <td>

                                            Rs. {{ number_format((float)$emp->amount, 2) }}
                                            {{-- {{file_exists($pdf)}} --}}
                                        </td>
                                        <td>
                                            {{$emp->date}}
                                        </td>

 <td>
                                            <a href="/preview-slip-employee-page/{{$emp->id}}">
                                                 <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32"><path fill="currentColor" d="M30.94 15.66A16.69 16.69 0 0 0 16 5A16.69 16.69 0 0 0 1.06 15.66a1 1 0 0 0 0 .68A16.69 16.69 0 0 0 16 27a16.69 16.69 0 0 0 14.94-10.66a1 1 0 0 0 0-.68ZM16 25c-5.3 0-10.9-3.93-12.93-9C5.1 10.93 10.7 7 16 7s10.9 3.93 12.93 9C26.9 21.07 21.3 25 16 25Z"/><path fill="currentColor" d="M16 10a6 6 0 1 0 6 6a6 6 0 0 0-6-6Zm0 10a4 4 0 1 1 4-4a4 4 0 0 1-4 4Z"/></svg>
                                            </a>
                                            @if (file_exists($emp->file_name) && $emp->file_name!=null && isset($emp->file_name))
                                                <a href="{{$emp->file_name}}" download><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"  viewBox="0 0 24 24"><path fill="currentColor" d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z"/></svg></a>
                                            @endif
                                        </td>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <script>
             function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }

            $(document).ready(function() {
    $('#datatable-buttons').DataTable({
        dom: "<'container-fluid'" +
            "<'row'" +
            "<'col-md-8'l>" +
            "<'col-md-4 text-right'f>" +
            ">" +
            "<'row dt-table'" +
            "<'col-md-12'tr>" +
            ">" +
            "<'row'" +
            "<'col-md-7'i>" +
            "<'col-md-5 text-right'p>" +
            ">" +
            ">",
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],


    });
});

        </script>
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
        {{-- <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script> --}}
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
