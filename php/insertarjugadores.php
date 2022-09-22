
<?php
include "./conexion.php";

if (isset($_POST['id_usuario']) && isset($_POST['id_partido']) &&  isset($_POST['rol'])) {

    $id_usuario = $_POST['id_usuario'];
    $id_partido = $_POST['id_partido'];
    $rol = $_POST['rol'];

    $conexion->query("insert into control
                (id_partido,id_usuario,rol,estado) values
                (   
                    '$id_partido',
                    '$id_usuario',
                    '$rol',
                    'Pendiente'
                )   ") or die($conexion->error);
    $conexion->query("update partido set poblacion =poblacion +'1' where id=".$id_partido  )or die($conexion->error);   
     
    header("Location: ../detalles.php?id=$id_partido&todobien=ya te encuentras registrado");
} else {
    header("Location: ../detalles.php?error");
}
  
?>