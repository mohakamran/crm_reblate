<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>New User Role {{$login_user_name}}</title> --}}
</head>

<body>
    <p> Dear <b>{{$user_name}}</b>,</p>
    <p>
        Your password has been reset. You can access your portal using below credentials:
    </p>
    <p>
        Email: {{$client_email}} <br>
        Password: {{$randomPassword}} <br>
        Portal Link: https://crm.reblatesols.com/login <br>
    </p>



   <p>If you face any issue while logging in then please contact us. Thank you so much!</p>
    <p>Best regards,<br>
     M.Abuzar<br>
     Website: https://reblatesols.com <br>
     </p>

</body>

</html>
