<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?autenticacion=fallo");
    exit();
}

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
                <td><?php echo $fila['id']; ?></td>
                <td>
                    <a href="detalle.php?id=<?php echo $fila['id']; ?>">
                        <?php echo $fila['titulo']; ?>
                    </a>
                </td>
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