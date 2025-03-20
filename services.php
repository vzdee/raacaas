<?php
require 'layout/config/database.php'; // Conectar a la base de datos
require_once 'layout/auths/session_check.php'; // Verificar si el usuario ha iniciado sesión
require 'layout/partials/dasheader.php';
require 'layout/cons/services_cons.php'
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Mis Servicios</title>
</head>
<body class="mis-servicios-page">
    <h2>Bienvenido, <?php echo $_SESSION["Nombre"]; ?></h2>
    <h3>Mis Servicios</h3>
    <table>
        <thead>
            <tr>
                <th>ID Servicio</th>
                <th>Cliente</th>

                <?php if ($_SESSION["TipoUsuario"] === "Admin") : ?>
                <th>ID Cliente</th>
                <?php endif; ?>

                <th>Empleado</th>

                <?php if ($_SESSION["TipoUsuario"] === "Admin") : ?>
                <th>ID Empleado</th>
                <?php endif; ?>
                    
                <th>Tipo de Servicio</th>
                <th>Costo Estimado</th>
                <th>Fecha Inicial</th>
                <th>Fecha Final</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($servicios as $servicio): ?>
                <tr>
                    <td><?php echo $servicio["IDServicio"]; ?></td>
                    <td><?php echo $servicio["NombreCliente"]; ?></td>

                    <?php if ($_SESSION["TipoUsuario"] === "Admin") : ?>
                    <td><?php echo $servicio["IDCliente"]; ?></td>
                    <?php endif; ?>

                    <td><?php echo $servicio["NombreEmpleado"]; ?></td>

                    <?php if ($_SESSION["TipoUsuario"] === "Admin") : ?>
                    <td><?php echo $servicio["IDEmpleado"]; ?></td>
                    <?php endif; ?>

                    <td><?php echo $servicio["TipoServicio"]; ?></td>
                    <td><?php echo $servicio["CostoEstimado"]; ?></td>
                    <td><?php echo $servicio["FechaInicio"]; ?></td>
                    <td><?php echo $servicio["FechaFinal"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
