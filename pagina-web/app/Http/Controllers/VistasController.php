<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
use App\Models\Juegos;
class VistasController extends Controller
{
    /**
     * Muestra la vista de noticias.
     */
    public function noticias()
    {
        $categorias = Categorias::all();
        $juegos = Juegos::query();
    
        if (request()->has('categoria')) {
            $juegos->where('categoria_id', request('categoria'));
        }
    
        $juegos = $juegos->get();
        return view('noticias', compact('juegos', 'categorias'));
    }
    /**
     * Muestra la vista de about.
     */
    public function about()
    {
        $categorias = Categorias::all();
        $juegos = Juegos::query();
    
        if (request()->has('categoria')) {
            $juegos->where('categoria_id', request('categoria'));
        }
    
        $juegos = $juegos->get();
        return view('about', compact('juegos', 'categorias'));
    }
}
