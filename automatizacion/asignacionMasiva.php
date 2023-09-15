<?php
include '../includes/conexion.php'; // Incluye tu archivo de conexión

// Obtener el día de la semana actual (1 para domingo, 2 para lunes, etc.)
$dayOfWeek = date('N');

// Obtener la hora actual en formato HH:MM:SS
$currentTime = date('H:i:s');

// Consulta SQL para seleccionar los IDs de usuarios y sus horarios
$query = "SELECT id_user, hora_entrada, hora_salida
FROM horario_vendedor
WHERE WEEKDAY(CURDATE()) + 1 = numero_dias";

$result = mysqli_query($con, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Obtener los datos del usuario y su horario
        $id_user = $row['id_user'];
        $hora_entrada = $row['hora_entrada'];
        $hora_salida = $row['hora_salida'];

        // Verificar si la hora actual está dentro del rango de horas de trabajo
        if ($currentTime >= $hora_entrada && $currentTime <= $hora_salida) {
            // Si está dentro del horario, establecer el estado en 1
            $updateQuery = "UPDATE horario_vendedor SET estado = 1 WHERE id_user = $id_user";
        } else {
            // Si está fuera del horario, establecer el estado en 0
            $updateQuery = "UPDATE horario_vendedor SET estado = 0 WHERE id_user = $id_user";
        }

        if (mysqli_query($con, $updateQuery)) {
            echo "El estado del usuario $id_user se ha actualizado correctamente.<br>";
        } else {
            echo "Error al actualizar el estado del usuario $id_user.<br>";
        }
    }
} else {
    echo "Error al ejecutar la consulta SQL.<br>";
}

// Cierra la conexión a la base de datos
mysqli_close($con);
?>
