<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gurus extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'gurus';
    protected $fillable = [
        'NUPTK',
        'NIP',
        'Nama_Guru',
        'Jenis_Kelamin',
        'Tempat_Lahir',
        'Tanggal_Lahir',
        'Status_Kepegawaian',
        'Jenis_PTK',
        'Jenjang_Pendidikan',
        'TMT_Kerja',
        'JJM',
        'Status',
    ];

    /**
     * Get all of the comments for the gurus
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ekstrakurikuler(): HasMany
    {
        return $this->hasMany(ekstrakurikuler::class, 'Guru_Ekskul', 'NUPTK');
    }

    /**
     * Get all of the kelas for the gurus
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kelas(): HasMany
    {
        return $this->hasMany(kelas::class, 'Wali_Kelas', 'NUPTK');
    }

    /**
     * Get all of the mata_pelajaran for the gurus
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mata_pelajaran(): HasMany
    {
        return $this->hasMany(mata_pelajaran::class, 'Guru_Mapel', 'NUPTK');
    }
    public function role_assignment(): HasMany
    {
        return $this->hasMany(role_assignment::class, 'NUPTK_Guru', 'NUPTK');
    }
}
