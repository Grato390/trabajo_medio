<?php
// Verifica si la sesión está activa antes de intentar iniciarla nuevamente
include 'datos.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["accion"])) {
        $accion = $_POST["accion"];

        switch ($accion) {
            case "borrar":
                $posicionSeleccionada = isset($_POST["seleccionarPosicion"]) ? intval($_POST["seleccionarPosicion"]) : 0;
                if ($posicionSeleccionada > 0 && $posicionSeleccionada <= count($_SESSION['agendaDeCitas'])) {
                    unset($_SESSION['agendaDeCitas'][$posicionSeleccionada - 1]);
                    $_SESSION['agendaDeCitas'] = array_values($_SESSION['agendaDeCitas']);
                }
                break;

            case "modificar":
                $posicionModificar = isset($_POST["seleccionarPosicion"]) ? intval($_POST["seleccionarPosicion"]) : 0;

                if ($posicionModificar > 0 && $posicionModificar <= count($_SESSION['agendaDeCitas'])) {
                    $_SESSION['posicionModificar'] = $posicionModificar;
                }

            case "agregar":
                // Obtener los nuevos datos del formulario
                $nuevoNombre = isset($_POST["nombreCita"]) ? $_POST["nombreCita"] : "";
                $nuevaFecha = isset($_POST["nuevaFecha"]) ? $_POST["nuevaFecha"] : "";

                // Agregar la nueva cita al final de la lista
                $_SESSION['agendaDeCitas'][] = array($nuevoNombre, $nuevaFecha);

                break;

            case "confirmar_modificacion":
                // Obtener los nuevos datos del formulario
                $nuevoNombre = isset($_POST["nuevoNombre"]) ? $_POST["nuevoNombre"] : "";
                $nuevaFecha = isset($_POST["nuevaFecha"]) ? $_POST["nuevaFecha"] : "";

                // Validar y aplicar la modificación
                if ($_SESSION['posicionModificar'] > 0 && $_SESSION['posicionModificar'] <= count($_SESSION['agendaDeCitas'])) {
                    $indiceModificar = $_SESSION['posicionModificar'] - 1;
                    $_SESSION['agendaDeCitas'][$indiceModificar][0] = $nuevoNombre;
                    $_SESSION['agendaDeCitas'][$indiceModificar][1] = $nuevaFecha;
                    // Limpiar la variable de posición modificar después de la modificación
                    unset($_SESSION['posicionModificar']);
                }
                break;
        }

        // Redirigir después de realizar la acción
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }
}
?>




