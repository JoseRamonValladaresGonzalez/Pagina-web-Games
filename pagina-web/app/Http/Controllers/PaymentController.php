<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Juegos, Order, Payment, OrderItem};

class PaymentController extends Controller
{
    public function showForm()
    {
        // Verificar carrito no vacío
        if (!session('cart') || count(session('cart')) === 0) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }
        
        return view('payment.form');
    }

    public function process(Request $request)
    {
        // Validación mejorada
        $validated = $request->validate([
            'card_number' => 'required|string|min:16|max:19',
            'expiry_date' => 'required|date_format:Y-m',
            'cvv' => 'required|numeric|digits_between:3,4',
            'name' => 'required|string|max:255'
        ]);
        DB::beginTransaction();
        try {
            // Verificar existencia de productos
            foreach (session('cart', []) as $item) {
                $juego = Juegos::findOrFail($item['product_id']);
            }

            // Crear pedido
            $order = auth()->user()->orders()->create([
                'total' => $this->calculateCartTotal(),
                'status' => 'completado' 
            ]);

            // Items del pedido
            foreach (session('cart', []) as $item) {
                $order->items()->create([
                    'juego_id' => $item['product_id'], 
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price']
                ]);
            }

            // Registrar pago
            $order->payment()->create([
                'payment_method' => 'tarjeta',
                'amount' => $order->total,
                'status' => 'completado',
                'transaction_id' => uniqid('PAGO_'), 
                'payment_date' => now()
            ]);

            DB::commit();
            
            session()->forget('cart');
            return redirect()->route('orders.index')->with('success', '¡Pago realizado con éxito!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function calculateCartTotal()
    {
        return collect(session('cart', []))->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });
    }
}