<?php
//registros de usuarios
require '../config/database.php'; // Conexión a la base de datos

if (isset($_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['contrasena'], $_POST['telefono'])) {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $correo = trim($_POST['correo']);
    $contrasena = password_hash(trim($_POST['contrasena']), PASSWORD_BCRYPT); // Cifrar contraseña
    $telefono = trim($_POST['telefono']);

    try {
        // Insertar en la tabla Usuario
        $sql = "INSERT INTO Usuario (nombre, apellido, correo, contrasena, telefono, tipousuario) 
                VALUES (:nombre, :apellido, :correo, :contrasena, :telefono, 'Cliente')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':apellido' => $apellido,
            ':correo' => $correo,
            ':contrasena' => $contrasena,
            ':telefono' => $telefono
        ]);
        // Obtener el ID del usuario insertado
        $idUsuario = $conn->lastInsertId();
        //Pasar el ID a la tabla Cliente
        // Insertar en la tabla Cliente
        $sqlCliente = "INSERT INTO Cliente (IDCliente) VALUES (:idUsuario)";
        $stmtCliente = $conn->prepare($sqlCliente);
        $stmtCliente->execute([':idUsuario' => $idUsuario]);
        header('Location: ../../login.php'); // Completado y manda a la pagina de login
        exit();
    } catch (PDOException $e) {
        die("Error en la consulta: " . $e->getMessage());
    }
} else {
    echo "Faltan datos en el formulario.";
}

// Iniciar Sesion



?>
