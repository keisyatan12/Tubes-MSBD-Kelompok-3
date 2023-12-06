<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mata_pelajaran extends Model
{
    use HasFactory;
    protected $table = 'mata_pelajarans';
<<<<<<< HEAD
=======
    protected $fillable = [
        'Kode_Mapel',
        'Nama_Mapel',
        'KKM',
        'Guru_Mapel',
    ];

    /**
     * Get all of the jadwal_mapel for the mata_pelajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwal_mapel(): HasMany
    {
        return $this->hasMany(jadwal_mapel::class, 'Kode_Mapel', 'Kode_Mapel');
    }

    /**
     * Get the guru that owns the mata_pelajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guru(): BelongsTo
    {
        return $this->belongsTo(gurus::class, 'Guru_Mapel', 'NUPTK');
    }
    /**
     * Get all of the nilai for the mata_pelajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nilai(): HasMany
    {
        return $this->hasMany(nilai::class, 'Kode_Mapel', 'Kode_Mapel');
    }
>>>>>>> 97b86fafab64d5e2ae1ccba80afbb47f365c1316
}
