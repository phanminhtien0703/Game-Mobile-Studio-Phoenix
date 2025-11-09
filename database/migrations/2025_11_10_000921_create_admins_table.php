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
        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('username', 100)->unique();
            $table->string('email', 255)->unique();
            $table->string('password_hash', 255);
            $table->enum('role', ['super_admin', 'admin', 'moderator', 'editor'])->default('admin');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('last_login')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->string('last_ip', 45)->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
