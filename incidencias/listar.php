<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?autenticacion=fallo");
    exit();
}

// Cambiar idioma si se envía desde el formulario
if (isset($_POST['cambiar_idioma'])) {
    $_SESSION['idioma'] = $_POST['idioma'];
    setcookie('idioma', $_POST['idioma'], time() + (365 * 24 * 60 * 60), '/');
}

$idioma = isset($_SESSION['idioma']) ? $_SESSION['idioma'] : (isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es');

require 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT id, titulo FROM incidencia WHERE usuario_id = $usuario_id";
$resultado = mysqli_query($conexion, $sql);
?>

<html>
<head>
    <title>Mis Incidencias</title>
</head>
<body>

<div style="text-align: right; margin: 10px;">
    <form method="POST" style="display: inline;">
        <label for="idioma">Idioma:</label>
        <select name="idioma" id="idioma" onchange="this.form.submit();">
            <option value="es" <?= $idioma === 'es' ? 'selected' : '' ?>>Español</option>
            <option value="en" <?= $idioma === 'en' ? 'selected' : '' ?>>English</option>
        </select>
        <input type="hidden" name="cambiar_idioma" value="1">
    </form>
</div>

<h2>Sistema de Tickets</h2>

<p>
    Usuario: <?php echo $_SESSION['usuario_nombre']; ?>
</p>

<a href="cerrar_sesion.php">Cerrar Sesión</a>

<hr>

<h3>Mis Incidencias</h3>

<a href="registrar.php">Nueva Incidencia</a>

<br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Título</th>
    </tr>

    <?php
    if (mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
    ?>
            <tr>
                <td>
                    <a href="detalle.php?id=<?php echo $fila['id']; ?>">
                        <?php echo $fila['id']; ?>
                    </a>
                </td>
                <td><?php echo $fila['titulo']; ?></td>
            </tr>
    <?php
        }
    } else {
    ?>
        <tr>
            <td colspan="2">No tienes incidencias registradas</td>
        </tr>
    <?php
    }
    ?>
</table>

</body>
</html>