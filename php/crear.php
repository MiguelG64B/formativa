<?php 
include "./conexion.php";

if(isset($_POST['id_usuario']) && isset($_POST['nombre']) &&  isset($_POST['descripcion'])   &&  isset($_POST['ubicacion'])
&&  isset($_POST['fecha']) &&  isset($_POST['hora']) &&  isset($_POST['maximo'])){

    $id_usuario=$_POST['id_usuario'];
    $nombre=$_POST['nombre'];
    $descripcion=$_POST['descripcion'];
    $ubicacion=$_POST['ubicacion'];
    $fecha=$_POST['fecha'];
    $hora=$_POST['hora'];
    $maximo=$_POST['maximo'];

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
                )   ")or die($conexion->error);
                header("Location: ../crear.php?success");    
}else{
    header("Location: ../crear.php?error=Favor de llenar todos los campos");
}

?>