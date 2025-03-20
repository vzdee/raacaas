<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Denegado</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #1a1a1a;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .container {
            padding: 20px;
            border: 2px solid red;
            border-radius: 10px;
            background-color: rgba(255, 0, 0, 0.1);
        }
        h1 {
            font-size: 3rem;
            color: red;
        }
        p {
            font-size: 1.2rem;
        }
        a {
            color: white;
            text-decoration: underline;
        }
    </style>
    <script>
        setTimeout(function() {
            window.location.href = '../../services.php';
        }, 5000);
    </script>
</head>
<body>
    <div class="container">
        <h1>Acceso Denegado</h1>
        <p>No tienes permiso para acceder a esta página.</p>
        <p>Serás redirigido en <span id="countdown">5</span> segundos...</p>
        <p><a href="../../services.php">Ir a la página anterior</a></p>
    </div>
    <script>
        let countdown = 5;
        setInterval(function() {
            countdown--;
            document.getElementById('countdown').textContent = countdown;
        }, 1000);
    </script>
</body>
</html>
