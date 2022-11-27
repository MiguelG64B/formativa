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
  <title>Editar partido</title>
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
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Editar partido</h4>
                  <p class="card-description">
                  </p>
                  <form class="forms-sample" action="./php/editarpartido.php" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Nombre</label>
                      <input type="text" class="form-control" id="nombre" value="<?php echo $fila[2]; ?>" name="nombre" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Descripcion</label>
                      <textarea class="form-control" id="descripcion" name="descripcion" value="<?php echo $fila[3]; ?>" rows="7"></textarea Required>
                    </div>


                    <div class="form-group">
                      <label for="exampleSelectGender">Ubicacion</label>
                      <select class="form-control" id="ubicacion" name="ubicacion" required>
                        <option value="<?php echo $fila[4]; ?>">No cambiar cancha</option>
                        <option value="1">Cancha San Eduardo</option>
                        <option value="2">Cancha de el zulima</option>
                        <option value="3">Cancha De Futbol Niza</option>
                        <option value="4">Cancha de futbol Ceiba II</option>
                        <option value="5">Cancha gratimara</option>
                        <option value="6">Cancha la La Mar</option>
                        <option value="7">Cancha Copetes</option>
                        <option value="8">Cancha Parque Jardín</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputName1">Fecha</label>
                      <input type="date" class="form-control" id="fecha" value="<?php echo $fila[5]; ?>" name="fecha" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Horas</label>
                      <select class="form-control" id="hora" name="hora" required>
                        <option value="<?php echo $fila[6]; ?>"><?php echo $fila[6]; ?></option>
                        <option value="3:00 pm - 6:00 pm">8:00 am - 11:00 am</option>
                        <option value="11:00 am - 2:00 pm">11:00 am - 2:00 pm</option>
                        <option value="3:00 pm - 6:00 pm">3:00 pm - 6:00 pm</option>
                        <option value="6:00 pm - 10:00 pm">6:00 pm - 10:00 pm</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Tipo de partido</label>
                      <select class="form-control" id="maximo" name="maximo" required>
                        <option value="10">5c5 (10)</option>
                        <option value="16">8c8 (16)</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleSelectGender">Estado del partido</label>
                      <select class="form-control" id="estado" name="estado" required>
                        <option value="<?php echo $fila[9]; ?>"><?php echo $fila[9]; ?></option>
                        <option value="Activo">Activo</option>
                        <option value="Cancelado">Cancelado</option>
                      </select>
                    </div>
                    <input type="hidden" id="id_usuario" name="id_usuario" value=" <?php echo $arregloUsuario['id_usuario']; ?> " class="form-control" required="">
                    <input hidden id="id_partido" name="id_partido" value=" <?php echo  $fila[0]; ?> " class="form-control" required="">
                    <input hidden id="poblacion" name="poblacion" value=" <?php echo  $fila[7]; ?> " class="form-control" required="">
                    <button type="submit" class="btn btn-primary me-2">Guardar cambios</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-12 grid-margin stretch-card">
              <div class="row flex-grow">

                <div class="card card-rounded">
                  <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start">
                      <div>
                        <h4 class="card-title card-title-dash">Participantes</h4>
                        <p class="card-subtitle card-subtitle-dash"><?php echo $fila[7]; ?>/<?php echo $fila[8]; ?></span></p>
                      </div>
                    </div>
                    <div class="table-responsive  mt-1">
                      <table class="table select-table">
                        <thead>
                        </thead>
                      </table>
                      <div class="table-responsive  mt-1">
                        <table class="table select-table">
                          <tbody>
                            <tr>
                              <td>
                                <div class="d-flex">
                                  <img src="images/faces/usuario.png" alt="">
                                  <div>
                                    <h6><?php echo  $arregloUsuario['nombre']; ?> <?php echo  $arregloUsuario['apellido']; ?></h6>
                                  </div>
                                </div>
                              </td>
                                <p>Administrador</p>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <?php
                    include('./php/conexion.php');
                    $limite = 3;
                    $totalQuery = $conexion->query('select count(*) from partido') or die($conexion->error);
                    $totalestado = mysqli_fetch_row($totalQuery);
                    $totalBotones = round($totalestado[0] / $limite);
                    $id_partido = $fila[0];
                    if (isset($_GET['limite'])) {
                      $resultado2 = $conexion->query("SELECT * FROM usuario LEFT JOIN control ON usuario.id = control.id_usuario WHERE control.id_partido = $id_partido limit " . $_GET['limite'] . "," . $limite) or die($conexion->error);
                    } else {
                      $resultado2 = $conexion->query("SELECT * FROM usuario LEFT JOIN control ON usuario.id = control.id_usuario WHERE control.id_partido = $id_partido  limit " . $limite) or die($conexion->error);
                    }

                    while ($fila2 = mysqli_fetch_array($resultado2)) {
                    ?>
                      <div class="table-responsive  mt-1">
                        <table class="table select-table">
                          <tbody>
                            <tr>
                              <td>
                                <div class="d-flex">
                                  <img src="images/faces/usuario.png" alt="">
                                  <div>
                                    <h6><?php echo  $fila2['nombre'];
                                        $fila2['apellido']; ?> <?php echo  $fila2['apellido']; ?></h6>
                                    <p><?php echo  $fila2['rol']; ?></p>
                                  </div>
                                </div>
                              </td>
                                <form action="./php/gestionjugador.php" method="post">
                                  <select class="form-control" id="estado" name="estado">
                                    <option value="<?php echo  $fila2['estado']; ?>"> <?php echo  $fila2['estado']; ?></option>
                                    <option value="Confirmado">Confirmado</option>
                                    <option value="Rechazado">Rechazado</option>
                                  </select>
                                  <input hidden id="id_control" name="id_control" value=" <?php echo  $fila2['id']; ?> " class="form-control" required="">
                                  <input hidden id="id_partido" name="id_partido" value=" <?php echo  $fila[0]; ?> " class="form-control" required="">
                                  <button type="submit" class="btn btn-primary me-2">Guardar cambios</button>
                                </form>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    <?php } ?>
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