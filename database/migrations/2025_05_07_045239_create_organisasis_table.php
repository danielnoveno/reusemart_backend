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
        Schema::create('organisasis', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_ORGANISASI')->primary();
            $table->string('NAMA_ORGANISASI', 255);
            $table->string('ALAMAT_ORGANISASI', 255);
            $table->string('NO_TELP_ORGANISASI', 25);
            $table->string('EMAIL_ORGANISASI', 25);
            $table->string('PASSWORD_ORGANISASI')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasis');
    }
};
