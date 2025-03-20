<?php
session_start();
session_unset(); // Limpiar variables de sesión
session_destroy(); // Destruir la sesión
session_write_close(); // Cierra la sesión para evitar problemas
$_SESSION = []; // Vaciar variables de sesión
header("Location: ../../login.php");
exit();
?>
