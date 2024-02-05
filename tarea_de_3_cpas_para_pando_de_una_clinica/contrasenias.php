<?php
// Obtener las citas de la URL
require_once 'datos.php';

// Crear una función para mostrar la lista de citas
function mostrarListaCitas($citas) {
    echo "<h2>Listado de Citas</h2>";
    echo "<ul>";
    foreach ($citas as $indice => $cita) {
        echo "<li> Cita: " . ($indice + 1) . ",==> " . $cita[0] . ",  fecha " . ($indice + 1) . ", ==>  " . $cita[1] . "</li>";
    }
    echo "</ul>";
}

// Llamar a la función para mostrar la lista de citas
mostrarListaCitas($agendaDeCitas);
?>
