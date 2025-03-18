<?php
require '../config/db.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["name"]);
    $correo = trim($_POST["correo"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hashear la contraseña
    $numerotel= trim($_POST["numerotel"]);

    try {
        // Verificar si el correo ya está registrado
        $sql = "SELECT IDCuenta FROM Cuentas WHERE Correo = :correo";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('El correo ya está registrado. Intenta con otro.'); window.location.href='../../login.php';</script>";
            exit();
        }

        // Insertar usuario en 'Cuentas'
        $sql = "INSERT INTO Cuentas (Correo, Nombre, Contrasena, NumeroTel) 
                VALUES (:correo, :nombre, :password, :numerotel)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':numerotel', $numerotel);
        $stmt->execute();

        // Obtener el ID generado
        $IDCuenta = $conn->lastInsertId();

        // Insertar en 'clientes'
        $sql = "INSERT INTO clientes (IDCuenta, FechaRegistro) 
                VALUES (:IDCuenta, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':IDCuenta', $IDCuenta, PDO::PARAM_INT);
        $stmt->execute();

        echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href='../../login.php';</script>";
        exit();
    } catch (PDOException $e) {
        echo "Error en el registro: " . $e->getMessage();
    }
} else {
    echo "Acceso no autorizado.";
}
?>
