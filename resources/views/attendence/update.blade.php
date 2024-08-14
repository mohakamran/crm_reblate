@extends('layouts.master')
@section('title')
    Update Attendence
@endsection
@section('css')
    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection
@section('page-title')
    View Leaves Details
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">


            <div class="col-12">
                <div class="card bg-white container p-3">
                    @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                    @endif
                    <form id="modalForm" method="post" action="/update-leave/{{$leave->id}}">
                        <!-- Title Row -->
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                               <div class="form-group">
                                <label for="titleInput">Title <span style="color:red">*</span></label>
                                <input type="text" class="form-control @error('leave_title') is-invalid @enderror " value="{{($leave->leave_title) ?? old('leave_title')}}" id="titleInput" name="leave_title" placeholder="Enter title">

                            </div>
                            </div>
                            <div class="col-md-4">
                               <div class="form-group">
                                <label for="startDate">Start Date</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" value="{{($leave->date) ?? old('date')}}" id="date" name="date">
                               </div>
                            </div>
                            <div class="col-md-4">
                               <div class="form-group">
                                <label for="endDate">End Date</label>
                                <input type="date" class="form-control @error('Ending_date') is-invalid @enderror" value="{{($leave->Ending_date) ?? old('Ending_date')}}" id="Ending_date" name="Ending_date">
                               </div>
                            </div>
                        </div>


                        <!-- Text Area Row -->
                        <div class="form-group mt-3">
                            <label class="EmpStyle font-size-14 fw-bolder" style="color:#14213d;" for="reason">
                                Reason <span style="color:red">*</span>
                            </label>
                            <textarea class="form-control inputboxcolor @error('reason') is-invalid @enderror p-2 bg-white" style="border: 1px solid #14213d; resize: none; height: 100px;" id="reason" name="reason" oninput="updateCharCount()" placeholder="Write Reason within 200 characters" rows="5">{{($leave->reason) ?? old('reason')}}</textarea>
                            <div class="char-count mt-2">
                                <span id="charCount">0</span> / 200 characters
                            </div>
                        </div>

                        <!-- Update Button Row -->
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>

                </div>
            </div>
        </div>
        </div> <!-- end col -->


        <script>
             function updateCharCount() {
                var textarea = document.getElementById("reason");
                var charCountSpan = document.getElementById("charCount");
                var maxLength = 200;
                var currentCount = textarea.value.length;

                if (currentCount > maxLength) {
                    textarea.value = textarea.value.slice(0, maxLength); // Truncate the text
                    currentCount = maxLength; // Update current count
                }

                charCountSpan.textContent = currentCount;
            }

        </script>



    @endsection
    @section('scripts')

        <script src="{{ URL::asset('build/js/app.js') }}"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @endsection
