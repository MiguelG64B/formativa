<?php
include "./conexion.php";

if (
    isset($_POST['id_usuario']) && isset($_POST['nombre']) &&  isset($_POST['descripcion'])   &&  isset($_POST['ubicacion'])
    &&  isset($_POST['fecha']) &&  isset($_POST['hora']) &&  isset($_POST['maximo'])
) {
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $ubicacion = $_POST['ubicacion'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $maximo = $_POST['maximo'];

    $em = $conexion->query("SELECT * FROM partido WHERE fecha = '".$_POST['fecha']."'  and hora = '".$_POST['hora']."'  and ubicacion = '".$_POST['ubicacion']."' and estado = 'Activo' limit 1") or die($conexion->error);
    if (mysqli_num_rows($em) > 0) {
        header("Location: ../crear.php?error=Ya hay un partido en esa cancha en ese margen de horario");
    } 
    else {
        $conexion->query("insert into partido
                (id_usuario,nombre,descripcion,ubicacion,fecha,hora,poblacion,maximo,estado) values
                (
                    '$id_usuario',
                    '$nombre',
                    '$descripcion',
                    '$ubicacion',
                    '$fecha',
                    '$hora',
                    '1',
                    '$maximo',
                    'Activo'
                )   ") or die($conexion->error);
        header("Location: ../crear.php?success");
    }
} else {
    header("Location: ../crear.php?error=Favor de llenar todos los campos");
}
