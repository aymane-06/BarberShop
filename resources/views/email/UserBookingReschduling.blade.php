<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Booking Has Been Rescheduled</title>
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
            background-color: #fff7ed;
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
        .services-list {
            list-style: none;
            padding-left: 0;
        }
        .services-list li {
            padding: 6px 0;
            border-bottom: 1px dotted #e5e7eb;
        }
        .services-list li:last-child {
            border-bottom: none;
        }
        .changes {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            padding: 10px 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Your Booking Has Been Rescheduled</h1>
            <p>The details of your appointment have been updated</p>
        </div>
        
        <div class="content">
            <p>Hello {{ $booking->user->name ?? 'Valued Customer' }},</p>
            
            <p>Your booking at <strong>{{ $booking->barbershop->name ?? 'our barbershop' }}</strong> with reference number <strong>{{ $booking->booking_reference }}</strong> has been successfully rescheduled.</p>
            
            <div class="booking-details">
                <div class="booking-item">
                    <strong>Barbershop:</strong>
                    <span>{{ $booking->barbershop->name ?? 'Our Barbershop' }}</span>
                </div>
                
                <div class="booking-item">
                    <strong>New Date:</strong>
                    <span>{{ date('l, F j, Y', strtotime($booking->booking_date)) }}</span>
                </div>
                
                <div class="booking-item">
                    <strong>New Time:</strong>
                    <span>{{ date('g:i A', strtotime($booking->time)) }}</span>
                </div>
                
                @if($booking->barber_name)
                <div class="booking-item">
                    <strong>Barber:</strong>
                    <span>{{ $booking->barber_name }}</span>
                </div>
                @endif
                
                <div class="booking-item">
                    <strong>Duration:</strong>
                    <span>{{ $booking->duration }} minutes</span>
                </div>
                
                <div class="booking-item">
                    <strong>Amount:</strong>
                    <span>${{ number_format($booking->amount, 2) }}</span>
                </div>
                
                <div class="booking-item">
                    <strong>Payment Status:</strong>
                    <span class="status-badge">{{ ucfirst($booking->payment_status) }}</span>
                </div>
                
                <div class="booking-item">
                    <strong>Services:</strong>
                    <div>
                        <ul class="services-list">
                            @if($booking->services)
                                @foreach($booking->services as $service)
                                    <li>{{ $service->name ?? 'Unknown Service' }} - ${{ number_format($service->price ?? 0, 2) }}</li>
                                @endforeach
                            @else
                                <li>No services listed</li>
                            @endif
                        </ul>
                    </div>
                </div>
                
                @if(isset($booking->notes) && !empty($booking->notes))
                <div class="booking-item">
                    <strong>Notes:</strong>
                    <span>{{ $booking->notes }}</span>
                </div>
                @endif
            </div>
            
            <p>Please mark this date in your calendar. If you need to make any further changes to your appointment, please do so at least 24 hours before your scheduled time.</p>
            
            <a href="" class="button">View My Bookings</a>
            
            <p>If you have any questions or need assistance, please contact the barbershop at {{ $booking->barbershop->phone ?? 'their contact number' }}.</p>
            
            <p>We look forward to seeing you!</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} CutBook. All rights reserved.</p>
            <p>This is an automated message, please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html></div>}</head>