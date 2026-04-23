<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: listar.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $permitir_conexion_desde_login = true;
    require 'conexion.php';

    $email = $_POST['email'];
    $clave = $_POST['clave'];

    $sql = "SELECT * FROM usuario WHERE email='$email' AND clave='$clave'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $user = mysqli_fetch_assoc($resultado);
        $_SESSION['usuario_id']     = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre'];
        header("Location: listar.php");
        exit();
    } else {
        $error = "Usuario o clave incorrectos.<br>Intenta nuevamente.<br><br>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div>
        <h1>Sistema de Tickets</h1>

        <?php if ($error): ?>
            <div style="color: #FF0000"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <label for="email">Correo electrónico:</label><br><br>
            <input type="email" name="email" placeholder="Correo electrónico" required><br><br>
            <label for="clave">Contraseña:</label><br><br>

            <input type="password" name="clave" placeholder="Contraseña" required><br><br>
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>

</html>