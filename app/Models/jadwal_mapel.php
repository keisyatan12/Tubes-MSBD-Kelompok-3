<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal_mapel extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'jadwal_mapels';
    protected $fillable = [
        'Kelas_ID',
        'Kode_Mapel',
        'Thn_Ajaran_ID',
        'Waktu_Mulai',
        'Waktu_Selesai',
        'Hari'
    ];

    /**
     * Get the kelas that owns the jadwal_mapel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(kelas::class, 'Kelas_ID', 'ID_Kelas');
    }

    /**
     * Get the mata_pelajaran that owns the jadwal_mapel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mata_pelajaran(): BelongsTo
    {
        return $this->belongsTo(mata_pelajaran::class, 'Kode_Mapel', 'Kode_Mapel');
    }

    /**
     * Get the tahun_ajaran that owns the jadwal_mapel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tahun_ajaran(): BelongsTo
    {
        return $this->belongsTo(tahun_ajaran::class, 'Thn_Ajaran_ID', 'ID_Thn_Ajaran');
    }
}
