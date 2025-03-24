<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RetroWave Games</title>
    <link href="{{ asset('css/neon-styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/your-kit-code.js" crossorigin="anonymous"></script>
    <!-- Incluimos el token CSRF para peticiones AJAX -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="scanline"></div>
    
    <header class="container">
        <div class="header-content">
            <div class="logo-container">
                <div class="logo">
                    <img src="{{ asset('storage/images/logo.jpg') }}"  alt="RetroGames Logo" class="w-full h-full object-cover"
                    height="50px" weight="10px">
                </div>
                <h1 class="neon-text">RETRO<span style="color: var(--neon-blue);">GAMES</span></h1>
            </div>
            <nav class="nav-links">
                <a href="#" class="nav-link"><i class="fas fa-sign-in-alt"></i> Login</a>
                <a href="#" class="nav-link"><i class="fas fa-user-plus"></i> Registro</a>
                <a href="{{ route('cart.index') }}" class="nav-link"><i class="fas fa-shopping-cart"></i> Carrito</a>
            </nav>
        </div>
        <div class="grid-gradient"></div>
    </header>

    <main class="container">
        <h2 class="neon-text" style="font-size: 2rem; margin-bottom: 2rem;">Juegos Destacados</h2>
        
        <div class="carousel-container">
            <!-- Juego 1 -->
            <div class="game-card" data-product-id="1">
                <img src="{{ asset('storage/images/minecraft.jpg') }}" alt="Juego 1" class="game-image">
                <button class="view-product">Ver producto</button>
                <button class="add-to-cart">Añadir al carrito</button>
                
            </div>
            
            <!-- Juego 2 -->
            <div class="game-card" data-product-id="2">
                <img src="{{ asset('storage/images/ERNR.jpg') }}" alt="Juego 2" class="game-image">
                <button class="view-product">Ver producto</button>
                <button class="add-to-cart">Añadir al carrito</button>
            </div>
            
            <!-- Juego 3 -->
            <div class="game-card" data-product-id="3">
                <img src="{{ asset('storage/images/ffx.jpg') }}" alt="Juego 3" class="game-image">
                <button class="view-product">Ver producto</button>
                <button class="add-to-cart">Añadir al carrito</button>
            </div>
        </div>
    </main>

    <footer class="container">
        <div class="grid-gradient"></div>
        <p style="margin-top: 2rem; color: var(--neon-blue);">
            © 2024 RetroGames - Powered by RetroWave
        </p>
    </footer>

    <!-- Script para capturar el evento y enviar la petición AJAX -->
    <script>
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      document.querySelectorAll('.add-to-cart').forEach(function(button) {
          button.addEventListener('click', function() {
              const gameCard = this.closest('.game-card');
              const productId = gameCard.getAttribute('data-product-id');
              const image = gameCard.querySelector('img').getAttribute('src');

              fetch("{{ route('cart.add') }}", {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': csrfToken
                  },
                  body: JSON.stringify({
                      product_id: productId,
                      image: image
                  })
              })
              .then(response => response.json())
              .then(data => {
                  alert(data.message);
              })
              .catch(error => console.error('Error:', error));
          });
      });

          // Evento para ver el producto
          document.querySelectorAll('.view-product').forEach(function(button) {
          button.addEventListener('click', function() {
              const gameCard = this.closest('.game-card');
              const productId = gameCard.getAttribute('data-product-id');
              window.location.href = `/productos/${productId}`;
          });
      });
    </script>
</body>
</html>
