<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Muestra los detalles de un producto simulado.
     */
    public function show($id)
    {
        // Datos simulados del producto
        $productos = [
            1 => [
                'nombre' => 'Minecraft',
                'descripcion' => 'Un juego de construcción y aventura en un mundo abierto.',
                'precio' => 29.99,
                'imagen' => 'minecraft.jpg',
            ],
            2 => [
                'nombre' => 'Final Fantasy X',
                'descripcion' => 'Un épico juego de rol con una historia profunda.',
                'precio' => 19.99,
                'imagen' => 'ffx.jpg',
            ],
            3 => [
                'nombre' => 'ERNR',
                'descripcion' => 'Un juego de rol de acción con gráficos retro.',
                'precio' => 14.99,
                'imagen' => 'ERNR.jpg',
            ]
        ];

        // Verifica si el producto existe
        if (!isset($productos[$id])) {
            abort(404, 'Producto no encontrado');
        }

        // Obtiene el producto por ID
        $producto = $productos[$id];

        // Retorna la vista con los datos del producto
        return view('producto.show', compact('producto'));
    }
}
