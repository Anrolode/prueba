<?php
include "conexion.php";

// Verificar si todos los campos están presentes
if (
    !isset($_POST['nombre'], $_POST['nombre_usuario'], $_POST['correo'], 
           $_POST['clave'], $_POST['rol'], $_POST['estado']) || 
    empty($_POST['nombre']) || empty($_POST['nombre_usuario']) || 
    empty($_POST['correo']) || empty($_POST['clave']) || 
    empty($_POST['rol']) || empty($_POST['estado'])
) {
    die("Error: Todos los campos son obligatorios.");
}

// Sanitizar y recibir datos correctamente
$nombre = trim($_POST['nombre']);
$nombre_usuario = trim($_POST['nombre_usuario']);
$correo = trim($_POST['correo']);
$clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
$rol = trim($_POST['rol']);
$estado = trim($_POST['estado']); // Ahora sí almacena correctamente el estado

// Validar formato del correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("Error: El formato del correo no es válido.");
}

// Preparar la consulta SQL correctamente
$sql = "INSERT INTO usuarios (nombre, nombre_usuario, correo, clave, rol, estado) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sssssi", $nombre, $nombre_usuario, $correo, $clave, $rol, $estado);
    if ($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error en el registro: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error en la consulta: " . $conexion->error;
}

$conexion->close();
?>
