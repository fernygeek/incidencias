<?php
session_start();

// Código de estado HTTP 500 - Internal Server Error
http_response_code(500);

// Destruir la sesión del usuario
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>500 - Internal Server Error</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
        }

        .navbar {
            background: #343a40;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            font-size: 20px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
        }

        .btn-dark {
            background: #343a40;
            color: white;
            border: 1px solid white;
        }

        .btn-primary {
            background: #007bff;
            color: white;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .container {
            max-width: 600px;
            margin: 80px auto;
            padding: 0 20px;
            text-align: center;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 50px 30px;
        }

        .icono {
            font-size: 70px;
            margin-bottom: 20px;
        }

        .card h2 {
            color: #343a40;
            font-size: 26px;
            margin-bottom: 10px;
        }

        .card p {
            color: #777;
            font-size: 15px;
            margin-bottom: 20px;
        }

        .codigo {
            display: inline-block;
            background: #e2e3e5;
            color: #343a40;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .aviso {
            background: #fff3cd;
            border-radius: 8px;
            padding: 12px 20px;
            margin-bottom: 25px;
            font-size: 14px;
            color: #856404;
        }
    </style>
</head>

<body>

    <!-- Barra de navegación -->
    <div class="navbar">
        <h2>🎫 Sistema de Tickets</h2>
    </div>

    <div class="container">
        <div class="card">
            <div class="icono">🔴</div>
            <h2>Error 500 – Internal Server Error</h2>
            <div class="codigo">500 Internal Server Error</div>

            <p>Ocurrió un problema interno en el servidor al procesar tu solicitud.</p>

            <div class="aviso">
                ⚠️ Tu sesión ha sido cerrada por seguridad. Por favor vuelve a iniciar sesión.
            </div>

            <a href="index.php" class="btn btn-primary">🔐 Ir al Login</a>
        </div>
    </div>

</body>

</html>