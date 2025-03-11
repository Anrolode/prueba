<?php
$conexion = new mysqli("localhost", "root", "", "mi_app");
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
?>
