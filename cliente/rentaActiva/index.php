<!DOCTYPE html>
<?php
     include("../php/conection.php");
     session_start();
     if(empty($_SESSION['ide'])){
     echo "<script>window.location.href = '../index.php';</script>";
     }
     $id = $_SESSION['ide'];


     $insertar0 = "select * from clientes where id_cliente='$id'";
     $consulta=mysqli_query($conexion,$insertar0);
     while ($row=mysqli_fetch_array($consulta)){

     $ife=$row['identificacion_cliente'];
     }
?>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#CD5F31">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/semantic/semantic.min.css">
    <link rel="stylesheet" href="../assets/css/master.css">
    <link rel="stylesheet" href="../assets/css/menuEstilos.css">
    <link rel="stylesheet" href="../assets/css/activosEstilos.css">
    <link rel="stylesheet" href="../assets/css/estiloForm.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
  </head>
  <body>
    <div class="linea">
    </div>
    <nav>
      <div class="logo">
        <a href="../panel/"><img src="../resources/mercadito.png" alt=""></a>
        <span>Mercadito</span>
      </div>
      <ul id="opciones">
        <li><a href="../rentar/">Rentar local nuevo</a></li>
        <li><a href="../ordenes/">Ordenes de pago</a></li>
        <li><a href="../comprobantes/">Comprobantes</a></li>
        <li><a href="../panel/">perfil</a></li>
      </ul>
      <a href="../php/matar.php" id="botonCerrar" class="ui orange inverted button" ontouchend="this.onclick=fix">Cerrar sesion</a>
      <div class="botonMenu" id="botonMenu">
        <div class="linea1">
        </div>
        <div class="linea2">
        </div>
        <div class="linea3">
        </div>
      </div>
    </nav>
    <aside class="cerrado">
      <ul>
        <li><a href="../rentar/">Rentar local nuevo</a></li>
        <li><a href="../ordenes/">Ordenes de pago</a></li>
        <li><a href="../comprobantes/">Comprobantes</a></li>
        <li><a href="../panel/">perfil</a></li>
        <li><a href="../php/matar.php">Cerrar sesion</a></li>
      </ul>
    </aside>
    <main>
      <div class="contenedor_tabla">
      <table class="ui orange padded table dataTable no-footer">
        <thead>
          <tr>
            <th colspan="4">En esta área podrás ver el vencimiento, fecha de inicio de renta y estatus de tu pago.</th>
          </tr></thead>
          <tbody>
            <?php
              include("conection.php");
                $Activos="SELECT nombre_local, fecha_inicio, fecha_pago, estado_pago FROM clientes INNER JOIN ( SELECT cliente_locales.id_local,nombre_local,id_cliente,tipo_pago,fecha_pago,fecha_inicio,estado_pago FROM cliente_locales INNER JOIN locales ON cliente_locales.id_local = locales.id_local )AS tablan ON clientes.id_cliente = tablan.id_cliente WHERE clientes.id_cliente = $id ORDER BY estado_pago";

                $consulta=mysqli_query($conexion,$Activos);
                while ($row=mysqli_fetch_array($consulta)) {
                  $nombre_local=$row['nombre_local'];
                  $fecha_inicio=$row['fecha_inicio'];
                  $fecha_pago=$row['fecha_pago'];
                  $estado_pago=$row['estado_pago'];
                  echo "<tr>";
                  echo "<td> Local $nombre_local </td>";
                  echo "<td> <div class='fecha1'> $fecha_inicio </div> </td>";
                  echo "<td> <div class='fecha2'> $fecha_pago </div> </td>";
                  if ($estado_pago == 1) {
                    echo "<td class='positive'> Pago realizado </td>";
                  }
                  else {
                      echo " <td class='negative'>  Pago no realizado </td>";
                  }
                  echo "</tr>";
                }
             ?>
          </tbody>

          <tfoot>
          </tfoot>
        </table>
        </div>
    </main>
  </body>
  <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="../assets/js/menuJs.js"></script>
    <script src="../assets/semantic/semantic.min.js"></script>
</html>
