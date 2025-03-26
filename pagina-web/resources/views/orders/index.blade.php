<link href="{{ asset('css/neon-styles.css') }}" rel="stylesheet">
<div class="container">
    <h2 class="neon-text">📦 Mis Pedidos</h2>
    
    @forelse($orders as $order)
    <div class="order-card">
        <div class="order-header">
            <h3>Pedido #{{ $order->id }}</h3>
            <p>Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p>Total: ${{ number_format($order->total, 2) }}</p>
            <p class="status">Estado: {{ ucfirst($order->status) }}</p>
        </div>

        <div class="order-items">
            @foreach($order->items as $item)
            <div class="item">
                <img src="{{ $item->image }}" alt="{{ $item->name }}">
                <div class="item-info">
                    <h4>{{ $item->name }}</h4>
                    <p>Cantidad: {{ $item->quantity }}</p>
                    <p>Precio unitario: ${{ number_format($item->unit_price, 2) }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="payment-info">
            <h4>💳 Información de pago</h4>
            <div class="grid-gradient"></div>
            <p>Método: {{ $order->payment->payment_method }}</p>
            <p>Transacción: {{ $order->payment->transaction_id }}</p>
            <p>Fecha pago: {{ $order->payment->payment_date }}</p>
        </div>
    </div>
    @empty
    <p class="empty">No tienes pedidos registrados 🌌</p>
    @endforelse

    <div class="pagination">
        {{ $orders->links() }}
    </div>
</div>

<style>
    /* Añadir estos estilos al CSS existente */
    .order-card {
        background: rgba(10, 10, 26, 0.8);
        border: 2px solid var(--neon-pink);
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        position: relative;
        transition: all 0.3s ease;
    }

    .order-card:hover {
        box-shadow: 0 0 30px rgba(255, 0, 255, 0.2);
        transform: translateY(-5px);
    }

    .order-header {
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--neon-blue);
    }

    .order-header h3 {
        color: var(--neon-pink);
        margin-bottom: 0.5rem;
    }

    .status {
        text-shadow: 0 0 10px var(--neon-blue);
        color: var(--neon-blue);
        font-weight: bold;
    }

    .order-items {
        margin: 1.5rem 0;
    }

    .item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        margin: 1rem 0;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
    }

    .item img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border: 1px solid var(--neon-pink);
        border-radius: 5px;
    }

    .item-info h4 {
        color: var(--neon-blue);
        margin-bottom: 0.5rem;
    }

    .payment-info {
        padding: 1.5rem;
        margin-top: 1.5rem;
        border-top: 1px solid var(--neon-pink);
        background: rgba(0, 255, 255, 0.05);
        border-radius: 8px;
    }

    .payment-info h4 {
        color: var(--neon-blue);
        margin-bottom: 1rem;
    }

    .empty {
        text-align: center;
        font-size: 1.5rem;
        text-shadow: 0 0 15px var(--neon-blue);
        padding: 2rem;
    }

    .pagination {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .pagination a {
        color: var(--neon-blue);
        border: 1px solid var(--neon-pink);
        padding: 0.5rem 1rem;
        margin: 0 0.3rem;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .pagination a:hover {
        background: rgba(255, 0, 255, 0.2);
        text-shadow: 0 0 10px var(--neon-blue);
    }

    @media (max-width: 768px) {
        .order-card {
            padding: 1rem;
        }
        
        .item {
            flex-direction: column;
            text-align: center;
        }
        
        .item img {
            width: 100%;
            height: 150px;
        }
    }
</style>