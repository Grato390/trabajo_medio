<?php
// Manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir la capa de datos

// // Incluir el archivo negocio_parte_de_modicacio.php
// require_once 'negocio_parte_de_modicacio.php';

// // creando listas de la nuestro base de datos


$agendaDeCitas = array(
    array("Consulta con el Dr. Pérez", "2024-02-10"),
    array("Examen médico", "2024-02-15"),
    array("Control de presión arterial", "2024-02-20"),
    array("Chequeo general", "2024-02-25"),
    array("Consulta con el Dr. Rodríguez", "2024-03-05"),
    array("Terapia física", "2024-03-10"),
    array("Consulta con el Dr. Gómez", "2024-03-15"),
    array("Control de glucosa", "2024-03-20"),
    array("Vacunación", "2024-03-25"),
    array("Seguimiento de tratamiento", "2024-04-01"),
    array("Seguimiento de tratamiento 2", "2024-04-11")
);
// //Llamar a la función miFuncion desde negocio_parte_de_modicacio.php
//miFuncion($agendaDeCitas);

// Validar si se recibe una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $usuario1 = "a";
    $contrasenia1 = "123";
    $usuario = $_POST["usuario"];
    $contrasenia = $_POST["contrasenia"];
    
    // Lógica de negocios para el gestor de contraseñas
    $resultado = pasando_datos_y_validar($usuario, $contrasenia, $usuario1, $contrasenia1);

    if ($resultado === true) {
        // Redirigir a la página de contraseñas
        header("Location: agregar_eleminar_actualizar.php");
        exit;
    } else {
        echo "Error: $resultado"; // Mostrar el error
    }
}
?>
