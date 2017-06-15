<?php
//vendor de composer
require "../vendor/autoload.php";
/*
Esta clase genera las conexionses con el API de TextMagic
Para el envio de SMS
*/
class OpenpayObject{
  //keys necesarios para el acceso a la api
  private $id = "mtuapgdbiyibi6mlfbjd";
  private $token = "sk_4e3da69e092f4eee9cc16742f40eee14";


  private $openpay;
  //constructor que inicializa el api con las keys necesarias
  public function __construct(){
    $this->openpay = Openpay::getInstance(
      $this->id,
      $this->token
    );
  }
  //Esta funcion genera un cargo en openpay, recibe el monto del cargo, la descripcion y el cliente(Este es un objeto de tipo cliente)
  public function crearCargo($monto,$descripcion,$cliente,$caducidad){
    $chargeData = array(
      'method' => 'store',
      'amount' => $monto,
      'description' => $descripcion,
      'customer' => $cliente,
      'due_date' => $caducidad
    );
    $charge = $this->openpay->charges->create($chargeData);
    return $charge;
  }
}
