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
    <title>Gestión de usuarios</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
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
            <a href="#" id="openModalBtn">
                Registrar
                <img src="img/registrar.png" width="30" alt="Registrar">
            </a>
            <?php endif; ?>
            <div class="separator"></div>
            <?php if ($_SESSION['rol'] === 'admin'): ?>
        <a href="#" class="edit-user-btn">
             Editar <img src="img/editar.png" width="30" alt="Editar">
        </a>
        <?php endif; ?>
            <a href="#eliminar">Eliminar <img src="img/eliminar.png" width="30" alt="Eliminar"></a>
        </div>

        <div class="container-fluid">
            <br>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nombre de usuario</th>
                        <th>Rol</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>  
    </div>

    <div id="registerModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" id="closeModalBtn">&times;</span>
            </div>
            <h2>Registrar Usuario</h2>
        <form id="registroForm">
        <label for="nombre">Nombre completo:</label>
        <input type="text" id="nombre" placeholder="Nombre" required>
        <label for="email">Correo Electronico:</label>
        <input type="email" id="correo" placeholder="Correo" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="clave" placeholder="Contraseña" required>
        <label for="rol">Rol:</label>
        <select id="rol">
            <option value="usuario">Usuario</option>
            <option value="admin">Administrador</option>
            <option value="cliente">Cliente</option>
        </select>
        <div class="buttons">
            <button type="submit">Registrar</button>
            <button type="button" id="cancelModalBtn">Cancelar</button>
        </div>
    </form>
        </div>
    </div>
<div id="editUserModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" id="closeEditModalBtn">&times;</span>
        </div>
        <h2>Editar Usuario</h2>
        <form id="editUserForm">
            <label for="editNombre">Nombre completo:</label>
            <input type="text" id="editNombre" placeholder="Nombre" required>
            <label for="editCorreo">Correo Electrónico:</label>
            <input type="email" id="editCorreo" placeholder="Correo" required>
            <label for="editRol">Rol:</label>
            <select id="editRol">
                <option value="usuario">Usuario</option>
                <option value="admin">Administrador</option>
                <option value="cliente">Cliente</option>
            </select>
            <div class="buttons">
                <button type="submit">Guardar Cambios</button>
                <button type="button" id="cancelEditModalBtn">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const editUserModal = document.getElementById("editUserModal");
    const editButtons = document.querySelectorAll(".edit-user-btn");
    const closeEditModalBtn = document.getElementById("closeEditModalBtn");
    const cancelEditModalBtn = document.getElementById("cancelEditModalBtn");

    editButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            editUserModal.style.display = "block";
        });
    });

    function closeEditUserModal() {
        editUserModal.style.display = "none";
    }

    closeEditModalBtn.addEventListener("click", closeEditUserModal);
    cancelEditModalBtn.addEventListener("click", closeEditUserModal);

    // Cerrar modal al hacer clic fuera de la ventana del modal
    window.addEventListener("click", function(event) {
        if (event.target === editUserModal) {
            closeEditUserModal();
        }
    });
});
</script>



    <script src="js/registro.js"></script>

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
</script>

</body>
</html>