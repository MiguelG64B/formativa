
<?php
include "./conexion.php";

if (isset($_POST['id_usuario']) && isset($_POST['id_partido']) && isset($_POST['fecha']) && isset($_POST['hora']) &&  isset($_POST['rol'])) {

    $id_usuario = $_POST['id_usuario'];
    $id_partido = $_POST['id_partido'];
    $rol = $_POST['rol'];

    //Esta consulta comprueba si el usuario esta en otro partido a la misma hora y dia (aun no le hago funcionar F)
    $em = $conexion->query("SELECT * FROM partido LEFT JOIN control ON partido.id = control.id_partido  WHERE partido.fecha = '" . $_POST['fecha'] . "'  and partido.hora = '" . $_POST['hora'] . "' and control.id_usuario = '" . $_POST['id_usuario'] . "' and partido.estado = 'Activo' limit 1") or die($conexion->error);
    if (mysqli_num_rows($em) > 0) {
        header("Location: ../detalles.php?id=$id_partido&error=Ya hay un partido en esa cancha en ese margen de horario");
    } else {//
        $conexion->query("insert into control
                (id_partido,id_usuario,rol,estado) values
                (   
                    '$id_partido',
                    '$id_usuario',
                    '$rol',
                    'Pendiente'
                )   ") or die($conexion->error);

        header("Location: ../detalles.php?id=$id_partido&todobien=ya te encuentras registrado");
    }
} else {
    header("Location: ../detalles.php?error");
}

?>