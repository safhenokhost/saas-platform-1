<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profile_field_values', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('profile_field_id')
                ->constrained('profile_fields')
                ->cascadeOnDelete();

            $table->text('value')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'profile_field_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_field_values');
    }
};
