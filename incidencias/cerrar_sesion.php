<?php
session_start();

// Destruir la sesión del usuario
session_destroy();

// Regresar al login
header("Location: index.php");
exit();
