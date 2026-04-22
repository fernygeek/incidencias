<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?autenticacion=fallo");
    exit();
}

// Código de estado HTTP 201 - Created
http_response_code(201);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>201 - Incidencia Creada</title>
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

        .btn-success {
            background: #28a745;
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
            color: #28a745;
            font-size: 26px;
            margin-bottom: 10px;
        }

        .card p {
            color: #777;
            font-size: 15px;
            margin-bottom: 30px;
        }

        .codigo {
            display: inline-block;
            background: #e9f7ef;
            color: #1e8449;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 30px;
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
            <div class="icono">✅</div>
            <h2>Incidencia Creada</h2>
            <div class="codigo">201 Created</div>
            <p>Tu incidencia fue registrada exitosamente en el sistema.</p>
            <a href="listar.php" class="btn btn-success">📋 Ver mis incidencias</a>
        </div>
    </div>

</body>

</html>