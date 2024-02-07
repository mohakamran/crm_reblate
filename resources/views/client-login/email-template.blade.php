<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>New User Role {{$login_user_name}}</title> --}}
</head>

<body>
    <p> Dear <b>{{$client_name}}</b>,</p>
    <p>
        Welcome to Reblate Solutions! Your Client ID has been Created For Reblate Client Portal. Now you can access portal using below credentials:
    </p>
    <p>
        Name: {{$client_name}} <br>
        Email: {{$client_email}} <br>
        Password: {{$randomPassword}} <br>
        Project: {{$project_name}} <br>
        Portal Link: https://crm.reblatesols.com/login <br>

    </p>



   <p>If you face any trouble having sign in then please contact with us. Thank you so much!</p>
    <p>Best regards,<br>
     M.Abuzar<br>
     Website: https://reblatesols.com <br>
     </p>

</body>

</html>
