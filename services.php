<?php
require 'layout/config/db.php'; // Conectar a la base de datos
require 'layout/auths/session.php'; // Verificar si el usuario ha iniciado sesión
require 'layout/partials/dasheader.php'; // Realizar las consultas SQL
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
    <h3>Lista de Servicios</h3>
    <table>
        <thead>
            <tr>
                <th>ID Servicio</th>
                <th>ID Empleado</th>
                <th>Estado</th>
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
                    <td><?php echo $servicio["IDEmpleado"]; ?></td>
                    <td><?php echo $servicio["EstadoServicio"]; ?></td>
                    <td><?php echo $servicio["TipoServicio"]; ?></td>
                    <td><?php echo $servicio["CostoEstimado"]; ?></td>
                    <td><?php echo $servicio["FechaInicial"]; ?></td>
                    <td><?php echo $servicio["FechaFinal"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
