<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ekstrakurikuler extends Model
{
    use HasFactory;
    protected $table = 'ekstrakurikulers';
    protected $fillable = [
        'Kode_Ekskul',
        'Nama_Ekskul',
        'Guru_Ekskul',
        'Hari',
        'Waktu_Mulai',
        'Waktu_Selesai',
    ];

    /**
     * Get all of the comments for the ekstrakurikuler
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ekskul_siswa(): HasMany
    {
        return $this->hasMany(ekskul_siswa::class, 'Ekskul_Kode', 'Kode_Ekskul');
    }

    /**
     * Get the user that owns the ekstrakurikuler
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guru(): BelongsTo
    {
        return $this->belongsTo(gurus::class, 'Guru_Ekskul', 'NUPTK');
    }
}
