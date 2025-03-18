<?php
session_start();

try {
    require "layout/config/db.php";

    if (!$conn) {
        throw new Exception("No se pudo establecer la conexión a la base de datos.");
    }

    // Verificar si hay sesión antes de usar $_SESSION["IDCuenta"]
    if (!isset($_SESSION["IDCuenta"])) {
        header("Location: login.php");
        exit();
    }

    $IDCuenta = $_SESSION["IDCuenta"];

    // Obtener datos del usuario desde la BD
    $sql = "SELECT cuentas.IDCuenta, cuentas.Nombre, cuentas.Correo, cuentas.NumeroTel, cuentas.Rol,
                   empleados.NSS, empleados.RFC
            FROM cuentas
            LEFT JOIN empleados ON cuentas.IDCuenta = empleados.IDCuenta
            WHERE cuentas.IDCuenta = :id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $IDCuenta, PDO::PARAM_INT);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si el usuario no existe, destruir sesión y redirigir a login
    if (!$usuario) {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
