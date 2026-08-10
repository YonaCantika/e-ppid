<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password - e-PPID PT Garam</title>
    <style>
        body { font-family: 'Helvetica Neue', Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 0; color: #334155; }
        .email-container { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; }
        .header { background: linear-gradient(135deg, #dc2626, #ef4444); padding: 30px; text-align: center; color: #ffffff; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 800; letter-spacing: 1px; }
        .content { padding: 35px 30px; text-align: center; }
        .content p { font-size: 15px; line-height: 1.6; color: #475569; margin-bottom: 20px; }
        .otp-box { background: #fef2f2; border: 2px dashed #ef4444; border-radius: 10px; padding: 20px; display: inline-block; margin: 15px 0 25px 0; min-width: 250px; }
        .otp-code { font-size: 32px; font-weight: 800; letter-spacing: 8px; color: #991b1b; margin: 0; font-family: 'Courier New', monospace; }
        .warning-box { background: #fffbeb; border: 1px solid #f59e0b; border-radius: 8px; padding: 15px; margin: 20px 0; text-align: left; }
        .warning-box p { font-size: 13px; color: #92400e; margin: 0; }
        .footer { background: #f8fafc; padding: 20px; text-align: center; font-size: 13px; color: #64748b; border-top: 1px solid #e2e8f0; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>e-PPID PT GARAM</h1>
            <p style="margin: 6px 0 0 0; font-size: 14px; opacity: 0.95; font-weight: 500;">Reset Password</p>
        </div>
        <div class="content">
            <h2 style="color: #0f172a; margin-top: 0; font-size: 22px;">🔒 Permintaan Reset Password</h2>
            <p>Halo, <strong style="color: #1e293b;">{{ $nama }}</strong>!</p>
            <p>Kami menerima permintaan untuk mereset password akun Anda (<strong>{{ $email }}</strong>) pada Sistem Layanan Informasi Publik (e-PPID) PT Garam.</p>
            <p>Silakan masukkan kode verifikasi berikut pada halaman reset password:</p>
            
            <div class="otp-box">
                <div class="otp-code">{{ $kode_unik }}</div>
            </div>

            <div class="warning-box">
                <p>⚠️ <strong>Penting:</strong> Jika Anda tidak merasa melakukan permintaan reset password ini, abaikan email ini. Password Anda tidak akan berubah.</p>
            </div>

            <p style="font-size: 13px; color: #64748b; margin-bottom: 0; border-top: 1px dashed #e2e8f0; padding-top: 15px; margin-top: 20px;">
                Demi keamanan akun Anda, jangan membagikan kode verifikasi ini kepada siapa pun. Kode ini hanya berlaku untuk satu kali penggunaan.
            </p>
        </div>
        <div class="footer">
            <p style="margin: 0;">&copy; {{ date('Y') }} PPID PT Garam. Hak Cipta Dilindungi Undang-Undang.</p>
        </div>
    </div>
</body>
</html>
