@extends('layouts.master')
@section('title')
    {{ $title }}
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
    {{ $title }}
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">{{ $title }}</h4>
                        <p>Only registered clients will be displayed. If any client's data is missing you can add it
                            from <a href="/add-new-client">here</a>.</p>
                        {{-- <p class="card-title-desc">The Buttons extension for DataTables
                            provides a common set of options, API methods and styling to display
                            buttons on a page that will interact with a DataTable. The core library
                            provides the based framework upon which plug-ins can built.
                        </p> --}}



                        @if (session('email_sent'))
                                <div class="alert alert-success alert-dismissible fade show" id="close-now">
                                    {{ session('email_sent') }}
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
                                    <th> SR</th>
                                    <th> Client </th>
                                    <th> Project</th>
                                    <th> Client Email</th>
                                    <th> Status</th>
                                    {{-- <th> Status</th> --}}
                                    {{-- <th> Month</th> --}}
                                    {{-- <th> Status</th> --}}
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @php $count = 1; @endphp
                                @foreach ($rec as $client)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td><a href="/create-invoice/{{$client->id}}">{{ $client->client_name }}</a></td>
                                        <td>{{$client->project_name }}</td>

                                        <td>
                                            {{ $client->client_email }}
                                            {{-- {{file_exists($pdf)}} --}}
                                        </td>
                                        {{-- @php
                                            $pdfPath = 'generated-salaries/' . $emp->Emp_Code . '_' . date('m_Y') . '.pdf';
                                            // echo $pdfPath;
                                        @endphp --}}
                                        {{-- <td>
                                            @if (file_exists(public_path($pdfPath)))
                                                <label class="text-primary">Salary Slip Sent</label>
                                            @else
                                                <label class="text-danger">Salary Slip Not Sent</label>
                                            @endif
                                        </td> --}}
                                        @php
                                            $pdf_name = 'invoices/'.$client->client_name."_".date('m_Y').".pdf";
                                            // echo $pdfPath;
                                        @endphp
                                        <td>

                                            @if (file_exists(public_path($pdf_name)))
                                                <label class="text-primary">Invoice Sent</label>
                                            @else
                                                <label class="text-danger">Invoice Not Sent</label>
                                            @endif
                                        </td>
                                            @php $count++; @endphp
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
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    buttons: [
                        'excel', 'print'
                    ],

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
