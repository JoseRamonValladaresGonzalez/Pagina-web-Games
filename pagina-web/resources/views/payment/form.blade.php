<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago</title>
    <link href="{{ asset('css/neon-styles.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="{{ asset('css/payment.css') }}" rel="stylesheet">
</head>
<body>
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
<div class="payment-container">
    <h2 class="neon-text">💳 Pago</h2>
    <form action="{{ route('payment.process') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="card-number">🔢 Número de Tarjeta</label>
            <input type="text" id="card-number" name="card_number" 
                   placeholder="•••• •••• •••• ••••" required>
        </div>
        
        <div class="form-group">
            <label for="expiry-date">📅 Fecha de Expiración</label>
            <input type="month" id="expiry-date" name="expiry_date" required>
        </div>

        <div class="form-group">
            <label for="cvv">🔒 CVV</label>
            <input type="text" id="cvv" name="cvv" placeholder="•••" required>
        </div>

        <div class="form-group">
            <label for="name">👤 Nombre en la Tarjeta</label>
            <input type="text" id="name" name="name" placeholder="JUAN PEREZ" required>
        </div>

        <button type="submit" class="neon-button">💵 Pagar Ahora</button>
    </form>
</div>


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