<?php
  require "../vendor/autoload.php";


  $tiempo = date("d")."/".date("m")."/".date("Y")." ".date("g").":".date("i")." ".date("a");
  echo $tiempo;

  $correo = "diegoalejandroene17@gmail.com";
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "ssl";
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465;
  $mail->Username = "tekviaprogramacion@gmail.com";
  $mail->Password = "tekvia123";


  $mail->setFrom('tekviaprogramacion@gmail.com','Tekvia');
  $mail->Subject = "Funcion de cronJob";
  $mail->AltBody = "Esta es la fecha";
  $mail->MsgHTML("$tiempo");
  $mail->AddReplyTo("$correo");
  $mail->AddAddress("$correo");
  $mail->IsHTML(true);
  if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo 'Message has been sent';
  }
  //wget -q -O /dev/null http://mercaditopuertadelsol.com/mercaditoApi/prueba/prueba.php
?>
