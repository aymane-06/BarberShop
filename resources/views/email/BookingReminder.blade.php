<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Reminder</title>
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
        .reminder-box {
            background-color: #fffbeb;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin-bottom: 20px;
            font-weight: 500;
        }
        .actions {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Appointment Reminder</h1>
            <p>Your appointment is coming up soon!</p>
        </div>
        
        <div class="content">
            <div class="reminder-box">
                <p>Hello {{ $booking->user->name ?? 'Valued Client' }},</p>
                <p>This is a friendly reminder that your appointment at {{ $booking->barbershop->name ?? 'our barbershop' }} is coming up soon.</p>
            </div>
            
            <p>{{ $note }}</p>
            
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
                    <strong>Amount Due:</strong>
                    <span>${{ number_format($booking->amount, 2) }}</span>
                </div>
            </div>
            
            <p>If you need to make any changes to your appointment, please contact us as soon as possible.</p>
            
            <div class="actions">
                <a href="" class="button">Manage Appointment</a>
            </div>
            
            <p>We look forward to seeing you soon!</p>
            
            <p>Best regards,<br>
            The {{ $booking->barbershop->name ?? 'CutBook' }} Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} CutBook. All rights reserved.</p>
            <p>This is an automated message, please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html></div></div>