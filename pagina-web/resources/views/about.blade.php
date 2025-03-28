<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sobre Nosotros - Estudio Indie</title>
    <link href="{{ asset('css/neon-styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap" rel="stylesheet">
    <!-- Se puede incluir Font Awesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Nav bar -->
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


    <!-- Main Content -->
    <main class="container">
        <section>
            <h2>Nuestra Historia</h2>
            <p>Somos un estudio de videojuegos independiente ubicado en el corazón de la ciudad. Fundado por un grupo de apasionados desarrolladores, nos dedicamos a crear experiencias únicas que combinan narrativas envolventes y mecánicas innovadoras.</p>
        </section>

        <div class="grid-gradient"></div>

        <section>
            <h2>Juegos Realizados</h2>
            <ul>
                <li><strong>Juego A:</strong> Una aventura épica en un mundo postapocalíptico.</li>
                <li><strong>Juego B:</strong> Un shooter futurista con acción incesante.</li>
                <li><strong>Juego C:</strong> Un puzzle narrativo que desafía la mente.</li>
            </ul>
        </section>

        <div class="grid-gradient"></div>

        <section>
            <h2>Nuestra Filosofía</h2>
            <p>Creemos en el poder de la innovación y la creatividad. Nuestro objetivo es romper esquemas y ofrecer juegos que no solo entretengan, sino que también inspiren a la comunidad gamer a pensar de forma diferente. La pasión por los videojuegos es el motor que nos impulsa a seguir innovando.</p>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025 RETROGAMES. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Efecto Scanline -->
    <div class="scanline"></div>

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