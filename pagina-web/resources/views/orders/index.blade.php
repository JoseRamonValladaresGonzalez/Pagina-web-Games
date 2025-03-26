<div class="container">
    <h2 class="neon-text">📦 Mis Pedidos</h2>
    
    @forelse($orders as $order)
    <div class="order-card">
        <div class="order-header">
            <h3>Pedido #{{ $order->id }}</h3>
            <p>Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p>Total: ${{ number_format($order->total, 2) }}</p>
            <p>Estado: {{ ucfirst($order->status) }}</p>
        </div>

        <div class="order-items">
            @foreach($order->items as $item)
            <div class="item">
                <img src="{{ $item->game->image }}" alt="{{ $item->game->name }}">
                <div>
                    <h4>{{ $item->game->name }}</h4>
                    <p>Cantidad: {{ $item->quantity }}</p>
                    <p>Precio unitario: ${{ number_format($item->unit_price, 2) }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="payment-info">
            <h4>💳 Información de pago</h4>
            <p>Método: {{ $order->payment->payment_method }}</p>
            <p>Transacción: {{ $order->payment->transaction_id }}</p>
            <p>Fecha pago: {{ $order->payment->payment_date->format('d/m/Y H:i') }}</p>
        </div>
    </div>
    @empty
    <p class="empty">No tienes pedidos registrados</p>
    @endforelse

    {{ $orders->links() }}
</div>