<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Verification</title>
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
            <h2>Verify Your Email Address</h2>
        </div>
        
        <div class="content">
            <p>Hello {{ $user->name ?? 'there' }},</p>
            
            <p>Thank you for registering with our Barbershop! Please verify your email address by clicking the button below:</p>
            
            <p style="text-align: center; margin: 30px 0;">
                <a href="{{ $verificationUrl }}" class="button">Verify Email Address</a>
            </p>
            
            <p>If the button above doesn't work, you can copy and paste the following link into your browser:</p>
            
            <p style="background-color: #f8f9fa; padding: 10px; word-break: break-all;">
                {{ $verificationUrl }}
            </p>
            
            <p>This verification link will expire in {{ config('auth.verification.expire', 60) }} minutes.</p>
            
            <p>If you did not create an account, no further action is required.</p>
            
            <p>Regards,<br>The Barbershop Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Barbershop. All rights reserved.</p>
        </div>
    </div>
</body>
</html></head>