<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
//Este archivo recibe las notificaciones de openpay y realiza el procedimiento especifico
//Esta preparado apra que se añadan mas opciones de ser necesarias
$timezone = "America/New_York";
date_default_timezone_set($timezone);
include('../modelo/conexion.php');
    require "../vendor/autoload.php";
$obj = file_get_contents('php://input');
$json = json_decode($obj);
$tipo = $json->type;
$id = $json->transaction->id;
//Selector que permite realizar una accion dependiendo el tipo de notificacion recibida
switch ($tipo) {
  //Procedimiento para notificacion de tipo cargo completado
  case 'charge.succeeded':
    if($json->transaction->status == 'completed'){
      $tabla = "ordenes_pago";
      $condiciones = "WHERE id_openpay = '$id'";
      $resultado = $conexionDb->buscar($tabla,$condiciones);
      while($fila = mysqli_fetch_assoc($resultado)){
        $id_orden = $fila['id_orden'];
      }

      $tabla = "cliente_locales";
      $condiciones = "WHERE id_orden = '$id_orden'";
      $resultado = $conexionDb->buscar($tabla,$condiciones);
      while($fila = mysqli_fetch_assoc($resultado)){
        $tipo_pago = $fila['tipo_pago'];
        $date = $fila['fecha_pago'];
        $id_usuario = $fila['id_cliente'];
      }
      $fecha = date_create($date);
      if($tipo_pago == 1){
        $campos = "estado_pago = 1, id_orden = 0";
      }elseif ($tipo_pago == 2) {
        $campos = "estado_pago = 1, id_orden = 0";
      }elseif ($tipo_pago == 3) {
        date_add($fecha, date_interval_create_from_date_string('30 days'));
        $campos = "id_orden = 0,fecha_pago = '".date_format($fecha,'Y-m-d')."',estado_pago=1";
      }

      $modificar = $conexionDb->modificar($tabla,$campos,$condiciones);
      $resultado = $conexionDb->buscar('clientes',' WHERE id_cliente = '.$id_usuario);
      while($fila = mysqli_fetch_assoc($resultado)){
        $correo = $fila['correo_cliente'];
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
      $mail->Subject = "Confirmacion de pago";
      $mail->AltBody = "Confirmacion de pago";
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
      <h3>Tu siguiente compra se completo</h3><br>
      <h3>".$json->transaction->description."</h3><br>
      <h3>Por el monto de $".$json->transaction->amount."</h3><br>
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
      if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
          echo 'Message has been sent';
      }
    }elseif($json->transaction->status == 'cancelled'){
      $correo = "diegoalejandroene17@gmail.com";
      //Procedimiento de envio de correo por medio de phpmailer
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
      $mail->Subject = "Funcion de cronJob";
      $mail->AltBody = "Esta es la fecha";
      $mail->MsgHTML("que onda que pez :*");
      $mail->AddReplyTo("$correo");
      $mail->AddAddress("$correo");
      $mail->IsHTML(true);


      //Envio de correo
      if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
          echo 'Message has been sent';
      }
    }



    break;
    //No eliminar ya que sera necesario si desea migrar el proyecto a otro host para recibir la aprobacion de webhook
    //Por parte de openpay
  case 'verification':
    //Correo al que decia recibir el codigo de verificacion puede cambiar de ser necesario
    $correo = "diegoalejandroene17@gmail.com";
    //Procedimiento de envio de correo por medio de phpmailer
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
    $mail->Subject = "Funcion de cronJob";
    $mail->AltBody = "Esta es la fecha";
    $mail->MsgHTML("$json->verification_code");
    $mail->AddReplyTo("$correo");
    $mail->AddAddress("$correo");
    $mail->IsHTML(true);


    //Envio de correo
    if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
    break;

  default:
    # code...
    break;
}



?>
