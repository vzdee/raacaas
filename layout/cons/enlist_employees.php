<?php
require "../config/database.php"; // Asegúrate de que la conexión a la BD funciona

// Función para registrar usuario en la tabla Usuario
function registrarUsuario($conn, $nombre, $apellido, $correo, $contrasena, $telefono) {
    try {
        $sql = "INSERT INTO Usuario (nombre, apellido, correo, contrasena, telefono, tipousuario) 
                VALUES (:nombre, :apellido, :correo, :contrasena, :telefono, 'Empleado')";
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
        die("Error en la consulta (registrarUsuario): " . $e->getMessage());
    }
}

// Función para insertar empleado en la tabla Empleado
function insertarEmpleado($conn, $idUsuario, $NSS, $RFC) {
    try {
        $sql = "INSERT INTO Empleado (IDEmpleado, NSS, RFC) VALUES (:idUsuario, :NSS, :RFC)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':idUsuario' => $idUsuario,
            ':NSS' => $NSS,
            ':RFC' => $RFC
        ]);
    } catch (PDOException $e) {
        die("Error en la consulta (insertarEmpleado): " . $e->getMessage());
    }
}

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y recibir los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $rfc = $_POST["rfc"];
    $nss = $_POST["nss"] ?? null; // Asegurar que no dé error si no se envía

    // Establecer una contraseña predeterminada o generarla aleatoriamente
    $contrasena = "Empleado123"; // Puedes cambiar esto o generar una aleatoria

    // Insertar usuario y obtener su ID
    $idUsuario = registrarUsuario($conn, $nombre, $apellido, $correo, $contrasena, $telefono);

    // Insertar empleado en la tabla Empleado
    insertarEmpleado($conn, $idUsuario, $nss, $rfc);

    echo "Empleado registrado exitosamente.";
}
?>
