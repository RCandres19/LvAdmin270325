<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Usuario extends Authenticatable
{
    use HasFactory, HasRoles;

    protected $table = 'usuarios'; // Nombre de la tabla en la BD

    protected $fillable = [
        'nombre', 
        'apellido', 
        'tipo_documento', 
        'documento', 
        'telefono', 
        'correo', 
        'password' // Se usa "password" en lugar de "contraseña" por convención
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'password' => 'string',
    ];

    /**
     * Mutador para encriptar la contraseña automáticamente.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Método para obtener el nombre completo del usuario.
     */
    public function getFullNameAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }

    /**
     * Personalizar salida JSON.
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'nombre_completo' => $this->getFullNameAttribute(),
            'tipo_documento' => $this->tipo_documento,
            'documento' => $this->documento,
            'telefono' => $this->telefono,
            'correo' => $this->correo,
            'roles' => $this->roles->pluck('name'), // Spatie ya da los roles
            'permisos' => $this->permissions->pluck('name'), // Spatie ya da los permisos
        ];
    }
}
