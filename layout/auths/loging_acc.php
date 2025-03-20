<?php
session_start();
require '../config/database.php'; // Conexión a la base de datos

// Variables globales
$correo = "";
$password = "";
$usuario = null;

function obtenerUsuarioPorCorreo($correo, $conn) {
    $sql = "SELECT IDUsuario, Nombre, Apellido, Contrasena, Telefono, TipoUsuario FROM Usuario WHERE Correo = :correo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':correo', $correo);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function iniciarSesion($usuario) {
    session_regenerate_id(true);

    // Guardamos datos del usuario en la sesión
    $_SESSION["IDUsuario"] = $usuario["IDUsuario"];
    $_SESSION["Nombre"] = $usuario["Nombre"];
    $_SESSION["TipoUsuario"] = $usuario["TipoUsuario"];

    redirigirSegunRol($usuario["TipoUsuario"]);
}

function redirigirSegunRol($rol) {
    // Definimos rutas según el tipo de usuario
    $rutas = [
        "Admin" => "../../dashboard.php",
        "Empleado" => "../../services.php",
        "Cliente" => "../../services.php"
    ];

    $url = isset($rutas[$rol]) ? $rutas[$rol] : "../../services.php";
    header("Location: $url");
    exit();
}

function mostrarErrorYRedirigir() {
    echo "<script>alert('Correo o contraseña incorrectos'); window.location.href='../../login.php';</script>";
    exit();
}

//Llamando funciones
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturamos los valores del formulario
    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);

    $usuario = obtenerUsuarioPorCorreo($correo, $conn);

    if ($usuario && password_verify($password, $usuario["Contrasena"])) {
        iniciarSesion($usuario);
    } else {
        mostrarErrorYRedirigir();
    }
} else {
    echo "Acceso no autorizado.";
}
?>
