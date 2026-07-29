<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kode Verifikasi e-PPID</title>
    <style>
        body { font-family: 'Helvetica Neue', Arial, sans-serif; background-color: #f8fafc; margin: 0; padding: 0; color: #334155; }
        .email-container { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; }
        .header { background: linear-gradient(135deg, #1d4ed8, #2563eb); padding: 30px; text-align: center; color: #ffffff; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 800; letter-spacing: 1px; }
        .content { padding: 35px 30px; text-align: center; }
        .content p { font-size: 15px; line-height: 1.6; color: #475569; margin-bottom: 20px; }
        .otp-box { background: #f1f5f9; border: 2px dashed #3b82f6; border-radius: 10px; padding: 20px; display: inline-block; margin: 15px 0 25px 0; min-width: 250px; }
        .otp-code { font-size: 36px; font-weight: 800; letter-spacing: 10px; color: #1e3a8a; margin: 0; }
        .footer { background: #f8fafc; padding: 20px; text-align: center; font-size: 13px; color: #64748b; border-top: 1px solid #e2e8f0; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>e-PPID PT GARAM</h1>
            <p style="margin: 6px 0 0 0; font-size: 14px; opacity: 0.95; font-weight: 500;">Layanan Informasi Publik</p>
        </div>
        <div class="content">
            <h2 style="color: #0f172a; margin-top: 0; font-size: 22px;">Verifikasi Akun Anda</h2>
            <p>Halo, <strong style="color: #1e293b;">{{ $nama }}</strong>!</p>
            <p>Terima kasih telah mendaftar pada Sistem Layanan Informasi Publik (e-PPID) PT Garam. Untuk mengaktifkan akun email <strong>{{ $email }}</strong> Anda, silakan klik tombol verifikasi di bawah ini:</p>
            
            <div style="margin: 25px 0;">
                <a href="{{ $url_verifikasi }}" style="display: inline-block; background: linear-gradient(135deg, #1d4ed8, #2563eb); color: #ffffff; text-decoration: none; padding: 15px 32px; border-radius: 8px; font-weight: 700; font-size: 16px; box-shadow: 0 4px 12px rgba(37,99,235,0.3);">
                    VERIFIKASI AKUN SAYA SEKARANG
                </a>
            </div>

            <p style="font-size: 14px; color: #64748b; margin-top: 20px; margin-bottom: 10px;">
                <em>Atau jika Anda membuka email ini di perangkat lain, Anda juga bisa memasukkan 6 digit kode OTP berikut secara manual pada halaman verifikasi web:</em>
            </p>
            
            <div class="otp-box">
                <div class="otp-code">{{ $kode_otp }}</div>
            </div>

            <p style="font-size: 13px; color: #64748b; margin-bottom: 0; border-top: 1px dashed #e2e8f0; padding-top: 15px; margin-top: 20px;">
                Demi keamanan akun Anda, jangan membagikan tautan atau kode verifikasi ini kepada siapa pun. Tautan ini bersifat unik (berenkripsi Signed Token) dan berlaku selama 24 jam.
            </p>
        </div>
        <div class="footer">
            <p style="margin: 0;">&copy; {{ date('Y') }} PPID PT Garam. Hak Cipta Dilindungi Undang-Undang.</p>
        </div>
    </div>
</body>
</html>
