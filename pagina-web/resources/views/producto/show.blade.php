<head>
<link href="{{ asset('css/neon-styles.css') }}" rel="stylesheet">
</head>
<body class="producto-show">
    <div class="container">
        <h1 class="neon-text">{{ $producto['nombre'] }}</h1>
        <img src="{{ asset('storage/images/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }}" style="width: 300px;">
        <p><strong>Descripción:</strong> {{ $producto['descripcion'] }}</p>
        <p><strong>Precio:</strong> ${{ $producto['precio'] }}</p>
        <button class="add-to-cart">Añadir al carrito</button>
    </div>
</body>
