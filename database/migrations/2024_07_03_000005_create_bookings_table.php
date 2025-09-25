<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->string('guest_name');
            $table->string('guest_phone');
            $table->string('guest_email');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guests_count')->default(1);
            $table->enum('status', ['pending', 'confirmed', 'completed']);
            $table->enum('payment_status', ['paid', 'unpaid']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
}; 