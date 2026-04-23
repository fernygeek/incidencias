<?php
session_start();

if (isset($_SESSION['usuario_id'])) {
    header("Location: listar.php");
    exit();
}

$error = "";
$email_guardado = isset($_COOKIE['email_recordado']) ? $_COOKIE['email_recordado'] : '';
$clave_guardada = isset($_COOKIE['clave_recordada']) ? $_COOKIE['clave_recordada'] : '';

// Obtener o establecer idioma
$idioma = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';

// Si se envía el formulario para cambiar idioma
if (isset($_POST['cambiar_idioma'])) {
    $idioma = $_POST['idioma'];
    setcookie('idioma', $idioma, time() + (365 * 24 * 60 * 60), '/');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['cambiar_idioma'])) {
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
        $_SESSION['idioma']         = $idioma;
        
        // Guardar o eliminar cookies de email y contraseña según checkbox
        if (isset($_POST['recordarme'])) {
            setcookie('email_recordado', $email, time() + (30 * 24 * 60 * 60), '/');
            setcookie('clave_recordada', $clave, time() + (30 * 24 * 60 * 60), '/');
        } else {
            setcookie('email_recordado', '', time() - 3600, '/');
            setcookie('clave_recordada', '', time() - 3600, '/');
        }
        
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
            <div>
                <label for="idioma">Idioma:</label>
                <select name="idioma" id="idioma" onchange="this.form.submit();">
                    <option value="es" <?= $idioma === 'es' ? 'selected' : '' ?>>Español</option>
                    <option value="en" <?= $idioma === 'en' ? 'selected' : '' ?>>English</option>
                </select>
                <input type="hidden" name="cambiar_idioma" value="1">
            </div>
        </form>
        <br>
        <form method="POST">
            <label for="email">Correo electrónico:</label><br><br>
            <input type="email" name="email" placeholder="Correo electrónico" value="<?= htmlspecialchars($email_guardado) ?>" required><br><br>
            
            <label for="clave">Contraseña:</label><br><br>
            <input type="password" name="clave" placeholder="Contraseña" value="<?= htmlspecialchars($clave_guardada) ?>" required><br><br>
            
            <input type="checkbox" name="recordarme" id="recordarme" <?= (!empty($email_guardado) && !empty($clave_guardada)) ? 'checked' : '' ?>>
            <label for="recordarme">Recórdarme</label><br><br>
            
            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>

</html>