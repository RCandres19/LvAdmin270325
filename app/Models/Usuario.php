<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Usuario extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $table = 'usuarios'; // Nombre de la tabla en la BD

    protected $fillable = ['nombre', 'email', 'password', 'rol', 'role_id'];

    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Rol::class, 'role_id');
    }
}
