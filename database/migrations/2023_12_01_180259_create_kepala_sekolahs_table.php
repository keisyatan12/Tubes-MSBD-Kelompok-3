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
        Schema::create('kepala_sekolahs', function (Blueprint $table) {
            $table->bigInteger('ID_Kepsek')->length(20)->primary();
            $table->string('Nama_Kepsek')->length(150);
            $table->string('Jenjang_Pendidikan')->length(100);
            $table->enum('Jenis_Kelamin', ['L','P']);
            $table->string('Tempat_Lahir')->length(100);
            $table->date('Tanggal_Lahir');
            $table->date('TMT_Kerja');
            $table->enum('Status',['Aktif','Resign','Diberhentikan','Cuti']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepala_sekolahs');
    }
};
