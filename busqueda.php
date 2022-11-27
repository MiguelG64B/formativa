<?php
session_start();

if (!isset($_SESSION['datos_login'])) {
  header("Location: ./login.php?error=No se ha iniciado sesion");
  echo "debes regristarte";
}
$arregloUsuario = $_SESSION['datos_login'];
if (!isset($_GET['texto'])) {
  header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Busqueda</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include("./layouts/nav.php"); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <?php include("./layouts/header.php"); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="row flex-grow">
                <div class="col-12 grid-margin stretch-card">
                  <div class="card card-rounded">
                    <div class="card-body">
                      <div class="d-sm-flex justify-content-between align-items-start">

                        <?php
                        include("./php/conexion.php");
                        $id_cancha = $_GET['id'];
                        $est = 'Activo';
                        $ubicacion = $conexion->query("select * from canchas where id = $id_cancha") or die($conexion->error);
                        if (mysqli_num_rows($ubicacion) > 0) {
                          $ubica = mysqli_fetch_row($ubicacion);
                        }
                        ?>
                        <div>
                          <h4 class="card-title card-title-dash text-primary"><?php echo $_GET['texto']; ?></h4>
                          <p class="card-subtitle card-subtitle-dash"></p>
                          <h4 class="card-title card-title-dash">Detalles</h4>
                          <p class="card-subtitle card-subtitle-dash"><?php echo $ubica[3]; ?></p>
                        </div>
                        <div class="col-lg-4 d-flex flex-column">
                          <div class="row flex-grow">
                            <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                              <div class="card bg-primary card-rounded">
                                <div class="card-body pb-0">
                                  <h4 class="card-title card-title-dash text-white mb-4">Ubicacion</h4>
                                  <div class="row">
                                    <div class="col-sm-8">
                                      <div class="status-summary-chart-wrapper pb-4">
                                        <div class="chartjs-size-monitor">
                                          <div class="chartjs-size-monitor-expand">
                                            <div class="text-warning"><a class="text-warning"><?php echo $ubica[1]; ?></a></div>
                                          </div>
                                          <div class="chartjs-size-monitor-shrink">
                                            <iframe src="https://www.google.com/maps/<?php echo $ubica[2]; ?>" width="200" height="100" style="border:100px;"></iframe>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <h4 class="card-title card-title-dash">Calendario</h4>
                      <div class="table-responsive  mt-1">
                        <table class="table select-table">
                          <thead>
                            <tr>
                              <th>

                              </th>
                              <th>Nombre</th>
                              <th>Fecha</th>
                              <th>Progreso</th>
                              <th>Estado</th>
                            </tr>
                          </thead>
                        </table>
                        <?php
                        include('./php/conexion.php');
                        $limite = 3;
                        $totalQuery = $conexion->query('select count(*) from partido') or die($conexion->error);
                        $totalestado = mysqli_fetch_row($totalQuery);
                        $totalBotones = round($totalestado[0] / $limite);
                        $resultado = $conexion->query("select * from partido LEFT JOIN canchas
                        ON partido.ubicacion = canchas.id  where canchas.nombrecancha like '%" . $_GET['texto'] . "%' AND partido.estado = 'Activo'") or die($conexion->error);

                        if (mysqli_num_rows($resultado) > 0) {
                          while ($fila = mysqli_fetch_array($resultado)) {
                        ?>
                            <table class="table select-table">
                              <tbody>
                                <tr>
                                  <td>

                                  </td>
                                  <td>
                                    <div class="d-flex">

                                      <div>
                                        <h6><a href="detalles.php?id=<?php echo $fila['id']; ?>"><?php echo $fila['id']; ?><?php echo $fila['nombre']; ?></h6></a>
                                      </div>
                                    </div>
                                  </td>
                                  <td>
                                    <p><?php echo $fila['fecha']; ?></p>
                                    <p><?php echo $fila['hora']; ?></p>
                                  </td>
                                  <td>
                                    <div>
                                      <p class="card-subtitle card-subtitle-dash"><?php echo $fila[7]; ?>/<?php echo $fila[8]; ?></span></p>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="badge badge-opacity-success"><?php echo $fila['estado']; ?></div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                        <?php }
                        } else {
                          echo  '<h2>No hay partidos registrados en esta cancha</h2><div>
                    <a href="index.php"><input type="submit" class="btn btn-sm btn-primary" value="Regresar a pagina principal"></a></div>';
                        } ?>
                        <?php
                        if (isset($_GET['limite'])) {
                          if ($_GET['limite'] > 0) {
                            echo '<button type="button" class="btn btn-inverse-primary"><a href="busqueda.php?limite=' . ($_GET['limite'] - $_GET['limite']) . '">&lt;</a></button>';
                          }
                        }
                        for ($k = 0; $k < $totalBotones; $k++) {
                          echo  '<button type="button" class="btn btn-inverse-primary"><a href="busqueda.php?limite=' . ($k * 3) . '">' . ($k + 1) . '</a></button>';
                        }
                        if (isset($_GET['limite'])) {
                          if ($_GET['limite'] + 6 < $totalBotones * $_GET['limite']) {
                            echo '<button type="button" class="btn btn-inverse-primary"><a href="busqueda.php?limite=' . ($_GET['limite'] + 3) . '">&gt;</a></button>';
                          }
                        } else {
                          echo '<button type="button" class="btn btn-inverse-primary"><a href="busqueda.php?limite=3">&gt;</a></button>';
                        }
                        ?>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include("./layouts/footer.php"); ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>