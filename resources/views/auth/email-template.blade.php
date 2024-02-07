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

         We are excited to inform you that an account has been created for the role <b>{{$userRole}}</b> you in Reblate CRM, your all-in-one solution for managing customer relationships efficiently.
        <br>
        Here are your account details:<br>
        - Email: {{$userEmail}} <br>
        - Password: {{$randomPassword}} <br>
        - Login Link: https://crm.reblatesols.com/user-login <br>

        Please log in to your account at CRM using the provided credentials. Upon your first login, you will be prompted to change your password to something more secure.

    </p>

    <p>Thank you so much!</p>
    <p>Best regards,<br>
     M.Abuzar<br>
     Website: https://reblatesols.com/ <br>
     </p>
</body>

</html>
