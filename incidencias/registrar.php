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

    // Si hay errores de validación → 400
    if (!empty($errores)) {
        $_SESSION['errores'] = $errores;
        header("Location: 400.php");
        exit();
    }

    // Guardar en la base de datos
    $sql = "INSERT INTO incidencia (titulo, descripcion, prioridad, usuario_id) 
            VALUES ('$titulo', '$descripcion', '$prioridad', $usuario_id)";

    $guardado = mysqli_query($conexion, $sql);

    // Si falla la BD → 500
    if (!$guardado) {
        header("Location: 500.php");
        exit();
    }

    // Todo bien → 201
    header("Location: 201.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Nueva Incidencia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            min-height: 100vh;
        }

        .navbar {
            background: #007bff;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            font-size: 20px;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 14px;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            cursor: pointer;
            border: none;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-primary {
            background: #007bff;
            color: white;
            font-size: 16px;
            width: 100%;
            padding: 12px;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn:hover {
            opacity: 0.85;
        }

        .container {
            max-width: 700px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        .card h3 {
            color: #333;
            margin-bottom: 25px;
            font-size: 22px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .campo {
            margin-bottom: 20px;
        }

        .campo label {
            display: block;
            font-size: 14px;
            color: #555;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .campo input,
        .campo textarea,
        .campo select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            font-family: Arial, sans-serif;
        }

        .campo input:focus,
        .campo textarea:focus,
        .campo select:focus {
            outline: none;
            border-color: #007bff;
        }

        .campo textarea {
            height: 120px;
            resize: vertical;
        }

        .footer-btns {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <!-- Barra de navegación -->
    <div class="navbar">
        <h2>🎫 Sistema de Tickets</h2>
        <div class="navbar-right">
            👤 <?= $_SESSION['usuario_nombre'] ?>
            <a href="cerrar_sesion.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <h3>➕ Nueva Incidencia</h3>

            <form method="POST">

                <div class="campo">
                    <label>Título *</label>
                    <input type="text" name="titulo"
                        placeholder="Ej: Cálculos incorrectos en facturación"
                        required>
                </div>

                <div class="campo">
                    <label>Descripción *</label>
                    <textarea name="descripcion"
                        placeholder="Describe el problema con detalle..."
                        required></textarea>
                </div>

                <div class="campo">
                    <label>Prioridad *</label>
                    <select name="prioridad" required>
                        <option value="">-- Selecciona una prioridad --</option>
                        <option value="Alta">🔴 Alta</option>
                        <option value="Media">🟡 Media</option>
                        <option value="Baja">🟢 Baja</option>
                    </select>
                </div>

                <div class="footer-btns">
                    <button type="submit" class="btn btn-primary">💾 Guardar Incidencia</button>
                    <a href="listar.php" class="btn btn-secondary">← Cancelar</a>
                </div>

            </form>
        </div>
    </div>

</body>

</html>