<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kepala_sekolah extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'kepala_sekolahs';
    protected $fillable = [
        'Nama_Kepsek',
        'Jenjang_Pendidikan',
        'Jenis_Kelamin',
        'Tempat_lahir',
        'Tanggal_Lahir',
        'TMT_Kerja',
        'Status',
    ];

    /**
     * Get all of the role_assignments for the kepala_sekolah
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function role_assignment(): HasMany
    {
        return $this->hasMany(role_assignment::class, 'Kepsek_ID', 'ID_Kepsek');
    }   
}
