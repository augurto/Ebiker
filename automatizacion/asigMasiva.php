<?php
include '../includes/conexion.php'; // Asegúrate de incluir la conexión adecuada
// Los valores a asignar consecutivamente
$valoresConsecutivos = [4, 6, 107, 108];
$contador = 0;

// Realiza la consulta para obtener los registros
$query = "SELECT id_form_web
          FROM web_formularios
          WHERE estado_web != 99
            AND estado_web = 0
            AND prospecto != 4
            AND idEmpresa = 1
            AND randomUser IS NULL
            AND DATE(fecha) >= '2023-07-25'
          ORDER BY fecha DESC";

$result = mysqli_query($con, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Obtiene el próximo valor consecutivo
        $valorConsecutivo = $valoresConsecutivos[$contador];
        
        // Actualiza la columna randomUser con el valor consecutivo
        $id_form_web = $row['id_form_web'];
        $updateQuery = "UPDATE web_formularios
                        SET randomUser = $valorConsecutivo
                        WHERE id_form_web = $id_form_web";

        mysqli_query($con, $updateQuery);
        
        // Incrementa el contador y vuelve a 0 si llega al final del arreglo
        $contador++;
        if ($contador >= count($valoresConsecutivos)) {
            $contador = 0;
        }
    }
} else {
    // Maneja el error si la consulta no fue exitosa
    echo "Error en la consulta SQL: " . mysqli_error($con);
}
?>
