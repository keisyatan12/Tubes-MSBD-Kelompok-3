<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
