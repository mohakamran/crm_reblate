@extends('layouts.master')
@section('title')
    Daily Reporting
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
    Daily Reporting
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-end mb-5">
                                <button type="button"class="reblateBtn p-2" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Add New Report
                                </button>



                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title" id="exampleModalLabel">New Report</h5>
                                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button> --}}
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-success" style="display: none;" id="success_message_id">
                                                    Report Added Succcessfully!</p>
                                                <textarea class="w-100 p-3 inputboxcolor" placeholder="Enter Your Daily Report"
                                                    style="resize: none; height:150px;border: 1px solid #e3e3e3" name="DailtReport" id="DailyReport"></textarea>
                                                <p class="text-danger" style="display:none;" id="message_error">Please Write
                                                    Someting!</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" onclick="saveReport()" class="btn btn-primary">Save
                                                    changes</button>
                                            </div>
                                        </div>
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
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Reports</th>
                                </tr>
                            </thead>

                            <tbody id="table-body">
                                @foreach ($daily_reporting as $rep)
                                    <tr>
                                        {{-- <td>{{ ( $emp->Emp_Code < 10) ? '00'.$emp->Emp_Code : $emp->Emp_Code }}sols</td> --}}
                                        <td>{{ $rep->emp_id }} </td>
                                        <td>{{ $rep->date }} </td>
                                        <td><a href="#modal_id_{{$rep->id}}"  data-toggle="modal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 32 32"><path fill="currentColor" d="M30.94 15.66A16.69 16.69 0 0 0 16 5A16.69 16.69 0 0 0 1.06 15.66a1 1 0 0 0 0 .68A16.69 16.69 0 0 0 16 27a16.69 16.69 0 0 0 14.94-10.66a1 1 0 0 0 0-.68ZM16 25c-5.3 0-10.9-3.93-12.93-9C5.1 10.93 10.7 7 16 7s10.9 3.93 12.93 9C26.9 21.07 21.3 25 16 25Z"></path><path fill="currentColor" d="M16 10a6 6 0 1 0 6 6a6 6 0 0 0-6-6Zm0 10a4 4 0 1 1 4-4a4 4 0 0 1-4 4Z"></path></svg>
                                        </a></td>
                                    </tr>

                                    <div class="modal fade" id="modal_id_{{$rep->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">

                                                <h5 class="modal-title" id="exampleModalLabel">Report</h5>
                                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button> --}}
                                            </div>
                                            <div class="modal-body">
                                                <pre>{{$rep->report}}</pre>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->



        <script>
            function saveReport() {
                var DailyReport = document.getElementById('DailyReport').value;
                var message_error = document.getElementById('message_error');
                // alert(DailyReport);
                // Data to be sent to the controller
                var dataToSend = {
                    DailyReport: DailyReport,
                    _token: '{{ csrf_token() }}'
                };

                if (DailyReport == "") {
                    message_error.style.display = "block";
                    return;
                } else {
                    message_error.style.display = "none";
                }

                $.ajax({
                    type: 'POST',
                    url: '/saveReportsDatabase',
                    data: dataToSend,
                    success: function(response) {
                        // Handle success
                        var success_message_id = document.getElementById('success_message_id');
                        success_message_id.style.display = "block";
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error("Error occurred while saving data:", error);
                    }
                });
            }
        </script>


    @endsection

    @section('scripts')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


        <!-- Datatable init js -->
        <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
