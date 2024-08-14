@extends('layouts.master')
@section('title')
    Quotations Page
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
    Quotations Page
@endsection
@section('body')
    <style>
        .btn-manager {
            padding: 11px;
            background: #14213d;
            border-radius: 3px;
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body bg-white">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <a href="/create-quotation" class="reblateBtn "
                                    style="padding:10px;margin-bottom:10px;text-align:center;float:right;"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-plus-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                    </svg> Add New
                                </a>
                            </div>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        <table id="datatable-buttons" class="table dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr style="background-color: #14213d">
                                    <th class="borderingLeftTable font-size-20" style="color: white">ID</th>
                                    <th class="font-size-20" style="color: white">Quotation Title</th>
                                    <th class="font-size-20" style="color: white">Status</th>
                                    <th class="font-size-20" style="color: white">Amount</th>
                                    <th class="font-size-20" style="color: white">Date</th>

                                    @if (auth()->user()->user_type == 'admin')
                                        <th class="font-size-20" style="color: white">Sent By</th>
                                        <th class="font-size-20" style="color: white">Proposal ID</th>
                                    @else
                                        <th class="font-size-20" style="color: white">Sent To</th>
                                    @endif

                                    <th class="borderingRightTable font-size-20" style="color: white">Action</th>


                                </tr>
                            </thead>

                            @php
                                $id = 1;
                            @endphp

                            <tbody id="table-body">
                                @foreach ($quo as $item)
                                    <tr>
                                        <td>
                                            {{ $id++ }}
                                        </td>
                                        <td>{{ $item->project_title }}</td>
                                        <td>
                                            @if (($item->status != null) & ($item->status == 'pending'))
                                                <span class="badge bg-info">{{ $item->status }}</span>
                                            @elseif (($item->status != null) & ($item->status == 'approved'))
                                                <span class="badge bg-success">{{ $item->status }}</span>
                                            @elseif (($item->status != null) & ($item->status == 'declined'))
                                                <span class="badge bg-danger">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->total_amount }} {{ $item->currency }}</td>
                                        <td>{{ $item->date }}</td>

                                        @if (auth()->user()->user_type == 'admin')
                                            <td> {{ $item->sent_by_name }} </td>
                                            <td> {{ $item->service_id }} </td>
                                        @else
                                            <td> {{ $item->sent_to_name }} </td>
                                        @endif

                                        <td>

                                            @if (auth()->user()->user_type == 'admin')
                                                @if ($item->status == 'pending')
                                                    <a href="/view-quotation/{{ $item->service_id }}" title="View"
                                                        class="btn-manager">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="#fff"
                                                                d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                                        </svg>
                                                    </a>
                                                    <a href="#"
                                                        onclick="approveQuotation('{{ $item->service_id }}','approve')"
                                                        title="approve" class="btn-manager">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="white"
                                                                d="M19.78 2.2L24 6.42L8.44 22L0 13.55l4.22-4.22l4.22 4.22zm0 2.8L8.44 16.36l-4.22-4.17l-1.41 1.36l5.63 5.62L21.19 6.42z" />
                                                        </svg>
                                                    </a>
                                                    <a href="#" title="decline"
                                                        onclick="approveQuotation('{{ $item->service_id }}','decline')"
                                                        class="btn-manager">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 15 15">
                                                            <path fill="white"
                                                                d="M3.64 2.27L7.5 6.13l3.84-3.84A.92.92 0 0 1 12 2a1 1 0 0 1 1 1a.9.9 0 0 1-.27.66L8.84 7.5l3.89 3.89A.9.9 0 0 1 13 12a1 1 0 0 1-1 1a.92.92 0 0 1-.69-.27L7.5 8.87l-3.85 3.85A.92.92 0 0 1 3 13a1 1 0 0 1-1-1a.9.9 0 0 1 .27-.66L6.16 7.5L2.27 3.61A.9.9 0 0 1 2 3a1 1 0 0 1 1-1c.24.003.47.1.64.27" />
                                                        </svg>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        onclick="delQuotation('{{ $item->service_id }}')" title="delete"
                                                        class="btn-manager">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="white"
                                                                d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z" />
                                                        </svg>
                                                    </a>
                                                @elseif($item->status == 'approved' || $item->status == 'declined')
                                                    <a href="/view-quotation/{{ $item->service_id }}" title="View"
                                                        class="btn-manager">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="#fff"
                                                                d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                                        </svg>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                        onclick="delQuotation('{{ $item->service_id }}')" title="delete"
                                                        class="btn-manager">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" viewBox="0 0 24 24">
                                                            <path fill="white"
                                                                d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z" />
                                                        </svg>
                                                    </a>
                                                @endif
                                            @elseif(auth()->user()->user_type == 'manager')
                                                <a href="/view-quotation/{{ $item->service_id }}" title="View"
                                                    class="btn-manager">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                        viewBox="0 0 24 24">
                                                        <path fill="#fff"
                                                            d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5" />
                                                    </svg>
                                                </a>
                                            @endif
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
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    buttons: [
                        'excel', 'print'
                    ],

                });
            });


            function delQuotation(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Quotation will be deleted!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonColor: '#FF5733', // Red color for "Yes"
                    cancelButtonColor: '#4CAF50', // Green color for "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send an AJAX request to delete the task
                        $.ajax({
                            url: '/del-quotation/' + id,
                            method: 'GET', // Use the DELETE HTTP method
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'deleted!',
                                    icon: 'success'
                                }).then(() => {
                                    location.reload(); // Refresh the page
                                });
                            },
                            error: function(xhr, status, error) {
                                // Handle errors, you can display an error message to the user
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while deleting quotation!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }

            function approveQuotation(id, status) {
                var link = "/send-quotation/" + id + "/" + status;
                console.log(link);
                var message = "Quotation will be declined! You will not be able to send again.";
                if (status == "approve") {
                    message = "Quotation will be Sent to Client!";
                }
                Swal.fire({
                    title: 'Are you sure?',
                    text: message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonColor: '#FF5733', // Red color for "Yes"
                    cancelButtonColor: '#4CAF50', // Green color for "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send an AJAX request to delete the task
                        $.ajax({
                            url: link,
                            method: 'GET', // Use the DELETE HTTP method
                            success: function() {
                                // Provide user feedback
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Done!',
                                    icon: 'success'
                                }).then(() => {
                                    location.reload(); // Refresh the page
                                });
                            },
                            error: function(xhr, status, error) {
                                // Handle errors, you can display an error message to the user
                                // Display server response in console for debugging
                                console.error('Server Response:', xhr.responseText);
                                console.error('Error Status:', status);
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred!',
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }
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

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
