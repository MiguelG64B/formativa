
<?php 
   include "conexion.php";
   if( isset($_POST['nombre'] ) && isset($_POST['email']) && isset($_POST['password'] ) 
    && isset($_POST['password2'] ) &&  isset($_POST['apellido']) &&  isset($_POST['telefono'])){
       
        $em= $conexion->query("SELECT email FROM usuario WHERE email = '".$_POST['email']."'")or die($conexion->error);
        if(mysqli_num_rows($em)>0){
            header("Location: ../registro.php?error=correo ya registrado");
        }

        else{
        if($_POST['password'] == $_POST['password2'] ){
            $name=$_POST['nombre'];
            $email=$_POST['email'];
            $Apellido=$_POST['apellido'];
            $telefono=$_POST['telefono'];
            $pass=sha1($_POST['password']);
                $conexion->query("insert into usuario (nombre,apellido,telefono,email,password,img_perfil,nivel) 
                    values('$name','$Apellido','$telefono','$email','$pass','default.jpg','cliente')  ")or die($conexion->error);
                    header("Location: ../login.php");
        }else{
           
            
        header("Location: ../registro.php?error=Contraseñas incorrectas");
        }
    }
}
?>