<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?autenticacion=fallo");
    exit();
}

// Destruir la sesión del usuario
session_destroy();

// Regresar al login
header("Location: index.php");
exit();
