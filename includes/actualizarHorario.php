<?php
// Tu conexión a la base de datos
include 'conexion.php'; // Asegúrate de incluir la conexión adecuada

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Verificar el estado actual del registro
    $query = "SELECT trabajaHoy FROM horario_vendedor WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($estadoActual);
    $stmt->fetch();
    $stmt->close();

    // Cambiar el estado (1 si estaba en 0, 0 si estaba en 1)
    $nuevoEstado = ($estadoActual == 1) ? 0 : 1;

    // Actualizar el estado en la base de datos
    $query = "UPDATE horario_vendedor SET trabajaHoy = ? WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ii", $nuevoEstado, $id);

    try {
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Se actualizo el estado.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $stmt->close();
    $con->close();
} else {
    // Si los datos no son válidos
    echo "Error: Datos no válidos.";
}
?>
