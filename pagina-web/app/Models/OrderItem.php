<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'juego_id', 'quantity', 'unit_price'];
    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function juego() {
        return $this->belongsTo(Juegos::class, 'juego_id');
    }
}