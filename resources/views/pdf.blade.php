<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>{{ $emp_name }} Salary</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway&family=Roboto&display=swap" rel="stylesheet">
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
            background-image: url('{{ url('reblate.png') }}');
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

        table {
            width: 100%;
            border-collapse: collapse;
            border: 2px solid black;
            margin-top: 30px;
            font-family: 'Raleway', sans-serif;
            font-family: 'Roboto', sans-serif;
        }

        table td {
            line-height: 25px;
            padding-left: 15px;
            text-align: center;
        }

        table th {
            background-color: #88a3dd;
            color: #000;
            text-align: center;
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
            font-size: 25px;
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

        span {
            font-size: 20px;
        }

        p {
            font-size: 18px;
        }

        .contact_section {
            margin: 10px;
            line-height: 0.9;
        }

        .contact_section p {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ url('reblat-logo.png') }}" alt="logo" class="logo">
        <table border="1">
            <tr height="100px" class="heading" style="">
                <td colspan='4'>Employee Details</td>
            </tr>
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
            </tr>
            <!------5 row---->
            <tr>
                <th>Leaves</th>
                <td>{{ $emp_leave }}</td>
            </tr>
        </table>
        <br />
        <table border="1">
            <tr>
                <th colspan="2">Income</th>
                <th colspan="2">Deductions</th>
            </tr>
            <tr>
                <td>Particular</td>
                <td>Amount</td>
                <td>Particular</td>
                <td>Amount</td>
            </tr>
            <tr>
                <td>Basic Salery</td>
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
                <td colspan="2" class="names">Muhammad Abuzar</td>
                <td colspan="2" class="names">Muhammad Danyal</td>
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

        <p><strong>Reason of Deduction: </strong>{{$emp_reason_deduction}}</p>

    </div>
    <div class="contact_section">
        <h1>For More information: </h1>
        <p>
            <strong>Address:</strong> High End Plaza, MB1, Citi Housing, Jhelum, Punjab,Pakistan
        </p>
        <p><strong>Website:</strong> <a href="https://reblatesols.com"> https://reblatesols.com </a></p>
        <p><strong>Email:</strong> <u>info@reblatesols.com</u></p>
        <p><strong>Phone Number:</strong> +1 (646) 814-8076</p>
    </div>
</body>

</html>
