@extends('layouts.master')
@section('title')
    Vacations
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
    Vacations
@endsection
@section('body')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <style>
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
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-5">

                            @if(Auth()->user()->user_type == "admin" || Auth()->user()->user_type == "manager")
                            <button id="popupButton" class="reblateBtn p-2"> Create Holidays</button>
                            <div class="popup" id="popup">
                                <div class="popup-content flex-column">
                                    <div class="d-flex mb-3 align-items-center justify-content-between">
                                        <h5 class="modal-title" id="exampleModalLabel">Set Holidays</h5>
                                        <span class="closeBtn"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                            </svg></span>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-success" style="display: none;" id="success_message_id">
                                            Holidays Have been set!</p>
                                        <p class="text-danger" style="display: none;" id="error_message_id">
                                            Vacations already set in database!</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Dates</label>

                                                    <input type="text" id="holiday_dates" name="daterange" value=""
                                                        class="form-control" />
                                                    <span style="color:red;display:none" id="holiday_date_message"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Holidays Type</label>
                                                    <input type="text" id="holiday_type"
                                                        placeholder="eid, national day etc" name=""
                                                        class="form-control">
                                                    <span style="color:red;display:none" id="holiday_type_message"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label for="">Description</label>
                                                <textarea name="" id="holiday_description" class="form-control" style="width:100%;height:100px;"></textarea>
                                            </div>
                                        </div>




                                    </div>
                                    <div class="modal-footer mt-3 d-flex gap-2">
                                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                            >Close</button> --}}
                                        <button type="button" onclick="setOfficeHolidays()"
                                            class="reblateBtn px-4 py-2">Create</button>
                                    </div>


                                </div>

                            </div>
                            @endif
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Holiday Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Description</th>
                                    <th>Total Days</th>


                                </tr>
                            </thead>

                            <tbody id="table-body">

                                @foreach ($holidays as $holiday)
                                    <tr>
                                        <td>
                                            @if(Auth()->user()->user_type == "admin" || Auth()->user()->user_type == "manager")
                                                <a href="#" data-toggle="modal"
                                                    data-target="#popup_{{ $holiday->id }}">{{ $holiday->holiday_type }}
                                                </a>
                                                @else
                                                {{$holiday->holiday_type}}
                                            @endif

                                        </td>
                                        <td>{{ $holiday->startDate }}</td>
                                        <td>{{ $holiday->endDate }}</td>
                                        <td>{{ $holiday->holiday_description }}</td>
                                        <td>{{ $holiday->total_days }}</td>


                                    </tr>

                                    {{-- popup --}}
                                    <div class="popup" id="popup_{{ $holiday->id }}">
                                        <div class="popup-content flex-column">
                                            <div class="d-flex mb-3 align-items-center justify-content-between">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Holidays</h5>
                                                <span class="closeBtn"><svg xmlns="http://www.w3.org/2000/svg"
                                                        width="20" height="20" fill="currentColor" class="bi bi-x-lg"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                    </svg></span>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-success" style="display: none;" id="success_message_id_{{ $holiday->id }}">
                                                    Holidays Have been set!</p>
                                                <p class="text-danger" style="display: none;" id="error_message_id_{{ $holiday->id }}">
                                                    Vacations already set in database!</p>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Dates</label>
                                                            @php
                                                                $dates = $holiday->startDate.'-'.$holiday->endDate;
                                                            @endphp

                                                            <input type="text" id="holiday_dates_{{ $holiday->id }}" name="daterange"
                                                            value="{{ $holiday->startDate }} - {{ $holiday->endDate }}" class="form-control" />
                                                            <span style="color:red;display:none"
                                                                id="holiday_date_message_{{$holiday->id }}"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Holidays Type</label>
                                                            <input type="text" id="holiday_type_{{ $holiday->id }}"
                                                                placeholder="eid, national day etc" name="" value="{{isset($holiday->holiday_type) ? $holiday->holiday_type : ''}}"
                                                                class="form-control">
                                                            <span style="color:red;display:none"
                                                                id="holiday_type_message_{{$holiday->id}}"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-md-12">
                                                        <label for="">Description</label>
                                                        <textarea name="" id="holiday_description_{{ $holiday->id }}" class="form-control" style="width:100%;height:100px;">{{isset($holiday->holiday_description) ? $holiday->holiday_description : ''}}</textarea>
                                                    </div>
                                                </div>




                                            </div>
                                            <div class="modal-footer mt-3 d-flex gap-2">
                                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                        >Close</button> --}}
                                                <button type="button" onclick="updateOfficeHolidays({{ $holiday->id }})"
                                                    class="reblateBtn px-4 py-2">Update</button>
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
            $(document).ready(function() {

                // Open modal
                $('a[data-toggle="modal"]').click(function() {
                    var target = $(this).attr('data-target');
                    $(target).addClass('show').attr('aria-hidden', 'false');
                    $('body').addClass('modal-open');
                });

                // Close modal
                $('.modal .close, .modal .btn-close').click(function() {
                    $(this).closest('.modal').removeClass('show').attr('aria-hidden', 'true');
                    $('body').removeClass('modal-open');
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                const popupButton = document.getElementById('popupButton');
                const popup = document.getElementById('popup');
                const closeBtn = document.querySelector('.closeBtn');

                popupButton.addEventListener('click', function() {
                    popup.style.display = 'block';
                });

                closeBtn.addEventListener('click', function() {
                    popup.style.display = 'none';
                });

                window.addEventListener('click', function(e) {
                    if (e.target === popup) {
                        popup.style.display = 'none';
                    }
                });
            });
            $(document).ready(function() {
                $('#datatable-buttons').DataTable({
                    dom: "<'container-fluid'" +
                        "<'row'" +
                        "<'col-md-8'lB>" +
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

            $(function() {
                $('input[name="daterange"]').daterangepicker({
                        opens: 'right',
                        isInvalidDate: function(date) {
                            // Disable Saturdays and Sundays
                            return (date.day() === 0 || date.day() === 6);
                        }
                    },
                    function(start, end, label) {
                        var startDate = start.format('YYYY-MM-DD');
                        var endDate = end.format('YYYY-MM-DD');
                    });
            });



            function setOfficeHolidays() {



                var holiday_dates = document.getElementById('holiday_dates').value;
                var holiday_type = document.getElementById('holiday_type').value;

                var holiday_description = document.getElementById('holiday_description').value;


                var holiday_date_message = document.getElementById('holiday_date_message');
                var holiday_type_message = document.getElementById('holiday_type_message');
                // var holiday_desc_message = document.getElementById('holiday_desc_message');

                var datesArray = holiday_dates.split(' - ');


                if (holiday_dates == "") {
                    holiday_date_message.style.display = "block";
                    holiday_date_message.innerHTML = "Please Select Date!";
                    return;
                } else {
                    holiday_date_message.style.display = "none";
                }

                if (holiday_type == "") {
                    holiday_type_message.style.display = "block";
                    holiday_type_message.innerHTML = "required!";
                    return;
                } else {
                    holiday_type_message.style.display = "none";
                }

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var startDate = datesArray[0];
                var endDate = datesArray[1];

                var formData = {
                    _token: csrfToken,
                    holiday_type: holiday_type,
                    holiday_description: holiday_description,
                    startDate: startDate,
                    endDate: endDate
                };

                // console.log(formData);



                var success_message_id = document.getElementById('success_message_id');
                var error_message_id = document.getElementById('error_message_id');

                error_message_id.style.display = "none";
                success_message_id.style.display = "none";

                // AJAX call to send data to the Laravel controller
                $.ajax({
                    url: '/create-holidays', // The Laravel route
                    type: 'POST', // POST request
                    data: formData,
                    success: function(response) {
                        // Show success message
                        // console.log('Response');

                        if (error_message_id.style.display == "block") {
                            error_message_id.style.display == "none";
                        }
                        success_message_id.style.display = "block";


                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400) {
                            if (success_message_id.style.display == "block") {
                                success_message_id.style.display == "none";
                            }
                            error_message_id.style.display = "block";
                        }
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Add CSRF token to request headers
                    }
                });

                return false; // Prevent form submission if within a form
            }

            //update
            function updateOfficeHolidays(id) {
                var holiday_id = 'holiday_dates_'+id;
                var holiday_type_id = 'holiday_type_'+id;
                var holiday_des_id = 'holiday_description_'+id;
                var holiday_date_message_id = 'holiday_date_message_'+id;
                // console.log(holiday_date_message);
                var holiday_type_message_id = 'holiday_type_message_'+id;



                var holiday_dates = document.getElementById(holiday_id).value;
                var holiday_type = document.getElementById(holiday_type_id).value;

                var holiday_description = document.getElementById(holiday_des_id).value;


                var holiday_date_message = document.getElementById(holiday_date_message_id);
                var holiday_type_message = document.getElementById(holiday_type_message_id);

                // var holiday_desc_message = document.getElementById('holiday_desc_message');

                var datesArray = holiday_dates.split(' - ');

                if (holiday_type == "") {
                    holiday_type_message.style.display = "block";
                    holiday_type_message.innerHTML = "required!";
                    return;
                } else {
                    holiday_type_message.style.display = "none";
                }



                if (holiday_dates == "") {
                    holiday_date_message.style.display = "block";
                    holiday_date_message.innerHTML = "Please Select Date!";
                    return;
                } else {
                    holiday_date_message.style.display = "none";
                }



                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                var startDate = datesArray[0];
                var endDate = datesArray[1];

                var formData = {
                    id: id,
                    _token: csrfToken,
                    holiday_type: holiday_type,
                    holiday_description: holiday_description,
                    startDate: startDate,
                    endDate: endDate,
                    status: 'update'
                };




                var success_message_id_id = 'success_message_id_'+id;
                var error_message_id_id = 'error_message_id_'+id;
                var success_message_id = document.getElementById(success_message_id_id);
                var error_message_id = document.getElementById(error_message_id_id);

                error_message_id.style.display = "none";
                success_message_id.style.display = "none";

                // AJAX call to send data to the Laravel controller
                $.ajax({
                    url: '/update-holidays', // The Laravel route
                    type: 'POST', // POST request
                    data: formData,
                    success: function(response) {
                        // Show success message
                        // console.log('Response');

                        if (error_message_id.style.display == "block") {
                            error_message_id.style.display == "none";
                        }
                        success_message_id.style.display = "block";


                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 400) {
                            if (success_message_id.style.display == "block") {
                                success_message_id.style.display == "none";
                            }
                            error_message_id.style.display = "block";
                        }
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Add CSRF token to request headers
                    }
                });

                return false; // Prevent form submission if within a form
            }
        </script>

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
