<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    use HasFactory;
   
    protected $log_absensi_ekskul = 'log_absensi_ekskul';
    protected $log_absensi_kelas = 'log_absensi_kelas';
    protected $log_ekskul_siswa = 'log_ekskul_siswa';
    protected $log_ekstrakurikuler = 'log_ekstrakurikuler';
    protected $log_guru = 'log_guru';
    protected $log_jadwal_mapel = 'log_jadwal_mapel';
   
}

