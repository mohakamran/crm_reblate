@extends('layouts.master')
@section('title')
    View Quotation
@endsection

@section('page-title')
    View Quotation
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
            width: 1245px;
            /* Width of the bar */
            height: 45px;
            /* Height of the bar */
            background-color: #14213D;
            /* Bar color */
        }

        .barTwo {
            position: relative;
            /* Positioning context for pseudo-element */
            width: 300px;
            /* Width of the bar */
            height: 45px;
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
            /* padding: 148px 0px 0px 0px !important; */
            text-align: center;
            font-size: 30px;
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
            width: 65%;
            margin-top: 30px;
        }
        .icons{
            font-size: 20px;
            color: #fca311;
            border-radius: 3px;
            width: 26px;
            height: 20px;
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
                            <div class="col-lg-11">
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
                                            <th scope="row" class="text-center">{{ $index + 1 }}</th>
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
                                <!-- <h4 class="questionportion">Questions</h4><br>
                                <p class="email"><b>Email Us :</b>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>info@reblatesols.com</span>
                                </p>
                                <p class="email"><b>Call Us :</b>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>0544
                                        587025</span></p> -->
                            </div>
                            <div class="col-md-6 " style="font-family: 'Poppins', sans-serif;">
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
                                <!-- <h4 class="questionportion">Payment Info</h4>
                                <p class="Sequence"><b>Bank Name :</b>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<span>CitiBank</span>
                                </p>
                                <p class="Sequence"><b>Account</b>
                                    :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>100102658</span>
                                </p>
                                <p class="Sequence"><b>A/C Name</b>
                                    :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>ReblateSolutions
                                        & Services Provider</span></p>
                                <p class="Sequence"><b>Branch Code</b>
                                    :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>248024</span>
                                </p>
                                <p class="Sequence"><b>Bank Address</b>
                                    :&nbsp;&nbsp;&nbsp;&nbsp;<span>2
                                        Park Street,Sydney NSW 2000</span></p> -->
                            </div>
                            <div class="col-md-6" style="margin-left: 56%;top: 18px;">
                                <hr class="Divider">
                                <h4 style="font-family: 'Poppins', sans-serif;color: #14213D;font-size: 18px;">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    Authorized Sign</h4>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row" style="margin-top: 5%;font-family: 'Poppins', sans-serif;color:#14213D">
                            <div class="col-md-4">
                            <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="m21 15.46l-5.27-.61l-2.52 2.52a15.045 15.045 0 0 1-6.59-6.59l2.53-2.53L8.54 3H3.03C2.45 13.18 10.82 21.55 21 20.97z"/></svg> 0544
                            587025</p>
                            </div>
                            <div class="col-md-4">
                            <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 2048 2048"><path fill="currentColor" d="M1024 0q141 0 272 36t245 103t207 160t160 208t103 245t37 272q0 141-36 272t-103 245t-160 207t-208 160t-245 103t-272 37q-141 0-272-36t-245-103t-207-160t-160-208t-103-244t-37-273q0-141 36-272t103-245t160-207t208-160T751 37t273-37m0 1920q123 0 237-32t214-90t182-141t140-181t91-214t32-238q0-123-32-237t-90-214t-141-182t-181-140t-214-91t-238-32q-123 0-237 32t-214 90t-182 141t-140 181t-91 214t-32 238q0 123 32 237t90 214t141 182t181 140t214 91t238 32m597-880l48-144h75l-85 256h-75l-48-144l-48 144h-75l-85-256h75l48 144l48-144h74zm-464-144h75l-85 256h-75l-48-144l-48 144h-75l-85-256h75l48 144l48-144h74l48 144zm-512 0h75l-85 256h-75l-48-144l-48 144h-75l-85-256h75l48 144l48-144h74l48 144z"/></svg> www.reblates.com</p>
                            </div>
                            <div class="col-md-4">
                            <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20"><path fill="currentColor" d="M19 14.5v-9c0-.83-.67-1.5-1.5-1.5H3.49c-.83 0-1.5.67-1.5 1.5v9c0 .83.67 1.5 1.5 1.5H17.5c.83 0 1.5-.67 1.5-1.5m-1.31-9.11c.33.33.15.67-.03.84L13.6 9.95l3.9 4.06c.12.14.2.36.06.51c-.13.16-.43.15-.56.05l-4.37-3.73l-2.14 1.95l-2.13-1.95l-4.37 3.73c-.13.1-.43.11-.56-.05c-.14-.15-.06-.37.06-.51l3.9-4.06l-4.06-3.72c-.18-.17-.36-.51-.03-.84s.67-.17.95.07l6.24 5.04l6.25-5.04c.28-.24.62-.4.95-.07"/></svg> info@reblatesols.com</p>
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
