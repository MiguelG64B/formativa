<?php 
include "conexion.php";
if(isset($_POST['estado']) &&  isset($_POST['id_control']) &&  isset($_POST['id_partido'])){ 

    $estado=$_POST['estado'];
    $id_partido=$_POST['id_partido'];
    $id_control=$_POST['id_control'];
      
    if($estado=="Confirmado"){
        $conexion->query("update partido set poblacion =poblacion +'1' where poblacion!=maximo and id=".$id_partido  )or die($conexion->error);   
        $conexion->query("update control set estado ='$estado' where id=".$id_control  )or die($conexion->error);
        header("Location: ../editarpartido.php?id=$id_partido&todobien=En la proxima sesion se vera reflejado el cambio"); 
    }else{
        if($estado=="Rechazado"){ 
            $conexion->query("update control set estado ='$estado' where id=".$id_control  )or die($conexion->error);
            header("Location: ../editarpartido.php?id=$id_partido&todobien=El usuario fue rechazado"); 
        }else{
            $conexion->query("update control set estado ='$estado' where id=".$id_control  )or die($conexion->error);
            header("Location: ../editarpartido.php?id=$id_partido&todobien=El usuario fue rechazado"); 
        }   
        header("Location: ../editarpartido.php?id=$id_partido&error=Se realizo la accion");  
    }
}   else{
    header("Location: ../editarpartido.php?id=$id_partido&error=Favor de llenar todos los campos");
}
?>