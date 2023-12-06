<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $table = 'roles';
    protected $fillable = ['ID_Roles', 'Email', 'Password', 'Nama_Role'];
    public $timestamps = false;
=======

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
>>>>>>> 97b86fafab64d5e2ae1ccba80afbb47f365c1316
}
