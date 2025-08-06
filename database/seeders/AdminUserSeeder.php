<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gerejatoraja.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
        ]);

        // Create additional admin user with different credentials
        User::create([
            'name' => 'Admin Gereja',
            'email' => 'admin@eben-haezer.com',
            'email_verified_at' => now(),
            'password' => Hash::make('gereja2024'),
        ]);

        $this->command->info('Admin users created successfully!');
        $this->command->info('Login credentials:');
        $this->command->info('1. Email: admin@gerejatoraja.com | Password: admin123');
        $this->command->info('2. Email: admin@eben-haezer.com | Password: gereja2024');
    }
}
