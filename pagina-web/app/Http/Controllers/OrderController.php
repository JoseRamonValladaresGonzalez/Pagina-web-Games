<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
                    ->with(['items.juego', 'payment']) 
                    ->latest()
                    ->paginate(10);

        return view('orders.index', compact('orders'));
    }
}