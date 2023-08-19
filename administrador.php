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
$empresaUser =$_SESSION['empresaUser'] ;



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
        <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">

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
        <style>
            .btn {
                line-height:0.3 !important;
            }
            
        </style>

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
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-body">
                                    <div>
                                        <label class="form-label">Filtrar por Fecha</label>
                                        <div class="input-daterange input-group" id="datepicker6"
                                            data-date-format="dd M, yyyy" data-date-autoclose="true"
                                            data-provide="datepicker" data-date-container='#datepicker6'>
                                            <input type="text" class="form-control" name="start"
                                                placeholder="Fecha Inicio" />
                                            <input type="text" class="form-control" name="end" placeholder="Fecha fin" />
                                          
                                                
                                        </div>
                                        <!-- input group -->
                                    </div>
                                    <!-- <div class="mb-6">
                                                <label class="form-label">Fuente</label>
                                                
                                                <select class="form-control select2" id="prospecto" name="prospecto">
                                                <?php
                                             
                                                include 'includes/conexion.php'; 
                                                // Realizar la consulta a la base de datos para obtener los datos de la tabla
                                                $query2 = "SELECT * FROM user where id_user in(3,4,5,6)";
                                                $result2 = mysqli_query($con, $query2);

                                                // Verificar si se encontraron resultados
                                                if (mysqli_num_rows($result2) > 0) {
                                                    // Generar las opciones dentro del select
                                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    $value2 = $row2['id_user'];
                                                    $text2 = $row2['nombre_user'];
                                                    echo "<option value='" . $value2 . "'>" . $text2 . "</option>";
                                                    }
                                                }

                                                // Cerrar la conexión a la base de datos
                                                mysqli_close($con);
                                                ?>
                                                </select>
                                                <button type="button"
                                        class="btn btn-soft-primary waves-effect waves-light"></button>

                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- INICIO DATOS -->

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="p-4">
                                            <div class="d-flex">
                                                <div class="flex-1">

                                                    <h3 class="mb-3"><span class="counter_value" data-target="20">20</span>
                                                    </h3>
                                                </div>
                                                <div class="">
                                                    <p class="badge bg-soft-primary text-primary fw-bold font-size-12 mb-0">
                                                        Hoy</p>
                                                </div>
                                            </div>
                                            <h5 class="text-muted font-size-14 mb-0">Atendidos</h5>
                                        </div>
                                        
                                    </div>
                                    <!-- end cardbody -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                                                        
                        
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="p-4">
                                            <div class="d-flex">
                                                <div class="flex-1">

                                                    <h3 class="mb-3"><span class="counter_value" data-target="15">15</span>
                                                    </h3>
                                                </div>
                                                <div class="">
                                                    <p class="badge bg-soft-primary text-primary fw-bold font-size-12 mb-0">
                                                        Hoy o semana ?</p>
                                                </div>
                                            </div>
                                            <h5 class="text-muted font-size-14 mb-0">Ventas</h5>
                                        </div>
                                        
                                    </div>
                                    <!-- end cardbody -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                                                        
                        
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="p-4">
                                            <div class="d-flex">
                                                <div class="flex-1">

                                                    <h3 class="mb-3"><span class="counter_value" data-target="25">25</span>
                                                    </h3>
                                                </div>
                                                <div class="">
                                                    <p class="badge bg-soft-primary text-primary fw-bold font-size-12 mb-0">
                                                        semana - Hoy ?</p>
                                                </div>
                                            </div>
                                            <h5 class="text-muted font-size-14 mb-0">Seguimiento</h5>
                                        </div>
                                        
                                    </div>
                                    <!-- end cardbody -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                                                        
                        
                            <div class="col-xl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="p-4">
                                            <div class="d-flex">
                                                <div class="flex-1">

                                                    <h3 class="mb-3"><span class="counter_value" data-target="999999">No Adriana, no me expl0tes</span>
                                                    </h3>
                                                </div>
                                                <div class="">
                                                    <p class="badge bg-soft-primary text-primary fw-bold font-size-12 mb-0">
                                                        Semana </p>
                                                </div>
                                            </div>
                                            <h5 class="text-muted font-size-14 mb-0">Tiempo de respuesta</h5>
                                        </div>
                                        
                                    </div>
                                    <!-- end cardbody -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                                                        
                        </div>
                        <!-- end row -->
                        


                        <!-- FIN DATOS -->

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Data Tables</h4>
                                    <div class="page-title-center">
                                    <button type="button" class="btn btn-primary waves-effect waves-light" style="height: 35px !important;" onclick="window.location.href = 'nuevoCliente.php';">
                                        Nuevo Cliente <i class="mdi mdi-emoticon-excited-outline font-size-16 align-middle ms-2"></i>
                                    </button>

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
                                       
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Vendedor</th>
                                                    <th>Fecha Ingreso</th>
                                                    <th>Tiempo no atendido</th>
                                                    <th>Accion</th>
                                                    <th>Nombres</th>
                                                    
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Establecer la conexión con la base de datos
                                                $servername = "localhost";
                                                $username = "u291982824_ebiker";
                                                $password = "21.17.Ebiker";
                                                $dbname = "u291982824_ebiker";

                                                $conn = new mysqli($servername, $username, $password, $dbname);

                                                // Verificar la conexión
                                                if ($conn->connect_error) {
                                                    die("Error en la conexión: " . $conn->connect_error);
                                                }

                                                // Consulta SQL para obtener los datos de la tabla "formulario_totem"
                                                $sql = "SELECT *
                                                 FROM web_formularios where estado_web != 99 and estado_web=0 and prospecto !=4 and idEmpresa= $empresaUser ORDER BY fecha DESC";
                                                
                                                $result = $conn->query($sql);
                                                

                                                // Verificar si se obtuvieron resultados
                                                if ($result->num_rows > 0) {
                                                    $id = 1; // Variable para el ID inicial

                                                    // Mostrar los datos en filas de la tabla
                                                    while ($row = $result->fetch_assoc()) {
                                                        $prospecto=$row["prospecto"];
                                                        $idUsuarioRandom=$row["randomUser"];
                                                        $fechaActual2 = date("Y-m-d H:i:s");
                                                        // Obtener la fecha actual en formato Unix Timestamp
                                                        $fechaActual = time();

                                                        // Supongamos que $row["fecha"] contiene una fecha en formato "Y-m-d H:i:s"
                                                        $fechaBase = strtotime($row["fecha"]);

                                                        // Calcular la diferencia en segundos
                                                        $diferenciaSegundos = $fechaActual - $fechaBase;

                                                        // Calcular la diferencia en días, horas y minutos
                                                        $diferenciaDias = floor($diferenciaSegundos / (60 * 60 * 24));
                                                        $diferenciaHoras = floor(($diferenciaSegundos % (60 * 60 * 24)) / 3600);
                                                        $diferenciaMinutos = floor(($diferenciaSegundos % 3600) / 60);
                                                        echo "<tr>";
                                                        echo "<td>" . $id . "</td>";
                                                     
                                                        include 'includes/conexion.php'; 
                                                        // Realizar la consulta a la base de datos para obtener los datos de la tabla

                                                        $query2 = "SELECT * FROM user where id_user =$idUsuarioRandom";
                                                        $result2 = mysqli_query($con, $query2);

                                                        // Verificar si se encontraron resultados
                                                        if (mysqli_num_rows($result2) > 0) {
                                                            // Generar las opciones dentro del select
                                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                                            $value2 = $row2['id_user'];
                                                            $text2 = $row2['userName'];
                                                            echo "<td>" . $text2 . "</td>"; 
                                                            }
                                                        }
                                                        // Cerrar la conexión a la base de datos
                                                        mysqli_close($con);
                                                        echo "<td>" . date('Y-m-d H:i:s', strtotime($row["fecha"] . '-5 hours')) . "</td>";
                                                        if ($diferenciaDias > 0) {
                                                            echo "<td>".$diferenciaDias . " días, " . $diferenciaHoras . " horas y " . $diferenciaMinutos . " minutos". "</td>";
                                                        } elseif ($diferenciaHoras > 0) {
                                                            echo "<td>". $diferenciaHoras . " horas y " . $diferenciaMinutos . " minutos". "</td>";
                                                        } else {
                                                            echo "<td>". $diferenciaMinutos . " minutos". "</td>";
                                                        }
                                                        
                                                        echo "<td>" . $row["datos_form"] . "</td>";                                       
                                                        echo "</tr>";
                                        
                                                        $id++; // Incrementar el ID

                                                        
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='9'>No se encontraron resultados.</td></tr>";
                                                }
                                                 
                                                // Cerrar la conexión
                                                $conn->close();
                                                ?>
                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <!-- MODAL -->
                        
                        <script>
                            $(document).ready(function() {
                                $('.bs-example-modal-center').on('show.bs.modal', function(event) {
                                    var button = $(event.relatedTarget); // Botón que activó el modal
                                    var idFormWeb = button.data('id'); // Obtener el valor de 'data-id'
                                    var datosForm = button.data('datos'); // Obtener el valor de 'data-datos'

                                    // Mostrar los valores en los campos de entrada
                                    $(this).find('input[name="id_form_web"]').val(idFormWeb);
                                    $(this).find('input[name="datos_form"]').val(datosForm);

                                    // Realizar la solicitud AJAX para obtener el valor de la consulta
                                    $.ajax({
                                        url: 'includes/consulta.php',
                                        type: 'POST',
                                        data: { idFormWeb: idFormWeb },
                                        success: function(response) {
                                            // Asignar el valor al campo de entrada
                                            $('.modal-body').find('#valor').val(response);
                                        },
                                        error: function(xhr, status, error) {
                                            console.log(error);
                                        }
                                    });
                                });
                            });
                        </script>
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <?php include './parts/footer.php';?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?php include './parts/sidebar.php';?>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/libs/select2/js/select2.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
        <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="assets/js/pages/form-advanced.init.js"></script>

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
