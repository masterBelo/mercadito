<?php
//Este archivo se ejecutara por medio de un cronjob todos los dias a las 8:00PM hora mexico
//Para enviar un mensaje recordando el pago con la orden de pago en el
//Solo se enviara "pendiente" dias seguidos de no ser asi se eliminara el cliente y todos los datos relacionados
//Carga de librerias y paquetes
require "../vendor/autoload.php";
//Carga de las clases necesarias para el funcionamiento
require_once('Googl.class.php');
include('../modelo/conexion.php');
include('conexionTextoV3.php');
include('OpenpayObject.php');

//Inicializacion de objetos necesarios
$objeto = new conexionTextoV3();
$open = new OpenpayObject();

//Consulta para obtener los datos de los clientes con deuda
$consulta = "SELECT * FROM (SELECT cliente_locales.id_cliente, nombre_cliente,correo_cliente,celular_cliente, id_local, tipo_pago, fecha_pago, fecha_inicio, id_orden, estado_pago FROM cliente_locales INNER JOIN clientes ON clientes.id_cliente = cliente_locales.id_cliente)as tablan INNER JOIN locales ON tablan.id_local = locales.id_local";
$arreglo = array();
$i = 0;
$resultado = $conexionDb->personalizada($consulta);
while($fila = mysqli_fetch_assoc($resultado)){
  switch ($fila['tipo_pago']) {
    case 1:
      $fechaActual = strtotime(date('Y-m-d'));
      $fechaUso = strtotime($fila['fecha_inicio']);
      if($fila['estado_pago'] == 0 && $fechaActual >= $fechaUso){
        $borrar = $conexionDb->eliminar('cliente_locales',"id_local = ".$fila['id_local']." AND id_cliente = ".$fila['id_cliente']);
      }
      break;
    case 2:
      $fechaActual = strtotime(date('Y-m-d'));
      $fechaUso = strtotime($fila['fecha_inicio']);
      if($fila['estado_pago'] == 0 && $fechaActual >= $fechaUso){
        $borrar = $conexionDb->eliminar('cliente_locales',"id_local = ".$fila['id_local']." AND id_cliente = ".$fila['id_cliente']);
      }
      break;
    case 3:
      $telefono = $fila['celular_cliente'];
      $correo = $fila['correo_cliente'];
      $fechaActual = strtotime(date('Y-m-d'));
      $fechaPago = strtotime($fila['fecha_pago']);
      if($fila['estado_pago'] == 0 && $fechaActual >= $fechaPago){
        $borrar = $conexionDb->eliminar('cliente_locales',"id_local = ".$fila['id_local']." AND id_cliente = ".$fila['id_cliente']);
      }else{
        $fechaPagoM = strtotime('-3 day',$fechaPago);
        if($fechaActual>=$fechaPagoM){
          if($fila['id_orden']==0){
            $cliente = array(
              'name'=>$fila['nombre_cliente'],
              'phone_number'=>$fila['celular_cliente'],
              'email'=>$fila['correo_cliente']
            );
            $precio = 900;
            $descripcion = "Class x 1 dia por local ".$fila['nombre_local'];
            $fechaI = date('Y-m-d',strtotime('-1 day',$fechaPago));
            $horaI = "23:59:59-05:00";
            $fechaIso = $fechaI."T".$horaI;
            $caducidad = $fechaIso;
            $cargo = $open->crearCargo($precio,$descripcion,$cliente,$caducidad);
            $link = "https://sandbox-dashboard.openpay.mx/paynet-pdf/mtuapgdbiyibi6mlfbjd/".$cargo->payment_method->reference;
            $googl = new Googl('AIzaSyC44Ry7bvkkkX8FTHSNnVXfKeB5YTTfAFI');
            $link = $googl->shorten($link);
            unset($googl);
            $tabla = "ordenes_pago";
            $campos = "openpay_url,id_openpay";
            $datos = "'$link','$cargo->id'";
            $insercion = $conexionDb->insertar($tabla,$campos,$datos);
            $id_orden = $conexionDb->conn->insert_id;
            $tabla = "cliente_locales";
            $campos = "estado_pago = 0,id_orden = ".$id_orden;
            $condicion = "WHERE id_cliente = ".$fila['id_cliente']." AND id_local = ".$fila['id_local'];
            $modificacion = $conexionDb->modificar($tabla,$campos,$condicion);
          }elseif($fila['id_orden']<>0 && $fila['estado_pago']==0){
            $resultado = $conexionDb->buscar('ordenes_pago','WHERE id_orden = '.$fila['id_orden']);
            while($f = mysqli_fetch_assoc($resultado)){
              $link = $f['openpay_url'];
            }
          }

          $mail = new PHPMailer();

          //modificar en caso de utilizar un correo distinto a gmail
          $mail->IsSMTP();
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = "ssl";
          $mail->Host = "smtp.gmail.com";
          $mail->Port = 465;

          //Datos de acceso al smtp
          $mail->Username = "tekviaprogramacion@gmail.com";
          $mail->Password = "tekvia123";

          //Correo e informacion del remitente
          $mail->setFrom('tekviaprogramacion@gmail.com','Tekvia');
          //Datos y contenido del correo
          $mail->Subject = "Formato de pago";
          $mail->Subject = "Mercadito puerta del sol";
          $mail->MsgHTML("
            <!DOCTYPE html>
            <html>
              <head>
                <meta charset='utf-8'>
                <title></title>
              </head>
              <body style='background-color:#F2F2F2!important;width:92%!important;margin-left:4px!important;position:absolute!important;'>
            <div style='color:#2E2E2E!important;font-family:sans-serif!important;font-size:12px!important;font-weight:normal!important;'>
            <div style='background-color:orange!important;width:100%!important;height:75px!important;'>
              <img style='height:50px!important;max-width: 60px!important;margin-top:10px!important;margin-left:5px!important;' src='http://mercaditopuertadelsol.com/cliente/resources/mercadito.png'>
            </div>
            <div style='color:#2E2E2E!important;font-family:sans-serif!important;margin:8px!important;font-size:12px!important;font-weight:normal!important;'>
            <h1>Mercadito Puerta del Sol</h1>
            <div style='width:100%!important;height:2px!important;background-color:#848484!important;'></div>
            <h3>Hola!!!!</h3><br>
            <h3>Mercadito Puerta del Sol te invita a realizar el pago ".$link."</h3><br>
            <div style='width:100%!important;height:2px!important;background-color:#848484!important;'></div>
            <h2>Ingresa ahora</h2><a style='text-decoration:none!important;' href='http://mercaditopuertadelsol.com/cliente/' target='_blank'><div style='margin-bottom:15px!important;text-align:center!important;margin-left:35px!important;background-color:orange!important;border-radius:5px!important;border-color:orange!important;color:#fff!important;font-size:20px!important;width:150px!important;'>IR</div></a>
            </div>
            <div style='width:100%!important;height:2px!important;background-color:#848484!important;'></div><br>
            <div style='background-color:#2E2E2E!important;height:45px!important;width:100%!important;text-align:center!important;color:#fff!important;font-size:11px!important;'>
              <img style='height:20px!important; margin-top:8px!important;' src='http://mercaditopuertadelsol.com/cliente/resources/tekviacloud.png'>
              <br>Design by Tekvia
            </div>
            <div style='width:100%!important;height:10px!important;background-color:#2E2E2E!important;'></div>
            </div>
            </body>
            </html>
          ");
          $mail->AddReplyTo("$correo");
          $mail->AddAddress("$correo");
          $mail->IsHTML(true);


          //Envio de correo
          $mail->send();
          unset($mail);

          //Mensaje a enviar
          $mensaje = "Mercadito Puerta del Sol te invita a realizar el pago ".$link;
          //$objeto->enviarMensaje($telefono,$mensaje);

        }
      }
      break;
    default:
      # code...
      break;
  }

}
