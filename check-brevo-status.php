<?php

/**
 * Script untuk mengecek status email di Brevo
 * Menggunakan Brevo API untuk melihat statistik pengiriman
 */

require_once 'vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['BREVO_API_KEY'];

echo "🔍 Checking Brevo Email Status...\n";
echo "🔑 API Key: " . substr($apiKey, 0, 20) . "...\n\n";

// Function to make API request
function makeBrevoRequest($endpoint, $apiKey, $method = 'GET', $data = null) {
    $url = "https://api.brevo.com/v3/" . $endpoint;
    
    $headers = [
        'Accept: application/json',
        'Content-Type: application/json',
        'api-key: ' . $apiKey
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    
    if ($data && $method !== 'GET') {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    return [
        'status' => $httpCode,
        'data' => json_decode($response, true)
    ];
}

// 1. Check account info
echo "📊 1. Account Information:\n";
$accountInfo = makeBrevoRequest('account', $apiKey);
if ($accountInfo['status'] === 200) {
    $account = $accountInfo['data'];
    echo "   ✅ Account: " . $account['companyName'] . "\n";
    echo "   📧 Email: " . $account['email'] . "\n";
    echo "   📈 Plan: " . $account['plan'][0]['type'] . "\n";
    echo "   💳 Credits: " . $account['plan'][0]['credits'] . "\n\n";
} else {
    echo "   ❌ Failed to get account info\n\n";
}

// 2. Check senders
echo "📤 2. Verified Senders:\n";
$senders = makeBrevoRequest('senders', $apiKey);
if ($senders['status'] === 200) {
    foreach ($senders['data']['senders'] as $sender) {
        $status = $sender['active'] ? '✅' : '❌';
        echo "   $status " . $sender['email'] . " (" . $sender['name'] . ")\n";
    }
    echo "\n";
} else {
    echo "   ❌ Failed to get senders info\n\n";
}

// 3. Check domains
echo "🌐 3. Verified Domains:\n";
$domains = makeBrevoRequest('senders/domains', $apiKey);
if ($domains['status'] === 200) {
    if (empty($domains['data']['domains'])) {
        echo "   ⚠️  No domains configured\n\n";
    } else {
        foreach ($domains['data']['domains'] as $domain) {
            $status = $domain['domain_verified'] ? '✅' : '❌';
            echo "   $status " . $domain['domain'] . "\n";
        }
        echo "\n";
    }
} else {
    echo "   ❌ Failed to get domains info\n\n";
}

// 4. Get recent email statistics (last 7 days)
echo "📈 4. Recent Email Statistics (Last 7 days):\n";
$endDate = date('Y-m-d');
$startDate = date('Y-m-d', strtotime('-7 days'));

$stats = makeBrevoRequest("emailCampaigns/statistics?startDate=$startDate&endDate=$endDate", $apiKey);
if ($stats['status'] === 200) {
    $data = $stats['data'];
    echo "   📤 Sent: " . ($data['sent'] ?? 0) . "\n";
    echo "   ✅ Delivered: " . ($data['delivered'] ?? 0) . "\n";
    echo "   ❌ Bounced: " . ($data['hardBounces'] ?? 0) . " hard, " . ($data['softBounces'] ?? 0) . " soft\n";
    echo "   📬 Opened: " . ($data['uniqueOpens'] ?? 0) . "\n";
    echo "   🔗 Clicked: " . ($data['uniqueClicks'] ?? 0) . "\n\n";
} else {
    echo "   ⚠️  No statistics available\n\n";
}

// 5. Check SMTP statistics
echo "📧 5. SMTP Statistics (Transactional Emails):\n";
$smtpStats = makeBrevoRequest("smtp/statistics?startDate=$startDate&endDate=$endDate", $apiKey);
if ($smtpStats['status'] === 200) {
    $data = $smtpStats['data'];
    echo "   📤 Requests: " . ($data['requests'] ?? 0) . "\n";
    echo "   ✅ Delivered: " . ($data['delivered'] ?? 0) . "\n";
    echo "   ❌ Bounced: " . ($data['hardBounces'] ?? 0) . " hard, " . ($data['softBounces'] ?? 0) . " soft\n";
    echo "   🚫 Blocked: " . ($data['blocked'] ?? 0) . "\n";
    echo "   📬 Opened: " . ($data['uniqueOpens'] ?? 0) . "\n";
    echo "   🔗 Clicked: " . ($data['uniqueClicks'] ?? 0) . "\n\n";
} else {
    echo "   ⚠️  No SMTP statistics available\n\n";
}

echo "✅ Status check completed!\n";
echo "\n💡 Tips:\n";
echo "   - Make sure your sender email is verified\n";
echo "   - Check if domain is properly configured\n";
echo "   - Monitor bounce rates and blocked emails\n";
echo "   - Gmail may delay emails from new domains\n";

?>
