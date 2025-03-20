<?php
require '../config/database.php'; // Conexión a la base de datos

function registrarUsuario($conn, $nombre, $apellido, $correo, $contrasena, $telefono) {
    try {
        $sql = "INSERT INTO Usuario (nombre, apellido, correo, contrasena, telefono, tipousuario) 
                VALUES (:nombre, :apellido, :correo, :contrasena, :telefono, 'Cliente')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':correo' => $correo,
            ':contrasena' => password_hash($contrasena, PASSWORD_BCRYPT), // Cifrar contraseña
            ':telefono' => $telefono
        ]);
        return $conn->lastInsertId(); // Retornar ID del usuario registrado
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}

function registrarCliente($conn, $idUsuario) {
    try {
        $sql = "INSERT INTO Cliente (IDCliente) VALUES (:idUsuario)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':idUsuario' => $idUsuario]);
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['correo']) && !empty($_POST['contrasena']) && !empty($_POST['telefono'])) {
        $idUsuario = registrarUsuario($conn, trim($_POST['nombre']), trim($_POST['apellido']), trim($_POST['correo']), trim($_POST['contrasena']), trim($_POST['telefono']));
        registrarCliente($conn, $idUsuario);
        header('Location: ../../login.php');
        exit();
    } else {
        echo "Faltan datos en el formulario.";
    }
}
?>
