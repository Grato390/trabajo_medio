<?php
session_start();
include 'datos.php';
include 'logic.php';

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["accion"])) {
        $accion = $_POST["accion"];

        switch ($accion) {
            case "borrar":
                // Lógica para borrar cita
                $posicionSeleccionada = isset($_POST["seleccionarPosicion"]) ? intval($_POST["seleccionarPosicion"]) : 0;
                if ($posicionSeleccionada > 0 && $posicionSeleccionada <= count($_SESSION['agendaDeCitas'])) {
                    unset($_SESSION['agendaDeCitas'][$posicionSeleccionada - 1]);
                    $_SESSION['agendaDeCitas'] = array_values($_SESSION['agendaDeCitas']);
                }
                break;

            case "modificar":
                // Lógica para modificar cita
                $posicionModificar = isset($_POST["seleccionarPosicion"]) ? intval($_POST["seleccionarPosicion"]) : 0;

                if ($posicionModificar > 0 && $posicionModificar <= count($_SESSION['agendaDeCitas'])) {
                    $_SESSION['posicionModificar'] = $posicionModificar;
                }
                break;

            case "confirmar_modificacion":
                // Lógica para confirmar la modificación
                $nuevoNombre = isset($_POST["nuevoNombre"]) ? $_POST["nuevoNombre"] : "";
                $nuevaFecha = isset($_POST["nuevaFecha"]) ? $_POST["nuevaFecha"] : "";

                if ($_SESSION['posicionModificar'] > 0 && $_SESSION['posicionModificar'] <= count($_SESSION['agendaDeCitas'])) {
                    $indiceModificar = $_SESSION['posicionModificar'] - 1;
                    $_SESSION['agendaDeCitas'][$indiceModificar][0] = $nuevoNombre;
                    $_SESSION['agendaDeCitas'][$indiceModificar][1] = $nuevaFecha;
                    unset($_SESSION['posicionModificar']);
                }
                break;

            case "agregar":
                // Lógica para agregar nueva cita
                $nombreCita = isset($_POST["nombreCita"]) ? $_POST["nombreCita"] : "";
                $nuevaFecha = isset($_POST["nuevaFecha"]) ? $_POST["nuevaFecha"] : "";

                // Agregar la nueva cita al final de la lista
                $_SESSION['agendaDeCitas'][] = [$nombreCita, $nuevaFecha];
                break;
        }

        // Redirigir después de realizar la acción
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 50%;
            padding: 20px;
        }

        #formularioAgregarCita {
            margin-bottom: 20px;
        }

        h2 {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input, select, button {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>GESTIONADOR para la tutoría</h1>

        <!-- Mostrar la lista actualizada de citas -->
        <h2>Listado de Citas</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <ul>
                <?php
                if (isset($_SESSION['agendaDeCitas']) && is_array($_SESSION['agendaDeCitas'])) {
                    foreach ($_SESSION['agendaDeCitas'] as $indice => $cita) {
                        echo "<li>Cita " . ($indice + 1) . ": $cita[0], Fecha: $cita[1]</li>";
                    }
                } else {
                    echo "<li>No hay citas disponibles</li>";
                }
                ?>
            </ul>

            <!-- Formulario para buscar, borrar, modificar o agregar cita -->
            <h2>Buscar, Borrar, Modificar o Agregar Cita</h2>

            <!-- Campo de selección para la posición -->
            <label for="seleccionarPosicion">Seleccionar cita:</label>
            <select name="seleccionarPosicion" required>
                <?php
                if (isset($_SESSION['agendaDeCitas']) && is_array($_SESSION['agendaDeCitas'])) {
                    for ($i = 1; $i <= count($_SESSION['agendaDeCitas']); $i++) {
                        echo "<option value=\"$i\">$i</option>";
                    }
                }
                ?>
            </select>
            <br>

            <!-- Campos para modificar o agregar -->
            <?php
            if (isset($_SESSION['posicionModificar'])) {
                $posicionModificar = $_SESSION['posicionModificar'];
                echo '<label for="nuevoNombre">Nuevo nombre:</label>';
                echo '<input type="text" name="nuevoNombre">';
                echo '<br>';
                echo '<label for="nuevaFecha">Nueva fecha:</label>';
                echo '<input type="text" name="nuevaFecha">';
                echo '<br>';
                // Botón para confirmar la modificación
                echo '<button type="submit" name="accion" value="confirmar_modificacion">Confirmar Modificación</button>';
            } else {
                // Campos para agregar nueva cita
                echo '<label for="nombreCita">Nuevo nombre de cita:</label>';
                echo '<input type="text" name="nombreCita">';
                echo '<br>';
                echo '<label for="nuevaFecha">Nueva fecha:</label>';
                echo '<input type="text" name="nuevaFecha">';
                echo '<br>';
                // Botón para realizar la modificación
                echo '<button type="submit" name="accion" value="modificar">Modificar</button>';
            }
            ?>

            <!-- Botones para borrar o agregar -->
            <button type="submit" name="accion" value="borrar">Borrar</button>
            <button type="submit" name="accion" value="agregar">Agregar</button>
        </form>
    </div>
</body>
</html>
