<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: listar.php");
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'conexion.php';

    $email = $_POST['email'];
    $clave = MD5($_POST['clave']);

    $sql = "SELECT * FROM usuario WHERE email='$email' AND clave='$clave'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $user = mysqli_fetch_assoc($resultado);
        $_SESSION['usuario_id']     = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre'];
        header("Location: listar.php");
        exit();
    } else {
        $error = "Usuario o clave incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login - SIT</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-box {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 360px;
        }

        .login-box h2 {
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
        }

        input {
            width: 100%;
            padding: 10px 14px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #007bff;
        }

        button {
            width: 100%;
            padding: 11px;
            margin-top: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            background: #ffe0e0;
            color: #c0392b;
            padding: 10px;
            border-radius: 6px;
            text-align: center;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>🎫 Sistema de Tickets</h2>

        <?php if ($error): ?>
            <div class="error">⚠️ <?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="clave" placeholder="Contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>

</html>