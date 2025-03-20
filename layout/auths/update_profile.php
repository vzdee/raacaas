<?php
session_start();
require "../config/database.php"; // Conectar a la BD

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["IDUsuario"])) {
    header("Location: ../login.php");
    exit();
}

$IDCuenta = $_SESSION["IDUsuario"];

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $correo = trim($_POST["correo"]);
    $telefono = trim($_POST["telefono"]);
    $nss = isset($_POST["nss"]) ? trim($_POST["nss"]) : null;
    $rfc = isset($_POST["rfc"]) ? trim($_POST["rfc"]) : null;

    try {
        // Iniciar una transacción
        $conn->beginTransaction();

        // Actualizar la tabla usuario
        $sqlUsuario = "UPDATE usuario SET Nombre = :nombre, Apellido = :apellido, Correo = :correo, Telefono = :telefono WHERE IDUsuario = :id";
        $stmtUsuario = $conn->prepare($sqlUsuario);
        $stmtUsuario->bindParam(":nombre", $nombre);
        $stmtUsuario->bindParam(":apellido", $apellido);
        $stmtUsuario->bindParam(":correo", $correo);
        $stmtUsuario->bindParam(":telefono", $telefono);
        $stmtUsuario->bindParam(":id", $IDCuenta);
        $stmtUsuario->execute();

        // Si el usuario es empleado/admin, actualizar NSS y RFC en la tabla empleado
        if (!empty($nss) && !empty($rfc)) {
            $sqlEmpleado = "UPDATE empleado SET NSS = :nss, RFC = :rfc WHERE IDEmpleado = :id";
            $stmtEmpleado = $conn->prepare($sqlEmpleado);
            $stmtEmpleado->bindParam(":nss", $nss);
            $stmtEmpleado->bindParam(":rfc", $rfc);
            $stmtEmpleado->bindParam(":id", $IDCuenta);
            $stmtEmpleado->execute();
        }

        // Confirmar la transacción
        $conn->commit();

        // Redirigir con mensaje de éxito
        header("Location: ../../profile.php?success=1");
        exit();
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollBack();
        die("Error al actualizar los datos: " . $e->getMessage());
    }
} else {
    header("Location: ../../profile.php");
    exit();
}
?>
