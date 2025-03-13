<?php
$host = 'localhost';
$dbname = 'mi_app';
$username = 'root'; // O tu usuario de base de datos
$password = ''; // O tu contraseña de base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

