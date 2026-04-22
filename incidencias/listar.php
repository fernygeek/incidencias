<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?autenticacion=fallo");
    exit();
}

require 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT id, titulo FROM incidencia WHERE usuario_id = $usuario_id";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mis Incidencias</title>
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

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .container {
            max-width: 850px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 25px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header h3 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f8f9fa;
            color: #555;
            font-weight: bold;
        }

        tr:hover {
            background: #f5f8ff;
        }

        td a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        td a:hover {
            text-decoration: underline;
        }

        .empty {
            text-align: center;
            color: #999;
            padding: 30px;
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
            <div class="card-header">
                <h3>📋 Mis Incidencias</h3>
                <a href="registrar.php" class="btn btn-success">+ Nueva Incidencia</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($resultado) > 0): ?>
                        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                            <tr>
                                <td><?= $fila['id'] ?></td>
                                <td>
                                    <a href="detalle.php?id=<?= $fila['id'] ?>">
                                        <?= $fila['titulo'] ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="empty">
                                No tienes incidencias registradas. ¡Crea una nueva!
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>