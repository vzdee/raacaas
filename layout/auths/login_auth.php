<?php
session_start();
require '../config/database.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);

    try {
        // Verificar usuario en 'cuentas'
        $sql = "SELECT IDUsuario, Nombre, Apellido, Contrasena, Telefono, TipoUsuario FROM Usuario WHERE Correo = :correo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();
        $cuentas = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cuentas && password_verify($password, $cuentas["Contrasena"])) {
            // Regenerar ID de sesión por seguridad
            session_regenerate_id(true);
            
            $_SESSION["IDUsuario"] = $cuentas["IDUsuario"];
            $_SESSION["Nombre"] = $cuentas["Nombre"];
            $_SESSION["TipoUsuario"] = $cuentas["TipoUsuario"]; // Guardar el rol en la sesión
            
            // Redirigir según el rol
            switch ($cuentas["Rol"]) {
                case "Admin":
                    header("Location: ../../dashboard.php");
                    break;
                case "Empleado":
                    header("Location: ../../services.php"); // Página para empleados
                    break;
                case "Cliente":
                    header("Location: ../../services.php"); // Página para clientes
                    break;
                default:
                    header("Location: ../../services.php"); // Por defecto, si no coincide ningún rol
                    break;
            }
            exit();
        } else {
            echo "<script>alert('Correo o contraseña incorrectos'); window.location.href='../../login.php';</script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "Error en el inicio de sesión: " . $e->getMessage();
    }
} else {
    echo "Acceso no autorizado.";
}