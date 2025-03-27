<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Juegos;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with(['items.juego', 'payment']) ->latest()->paginate(10);

        $categorias = Categorias::all();
        $juegos = Juegos::query();
    
        if (request()->has('categoria')) {
            $juegos->where('categoria_id', request('categoria'));
        }
    
        $juegos = $juegos->get();
        return view('orders.index', compact('orders', 'juegos', 'categorias'));
    }
}