<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Juegos;
use App\Models\Categorias;
use Illuminate\Http\Request;

class JuegosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categorias::all();
        $juegos = Juegos::query();
    
        if (request()->has('categoria')) {
            $juegos->where('categoria_id', request('categoria'));
        }
    
        $juegos = $juegos->get();
    
        return view('juegos.index', compact('juegos', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categorias = Categorias::all();
        return view('juegos.show', ['juego' => Juegos::findOrFail($id)] , compact('categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
