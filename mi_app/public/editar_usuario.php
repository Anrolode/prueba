<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Obtener datos del usuario a editar
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        header("Location: usuarios_registrados.php");
        exit;
    }
} else {
    header("Location: usuarios_registrados.php");
    exit;
}

// Procesar actualización de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = trim($_POST['nombre_usuario']);
    $rol = trim($_POST['rol']);
    $estado = (int)$_POST['estado'];

    $updateQuery = "UPDATE usuarios SET nombre_usuario = :nombre_usuario, rol = :rol, estado = :estado WHERE id = :id";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->execute([
        'nombre_usuario' => $nombre_usuario,
        'rol' => $rol,
        'estado' => $estado,
        'id' => $id
    ]);

    header("Location: usuarios_registrados.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Editar Usuario</h2>
    <form method="POST">
        <label>Nombre de Usuario:</label>
        <input type="text" name="nombre_usuario" value="<?php echo htmlspecialchars($usuario['nombre_usuario'], ENT_QUOTES, 'UTF-8'); ?>" required>
        
        <label>Rol:</label>
        <select name="rol" required>
            <option value="usuario" <?php echo ($usuario['rol'] === 'usuario') ? 'selected' : ''; ?>>Usuario</option>
            <option value="admin" <?php echo ($usuario['rol'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
        </select>
        
        <label>Estado:</label>
        <select name="estado" required>
            <option value="1" <?php echo ($usuario['estado'] == 1) ? 'selected' : ''; ?>>Activo</option>
            <option value="0" <?php echo ($usuario['estado'] == 0) ? 'selected' : ''; ?>>Inactivo</option>
        </select>
        
        <button type="submit">Actualizar</button>
        <a href="index.php">Cancelar</a>
    </form>
</body>
</html>
