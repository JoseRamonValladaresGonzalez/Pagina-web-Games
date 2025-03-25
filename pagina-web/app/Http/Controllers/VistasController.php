<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;
class VistasController extends Controller
{
    /**
     * Muestra la vista de noticias.
     */
    public function noticias()
    {
        $categorias = Categorias::all();
        return view('noticias', compact('categorias'));
    }

    /**
     * Muestra la vista de about.
     */
    public function about()
    {
        $categorias = Categorias::all();
        return view('about', compact('categorias'));
    }
}
