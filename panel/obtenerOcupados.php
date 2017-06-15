<?php
  include('../mercaditoApi/modelo/conexion.php');
  $consulta = "SELECT locales.id_local,nombre_local,id_cliente,tipo_pago,fecha_pago,id_orden FROM locales INNER JOIN cliente_locales ON locales.id_local = cliente_locales.id_local";
  $arreglo = array();
  $i = 0;
  $resultado = $conexionDb->personalizada($consulta);
  while($fila = mysqli_fetch_assoc($resultado)){
    $arreglo[$i] = $fila;
    $i++;
  }
  echo json_encode($arreglo);



?>
