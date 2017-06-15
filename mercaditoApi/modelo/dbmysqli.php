<?php
/*
!!!!!Si borras esto explota todo¡¡¡¡¡
Objeto que genera la conexion a la base de datos
Este incluye las funciones para obtener y modificar datos en la base
*/
class dbmysqli{
  public $conn;
  private $host = "localhost";
  private $usuario = "c0630048";
  private $clave = "mi69nuFAnu";
  private $db = "c0630048_mds";

  public function __construct(){
    $this->conn = new mysqli($this->host,$this->usuario,$this->clave,$this->db) or die("MySQL Connection Error");
  }

  public function insertar($tabla,$campos,$datos){
    if($this->conn->query("INSERT INTO $tabla ($campos) VALUES ($datos)")===TRUE){
      return "true";
    }else{
      return "false";
    }
  }
  public function modificar($tabla,$campos,$condicion){
    $sql = "UPDATE $tabla SET $campos $condicion";
    if($this->conn->query($sql)===TRUE){
      return "true";
    }else{
      return "false";
    }
  }
  public function eliminar($tabla,$condicion){
    if($this->conn->query("DELETE FROM $tabla WHERE $condicion")){
      return "true";
    }else{
      return "false";
    }
  }
  public function buscar($tabla,$condiciones){
    if($condiciones == ""){
      $resultado = $this->conn->query("SELECT * FROM $tabla") or trigger_error($this->conn->error."[$sql]");
      return $resultado;
    }else{
      $sql = "SELECT * FROM ".$tabla." ".$condiciones;
      $resultado = $this->conn->query($sql) or trigger_error($this->conn->error."[$sql]");
      return $resultado;
    }
  }
  public function personalizada($sentencia){
    $resultado = $this->conn->query($sentencia) or trigger_error($this->conn->error."[$sentencia]");
    return $resultado;
  }

  public function prueba(){
    return "hola";
  }

}
