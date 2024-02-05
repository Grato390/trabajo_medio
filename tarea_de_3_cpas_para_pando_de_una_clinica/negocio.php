<?php
// Manejo de errores

require_once 'datos.php';


function pasando_datos_y_validar($usuario, $contrasenia, $usuario1, $contrasenia1)
{
 
        // Ejemplo básico de validación (usuario debe ser "a" y contraseña "123")
        if ($usuario === $usuario1 && $contrasenia === $contrasenia1) {
            return true; // Usuario y contraseña válidos
        } else {
            if ($usuario !== $usuario1 && $contrasenia !== $contrasenia1) {
                return "Error: usuario y contrasenia son incorrectos";
            }

            if ($usuario === $usuario1 && $contrasenia !== $contrasenia1 ){
                return "Error: contrasenia incorrectos.";
            } else {
                return "Error: contraseña incorrecto.";
            }
        
    }
}



function obtenerContrasenias()
{
    // Lógica para obtener contraseñas
    // Aquí deberías recuperar las contraseñas desde una fuente de datos
    // (por ejemplo, una base de datos o un archivo)
    return array(
        "Sitio 1" => "password1",
        "Sitio 2" => "password2",
        // Agrega más contraseñas según sea necesario
    );
}
?>

