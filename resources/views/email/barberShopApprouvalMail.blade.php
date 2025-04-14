<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbershop Approved</title>
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
        .approval-status {
            font-size: 18px;
            font-weight: bold;
            margin: 15px 0;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            background-color: #d4edda;
            color: #155724;
        }
        .notes {
            background-color: #f8f9fa;
            padding: 15px;
            margin: 20px 0;
            border-left: 4px solid #3490dc;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header"></div></div>
            <h2>Congratulations! Your Barbershop is Approved</h2>
        </div>
        
        <div class="content">
            <p>Hello {{ $barbershop->user->name ?? 'Shop Owner' }},</p>
            
            <p>Great news! We have reviewed and approved your application for <strong>{{ $barbershop->name }}</strong>.</p>
            
            <div class="approval-status">
                Your barbershop is now live on our platform!
            </div>
            
            <p>Your business profile is now visible to customers, and you can start:</p>
            <ul>
                <li>Managing your services</li>
                <li>Accepting appointments</li>
                <li>Customizing your business profile</li>
                <li>Connecting with new customers</li>
            </ul>
            
            <p style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/barber/dashboard') }}" class="button">Go to Your Dashboard</a>
            </p>
            
            @if(isset($approval_notes) && $approval_notes)
                <div class="notes">
                    <p><strong>Note from our team:</strong></p>
                    <p>{{ $approval_notes }}</p>
                </div>
            @endif
            
            <p>If you have any questions or need assistance setting up your profile, please contact our support team.</p>
            
            <p>Thank you for choosing our platform for your business!</p>
            
            <p>Best regards,<br>The Barbershop Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Barbershop. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
