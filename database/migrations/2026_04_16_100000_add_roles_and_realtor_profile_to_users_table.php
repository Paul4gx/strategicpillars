<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 32)->default('client')->after('email');
            $table->string('realty_display_name')->nullable()->after('name');
            $table->string('phone', 32)->nullable()->after('realty_display_name');
            $table->text('bio')->nullable()->after('phone');
            $table->string('avatar_path')->nullable()->after('bio');
            $table->timestamp('onboarding_completed_at')->nullable()->after('remember_token');
        });

        DB::table('users')->where('is_admin', true)->update(['role' => 'admin']);
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'realty_display_name',
                'phone',
                'bio',
                'avatar_path',
                'onboarding_completed_at',
            ]);
        });
    }
};
