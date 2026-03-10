<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking Cancelled – FurryTails</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 0; }
        .wrapper { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        .header { background: #ef4444; padding: 30px 40px; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 24px; }
        .header p { color: rgba(255,255,255,.85); margin: 6px 0 0; font-size: 14px; }
        .body { padding: 32px 40px; }
        .greeting { font-size: 16px; color: #374151; margin-bottom: 20px; }
        .card { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; margin-bottom: 20px; }
        .card h3 { margin: 0 0 14px; color: #111827; font-size: 15px; }
        .row { display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid #e5e7eb; font-size: 14px; }
        .row:last-child { border-bottom: none; }
        .label { color: #6b7280; }
        .value { color: #111827; font-weight: 600; }
        .badge-cancelled { display: inline-block; background: #fee2e2; color: #991b1b; padding: 3px 10px; border-radius: 12px; font-size: 13px; font-weight: 600; }
        .note { font-size: 13px; color: #6b7280; margin-top: 20px; line-height: 1.6; }
        .cta { display: inline-block; margin-top: 16px; background: #24CFF4; color: #fff; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; }
        .footer { background: #f9fafb; padding: 20px 40px; text-align: center; font-size: 12px; color: #9ca3af; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>🐾 FurryTails Pet Clinic</h1>
        <p>Booking Cancelled</p>
    </div>
    <div class="body">
        <p class="greeting">Hi <strong>{{ $user->firstName }}</strong>,</p>
        <p style="color:#374151;font-size:15px;">
            Your {{ $bookingType }} has been cancelled. Here are the details of the cancelled booking:
        </p>

        @if ($bookingType === 'appointment')
        <div class="card">
            <h3>📅 Cancelled Appointment</h3>
            <div class="row"><span class="label">Service</span><span class="value">{{ $booking->service->name ?? 'N/A' }}</span></div>
            <div class="row"><span class="label">Pet</span><span class="value">{{ $booking->pet->name ?? 'N/A' }}</span></div>
            <div class="row"><span class="label">Date</span><span class="value">{{ \Carbon\Carbon::parse($booking->date)->format('F j, Y') }}</span></div>
            <div class="row"><span class="label">Time</span><span class="value">{{ \Carbon\Carbon::parse($booking->time)->format('g:i A') }}</span></div>
            <div class="row"><span class="label">Status</span><span class="value"><span class="badge-cancelled">Cancelled</span></span></div>
        </div>
        @else
        <div class="card">
            <h3>🏠 Cancelled Boarding</h3>
            <div class="row"><span class="label">Type</span><span class="value">{{ $booking->boardingType }}</span></div>
            <div class="row"><span class="label">Pet</span><span class="value">{{ $booking->pet->name ?? 'N/A' }}</span></div>
            <div class="row"><span class="label">Check-in</span><span class="value">{{ \Carbon\Carbon::parse($booking->start_date)->format('F j, Y') }}</span></div>
            <div class="row"><span class="label">Check-out</span><span class="value">{{ \Carbon\Carbon::parse($booking->end_date)->format('F j, Y') }}</span></div>
            <div class="row"><span class="label">Status</span><span class="value"><span class="badge-cancelled">Cancelled</span></span></div>
        </div>
        @endif

        <p class="note">
            If you believe this cancellation was made in error, or if you'd like to rebook, please log in to your account.
        </p>
        <p class="note">
            Thank you for being a valued FurryTails customer. We hope to see you and your furry friend soon! 🐾
        </p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} FurryTails Pet Clinic. All rights reserved.<br>
        This is an automated email — please do not reply directly.
    </div>
</div>
</body>
</html>
