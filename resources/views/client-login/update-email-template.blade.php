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
         Your Password for Reblate Portal has been reset By Admin. Now you can access portal using updated credentials:
    </p>
    <p>
        Email: {{$login_user_email}} <br>
        Password: {{$randomPassword}} <br>
        Portal Link: https://crm.reblatesols.com/login <br>
    </p>



   <p>Thank you so much!</p>
    <p>Best regards,<br>
     M.Abuzar<br>
     Website: https://reblatesols.com <br>
     </p>

</body>

</html>
