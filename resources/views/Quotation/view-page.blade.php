@extends('layouts.master')
@section('title')
    Create Quotation
@endsection

@section('page-title')
    Create Quotation
@endsection
@section('body')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins';

        }

        .form-control {
            background-color: #fff;
            /* Set background color for the select box */
            color: #000;
            /* Set text color */
        }

        .service-container {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .task-container {
            margin-top: 10px;
        }

        .bar {
            width: 1583px;
            /* Width of the bar */
            height: 40px;
            /* Height of the bar */
            background-color: #14213D;
            /* Bar color */
        }

        .barTwo {
            position: relative;
            /* Positioning context for pseudo-element */
            width: 300px;
            /* Width of the bar */
            height: 40px;
            /* Height of the bar */
            background-color: #fca311;
            /* Bar color */
            margin-left: auto;
            /* Aligns the bar to the right */
            overflow: hidden;
            /* Hide overflow content */
        }

        .imagStyle {
            width: 36%;
            height: 110%;
        }

        .Hr {
            margin-top: -10px;
            margin-bottom: 1rem;
            border: 62px;
            border: 1px solid #14213D;
            width: 70%;
        }

        .HrProject {
            margin-top: -10px;
            margin-bottom: 1rem;
            border: 62px;
            border: 1px solid #14213D;
            width: 85%;
        }

        .HrCategory {
            margin-top: -10px;
            border: 1px solid #14213D;
            width: 65%;
            margin-left: 107px;
        }

        .HrDeadline {
            margin-top: -10px;
            border: 1px solid #14213D;
            width: 65%;
            margin-left: 107px;
        }

        .HrClient {
            margin-top: -10px;
            border: 1px solid #14213D;
            width: 73%;
            margin-left: 19%;
        }

        .Web {
            background-color: rgba(233, 233, 233, 1);
            width: 104%;
            height: 35px;
            padding-top: 4px;
            margin-left: -13px;
        }

        .pricestyling {
            padding: 148px 0px 0px 0px !important;
            text-align: center;
            font-size: 35px;
            font-weight: bold;
            font-family: 'popins';
        }

        .pricestylingSec {
            padding: 50px 0px 0px 0px !important;
            text-align: center;
            font-size: 35px;
            font-weight: bold;
            font-family: 'popins';
        }

        .questionportion {
            font-size: 30px;
            font-weight: bold;
            font-family: 'Popins';
            color: #14213D;
        }

        .email {
            font-weight: 500;
            color: #14213D;
        }

        .AMOUNT {
            background-color: #fca311;
            font-family: 'Poppins', sans-serif;
            width: 80%;
            height: 48px;
            text-align: center;
            padding-top: 10px;
            color: white;
            font-weight: 600;

        }

        .vl {
            border-left: 2px solid #14213D;
            height: 500% !important;
        }

        .Sequence {
            margin-bottom: 0rem;
            color: #14213D;
        }

        .Divider {
            border: 1px solid #14213D;
            width: 60%;
            margin-top: 30px;
        }
    </style>

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card bg-white p-3">

                    <div class="bar"></div>
                    <div class="barTwo" style="width: 500px;"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <img class="imagStyle" src="{{ url('reblate_dark-5ab25660.webp') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row" style="margin-top: 6%;">
                            <div class="col-md-6">
                                <label for=""><span
                                        style="font-size: 20px;font-family: 'Poppins', sans-serif;">Name</span> :
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
                                        style="font-size: 20px;font-family: 'Poppins';">{{ $quotes->client_name }}</span></label>
                                <hr class="Hr">
                            </div>
                            <div class="col-md-6">
                                <label for=""><span
                                        style="font-size: 20px;font-family: 'Poppins', sans-serif;">Date</span> :
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                        style="font-size: 20px;font-family: 'Poppins';">{{ $quotes->date }}</span></label>
                                <hr class="Hr">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row" style="margin-top: 2%;">
                            <div class="col-md-6">
                                <label for=""><span
                                        style="font-size: 20px;font-family: 'Poppins', sans-serif;">Category</span> :
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
                                        style="font-size: 20px;font-family: 'Poppins';">{{ $quotes->project_category }}</span></label>
                                <hr class="Hr">
                            </div>
                            <div class="col-md-6">
                                <label for=""><span
                                        style="font-size: 20px;font-family: 'Poppins', sans-serif;">Deadline</span> :
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span
                                        style="font-size: 20px;font-family: 'Poppins';">{{ $quotes->project_deadline }}</span></label>
                                <hr class="Hr">
                            </div>

                        </div>
                    </div>
                    <div class="container">
                        <div class="row" style="margin-top: 2%;">
                            <div class="col-lg-12">
                                <label for=""><span
                                        style="font-size: 20px;font-family: 'Poppins', sans-serif;">Project</span>:
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
                                        style="font-size: 20px;font-family: 'Poppins';">{{ $quotes->project_title }}</span></label>
                                <hr class="HrProject">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row" style="margin-top: 2%;">
                            <div class="col-lg-12">
                                <label for=""><span
                                        style="font-size: 20px;font-family: 'Poppins', sans-serif;">Client
                                        Requirements</span>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                                <p>
                                    {!! $quotes->client_requirements !!}
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row" style="margin-top: 5%;">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr style="background-color:#14213D;font-family: 'Poppins', sans-serif;color: white;">
                                            <th scope="col" style="color: white;">SN</th>
                                            <th scope="col" style="color: white;">Task</th>
                                            <th scope="col" style="color: white;">Price</th>
                                            <th scope="col" style="color: white;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($services as $index => $service)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>
                                                <h5 class="Web" style="font-family: 'Poppins';">&nbsp;&nbsp;&nbsp;{{ $service->service_name }}</h5>
                                                @foreach(json_decode($service->tasks) as $task)
                                                <p style="font-family: 'Poppins';">{{ $task }}</p>
                                                @endforeach
                                            </td>
                                            <td class="pricestyling" style="text-align: center; vertical-align: middle;">{{ $quotes->currency }} {{ $service->amount }}/-</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row" style="margin-top: 5%;">
                            <div class="col-md-6" style="font-family: 'Poppins', sans-serif;">
                                <h4 class="questionportion">Questions</h4><br>
                                <p class="email">Email Us :
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>info@reblatesols.com</span>
                                </p>
                                <p class="email">Call Us :
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>0544
                                        587025</span></p>
                            </div>
                            <div class="col-md-6" style="font-family: 'Poppins', sans-serif;">
                                <h4 class="AMOUNT">TOTAL AMOUNT &nbsp;&nbsp;&nbsp;&nbsp;<span class="vl"></span><span
                                        style="color: #14213D;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $quotes->currency }}
                                        {{ $quotes->total_amount }}/- </span></h4>
                                <p class="email">Quotation Expires : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
                                        style="font-size: 20px;font-weight: 600;">{{ $quotes->quotation_expires }}</span>
                                </p>
                                <p class="email">Before Project Starts :
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span
                                        style="font-size: 20px;font-weight: 600;"> {{ $quotes->currency }}
                                        {{ $quotes->amount_upfront }}/-</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row" style="margin-top: 5%;font-family: 'Poppins', sans-serif;">
                            <div class="col-md-6">
                                <h4 class="questionportion">Payment Info</h4>
                                <p class="Sequence">Bank Name :
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>CitiBank</span>
                                </p>
                                <p class="Sequence">Account
                                    :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>100102658</span>
                                </p>
                                <p class="Sequence">A/C Name
                                    :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>ReblateSolutions
                                        & Services Provider</span></p>
                                <p class="Sequence">Branch Code
                                    :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>248024</span>
                                </p>
                                <p class="Sequence">Bank Address
                                    :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>2
                                        Park Street,Sydney NSW 2000</span></p>
                            </div>
                            <div class="col-md-6">
                                <hr class="Divider">
                                <h4 style="font-family: 'Poppins', sans-serif;color: #14213D;font-size: 18px;">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized
                                    Sign</h4>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row" style="margin-top: 5%;font-family: 'Poppins', sans-serif;color:#14213D">
                            <div class="col-md-4">
                                <i class="fas fa-phone phone-icon"></i> +123456789</p>
                            </div>
                            <div class="col-md-4">
                                <i class="fas fa-phone phone-icon"></i> www.reblates.com</p>
                            </div>
                            <div class="col-md-4">
                                <i class="fas fa-phone phone-icon"></i> info@reblatesols.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row"
                            style="margin-top: 2%;font-family: 'Poppins', sans-serif;color: #14213D;text-align: center;">
                            <div class="col-lg-12">
                                <h4>High End Plaza Basement, MB1, Citi Housing jhelum</h4>
                            </div>
                        </div>
                    </div>


                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>

        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @endsection
    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
