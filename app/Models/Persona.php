<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'direccion',
        'fecha_nacimiento',
        'telefono',
        'profesion_id'
    ];
}
