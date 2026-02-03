<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('profiles', 'full_name')) {
                $table->string('full_name')->nullable()->after('user_id');
            }

            if (!Schema::hasColumn('profiles', 'postal_code')) {
                $table->string('postal_code', 10)->nullable();
            }

            if (!Schema::hasColumn('profiles', 'address')) {
                $table->text('address')->nullable();
            }

            if (!Schema::hasColumn('profiles', 'avatar')) {
                $table->string('avatar')->nullable();
            }

            if (!Schema::hasColumn('profiles', 'lat')) {
                $table->decimal('lat', 10, 7)->nullable();
            }

            if (!Schema::hasColumn('profiles', 'lng')) {
                $table->decimal('lng', 10, 7)->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            foreach (['full_name','postal_code','address','avatar','lat','lng'] as $col) {
                if (Schema::hasColumn('profiles', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
