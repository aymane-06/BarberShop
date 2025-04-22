<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Booking Has Been Canceled</title>
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
            background: linear-gradient(135deg, rgba(220, 38, 38, 0.95) 0%, rgba(185, 28, 28, 0.8) 100%);
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 25px;
        }
        .booking-details {
            background-color: #fef2f2;
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
            background-color: #dc2626;
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
        .cancellation-reason {
            background-color: #fef2f2;
            border-left: 4px solid #dc2626;
            padding: 12px 15px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Booking Canceled</h1>
            <p>Your appointment has been canceled</p>
        </div>
        
        <div class="content">
            <p>Hello {{ $booking->user->name }},</p>
            
            <p>Your booking with <strong>{{ $booking->barbershop->name }}</strong> (reference number: <strong>{{ $booking->booking_reference }}</strong>) has been canceled.</p>
            
            <div class="cancellation-reason">
                <strong>Cancellation Reason:</strong> {{ $canlelationReason }}
                @if($notes)
                <p><strong>Additional Notes:</strong> {{ $notes }}</p>
                @endif
            </div>
            
            <p>Here are the details of your canceled booking:</p>
            
            <div class="booking-details">
                <div class="booking-item">
                    <strong>Barbershop:</strong>
                    <span>{{ $booking->barbershop->name }}</span>
                </div>
                
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
                    <strong>Requested Barber:</strong>
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
                    <strong>Services:</strong>
                    <div>
                        <ul class="services-list">
                            @foreach($booking->services as $service)
                                <li>{{ $service->name }} - ${{ number_format($service->price, 2) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            
            <p>You can book another appointment by clicking the button below:</p>
            
            <a href="" class="button">Book New Appointment</a>
            
            <p>If you have any questions about this cancellation, please contact {{ $booking->barbershop->name }} at {{ $booking->barbershop->email ?? $booking->barbershop->phone }}.</p>
            
            <p>Thank you for using CutBook!</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} CutBook. All rights reserved.</p>
            <p>This is an automated message, please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>