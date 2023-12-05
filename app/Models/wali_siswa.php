<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wali_siswa extends Model
{
    use HasFactory;

    protected $table = 'wali_siswas';
    protected $fillable = [
        'Nama_Wali',
        'ID_Siswa',
        'Pekerjaan_Wali',
        'No_Rek_Bank',
        'Bank_Atas_Nama',
    ];
    /**
     * Get the siswa that owns the wali_siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(siswa::class, 'ID_Siswa', 'NISN');
    }
}
