<?php

require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationCodeMail;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "🚀 Testing Brevo API Email (ACTIVATED)...\n";

    // Test email address - bisa kirim ke email manapun dengan Brevo yang sudah aktif
    $testEmail = 'anjaykipas244@gmail.com'; // Email untuk testing
    $verificationCode = '123456';

    echo "📧 Sending to: {$testEmail}\n";
    echo "🔑 Verification code: {$verificationCode}\n";

    Mail::to($testEmail)->send(new VerificationCodeMail($verificationCode, 'baptism'));

    echo "✅ Email sent successfully!\n";
    echo "📬 Check your inbox at {$testEmail}\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "📋 Stack trace:\n" . $e->getTraceAsString() . "\n";
}
