<?php
include 'conexion.php';

$idFormWeb = $_GET['inputIdFormWeb'];
$selectUsuario = $_GET['selectUsuario'];
$query = "UPDATE web_formularios SET randomUser = '$selectUsuario' WHERE id_form_web = '$idFormWeb'";

if (mysqli_query($con, $query)) {
    // La inserción fue exitosa, redirecciona a editarcliente.php con el parámetro id
    $id = mysqli_insert_id($con);
    echo "Error en la inserción de datos: ".$idFormWeb.$selectUsuario;
    exit();
} else {
    // Manejar el caso de error en la inserción
    echo "Error en la inserción de datos: " . mysqli_error($con);
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
