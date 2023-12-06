<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi_kelas extends Model
{
    use HasFactory;
    protected $table = 'absensi_kelas';
    protected $fillable = [
        'ID_Absensi',
        'Siswa_ID',
        'Kelas',
        'Tanggal',
        'Hadir',
        'Izin',
        'Alpa',
        'Sakit',
    ];

    /**
     * Get the user that owns the absensi_kelas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'Kelas', 'ID_Kelas');
    }

    /**
     * Get the siswa that owns the absensi_kelas
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(siswa::class, 'Siswa_ID', 'NISN');
    }
    /**
     * Get all of the rapor for the absensi_kelas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rapor(): HasMany
    {
        return $this->hasMany(rapor::class, 'Absensi_ID', 'ID_Absensi');
    }
}
