<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClienteModel extends Model
{
    use HasFactory;

    protected $table = 'cliente';

    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'tipo_documento',
        'numero_documento',
        'celular',
        'correo',
        'direccion',
        'asesor_id',
    ];
}
