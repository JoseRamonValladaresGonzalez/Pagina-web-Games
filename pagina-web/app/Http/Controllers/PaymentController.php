<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('payment.form');
    }

    public function processPayment(Request $request)
    {
        // Aquí iría la lógica de pago, por ahora solo redirigimos con un mensaje.
        return redirect()->route('payment.form')->with('success', 'Pago procesado correctamente.');
    }
}
?>