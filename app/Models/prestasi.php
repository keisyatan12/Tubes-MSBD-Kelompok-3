<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prestasi extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'prestasis';
    protected $fillable = [
        'Siswa',
        'Jenis_Prestasi',
        'Deskripsi',
        'Tanggal',
    ];
    /**
     * Get the siswa that owns the prestasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(siswa::class, 'Siswa', 'NISN');
    }
    /**
     * Get all of the rapor for the prestasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rapor(): HasMany
    {
        return $this->hasMany(rapor::class, 'Prestasi_ID', 'ID_Prestasi');
    }
}
