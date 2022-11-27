<?php 
include "conexion.php";
if(isset($_POST['resultado']) &&  isset($_POST['comentarios']) &&  isset($_POST['id_partido']) &&  isset($_POST['id_usuario'])){ 

    $resultado=$_POST['resultado'];
    $comentarios=$_POST['comentarios'];
    $id_partido=$_POST['id_partido'];
    $id_usuario=$_POST['id_usuario'];

    $conexion->query("insert into resultados
    (id_partido,resultado,comentarios) values
    (
        '$id_partido',
        '$resultado',
        '$comentarios'
    )   ")or die($conexion->error);
    $conexion->query("update partido set estado ='Finalizado' where id=".$id_partido  )or die($conexion->error); 
    header("Location: ../reporte.php?id=$id_partido&todobien=En la proxima sesion se vera reflejado el cambio");

}   else{
    header("Location: ../reporte.php?id=$id_partido&error=Favor de llenar todos los campos");
}
?>