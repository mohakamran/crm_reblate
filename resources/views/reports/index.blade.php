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
                            <a href="{{ route('report.add') }}" class="reblateBtn p-2"> Create Monthly Report</a>
                        </div>
                        <table id="datatable-buttons" class="table dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr style="background-color: #14213d">
                                    <th class="borderingLeftTable font-size-20" style="color: white">SN</th>
                                    <th class="borderingLeftTable font-size-20" style="color: white">Holiday Type</th>
                                    <th class="font-size-20" style="color: white">Start Date</th>
                                    <th class="font-size-20" style="color: white">End Date</th>
                                    <th class="font-size-20" style="color: white">Description</th>
                                    <th class="borderingRightTable font-size-20" style="color: white">Total Days</th>
                                    @if (auth()->user()->user_type == "admin" || auth()->user()->user_type == "manager")
                                        <th class="font-size-20" style="color: white">Action</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody id="table-body">

                                @php
                                    $count = 1;
                                @endphp
                                    <tr style="border-bottom: 1px solid #c7c7c7">
                                        <td>
                                            {{$count++}}
                                        </td>
                                        <td class="table-lines" >vcbvc
                                        </td>
                                        <td class="table-lines" > $holiday->startDate </td>
                                        <td class="table-lines" > $holiday->endDate </td>
                                        <td class="table-lines" > $holiday->holiday_description </td>
                                        <td class="table-lines" > $holiday->total_days </td>

                                        @if (auth()->user()->user_type == "admin" || auth()->user()->user_type == "manager")
                                             <td class="table-lines">
                                                <a href="#" onclick="delUploadEntry('{{$holiday->id}}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                                        viewBox="0 0 24 24">
                                                        <path fill="#d20f0f"
                                                            d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zm2-4h2V8H9zm4 0h2V8h-2z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <a href="#" data-toggle="modal" data-target="#popup_{{ $holiday->id }}"  >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M20.71 7.04c.39-.39.39-1.04 0-1.41l-2.34-2.34c-.37-.39-1.02-.39-1.41 0l-1.84 1.83l3.75 3.75M3 17.25V21h3.75L17.81 9.93l-3.75-3.75z"/></svg>
                                                </a>
                                             </td>
                                        @endif
                                    </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        <script>

function delUploadEntry(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Holidays will be removed!',
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
                            url: '/del-vacations/' + id,
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
                                    text: error,
                                    icon: 'error'
                                });
                            }
                        });

                    }
                });
            }

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
                        '', ''
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
