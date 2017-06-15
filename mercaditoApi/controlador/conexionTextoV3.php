<?php
//vendor de composer
require "../vendor/autoload.php";


/*
Esta clase genera las conexionses con el API de TextMagic
Para el envio de SMS
*/
class conexionTextoV3{
  private $sid = "AC8da101d6b7b794bbca955be47a01b8b4";
  private $token = "48703ac1820b5d2e13c21a393284d630";
  private $client;

  public function __construct(){
    $this->client = new Twilio\Rest\Client($this->sid,$this->token);
  }
  public function enviarMensaje($telefono,$mensaje){
    $message = $this->client->messages->create(
      $telefono,
      array(
        'from' => '+12107141665 ',
        'body' => $mensaje
      )
    );
    return $message->sid;
  }
}
