<?php

// Test script to insert member data directly
require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Member;

try {
    echo "Testing Member model insertion...\n";
    
    // Test data similar to what form would send
    $testData = [
        'nama_lengkap' => 'Test User Keluarga',
        'jenis_kelamin' => 'Laki-laki',
        'tempat_lahir' => 'Jakarta',
        'tanggal_lahir' => '1990-01-01',
        'alamat' => 'Data keluarga - Kepala Keluarga',
        'pekerjaan' => 'Software Engineer',
        'status_pernikahan' => 'Menikah',
        'email' => 'test@example.com',
        'status' => 'active',
        'nama_ayah' => 'Baptis: S, Sidi: S',
        'nama_ibu' => 'Pendidikan: S1',
        'nama_pasangan' => 'Jakarta, 2020-01-01',
    ];
    
    echo "Data to insert:\n";
    print_r($testData);
    
    // Try to create member
    $member = Member::create($testData);
    
    echo "Member created successfully!\n";
    echo "ID: " . $member->id . "\n";
    echo "Name: " . $member->nama_lengkap . "\n";
    echo "Email: " . $member->email . "\n";
    
    // Check if member exists in database
    $check = Member::find($member->id);
    if ($check) {
        echo "Member verified in database!\n";
    } else {
        echo "Member NOT found in database!\n";
    }
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "\nStack trace:\n";
    echo $e->getTraceAsString() . "\n";
}

// Also test database connection
try {
    echo "\nTesting database connection...\n";
    $count = Member::count();
    echo "Current members count: " . $count . "\n";
    
    // Show recent members
    $recent = Member::latest()->take(5)->get();
    echo "Recent members:\n";
    foreach ($recent as $member) {
        echo "- ID: {$member->id}, Name: {$member->nama_lengkap}, Email: {$member->email}\n";
    }
    
} catch (\Exception $e) {
    echo "Database connection error: " . $e->getMessage() . "\n";
}
