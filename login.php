<?php
require 'layout/config/database.php'; // Asegúrate de incluir tu archivo de conexión a la base de datos
require "layout/partials/header.php";  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Iniciar Sesion</title>
</head>
    <main class="login-page">
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Regístrarse</button>
                </div>
            </div>

            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register">
                <!--Login-->
            <form action="layout/auths/login_auth.php" method="POST" class="formulario__login">
                <h2>Iniciar Sesión</h2>
                <input type="correo" name="correo" placeholder="correo" required>
                <input type="password" name="password" placeholder="contrasena" required>
                <button type="submit">Entrar</button>
            </form>


                <!--Register-->
            <form action="layout/auths/register_auth.php" method="POST" class="formulario__register">
                <h2>Regístrarse</h2>
                <input type="text" name="nombre" placeholder="nombre" required>
                <span class="error" id="errorNombre"></span>

                <input type="text" name="apellido" placeholder="apellido" required>
                <span class="error" id="errorApellido"></span>

                <input type="email" name="correo" placeholder="correo" required>
                <span class="error" id="errorCorreo"></span>

                <input type="password" name="contrasena" placeholder="contrasena" required>
                <span class="error" id="errorContrasena"></span>

                <input type="text" name="telefono" placeholder="telefono" required>
                <span class="error" id="errorTelefono"></span>

                <button type="submit">Registrar</button>
            </form>
            </div>
        </div>
    </main>
    <script src="js/script.js"></script>
</html>
