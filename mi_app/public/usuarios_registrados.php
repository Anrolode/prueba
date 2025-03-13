<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.html");
    exit();
}
?>
<?php
include 'conexion.php';

// Consulta para obtener los usuarios
$query = "SELECT * FROM usuarios";
$stmt = $pdo->query($query);
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de usuarios</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .main-container {
            border: 2px solid black; /* Borde negro alrededor del contenedor */
            margin: 20px auto;
            width: 80%;
            height: 400px; /* Ajusta la altura del contenedor */
            overflow-y: auto; /* Habilita el scroll vertical */
            background-color: #f0f0f0; /* Fondo gris claro */
            padding: 10px;
        }
               /* Estilos para el modal */
        .modal {
            display: none; /* Ocultar el modal por defecto */
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4); /* Fondo oscuro semi-transparente */
        }

        .modal-content {
            position: absolute;
            top: 100px; /* Ajusta según la posición deseada */
            left: 50%;
            transform: translateX(-50%);
            width: 400px; /* Ancho del formulario */
            background-color: rgb(195, 195, 195); /* Fondo gris */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            position: relative; /* Necesario para posicionar el botón de cierre */
        }

        .modal-header {
            display: flex;
            justify-content: flex-end;
        }

        .close {
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .modal-content label {
            display: block;
            margin-bottom: 10px;
        }

        .modal-content input,
        .modal-content select {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
        }

        .modal-content .buttons {
            display: flex;
            justify-content: space-between;
        }

        .modal-content .buttons button {
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <div class="menu">
            <div class="logo-container">
                <img src="img/logo.png" alt="Logo" class="logo">
            </div>
            <div>
                <nav>
                    <a href="dashboard_admin.php" class="link" style="background-color: rgb(255, 255, 255);">
                        <img src="img/registro.png" alt="Gestión" class="icon">
                        <span class="title">Usuarios</span>
                    </a>
                    <a href="inventario.php" class="link" style="background-color: rgb(192, 192, 192);">
                        <img src="img/inventario.png" alt="Inventario" class="icon">
                        <span class="title">Inventario</span>
                    </a>
                    <a href="facturacion.php" class="link" style="background-color: rgb(192, 192, 192);">
                        <img src="img/factura.png" alt="Facturación" class="icon">
                        <span class="title">Facturación</span>
                    </a>
                    <h1>Bienvenido Administrador, <?php echo $_SESSION['nombre']; ?> 🛠️</h1>
                    <a href="../backend/logout.php">Cerrar sesión</a>
                </nav>
            </div>
        </div>
    </header>

    <div class="main-container">
        <div id="registro-acciones" class="acciones">
            <?php if ($_SESSION['rol'] === 'admin'): ?>
            <a href="registrar_usuario.php">
                Registrar
                <img src="img/registrar.png" width="30" alt="Registrar">
            </a>
            <?php endif; ?>
            <div class="separator"></div>
            <?php if ($_SESSION['rol'] === 'admin'): ?>
        <a href="usuarios.php" class="edit-user-btn">
             Editar <img src="img/cliceditar.png" width="30" alt="Editar">
        </a>
        <?php endif; ?>
        <div class="separator"></div>
            <a href="#eliminar">Eliminar <img src="img/eliminar.png" width="30" alt="Eliminar"></a>
        </div>


        <div class="container-fluid">
            <br>
            <table class="custom-table">
                <thead>
                    <tr>
                <th>Nombre de Usuario</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo htmlspecialchars($usuario['nombre_usuario']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['rol']); ?></td>
                    <td><?php echo htmlspecialchars($usuario['estado']); ?></td>
                    <td>
                        <a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>