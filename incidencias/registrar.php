<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php?autenticacion=fallo");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'conexion.php';

    $titulo      = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $prioridad   = $_POST['prioridad'];
    $usuario_id  = $_SESSION['usuario_id'];

    // Validación
    $errores = [];

    if (empty($titulo)) {
        $errores[] = "El título es obligatorio.";
    }

    if (empty($descripcion)) {
        $errores[] = "La descripción es obligatoria.";
    }

    if (!in_array($prioridad, ['Alta', 'Media', 'Baja'])) {
        $errores[] = "La prioridad no es válida.";
    }

    // Si hay errores de validación: 400
    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;
        header("Location: 400.php");
        exit();
    }

    // Guardar en la base de datos
    $sql = "INSERT INTO incidencia (titulo, descripcion, prioridad, usuario_id) 
            VALUES ('$titulo', '$descripcion', '$prioridad', $usuario_id)";

    $guardado = mysqli_query($conexion, $sql);

    // Si falla la BD: 500
    if (!$guardado) {
        header("Location: 500.php");
        exit();
    }

    // Todo bien: 201
    header("Location: 201.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nueva Incidencia</title>
</head>

<body>

    <div>
        <h2>Sistema de Tickets</h2>
        <div>
            Usuario: <?= $_SESSION['usuario_nombre'] ?><br><br>
            <a href="cerrar_sesion.php">Cerrar Sesión</a>
        </div>
    </div>
    <hr>

    <h3>Nueva Incidencia</h3>

    <form method="POST">

        <div>
            <label>Título *</label>
            <br>
            <input type="text" style="width: 400px; height: 30px;" name="titulo" placeholder="Ej: Cálculos incorrectos en facturación" required>
        </div>
        <br>
        <div>
            <label>Descripción *</label>
            <br>
            <textarea name="descripcion" style="width: 400px; height: 100px;" placeholder="Describe el problema con detalle..." required></textarea>
        </div>
        <br>
        <div>
            <label>Prioridad *</label>
            <br>
            <select name="prioridad" required>
                <option value="">-- Selecciona una prioridad --</option>
                <option value="Alta" style="color: red;">Alta</option>
                <option value="Media" style="color: orange;">Media</option>
                <option value="Baja" style="color: green;">Baja</option>
            </select>
        </div>
        <br><br>
        <div>
            <button type="submit">Guardar Incidencia</button>
            <br><br>
            <a href="listar.php">Cancelar</a>
        </div>

    </form>

</body>

</html>