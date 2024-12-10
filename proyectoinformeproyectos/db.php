<?php
$host = 'localhost';
$dbname = 'sistema_reportes';
$username = 'root'; // Cambia a tu usuario de base de datos
$password = '';     // Cambia a tu contraseña de base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
