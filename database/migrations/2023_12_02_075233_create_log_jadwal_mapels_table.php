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
        Schema::create('log_jadwal_mapels', function (Blueprint $table) {
            $table->string('ID_Jadwal')->length(10);
            $table->string('Kelas_ID')->length(10);
            $table->char('Kode_Mapel')->length(5);
            $table->bigInteger('Thn_Ajaran_ID');
            $table->time('Waktu_Mulai');
            $table->time('Waktu_Selesai');
            $table->enum('Hari',['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']);
            $table->string('Action')->length(6);
            $table->string('Username')->length(100);
            $table->timestamp('Waktu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_jadwal_mapels');
    }
};
