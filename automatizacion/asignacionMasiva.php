<?php
include '../includes/conexion.php'; // Incluye tu archivo de conexión

// Obtener el día de la semana actual (1 para domingo, 2 para lunes, etc.)
$dayOfWeek = date('N');

// Obtener la hora actual en formato HH:MM:SS
$currentTime = date('H:i:s');

// Consulta SQL para seleccionar los IDs de usuarios que cumplen las condiciones
$query = "SELECT id_user
          FROM horario_vendedor
          WHERE numero_dias = $dayOfWeek
          AND '$currentTime' BETWEEN hora_entrada AND hora_salida";

$result = mysqli_query($con, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Obtener el ID del usuario
        $id_user = $row['id_user'];

        // Ejecutar una consulta de actualización para establecer el estado en 1
        $updateQuery = "UPDATE horario_vendedor SET estado = 1 WHERE id_user = $id_user";

        if (mysqli_query($con, $updateQuery)) {
            echo "El estado del usuario $id_user se ha actualizado a 1.<br>";
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
