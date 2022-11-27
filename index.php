<?php
session_start();
if (!isset($_SESSION['datos_login'])) {
  header("Location: ./login.php");
}
$arregloUsuario = $_SESSION['datos_login'];
$id_usuario = $arregloUsuario['id_usuario'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Principal</title>
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
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">

                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded table-darkBGImg">
                              <div class="card-body">
                                <div class="col-sm-8">
                                  <h3 class="text-white upgrade-info mb-0">
                                    Encuentra un <span class="fw-bold">equipo</span> para un partido rapido.
                                  </h3>
                                  <a href="./crear.php" class="btn btn-info upgrade-btn">Crea tu partido</a>
                                </div>..............
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                    <h4 class="card-title card-title-dash">Partidos en los que participas</h4>
                                    <p class="card-subtitle card-subtitle-dash">Una lista de partidos en los que te has registrado</p>
                                  </div>
                                  <div>
                                    <a href="./vermas.php"> <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button">Buscar partidos</button></a>
                                  </div>
                                </div>
                                <div class="table-responsive  mt-1">
                                  <table class="table select-table">
                                    <thead>
                                      <tr>
                                        <th>

                                        </th>
                                        <th>Nombre</th>
                                        <th>Ubicacion</th>
                                        <th>Progreso</th>
                                      </tr>
                                    </thead>
                                  </table>
                                  <?php
                                  include('./php/conexion.php');
                                  $limite = 3;
                                  $totalQuery = $conexion->query('select count(*) from partido') or die($conexion->error);
                                  $totalestado = mysqli_fetch_row($totalQuery);
                                  $totalBotones = round($totalestado[0] / $limite);

                                  if (isset($_GET['limite'])) {
                                    $resultado = $conexion->query("SELECT * FROM partido LEFT JOIN control ON partido.id = control.id_partido WHERE control.id_usuario = $id_usuario AND partido.estado = 'Activo' limit " . $_GET['limite'] . "," . $limite) or die($conexion->error);
                                  } else {
                                    $resultado = $conexion->query("SELECT * FROM partido LEFT JOIN control ON partido.id = control.id_partido WHERE control.id_usuario = $id_usuario AND partido.estado = 'Activo'  limit " . $limite) or die($conexion->error);
                                  }

                                  while ($fila = mysqli_fetch_array($resultado)) {
                                  ?>
                                    <table class="table select-table">
                                      <tbody>
                                        <tr>
                                          <td>
                                            <h6><a href="detalles.php?id=<?php echo $fila['id_partido']; ?>"><?php echo $fila['nombre']; ?></h6></a>
                                          </td>
                                </div>
                              </div>

                              <td>
                                <p><?php echo $fila['fecha']; ?></p>
                                <p><?php echo $fila['hora']; ?></p>
                              </td>
                              <td>
                                <p class="card-subtitle card-subtitle-dash"><?php echo $fila[7]; ?>/<?php echo $fila[8]; ?></span></p>
                              </td>
                              </tr>
                              </tbody>
                              </table>
                            <?php } ?>
                            </div>
                            <?php
                            if (isset($_GET['limite'])) {
                              if ($_GET['limite'] > 0) {
                                echo '<button type="button" class="btn btn-inverse-primary"><a href="index.php?limite=' . ($_GET['limite'] - $_GET['limite']) . '">&lt;</a></button>';
                              }
                            }
                            for ($k = 0; $k < $totalBotones; $k++) {
                              echo  '<button type="button" class="btn btn-inverse-primary"><a href="index.php?limite=' . ($k * 3) . '">' . ($k + 1) . '</a></button>';
                            }
                            if (isset($_GET['limite'])) {
                              if ($_GET['limite'] + 6 < $totalBotones * $_GET['limite']) {
                                echo '<button type="button" class="btn btn-inverse-primary"><a href="index.php?limite=' . ($_GET['limite'] + 3) . '">&gt;</a></button>';
                              }
                            } else {
                              echo '<button type="button" class="btn btn-inverse-primary"><a href="index.php?limite=3">&gt;</a></button>';
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row flex-grow">
                      <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                        <div class="card card-rounded">
                          <div class="card-body card-rounded">
                            <h4 class="card-title  card-title-dash">Proximos partidos</h4>
                            <?php
                            include('./php/conexion.php');
                            $limite = 3;
                            $totalQuery = $conexion->query('select count(*) from partido') or die($conexion->error);
                            $totalestado = mysqli_fetch_row($totalQuery);
                            $totalBotones = round($totalestado[0] / $limite);
                            if (isset($_GET['limite'])) {
                              $resultado2 = $conexion->query("select * from partido where id_usuario !=  $id_usuario  limit " . $_GET['limite'] . "," . $limite) or die($conexion->error);
                            } else {
                              $resultado2 = $conexion->query("select * from partido where id_usuario !=  $id_usuario order by id DESC limit " . $limite) or die($conexion->error);
                            }

                            while ($fila = mysqli_fetch_array($resultado2)) {
                            ?>
                              <div class="list align-items-center border-bottom py-2">
                                <div class="wrapper w-100">
                                  <h6><a href="detalles.php?id=<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></h6></a>
                                  <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                      <i class="mdi mdi-calendar text-muted me-1"></i>
                                      <p class="mb-0 text-small text-muted"><?php echo $fila['fecha']; ?></p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <?php } ?>
                            <div class="list align-items-center pt-3">
                              <div class="wrapper w-100">
                                <p class="mb-0">
                                  <a href="vermas.php" class="fw-bold text-primary">Ver mas <i class="mdi mdi-arrow-right ms-2"></i></a>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6 grid-margin stretch-card">
                        <div class="card card-rounded">
                          <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                              <h4 class="card-title card-title-dash">Actividad</h4>
                              <p class="mb-0">Historial de partidos</p>
                            </div>
                            <?php
                            include('./php/conexion.php');
                            $limite = 3;
                            $totalQuery = $conexion->query('select count(*) from partido') or die($conexion->error);
                            $totalestado = mysqli_fetch_row($totalQuery);
                            $totalBotones = round($totalestado[0] / $limite);

                            if (isset($_GET['limite'])) {
                              $resultado2 = $conexion->query("SELECT * FROM partido LEFT JOIN control ON partido.id = control.id_partido WHERE control.id_usuario = $id_usuario AND partido.estado = 'Finalizado' limit " . $_GET['limite'] . "," . $limite) or die($conexion->error);
                            } else {
                              $resultado2 = $conexion->query("SELECT * FROM partido LEFT JOIN control ON partido.id = control.id_partido WHERE control.id_usuario = $id_usuario AND partido.estado = 'Finalizado'  limit " . $limite) or die($conexion->error);
                            }

                            while ($filafin = mysqli_fetch_array($resultado2)) {
                            ?>
                              <ul class="bullet-line-list">
                                <li>
                                  <div class="d-flex justify-content-between">
                                    <div><span class="text-light-green"><?php echo $filafin['nombre']; ?> </span><?php echo $filafin['rol']; ?></div>
                                    <p><?php echo $filafin['estado']; ?></p>
                                  </div>
                                </li>
                              </ul>
                            <?php } ?>
                            <div class="list align-items-center pt-3">
                              <div class="wrapper w-100">
                                <p class="mb-0">
                                  <a href="historial.php" class="fw-bold text-primary">Ver todo <i class="mdi mdi-arrow-right ms-2"></i></a>
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 d-flex flex-column">
                    <div class="row flex-grow">
                      <div class="col-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-12">
                                    </ul>
                                <div class="d-flex justify-content-between align-items-center">
                                  <h4 class="card-title card-title-dash">Canchas</h4>
                                </div>
                                <div class="list-wrapper">
                                  <ul class="list-unstyled mb-0">
                                    <?php
                                    include('./php/conexion.php');
                                    $re = $conexion->query("select * from canchas");
                                    while ($f = mysqli_fetch_array($re)) {

                                    ?>
                                      <ul>
                                        <li>
                                          <a href="./busqueda.php?texto=<?php echo $f['nombrecancha'] ?>&id=<?php echo $f['id'] ?>">
                                            <div class="d-flex justify-content-between">
                                              <div><span class="text-light-green"><?php echo $f['nombrecancha']; ?> </span>
                                                <p> <?php
                                                    include('./php/conexion.php');
                                                    $re2 = $conexion->query("select count(*) from partido where estado = 'Activo' and ubicacion = " . $f['id']);
                                                    $fila = mysqli_fetch_row($re2);
                                                    echo $fila[0];
                                                    ?></p>
                                              </div>

                                            </div>
                                          </a>
                                        </li>
                                      </ul>
                                    <?php } ?>
                                   </ul>
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