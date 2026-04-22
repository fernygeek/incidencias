<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?autenticacion=fallo");
    exit();
}

require 'conexion.php';

// Verificar que se recibió el ID por la URL
if (!isset($_GET['id'])) {
    header("Location: listar.php");
    exit();
}

$id = $_GET['id'];
$usuario_id = $_SESSION['usuario_id'];

// Buscar la incidencia que pertenezca al usuario logueado
$sql = "SELECT * FROM incidencia WHERE id = $id AND usuario_id = $usuario_id";
$resultado = mysqli_query($conexion, $sql);

// Si no existe o no le pertenece, regresar al listado
if (mysqli_num_rows($resultado) == 0) {
    header("Location: listar.php");
    exit();
}

$incidencia = mysqli_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Detalle de Incidencia</title>
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

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .container {
            max-width: 750px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .card h3 {
            color: #333;
            margin-bottom: 25px;
            font-size: 22px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .campo {
            margin-bottom: 20px;
        }

        .campo label {
            display: block;
            font-size: 13px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .campo p {
            font-size: 16px;
            color: #333;
        }

        .prioridad {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .prioridad.Alta {
            background: #ffe0e0;
            color: #c0392b;
        }

        .prioridad.Media {
            background: #fff4e0;
            color: #d68910;
        }

        .prioridad.Baja {
            background: #e0f7e9;
            color: #1e8449;
        }

        .footer-btn {
            margin-top: 30px;
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
            <h3>📄 Detalle de Incidencia</h3>

            <div class="campo">
                <label>ID</label>
                <p>#<?= $incidencia['id'] ?></p>
            </div>

            <div class="campo">
                <label>Título</label>
                <p><?= $incidencia['titulo'] ?></p>
            </div>

            <div class="campo">
                <label>Descripción</label>
                <p><?= $incidencia['descripcion'] ?></p>
            </div>

            <div class="campo">
                <label>Prioridad</label>
                <p>
                    <span class="prioridad <?= $incidencia['prioridad'] ?>">
                        <?= $incidencia['prioridad'] ?>
                    </span>
                </p>
            </div>

            <div class="footer-btn">
                <a href="listar.php" class="btn btn-secondary">← Regresar al listado</a>
            </div>
        </div>
    </div>

</body>

</html>