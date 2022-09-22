<?php 
include "conexion.php";
if(isset($_POST['nombre']) &&  isset($_POST['id_usuario']) &&  isset($_POST['apellido']) &&  isset($_POST['telefono'])){ 
    $conexion->query("update usuario set 
    nombre='".$_POST['nombre']."',
    apellido='".$_POST['apellido']."',
    telefono='".$_POST['telefono']."'
    where id=".$_POST['id_usuario']);

    echo "se actualizo";
    header("Location: ../perfil.php?todobien=En la proxima sesion se vera reflejado el cambio");
}   
?>