<?php

// Test script to make direct HTTP request to form submission
require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LandingController;

try {
    echo "Testing direct form submission...\n";
    
    // Create a mock request with form data
    $formData = [
        'anggota' => [
            1 => [
                'nama_lengkap' => 'Test Direct Form',
                'jenis_kelamin' => 'Lk',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'status_baptis' => 'S',
                'status_sidi' => 'S',
                'tempat_nikah' => 'Jakarta',
                'tanggal_nikah' => '2020-01-01',
                'hubungan_keluarga' => 'Kepala Keluarga',
                'pendidikan' => 'S1',
                'pekerjaan' => 'Software Engineer',
                'status' => 'K'
            ]
        ],
        'email' => 'testdirect@example.com',
        '_token' => csrf_token()
    ];
    
    // Set up session for email verification
    Session::put('anggota_email_verified', true);
    Session::put('anggota_verified_email', 'testdirect@example.com');
    
    // Create request
    $request = Request::create('/submit-anggota', 'POST', $formData);
    
    // Create controller instance
    $controller = new LandingController();
    
    echo "Calling submitAnggota method...\n";
    
    // Call the method directly
    $response = $controller->submitAnggota($request);
    
    echo "Response type: " . get_class($response) . "\n";
    
    if (method_exists($response, 'getContent')) {
        echo "Response content: " . $response->getContent() . "\n";
    }
    
    if (method_exists($response, 'getStatusCode')) {
        echo "Status code: " . $response->getStatusCode() . "\n";
    }
    
    // Check if data was saved
    $count = \App\Models\Member::where('email', 'testdirect@example.com')->count();
    echo "Members with test email: {$count}\n";
    
    if ($count > 0) {
        echo "SUCCESS: Data was saved to database!\n";
        $members = \App\Models\Member::where('email', 'testdirect@example.com')->get();
        foreach ($members as $member) {
            echo "- ID: {$member->id}, Name: {$member->nama_lengkap}\n";
        }
    } else {
        echo "FAILED: No data was saved to database!\n";
    }
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "\nStack trace:\n";
    echo $e->getTraceAsString() . "\n";
}
