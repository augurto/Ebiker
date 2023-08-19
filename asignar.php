<?php
session_start();
include 'includes/conexion.php'; // Incluir el archivo de conexión

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

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Data Tables</h4>
                                    <div class="page-title-center">
                                    <?php if ($tipoUsuario == 2): ?>
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
                                        
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>boton</th>
                                                    <th>Vendedor</th>
                                                    <th>Fecha Ingreso</th>
                                                    <th>Tiempo no atendido</th>
                                                    <th>Accion</th>
                                                    <th>Fuente</th>
                                                    <th>Estado</th>
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
                                                        $idConsulta=$row['id_form_web'];
                                                        // Consulta para obtener el usuario con el id_usuario específico
                                                        $userQuery = "SELECT * FROM user WHERE id_user = $idUsuarioRandom";
                                                        $userResult = $conn->query($userQuery);

                                                        // Verificar si se encontró el usuario
                                                        if ($userResult->num_rows > 0) {
                                                            $userData = $userResult->fetch_assoc();
                                                            $userName = $userData["userName"]; // Aquí capturamos el valor de userName
                                                        } else {
                                                            $userName = "Usuario no encontrado"; // Manejo de caso en que el usuario no se encuentra
                                                        }
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
                                                        echo '<td>';
                                                        echo '<button type="button" class="btn btn-primary waves-effect waves-light"
                                                                    data-bs-toggle="modal" data-bs-target="#myModal"
                                                                    data-id="' . $idConsulta . '"  data-random="' . $idUsuarioRandom . '">Asignar</button>';
                                                        echo '</td>';
                                                        echo "<td>" . $userName . "</td>"; 
                                                        echo "<td>" . date('Y-m-d H:i:s', strtotime($row["fecha"] . '-5 hours')) . "</td>";
                                                        if ($diferenciaDias > 0) {
                                                            echo "<td>".$diferenciaDias . " días, " . $diferenciaHoras . " horas y " . $diferenciaMinutos . " minutos". "</td>";
                                                        } elseif ($diferenciaHoras > 0) {
                                                            echo "<td>". $diferenciaHoras . " horas y " . $diferenciaMinutos . " minutos". "</td>";
                                                        } else {
                                                            echo "<td>". $diferenciaMinutos . " minutos". "</td>";
                                                        }
                                                        $url_dato = $row["URL"];
                                                        // Obtener los parámetros de la URL
                                                        $params = parse_url($url_dato, PHP_URL_QUERY);

                                                        // Convertir los parámetros en un arreglo asociativo
                                                        parse_str($params, $query);

                                                        // Obtener los valores de las variables específicas
                                                        $a = $query['utm_source'];
                                                        $b = $query['utm_medium'];
                                                        $c = $query['utm_campaign'];

                                                        // Imprimir los valores
                                                                                                           
                                                        $documentoCliente=$row["documentoCliente"];
                                                        $fuente_dato = $row["fuente_dato"];

                                                       
                                                            // Obtener el valor de $row["estado_web"]
                                                            $estado_web = $row["estado_web"];

                                                            if ($estado_web == 0 && !empty($a)) {
                                                                echo "<td>
                                                                
                                                                <a href='seguimientoCliente.php?id=" . $row['id_form_web'] . "&pr=" . $a . "&f=" . $tipoFuente . "'  class='btn btn-danger waves-effect waves-light'>
                                                                    Atender
                                                                </a>                                                       
                                                                </td>";
                                                               
                                                            } elseif ($estado_web == 1) {
                                                                echo "<td>
                                                                        
                                                                            <a href='seguimientoCliente.php?id=" . $row['id_form_web'] . "&pr=" . $a . "&f=" . $tipoFuente . "'  class='btn btn-primary waves-effect waves-light'>
                                                                            Atendido
                                                                            </a>
                                                                        </td>";
                                                                   
                                                            } elseif (empty($a) && $estado_web == 0  ) {
                                                                echo "<td>
                                                                    <a href='seguimientoCliente.php?id=" . $row['id_form_web'] . "&pr=" . $a . "&f=" . $tipoFuente . "'  class='btn btn-danger waves-effect waves-light'>
                                                                        Atender
                                                                    </a>
                                                                </td>";
                                                               
                                                            }
                                                            
                                                        
                                                            if (empty($row["id_user"])) {
                                                                if ($a == "Google ADS") {
                                                                    $fuenteOriginal = 2;
                                                                } elseif ($a == "Meta ADS") {
                                                                    $fuenteOriginal = 3;
                                                                } else {
                                                                    $fuenteOriginal = 1;
                                                                }
                                                            } else {
                                                                $fuenteOriginal = $row["prospecto"];
                                                            }
                                                            
                                                        /* condicional para mostrar si es de facebook, google, organico o presencial */
                                                      

                                                                $queryFuente = "SELECT colorFuente,descripcionFuente FROM fuente WHERE tipoFuente = '$fuenteOriginal'";
                                                                $resultFuente = mysqli_query($conn, $queryFuente);

                                                                $rowFuente = mysqli_fetch_assoc($resultFuente);
                                                                $descripcionFuente = $rowFuente['descripcionFuente'];
                                                                $colorFuente = $rowFuente['colorFuente'];
                                                                $tipoFuente = $rowFuente['tipoFuente'];                                            
                                                                        

                                                                echo '<td><span class="badge rounded-pill" style="background-color: ' . $colorFuente . ';color:white;">' . $descripcionFuente . '</span></td>';

                                                        
                                                        $estadoCliente = $row["tipoCliente"];
                                                        
                                                        // Realizar la consulta a la base de datos para obtener la descripción del tipo de cliente
                                                        $queryTipoCliente = "SELECT * FROM tipoCliente WHERE valorTipoCliente = $estadoCliente";
                                                        $resultTipoCliente = mysqli_query($conn, $queryTipoCliente);

                                                        if ($resultTipoCliente && mysqli_num_rows($resultTipoCliente) > 0) {
                                                            $rowTipoCliente = mysqli_fetch_assoc($resultTipoCliente);
                                                            $descripcionTipoCliente = $rowTipoCliente["descripcionTipoCliente"];
                                                            $colorTipoCliente = $rowTipoCliente["colorTipoCliente"];

                                                            echo "<td><span class=\"badge rounded-pill\" style=\"background-color: $colorTipoCliente;\">$descripcionTipoCliente</span></td>";
                                                        } else {
                                                            
                                                            echo '<td><span class="badge rounded-pill" style="background-color: black; color: white;">Prospecto Venta</span></td>';

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
                        <!-- Modal -->
                        <?php
                        

                        $query3 = "SELECT u.userName, wf.randomUser, COUNT(*) AS cantidad
                        FROM web_formularios wf
                        INNER JOIN user u ON u.id_user = wf.randomUser
                        WHERE wf.estado_web = 0
                        GROUP BY wf.randomUser
                        ORDER BY cantidad ASC";

                        $result3 = mysqli_query($con, $query3);
                        ?>

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
                                            
                                    <form action="includes/asignarUsuario.php" method="get">
                                            <input type="text" class="form-control" id="inputIdFormWeb" name="idFormWeb" >
                                            <label for="inputIdFormWeb2" class="form-label">ID del Usuario actual</label>
                                            <input type="text" class="form-control" id="myInput" readonly>
                                            
                                        </div>
                                       
                                        <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Vendedor</th>
                                                <th>Cantidad no Atendidos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                                <tr>
                                                    <td><?php echo $row3['userName']; ?></td>
                                                    <td><?php echo $row3['cantidad']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                         </table>
                                        <div class="mb-3">
                                            <label for="selectUsuario" class="form-label">Asignar a Usuario</label>
                                            <select class="form-select" id="selectUsuario" name="selectUsuario">
                                                <?php
                                                    $queryUsuarios = "SELECT id_user, userName FROM user where tipo_user =1";
                                                    $resultUsuarios = mysqli_query($con, $queryUsuarios);

                                                    while ($rowUsuario = mysqli_fetch_assoc($resultUsuarios)) {
                                                        echo '<option value="' . $rowUsuario['id_user'] . '">' . $rowUsuario['userName'].$rowUsuario['id_user'] . '</option>';
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
                            
                        $(document).ready(function () {
                            $('.btn-primary').click(function () {
                                var idValue = $(this).data('id');
                                var randomValue = $(this).data('random');
                                $('#idValueSpan').text(idValue); // Actualiza el valor del span
                                $('#inputIdFormWeb').val(idValue); // Rellena el input con el valor del ID
                                $('#myInput').val(randomValue); // Rellena el otro input con el valor de $idUsuarioRandom
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
