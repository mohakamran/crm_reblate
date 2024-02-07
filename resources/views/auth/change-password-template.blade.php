<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Template</title>
    
</head>

<body>
    <p> Dear <b>{{$userName}}</b>,</p>
    <p>

        It is to inform you that Admin has sent you new credentials for CRM. Now, you can login and resume your account.
        Please log in to your account at CRM using the provided credentials. 
        <br>
        - Email: {{$userEmail}} <br>
        - New Password: {{$randomPassword}} <br>
        - Login Link: https://crm.reblatesols.com/user-login

    </p>

    <p>Thank you so much!</p>
    <p>Best regards,<br>
     M.Abuzar<br>
     Website: https://reblatesols.com/ <br>
     </p>
</body>

</html>
