<?php
session_start();
require '../config/db.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);

    try {
        // Verificar usuario en 'usuarios'
        $sql = "SELECT IDCuenta, Nombre, Contrasena, NumeroTel, Rol FROM cuentas WHERE Correo = :correo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $cuentas = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cuentas && password_verify($password, $cuentas["Contrasena"])) {
            $_SESSION["IDCuenta"] = $cuentas["IDCuenta"];
            $_SESSION["Nombre"] = $cuentas["Nombre"];
            $_SESSION["Rol"] = $cuentas["Rol"]; // Guardar el rol en la sesión
            header("Location: ../../dashboard.php");
            exit();
        }else {
            echo "<script>alert('Correo o contraseña incorrectos'); window.location.href='../../login.php';</script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "Error en el inicio de sesión: " . $e->getMessage();
    }
} else {
    echo "Acceso no autorizado.";
}
?>
