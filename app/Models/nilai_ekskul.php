<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai_ekskul extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'nilai_ekskuls';
    protected $fillable = [
        'ID_Ekskul_Siswa',
        'Nilai',
    ];

    /**
     * Get the ekskul_siswa that owns the nilai_ekskul
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ekskul_siswa(): BelongsTo
    {
        return $this->belongsTo(ekskul_siswa::class, 'ID_Ekskul_Siswa', 'ID_Ekskul_Siswa');
    }
    /**
     * Get all of the rapor for the nilai_ekskul
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rapor(): HasMany
    {
        return $this->hasMany(rapor::class, 'ID_Ekskul_Nilai', 'ID_Nilai_Ekskul');
    }
}
