<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New User Role {{$login_user_name}}</title>
</head>

<body>
    <p> Dear <b>{{$login_user_name}}</b>,</p>
    <p>
        Welcome to Reblate Solutions! Your Employee ID has been Created For Employee Portal. Now you can access portal using below credentials:
    </p>
    <p>
        Username: {{$login_user_code}} <br>
        Password: {{$randomPassword}} <br>
        Portal Link: https://crm.reblatesols.com/login <br>
        Designation: {{$employee_designation}} <br>
        Shift Time: {{$employee_shift_time}} <br>
        Joining Date: {{$employee_joining_date}} <br>
        Department: {{$employee_department}} <br>
    </p>



   <p>Thank you so much!</p>
    <p>Best regards,<br>
     M.Abuzar<br>
     Website: https://reblatesols.com <br>
     </p>

</body>

</html>
