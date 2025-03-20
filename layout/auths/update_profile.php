<?php
require "../config/database.php";

function verificarSesion() {
    session_start();
    if (!isset($_SESSION["IDUsuario"])) {
        header("Location: ../login.php");
        exit();
    }
    return $_SESSION["IDUsuario"];
}

function actualizarUsuario($conn, $id, $nombre, $apellido, $correo, $telefono) {
    $sql = "UPDATE usuario SET Nombre = :nombre, Apellido = :apellido, Correo = :correo, Telefono = :telefono WHERE IDUsuario = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ":nombre" => $nombre,
        ":apellido" => $apellido,
        ":correo" => $correo,
        ":telefono" => $telefono,
        ":id" => $id
    ]);
}

function actualizarEmpleado($conn, $id, $nss, $rfc) {
    if (!empty($nss) && !empty($rfc)) {
        $sql = "UPDATE empleado SET NSS = :nss, RFC = :rfc WHERE IDEmpleado = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ":nss" => $nss,
            ":rfc" => $rfc,
            ":id" => $id
        ]);
    }
}

function procesarFormulario($conn) {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = verificarSesion();
        $nombre = trim($_POST["nombre"]);
        $apellido = trim($_POST["apellido"]);
        $correo = trim($_POST["correo"]);
        $telefono = trim($_POST["telefono"]);
        $nss = $_POST["nss"] ?? null;
        $rfc = $_POST["rfc"] ?? null;

        try {
            $conn->beginTransaction();
            actualizarUsuario($conn, $id, $nombre, $apellido, $correo, $telefono);
            actualizarEmpleado($conn, $id, $nss, $rfc);
            $conn->commit();
            header("Location: ../../profile.php?success=1");
            exit();
        } catch (Exception $e) {
            $conn->rollBack();
            die("Error al actualizar los datos: " . $e->getMessage());
        }
    } else {
        header("Location: ../../profile.php");
        exit();
    }
}

procesarFormulario($conn);
?>
