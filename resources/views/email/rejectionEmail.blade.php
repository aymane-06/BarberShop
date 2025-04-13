<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbershop Application Rejected</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .content {
            padding: 20px 0;
        }
        .reason-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #dc3545;
            margin: 20px 0;
        }
        .details-box {
            background-color: #f8f9fa;
            padding: 15px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Barbershop Application Rejected</h2>
        </div>
        
        <div class="content">
            <p>Hello {{ $barbershop->user->name ?? 'there' }},</p>
            
            <p>We regret to inform you that your application for <strong>{{ $barbershop->name }}</strong> has been rejected.</p>
            
            <div class="reason-box">
                <h3>Reason for Rejection:</h3>
                <p>{{ $Rejection_Reason }}</p>
            </div>
            
            @if(!empty($Rejection_Details))
            <div class="details-box">
                <h3>Additional Details:</h3>
                <p>{{ $Rejection_Details }}</p>
            </div>
            @endif
            
            <p>You may address these issues and submit a new application. If you believe this decision was made in error, please contact our support team.</p>
            
            <p style="text-align: center; margin: 30px 0;">
                <a href="" class="button">Contact Support</a>
            </p>
            
            <p>Regards,<br>The Barbershop Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Barbershop. All rights reserved.</p>
        </div>
    </div>
</body>
</html>