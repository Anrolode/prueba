<?php
include "conexion.php"; // Asegúrate de que este archivo establece correctamente la conexión a la base de datos

// Recibir datos del formulario y sanitizarlos
$nombre = trim($_POST['producto']);
$descripcion = trim($_POST['descripcion']);
$precio = trim($_POST['precio']);
$categoria = trim($_POST['categoria']);

// Validar que los campos no estén vacíos
if (empty($nombre) || empty($descripcion) || empty($precio) || empty($categoria)) {
    die("Error: Todos los campos son obligatorios.");
}

// Validar que el precio sea un número válido
if (!is_numeric($precio) || $precio <= 0) {
    die("Error: El precio debe ser un número válido y mayor a 0.");
}

// Consulta preparada para evitar inyecciones SQL
$sql = "INSERT INTO productos (nombre, descripcion, precio, categoria) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssds", $nombre, $descripcion, $precio, $categoria);
    
    if ($stmt->execute()) {
        echo "Producto registrado exitosamente.";
    } else {
        echo "Error en el registro: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error en la consulta: " . $conexion->error;
}

$conexion->close();
?>