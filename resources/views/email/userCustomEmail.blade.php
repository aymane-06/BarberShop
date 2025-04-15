<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $subject ?? 'Barbershop Platform Notification' }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 20px;
        }
        .header {
            text-align: center;
            padding-bottom: 15px;
            margin-bottom: 20px;
            border-bottom: 1px solid #e9ecef;
        }
        .barbershop-title {
            color: #3d5a80;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .message {
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 6px;
            margin-bottom: 20px;
            line-height: 1.7;
        }
        .user-info {
            background-color: #e9ecef;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 3px solid #3d5a80;
        }
        .footer {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e9ecef;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
        }
        .btn {
            display: inline-block;
            background-color: #3d5a80;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            margin-top: 15px;
        }
        .info-label {
            font-weight: bold;
            color: #3d5a80;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2 class="barbershop-title">Barbershop</h2>
            <p>Official Communication</p>
        </div>
        
        @if(isset($user))
        <div class="user-info">
            <p><span class="info-label">Name:</span> {{ $user->name ?? 'N/A' }}</p>
            <p><span class="info-label">Email:</span> {{ $user->email ?? 'N/A' }}</p>
        </div>
        @endif

        <div class="message">
            @if(isset($CustomMessage))
                {!! $CustomMessage !!}
            @else
                <p>Thank you for being part of our platform.</p>
            @endif
            
            <p style="margin-top: 20px;">
                If you have any questions, please don't hesitate to contact us.
            </p>
            
            <div style="margin-top: 15px;">
                Best regards,<br>
                The Barbershop Platform Team
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Barbershop Platform. All rights reserved.</p>
            <p>This is an automated email, please do not reply directly.</p>
        </div>
    </div>
</body>
</html>}