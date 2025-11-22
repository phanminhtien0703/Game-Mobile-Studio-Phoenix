<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Cập nhật giá trị NULL thành 0
        DB::table('games')->whereNull('download_count')->update(['download_count' => 0]);

        // Thêm default value cho cột download_count
        Schema::table('games', function (Blueprint $table) {
            $table->integer('download_count')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->integer('download_count')->nullable()->change();
        });
    }
};
