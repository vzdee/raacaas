<?php 
require_once "layout/auths/session_check.php"
?>

<header class="header">
    <div class="logo">
        <a href="index.php">
            <img src="img/logo.png" alt="Logo"/>
        </a>
    </div>
    <nav>
        <ul>
            <?php if ($_SESSION["TipoUsuario"] === "Admin" || $_SESSION["TipoUsuario"] === "Empleado") : ?>
            <li><a href="dashboard.php">Dashboard</a></li>
            <?php endif; ?>
            <?php if ($_SESSION["TipoUsuario"] === "Admin") : ?>
            <li><a href="enlist.php">Alta Empleados</a></li>
            <?php endif; ?>
            <li><a href="services.php">Consultar Servicios</a></li>
            <li><a href="profile.php">Perfil</a></li>
            <li><a href="layout/auths/logout_auth.php">Cerrar Sesion</a></li>
        </ul>
    </nav>
</header>
