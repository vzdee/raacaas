<?php
session_start();
require "layout/config/database.php"; // Conectar a la base de datos

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["IDUsuario"])) {
    header("Location: login.php");
    exit();
}

$IDCuenta = $_SESSION["IDUsuario"];

// Obtener todos los datos del usuario desde la BD
$sql = "SELECT usuario.IDUsuario, usuario.Nombre, usuario.Apellido, usuario.Correo, usuario.Telefono, usuario.TipoUsuario,
               empleado.NSS, empleado.RFC
        FROM usuario
        LEFT JOIN empleado ON usuario.IDUsuario = empleado.IDEmpleado
        WHERE usuario.IDUsuario = :id";

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

// Obtener el rol del usuario
$_SESSION["TipoUsuario"] = $usuario["TipoUsuario"];
$rol = $_SESSION["TipoUsuario"];

// Función para verificar acceso según roles permitidos
function verificarAcceso($rolesPermitidos) {
    if (!in_array($_SESSION["TipoUsuario"], $rolesPermitidos)) {
        header("Location: acceso_denegado.php");
        exit();
    }
}

?>