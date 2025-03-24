<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Agregar producto al carrito usando datos simulados
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $image = $request->input('image');

        // Datos simulados para el producto
        $product = [
            'id'       => $productId,
            'name'     => 'Juego ' . $productId, // Nombre simulado
            'price'    => 10.00,                // Precio de ejemplo
            'quantity' => 1,
            'image'    => $image,
        ];

        // Obtener el carrito actual de la sesión, o crear uno nuevo si no existe
        $cart = session()->get('cart', []);

        // Si el producto ya existe en el carrito, se incrementa la cantidad
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = $product;
        }

        // Guardar el carrito actualizado en la sesión
        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Producto añadido al carrito',
            'cart' => $cart
        ]);
    }

    // Mostrar el contenido del carrito
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }
    public function clear()
{
    session()->forget('cart');

    return response()->json([
        'message' => 'Carrito vaciado correctamente'
    ]);
}

}
