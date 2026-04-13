<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat akun admin dari environment variable
        // Jika sudah ada, skip (tidak duplikat)
        $email = env('ADMIN_EMAIL', 'admin@masjidalIkhlas.com');

        User::firstOrCreate(
            ['email' => $email],
            [
                'name'              => env('ADMIN_NAME', 'Administrator'),
                'email'             => $email,
                'password'          => Hash::make(env('ADMIN_PASSWORD', 'password123')),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Admin account ready: ' . $email);
    }
}
