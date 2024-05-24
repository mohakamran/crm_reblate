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
        {{-- <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/office-times-morning" enctype="multipart/form-data">
                            @csrf

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" id="close-now">
                                    {{ session('success') }}
                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            @endif


                            <h4 style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">Morning Shift </h4>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control inputboxcolor" style="border: 1px solid #c7c7c7;" name="shift_start_morning" type="time"
                                            value=""  >
                                        <label for="">Shift Start <span class="text-danger">*</span></label>
                                        @error('shift_start_morning')
                                            <span style="color:red">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control inputboxcolor" style="border: 1px solid #c7c7c7;" name="break_start_morning" type="time"
                                            value=""  >
                                        <label for="">Break Start <span class="text-danger">*</span></label>
                                        @error('break_start_morning')
                                        <span style="color:red">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control inputboxcolor" style="border: 1px solid #c7c7c7;" name="break_end_morning" type="time"
                                            value=""  >
                                        <label for="">Break End <span class="text-danger">*</span></label>
                                        @error('break_end_morning')
                                        <span style="color:red">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input class="form-control inputboxcolor" style="border: 1px solid #c7c7c7;" name="shift_end_morning" type="time"
                                            value=""  >
                                        <label for="">Shift Start <span class="text-danger">*</span></label>
                                        @error('shift_end_morning')
                                        <span style="color:red">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div>
                                <button type="submit" class="reblateBtn w-md py-2 px-4">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">

                        <form method="post" action="/office-times-night" enctype="multipart/form-data">
                            @csrf

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" id="close-now">
                                    {{ session('success') }}
                                    <a type="button" onclick="hideNow()" class="close" data-dismiss="alert"
                                        aria-label="Close" style="float: right;">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                            @endif


                            <h4 style="font-size: 30px; padding-bottom: 10px; border-bottom: 1px solid #e3e3e3;">Evening Shift</h4>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control inputboxcolor" style="border: 1px solid #c7c7c7;" name="shift_start_night" type="time"
                                                value=""  >
                                            <label for="">Shift Start <span class="text-danger">*</span></label>
                                            @error('shift_start_night')
                                            <span style="color:red">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control inputboxcolor" style="border: 1px solid #c7c7c7;" type="time" name="break_start_night"
                                                value=""  >
                                            <label for="">Break Start <span class="text-danger">*</span></label>
                                            @error('break_start_night')
                                            <span style="color:red">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control inputboxcolor" style="border: 1px solid #c7c7c7;" type="time" name="break_end_night"
                                                value=""  >
                                            <label for="">Break End <span class="text-danger">*</span></label>
                                            @error('break_end_night')
                                            <span style="color:red">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control inputboxcolor" style="border: 1px solid #c7c7c7;" type="time" name="shift_end_night"
                                                value=""  >
                                            <label for="">Shift End <span class="text-danger">*</span></label>
                                            @error('shift_end_night')
                                            <span style="color:red">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            <div>
                                <button type="submit" class="reblateBtn w-md py-2 px-4">Update</button>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div> --}}


        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-5">
                        <button type="button"class="reblateBtn p-2" data-toggle="modal" data-target="#exampleModal">
                            Add Office Time
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
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Shift Type</th>
                                <th>Shift Start</th>
                                <th>Break Start</th>
                                <th>Break End</th>
                                <th>Shift End</th>
                            </tr>
                        </thead>

                        <tbody id="table-body">

                            @foreach ($data as $rec)
                                <tr>
                                    <td>{{ $rec->shift_type }}</td>
                                    <td>{{ $rec->shift_start }}</td>
                                    <td>{{ $rec->break_start }}</td>
                                    <td>{{ $rec->break_end }}</td>
                                    <td>{{ $rec->shift_end }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
        <!-- end row -->
        <script>
            function hideNow() {
                var divElement = document.getElementById('close-now');
                divElement.style.display = 'none';
            }

            function saveOfficeTime() {
                var office_start = document.getElementById('office_start').value;
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
