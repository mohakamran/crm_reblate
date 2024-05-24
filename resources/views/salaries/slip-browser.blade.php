@extends('layouts.master')
@section('title')
    Salary Slip
@endsection
@section('page-title')
Salary Slip
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .container .contact {
            position: relative;
            z-index: 5;
        }

        .container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            /* background-image: url('{{ url('public/reblate.png') }}'); */
            background-position: center;
            background-size: 950px;
            background-repeat: no-repeat;
            height: 100%;
            width: 100%;
            opacity: 0.1;
            z-index: -1;
        }

        .logo {
            width: 300px;
            object-fit: contain;
        }
        table tr,td,th {
            border:1px solid #eee;
            border-collapse: collapse;
        }

        table {
            width: 100%;
            /* border-collapse: collapse; */
            /* border: 2px solid black; */
            margin-top: 30px;
            font-family: 'Roboto', sans-serif;
        }

        table td {
            line-height: 25px;
            padding:6px;
            font-size: 15px;
        }

        table th {
            background-color: #14213d3b;
            color: #000;
            text-align: left;
            font-size: 17px;
            padding:5px 5px;
        }

        .heading {
            background-color: #14213d;
            color: #ffffff;
            text-align: center;
            font-size: 40px;
            font-weight: 600;
            font-family: sans-serif;
        }

        .netSalery {
            padding: 20px;
            background-color: #14213d;
            color: white;
            font-size: 18px;
        }

        .names {
            padding: 15px;
            font-size: 20px;
        }

        .role {
            background-color: orange;
        }

        .desc {
            padding: 10px;
            text-align: center;
            color: gray;
        }

        .contact {
            padding: 20px;
            font-family: sans-serif;
        }

        .contact h1 {
            font-size: 20px;
        }

        a {
            text-decoration: none;
            font-size: 18px;
        }



        p {
            font-size: 18px;
        }

        .contact_section {
            margin: 10px;
            line-height: 0.9;
            text-align: center;
        }
        .contact_section h3{
            font-size: 18px;
            color: #000;

        }

        .contact_section p {
            font-size: 13px;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-xl-7">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <img src="https://reblatesols.com/assets/reblate_dark-5ab25660.png" style="width:250px;" alt="logo" class="logo">
                         {{-- <svg version="1.0" xmlns="http://www.w3.org/2000/svg"  width="300.000000pt" height="72.000000pt" viewBox="0 0 300.000000 72.000000"  preserveAspectRatio="xMidYMid meet">  <g transform="translate(0.000000,72.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"> <path d="M232 689 c-29 -11 -76 -42 -104 -68 l-52 -48 -27 20 c-25 18 -49 17 -49 -3 0 -5 15 -18 33 -29 74 -48 72 -44 47 -97 -15 -30 -25 -72 -28 -118 -6 -100 22 -172 97 -247 67 -67 123 -89 226 -89 93 0 153 22 214 76 l50 45 51 -37 c40 -29 54 -34 63 -25 9 10 5 18 -17 36 l-29 23 24 49 c20 41 24 63 24 153 0 99 -2 109 -33 172 -37 75 -104 142 -179 179 -69 34 -234 38 -311 8z m290 -38 c113 -54 192 -165 204 -287 9 -85 -36 -237 -63 -211 -3 3 4 31 16 62 57 152 -6 320 -150 400 -50 28 -62 30 -154 30 -110 0 -148 -13 -220 -76 -36 -32 -51 -34 -40 -8 10 24 95 82 148 101 71 25 194 20 259 -11z m-17 -66 c182 -89 216 -333 64 -469 -146 -131 -378 -82 -460 98 -23 51 -25 157 -4 215 57 161 242 234 400 156z"/> <path d="M323 549 l-53 -31 0 -61 0 -62 85 -50 c81 -47 85 -51 85 -85 0 -29 -6 -39 -29 -53 -28 -16 -31 -16 -60 0 -28 16 -31 23 -31 65 0 36 4 47 18 50 13 2 8 9 -19 26 -20 12 -39 22 -43 22 -4 0 -5 -39 -4 -86 l3 -87 54 -30 54 -31 53 29 54 29 0 66 0 65 -85 48 c-80 46 -85 50 -85 82 0 26 6 37 31 53 30 18 33 19 60 3 26 -14 29 -21 29 -68 0 -32 -5 -53 -12 -56 -11 -3 40 -37 57 -37 3 0 5 39 5 88 l0 87 -49 28 c-27 15 -53 27 -57 27 -5 0 -33 -14 -61 -31z"/> <path d="M215 497 c-32 -17 -36 -22 -20 -25 19 -3 20 -9 17 -156 l-3 -153 74 -46 c40 -26 80 -49 89 -52 8 -3 51 15 96 42 l82 48 0 157 c0 155 0 157 23 160 19 3 16 7 -20 26 -52 27 -56 27 -47 0 4 -12 7 -36 6 -53 0 -16 0 -80 -1 -142 l-1 -112 -59 -35 c-32 -20 -63 -36 -69 -36 -6 0 -35 15 -66 33 l-55 32 -3 167 -3 166 -40 -21z"/> <path d="M2494 575 c-7 -18 3 -35 22 -35 20 0 30 30 13 41 -20 12 -29 11 -35 -6z"/> <path d="M1150 480 c0 -83 1 -90 20 -90 11 0 20 5 20 12 0 9 3 9 12 0 17 -17 54 -15 72 4 23 23 21 87 -5 109 -17 16 -25 17 -51 7 -30 -11 -30 -11 -24 18 5 27 3 30 -19 30 -25 0 -25 -1 -25 -90z m98 -22 c3 -24 0 -28 -21 -28 -27 0 -40 20 -30 46 10 26 48 13 51 -18z"/> <path d="M1318 480 c3 -81 5 -90 23 -90 17 0 19 8 19 90 0 87 -1 90 -22 90 -22 0 -23 -2 -20 -90z"/> <path d="M1878 556 c-16 -8 -23 -20 -23 -41 0 -25 7 -33 38 -48 20 -10 37 -25 37 -33 0 -16 -26 -19 -35 -4 -8 13 -45 13 -45 1 0 -33 61 -52 99 -31 44 23 35 62 -20 91 -42 21 -51 39 -19 39 11 0 20 -4 20 -10 0 -5 12 -10 26 -10 25 0 26 1 12 22 -19 28 -59 39 -90 24z"/> <path d="M2160 480 c0 -83 1 -90 20 -90 19 0 20 7 20 90 0 83 -1 90 -20 90 -19 0 -20 -7 -20 -90z"/> <path d="M843 475 c0 -83 0 -85 24 -85 20 0 24 5 23 28 -3 47 0 48 21 10 15 -29 26 -38 45 -38 l26 0 -21 33 c-20 33 -20 33 -1 50 47 40 10 87 -66 87 l-50 0 -1 -85z m92 45 c8 -13 -13 -40 -31 -40 -8 0 -14 10 -14 25 0 18 5 25 19 25 11 0 23 -5 26 -10z"/> <path d="M1560 545 c0 -8 -4 -15 -10 -15 -5 0 -10 -9 -10 -20 0 -11 5 -20 10 -20 6 0 10 -17 10 -38 0 -43 14 -62 47 -62 16 0 23 6 23 20 0 11 -7 20 -15 20 -10 0 -15 10 -15 30 0 20 5 30 15 30 8 0 15 9 15 20 0 11 -7 20 -15 20 -8 0 -15 7 -15 15 0 8 -9 15 -20 15 -11 0 -20 -7 -20 -15z"/> <path d="M2400 545 c0 -8 -4 -15 -10 -15 -5 0 -10 -9 -10 -20 0 -11 5 -20 10 -20 6 0 10 -17 10 -38 0 -43 14 -62 47 -62 16 0 23 6 23 20 0 11 -7 20 -15 20 -10 0 -15 10 -15 30 0 20 5 30 15 30 8 0 15 9 15 20 0 11 -7 20 -15 20 -8 0 -15 7 -15 15 0 8 -9 15 -20 15 -11 0 -20 -7 -20 -15z"/> <path d="M1019 512 c-46 -38 -17 -122 43 -122 34 0 84 43 56 48 -9 2 -27 -2 -39 -8 -17 -10 -24 -9 -37 4 -15 15 -12 16 36 16 45 0 52 3 52 20 0 27 -35 60 -64 60 -13 0 -34 -8 -47 -18z m55 -18 c25 -9 19 -24 -9 -24 -24 0 -32 10 -18 23 8 8 8 8 27 1z"/> <path d="M1400 510 c-24 -24 -26 -67 -5 -97 12 -18 25 -21 70 -21 l55 1 0 68 c0 62 -2 69 -20 69 -11 0 -20 -5 -20 -12 0 -9 -3 -9 -12 0 -18 18 -45 15 -68 -8z m75 -50 c0 -18 -6 -26 -23 -28 -13 -2 -25 3 -28 12 -10 26 4 48 28 44 17 -2 23 -10 23 -28z"/> <path d="M1661 504 c-12 -15 -21 -34 -21 -44 0 -10 9 -29 21 -44 26 -33 70 -35 102 -3 l22 22 -23 3 c-13 2 -30 -2 -38 -9 -12 -10 -18 -9 -32 4 -15 16 -13 17 36 17 45 0 52 3 52 20 0 57 -83 80 -119 34z m63 -10 c27 -10 18 -24 -15 -24 -27 0 -30 2 -19 15 14 17 13 17 34 9z"/> <path d="M2020 512 c-45 -37 -18 -122 39 -122 45 0 71 26 71 70 0 63 -61 92 -110 52z m68 -51 c2 -13 -2 -27 -9 -31 -21 -14 -39 1 -39 32 0 25 4 29 23 26 14 -2 23 -11 25 -27z"/> <path d="M2230 470 c0 -69 9 -77 83 -78 l47 0 0 69 c0 62 -2 69 -20 69 -17 0 -20 -7 -20 -49 0 -31 -5 -51 -12 -54 -28 -9 -38 6 -38 54 0 42 -3 49 -20 49 -18 0 -20 -7 -20 -60z"/> <path d="M2490 460 c0 -63 2 -70 20 -70 18 0 20 7 20 70 0 63 -2 70 -20 70 -18 0 -20 -7 -20 -70z"/> <path d="M2582 514 c-16 -11 -22 -25 -22 -53 0 -46 24 -71 67 -71 39 0 63 28 63 73 0 39 -27 67 -65 67 -11 0 -31 -7 -43 -16z m68 -53 c0 -29 -14 -42 -37 -34 -7 3 -13 18 -13 34 0 24 4 29 25 29 21 0 25 -5 25 -29z"/> <path d="M2720 460 c0 -63 2 -70 20 -70 17 0 20 7 20 50 0 47 2 50 25 50 23 0 25 -3 25 -50 0 -43 3 -50 20 -50 18 0 20 7 20 54 0 36 -5 60 -16 70 -18 19 -45 21 -62 4 -9 -9 -12 -9 -12 0 0 7 -9 12 -20 12 -18 0 -20 -7 -20 -70z"/> <path d="M2892 518 c-25 -25 -14 -56 23 -68 19 -6 35 -16 35 -21 0 -12 -27 -12 -35 1 -7 12 -45 13 -45 2 0 -21 40 -43 71 -40 65 6 65 64 -1 81 -24 6 -30 11 -21 20 8 8 14 8 23 -1 14 -14 48 -16 48 -4 0 32 -73 55 -98 30z"/> <path d="M2608 263 c0 -21 0 -51 1 -66 3 -32 -23 -67 -49 -67 -9 0 -24 8 -33 18 -38 42 -7 99 47 88 22 -5 27 -3 19 5 -6 6 -26 9 -44 7 -79 -7 -70 -128 10 -128 15 0 32 5 39 12 9 9 12 9 12 0 0 -7 3 -12 8 -12 4 0 8 41 8 90 1 50 -2 90 -7 90 -5 0 -10 -17 -11 -37z"/> <path d="M870 275 c-7 -8 -10 -25 -6 -39 4 -16 1 -26 -9 -30 -18 -7 -20 -57 -3 -74 16 -16 70 -16 86 0 9 9 15 9 24 0 19 -19 33 -14 15 6 -15 17 -15 20 -1 41 9 12 13 25 9 29 -4 4 -9 3 -12 -3 -15 -41 -23 -40 -64 3 -38 40 -40 45 -26 60 15 14 18 14 37 -3 21 -19 29 -8 8 13 -16 16 -43 15 -58 -3z m44 -94 l28 -29 -21 -12 c-42 -22 -82 11 -61 51 14 25 21 24 54 -10z"/> <path d="M1086 274 c-30 -29 -18 -55 37 -77 39 -17 51 -50 21 -61 -25 -10 -32 -7 -54 16 -17 19 -20 19 -20 5 0 -40 92 -47 105 -8 9 30 -4 47 -46 64 -27 11 -39 21 -39 36 0 28 36 37 61 15 24 -21 36 -13 14 10 -21 20 -59 21 -79 0z"/> <path d="M1972 203 c1 -49 3 -71 5 -50 4 32 8 37 29 37 41 0 64 18 64 50 0 34 -23 50 -69 50 l-31 0 2 -87z m82 52 c10 -28 -5 -45 -40 -45 -31 0 -34 3 -34 30 0 27 3 30 34 30 21 0 36 -6 40 -15z"/> <path d="M1391 251 c-8 -5 -20 -7 -28 -4 -10 4 -13 -10 -13 -61 0 -37 4 -66 10 -66 6 0 10 24 10 54 0 46 3 56 20 61 11 3 20 11 20 16 0 11 -1 11 -19 0z"/> <path d="M1217 232 c-21 -23 -22 -61 -1 -90 26 -37 104 -26 104 15 0 8 -7 6 -20 -7 -26 -26 -45 -25 -72 3 l-23 22 60 5 c53 4 60 7 57 25 -2 11 -9 26 -14 33 -16 18 -72 15 -91 -6z m87 -14 c15 -24 5 -30 -48 -26 -46 3 -47 3 -30 26 19 27 61 27 78 0z"/> <path d="M1423 238 c37 -89 51 -118 57 -118 6 0 20 29 57 118 3 6 1 12 -5 12 -5 0 -18 -22 -28 -50 -10 -27 -21 -50 -24 -50 -3 0 -14 23 -24 50 -10 28 -23 50 -28 50 -6 0 -8 -6 -5 -12z"/> <path d="M1560 185 c0 -37 4 -65 10 -65 6 0 10 28 10 65 0 37 -4 65 -10 65 -6 0 -10 -28 -10 -65z"/> <path d="M1614 225 c-44 -67 47 -145 101 -85 25 27 12 37 -14 11 -12 -12 -27 -21 -35 -21 -26 0 -47 31 -44 64 2 23 10 33 32 41 24 8 31 6 46 -12 10 -12 20 -19 24 -16 13 13 -28 43 -60 43 -25 0 -38 -7 -50 -25z"/> <path d="M1767 232 c-37 -41 -10 -112 42 -112 32 0 61 18 61 37 0 14 -4 13 -21 -6 -25 -27 -56 -24 -77 7 -14 22 -14 22 42 22 52 0 56 2 56 23 0 13 -5 28 -12 35 -18 18 -73 14 -91 -6z m77 -8 c26 -26 18 -34 -34 -34 -54 0 -59 4 -33 32 20 22 46 23 67 2z"/> <path d="M2100 220 c0 -14 -3 -42 -6 -62 -4 -24 -3 -38 4 -38 6 0 12 23 14 52 3 44 7 55 28 65 25 13 25 13 -7 11 -28 -2 -33 -6 -33 -28z"/> <path d="M2186 228 c-34 -49 -7 -108 49 -108 39 0 65 28 65 71 0 55 -83 82 -114 37z m82 0 c7 -7 12 -27 12 -45 0 -25 -6 -36 -24 -44 -36 -17 -66 3 -66 44 0 38 15 57 45 57 12 0 26 -5 33 -12z"/> <path d="M2338 186 c15 -36 30 -66 35 -66 8 0 57 105 57 123 0 20 -18 -7 -38 -57 l-19 -48 -20 53 c-11 29 -25 55 -31 57 -5 1 2 -26 16 -62z"/> <path d="M2450 185 c0 -37 4 -65 10 -65 6 0 10 28 10 65 0 37 -4 65 -10 65 -6 0 -10 -28 -10 -65z"/> <path d="M2672 238 c-18 -24 -23 -57 -11 -80 16 -30 28 -38 60 -38 24 0 68 34 57 45 -3 3 -13 -4 -23 -15 -22 -24 -48 -26 -69 -4 -27 26 -18 34 39 34 47 0 55 3 55 18 0 42 -82 72 -108 40z m76 -10 c25 -25 13 -38 -33 -38 -48 0 -55 9 -29 34 18 19 45 21 62 4z"/> <path d="M2805 183 c0 -76 13 -84 17 -11 3 44 7 54 28 65 25 12 24 12 -10 11 l-35 -1 0 -64z"/> <path d="M2892 233 c-14 -27 -5 -41 34 -53 24 -8 34 -17 32 -28 -4 -23 -32 -26 -52 -6 -20 20 -34 11 -16 -11 16 -20 64 -19 81 1 16 20 1 48 -29 52 -25 4 -46 27 -37 42 10 16 43 12 54 -7 5 -10 13 -15 17 -11 4 4 1 14 -6 23 -17 21 -67 19 -78 -2z"/> </g> </svg> --}}
                        <div class="mt-3 p-2 text-center">
                            <h2 style="font-size:25px;color:#14213d">Employee <span style="color: #fca311;font-size:25px;font-weight:500">Details</span> </h2>
                        </div>
                         <table >
                            <tr>
                                <th>Name</th>
                                <td>{{ $emp_name }}</td>
                                <th>Emp Code</th>
                                <td>{{ $emp_code }}</td>
                            </tr>
                            <!-----2 row--->
                            <tr>
                                <th>Designation</th>
                                <td>{{ $emp_designation }}</td>
                                <th>Date of Joining</th>
                                <td>{{ $emp_date_of_joining_hidden }}</td>

                            </tr>
                            <!------3 row---->
                            <tr>
                                <th>Number of Working Days</th>
                                <td>{{ $emp_no_of_working_days }}</td>
                                <th>Month Salary</th>
                                <td>{{ $emp_month_salary_hidden }}</td>
                            </tr>
                            <!------4 row---->
                            <tr>
                                <th>Absents</th>
                                <td>{{ $emp_absent }}</td>
                                <th>Leaves</th>
                                <td>{{ $emp_leave }}</td>
                            </tr>
                            <!------5 row---->
                            <tr>
                                <th>Present </th>
                                <td>{{ $emp_present_days }}</td>
                            </tr>
                        </table>
                        <table style="color: #000" >
                            <tr>
                                <th colspan="2">Income</th>
                                <th colspan="2">Deductions</th>
                            </tr>
                            {{-- <tr>
                                <td>Particular</td>
                                <td>Amount</td>
                                <td>Particular</td>
                                <td>Amount</td>
                            </tr> --}}
                            <tr>
                                <td>Basic Salary</td>
                                <td>Rs. {{ $emp_basic_salary }}</td>
                                <td>Deduction </td>
                                <td>Rs. {{ $emp_deduction }}</td>
                            </tr>
                            <tr>
                                <td>Designation Bonus </td>
                                <td>Rs. {{ $emp_designation_bonus }}</td>

                            </tr>
                            <tr>
                                <td>KPI Bonus </td>
                                <td>Rs. {{ $emp_kpi_bonus }}</td>
                            </tr>
                            <tr>
                                <td>Project Bonus </td>
                                <td>Rs. {{ $emp_project_bonus }}</td>
                            </tr>
                            <tr>
                                <td>Travel Allowance</td>
                                <td>Rs. {{ $emp_travel_allowence }}</td>
                            </tr>
                            <tr>
                                <td>Quartarly Bonus</td>
                                <td>Rs. {{ $quarterly_bonus }}</td>
                            </tr>

                            <tr>
                                <th>Total</th>
                                <td>Rs. {{ $emp_total_salary }}</td>
                                <th>Total</th>
                                <td>Rs. {{ $emp_deduction }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="netSalery"><strong>Net Salary</strong></td>
                                <td>Rs. {{ $emp_net_salary }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="names">{{$created_by}}</td>
                                <td colspan="2" class="names">{{$authorized_by}}</td>
                            </tr>
                            <tr>
                                <td class="role" colspan="2">Created By</td>
                                <td class="role" colspan="2">Authorized by</td>
                            </tr>
                            <tr>
                                <td class="desc" colspan="4">Feel free to contact Mr. Abuzar in case of any quiries or concerns
                                    related to salary</td>
                            </tr>
                        </table>
                        @if ($emp_reason_deduction != "")
                           <p style="font-size: 12px;"><strong>Reason of Deduction: </strong>{{$emp_reason_deduction}}</p>
                        @endif
                    </div>
                    <div class="contact_section">
                        <h3>For More information </h3>
                        <p>
                            <strong style="color: #14213d">Address:</strong> High End Plaza, MB1, Citi Housing, Jhelum, Punjab,Pakistan
                        </p>
                        <p><strong style="color: #14213d">Website:</strong> <a style="color:black;font-size:13px;" href="https://reblatesols.com"> https://reblatesols.com </a></p>
                        <p><strong style="color: #14213d">Email:</strong> <u>info@reblatesols.com</u></p>
                        <p><strong style="color: #14213d">Phone Number:</strong> +1 (646) 814-8076</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
