<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <!-- Agregar meta tag CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap">
    <style>
        body {
            background-color: #0a0a0a;
            font-family: 'Syne Mono', monospace;
            color: #fff;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
            border: 2px solid #0ff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        }

        h2.neon-text {
            color: #0ff;
            text-align: center;
            text-shadow: 0 0 10px #0ff;
            animation: flicker 1.5s infinite alternate;
            margin-bottom: 2rem;
        }

        .cart-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }

        .cart-item {
            background: rgba(0, 0, 0, 0.7);
            border: 2px solid #0f0;
            border-radius: 10px;
            padding: 1rem;
            transition: transform 0.3s ease;
        }

        .cart-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.5);
        }

        .item-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #0ff;
            margin-bottom: 1rem;
        }

        .item-details {
            text-align: center;
        }

        .item-details p {
            margin: 0.5rem 0;
            color: #0ff;
            text-shadow: 0 0 5px #0ff;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        #vaciar-carrito, .pay-button {
            background: #000;
            color: #0ff;
            border: 2px solid #0ff;
            padding: 12px 24px;
            font-size: 1.1rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        #vaciar-carrito:hover, .pay-button:hover {
            background: #0ff;
            color: #000;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
        }

        .empty-cart {
            text-align: center;
            color: #0f0;
            font-size: 1.5rem;
            text-shadow: 0 0 10px #0f0;
            padding: 2rem;
        }

        @keyframes flicker {
            0%, 18%, 22%, 25%, 53%, 57%, 100% {
                text-shadow: 0 0 10px #0ff,
                    0 0 20px #0ff,
                    0 0 30px #0ff,
                    0 0 40px #0ff;
            }
            20%, 24%, 55% {
                text-shadow: none;
            }
        }

        @media (max-width: 768px) {
            .cart-grid {
                grid-template-columns: 1fr;
            }
            
            .container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="neon-text">🛒 Tu Carrito</h2>
        @if(count($cart))
            <div class="cart-grid">
                @foreach($cart as $item)
                <div class="cart-item">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="item-image">
                    <div class="item-details">
                        <p>📛 {{ $item['name'] }}</p>
                        <p>💲 Precio: ${{ number_format($item['price'], 2) }}</p>
                        <p>🔢 Cantidad: {{ $item['quantity'] }}</p>
                        <p>💠 Total: ${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="button-group">
                <button id="vaciar-carrito">🗑️ Vaciar Carrito</button>
                <a href="{{ route('payment.form') }}" class="pay-button">💳 Pagar</a>
            </div>
        @else
            <p class="empty-cart">🚫 Tu carrito está vacío.</p>
        @endif
    </div>
    <script>
        // Asegurar que el DOM esté cargado
        document.addEventListener('DOMContentLoaded', function() {
            const vaciarBtn = document.getElementById('vaciar-carrito');
            
            if (vaciarBtn) {
                vaciarBtn.addEventListener('click', function() {
                    fetch("{{ route('cart.clear') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        location.reload();
                    })
                    .catch(error => console.error('Error:', error));
                });
            }
        });
    </script>
</body>
</html>