<?php

// Test script to simulate form submission
require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Member;
use Illuminate\Support\Facades\Session;

try {
    echo "Simulating form submission...\n";
    
    // Simulate session data (email verification)
    Session::put('anggota_email_verified', true);
    Session::put('anggota_verified_email', 'test@example.com');
    
    // Simulate form data structure
    $formData = [
        'anggota' => [
            1 => [
                'nama_lengkap' => 'John Doe',
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
        'email' => 'test@example.com'
    ];
    
    echo "Form data structure:\n";
    print_r($formData);
    
    // Simulate the controller logic
    $validated = $formData; // Skip validation for test
    
    // Check email verification
    $emailVerified = Session::get('anggota_email_verified');
    $verifiedEmail = Session::get('anggota_verified_email');
    
    echo "\nEmail verification status:\n";
    echo "anggota_email_verified: " . ($emailVerified ? 'true' : 'false') . "\n";
    echo "anggota_verified_email: " . $verifiedEmail . "\n";
    echo "submitted_email: " . $validated['email'] . "\n";
    
    if (!$emailVerified || $verifiedEmail !== $validated['email']) {
        echo "Email verification failed!\n";
        exit;
    }
    
    $savedMembers = [];
    
    // Process each family member
    foreach ($validated['anggota'] as $index => $anggotaData) {
        echo "\nProcessing member {$index}:\n";
        print_r($anggotaData);
        
        // Generate member number
        $memberNumber = $index == 1 ? 'KK-001' : 'Ang-' . str_pad($index, 3, '0', STR_PAD_LEFT);
        echo "Member number: {$memberNumber}\n";
        
        // Map status pernikahan
        $statusMapping = [
            'K' => 'Menikah',
            'B' => 'Belum Menikah',
            'J' => 'Janda',
            'D' => 'Duda'
        ];
        $statusPernikahan = $statusMapping[$anggotaData['status']] ?? 'Belum Menikah';
        
        // Prepare member data
        $memberData = [
            'nama_lengkap' => $anggotaData['nama_lengkap'],
            'jenis_kelamin' => $anggotaData['jenis_kelamin'] === 'Lk' ? 'Laki-laki' : 'Perempuan',
            'tempat_lahir' => $anggotaData['tempat_lahir'],
            'tanggal_lahir' => $anggotaData['tanggal_lahir'],
            'alamat' => 'Data keluarga - ' . $anggotaData['hubungan_keluarga'],
            'pekerjaan' => $anggotaData['pekerjaan'],
            'status_pernikahan' => $statusPernikahan,
            'email' => $validated['email'],
            'status' => 'active',
            'nama_ayah' => 'Baptis: ' . $anggotaData['status_baptis'] . ', Sidi: ' . $anggotaData['status_sidi'],
            'nama_ibu' => 'Pendidikan: ' . $anggotaData['pendidikan'],
            'nama_pasangan' => $anggotaData['tempat_nikah'] ?? 'Belum menikah',
        ];
        
        echo "Member data to insert:\n";
        print_r($memberData);
        
        // Create member
        $member = Member::create($memberData);
        $savedMembers[] = $member;
        
        echo "Member created with ID: {$member->id}\n";
    }
    
    echo "\nTotal members saved: " . count($savedMembers) . "\n";
    
    // Clear session
    Session::forget(['anggota_email_verified', 'anggota_verified_email']);
    
    echo "Form simulation completed successfully!\n";
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "\nStack trace:\n";
    echo $e->getTraceAsString() . "\n";
}
