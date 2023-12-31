<?php
session_start();
include 'includes/conexion.php'; // Incluir el archivo de conexión

if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redireccionar a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: login.php");
    exit();
}

// El usuario ha iniciado sesión, puedes acceder a los datos de sesión
$usuario = $_SESSION['usuario'];
$dni = $_SESSION['dni'];
$tipoUsuario = $_SESSION['tipoUsuario'];
$empresaUser = $_SESSION['empresaUser'];

if ($tipoUsuario == 1) {
    // Redireccionar al vendedor.php si la empresa es 1
    header("Location: vendedor.php");
    exit();
}
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
    <!-- Plugins css -->
    <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
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
                <?php
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=74451492',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer apis-token-6245.wt-VO39h1kYcilm8CMcL-WdJ6p7C-J-s'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);

                $data = json_decode($response, true);

                $nombre = $data['nombres'];
                $apellido_paterno = $data['apellidoPaterno'];
                $apellido_materno = $data['apellidoMaterno'];

                echo "Nombre: $nombre\n";
                echo "Apellido Paterno: $apellido_paterno\n";
                echo "Apellido Materno: $apellido_materno\n";
                ?>

                <div class="container-fluid">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Evaluacion Crediticia Pendiente</h4>
                                <form class="needs-validation" novalidate>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Nombres</label>
                                                <input type="text" class="form-control" id="validationCustom04" name="nombres" placeholder="Nombres" readonly>

                                                <div class="invalid-feedback">
                                                    Please select a valid state.
                                                </div>

                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom04" class="form-label">Apellido Paterno</label>
                                                <input type="text" class="form-control" id="validationCustom04" name="apellidoPaterno" placeholder="Apellido Paterno" readonly>
                                                <div class="invalid-feedback">
                                                    Please provide a valid city.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom05" class="form-label">Apellido Materno</label>
                                                <input type="text" class="form-control" id="validationCustom05" name="apellidoMaterno" placeholder="Apellido Materno" readonly>
                                                <div class="invalid-feedback">
                                                    Please provide a valid zip.
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label">Estado Civil</label>
                                                <select class="form-select" id="validationCustom03" name="estadoCivil" required>
                                                    <option selected disabled value="">Seleccionar</option>
                                                    <option value="1">Soltero</option>
                                                    <option value="2">Casado</option>
                                                    <option value="3">Viudo</option>
                                                    <option value="4">Divorciado</option>
                                                    <option value="5">Otro</option>
                                                </select>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom02" class="form-label">Edad</label>
                                                <input type="number" class="form-control" id="validationCustom02" name="edad" placeholder="Edad" value="Otto" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom02" class="form-label">Celular</label>
                                                <input type="number" class="form-control" id="validationCustom02" placeholder="Celular" name="celular" value="Otto" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>

                                    <!-- end row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label">Modelo</label>
                                                <select class="form-select" id="validationCustom03" name="modelo" required>
                                                    <option selected disabled value="">Seleccionar</option>
                                                    <option value="1">Modelo1</option>
                                                    <option value="2">Modelo2</option>
                                                    <option value="3">Modelo3</option>
                                                    <option value="4">Modelo4</option>
                                                    <option value="5">Otro</option>
                                                </select>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom02" class="form-label">Precio</label>
                                                <input type="number" class="form-control" id="validationCustom02" placeholder="Precio" value="Otto" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->

                                    </div>
                                    <!-- end row -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label">Tipo de ingresos</label>
                                                <select class="form-select" id="validationCustom03" name="tipoIngreso" required>
                                                    <option selected disabled value="">Seleccionar</option>
                                                    <option value="Dependiente">Dependiente</option>
                                                    <option value="Independiente">Independiente</option>
                                                    <option value="Otro">Otro</option>
                                                </select>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom02" class="form-label">Ingreso Promedio</label>
                                                <input type="number" class="form-control" id="validationCustom02" placeholder="ingresoPromedio" value="Otto" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="validationCustom02" class="form-label">Inicial</label>
                                                <input type="number" class="form-control" id="validationCustom02" placeholder="Inicial" value="Otto" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->

                                    </div>

                                    <!-- end row -->

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">

                                                    <h4 class="card-title">Dropzone</h4>
                                                    <p class="card-title-desc">DropzoneJS is an open source library
                                                        that provides drag’n’drop file uploads with image previews.
                                                    </p>

                                                    <div>
                                                        <form action="#" class="dropzone">
                                                            <div class="fallback">
                                                                <input name="file" type="file" multiple="multiple">
                                                            </div>
                                                            <div class="dz-message needsclick">
                                                                <div class="mb-3">
                                                                    <i class="display-4 text-muted ri-upload-cloud-2-line"></i>
                                                                </div>
                                                                <h4>Drop files here or click to upload.</h4>
                                                            </div>
                                                        </form>
                                                        <!-- end form -->
                                                    </div>

                                                    <div class="text-center mt-4">
                                                        <button type="button" class="btn btn-primary waves-effect waves-light">Send
                                                            Files</button>
                                                    </div>
                                                </div>
                                                <!-- end cardbody -->
                                            </div>
                                            <!-- end card -->
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                    <div>
                                        <button class="btn btn-primary" type="submit">Actualizar</button>
                                    </div>
                                </form>
                                <!-- end form -->
                            </div>
                            <!-- end cardbody -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- End Page-content -->


        <?php include './parts/footer.php'; ?>
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?php include './parts/sidebar.php'; ?>

    <script src="assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="assets/js/pages/form-validation.init.js"></script>

    <!-- Plugins js -->
    <script src="assets/libs/dropzone/min/dropzone.min.js"></script>


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