<?php
session_start();
require "layout/config/db.php"; // Conectar a la base de datos

// Verificar si el usuario ha iniciado sesión
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

// Obtener el rol del usuario
$rol = $usuario["Rol"];

// Consulta de servicios según el rol del usuario
try {
    if ($rol == "Cliente") {
        $sqlServicios = "SELECT s.IDServicio, s.IDEmpleado, i.EstadoServicio, i.TipoServicio, i.CostoEstimado, s.FechaInicial, s.FechaFinal
                FROM servicios s
                JOIN infoservicios i ON s.IDServicio = i.IDServicio
                JOIN clientes c ON s.IDCliente = c.IDCliente
                WHERE c.IDCuenta = :idCuenta";
    } elseif ($rol == "Empleado") {
        $sqlServicios = "SELECT s.IDServicio, s.IDEmpleado, i.EstadoServicio, i.TipoServicio, i.CostoEstimado, s.FechaInicial, s.FechaFinal
                FROM servicios s
                JOIN infoservicios i ON s.IDServicio = i.IDServicio
                JOIN empleados e ON s.IDEmpleado = e.IDEmpleado
                WHERE e.IDCuenta = :idCuenta";
    } else { // Admin puede ver todos los servicios
        $sqlServicios = "SELECT s.IDServicio, s.IDEmpleado, i.EstadoServicio, i.TipoServicio, i.CostoEstimado, s.FechaInicial, s.FechaFinal
                FROM servicios s
                JOIN infoservicios i ON s.IDServicio = i.IDServicio";
    }

    $stmtServicios = $conn->prepare($sqlServicios);
    if ($rol != "Admin") {
        $stmtServicios->bindParam(':idCuenta', $IDCuenta, PDO::PARAM_INT);
    }
    $stmtServicios->execute();
    $servicios = $stmtServicios->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener los servicios: " . $e->getMessage());
}
?>
