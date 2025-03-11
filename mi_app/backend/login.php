<?php
session_start();
include "conexion.php";

$correo = $_POST['correo'];
$clave = $_POST['clave'];

$sql = "SELECT * FROM usuarios WHERE correo='$correo'";
$result = $conexion->query($sql);
$usuario = $result->fetch_assoc();

if ($usuario && password_verify($clave, $usuario['clave'])) {
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nombre'] = $usuario['nombre'];
    $_SESSION['rol'] = $usuario['rol'];

    echo ($usuario['rol'] === 'admin') ? "admin" : 
         (($usuario['rol'] === 'cliente') ? "cliente" : "usuario");
    } else {
    echo "error";
}
?>
