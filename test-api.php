<?php

require_once 'vendor/autoload.php';

echo "🧪 Testing Email Verification API...\n";

// Test data
$email = 'anjaykipas244@gmail.com'; // Email untuk testing Brevo
$url = 'http://127.0.0.1:8000/api/email-verification/send-code';

echo "📧 Testing email: {$email}\n";
echo "🌐 API URL: {$url}\n\n";

// Prepare data
$data = [
    'email' => $email,
    'type' => 'baptism'
];

// Initialize cURL
$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'Accept: application/json'
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => true
]);

// Execute request
echo "🚀 Sending request...\n";
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);

curl_close($ch);

// Display results
echo "📊 Results:\n";
echo "HTTP Status: {$httpCode}\n";

if ($error) {
    echo "❌ cURL Error: {$error}\n";
} else {
    echo "📄 Response:\n";
    $decoded = json_decode($response, true);
    if ($decoded) {
        echo json_encode($decoded, JSON_PRETTY_PRINT) . "\n";
    } else {
        echo $response . "\n";
    }
}

echo "\n✅ Test completed!\n";
