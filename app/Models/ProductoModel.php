<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductoModel extends Model
{
    use HasFactory;

    protected $table = 'producto';

    protected $fillable = [
        'tipo',
        'precio',
    ];
}
