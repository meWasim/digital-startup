<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f7;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .email-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-color: #f4f4f7;
            width: 100%;
        }
        .email-container {
            width: 100%;
            max-width: 95vw;
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #0056b3;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            font-size: 24px;
            margin: 0;
        }
        .email-body {
            padding: 30px;
            color: #555;
        }
        .email-body h2 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #333;
        }
        .email-body p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .email-body a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #0056b3;
            text-decoration: none;
            border-radius: 5px;
        }
        .email-body a:hover {
            background-color: #003d82;
        }
        .email-footer {
            text-align: center;
            padding: 15px;
            font-size: 14px;
            background-color: #f4f4f7;
            color: #888;
            border-top: 1px solid #ddd;
        }
        .email-footer p {
            margin: 5px 0;
        }
        .email-footer a {
            color: #0056b3;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">
            <!-- Email Header -->
            <div class="email-header">
                <h1>Thank You for Reaching Out!</h1>
            </div>

            <!-- Email Body -->
            <div class="email-body">
                <h2>Hi {{ $user->full_name }},</h2>
                <p>We’ve received your message and want to thank you for contacting us. Our team is reviewing your query and will respond as soon as possible.</p>
                <p>In the meantime, feel free to browse through our website or reach out to us for any urgent matters.</p>
                <a href="https://yourcompanywebsite.com">Visit Our Website</a>
            </div>

            <!-- Email Footer -->
            <div class="email-footer">
                <p>&copy; {{ date('Y') }} Digital Startups. All rights reserved.</p>
                <p><a href="mailto:support@digitalstartups.com">Contact Support</a></p>
            </div>
        </div>
    </div>
</body>
</html>
