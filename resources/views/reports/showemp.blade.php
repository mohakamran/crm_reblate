@extends('layouts.master')
@section('title')
Reporting Detail
@endsection
@section('page-title')
Reporting Detail
@endsection
@section('body')
    <style>
        .form-control {
            background-color: #fff;
            /* Set background color for the select box */
            color: #000;
            /* Set text color */
        }
    </style>

    <style>
        .service-container {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .task-container {
            margin-top: 10px;
        }
        .h4Title{
            font-size: 40px;
    font-weight: 600;
    color: #14213d;
        }
        .dateH4{
            font-size: 20px;
    font-weight: 400;
    color: #14213d;
}
        .h5Title{
            font-size: 25px;
    font-weight: 600;
    color: #14213d;
}
.h4Emp{
    font-size: 25px;
    color: #fca311;
    font-weight: 600;
}
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <body data-sidebar="colored">
    @endsection
    @section('content')
    <div class="container mt-5">
        <div class="card">
            
            <div class="card-header">
                <h4 class="h4Title">Title : Weekly Report</h4>
                <p class="dateH4">Date: <span>{{ $report->date }}</span></p>
            </div>
            <div class="card-body">
                <h4 class="h4Emp">Emp Name : &nbsp;&nbsp;&nbsp;<span>{{ $report->name }}</span></h4>
                <p class="dateH4">Emp Id: <span>{{ $report->user_code }}</span></p>
                <p>{{$report->task_title}}</p>
                @if($report && $report->approval === 'approved')
                    <h5 class="h5Title">Approval : <span class="text-success">{{ $report->approval }}</span></h5>
                @elseif($report && $report->approval === 'not approved')
                    <h5 class="h5Title">Approval : <svg fill="red" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" height="20px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <polygon points="335.188,154.188 256,233.375 176.812,154.188 154.188,176.812 233.375,256 154.188,335.188 176.812,357.812 256,278.625 335.188,357.812 357.812,335.188 278.625,256 357.812,176.812 "></polygon> <path d="M256,0C114.609,0,0,114.609,0,256s114.609,256,256,256s256-114.609,256-256S397.391,0,256,0z M256,472 c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z"></path> </g></svg><span class="text-danger" style="font-size:18px;">
                        <br><span style="color: #000;font-size:18px;">{{ $report->disapproval_reason }}</span></span></h5>
                @else
                    <h5 class="h5Title">Approval: <br><span class="text-muted">No status available</span></h5>
                @endif
            </div>
        </div>
    </div>


        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>



        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endsection
