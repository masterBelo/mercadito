<?php
		    include("conection.php");
            
            $correo = $_POST['user'];
            $password = $_POST['password'];
            
			$insertar1 = "select * from usuarios where username = '$correo'";
            $consulta=mysqli_query($conexion,$insertar1);

              
            while ($row=mysqli_fetch_array($consulta)) {
              
              $id=$row['id_usuario'];    
              $comprobacion=$row['username'];
              $contrasenia=$row['contrasenia'];
              $tekvia=$row['tekvia'];
    
            }

            if($comprobacion==$correo && $password==$contrasenia && $tekvia=='on'){
                session_start();
                $_SESSION['ide'] = $id;
                 echo "<meta HTTP-EQUIV='REFRESH' CONTENT='0;URL=menu.php'/>";
            }
           
            else{
                header( "HTTP/1.1 301 Moved Permanently" ); 
                header("Location: login.php");
            }
            

?>