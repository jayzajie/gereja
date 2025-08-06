<?php

// Simple script to run migration
require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

// Database configuration
$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => __DIR__ . '/database/database.sqlite',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

try {
    // Check if columns exist before adding them
    $schema = Capsule::schema();
    
    if ($schema->hasTable('members')) {
        echo "Members table exists. Checking columns...\n";
        
        // Add new columns if they don't exist
        $schema->table('members', function (Blueprint $table) {
            if (!$schema->hasColumn('members', 'nomor_anggota')) {
                $table->string('nomor_anggota')->nullable()->after('id');
                echo "Added nomor_anggota column\n";
            }
            
            if (!$schema->hasColumn('members', 'status_baptis')) {
                $table->enum('status_baptis', ['S', 'B'])->nullable();
                echo "Added status_baptis column\n";
            }
            
            if (!$schema->hasColumn('members', 'status_sidi')) {
                $table->enum('status_sidi', ['S', 'B'])->nullable();
                echo "Added status_sidi column\n";
            }
            
            if (!$schema->hasColumn('members', 'tempat_nikah')) {
                $table->string('tempat_nikah')->nullable();
                echo "Added tempat_nikah column\n";
            }
            
            if (!$schema->hasColumn('members', 'tanggal_nikah')) {
                $table->date('tanggal_nikah')->nullable();
                echo "Added tanggal_nikah column\n";
            }
            
            if (!$schema->hasColumn('members', 'hubungan_keluarga')) {
                $table->string('hubungan_keluarga')->nullable();
                echo "Added hubungan_keluarga column\n";
            }
            
            if (!$schema->hasColumn('members', 'pendidikan')) {
                $table->string('pendidikan')->nullable();
                echo "Added pendidikan column\n";
            }
        });
        
        echo "Migration completed successfully!\n";
    } else {
        echo "Members table does not exist!\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
