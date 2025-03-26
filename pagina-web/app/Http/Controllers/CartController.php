<?php

namespace App\Http\Controllers;

use App\Models\Juegos;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|integer|exists:juegos,id'
            ]);
            
            $juego = Juegos::findOrFail($request->product_id);
            
            $cart = session()->get('cart', []);
            
            if(isset($cart[$juego->id])) {
                $cart[$juego->id]['quantity']++;
            } else {
                $cart[$juego->id] = [
                    'product_id' => $juego->id,
                    'name' => $juego->nombre, // Asumiendo que el campo se llama 'nombre'
                    'price' => $juego->precio,
                    'quantity' => 1,
                    'image' => $juego->imagen
                ];
            }
            
            session()->put('cart', $cart);
            
            return response()->json([
                'success' => true,
                'message' => 'Juego agregado al carrito'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function clear()
    {
        try {
            session()->forget('cart');
            return response()->json([
                'success' => true,
                'message' => 'Carrito vaciado'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}