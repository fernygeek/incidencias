<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?autenticacion=fallo");
    exit();
}
http_response_code(201);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>201 - Creado</title>
</head>

<body>
    <h1>Sistema de Tickets</h1>
    <p>Bienvenido: <?= $_SESSION['usuario_nombre'] ?></p>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
    <hr>
    <h2>✅ Incidencia Creada – 201 Created</h2>
    <p>Tu incidencia fue registrada exitosamente.</p>
    <br>
    <a href="listar.php">Ver mis incidencias</a>
</body>

</html>