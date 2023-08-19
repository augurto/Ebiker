<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén la conexión a la base de datos
    include('conexion.php'); 
    // Obtén los valores enviados desde el formulario
    $idFormWeb = $_POST['idFormWeb'];
    $selectUsuario = $_POST['selectUsuario'];

    // Construye la consulta SQL para actualizar el valor de randomUser
    $queryUpdate = "UPDATE web_formularios SET randomUser = '$selectUsuario' WHERE id_form_web = '$idFormWeb'";

    // Ejecuta la consulta
    if (mysqli_query($con, $queryUpdate)) {
        mysqli_close($con);
        // Redirige a la página administrador.php
        exit(); // Termina el script para evitar ejecución adicional
    } else {
        echo "Error al actualizar: " . mysqli_error($con);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($con);
}
?>
