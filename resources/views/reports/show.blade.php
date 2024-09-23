@extends('layouts.master')
@section('title')
    Reports
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
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
            .dataTables_length,
            .dataTables_filter,
            .dataTables_buttons {
                display: inline-block;
                margin-right: 10px;
            }

            .dataTables_filter {
                float: right;
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
            .task-title {
        display: inline-block;
        width: 100%; /* Ensure it takes the full width available */
        word-wrap: break-word;
    }

    .task-title span {
        display: block;
        width: 100%;
    }
    #disapproval-reasons {
        margin-top: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f8f9fa;
    }
    .no-disapprovals {
        font-size: 16px;
        color: #007bff;
    }
    .disapproval-item {
        margin-bottom: 15px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .disapproval-title {
        font-weight: bold;
        margin-bottom: 5px;
    }
    .disapproval-reason {
        font-size: 14px;
        color: #555;
        margin-bottom: 5px;
    }
    .disapproval-date {
        font-size: 12px;
        color: #888;
    }
    .label {
        font-weight: bold;
        display: inline-block;
        margin-right: 5px;
    }
        </style>
        <div class="row">
            <div class="col-12">
                <div class="card" style="box-shadow: none">
                    <div class="card-body bg-white">
                        <div class="d-flex my-3">
                            <p style="font-size: 23px;">Weekly Report : &nbsp;<span style="color: #fca311;text-decoration: underline;font-size: 26px;">{{ $employeeName }}</span></p>
                            <div class="d-flex justify-content-end" style="margin-left: 42%;">
                                <p style="font-size: 23px;">Employee Code : &nbsp; <span style="color: #fca311;text-decoration: underline;font-size: 22px;">{{$employeeCode}}</span></p>
                            </div>
                        </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Task Title</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 1;
                                @endphp
                                    @foreach($report as $task)
                                    @php
                                        $words = explode(' ', $task->task_title);
                                        $chunks = array_chunk($words, 13);
                                    @endphp
                                        <tr>
                                            <td style="color: #000;">{{$count++}}</td>
                                            <td class="task-title"> 
                                                @foreach ($chunks as $chunk)
                                                <span>{{ implode(' ', $chunk) }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $task->date }}</td>
                                            <td class="text-warning"> <span style="background: #14213d;border: 1px solid #ffffff;border-radius: 25px;padding: 3px 15px;">{{ $task->status }}</span></td>
                                            <td>
                                                @if ($task->approval == 'approved')
                                                    <div class="text-success">
                                                        <svg width="25px" height="25px" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5.03033 11.4697C4.73744 11.1768 4.26256 11.1768 3.96967 11.4697C3.67678 11.7626 3.67678 12.2374 3.96967 12.5303L5.03033 11.4697ZM8.5 16L7.96967 16.5303C8.26256 16.8232 8.73744 16.8232 9.03033 16.5303L8.5 16ZM17.0303 8.53033C17.3232 8.23744 17.3232 7.76256 17.0303 7.46967C16.7374 7.17678 16.2626 7.17678 15.9697 7.46967L17.0303 8.53033ZM9.03033 11.4697C8.73744 11.1768 8.26256 11.1768 7.96967 11.4697C7.67678 11.7626 7.67678 12.2374 7.96967 12.5303L9.03033 11.4697ZM12.5 16L11.9697 16.5303C12.2626 16.8232 12.7374 16.8232 13.0303 16.5303L12.5 16ZM21.0303 8.53033C21.3232 8.23744 21.3232 7.76256 21.0303 7.46967C20.7374 7.17678 20.2626 7.17678 19.9697 7.46967L21.0303 8.53033ZM3.96967 12.5303L7.96967 16.5303L9.03033 15.4697L5.03033 11.4697L3.96967 12.5303ZM9.03033 16.5303L17.0303 8.53033L15.9697 7.46967L7.96967 15.4697L9.03033 16.5303ZM7.96967 12.5303L11.9697 16.5303L13.0303 15.4697L9.03033 11.4697L7.96967 12.5303ZM13.0303 16.5303L21.0303 8.53033L19.9697 7.46967L11.9697 15.4697L13.0303 16.5303Z" fill="#000000"></path>
                                                        </svg>
                                                        Approved
                                                    </div>
                                                @elseif ($task->approval == 'not approved')
                                                    <div class="text-danger">
                                                        Not Approved 
                                                    </div>
                                                @else
                                                    @if (session('approved_task_id') == $task->id)
                                                        <div class="text-success">Approved Successfully</div>
                                                    @else
                                                        <form method="POST" action="{{ route('task.approve', $task->id) }}" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary btn-sm">Approved</button>
                                                        </form>
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#disapprovalModal-{{ $task->id }}">Not Approved</button>
                                                        
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="disapprovalModal-{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="disapprovalModalLabel-{{ $task->id }}" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="disapprovalModalLabel-{{ $task->id }}">Disapproval Reason</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="POST" action="{{ route('task.not_approve', $task->id) }}">
                                                                            @csrf
                                                                            <input type="text" name="task_title" value="{{ $task->task_title }}" readonly class="form-control mb-2">
                                                                            <textarea name="disapproval_reason" class="form-control" rows="4" required></textarea>
                                                                            <button type="submit" class="btn btn-danger mt-2">Submit</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="disapproval-reasons">
                                @if($disapprovals->isEmpty())
                                    <div class="no-disapprovals">
                                        No disapprovals yet.
                                    </div>
                                @else
                                    @foreach ($disapprovals as $disapproval)
                                        <div class="disapproval-item">
                                            <div class="disapproval-title">
                                                <span class="label">Task Title:</span> <span style="color: #656a60;font-weight: 400;">{{ $disapproval->task_title }}</span>
                                            </div>
                                            <div class="disapproval-reason">
                                                <span class="label">Reason for Not Approved:</span> {{ $disapproval->disapproval_reason }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                    </div>
                </div>
            </div> 
        </div> 

        <script>
            $(document).ready(function() {
                $('a[data-toggle="modal"]').click(function() {
                    var target = $(this).attr('data-target');
                    $(target).addClass('show').attr('aria-hidden', 'false');
                    $('body').addClass('modal-open');
                });
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
                $.ajax({
                    url: '/create-holidays', 
                    type: 'POST', 
                    data: formData,
                    success: function(response) {

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
                        'X-CSRF-TOKEN': csrfToken 
                    }
                });

                return false; 
            }
            function updateOfficeHolidays(id) {
                var holiday_id = 'holiday_dates_'+id;
                var holiday_type_id = 'holiday_type_'+id;
                var holiday_des_id = 'holiday_description_'+id;
                var holiday_date_message_id = 'holiday_date_message_'+id;
                var holiday_type_message_id = 'holiday_type_message_'+id;
                var holiday_dates = document.getElementById(holiday_id).value;
                var holiday_type = document.getElementById(holiday_type_id).value;
                var holiday_description = document.getElementById(holiday_des_id).value;
                var holiday_date_message = document.getElementById(holiday_date_message_id);
                var holiday_type_message = document.getElementById(holiday_type_message_id);
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
                $.ajax({
                    url: '/update-holidays', 
                    type: 'POST', 
                    data: formData,
                    success: function(response) {

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
                        'X-CSRF-TOKEN': csrfToken 
                    }
                });

                return false; 
            }
        </script>
        <script>
            function deleteproject(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You Want To Delete The Report',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonColor: '#FF5733', 
                    cancelButtonColor: '#4CAF50', 
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/Delete-Report/' + id,
                            method: 'DELETE', 
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                            },
                            success: function() {
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'deleted!',
                                    icon: 'success'
                                }).then(() => {
                                    location.reload(); 
                                });
                            },
                            error: function(xhr, status, error) {
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
        </script>
        <script>
            function showDisapprovalForm(taskId) {
                var form = document.getElementById('disapproval-form-' + taskId);
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection
    @section('scripts')
        <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
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
        <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endsection
