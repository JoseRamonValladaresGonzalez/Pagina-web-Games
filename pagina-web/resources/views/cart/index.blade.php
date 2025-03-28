<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <!-- Agregar meta tag CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/carrito.css') }}" rel="stylesheet">
    <link href="{{ asset('css/neon-styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <nav class="neon-nav">
        <div class="container">
            <div class="header-content">
                <!-- Logo y título -->
                <div class="logo-container">
                    <div class="logo">
                        <img src="{{ asset('storage/images/logo.jpg') }}" alt="RetroGames Logo" height="50">
                    </div>
                    <h1 class="neon-text">RETRO<span style="color: var(--neon-blue);">GAMES</span></h1>
                </div>

                <!-- Menú de navegación -->
                <div class="nav-links-container">
                    <!-- Links principales -->
                    <div class="nav-links">
                        <!-- Tienda: devuelve a la página principal -->
                        <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                            <i class="fas fa-store"></i> Tienda
                        </a>
                        <!-- Categorías: menú desplegable al pasar el ratón -->
                        <div class="relative group">
                            <button type="button" class="nav-link flex items-center">
                                <i class="fas fa-list"></i> Categorías
                                <i class="fas fa-caret-down ml-1"></i>
                            </button>
                            <div class="user-menu">
                                @foreach ($categorias as $categoria)
                                <a href="{{ route('home', ['categoria' => $categoria->id]) }}"
                                    class="user-menu-item">
                                    {{ $categoria->nombre }}
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Noticias: redirige a la página de noticias -->
                        <a href="{{ route('noticias') }}" class="nav-link {{ request()->is('noticias') ? 'active' : '' }}">
                            <i class="fas fa-newspaper"></i> Noticias
                        </a>

                        <!-- Sobre Nosotros: redirige a la página de sobre nosotros -->
                        <a href="{{ route('about') }}" class="nav-link {{ request()->is('about') ? 'active' : '' }}">
                            <i class="fas fa-info-circle"></i> Sobre Nosotros
                        </a>
                    </div>

                    <!-- Menú de autenticación -->
                    <div class="auth-links">
                        @auth
                        <!-- Menú desplegable usuario -->
                        <div class="relative group">
                            <button class="user-menu-button">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-caret-down"></i>
                            </button>
                            <div class="user-menu">
                                <a href="{{ route('orders.index') }}" class="user-menu-item">
                                    <i class="fas fa-box-open"></i> Mis Pedidos
                                </a>

                                <a href="{{ route('profile.edit') }}" class="user-menu-item">
                                    <i class="fas fa-user-circle"></i> Perfil
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="user-menu-item">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                        @else
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link">
                            <i class="fas fa-user-plus"></i> Registro
                        </a>
                        @endif
                        @endauth

                        <a href="{{ route('cart.index') }}" class="nav-link">
                            <i class="fas fa-shopping-cart"></i> Carrito
                        </a>
                    </div>
                </div>

                <!-- Botón móvil -->
                <button id="mobileMenuButton" class="mobile-menu-button">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Menú móvil -->
        <div id="mobileMenu" class="mobile-menu">
            <a href="{{ url('/') }}" class="mobile-link">
                <i class="fas fa-store"></i> Tienda
            </a>

            <div class="mobile-dropdown">
                <button class="mobile-dropdown-button">
                    <i class="fas fa-list"></i> Categorías <i class="fas fa-caret-down"></i>
                </button>
                <div class="mobile-dropdown-content">
                    @foreach ($categorias as $categoria)
                    <a href="{{ route('home', ['categoria' => $categoria->id]) }}" class="mobile-link">
                        {{ $categoria->nombre }}
                    </a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('noticias') }}" class="mobile-link">
                <i class="fas fa-newspaper"></i> Noticias
            </a>

            <a href="{{ route('about') }}" class="mobile-link">
                <i class="fas fa-info-circle"></i> Sobre Nosotros
            </a>

            @auth
            <a href="{{ route('orders.index') }}" class="mobile-link">
                <i class="fas fa-box-open"></i> Mis Pedidos
            </a>

            <a href="{{ route('profile.edit') }}" class="mobile-link">
                <i class="fas fa-user-circle"></i> Perfil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mobile-link" style="width: 100%; text-align: left; background: none; border: none; color: inherit;">
                    <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="mobile-link">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="mobile-link">
                <i class="fas fa-user-plus"></i> Registro
            </a>
            @endif
            @endauth

            <a href="{{ route('cart.index') }}" class="mobile-link">
                <i class="fas fa-shopping-cart"></i> Carrito
            </a>
        </div>

        <div class="grid-gradient"></div>
    </nav>

</head>

<body>


    <div class="container">
        <h2 class="neon-text">🛒 Tu Carrito</h2>
        @if(count($cart))
        <div class="cart-grid">
            @foreach($cart as $item)
            <div class="cart-item">
                <img src="{{ asset('storage/images/juegos/' . $item['image']) }}" alt="{{ $item['name'] }}" class="item-image">
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

<script>
        // Menú principal móvil
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('show');
        });

        // Dropdowns móviles
        document.querySelectorAll('.mobile-dropdown-button').forEach(button => {
            button.addEventListener('click', function() {
                const dropdownContent = this.nextElementSibling;
                dropdownContent.classList.toggle('show');
            });
        });
    </script>
</body>

</html>