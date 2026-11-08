<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('health_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('family_member_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('blood_group', 3)->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone', 30)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('health_profiles');
    }
};
