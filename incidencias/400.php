<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?autenticacion=fallo");
    exit();
}
http_response_code(400);
$errores = isset($_SESSION['errores']) ? $_SESSION['errores'] : [];
unset($_SESSION['errores']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>400 - Bad Request</title>
</head>

<body>
    <h1>Sistema de Tickets</h1>
    <p>Bienvenido: <?= $_SESSION['usuario_nombre'] ?></p>
    <a href="cerrar_sesion.php">Cerrar Sesión</a>
    <hr>
    <h2>⚠️ Error 400 – Bad Request</h2>
    <p>Los datos enviados no son válidos:</p>
    <?php if (!empty($errores)): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <br>
    <a href="registrar.php">← Volver al formulario</a>
</body>

</html>