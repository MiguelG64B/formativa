<?php 
include "conexion.php";
if(isset($_POST['id_usuario']) && isset($_POST['nombre']) &&  isset($_POST['descripcion'])   &&  isset($_POST['ubicacion'])
&&  isset($_POST['fecha']) &&  isset($_POST['hora']) &&  isset($_POST['poblacion']) &&  isset($_POST['maximo']) &&  isset($_POST['id_partido'])&&  isset($_POST['estado'])){
    $id_partido=$_POST['id_partido'];
    $conexion->query("update partido set 
    id_usuario='".$_POST['id_usuario']."',
    nombre='".$_POST['nombre']."',
    descripcion='".$_POST['descripcion']."',
    ubicacion='".$_POST['ubicacion']."',
    fecha='".$_POST['fecha']."',
    hora='".$_POST['hora']."',
    poblacion='".$_POST['poblacion']."',
    maximo='".$_POST['maximo']."',
    estado='".$_POST['estado']."'
    where id=".$_POST['id_partido']);

    echo "se actualizo";
    header("Location: ../editarpartido.php?id=$id_partido&todobien=En la proxima sesion se vera reflejado el cambio");
}   
else{
    header("Location: ../editarpartido.php?id=$id_partido&error=Favor de llenar todos los campos");
}
?>