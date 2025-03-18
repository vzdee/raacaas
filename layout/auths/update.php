<?php
require "../config/db.php"; // Conexión a la BD
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['IDCuenta'])) {
    header("Location: login.php");
    exit();
}

$IDCuenta = $_SESSION['IDCuenta']; // Se obtiene el ID desde la sesión

// Obtener los datos enviados desde el formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$nss = $_POST['nss'] ?? null;
$rfc = $_POST['rfc'] ?? null;

try {
    // Iniciar transacción para asegurar que ambos cambios se hagan correctamente
    $conn->beginTransaction();

    // Actualizar la tabla "cuentas"
    $sql = "UPDATE cuentas SET Nombre = ?, Correo = ?, NumeroTel = ? WHERE IDCuenta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$nombre, $correo, $telefono, $IDCuenta]);

    // Verificar si el usuario tiene rol de "Empleado" antes de actualizar NSS y RFC
    if (!empty($nss) && !empty($rfc)) {
        $sqlEmpleado = "UPDATE empleados SET NSS = ?, RFC = ? WHERE IDCuenta = ?";
        $stmtEmpleado = $conn->prepare($sqlEmpleado);
        $stmtEmpleado->execute([$nss, $rfc, $IDCuenta]);
    }

    // Confirmar transacción
    $conn->commit();

    // Actualizar la sesión con los nuevos datos para que se reflejen sin necesidad de cerrar sesión
    $_SESSION['Nombre'] = $nombre;
    $_SESSION['Correo'] = $correo;
    $_SESSION['NumeroTel'] = $telefono;
    
    if (!empty($nss)) $_SESSION['NSS'] = $nss;
    if (!empty($rfc)) $_SESSION['RFC'] = $rfc;

    // Redirigir con mensaje de éxito
    header("Location: ../../profile.php");
    exit();
} catch (PDOException $e) {
    $conn->rollBack();
    die("Error en la actualización: " . $e->getMessage());
}
?>
