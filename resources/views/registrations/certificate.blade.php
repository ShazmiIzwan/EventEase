<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate of Participation</title>
    <style>
        body { font-family: sans-serif; text-align: center; color: #333; }
        .border { border: 10px solid #255ff4; padding: 30px; }
        .inner { border: 5px solid #f4a825; padding: 20px; }
        .title { font-size: 32px; margin-top: 20px; }
        .subtitle { font-size: 18px; margin: 20px 0; }
        .name { font-size: 28px; font-weight: bold; margin: 20px 0; }
        .details { font-size: 16px; margin: 30px 0; }
        .footer { margin-top: 50px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="border">
        <div class="inner">
            <h1 class="title">Certificate of Participation</h1>
            <p class="subtitle">This is to certify that</p>

            <p class="name">{{ $reg->first_name }} {{ $reg->last_name }}</p>

            <p class="details">
                has successfully participated in<br>
                <strong>{{ $reg->events->event_name }}</strong><br>
                on {{ \Carbon\Carbon::parse($reg->events->event_date)->format('d F Y') }}
                at {{ \Carbon\Carbon::parse($reg->events->event_time)->format('h:i A') }}<br>
                (Category: {{ $reg->events->getcategory->category }})
            </p>
            
            <div class="footer">
                Issued on {{ \Carbon\Carbon::parse($reg->certificate_issued_at)->format('d F Y') }}<br>
                <em>__________________________</em><br>
                <strong>Event Organizer</strong>
            </div>
        </div>
    </div>
</body>
</html>
