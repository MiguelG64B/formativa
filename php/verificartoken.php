<?php
include "conexion.php";
$email = $_POST['email'];
$token = $_POST['token'];
$codigo = $_POST['codigo'];
$res = $conexion->query("select * from passwords where 
        email='$email' and token='$token' and codigo=$codigo") or die($conexion->error);
$correcto = false;
if (mysqli_num_rows($res) > 0) {
  $fila = mysqli_fetch_row($res);
  $fecha = $fila[4];
  $fecha_actual = date("Y-m-d h:m:s");
  $seconds = strtotime($fecha_actual) - strtotime($fecha);
  $minutos = $seconds / 60;
  /* if($minutos > 10 ){
            echo "token vencido";
        }else{
            echo "todo correcto";
        }*/
  $correcto = true;
} else {

  $correcto = false;
  header("Location: ../reset.php?email=$email&token=$token");
}

?>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Restablecer </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">

        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h4>Nueva contraseña</h4>
              <?php if ($correcto) { ?>
              <form class="pt-3" method="post" action="./cambiarpassword.php">
                <div class="form-group">
                <label for="c" class="form-label">Ingresa tu nueva contraseña</label>
                  <input type="password" class="form-control" id="c" name="p" pattern=".{3,10}" required>
                </div>
                <div class="form-group">
                <label for="c" class="form-label">Confirmar contraseña</label>
                  <input type="password" class="form-control" id="c" name="p2" pattern=".{3,10}" required>
                </div>
                <input type="hidden" class="form-control" id="c" name="email" value="<?php echo $email; ?>">
                <div class="mt-3">
                  <button type="submit" class="text-center btn btn-primary btn-block">Cambiar contraseña</button>
                </div>
              </form>
              <?php } else { ?>
          <div class="alert alert-danger">Código incorrecto o vencido, vuelve a ingresar al link de tu correo</div>
        <?php } ?>
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
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../js/dashboard.js"></script>
  <script src="../js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>