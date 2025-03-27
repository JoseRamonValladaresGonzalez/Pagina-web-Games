<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberSphere - Detalle de Noticia</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap" rel="stylesheet">
    <link href="{{ asset('css/neon-styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/news.css') }}" rel="stylesheet">
</head>
<body>
    <div class="scanline"></div>
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

    <div class="grid-gradient"></div>

    <main>
        <div class="container">
            <article class="article-content">
                <h1 class="news-title">Noticia 2</h1>
                <p class="publish-date">Publicado el 25 de Octubre, 2023</p>
                
                <img src="https://via.placeholder.com/1200x400" alt="Cyberpunk 2077 Phantom Liberty" class="featured-image">
                
                <div class="article-body">
                    <p>En un sorprendente anuncio, CD Projekt RED reveló que la esperada expansión Phantom Liberty para Cyberpunk 2077 ha superado las 5 millones de copias vendidas en su primera semana de lanzamiento. Este éxito marca un hito importante para el estudio polaco, especialmente después del lanzamiento problemático del juego base en 2020.</p>

                    <p>La expansión, que cuenta con la participación del icónico actor Idris Elba en el papel del agente Solomon Reed, introduce una nueva campaña de espionaje en el distrito de Dogtown. Los jugadores han elogiado la profundidad de la narrativa y las mejoras técnicas significativas que acompañan esta actualización.</p>

                    <p>El director del juego, Gabriel Amatangelo, comentó: "Estamos profundamente agradecidos con la comunidad por su apoyo continuo. Phantom Liberty representa todo lo que queríamos que fuera Cyberpunk 2077 desde el principio, y estamos emocionados de ver que los jugadores están disfrutando de esta nueva experiencia."</p>

                    <p>Principales características de la expansión:
                        <ul>
                            <li>Nueva historia de 20+ horas con múltiples finales</li>
                            <li>Sistema de habilidades renovado</li>
                            <li>Mejoras radicales en el sistema de IA</li>
                            <li>Nuevas armas y cyberware</li>
                            <li>Soporte completo para tecnología Ray Tracing Overdrive</li>
                        </ul>
                    </p>

                    <p>Los analistas de la industria señalan que este éxito podría marcar un punto de inflexión para CD Projekt RED, demostrando su capacidad para recuperar la confianza de los jugadores después de un lanzamiento problemático. Mientras tanto, los fanáticos ya especulan sobre posibles contenidos futuros y el anuncio esperado de una secuela.</p>
                </div>
            </article>
        </div>
    </main>

    <div class="grid-gradient"></div>

    <footer>
        <div class="container">
            <p class="neon-text">© 2023 CyberSphere - Todos los derechos reservados</p>
        </div>
    </footer>
</body>
</html>