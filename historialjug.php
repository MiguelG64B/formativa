<?php
session_start();

if (!isset($_SESSION['datos_login'])) {
  header("Location: ./login.php?error=No se ha iniciado sesion");
  echo "debes regristarte";
}

$id_usuario =  $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Historial de jugador</title>
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
                        <div>
                          <h4 class="card-title card-title-dash">Actividad</h4>
                          <p class="card-subtitle card-subtitle-dash">Historial en los que participo <?php  echo $_GET['nombre'] ?></p>
                        </div>
                      </div>
                      <div class="table-responsive  mt-1">
                        <table class="table select-table">
                          <thead>
                            <tr>
                              <th></th>
                              <th></th>
                              <th>Nombre</th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th>Fecha</th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                                <th>Progreso</th>
                               </tr>
                          </thead>
                        </table>
                        <?php
                        include('./php/conexion.php');
                        $limite = 10;
                        $totalQuery = $conexion->query('select count(*) from partido') or die($conexion->error);
                        $totalestado = mysqli_fetch_row($totalQuery);
                        $totalBotones = round($totalestado[0] / $limite);
                        if (isset($_GET['limite'])) {
                          $resultado = $conexion->query("SELECT * FROM partido LEFT JOIN control ON partido.id = control.id_partido WHERE control.id_usuario = $id_usuario AND partido.estado = 'Finalizado' limit " . $_GET['limite'] . "," . $limite) or die($conexion->error);
                        } else {
                          $resultado = $conexion->query("SELECT * FROM partido LEFT JOIN control ON partido.id = control.id_partido WHERE control.id_usuario = $id_usuario AND partido.estado = 'Finalizado'  limit " . $limite) or die($conexion->error);
                        }

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
                                      <h6><a href="resultados.php?id=<?php echo $fila['id_partido']; ?>"><?php echo $fila['nombre']; ?></h6></a>
                                    </div>
                                  </div>
                                </td>
                                <td>
                               <p><?php echo $fila['fecha']; ?></p>
                                </td>
                                <td>
                                  <div>
                                  <p class="card-subtitle card-subtitle-dash"><?php echo $fila[7]; ?>/<?php echo $fila[8]; ?></span></p>
                                  </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        <?php } ?>
                        <?php
                if (isset($_GET['limite'])) {
                  if ($_GET['limite'] > 0) {
                    echo '<button type="button" class="btn btn-inverse-primary"><a href="historial.php?limite=' . ($_GET['limite'] - $_GET['limite']) . '">&lt;</a></button>';
                  }
                }
                for ($k = 0; $k < $totalBotones; $k++) {
                  echo  '<button type="button" class="btn btn-inverse-primary"><a href="historial.php?limite=' . ($k * 3) . '">' . ($k + 1) . '</a></button>';
                }
                if (isset($_GET['limite'])) {
                  if ($_GET['limite'] + 6 < $totalBotones * $_GET['limite']) {
                    echo '<button type="button" class="btn btn-inverse-primary"><a href="historial.php?limite=' . ($_GET['limite'] + 3) . '">&gt;</a></button>';
                  }
                } else {
                  echo '<button type="button" class="btn btn-inverse-primary"><a href="historial.php?limite=3">&gt;</a></button>';
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