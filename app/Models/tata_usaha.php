<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tata_usaha extends Model
{
    use HasFactory;

    protected $table = 'tata_usahas';
    protected $fillable = [
        'Nama_Pegawai',
        'Jenis_Kelamin',
        'TMT_Kerja',
        'Tempat_Lahir',
        'Tanggal_Lahir',
        'Jenjang_Pendidikan',
        'Status'
    ];
    public function role_assignment(): HasMany
    {
        return $this->hasMany(role_assignment::class, 'Pegawai_ID', 'ID_Pegawai');
    }
}
