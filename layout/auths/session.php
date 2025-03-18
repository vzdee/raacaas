<?php
session_start();
require "layout/config/db.php";

if (!isset($_SESSION["IDCuenta"])) {
    header("Location: login.php");
    exit();
}

$IDCuenta = $_SESSION["IDCuenta"];

// Obtener todos los datos del usuario desde la BD
$sql = "SELECT cuentas.IDCuenta, cuentas.Nombre, cuentas.Correo, cuentas.NumeroTel, cuentas.Rol,
               empleados.NSS, empleados.RFC
        FROM cuentas
        LEFT JOIN empleados ON cuentas.IDCuenta = empleados.IDCuenta
        WHERE cuentas.IDCuenta = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $IDCuenta);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Si el usuario no existe, redirigir a login
if (!$usuario) {
    session_destroy();
    header("Location: login.php");
    exit();
}

//Actualizar datos del usuario al cambiar algo

?>
