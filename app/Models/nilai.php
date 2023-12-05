<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'nilais';
    protected $fillable = [
        'Kode_Mapel',
        'Siswa_ID',
        'Thn_Ajaran',
        'Jenis',
        'Nilai_Pengetahuan',
        'Nilai_Keterampilan',
    ];
    /**
     * Get the mata_pelajaran that owns the nilai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mata_pelajaran(): BelongsTo
    {
        return $this->belongsTo(mata_pelajaran::class, 'Kode_Mapel', 'Kode_Mapel');
    }
    /**
     * Get the siswa that owns the nilai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(siswa::class, 'Siswa_ID', 'NISN');
    }
    /**
     * Get the tahun_ajaran that owns the nilai
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tahun_ajaran(): BelongsTo
    {
        return $this->belongsTo(tahun_ajaran::class, 'Thn_Ajaran', 'ID_Thn_Ajaran');
    }
    /**
     * Get all of the rapor for the nilai
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rapor(): HasMany
    {
        return $this->hasMany(rapor::class, 'ID_Nilai', 'Nilai_ID');
    }
}
