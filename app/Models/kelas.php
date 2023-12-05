<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = [
        'Wali_Kelas',
        'Nama_Kelas',
        'Tingkatan',
        'Kelompok_Kelas',
    ];

    /**
     * Get all of the comments for the kelas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function absensi_kelas(): HasMany
    {
        return $this->hasMany(absensi_kelas::class, 'Kelas', 'ID_Kelas');
    }

    /**
     * Get all of the jadwal_mapel for the kelas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal_mapel(): HasMany
    {
        return $this->hasMany(jadwal_mapel::class, 'Kelas_ID', 'ID_Kelas');
    }

    /**
     * Get the gurus that owns the kelas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gurus(): BelongsTo
    {
        return $this->belongsTo(gurus::class, 'Wali_Kelas', 'NUPTK');
    }

}
