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
        We have recieved your password change request.  Click the link below to reset your password:
        <a href="{{ $url }}">{{ $url }}</a>
        <p>This link will expire in 10 minutes.</p>
    </p>

   <p>If you face any issue while logging in then please contact us. Thank you so much!</p>
    <p>Best regards,<br>
     M.Abuzar<br>
     Website: https://reblatesols.com <br>
     </p>

</body>

</html>
