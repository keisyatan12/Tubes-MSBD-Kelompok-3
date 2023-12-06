<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ekskul_siswa extends Model
{
    use HasFactory;
    protected $table = 'ekskul_siswas';
    protected $fillable = [
        'ID_Ekskul_Siswa',
        'Ekskul_Kode',
        'Siswa_ID',
        'Thn_Ajaran',
    ];

    /**
     * Get all of the comments for the ekskul_siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function absensi_ekskul(): HasMany
    {
        return $this->hasMany(absensi_ekskul::class, 'ID_Ekskul_Siswa', 'ID_Ekskul_Siswa');
    }

    /**
     * Get the user that owns the ekskul_siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ekstrakurikuler(): BelongsTo
    {
        return $this->belongsTo(ekstrakurikuler::class, 'Ekskul_Kode', 'Kode_Ekskul');
    }

    /**
     * Get the siswa that owns the ekskul_siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(siswa::class, 'Siswa_ID', 'NISN');
    }

    /**
     * Get the tahun_ajaran that owns the ekskul_siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tahun_ajaran(): BelongsTo
    {
        return $this->belongsTo(tahun_ajaran::class, 'Thn_Ajaran', 'ID_Thn_Ajaran');
    }
    
    /**
     * Get all of the nilai_ekskul for the ekskul_siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nilai_ekskul(): HasMany
    {
        return $this->hasMany(nilai_ekskul::class, 'ID_Ekskul_Siswa', 'ID_Ekskul_Siswa');
    }
}
