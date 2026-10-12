<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@spillargroup.com'],
            [
                'name' => 'Admin',
                'password' => '12345678',
                'role' => UserRole::MainAdmin,
                'email_verified_at' => now(),
            ]
        );
    }
}
