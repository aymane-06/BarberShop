<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barbershop Application Reconsideration</title>
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
        .notes-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #17a2b8;
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
            <h2>Barbershop Application Reconsideration</h2>
        </div>
        
        <div class="content">
            <p>Hello {{ $barbershop->user->name ?? 'there' }},</p>
            
            <p>We have received your reconsideration request for <strong>{{ $barbershop->name }}</strong>.</p>
            
            <div class="notes-box">
                <h3>Your Reconsideration Notes:</h3>
                <p>{{ $reconsideration_notes }}</p>
            </div>
            
            <p>Our team will review your application again taking into account the additional information you've provided. We'll get back to you as soon as possible with our decision.</p>
            
            <p>In the meantime, if you have any questions or need to provide additional information, please don't hesitate to reach out to our support team.</p>
            
            <p style="text-align: center; margin: 30px 0;">
                <a href="" class="button">Contact Support</a>
            </p>
            
            <p>Thank you for your patience,<br>The Barbershop Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Barbershop. All rights reserved.</p>
        </div>
    </div>
</body>
</html>