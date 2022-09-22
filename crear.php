<?php
session_start();

if (!isset($_SESSION['datos_login'])) {
  header("Location: ./login.php?error=No se ha iniciado sesion");
  echo "debes regristarte";
}
$arregloUsuario = $_SESSION['datos_login'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Crear evento</title>
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
                  <h4 class="card-title">Crear partido</h4>
                  <p class="card-description">
                  </p>
                  <form class="forms-sample" action="./php/crear.php" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Nombre</label>
                      <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Descripcion</label>
                      <textarea class="form-control" id="descripcion" name="descripcion" rows="4"></textarea>
                    </div>


                    <div class="form-group">
                      <label for="exampleSelectGender">Ubicacion</label>
                      <select class="form-control" id="ubicacion" name="ubicacion">
                        <?php
                        include('./php/conexion.php');
                        $re = $conexion->query("select * from canchas");
                        while ($f = mysqli_fetch_array($re)) {
                        ?>
                          <option value="<?php echo $f['id']; ?>"><?php echo $f['nombre']; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputName1">Fecha</label>
                      <input type="datetime-local" class="form-control" id="fecha" name="fecha">
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Horas</label>
                      <select class="form-control" id="hora" name="hora">
                        <option value="3:00 pm - 6:00 pm">3:00 pm - 6:00 pm</option>
                        <option value="8:00 pm - 11:00 pm">8:00 pm - 11:00 pm</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Tipo de partido</label>
                      <select class="form-control" id="maximo" name="maximo">
                        <option value="10">5c5 (10)</option>
                        <option value="22">11c11 (22)</option>
                      </select>
                    </div>
                    <input type="hidden" id="id_usuario" name="id_usuario" value=" <?php echo $arregloUsuario['id_usuario']; ?> " class="form-control" required>
                    <button type="submit" class="btn btn-primary me-2">Guardar cambios</button>
                  </form>
                  <?php
                  if (isset($_GET['error'])) {
                  ?>
                    <div class="alert alert-danger" role="alert">
                      <?php echo $_GET['error']; ?>
                    </div>

                  <?php  } ?>
                  <?php
                  if (isset($_GET['success'])) {
                  ?>
                    <div class="alert alert-success" role="alert">
                      Se ha insertado correctamente.
                    </div>

                  <?php  } ?>
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