<?php
include('conexionTextoV3.php');
$mensajero = new conexionTextoV3();
$telefono = $_POST['celPro'];
$mensaje = $_POST['txtPro'];
$mensajero->enviarMensaje($telefono,$mensaje);
?>
