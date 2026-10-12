<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')
            ->where('email', 'admin@spillargroup.com')
            ->update([
                'role' => 'main_admin',
                'is_admin' => true,
            ]);
    }

    public function down(): void
    {
        DB::table('users')
            ->where('email', 'admin@spillargroup.com')
            ->where('role', 'main_admin')
            ->update([
                'role' => 'admin',
                'is_admin' => true,
            ]);
    }
};
