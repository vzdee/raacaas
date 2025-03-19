<?php
require "layout/partials/dasheader.php";
require "layout/auths/session.php";
require "layout/config/db.php";
require "layout/cons/consultas.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
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
                            echo "<td>" . htmlspecialchars($empleado['IDEmpleado']) . "</td>";
                            echo "<td>" . htmlspecialchars($empleado['Nombre']) . "</td>";
                            echo "<td>" . htmlspecialchars($empleado['Correo']) . "</td>";
                            echo "<td>" . htmlspecialchars($empleado['NumeroTel']) . "</td>";
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
            <form action="layout/cons/insertar.php" method="POST" class="alta-form">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
                <label for="correo">Correo:</label>
                <input type="email" name="correo" id="correo" required>
                <label for="telefono">Telefono:</label>
                <input type="tel" name="telefono" id="telefono" required>
                <label for="rfc">RFC:</label>
                <input type="text" name="rfc" id="rfc" required>
                <input type="submit" value="Registrar Empleado" class="btn-alta">
            </form>
        </div>
    </div>
</body>