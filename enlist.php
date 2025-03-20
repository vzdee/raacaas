<?php
require "layout/partials/dasheader.php";
require_once "layout/auths/session_check.php";
verificarAcceso(["Admin"]);
require "layout/config/database.php";
require "layout/cons/dash_cons.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Alta Empleados</title>
</head>

<body class="alta-page">
    <div class="container-alta">
        <div class="container-empleados">
            <?php if ($empleados): ?>
                <table class="empleados-table">
                <h3 class="empleados-title">Lista de Empleados</h3>
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
                            echo "<td>" . htmlspecialchars($empleado['Apellido']) . "</td>";
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

        <div class="register-alta">
            <h3 class="alta-title">Alta de Empleados</h3>
            <form action="layout/cons/enlist_employees.php" method="POST" class="alta-form">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido" id="apellido" required>
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" required>
                <label for="telefono">Telefono:</label>
                <input type="tel" name="telefono" id="telefono" required>
                <label for="rfc">RFC:</label>
                <input type="text" name="rfc" id="rfc" required>
                <label for="nss">NSS:</label>
                <input type="text" name="nss" id="nss">
                <input type="submit" value="Registrar Empleado" class="btn-alta">
            </form>
        </div>
    </div>
</body>