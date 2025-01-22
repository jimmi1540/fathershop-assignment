<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $campaign->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            text-align: center;
            color: #333;
        }
        .email-body {
            color: #555;
            line-height: 1.6;
            font-size: 16px;
        }
        .email-footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
        .campaign-info {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f8f8;
            border-left: 4px solid #3498db;
            font-size: 16px;
            color: #333;
        }
        .btn {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .unsubscribe {
            font-size: 12px;
            color: #999;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1 class="email-header">{{ $campaign->title }}</h1>
        <p class="email-body">Hello {{ $customer->name }},</p>
        <p class="email-body">{{ $campaign->body }}</p>

        <div class="campaign-info">
            <p><strong>Status:</strong> {{ $customer->status }}</p>
            <p><strong>Expiry Date:</strong> {{ $customer->plan_expiry_date }}</p>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ $campaign->cta_link }}" class="btn">Shop Now</a>
        </div>

        <p class="email-footer">
            Best regards,<br>Your Company
        </p>
        <p class="unsubscribe">
            You are receiving this email because you subscribed to our newsletter. If you wish to unsubscribe, click <a href="{{ $campaign->unsubscribe_link }}">here</a>.
        </p>
    </div>
</body>
</html>
