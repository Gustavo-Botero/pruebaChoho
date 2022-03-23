<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetallePedidoModel extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedido';

    protected $fillable = [
        'id',
        'factura_id',
        'producto_id',
        'cantidad',
    ];

    public function factura()
    {
        return $this->belongsTo(FacturaModel::class, 'factura_id');
    }

    public function producto()
    {
        return $this->belongsTo(ProductoModel::class, 'producto_id');
    }
}
