<?php
session_start();
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
    <h1>Sistema de Tickets</h1>
    <hr>
    <h2>🔴 Error 500 – Internal Server Error</h2>
    <p>Ocurrió un problema interno en el servidor.</p>
    <p>Tu sesión ha sido cerrada por seguridad.</p>
    <br>
    <a href="index.php">← Ir al Login</a>
</body>

</html>