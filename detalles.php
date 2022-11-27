<?php
session_start();
include("./php/conexion.php");
if (isset($_GET['id'])) {
  $resultado = $conexion->query("select * from partido where id=" . $_GET['id']) or die($conexion->error);
  if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_row($resultado);
  } else {
    header("Location: ./index.php");
  }
} else {
  //redireccionar
  header("Location: ./index.php");
}
$arregloUsuario = $_SESSION['datos_login'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Detalles partido</title>
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
                <div class="statistics-details d-flex align-items-center justify-content-between">
                  <div>
                    <h3 class="rate-percentage"><?php echo $fila[2]; ?></h3>
                    <p class="statistics-title"><?php echo $fila[3]; ?></p>
                    
                  </div>

                  <?php
                  include("./php/conexion.php");
                  $id_cancha = $fila[4];
                  $ubicacion = $conexion->query("select * from canchas where id= $id_cancha") or die($conexion->error);
                  if (mysqli_num_rows($ubicacion) > 0) {
                    $ubica = mysqli_fetch_row($ubicacion);
                  }
                  ?>
                  <div class="col-lg-4 d-flex flex-column">
                    <div class="row flex-grow">
                      <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                        <div class="card bg-primary card-rounded">
                          <div class="card-body pb-0">
                            <h4 class="card-title card-title-dash text-white mb-4">Donde y cuando</h4>
                            <div class="row">
                              <div class="col-sm-4">
                                <p class="status-summary-ight-white mb-1"><?php echo $fila[5]; ?></p>
                                <p class="status-summary-ight-white mb-1"><?php echo $fila[6]; ?></p>
                              </div>
                              <div class="col-sm-8">
                                <div class="status-summary-chart-wrapper pb-4">
                                  <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                      <div class="text-warning"><a class="text-warning" href="./busqueda.php?texto=<?php echo $ubica[1] ?>&id=<?php echo $fila[7] ?>"><?php echo $ubica[1]; ?></a></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                    <iframe src="https://www.google.com/maps/<?php echo $ubica[2];?>" width="200" height="100" style="border:100px;"></iframe>
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
                <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                  <div class="card card-rounded">
                    <div class="card-body card-rounded">
                      <h4 class="card-title  card-title-dash">Ultimos inscritos</h4>
                      <?php
                      include('./php/conexion.php');
                      $limite = 3;
                      $totalQuery = $conexion->query('select count(*) from partido') or die($conexion->error);
                      $totalestado = mysqli_fetch_row($totalQuery);
                      $totalBotones = round($totalestado[0] / $limite);
                      $id_partido = $fila[0];
                      if (isset($_GET['limite'])) {
                        $resultado2 = $conexion->query("SELECT * FROM usuario LEFT JOIN control ON usuario.id = control.id_usuario WHERE control.id_partido = $id_partido AND control.estado = 'Confirmado' limit " . $_GET['limite'] . "," . $limite) or die($conexion->error);
                      } else {
                        $resultado2 = $conexion->query("SELECT * FROM usuario LEFT JOIN control ON usuario.id = control.id_usuario WHERE control.id_partido = $id_partido AND control.estado = 'Confirmado' limit " . $limite) or die($conexion->error);
                      }

                      while ($fila2 = mysqli_fetch_array($resultado2)) {
                      ?>
                        <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                          <div class="d-flex">
                            <a href="./historialjug.php?id=<?php echo $fila2[0] ?>&nombre=<?php echo $fila2[1] ?>"><img class="img-sm rounded-10" src="images/faces/usuario.png" alt="profile"></a>
                            <div class="wrapper ms-3">
                              <p class="ms-1 mb-1 fw-bold"><?php echo  $fila2['nombre'];
                             $fila2['apellido']; ?> <?php echo  $fila2['apellido']; ?> </p>
                             
                              <small class="text-muted mb-0"><?php echo  $fila2['rol']; ?></small>
                            </div>
                          </div>
                          <div class="text-muted text-small">
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-lg-6 grid-margin stretch-card">

                  <div class="card card-rounded">
                    <div class="card-body">
                      <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="card-title card-title-dash">Opciones</h4>
                      </div>
                      <?php
                      $id_partidos = $_GET['id'];
                      $id_usuario = $arregloUsuario['id_usuario'];
                      $poblacion =$fila[7]; 
                      $maximo =$fila[8]; 
                      $resultadocontrol = $conexion->query("select * from control  where control.id_usuario =  $id_usuario and control.id_partido= $id_partidos limit " . $limite) or die($conexion->error);

                      if (mysqli_num_rows($resultadocontrol) > 0) {
                        while ($filacontrol = mysqli_fetch_array($resultadocontrol)) {
                      ?>
                          <div class="col-12 alert alert-success">Tu solicitud esta pendiente</div>
                        <?php
                        }
                      } else {
                        ?>
                        <form class="pt-3" method="post" action="./php/insertarjugadores.php">
                          <input type="hidden" id="id_usuario" name="id_usuario" value=" <?php echo $arregloUsuario['id_usuario']; ?> " class="form-control" required>
                          <input type="hidden" id="id_partido" name="id_partido" value=" <?php echo  $fila[0]; ?> " class="form-control" required>
                          <input type="hidden" id="hora" name="hora" value=" <?php echo  $fila[6]; ?> " class="form-control" required>
                          <input type="hidden" id="fecha" name="fecha" value=" <?php echo  $fila[5]; ?> " class="form-control" required>
                          <label>Me quiero presentar como...</label>
                          <select class="form-control form-control-lg" id="rol" name="rol">
                            <option value="jugador">Jugador</option>
                            <option value="arquero">Arquero</option>
                          </select>
                          <div class="mt-3">
                            <button type="submit" class="btn btn-primary mb-2">Postularme</button>
                          </div>
                        </form>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <?php
                if (isset($_GET['error'])) {
                  echo '<div class="col-12 alert alert-danger">' . $_GET['error'] . '</div>';
                }
                ?>
                <?php
                if (isset($_GET['todobien'])) {
                  echo '<div class="col-12 alert alert-success">' . $_GET['todobien'] . '</div>';
                }
                ?>
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