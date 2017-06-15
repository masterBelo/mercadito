<?php
            include("../conection.php");
            mysqli_select_db($conexion);
 		        $local = $_POST['local'];
		        $nombre = $_POST['nombre'];
            $telefono = $_POST['telefono'];
            $celular = $_POST['celular'];
            $correo = $_POST['correo'];
            $domicilio = $_POST['domicilio'];
            $suscripcion = $_POST['suscripcion'];

            $ife = $_FILES['ife'];
            $contrato = $_FILES['contrato'];

            $ifen = $_FILES['ife']['name'];
            $contraton = $_FILES['contrato']['name'];

            $fecha = date("Y-m-d");

            $carpeta = "LOCAL-$local-CONTRATO($fecha)";
            if (!file_exists("$carpeta")) {
            mkdir($carpeta, 0777, true);
           }

            $destino1 = "$carpeta/"."$ifen";
            copy($_FILES['ife']['tmp_name'],$destino1);
            $destino2 = "$carpeta/"."$contraton";
            copy($_FILES['contrato']['tmp_name'],$destino2);

           $insertar1 = "INSERT INTO clientes(nombre_cliente, telefono_cliente, celular_cliente, correo_cliente, domicilio_cliente, identificacion_cliente, contrato_cliente) VALUES ('$nombre', '$telefono', '$celular', '$correo', '$domicilio', '$destino1', '$destino2')";
           mysqli_query($conexion,$insertar1);

           $insertar2 = "select * from clientes order by id_cliente DESC LIMIT 1";
           $consulta=mysqli_query($conexion,$insertar2);
           while ($row=mysqli_fetch_array($consulta)) {
            $id_cliente=$row['id_cliente'];
            }

           $insertar3 = "INSERT INTO cliente_locales(id_cliente, id_local, tipo_pago, fecha_pago) VALUES ('$id_cliente', '$local', '$suscripcion', '$fecha')";
           mysqli_query($conexion,$insertar3);

          $insertar4 = "UPDATE locales SET estado_local='1' WHERE id_local ='$local'";
                    mysqli_query($conexion,$insertar4);

        

?>
