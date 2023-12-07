<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class absensi_ekskul extends Model
{
    use HasFactory;

    protected $table = 'absensi_ekskuls';
    protected $fillable = [
        'ID_Absensi',
        'ID_Ekskul_Siswa',
        'Tanggal',
        'Hadir',
        'Izin',
        'Alpa',
        'Sakit',
    ];

    /**
     * Get the ekskul_siswa that owns the absensi_ekskul
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ekskul_siswa(): BelongsTo
    {
        return $this->belongsTo(ekskul_siswa::class, 'ID_Ekskul_Siswa', 'ID_Ekskul_Siswa');
    }
    /**
     * Get all of the rapor for the absensi_ekskul
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rapor(): HasMany
    {
        return $this->hasMany(rapor::class, 'Absensi_Ekskul', 'ID_Absensi');
    }
}