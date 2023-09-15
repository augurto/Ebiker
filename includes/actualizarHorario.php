<?php
include 'conexion.php'; // Incluye tu archivo de conexión

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['id_user']) && isset($_POST['dias']) && isset($_POST['hora_entrada']) && isset($_POST['hora_salida']) && isset($_POST['sede']) && isset($_POST['estado'])) {
    $id = $_POST['id'];
    $id_user = $_POST['id_user'];
    $dias = $_POST['dias'];
    $hora_entrada = $_POST['hora_entrada'];
    $hora_salida = $_POST['hora_salida'];
    $sede = $_POST['sede'];
    $estado = $_POST['estado'];

    // Evita la inyección SQL usando sentencias preparadas
    $stmt = $con->prepare("UPDATE horario_vendedor SET id_user = ?, dias = ?, hora_entrada = ?, hora_salida = ?, sede = ?, estado = ? WHERE id = ?");
    $stmt->bind_param("isssiii", $id_user, $dias, $hora_entrada, $hora_salida, $sede, $estado, $id);

    try {
        if ($stmt->execute()) {
            // Si la actualización fue exitosa
            echo "success";
        } else {
            // Si hubo un error en la actualización
            echo "Error al actualizar los datos.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    
    // Cierra la declaración y la conexión
    $stmt->close();
    $con->close();
} else {
    // Si los datos no son válidos
    echo "Error: Datos no válidos.";
}
?>
