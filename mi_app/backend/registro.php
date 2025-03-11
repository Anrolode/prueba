<?php
include "conexion.php";

$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);
$clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
$rol = trim($_POST['rol']);

// Validar que los campos no estén vacíos
if (empty($nombre) || empty($correo) || empty($_POST['clave']) || empty($rol)) {
    die("Error: Todos los campos son obligatorios.");
}

// Validar formato de correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("Error: El formato del correo no es válido.");
}

// Usar una consulta preparada para evitar inyecciones SQL
$sql = "INSERT INTO usuarios (nombre, correo, clave, rol) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssss", $nombre, $correo, $clave, $rol);
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
