<?php
session_start();
include 'includes/conexion.php'; // Incluir el archivo de conexión

// El usuario ha iniciado sesión, puedes acceder a los datos de sesión
$usuario = $_SESSION['usuario'];
$dni = $_SESSION['dni'];
$tipoUsuario = $_SESSION['tipoUsuario'];
$empresaUser = $_SESSION['empresaUser'];



?>

<!doctype html>
<html lang="es">

<head>

    <meta charset="utf-8" />
    <title>Geo <?php echo "<3"; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    
    
    <link href="assets/libs/datatables.net-autofill-bs4/css/autoFill.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/libs/datatables.net-keytable-bs4/css/keyTable.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    

</head>

<body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <?php
        include './parts/nav.php';
        include './parts/menuVertical.php'
        ?>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Data Tables</h4>
                                <div class="page-title-center">
                                    <?php if ($tipoUsuario == 2) : ?>
                                        <button type="button" class="btn btn-primary waves-effect waves-light" style="height: 35px !important;" onclick="window.location.href = 'automatizacion/asignacionMasiva.php';">
                                            Asignar Masivamente <i class="mdi mdi-emoticon-excited-outline font-size-16 align-middle ms-2"></i>
                                        </button>
                                    <?php endif; ?>

                                </div>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                        <li class="breadcrumb-item active">Data Tables</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <!-- Modal -->

                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Datatable Editable</h4>

                                <?php
                                // Tu conexión a la base de datos
                                include 'includes/conexion.php'; // Asegúrate de incluir la conexión adecuada

                                // Consulta SQL para obtener los datos de la tabla horario_vendedor
                                $query = "SELECT hv.*, u.userName AS nombre_usuario
                                FROM horario_vendedor AS hv
                                INNER JOIN user AS u ON hv.id_user = u.id_user
                                WHERE hv.numero_dias = DAYOFWEEK(CURDATE())
                                ORDER BY hv.sede;
                                ";

                                $result = mysqli_query($con, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    // Imprimir la tabla con los resultados
                                    echo '<div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>ID de Usuario</th>
                                                        <th>Días</th>
                                                        <th>Hora de Entrada</th>
                                                        <th>Hora de Salida</th>
                                                        <th>Sede</th>
                                                        <th>Estado</th>
                                                        <th>Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo '<tr>';
                                                    echo '<td>' . $row['id'] . '</td>';
                                                    echo '<td>' . $row['nombre_usuario'] . '</td>';
                                                    echo '<td>' . $row['dias'] . '</td>';
                                                    echo '<td>' . $row['hora_entrada'] . '</td>';
                                                    echo '<td>' . $row['hora_salida'] . '</td>';
                                                    echo '<td>';
                                                    $sede = $row['sede'];
                                                    if ($sede == 1) {
                                                        echo 'Surco';
                                                    } elseif ($sede == 2) {
                                                        echo 'Mega Plaza';
                                                    } elseif ($sede == 3) {
                                                        echo 'Los Olivos';
                                                    } elseif ($sede == 4) {
                                                        echo 'Independencia';
                                                    } else {
                                                        echo 'Sede no Registrada';
                                                    }
                                                    echo '</td>';

                                                    echo '<td>' . ($row['estado'] == 1 ? 'Trabajando' : 'Fuera de Horario') . '</td>';
                                                    echo '<td>';
                                                    echo '<input type="checkbox" id="switch' . $row['id'] . '" switch="none"';
                                                    if ($row['estado'] == 1) {
                                                        echo ' checked ';
                                                    }
                                                    echo '/>';
                                                    echo '</td>';
                                                    echo '<td>';
                                                    echo '<input type="checkbox" id="actionSwitch' . $row['id'] . '" switch="none"';
                                                    if ($row['trabajaHoy'] == 1) {
                                                        echo ' checked ';
                                                    }
                                                    echo '/>';
                                                    echo '<label for="actionSwitch' . $row['id'] . '" data-on-label="On" data-off-label="Off" onclick="confirmChange(' . $row['id'] . ')"></label>';
                                                    echo '</td>';
                                                    echo '</tr>';
                                                }
                                                
                                                

                                    echo '</tbody>
                                        </table>
                                    </div>';
                                } else {
                                    echo "No se encontraron registros.";
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($con);
                                ?>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                <script>
                                function confirmChange(id) {
                                    if (confirm('¿Desea cambiar el estado?')) {
                                        // El usuario ha confirmado el cambio de estado
                                        // Realizar una solicitud AJAX para actualizar la base de datos
                                        $.ajax({
                                            type: "POST",
                                            url: "includes/actualizarHorario.php", // Reemplaza con la URL correcta
                                            data: { id: id },
                                            success: function(response) {
                                                if (response === "success") {
                                                    alert('Estado actualizado correctamente.');
                                                } else {
                                                    alert('Actualizado Correctamente');
                                                }
                                            }
                                        });
                                    } else {
                                        // El usuario ha cancelado la acción
                                        // Restablecer el interruptor a su estado original
                                        document.getElementById("switch" + id).checked = !document.getElementById("switch" + id).checked;
                                    }
                                }
                                </script>


                               

                            </div>
                            <!-- end cardbody -->
                            <?php 
                            include 'includes/conexion.php'; // Asegúrate de incluir la conexión adecuada

                            // Obtener el día de la semana actual (1 para domingo, 2 para lunes, etc.)
                            $dayOfWeek = date('N');
                            
                            // Consulta SQL para obtener los IDs de usuarios con estado = 1 para el día actual
                            $query = "SELECT id_user FROM horario_vendedor WHERE numero_dias = date('N') AND estado = 1";
                            
                            $result = mysqli_query($con, $query);
                            
                            if (mysqli_num_rows($result) > 0) {
                                echo '<h2>IDs de Usuarios con Estado = 1 para el Día Actual:</h2>';
                                echo '<ul>';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<li>' . $row['id_user'] . '</li>';
                                }
                                echo '</ul>';
                            } else {
                                echo "No se encontraron registros para el día actual con estado = 1.";
                            }
                            
                            // Cierra la conexión a la base de datos
                            mysqli_close($con);
                            ?>
                           

                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            <?php include './parts/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?php include './parts/sidebar.php'; ?>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>
    <!-- Table Editable plugin -->
    <script src="assets/libs/table-edits/build/table-edits.min.js"></script>

    <script src="assets/js/pages/table-editable.init.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>