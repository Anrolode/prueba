<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="css/styles.css">
</head><body>
    <header>
        <div class="menu">
            <div class="logo-container">
                <img src="img/logo.png" alt="Logo" class="logo">
            </div>
            <div>
                <nav>
                <div>
                    <a href="usuarios.php" class="link" id="registro-link" style="background-color: rgb(192, 192, 192);">
                    <img src="img/registro.png" alt="Registro" class="icon">
                    <span class="title">Usuarios</span>
                </a></div>
                <a href="inventario.php" class="link" style="background-color: rgb(192, 192, 192);">
                    <img src="img/inventario.png" alt="Inventario" class="icon">
                    <span class="title">Inventario</span>
                </a>
                <a href="img/facturacion.html" class="link" style="background-color: rgb(192, 192, 192);">
                    <img src="img/factura.png" alt="Facturación" class="icon">
                    <span class="title">Facturación</span>
                </a>
                <h1>Bienvenido Administrador, <?php echo $_SESSION['nombre']; ?> 🛠️</h1>
                <a href="../backend/logout.php">Cerrar sesión</a>
                </nav>
            </div>
        </div>
    </header>
    <h4>Minimizing System</h4>

    <footer>
        © 2025 Lorman s.a.s
      </footer>
</html>
</body>
<footer> </footer>
</html>