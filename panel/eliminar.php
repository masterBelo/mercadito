<?php
            include("conection.php");
 		         $local = $_POST['local'];
             $quees = $_POST['quees'];

             $insertar1 = "delete from cliente_locales where id_local = '$local'";
             mysqli_query($conexion,$insertar1);

             $insertar2 = "UPDATE locales SET estado_local='0' WHERE id_local ='$local'";
              mysqli_query($conexion,$insertar2);

            echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=menu.php?on=del'/>";
?>
