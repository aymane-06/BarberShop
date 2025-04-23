<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Completed</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
            color: #374151;
            line-height: 1.5;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.95) 0%, rgba(234, 88, 12, 0.8) 100%);
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 25px;
        }
        .booking-details {
            background-color: #f0fdf4;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .booking-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .booking-item:last-child {
            border-bottom: none;
        }
        .button {
            display: inline-block;
            background-color: #f59e0b;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin: 15px 0;
            text-align: center;
        }
        .footer {
            background-color: #f3f4f6;
            padding: 15px;
            text-align: center;
            font-size: 0.875rem;
            color: #6b7280;
        }
        .thank-you-box {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .rating {
            text-align: center;
            margin: 20px 0;
        }
        .rating a {
            display: inline-block;
            margin: 0 5px;
            color: #f59e0b;
            font-size: 24px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thank You For Your Visit!</h1>
            <p>We appreciate your business</p>
        </div>
        
        <div class="content">
            <div class="thank-you-box">
                <p>Hello {{ $booking->user->name ?? 'Valued Client' }},</p>
                <p>Thank you for choosing {{ $booking->barbershop->name ?? 'our barbershop' }}. We hope you enjoyed your experience with us!</p>
            </div>
            
            <p>Your appointment has been completed successfully. Here's a summary of your visit:</p>
            
            <div class="booking-details">
                <div class="booking-item">
                    <strong>Date:</strong>
                    <span>{{ date('l, F j, Y', strtotime($booking->booking_date)) }}</span>
                </div>
                
                <div class="booking-item">
                    <strong>Time:</strong>
                    <span>{{ date('g:i A', strtotime($booking->time)) }}</span>
                </div>
                
                @if($booking->barber_name)
                <div class="booking-item">
                    <strong>Your Barber:</strong>
                    <span>{{ $booking->barber_name }}</span>
                </div>
                @endif
                
                <div class="booking-item">
                    <strong>Services:</strong>
                    <div>
                        <ul style="list-style: none; padding-left: 0;">
                            @if($booking->services)
                                @foreach($booking->services as $service)
                                    <li>{{ $service->name ?? 'Service' }} - ${{ number_format($service->price ?? 0, 2) }}</li>
                                @endforeach
                            @else
                                <li>Service package</li>
                            @endif
                        </ul>
                    </div>
                </div>
                
                <div class="booking-item">
                    <strong>Amount Paid:</strong>
                    <span>${{ number_format($booking->amount, 2) }}</span>
                </div>
            </div>
            
            <p>How was your experience? We'd love to hear your feedback!</p>
            
            <div class="rating">
                <p>Rate your experience:</p>
                <a href="">★</a>
                <a href="">★★</a>
                <a href="">★★★</a>
                <a href="">★★★★</a>
                <a href="">★★★★★</a>
            </div>
            
            <p>Looking forward to your next visit? Book your next appointment now and secure your preferred time slot!</p>
            
            <div style="text-align: center;">
                <a href="" class="button">Book Next Appointment</a>
            </div>
            
            <p>We value your loyalty and look forward to serving you again soon.</p>
            
            <p>Best regards,<br>
            The {{ $booking->barbershop->name ?? 'CutBook' }} Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} CutBook. All rights reserved.</p>
            <p>This is an automated message, please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html></html>