<?php
require "layout/partials/dasheader.php";
require "layout/config/db.php";
require_once "layout/auths/session.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Perfil de Usuario</title>
</head>
<body class="profile-page">
    <div class="profile-container">
    <h3 class="section-title">Información Personal</h3>
        <div class="profile-box">
            <img src="img/avatar.png" alt="Foto de perfil" class="profile-avatar">
            <h2 class="profile-name"><?= htmlspecialchars($usuario['Nombre']) ?></h2>
            <p class="profile-role">Rol: <?= htmlspecialchars($usuario['Rol']) ?></p>
        </div>

        <div class="profile-content">
            <form action="layout/auths/update.php" method="post">
                <div class="form-group">
                    <label class="label-input">Nombre:</label>
                    <input type="text" name="nombre" class="input-field" value="<?= htmlspecialchars($usuario['Nombre']) ?>" required>
                </div>

                <div class="form-group">
                    <label class="label-input">Correo:</label>
                    <input type="email" name="correo" class="input-field" value="<?= htmlspecialchars($usuario['Correo']) ?>" required>
                </div>

                <div class="form-group">
                    <label class="label-input">Número Telefónico:</label>
                    <input type="tel" name="telefono" class="input-field" value="<?= htmlspecialchars($usuario['NumeroTel']) ?>" required>
                </div>

                <?php if ($usuario['Rol'] === 'Empleado' || $usuario['Rol'] === 'Administrador'): ?>
                    <div class="form-group">
                        <label class="label-input">NSS:</label>
                        <input type="text" name="nss" class="input-field" value="<?= htmlspecialchars($usuario['NSS']) ?>">
                    </div>

                    <div class="form-group">
                        <label class="label-input">RFC:</label>
                        <input type="text" name="rfc" class="input-field" value="<?= htmlspecialchars($usuario['RFC']) ?>">
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn-update">Actualizar</button>
            </form>
        </div>
    </div>
</body>
</html>
