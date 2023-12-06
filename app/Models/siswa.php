<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = [
        'NISN',
        'NIPD',
        'Nama_Siswa',
        'Jenis_Kelamin',
        'Tempat_Lahir',
        'Tanggal_Lahir',
        'Agama',
        'Alamat',
        'No_hp',
        'Status_dlm_Klrg',
        'Nama_Ayah',
        'Nama_Ibu',
        'Pekerjaan_Ayah',
        'Pekerjaan_Ibu',
        'No_Rek_Bank',
        'Bank_Atas_Nama',
        'Status_Siswa',
        'Sekolah_Asal',
        'Anak_Ke',
    ];

    /**
     * Get all of the comments for the siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function absensi_kelas(): HasMany
    {
        return $this->hasMany(absensi_kelas::class, 'Siswa_ID', 'NISN');
    }

    /**
     * Get all of the comments for the siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function absensi_ekskul(): HasMany
    {
        return $this->hasMany(absensi_ekskul::class, 'Siswa_ID', 'NISN');
    }

    /**
     * Get all of the kip_kps_pip for the siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kip_kps_pip(): HasOne
    {
        return $this->hasOne(kip_kps_pip::class, 'ID_Siswa', 'other_key');
    }
    /**
     * Get all of the nilai for the siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nilai(): HasMany
    {
        return $this->hasMany(nilai::class, 'Siswa_ID', 'NISN');
    }
    /**
     * Get all of the prestasi for the siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prestasi(): HasMany
    {
        return $this->hasMany(prestasi::class, 'Siswa', 'NISN');
    }
    public function role_assignment(): HasMany
    {
        return $this->hasMany(role_assignment::class, 'Siswa_ID', 'NISN');
    }
    /**
     * Get all of the wali_siswa for the siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wali_siswa(): HasMany
    {
        return $this->hasMany(wali_siswa::class, 'ID_Siswa', 'NISN');
    }
}
