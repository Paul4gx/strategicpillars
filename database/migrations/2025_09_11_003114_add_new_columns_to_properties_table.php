<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->year('year_built')->nullable();
            $table->integer('area')->nullable();
            $table->json('property_features')->nullable();
            $table->enum('building_type', ['office', 'home', 'complex', 'others'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['year_built', 'area', 'property_features', 'building_type']);
        });
    }
};
