<?php

/**
 * Test kirim email ke beberapa provider untuk cek deliverability
 */

$testEmails = [
    'anjaykipas244@gmail.com' => 'Gmail',
    'suryawijaya1141@gmail.com' => 'Gmail (Verified Sender)',
    // Tambahkan email lain jika ada
];

$url = 'http://127.0.0.1:8000/api/email-verification/send-code';

echo "🧪 Testing Email Delivery to Multiple Providers...\n\n";

foreach ($testEmails as $email => $provider) {
    echo "📧 Testing: $email ($provider)\n";

    $data = [
        'email' => $email,
        'type' => 'baptism'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json'
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        $result = json_decode($response, true);
        if ($result['success']) {
            echo "   ✅ Sent successfully\n";
        } else {
            echo "   ❌ Failed: " . $result['message'] . "\n";
        }
    } else {
        echo "   ❌ HTTP Error: $httpCode\n";
        echo "   📄 Response: $response\n";
    }

    echo "   ⏱️  Waiting 2 seconds...\n\n";
    sleep(2);
}

echo "✅ All tests completed!\n";
echo "📬 Please check all inboxes (including spam folders)\n";
echo "⏰ Gmail may take 1-5 minutes to deliver emails\n";

?>
