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
    <title>Inventario</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        /* Estilos para el modal */
        .modal {
            display: none;
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
                    <a href="usuarios.php" class="link" id="registro-link" style="background-color: rgb(192, 192, 192);">
                        <img src="img/registro.png" alt="Registro" class="icon">
                        <span class="title">Usuarios</span>
                    </a>
                    <a href="dashboard_admin.php" class="link" style="background-color: white">
                        <img src="img/inventario.png" alt="Inventario" class="icon">
                        <span class="title">Inventario</span>
                    </a>
                    <a href="facturacion.html" class="link" style="background-color: rgb(192, 192, 192);">
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
            <a href="#" id="openModalBtn">
                Registrar Producto
                <img src="img/registrarproducto.png" width="30" alt="registrarproducto">
            </a>
            <?php endif; ?>
            <div class="separator"></div>
            <a href="generarreporte.html">
                Generar reporte
                <img src="img/generarreporte.png" width="30" alt="generarreporte">
            </a>
         </div>       

         <!-- Tabla de productos -->
         <div class="container-fluid">
            <br>
            <table class="custom-table">
              <thead>
                <tr>
                  <th>Nombre del producto</th>
                  <th>Descripción</th>
                  <th>Precio</th>
                  <th>Categoría</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>  
    </div>

    <!-- Modal para registrar producto -->
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
            <span class="close" id="closeModalBtn">&times;</span>
            </div>
            <h2>Registrar Producto</h2>
            <form id="registroProductoForm">
            <label for="nombre">Nombre del Producto:</label>
    <input type="text" id="nombre" placeholder="Nombre del producto">
    <label for="descripcion">Descripcion:</label>
    <input type="text" id="descripcion" placeholder="Descripción">
    <label for="precio">Precio:</label>
    <input type="number" id="precio" placeholder="Precio">
    <label for="categoria">Categoria:</label>
    <select id="categoria" placeholder="Categoría">
            <option value="Muebles">Muebles</option>
            <option value="Electronica">Electronica</option>
            <option value="Oficinas">Oficinas</option>
        </select>
    <div class="buttons">
    <button type="submit">Registrar Producto</button>
    <button type="button" id="cancelModalBtn">Cancelar</button>
    </div>
</form>
        </div>
    </div>

    <script src="js/registrar_producto.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const registerModal = document.getElementById("registerModal");
        const openModalBtn = document.getElementById("openModalBtn");
        const closeModalBtn = document.getElementById("closeModalBtn");
        const cancelModalBtn = document.getElementById("cancelModalBtn");

        openModalBtn.addEventListener("click", function(event) {
            event.preventDefault();
            registerModal.style.display = "block";
        });

        function closeRegisterModal() {
            registerModal.style.display = "none";
        }

        closeModalBtn.addEventListener("click", closeRegisterModal);
        cancelModalBtn.addEventListener("click", closeRegisterModal);

        window.onclick = function(event) {
            if (event.target === registerModal) {
                closeRegisterModal();
            }
        }
    });
    // Cerrar el modal con el botón de cancelar
document.getElementById("cancelModalBtn").addEventListener("click", function () {
    document.getElementById("registerModal").style.display = "none";
});

// Cerrar el modal con la 'X'
document.getElementById("closeModalBtn").addEventListener("click", function () {
    document.getElementById("registerModal").style.display = "none";
});

</script>

</body>
</html>