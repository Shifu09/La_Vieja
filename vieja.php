<?php
function juegoTerminado($tablero, $jugador)
{
    // filas
    for ($i = 0; $i < 3; $i++) {
        if ($tablero[$i][0] == $jugador && $tablero[$i][1] == $jugador && $tablero[$i][2] == $jugador) {
            return true;
        }
    }

    //columnas
    for ($j = 0; $j < 3; $j++) {
        if ($tablero[0][$j] == $jugador && $tablero[1][$j] == $jugador && $tablero[2][$j] == $jugador) {
            return true;
        }
    }

    //diagonales
    if (($tablero[0][0] == $jugador && $tablero[1][1] == $jugador && $tablero[2][2] == $jugador) ||
        ($tablero[0][2] == $jugador && $tablero[1][1] == $jugador && $tablero[2][0] == $jugador)
    ) {
        return true;
    }

    return false;
}

$tablero = array(
    array('_', '_', '_'),
    array('_', '_', '_'),
    array('_', '_', '_')
);


$jugadorActual = "X";
$juegoTerminado = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fila = $_POST["fila"];
    $columna = $_POST["columna"];
    if (!isset($tablero[$fila][$columna])) {
        echo "Esa posición no existe.";
    } else {
        if ($tablero[$fila][$columna] == '_') {
            $tablero[$fila][$columna] = $jugadorActual;
            $juegoTerminado = juegoTerminado($tablero, $jugadorActual);
            if (!$juegoTerminado) {
                $jugadorActual = ($jugadorActual == "X") ? "O" : "X";
            }
        } else {
            echo "Esa posición ya está ocupada.";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>La Vieja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-900 opacity-75">
    <h1 class="font-sans text-6xl text-center uppercase">La vieja que medio sirve en PHP </h1>
    <br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table class=" items-center justify-center flex">
            <?php for ($i = 0; $i < 3; $i++) { ?>
                <tr>
                    <?php for ($j = 0; $j < 3; $j++) { ?>
                        <td>
                            <div>
                                <div><input type="text" name="fila" value="<?php echo $i; ?>" hidden></div>
                                <div><input type="button" name="fila" value="<?php echo $i; ?>" class="bg-yellow-400 font-bold py-2 px-5 text-base border-4 border-black rounded-lg shadow-md hover:translate-x-[-0.05em] hover:translate-y-[-0.05em] hover:shadow-lg active:translate-x-[0.05em] active:translate-y-[0.05em] active:shadow-sm"></div>
                                <div><input type="text" name="columna" value="<?php echo $j; ?>" hidden></div>
                                <div><input type="button" name="columna" value="<?php echo $j; ?>" class="bg-yellow-400 font-bold py-2 px-5 text-base border-4 border-black rounded-lg shadow-md hover:translate-x-[-0.05em] hover:translate-y-[-0.05em] hover:shadow-lg active:translate-x-[0.05em] active:translate-y-[0.05em] active:shadow-sm"></div>
                                <div><input type="button" class="bg-red-700 font-bold py-2 px-5 text-base border-4 border-black rounded-lg shadow-md hover:translate-x-[-0.05em] hover:translate-y-[-0.05em] hover:shadow-lg active:translate-x-[0.05em] active:translate-y-[0.05em] active:shadow-sm"" name=" tablero[<?php echo $i; ?>][<?php echo $j; ?>]" value="<?php echo $tablero[$i][$j]; ?>" disabled></div>
                            </div>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>

        <?php if (!$juegoTerminado) { ?>

            <p class="text-lg text-center font-bold">Turno del jugador <?php echo $jugadorActual; ?></p>
            <div class=" items-center justify-center flex">
                <p class="text-lg font-bold">Ingrese la fila (0-2): <input type="number" name="fila" min="0" max="2" class="rounded-lg border-2 border-yellow-500 focus:outline-yellow-200 outline-none font-sans focus:bg-white outline-offset-1 transition duration-250 ease-in-out px-4 py-2" </p>
                <p class="text-lg font-bold">Ingrese la columna (0-2): <input type="number" name="columna" min="0" max="2" class="rounded-lg border-2 border-yellow-500 focus:outline-yellow-200 outline-none font-sans focus:bg-white outline-offset-1 transition duration-250 ease-in-out px-4 py-2" </p>
                    <button type="submit" class="bg-yellow-400 font-bold py-2 px-5 text-base border-4 border-black rounded-lg shadow-md hover:translate-x-[-0.05em] hover:translate-y-[-0.05em] hover:shadow-lg active:translate-x-[0.05em] active:translate-y-[0.05em] active:shadow-sm">Jugar</button>
            </div>
        <?php } else { ?>
            <p class="text-lg text-center font-bold">¡El jugador <?php echo $jugadorActual; ?> ha ganado el juego!</p>
        <?php } ?>
    </form>
</body>

</html>