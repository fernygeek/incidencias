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
    <h2>Sistema de Tickets</h2>
    <p>Usuario: <?= $_SESSION['usuario_nombre'] ?></p>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
    <hr>
    <div style="color: #15931c">
        <h1>Incidencia Creada – 201 Created</h1>
    </div>
    <p>Tu incidencia fue registrada exitosamente.</p>
    <br>
    <a href="listar.php">Ver mis incidencias</a>
</body>

</html>