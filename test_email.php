<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    \Illuminate\Support\Facades\Mail::raw('Halo! Ini adalah test email dari sistem e-PPID PT Garam. Email ini dikirim ke alamat berbeda untuk membuktikan SMTP berfungsi dengan baik.', function($message) {
        $message->to('yonadamai@gmail.com')
                ->subject('Test Email e-PPID ke Alamat Lain');
    });
    echo "✅ EMAIL BERHASIL DIKIRIM ke yonadamai@gmail.com!\n";
} catch (\Exception $e) {
    echo "❌ GAGAL: " . $e->getMessage() . "\n";
}
