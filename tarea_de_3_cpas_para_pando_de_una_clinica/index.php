<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Contraseñas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Registro de actividad </h1>
        <form action="negocio.php" method="post">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" required>
            <br>
            <label for="contrasenia">Contraseña:</label>
            <input type="password" name="contrasenia" required>
            <br>
            <button  type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>
