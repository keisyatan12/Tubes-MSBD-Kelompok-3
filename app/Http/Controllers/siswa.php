<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade
class siswa extends Controller
{
    public function index()
    {
        // Fetch $guruData from your database or any source
        $siswa = DB::select('SELECT * FROM siswa');

        return view('superadmin/manajemenuser/listsiswa-superadminMU')->with('siswa', $siswa);
    }

    public function siswadetail()
    {
        // Fetch $guruData from your database or any source
        $siswa = DB::select('SELECT * FROM siswa');

        return view('superadmin/manajemenuser/detailsiswa-superadminMU')->with('siswa', $siswa);
    }


}
