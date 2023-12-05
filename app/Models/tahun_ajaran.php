<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tahun_ajaran extends Model
{
    use HasFactory;
    protected $table = 'tahun_ajarans';
    protected $fillable = [
        'Thn_Ajaran',
        'Semester',
        'Tanggal_Mulai',
        'Tanggal_Selesai',
    ];

    /**
     * Get all of the absensi for the tahun_ajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ekskul_siswa(): HasMany
    {
        return $this->hasMany(ekskul_siswa::class, 'Thn_Ajaran', 'ID_Thn_Ajaran');
    }

    /**
     * Get all of the jadwal_mapel for the tahun_ajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal_mapel(): HasMany
    {
        return $this->hasMany(jadwal_mapel::class, 'Thn_Ajaran_ID', 'ID_Thn_Ajaran');
    }

    /**
     * Get all of the nilai for the tahun_ajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nilai(): HasMany
    {
        return $this->hasMany(nilai::class, 'Thn_Ajaran', 'ID_Thn_Ajaran');
    }
}
