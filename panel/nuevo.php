<?php
            include("../conection.php");
            mysqli_select_db($conexion);
 		        $nuevomod = $_POST['nuevomod'];

            $insertar1 = "INSERT INTO locales(estado_local, nombre_local) VALUES ('0', '$nuevomod')";
            mysqli_query($conexion,$insertar1);

?>
