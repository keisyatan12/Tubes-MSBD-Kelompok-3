<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class role_assignment extends Model
{
    use HasFactory;
    protected $table = 'role_assignments';
    protected $fillable = [
        'Role_ID',
        'Siswa_ID',
        'NUPTK_Guru',
        'Pegawai_ID',
        'Kepsek_ID',
    ];
    /**
     * Get the kepala_sekolah that owns the role_assignment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kepala_sekolah(): BelongsTo
    {
        return $this->belongsTo(kepala_sekolah::class, 'Kepsek_ID', 'ID_Kepsek');
    }
    /**
     * Get the Guru that owns the role_assignment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gurus(): BelongsTo
    {
        return $this->belongsTo(gurus::class, 'NUPTK_Guru', 'NUPTK');
    }
    /**
     * Get the tata_usaha that owns the role_assignment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tata_usaha(): BelongsTo
    {
        return $this->belongsTo(tata_usaha::class, 'Pegawai_ID', 'ID_Pegawai');
    }
    /**
     * Get the role that owns the role_assignment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(role::class, 'Role_ID', 'ID_Roles');
    }
    /**
     * Get the siswa that owns the role_assignment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(siswa::class, 'Siswa_ID', 'NISN');
    }
}
