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
                                        <button type="button" class="btn btn-primary waves-effect waves-light" style="height: 35px !important;" onclick="window.location.href = 'nuevoCliente.php';">
                                            Nuevo Cliente <i class="mdi mdi-emoticon-excited-outline font-size-16 align-middle ms-2"></i>
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


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Data Clientes</h4>
                                    <?php


                                    $query3 = "SELECT u.userName,u.sede, wf.randomUser, COUNT(*) AS cantidad
                                        FROM web_formularios wf
                                        INNER JOIN user u ON u.id_user = wf.randomUser
                                        WHERE wf.estado_web = 0
                                        GROUP BY wf.randomUser
                                        ORDER BY u.sede ASC";

                                    $result3 = mysqli_query($con, $query3);
                                    ?>


                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Vendedor</th>
                                                <th>Cantidad no Atendidos</th>
                                                <th>Sede</th>
                                                <th>Acción</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                        <tr>
                                            <td><?php echo $row3['userName']; ?></td>
                                            <td><?php echo $row3['cantidad']; ?></td>
                                            <td>
                                                <?php 
                                                if($row3['sede']==0){
                                                    echo 'Independencia'; 
                                                } elseif($row3['sede']==1){
                                                    echo 'Mega Plaza';
                                                } elseif($row3['sede']==2){
                                                    echo 'Los Olivos';
                                                } elseif($row3['sede']==3){
                                                    echo 'Surco';
                                                } else {
                                                    echo 'Trujillo';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                
                                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                                data-bs-toggle="modal" data-bs-target="#myModal<?php echo $row3['randomUser']; ?>">Reasignar</button>
                                            </td>
                                        </tr>
                                        <!-- sample modal content -->
                                        <div id="myModal<?php echo $row3['randomUser']; ?>" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myModalLabel">Modal Heading
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <input type="text" class="form-control" value="<?php echo $row3['randomUser']; ?>" readonly>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button"
                                                            class="btn btn-primary waves-effect waves-light">Save
                                                            changes</button>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                        
                                    <?php } ?>

                                        </tbody>
                                    </table>
                                    


                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="includes/asignarUsuario.php" method="get">
                                        <div class="mb-3">
                                            <label for="selectUsuario" class="form-label">Asignar a Usuario</label>
                                            <select class="form-select" id="selectUsuario" name="selectUsuario">
                                                <?php
                                                $queryUsuarios = "SELECT id_user, userName FROM user where tipo_user =1 and estadoUsuario= 0";
                                                $resultUsuarios = mysqli_query($con, $queryUsuarios);

                                                while ($rowUsuario = mysqli_fetch_assoc($resultUsuarios)) {
                                                    echo '<option value="' . $rowUsuario['id_user'] . '">' . $rowUsuario['userName'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="idFormWeb" name="idFormWeb" value="<?php echo $_GET['id']; ?>" readonly>
                                        </div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Actualizar</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL -->
                    <!-- Modal -->

                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myModalLabel">Detalles del Formulario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>El valor del ID es: <span id="idValueSpan"></span></p>

                                    <div class="mb-3">

                                        <form>
                                            <input type="text" class="form-control" id="inputIdFormWeb" name="idFormWeb">
                                            <input type="text" class="form-control" id="inputIdFormWeb" name="iddd">
                                            <label for="inputIdFormWeb2" class="form-label">ID del Usuario actual</label>
                                            <input type="text" class="form-control" id="myInput" readonly>

                                    </div>

                                    <div class="mb-3">
                                        <label for="selectUsuario" class="form-label">Asignar a Usuario</label>
                                        <select class="form-select" id="selectUsuario" name="selectUsuario">
                                            <?php
                                            $queryUsuarios = "SELECT id_user, userName FROM user where tipo_user =1";
                                            $resultUsuarios = mysqli_query($con, $queryUsuarios);

                                            while ($rowUsuario = mysqli_fetch_assoc($resultUsuarios)) {
                                                echo '<option value="' . $rowUsuario['id_user'] . '">' . $rowUsuario['userName'] . $rowUsuario['id_user'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar cambios</button>

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <script>
                        $(document).ready(function() {
                            $('.btn-primary').click(function() {
                                var idValue = $(this).data('id');
                                var randomValue = $(this).data('random');
                                $('#idValueSpan').text(idValue); // Actualiza el valor del span
                                $('#inputIdFormWeb').val(idValue); // Rellena el input con el valor del ID
                                $('#myInput').val(randomValue); // Rellena el otro input con el valor de $idUsuarioRandom
                            });
                        });

                        $(document).ready(function() {
                            $('.btn-primary').click(function() {
                                var idValue = $(this).data('id');
                                var randomValue = $(this).data('random');
                                $('#idValueSpan').text(idValue);
                                $('#inputIdFormWeb').val(idValue);
                                $('#inputIdFormWeb2').val(idValue);
                                $('#myInput').val(randomValue);

                                // Enviar los datos del formulario al servidor usando AJAX con método GET
                                $.ajax({
                                    type: "GET",
                                    url: "includes/asignarUsuario.php", // Ruta del archivo PHP que procesa el formulario
                                    data: $('#myModal form').serialize(), // Envía los datos del formulario al servidor
                                    success: function(response) {
                                        // Manejar la respuesta del servidor si es necesario
                                        console.log(response);
                                    }
                                });
                            });
                        });
                    </script>

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

    <script src="assets/js/app.js"></script>

</body>

</html>