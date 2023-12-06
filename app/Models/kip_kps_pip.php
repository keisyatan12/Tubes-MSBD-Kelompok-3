<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kip_kps_pip extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'kip_kps_pips';
    protected $fillable = [
        'ID_Siswa',
        'Status_KIP',
        'No_KIP',
        'Status_KPS',
        'No_KPS',
        'Status_Eligible_PIP',
        'Alasan_Eligible_PIP',
    ];

    /**
     * Get the siswa that owns the kip_kps_pip
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(siswa::class, 'ID_Siswa', 'other_key');
    }
}
