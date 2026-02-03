<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profile_field_values', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');
            $table->foreignId('profile_field_id');

            $table->text('value')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_field_values');
    }
};
