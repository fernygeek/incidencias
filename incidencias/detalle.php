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
</head>

<body>

    <!-- Barra de navegación -->
    <div>
        <h2>Sistema de Tickets</h2>
        <div>
            Usuario: <?= $_SESSION['usuario_nombre'] ?><br><br>
            <a href="cerrar_sesion.php">Cerrar Sesión</a>
        </div>
    </div>

    <hr>

    <div>
        <h3>Detalle de Incidencia</h3>

        <div>
            <h4>ID</h4>
            <p>#<?= $incidencia['id'] ?></p>
        </div>

        <div>
            <h4>Título</h4>
            <p><?= $incidencia['titulo'] ?></p>
        </div>

        <div>
            <h4>Descripción</h4>
            <p><?= $incidencia['descripcion'] ?></p>
        </div>

        <div>
            <h4>Prioridad</h4>
            <p> <?= $incidencia['prioridad'] ?> </p>
        </div>

        <div>
            <a href="listar.php">← Regresar al listado</a>
        </div>
    </div>

</body>

</html>