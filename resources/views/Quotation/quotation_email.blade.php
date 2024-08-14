<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {

            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: 'Poppins';
        }

        .email-wrapper {
            width: 100%;
            background-color: #f4f4f4;
            padding: 20px;
            box-sizing: border-box;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #14213d;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

.email-header img {
    /* max-width: 200px; */
    width: 60%;
    height: auto;
    object-fit: cover;
    margin: 15px 0 0 0;
}

        .email-body {
            padding: 20px;
        }

        .email-body h1 {
            color: #14213d;
            margin-top: 0;
        }

        ul li {
            line-height: 30px;
        }

        .email-body p {
    line-height: 1.6;
    text-align: justify;
}

        .email-signature {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .email-signature img {
            max-width: 143px;
            height: auto;
            object-fit: cover;
        }

        .email-footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
            border-top: 1px solid #ddd;
        }

        .email-footer p {
            margin: 5px 0;
        }

        .email-footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-container">
            <div class="email-header">
                <img src="{{ url('logo-company.png') }}" alt="Reblate Solutions">
                <h1>Quotation from Reblate Solutions</h1>
            </div>
            <div class="email-body">
                <h1>Hello {{ $quotes->client_name }},</h1>
                <p>We hope this message finds you well.</p>
                <p>Please find the quotation for the requested services. We have carefully prepared this quotation based
                    on your requirements and we are confident it meets your expectations.</p>
                <p><strong>Quotation Details:</strong></p>
                <ul>
                    <li><strong>Project:</strong> {{ $quotes->project_category }}</li>
                    <li><strong>Quotation Expiry Date:</strong> {{ $quotes->quotation_expires }}</li>
                    <li><strong>Amount:</strong> ${{ number_format($quotes->total_amount, 2) }}</li>
                    <li><strong>Upfront Amount:</strong> ${{ number_format($quotes->amount_upfront, 2) }}</li>
                </ul>
                <p>If you have any questions or need further modifications, please do not hesitate to contact us. We are
                    here to assist you with any further details or clarifications you may need.</p>
                <p>Thank you for considering our services. We look forward to your feedback.</p>

                <div class="email-signature">
                    <p>Best regards</p>
                    <p><strong>Roveem Dar</strong><br>
                        CEO<br>
                        Reblate Solutions</p>
                    <!--<img src="{{ url('My_Sign.png') }}" alt="Signature">-->
                </div>
            </div>
            <div class="email-footer">
                <p><strong>Reblate Solutions & Service Providers</strong></p>
                <p>High End Plaza Basement, MB1, Citi Housing Jhelum</p>
                <p>Phone: 0544 587025</p>
                <p>Email: <a href="mailto:info@reblatesols.com">info@reblatesols.com</a></p>
                <p>Website: <a href="https://www.reblatesols.com">www.reblatesols.com</a></p>
            </div>
        </div>
    </div>
</body>

</html>
