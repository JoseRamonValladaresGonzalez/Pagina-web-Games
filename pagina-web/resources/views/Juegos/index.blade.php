<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetroWave Games</title>
    <link href="{{ asset('css/neon-styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-kit-code.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Incluimos el token CSRF para peticiones AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="scanline"></div>
    <!-- Barra de navegación estilo Breeze adaptada -->
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
                    <a href="{{ route('orders.index') }}" class="nav-link">
    <i class="fas fa-box-open"></i> Mis Pedidos
</a>
                    <!-- Categorías: menú desplegable al pasar el ratón -->
                    <div class="relative group">
                        <button type="button" class="nav-link flex items-center">
                            <i class="fas fa-list"></i> Categorías
                            <i class="fas fa-caret-down ml-1"></i>
                        </button>
                        <div class="user-menu">
                            @foreach ($categorias as $categoria)
                            <a href="{{ route('categorias.show', $categoria->id) }}" class="user-menu-item">
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
            <button @click="open = !open" class="mobile-menu-button">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <!-- Menú móvil -->
    <div x-show="open" class="mobile-menu">
        @auth
        <a href="{{ route('profile.edit') }}" class="mobile-link">
            <i class="fas fa-user-circle"></i> Perfil
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="mobile-link">
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


    <main class="container">
        <h2 class="neon-text" style="font-size: 2rem; margin-bottom: 2rem;">Juegos Destacados</h2>
        <div class="carousel-wrapper">
            <button class="carousel-btn left" onclick="moveCarousel(-1)">&#9665;</button>
            <div class="carousel-container">
                @foreach ($juegos as $juego)
                <div class="game-card" data-product-id="{{ $juego->id }}">
                    <img src="{{ asset('storage/images/' . $juego->imagen) }}" alt="Juego 1" class="game-image">
                    <a class="view-product" href="{{ route('juegos.show', $juego->id) }}">Ver producto</a>
                    <button class="add-to-cart">Añadir al carrito</button>
                </div>
                @endforeach
            </div>
            <button class="carousel-btn right" onclick="moveCarousel(1)">&#9655;</button>
        </div>
    </main>

    <footer class="container">
        <div class="grid-gradient"></div>
        <p style="margin-top: 2rem; color: var(--neon-blue);">
            © 2024 RetroGames - Powered by RetroWave
        </p>
    </footer>

    <!-- Script para el carrusel -->
    <script>
        let scrollAmount = 0;
        const container = document.querySelector(".carousel-container");

        function moveCarousel(direction) {
            // Calcula el ancho de la tarjeta más un margen (ajusta según sea necesario)
            const cardWidth = document.querySelector(".game-card").offsetWidth + 16;
            scrollAmount += direction * cardWidth;
            container.scrollTo({
                left: scrollAmount,
                behavior: "smooth"
            });
        }
    </script>

    <!-- Script para el AJAX y navegación al producto -->
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); 
     document.querySelectorAll('.add-to-cart').forEach(function(button) {
    button.addEventListener('click', function() {
        const gameCard = this.closest('.game-card');
        const productId = gameCard.getAttribute('data-product-id');
        
        fetch("{{ route('cart.add') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                product_id: productId  // Solo enviar ID (la imagen se obtiene del modelo)
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);  // Mensaje actualizado del controlador
        });
    });
});
    </script>
</body>

</html>