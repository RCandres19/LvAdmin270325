<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informacion extends Model
{
    use HasFactory;

    protected $table = 'informacion';

    protected $fillable = ['titulo', 'contenido', 'imagen', 'fecha_actualizacion'];
}
