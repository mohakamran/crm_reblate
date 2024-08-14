<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet"> --}}
    <title>{{ $quotes->project_title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .bar {
            width: 1245px;
            /* Width of the bar */
            height: 45px;
            /* Height of the bar */
            background-color: #14213D;
            /* Bar color */
        }

        .container {
            margin: 0px 2rem;
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

        h4 {
            margin: 0;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
        }



        .footer {
            font-size: 0.875rem;
            padding: 1rem;
            background-color: rgb(241 245 249);
        }

        table {
            width: 100%;
            border-spacing: 0;

        }
        .table-bordered {
            border:1px solid black;
            border-collapse: collapse;
        }
        .table-bordered tr, .table-bordered td {
            border:1px solid black;
        }

        table.products {
            font-size: 0.875rem;
        }

        table.products tr {
            background-color: rgb(96 165 250);
        }

        table.products th {
            color: #ffffff;
            /* padding: 0.5rem; */
            padding: 10px;
            text-align: left;
        }

        table tr.items {
            background-color: rgb(241 245 249);
        }

        table tr.items td {
            padding: 0.5rem;
        }

        .total {
            text-align: right;
            margin-top: 1rem;
            font-size: 0.875rem;
        }

        .margin-top {
            margin-top: 30px;
        }

        .box {
            background: #FEEEDF;
            padding: 10px;
            margin-left: 10px;
            max-height: 260px;
        }

        .box div {
            margin-top: 5px;
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
            width: 40%;
            height: 48px;
            text-align: center;
            padding-top: 10px;
            color: white;
            font-weight: 600;
            float: right;
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
            width: 37%;
            margin-top: 30px;
            display: block;
            margin: 0;
        }

        .icons {
            font-size: 20px;
            color: #fca311;
            border-radius: 3px;
            width: 26px;
            height: 20px;
        }

        .box {
            background: #FEEEDF;
            padding: 20px;
            height: 200px;
            max-height: 200px;
        }

        .quotation-container {
            margin-top: 40px;
        }

        .stamp-image {
            /* float: right; */
            position: absolute;
            height: 127px;
            width: 117px;
            top: -8rem;
            /* display: block; */
            margin: 0 auto;
            left: 38rem;
            object-fit: contain;
            rotate: 17px;
            transform: rotate(-20deg);
        }

        .quotation-heading {
            font-size: 20px;
        }
    </style>
</head>

<body>
    <div class="bar"></div>
    <div class="barTwo" style="width: 500px;"></div>
    <table class="margin-top w-full container">
        <tr>
            <td class="w-half">
               <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('reblat-logo.png'))) }}" alt="laravel daily" width="200" />


            </td>
            <td class="w-half">
                {{-- <h2>Invoice ID: 834847473</h2> --}}
            </td>
        </tr>
    </table>

    <div class="margin-top container">
        <table class="w-full">
            <tr>
                <td class="w-half box">
                    <div>
                        <h4>Quotation To:</h4>
                    </div>
                    <div><strong>{{ $quotes->client_name }}</strong></div>
                    <div> {{ $quotes->client_email }}</div>
                    <div>Project: {{ $quotes->project_title }}</div>
                    <div>Category: {{ $quotes->project_category }}</div>
                    @php
                        use Carbon\Carbon;
                    @endphp
                    <div>Deadline: {{ Carbon::parse($quotes->project_deadline)->format('d F Y') }}</div>
                </td>
                <td class="w-half box">
                    <div>
                        <h4>Quotation From:</h4>
                    </div>
                    <div>Reblate Solutions & Service Providers</div>
                    <div> <strong>Address: </strong> High End Plaza Basement, MB1, Citi Housing jhelum</div>
                    <div> <strong>Phone: </strong>0544 587025</div>
                    <div> <strong>Email: </strong>info@reblatesols.com</div>
                    <div> <strong>Website: </strong> https://www.reblatesols.com</div>
                </td>
            </tr>
        </table>
    </div>


    <div class="margin-top container" style="margin-left:3rem;">

            <label for=""><span style="font-size: 20px;">Client
                    Requirements</span>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
            <p >
                {!! $quotes->client_requirements !!}
            </p>


    </div>




    <div class="margin-top container">
        <table class="table table-bordered">
            <thead>
                <tr style="padding:10px;background-color:#14213D;color: #fff;">
                    <th scope="col" style="color: white;padding-top:5px;padding-bottom:5px;">SN</th>
                    <th scope="col" style="color: white;">Task</th>
                    <th scope="col" style="color: white;">Price</th>
                    <th scope="col" style="color: white;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $index => $service)
                    <tr style="border:1px solid black;">
                        <th scope="row" class="text-center">{{ $index + 1 }}</th>
                        <td>
                            <h5 class="Web" style="font-size: 18px;margin-top:4px;background:#14213D;color:#fff;padding:3px;">
                                &nbsp;&nbsp;&nbsp;{{ $service->service_name }}</h5>
                            @foreach (json_decode($service->tasks) as $task)
                                <p style="padding-left:5px;padding-top:2px;padding-bottom:2px;"> {{ $task }} </p>
                            @endforeach
                        </td>
                        <td class="pricestyling"
                            style="text-align: center; vertical-align: middle;font-family: 'Poppins';font-size: 20px;">
                            {{ $quotes->currency }} {{ $service->amount }}/-</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    </div>


    <div style="text-align: right; margin-top: 20px; padding: 10px;">
        <h4 style="margin: 0; font-size: 16px; font-weight: bold; background:#fca311; padding:15px 20px; display: inline;">
            TOTAL AMOUNT
            <span style="border-left: 1px solid #000; padding-left: 10px; margin-left: 10px;"></span>
            <span style="color: #14213D; margin-left: 10px;">
                {{ $quotes->currency }} {{ $quotes->total_amount }} /-
            </span>
        </h4>

        <p style="margin: 15px 0 0; font-size: 14px; padding:5px 20px;">
            Quotation Expires:
            <span style="font-size: 16px; font-weight: 600; margin-left: 5px;">
                {{ $quotes->quotation_expires }}
            </span>
        </p>

        <p style="margin: 5px 0 0; font-size: 14px; padding:5px 20px;">
            Pay Before Project Starts (Upfront Amount):
            <span style="font-size: 16px; font-weight: 600; margin-left: 5px;">
                {{ $quotes->currency }} {{ $quotes->amount_upfront }} /-
            </span>
        </p>
    </div>



    <table class=" w-full container" style="margin-top:7rem;">
        <tr>
            <td class="w-half">
                @if ($quotes->additional_notes!=null)
                <h4 style="color: #14213D; font-size: 18px; margin-bottom: 10px;">Additional Notes</h4>
                <p> {{$quotes->additional_notes}} </p>
                @endif

            </td>
            <td class="w-half">
                <div style="margin-bottom: 10px;">
                   <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('stamp.png'))) }}" alt="Stamp" style="width: 100px; height: auto;padding-left:10rem;"/>

                </div>

                <!-- Signature Line and Text -->
                <div style="display: block;">
                    <!--<hr style="width: 60%; border: 1px solid #000; margin: 0 auto 10px;"/>-->
                    <!--<h4 style="color: #14213D; font-size: 18px; margin: 0;padding-left:10rem;">-->
                    <!--    Authorized Sign-->
                    <!--</h4>-->
                </div>
            </div>
            </td>
        </tr>
    </table>


</body>

</html>
