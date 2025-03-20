<?php
verificarAcceso(["Admin"]);
require "layout/auths/session_check.php";// Conexión a la base de datos
require "layout/cons/dash_cons.php";  // Incluir el archivo que contiene la consulta
require 'layout/partials/dasheader.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Dashboard</title>
</head>
<body class="dashboard-page">
    <div class="container-dashboard">
        <?php if ($empleados): ?>
            <table class="users-table">
            <h3 class="page-title">Lista de Empleados</h3>
                <thead>
                    <tr>
                        <th>ID Empleado</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>RFC</th>
                        <th>Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($empleados as $empleado) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($empleado['IDUsuario']) . "</td>";
                        echo "<td>" . htmlspecialchars($empleado['Nombre']) . "</td>";
                        echo "<td>". htmlspecialchars($empleado["Apellido"]) ."</td>";
                        echo "<td>" . htmlspecialchars($empleado['Correo']) . "</td>";
                        echo "<td>" . htmlspecialchars($empleado['Telefono']) . "</td>";
                        echo "<td>" . htmlspecialchars($empleado['RFC']) . "</td>";
                        echo "<td>" . htmlspecialchars($empleado['FechaRegistro']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay empleados para mostrar.</p>
        <?php endif; ?>
    </div>

    <div class="container-dashboard">
        <?php if ($servicios): ?>
            <table class="services-table">
            <h3 class="services-title">Lista de Servicios</h3>
                <thead>
                    <tr>
                        <th>ID Servicio</th>
                        <th>ID Empleado</th>    
                        <th>ID Cliente</th>
                        <th>Tipo Servicio</th>
                        <th>Estado Servicio</th>
                        <th>Costo Estimado</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Final</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($servicios as $servicio) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($servicio['IDServicio']) . "</td>";
                        echo "<td>" . htmlspecialchars($servicio['IDEmpleado']) . "</td>";
                        echo "<td>" . htmlspecialchars($servicio['IDCliente']) . "</td>";
                        echo "<td>" . htmlspecialchars($servicio['TipoServicio']) . "</td>";
                        echo "<td>" . htmlspecialchars($servicio['EstadoServicio']) . "</td>";
                        echo "<td>" . htmlspecialchars($servicio['CostoEstimado']) . "</td>";
                        echo "<td>" . htmlspecialchars($servicio['FechaInicio']) . "</td>";
                        echo "<td>" . htmlspecialchars($servicio['FechaFinal']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay servicios por mostrar.</p>
        <?php endif; ?>
    </div>

    <body class="dashboard-page">
    <div class="container-dashboard">
        <?php if ($clientes): ?>
            <table class="users-table">
            <h3 class="page-title">Lista de clientes</h3>
                <thead>
                    <tr>
                        <th>ID Cliente</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Fecha de Registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($clientes as $cliente) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($cliente['IDUsuario']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['Nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['Correo']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['Telefono']) . "</td>";
                        echo "<td>" . htmlspecialchars($cliente['FechaRegistro']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay clientes para mostrar.</p>
        <?php endif; ?>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
