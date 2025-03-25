<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Juegos extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria_id',
        'imagen'
    ];

    public function categoria(){
        return $this->belongsTo(Categorias::class);
    }
}
