@extends('layouts.master')
@section('title')
    Office Times
@endsection
@section('page-title')
    Office Times
@endsection
@section('body')

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
                text-align: center;
            }

            .closeBtn {
                position: absolute;
                top: 25px;
                right: 15px;
                cursor: pointer;
            }

    </style>

        <div class="row">
            <div class="card p-0" style="box-shadow: none; ">
                <div class="card-body bg-white" style="border: 1px solid #c7c7c7">
                    <div class="d-flex justify-content-end mb-2">
                        <button type="button"class="reblateBtn p-2" data-toggle="modal" data-target="#exampleModal">
                            Add Office Time
                        </button>
                        <button id="popupButton">
                            edit
                        </button>




                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="exampleModalLabel">Change Shift Time</h5>
                                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button> --}}
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-success" style="display: none;" id="success_message_id">
                                            Time Added Succcessfully!</p>
                                        <div class="container">
                                            <label for="">Office Start (<span style="color:red">*</span>)</label>
                                            <input type="time" id="office_start" class="form-control">
                                            <span style="color:red; display: none;" id="message_start">Office Start Time
                                                Required!</span>
                                        </div>
                                        <div class="container mt-2">
                                            <label for="">Office End (<span style="color:red">*</span>)</label>
                                            <input type="time" id="office_end" class="form-control">
                                            <span style="color:red; display: none;" id="message_end">Office End Time
                                                Required!</span>
                                        </div>

                                        <div class="container mt-2">
                                            <label for="">Break Start</label>
                                            <input type="time" id="break_start" class="form-control">
                                        </div>
                                        <div class="container mt-2">
                                            <label for="">Break End</label>
                                            <input type="time" id="break_end" class="form-control">

                                        </div>
                                        <div class="container mt-2">
                                            <label for="">Select Shift (<span style="color:red">*</span>)</label>
                                            <select id="shift_time" id="" class="form-control">
                                                <option value="" selected>select shift</option>
                                                <option value="morning">Morning</option>
                                                <option value="night">Night</option>
                                            </select>
                                            <span style="color:red; display: none;" id="message_shift">Select Shift!</span>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                            onclick="location.reload()">Close</button>
                                        <button type="button" onclick="saveOfficeTime()" class="btn btn-primary">Save
                                            changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <table id="datatable-buttons" class="table dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr style="background-color: #14213d">
                                <th class="borderingLeftTable font-size-20" style="color: white">Shift Type</th>
                                <th class="font-size-20" style="color: white">Shift Start</th>
                                <th class="font-size-20" style="color: white">Break Start</th>
                                <th class="font-size-20" style="color: white">Break End</th>
                                <th class="font-size-20" style="color: white">Shift End</th>
                                <th class="borderingRightTable font-size-20" style="color: white">Edit</th>
                            </tr>
                        </thead>

                        <tbody id="table-body">

                            @foreach ($data as $rec)
                                <tr style="border-bottom: 1px solid #c7c7c7">
                                    <td class="table-lines" >{{ $rec->shift_type }}</td>
                                    <td class="table-lines" >{{ $rec->shift_start }}</td>
                                    <td class="table-lines" >{{ $rec->break_start }}</td>
                                    <td class="table-lines" >{{ $rec->break_end }}</td>
                                    <td class="table-lines" >{{ $rec->shift_end }}</td>
                                    <td class="table-lines" >
                                        <div>
                                            <button type="button" style="width: 30px; height:30px;border:none; background-color:#14213d26; border-radius:50%; " data-toggle="modal"
                                                data-target="#exampleModal" onclick="editShift({{ $rec->id }})">
                                                <svg style="position: relative;"
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="#14213d50" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                            </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="popup" id="popup">
                    <div class="popup-content flex-column">
                        <div class="d-flex mb-3 align-items-center justify-content-between">
                            <h2 class="mb-0"
                                style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                Change Shift Time</h2>
                            <span class="closeBtn p-2" id="closeClass" style="border-radius: 50%; background-color:#14213d26"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="#14213d50" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <path
                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                </svg></span>
                        </div>
                        <div class="modal-body text-start">
                            <p class="text-success" style="display: none;" id="success_message_id">
                                Time Added Succcessfully!</p>
                            <div class="container">
                                <label for="">Office Start (<span style="color:red">*</span>)</label>
                                <input type="time" id="office_start" class="form-control">
                                <span style="color:red; display: none;" id="message_start">Office Start Time
                                    Required!</span>
                            </div>
                            <div class="container mt-2">
                                <label for="">Office End (<span style="color:red">*</span>)</label>
                                <input type="time" id="office_end" class="form-control">
                                <span style="color:red; display: none;" id="message_end">Office End Time
                                    Required!</span>
                            </div>

                            <div class="container mt-2">
                                <label for="">Break Start</label>
                                <input type="time" id="break_start" class="form-control">
                            </div>
                            <div class="container mt-2">
                                <label for="">Break End</label>
                                <input type="time" id="break_end" class="form-control">

                            </div>
                            <div class="container mt-2">
                                <label for="">Select Shift (<span style="color:red">*</span>)</label>
                                <select id="shift_time" id="" class="form-control">
                                    <option value="" selected>select shift</option>
                                    <option value="morning">Morning</option>
                                    <option value="night">Night</option>
                                </select>
                                <span style="color:red; display: none;" id="message_shift">Select Shift!</span>
                            </div>

                        </div>
                        <div class="text-end mt-3">

                            <button type="button" onclick="saveOfficeTime()" class="reblateBtn px-3 py-1">Save
                                changes</button>
                        </div>
                    </div>
                </div>


                    </div>
                    <table id="datatable-buttons" class="table dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr style="background-color: #14213d">
                                <th class="borderingLeftTable font-size-20" style="color: white">Shift Type</th>
                                <th class="font-size-20" style="color: white">Shift Start</th>
                                <th class="font-size-20" style="color: white">Break Start</th>
                                <th class="font-size-20" style="color: white">Break End</th>
                                <th class="font-size-20" style="color: white">Shift End</th>
                                <th class="borderingRightTable font-size-20" style="color: white">Edit</th>
                            </tr>
                        </thead>

                        <tbody id="table-body">

                            @foreach ($data as $rec)
                                <tr style="border-bottom: 1px solid #c7c7c7">
                                    <td class="table-lines">{{ $rec->shift_type }}</td>
                                    <td class="table-lines">{{ $rec->shift_start }}</td>
                                    <td class="table-lines">{{ $rec->break_start }}</td>
                                    <td class="table-lines">{{ $rec->break_end }}</td>
                                    <td class="table-lines">{{ $rec->shift_end }}</td>
                                    <td class="table-lines">
                                        <div>
                                            <button type="button"
                                                style="width: 30px; height:30px;border:none; background-color:#14213d26; border-radius:50%; "
                                                data-toggle="modal" data-target="#update_popup_{{ $rec->id }}"
                                                 >
                                                <svg style="position: relative;" xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="#14213d50" class="bi bi-pencil-fill"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <div class="popup" id="update_popup_{{ $rec->id }}">
                                    <div class="popup-content flex-column">
                                        <div class="d-flex mb-3 align-items-center justify-content-between">
                                            <h2 class="mb-0"
                                                style="color: #fca311; font-weight: 600; font-size: 25px; border-bottom:1px solid #c7c7c7">
                                                Update Shift Time</h2>
                                            <span class="closeBtn p-2" id="closeClass_{{ $rec->id }}"
                                                style="border-radius: 50%; background-color:#14213d26"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#14213d50"
                                                    class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                </svg></span>
                                        </div>
                                        <div class="modal-body text-start">
                                            <p class="text-success" style="display: none;" id="success_message_id">
                                                Time update succcessfully!</p>
                                            <div class="container">
                                                <label for="">Office Start   (<span style="color:red">*</span>)</label>
                                                <input type="time" id="office_start" value="{{ date('H:i', strtotime($rec->shift_start)) }}"  class="form-control">
                                                <span style="color:red; display: none;" id="message_start">Office Start Time
                                                    Required!</span>
                                            </div>
                                            <div class="container mt-2">
                                                <label for="">Office End (<span style="color:red">*</span>)</label>
                                                <input type="time" id="office_end" value="{{ date('H:i', strtotime($rec->shift_end)) }}" class="form-control">
                                                <span style="color:red; display: none;" id="message_end">Office End Time
                                                    Required!</span>
                                            </div>

                                            <div class="container mt-2">
                                                <label for="">Break Start</label>
                                                <input type="time" id="break_start" value="{{ $rec->break_start !== '00:00' ? date('H:i', strtotime($rec->break_start)) : '' }}" class="form-control">
                                            </div>
                                            <div class="container mt-2">
                                                <label for="">Break End</label>
                                                <input type="time" id="break_end" value="{{ $rec->break_end !== '00:00' ? date('H:i', strtotime($rec->break_end)) : '' }}" class="form-control">

                                            </div>
                                            <div class="container mt-2">
                                                <label for="">Select Shift (<span style="color:red">*</span>)</label>
                                                <select id="shift_time" id="" class="form-control">
                                                    <option value=""  >select shift</option>
                                                    <option value="morning" {{($rec->break_start == "morning") ? 'selected' : ''}}>Morning</option>
                                                    <option value="night" {{($rec->break_start == "night") ? 'selected' : ''}}>Night</option>
                                                </select>
                                                <span style="color:red; display: none;" id="message_shift">Select Shift!</span>
                                            </div>

                                        </div>
                                        <div class="text-end mt-3">

                                            <button type="button" onclick="UpdateOfficeTime({{$rec->id}})" class="reblateBtn px-3 py-1">Save
                                                changes</button>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </tbody>
                    </table>
                </div>



            </div>

        </div>
        <!-- end row -->
        <script>
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

            //update

            // document.addEventListener('DOMContentLoaded', function(id) {
            //     var poup_button = 'update_popup_'+id;
            //     var closeBtn = '#closeClass_'+id;
            //     const popupButton = document.getElementById(poup_button);
            //     const popup = document.getElementById(poup_button);
            //     const closeBtn = document.querySelector(closeBtn);

            //     popupButton.addEventListener('click', function() {
            //         popup.style.display = 'block';
            //     });

            //     closeBtn.addEventListener('click', function() {
            //         popup.style.display = 'none';
            //     });

            //     window.addEventListener('click', function(e) {
            //         if (e.target === popup) {
            //             popup.style.display = 'none';
            //         }
            //     });
            // });

            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }

            function UpdateOfficeTime(id) {
                var off_start = 'office_start_'+id;
                var off_end = 'office_end_'+id;
                var br_start = 'break_start_'+id;
                var br_end = 'break_end_'+id;
                var shi_time = 'shift_time_'+id;

                var success_messag = 'success_message_id_'+id;
                var message_shift_id = 'message_shift_'+id;
                var message_start_id = 'message_start_'+id;
                var message_end_id = 'message_end_'+id;


                var office_start = document.getElementById(off_start).value;
                var office_end = document.getElementById(off_end).value;
                var break_start = document.getElementById(br_start).value;
                var break_end = document.getElementById(br_end).value;
                var shift_time = document.getElementById(shi_time).value;

                var message_shift = document.getElementById(message_shift_id);
                var message_start_id = document.getElementById(message_start_id);
                var message_end_id = document.getElementById(message_end_id);
                var success_messag = document.getElementById(success_messag);

                 if (office_start == "") {
                    message_start_id.style.display = "block";
                    return;
                } else {
                    message_start_id.style.display = "none";
                }

                if (office_end == "") {
                    message_end_id.style.display = "block";
                    return;
                } else {
                    message_end_id.style.display = "none";
                }

                if (shift_time == "") {
                    message_shift.style.display = "block";
                    return;
                } else {
                    message_shift.style.display = "none";
                }

                 // Convert 24-hour format to 12-hour format with AM/PM
                office_start = formatTime(office_start);
                office_end = formatTime(office_end);
                break_start = break_start ? formatTime(break_start) : "00:00"; // Set default value if empty
                break_end = break_end ? formatTime(break_end) : "00:00 "; // Set default value if empty

                // console.log(office_start);
                // console.log(office_end);
                // console.log(break_start);
                // console.log(break_end);
                // console.log(shift_time);
                // console.log(id);
                // return;

                // return;


                // alert(DailyReport);
                // Data to be sent to the controller
                var dataToSend = {
                    office_start: office_start,
                    office_end: office_end,
                    break_start: break_start,
                    break_end: break_end,
                    shift_time: shift_time,
                    id:id,
                    _token: '{{ csrf_token() }}'
                };



                $.ajax({
                    type: 'POST',
                    url: '/update-office-times',
                    data: dataToSend,
                    success: function(response) {
                        // Handle success

                        success_messag.style.display = "block";
                        // window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error("Error occurred while saving data:", error);
                    }
                });

            }

            function saveOfficeTime() {
                var office_start = document.getElementById('office_start').value;
                console.log(office_start);
                var office_end = document.getElementById('office_end').value;
                var break_start = document.getElementById('break_start').value;
                var break_end = document.getElementById('break_end').value;
                var shift_time = document.getElementById('shift_time').value;

                var message_shift = document.getElementById('message_shift');
                var message_start = document.getElementById('message_start');
                var message_end = document.getElementById('message_end');

                // Convert 24-hour format to 12-hour format with AM/PM
                office_start = formatTime(office_start);
                office_end = formatTime(office_end);
                break_start = break_start ? formatTime(break_start) : "00:00"; // Set default value if empty
                break_end = break_end ? formatTime(break_end) : "00:00 "; // Set default value if empty

                // alert(office_start);
                // alert(break_start);
                // alert(break_end);
                // alert(break_end);
                // alert(shift_time);

                // return;

                if (office_start == "") {
                    message_start.style.display = "block";
                    return;
                } else {
                    message_start.style.display = "none";
                }

                if (office_end == "") {
                    message_end.style.display = "block";
                    return;
                } else {
                    message_end.style.display = "none";
                }

                if (shift_time == "") {
                    message_shift.style.display = "block";
                    return;
                } else {
                    message_shift.style.display = "none";
                }






                var message_error = document.getElementById('message_error');
                // alert(DailyReport);
                // Data to be sent to the controller
                var dataToSend = {
                    office_start: office_start,
                    office_end: office_end,
                    break_start: break_start,
                    break_end: break_end,
                    shift_time: shift_time,
                    _token: '{{ csrf_token() }}'
                };



                $.ajax({
                    type: 'POST',
                    url: '/office-times',
                    data: dataToSend,
                    success: function(response) {
                        // Handle success
                        var success_message_id = document.getElementById('success_message_id');
                        success_message_id.style.display = "block";
                        // window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error("Error occurred while saving data:", error);
                    }
                });
            }

            // Function to convert time from 24-hour format to 12-hour format with AM/PM
            function formatTime(time) {
                // Split the time string into hours and minutes
                var splitTime = time.split(':');
                var hours = parseInt(splitTime[0]);
                var minutes = parseInt(splitTime[1]);

                // Determine AM/PM
                var period = hours >= 12 ? 'PM' : 'AM';

                // Convert hours to 12-hour format
                hours = hours % 12;
                hours = hours ? hours : 12; // Handle midnight (0 hours)

                // Add leading zero to minutes if needed
                minutes = minutes < 10 ? '0' + minutes : minutes;

                // Concatenate hours, minutes, and period
                return hours + ':' + minutes + ' ' + period;
            }
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
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        buttons: [
            'excel', 'print'
        ],

    });
});

        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
