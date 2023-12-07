<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = [
        'Email',
        'Password',
        'Nama_Role',
    ];
    public function role_assignment(): HasMany
    {
        return $this->hasMany(role_assignment::class, 'Role_ID', 'ID_Roles');
    }
}
