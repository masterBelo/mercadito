<?php
  include('conexion.php');
  $fecha = $_GET['fechaActual'];
  $fecha = date("Y-m-d",strtotime($fecha));
  $nuevaFecha = date("Y-m-d",strtotime('+30 day',strtotime($fecha)));
  switch ($_GET['tipo']) {
    case 'normal':
      $tipo = 1;
      $consulta = "SELECT * FROM  locales LEFT JOIN cliente_locales ON locales.id_local = cliente_locales.id_local WHERE tipo_local <> $tipo or `fecha_inicio` <= '$fecha' AND `fecha_pago` >= '$fecha'";
      break;
    case 'class':
      $tipo = 2;
      $consulta = "SELECT * FROM  locales LEFT JOIN cliente_locales ON locales.id_local = cliente_locales.id_local WHERE tipo_local <> $tipo or `fecha_inicio` = '$fecha'";
      break;
    case 'ultra':
      $tipo = 3;
      $consulta = "SELECT * FROM `cliente_locales` right join locales ON cliente_locales.id_local = locales.id_local WHERE `fecha_pago`<> '' OR `tipo_local` <> 3";
      break;
    default:
      # code...
      break;
  }


  $arreglo = array();
  $i = 0;
  $resultado = $conexionDb->personalizada($consulta);
  while($fila = mysqli_fetch_assoc($resultado)){
    $arreglo[$i] = $fila;
    $i++;
  }
  echo json_encode($arreglo);

?>
