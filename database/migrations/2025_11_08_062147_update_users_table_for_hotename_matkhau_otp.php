<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Đổi name -> hoten (nếu cột name tồn tại)
            if (Schema::hasColumn('users', 'name') && !Schema::hasColumn('users', 'hoten')) {
                $table->renameColumn('name', 'hoten');
            }

            // Đổi password -> matkhau (nếu cột password tồn tại)
            if (Schema::hasColumn('users', 'password') && !Schema::hasColumn('users', 'matkhau')) {
                $table->renameColumn('password', 'matkhau');
            }

            // Thêm cột otp nếu chưa có
            if (!Schema::hasColumn('users', 'otp')) {
                $table->string('otp')->nullable()->after('matkhau');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'hoten') && !Schema::hasColumn('users', 'name')) {
                $table->renameColumn('hoten', 'name');
            }
            if (Schema::hasColumn('users', 'matkhau') && !Schema::hasColumn('users', 'password')) {
                $table->renameColumn('matkhau', 'password');
            }
            if (Schema::hasColumn('users', 'otp')) {
                $table->dropColumn('otp');
            }
        });
    }
};
