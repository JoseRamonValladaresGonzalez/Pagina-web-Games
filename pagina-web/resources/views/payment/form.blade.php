<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Pago</title>
    <style>
        body {
            background-color: #0a0a0a;
            font-family: 'Arial', sans-serif;
            color: #fff;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 2rem;
            border-radius: 10px;
            border: 2px solid #0ff;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            max-width: 500px;
            width: 100%;
        }

        h2.neon-text {
            color: #0ff;
            text-align: center;
            text-shadow: 0 0 10px #0ff;
            animation: flicker 1.5s infinite alternate;
            margin-bottom: 2rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        label {
            color: #0f0;
            font-weight: bold;
            text-shadow: 0 0 5px #0f0;
        }

        input {
            background: rgba(0, 0, 0, 0.7);
            border: 2px solid #0ff;
            border-radius: 5px;
            padding: 10px;
            color: #0ff;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #0f0;
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.5);
        }

        button {
            background: #000;
            color: #0ff;
            border: 2px solid #0ff;
            padding: 12px;
            font-size: 1.1rem;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        button:hover {
            background: #0ff;
            color: #000;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.5);
            transform: scale(1.05);
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

        /* Efecto de brillo al hacer hover en los inputs */
        input:hover {
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
        }

        /* Estilo para placeholders */
        ::placeholder {
            color: #0ff;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="neon-text">Pago</h2>
        <form action="{{ route('payment.process') }}" method="POST">
            @csrf
            <label for="card-number">Número de Tarjeta</label>
            <input type="text" id="card-number" name="card_number" placeholder="•••• •••• •••• ••••" required>

            <label for="expiry-date">Fecha de Expiración</label>
            <input type="month" id="expiry-date" name="expiry_date" required>

            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" placeholder="•••" required>

            <label for="name">Nombre en la Tarjeta</label>
            <input type="text" id="name" name="name" placeholder="JUAN PEREZ" required>

            <button type="submit">Pagar</button>
        </form>
    </div>
</body>
</html>