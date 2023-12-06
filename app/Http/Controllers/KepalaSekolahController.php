<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\mata_pelajaran;

class KepalaSekolahController extends Controller
{
    public function index(){
        return view('superadmin.dashboardsuperadmin');
    }

    public function create_post(){
        return view('superadmin.create_post');
    }
    
public function show_mapel(){
    $mata_pelajarans = DB::select('SELECT * FROM mata_pelajarans');

        return view('superadmin/daftarmapel-superadminMP')->with('log_absensi_ekskul', $mata_pelajarans);
}

    public function store_post(Request $request)
    {
        $validated = $request->validate([
        
            'Kode_Mapel' => 'required|min:2|max:5',
            'Nama_Mapel' => 'required|min:5|max:150',
            'KKM' => 'required|min:1|max:2',
            'Guru_Mapel' => 'required|min:5|max:150',
        ]);

        $new_post = new Post;
        $new_post->Kode_Mapel = $request->Kode_Mapel;
        $new_post->Nama_Mapel = $request->Nama_Mapel;
        $new_post->KKM = $request->KKM;
        $new_post->Guru_Mapel = $request->Guru_Mapel;
        $new_post->save();

        return redirect('/superadmin/daftarmapel-superadminMP')->with('Mapel baru berhasil ditambahkan');
    }
}
