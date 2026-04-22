<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?autenticacion=fallo");
    exit();
}

// Código de estado HTTP 400 - Bad Request
http_response_code(400);

// Recoger los errores enviados desde registrar.php
$errores = isset($_SESSION['errores']) ? $_SESSION['errores'] : [];
unset($_SESSION['errores']); // Limpiar los errores de la sesión
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>400 - Bad Request</title>
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
            background: #007bff;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            font-size: 20px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-warning {
            background: #ffc107;
            color: #333;
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
            color: #c0392b;
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
            background: #fde8e8;
            color: #c0392b;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .lista-errores {
            background: #fde8e8;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 25px;
            text-align: left;
        }

        .lista-errores p {
            color: #c0392b;
            font-size: 14px;
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <!-- Barra de navegación -->
    <div class="navbar">
        <h2>🎫 Sistema de Tickets</h2>
        <div class="navbar-right">
            👤 <?= $_SESSION['usuario_nombre'] ?>
            <a href="cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="icono">⚠️</div>
            <h2>Error 400 – Bad Request</h2>
            <div class="codigo">400 Bad Request</div>
            <p>Los datos enviados no son válidos. Por favor revisa los siguientes errores:</p>

            <?php if (!empty($errores)): ?>
                <div class="lista-errores">
                    <?php foreach ($errores as $error): ?>
                        <p>❌ <?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <a href="registrar.php" class="btn btn-warning">🔄 Volver al formulario</a>
        </div>
    </div>

</body>

</html>