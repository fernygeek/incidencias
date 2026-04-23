<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?autenticacion=fallo");
    exit();
}

http_response_code(500);
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>500 - Internal Server Error</title>
</head>

<body>
    <h2>Sistema de Tickets</h2>
    <hr>
    <div style="color: #FF0000">
        <h1>Error 500 – Internal Server Error</h1>
    </div>
    <p>Ocurrió un problema interno en el servidor.</p>
    <p>Tu sesión ha sido cerrada por seguridad.</p>
    <br>
    <a href="index.php">Ir al Login</a>
</body>

</html>