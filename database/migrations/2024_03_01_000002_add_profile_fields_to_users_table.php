<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('id');
            $table->string('last_name')->nullable()->after('name');
            $table->string('address')->nullable()->after('email');
            // storage quota in bytes, default 3 GB
            $table->unsignedBigInteger('storage_limit')->default(3 * 1024 * 1024 * 1024);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'last_name', 'address', 'storage_limit']);
        });
    }
};
