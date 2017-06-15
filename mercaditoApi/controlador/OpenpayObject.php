<?php
//vendor de composer
require "../vendor/autoload.php";
/*
Esta clase genera las conexionses con el API de TextMagic
Para el envio de SMS
*/
class OpenpayObject{
  private $sid = "AC8da101d6b7b794bbca955be47a01b8b4";
  private $token = "48703ac1820b5d2e13c21a393284d630";
  private $openpay;

  public function __construct(){
    $this->openpay = Openpay::getInstance(
      'mtuapgdbiyibi6mlfbjd',
      'sk_4e3da69e092f4eee9cc16742f40eee14'
    );
  }
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
