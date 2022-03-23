<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AsesorModel extends Model
{
    use HasFactory;

    protected $table = 'asesor';

    protected $fillable = [
        'id',
        'nombre',
        'apellido',
        'tipo_documento',
        'numero_documento',
        'celular',
        'correo',
        'direccion',
    ];

    public function clientes()
    {
        return $this->hasMany(ClienteModel::class);
    }
}
