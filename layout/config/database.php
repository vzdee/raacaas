<?php
// consultar_usuarios.php
$host = "localhost";
$user = "root"; // Usuario por defecto en XAMPP
$password = ""; // XAMPP no tiene contraseña por defecto
$database = "raacaas"; // Nombre de tu base de datos
try {
    $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

?>
