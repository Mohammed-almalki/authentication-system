<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body style="background-color: #f4f4f7; margin: 0; padding: 1rem; font-family: Arial, sans-serif; color: #333;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 20px; border-radius: 8px;">
                    <tr>
                        <td align="center" style="background-color: #000000; color: #ffffff; font-size: 24px; font-weight: bold; padding: 10px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            Password Reset Request
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 20px; font-size: 16px; color: #555;">
                            <p>Hello,</p>
                            <p>You requested a password reset. Click the link below to reset your password:</p>
                            <p style="text-align: center;">
                                <a href="{{ url('reset-password', $token) }}?email={{ urlencode($email) }}" style="display: inline-block; padding: 12px 24px; font-size: 16px; color: #ffffff; background-color: #000000; text-decoration: none; border-radius: 4px; font-weight: bold;">
                                    Reset Password
                                </a>
                            </p>
                            <p>If you did not request a password reset, please ignore this email or contact support if you have questions.</p>
                            <p>Thank you,<br>The Support Team</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px; color: #888; text-align: center; padding: 20px;">
                            <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
                            <p><a href="{{ url('reset-password', $token) }}?email={{ urlencode($email) }}" style="color: #4CAF50;">{{ url('reset-password', $token) }}?email={{ urlencode($email) }}</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>


