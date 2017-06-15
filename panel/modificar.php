<?php
            include("conection.php");
            mysqli_select_db($conexion);
            $idmod = $_POST['idmod'];
            $nuevomod = $_POST['nuevomod'];

            $insertar0 = "UPDATE locales SET nombre_local='$nuevomod' WHERE id_local='$idmod'";
            mysqli_query($conexion,$insertar0);

?>
