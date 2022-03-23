<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FacturaModel extends Model
{
    use HasFactory;

    protected $table = 'factura';

    protected $fillable = [
        'id',
        'cliente_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(ClienteModel::class, 'cliente_id');
    }

    public function detallePedidos()
    {
        return $this->hasMany(DetallePedidoModel::class, 'factura_id');
    }
}
