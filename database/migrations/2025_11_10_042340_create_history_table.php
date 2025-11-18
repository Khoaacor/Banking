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
        Schema::create('history', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('idck_id');
            $table->foreign('idck_id')->references('id')->on('users');
            $table->unsignedBigInteger('stkck');
            $table->string('hotenck');
            $table->unsignedBigInteger('sotienck');
            $table->string('noidungck')->nullable();
            $table->unsignedBigInteger('idnn_id');
            $table->foreign('idnn_id')->references('id')->on('users');
            $table->unsignedBigInteger('stknn');
            $table->string('hotennn');
            $table->string('trangthai');
            $table->timestamps();
        });
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history');
    }
};
