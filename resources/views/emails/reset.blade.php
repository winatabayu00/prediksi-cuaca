<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
<p>Halo,</p>
<p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.</p>
<p>
    <a href="{{ $resetLink }}" style="display:inline-block;padding:10px 20px;background-color:#3490dc;color:#fff;text-decoration:none;border-radius:5px;">
        Reset Password
    </a>
</p>
<p>Jika Anda tidak meminta reset password, abaikan email ini.</p>
<p>Terima kasih,<br>{{ config('app.name') }}</p>
</body>
</html>
