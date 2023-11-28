<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
use App\Models\Post;
class LogController extends Controller
{
    public function index()
    {
        // Fetch $guruData from your database or any source
        $log_absensi_ekskul = DB::select('SELECT * FROM log_absensi_ekskul');

        return view('superadmin/log/log_absensi_ekskul')->with('log_absensi_ekskul', $log_absensi_ekskul);
    }

    public function absen_kelas()
    {
        // Fetch $guruData from your database or any source
        $log_absensi_kelas = DB::select('SELECT * FROM log_absensi_kelas');

        return view('superadmin/log/log_absensi_kelas')->with('log_absensi_kelas', $log_absensi_kelas);
    }

    public function ekskul_siswa()
    {
        // Fetch $guruData from your database or any source
        $log_ekskul_siswa = DB::select('SELECT * FROM log_ekskul_siswa');

        return view('superadmin/log/log_ekskul_siswa')->with('log_ekskul_siswa', $log_ekskul_siswa);
    }

    public function ekskul()
    {
        // Fetch $guruData from your database or any source
        $log_ekstrakurikuler = DB::select('SELECT * FROM log_ekstrakurikuler');

        return view('superadmin/log/log_ekskul')->with('log_ekstrakurikuler', $log_ekstrakurikuler);
    }
    
    public function guru()
    {
        // Fetch $guruData from your database or any source
        $log_guru = DB::select('SELECT * FROM log_guru');

        return view('superadmin/log/log_guru')->with('log_guru', $log_guru);
    }

    public function jadwalmapel()
    {
        // Fetch $guruData from your database or any source
        $log_jadwal_mapel = DB::select('SELECT * FROM log_jadwal_mapel');

        return view('superadmin/log/log_jadwal_mapel')->with('log_jadwal_mapel', $log_jadwal_mapel);
    }
}
