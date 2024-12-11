<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cuti_karyawans', function (Blueprint $table) {
            $table->foreignId('id_cuti')->constrained('cutis')->onDelete('cascade'); // Kolom id_cuti yang berelasi dengan tabel cuti
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // Kolom id_user yang berelasi dengan tabel users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti_karyawans');
    }
};
