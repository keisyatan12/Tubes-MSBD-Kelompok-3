<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rapor extends Model
{
    use HasFactory;
    protected $table = 'rapors';
    protected $fillable = [
        'ID_Nilai',
        'ID_Ekskul_Nilai',
        'Prestasi_ID',
        'Absensi_ID',
        'Absensi_Ekskul',
    ];

    /**
     * Get the absensi_ekskul that owns the rapor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function absensi_ekskul(): BelongsTo
    {
        return $this->belongsTo(absensi_ekskul::class, 'Absensi_Ekskul', 'ID_Absensi');
    }
    /**
     * Get the absensi_kelas that owns the rapor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function absensi_kelas(): BelongsTo
    {
        return $this->belongsTo(absensi_kelas::class, 'Absensi_ID', 'ID_Absensi');
    }
    /**
     * Get the nilai_ekskul that owns the rapor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nilai_ekskul(): BelongsTo
    {
        return $this->belongsTo(nilai_ekskul::class, 'ID_Ekskul_Nilai', 'ID_Nilai_Ekskul');
    }
    /**
     * Get the nilai that owns the rapor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nilai(): BelongsTo
    {
        return $this->belongsTo(nilai::class, 'ID_Nilai', 'Nilai_ID');
    }
    /**
     * Get the prestasi that owns the rapor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function prestasi(): BelongsTo
    {
        return $this->belongsTo(prestasi::class, 'Prestasi_ID', 'ID_Prestasi');
    }
}
