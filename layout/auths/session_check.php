<?php
session_start();
require "layout/config/database.php";

function verificarSesion() {
    if (!isset($_SESSION["IDUsuario"])) {
        header("Location: login.php");
        exit();
    }
    return $_SESSION["IDUsuario"];
}

function obtenerDatosUsuario($conn, $IDCuenta) {
    $sql = "SELECT usuario.IDUsuario, usuario.Nombre, usuario.Apellido, usuario.Correo, usuario.Telefono, usuario.TipoUsuario,
                   empleado.NSS, empleado.RFC
            FROM usuario
            LEFT JOIN empleado ON usuario.IDUsuario = empleado.IDEmpleado
            WHERE usuario.IDUsuario = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $IDCuenta);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function verificarAcceso($rolesPermitidos) {
    if (!in_array($_SESSION["TipoUsuario"], $rolesPermitidos)) {
        header("Location: layout/partials/denied_access.php");
        exit();
    }
}

$IDCuenta = verificarSesion();
$usuario = obtenerDatosUsuario($conn, $IDCuenta);

if (!$usuario) {
    session_destroy();
    header("Location: ../../login.php");
    exit();
}

$_SESSION["TipoUsuario"] = $usuario["TipoUsuario"];
$rol = $_SESSION["TipoUsuario"];
?>
