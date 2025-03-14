<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Reset Your Password</title>
    <style>
        @media only screen and (max-width: 620px) {
            table.body h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }

            table.body p,
            table.body ul,
            table.body ol,
            table.body td,
            table.body span,
            table.body a {
                font-size: 16px !important;
            }

            table.body .wrapper {
                padding: 10px !important;
            }

            table.body .content {
                padding: 0 !important;
            }

            table.body .container {
                padding: 0 !important;
                width: 100% !important;
            }

            table.body .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }

            table.body .btn table {
                width: 100% !important;
            }

            table.body .btn a {
                width: 100% !important;
            }
        }

        body {
            font-family: 'Poppins', 'Helvetica', sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 16px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            background-color: #f5f7fa;
        }

        .logo-img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .header {
            padding: 20px 0;
            text-align: center;
        }

        .content-cell {
            padding: 35px;
        }

        .button {
            background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%);
            border-radius: 8px;
            color: #ffffff !important;
            display: inline-block;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            padding: 14px 24px;
            margin: 20px 0;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background: linear-gradient(135deg, #6d28d9 0%, #4c1d95 100%);
        }

        .purple-text {
            color: #7c3aed;
        }

        .footer {
            color: #6b7280;
            font-size: 14px;
            text-align: center;
            padding: 20px;
        }

        .footer a {
            color: #7c3aed;
            text-decoration: none;
        }

        .social-icons {
            margin: 15px 0;
        }

        .social-icon {
            display: inline-block;
            margin: 0 5px;
        }
        
        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .border-top {
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body style="background-color: #f5f7fa; margin: 0; padding: 0;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" width="100%">
        <tr>
            <td>&nbsp;</td>
            <td class="container" width="600">
                <div class="content">
                    <!-- Header -->
                    <table role="presentation" class="header" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="center">
                                <img src="" alt="CutBook Logo" class="logo-img">
                            </td>
                        </tr>
                    </table>
                    
                    <!-- Main Content -->
                    <table role="presentation" class="main card" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-cell">
                                <h1 style="color: #111827; font-size: 24px; font-weight: 700; margin-top: 0;">Reset Your Password</h1>
                                <p style="color: #4b5563;">Hello,</p>
                                <p style="color: #4b5563;">You recently requested to reset your password for your <span class="purple-text">CutBook</span> account. Click the button below to proceed:</p>
                                
                                <div style="text-align: center;">
                                    <a href="{{ $resetUrl }}" class="button" target="_blank">Reset Password</a>
                                </div>
                                
                                <p style="color: #4b5563;">This password reset link will expire in 60 minutes. If you didn't request a password reset, please ignore this email or contact our support team if you have questions.</p>
                                
                                <p style="color: #4b5563;">If you're having trouble clicking the button, copy and paste the URL below into your web browser:</p>
                                <p style="color: #6b7280; font-size: 14px; word-break: break-all;">{{ $resetUrl }}</p>
                                
                                <div class="border-top">
                                    <p style="color: #4b5563;">Thanks,<br>The CutBook Team</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    
                    <!-- Additional Info -->
                    <table role="presentation" class="card" width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-cell">
                                <h2 style="color: #111827; font-size: 18px; font-weight: 600; margin-top: 0;">Password Tips</h2>
                                <ul style="color: #4b5563; padding-left: 20px;">
                                    <li>Use at least 8 characters</li>
                                    <li>Include uppercase and lowercase letters</li>
                                    <li>Add numbers and special characters</li>
                                    <li>Don't reuse passwords from other sites</li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    
                    <!-- Footer -->
                    <div class="footer">
                        <p>© {{ date('Y') }} CutBook. All rights reserved.</p>
                        <p>Modern barber booking platform for the perfect cut.</p>
                        <div class="social-icons">
                            <a href="#" class="social-icon"><img src="https://img.icons8.com/material-rounded/24/7c3aed/facebook-f.png" alt="Facebook"></a>
                            <a href="#" class="social-icon"><img src="https://img.icons8.com/material-rounded/24/7c3aed/instagram-new.png" alt="Instagram"></a>
                            <a href="#" class="social-icon"><img src="https://img.icons8.com/material-rounded/24/7c3aed/twitter.png" alt="Twitter"></a>
                        </div>
                        <p>
                            <a href="#">Privacy Policy</a> •
                            <a href="#">Terms of Service</a> •
                            <a href="#">Contact Us</a>
                        </p>
                        <p style="font-size: 12px; color: #9ca3af;">
                            If you have any questions, feel free to <a href="mailto:support@cutbook.com">contact our support team</a>
                        </p>
                    </div>
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>
</html></td></head>