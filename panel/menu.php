<!DOCTYPE html>
<?php
     include("conection.php");
     session_start();
     if(empty($_SESSION['ide'])){
      echo "<script>window.location.href = 'login.php';</script>";
    }
?>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/estiloMenu.css">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>Mercadito</title>
  </head>
    <?php
    $on = ($_REQUEST['on']);
    if($on == 'res'){
      echo "<script>window.location.href = '#popup2';</script>";
    }elseif ($on == 'del') {
      echo "<script>window.location.href = '#popup3';</script>";
    }
    else{
    $registro = $_POST['registro'];
    if($registro=='1'){
    echo "<body onload= \"opcion(event, 'RES')\">";
  }else{echo "<body>";}}
    ?>
      <div class="logout"><a href="matar.php"><img class="imgLogout" src="resources/Logout.png"></a></div>
      <div class="imgArriba">
<img class="imgArribaArriba" id="imagencita" src="">
      </div><br>
    <div class="tab">
        <a href="#" id="cambio1"> <button class="tablinks" onclick="opcion(event, 'RES')">REGISTRO</button></a>
        <a href="#" id="cambio2"> <button class="tablinks" onclick="opcion(event, 'CRO')"<?php if($registro=='1'){ echo "disabled"; }?>>CROBRANZA</button>
        <a href="#" id="cambio3"> <button class="tablinks" onclick="opcion(event, 'BAL')"<?php if($registro=='1'){ echo "disabled"; }?>>BALANCE</button>
        <a href="#" id="cambio4"> <button class="tablinks" onclick="opcion(event, 'CON')"<?php if($registro=='1'){ echo "disabled"; }?>>CONFIGURACION</button>
      <a style="float:right" href="menu.php?on=mercadito"><?php if($registro=='1'){ echo "<img class='onoff' src='resources/on.png' id='on'></a>";}else{ echo "<img class='onoff' src='resources/off.png' id='on'></a>";} ?>
    </div>

<footer class="footer">
Copyright © Tekvia 2017 Todos los derechos reservados
</footer>
            <form id="fileUploadForm" method="post" name="formulario" enctype="multipart/form-data">
    <div id="RES" class="tabcontent">
      <section id="registro">
      <div class="parteI">
      <p>A CONTINUACION REGISTRA UN  CLIENTE ANEXANDO LA INFORMACIÓN NESESARIA </br> Y EL TIPO DE SUSCRIPCIÓN.</p>
        <select class="seleccito" name="local">
           <?php
            include("conection.php");
            $registro = $_POST['registro'];
            $local = $_POST['local'];
            if($registro=='1'){
            echo"<option value='$local'>LOCAL $local</option>";
            }else{
            echo "<option selected value='0' disabled>SELECCIONE UN LOCAL</option>";
            mysqli_select_db($conexion);
            $insertar0 = "select * from locales";
            $consulta=mysqli_query($conexion,$insertar0);
            while ($row=mysqli_fetch_array($consulta))
            {
            $id_local=$row['id_local'];
            $nombre_local=$row['nombre_local'];
            $estado_local=$row['estado_local'];
            if($estado_local==0){
            echo"<option value='$id_local'>LOCAL $nombre_local</option>";
            }else{
                echo"<option value='$id_local' disabled>LOCAL $nombre_local (no disponible)</option>";
            }
            }
            }
            ?>
           </select>

        </br>
      <input type="text" placeholder="NOMBRE COMPLETO" name="nombre" maxlength="60" required/> </br>
      <input type="text" placeholder="TELEFONO FIJO" name="telefono" maxlength="10" onkeypress="return justNumbers(event);" required /> </br>
      <input type="text" placeholder="CELULAR" name="celular" maxlength="10" onkeypress="return justNumbers(event);" required /> </br>
      <input type="mail" placeholder="CORREO" name="correo" maxlength="60" required /> </br>
      <input type="text" placeholder="DOMICILIO" name="domicilio" maxlength="60" required /> </br>
        <select class="seleccito" name="suscripcion">
          <option value="2">1 DÍA X 90 PESOS</option>
          <option value="1">1 DÍA X 50 PESOS</option>
          <option value="3">1 MES X 900 PESOS</option>
        </select>
      <button type="submit" name="button" id="btnSubir">REGISTRAR</button>
      </div>
      <div class="parteII">
        <div class="fila1">
            <input type="text" placeholder="IFE SUSCRIPTOR" name="ife1" id="ife1"  required disabled/> <label for="ife" class="botoncillo">ADJUNTAR</label>
        </div>
        <div class="fila2">
          <input type="text" placeholder="CONTRATO" name="contrato1" id="contrato1" required disabled/> <label for="contrato" class="botoncillo">ADJUNTAR</label>
        </div>
          <div class="notoy">
          <input type="file" name="ife" id="ife" onchange="ife1.value = this.value">
          <input type="file" name="contrato" id="contrato" onchange="contrato1.value = this.value">
          </div>
    </div>
      </section>
    </div>
 </form>
    <div id="CRO" class="tabcontent">
      <div class="Subtab">
        <button id="show1">LOCALES CORRIENTE</button>
        <button id="show2">LOCALES DEUDA</button>
        <button id="show3">LOCALES DISPONIBLES</button>
        <button id="show4">CROQUIS</button>
      </div>
      <div id="element1" style="display: none;" class="localesCorriente">
          <div class="rayita"></div>
          <div class="thContent">
          <div  class="thContent1"><div class="txtC">LOCAL</div></div>
          <div  class="thContent2"><div class="txtC">LOCATARIO</div></div>
          <div  class="thContent3"><div class="txtC">TELEFONO</div></div>
          <div  class="thContent4"><div class="txtC">ACCIONES</div><div class="accionesT">&nbsp;&nbsp;&nbsp; PAGADO&nbsp; &nbsp;&nbsp; VER PEFIL&nbsp;&nbsp; &nbsp; ENVIAR</div></div>
          </div>
          <div class="tablita">
            <div class="azul11"><div class="azul21"></div></div>
            <div class="azul12"><div class="azul22"></div></div>
            <div class="azul13"><div class="azul23"></div></div>
            <div class="azul14"><div class="azul24"></div></div>
        <table class="tableM">

            <tr>
             <th></th>
             <th></th>
             <th></th>
             <th></th>
            </tr>

                  <?php
		          include("conection.php");
              $fechahoy = date("Y-m-d");
			        $insertar2 = "SELECT * FROM clientes INNER JOIN ( SELECT cliente_locales.id_local,nombre_local,id_cliente,tipo_pago,fecha_pago FROM cliente_locales INNER JOIN locales ON cliente_locales.id_local = locales.id_local )AS tablan ON clientes.id_cliente = tablan.id_cliente WHERE fecha_pago > CURRENT_DATE";
              $consulta=mysqli_query($conexion,$insertar2);
              while ($row=mysqli_fetch_array($consulta)) {
              $id_local=$row['nombre_local'];
              $nombre_cliente=$row['nombre_cliente'];
              $celular_cliente=$row['celular_cliente'];
              $correo_cliente=$row['correo_cliente'];
              $domicilio_cliente=$row['domicilio_cliente'];
              $identificacion_cliente=$row['identificacion_cliente'];
              $contrato_cliente=$row['contrato_cliente'];
              $fotirris = $row['imagen'];
                  echo "<tr class='trT'>";
                  echo "<td class='td1'>LOCAL $id_local</td>";
                  echo "<td class='td2'>$nombre_cliente</td>";
                  echo "<td class='td3'>$celular_cliente</td>";
                  echo "<td class='td4'><img class='imgT' src='resources/palomita.png'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                  echo "<a href='#popup1' class='popup-link' id='soyel$id_local'><img class='imgT' src='resources/user.png'></a>
                  <script>
                  $(document).ready(function() {
                  $('#soyel$id_local').click(function(){
                  $('#nombreP1').html('$nombre_cliente');
                  $('#domicilioP1').html('$domicilio_cliente');
                  $('#correoP1').html('$correo_cliente');
                  $('#telefonoP1').html('$celular_cliente');
                  $('#localP1').html('LOCAL <br>$id_local');
                  $('#c21').attr('href', 'archivos/$identificacion_cliente');
                  $('#c22').attr('href', 'archivos/$contrato_cliente');
                  $('#fotirrisLocal').attr('src', 'archivos/LOCALES/sundoormarket.png');
                  });
                  });
                  </script>";
                  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                  echo "<img class='imgT' src='resources/message.png'></td>";
                  echo "</tr>";
            }
                  ?>

          </table>
          </div>

          <div class="babilonia">
          <button class="exportarPDF">EXPORTAR A PDF</button>
          </div>
        </div>
      <div id="element2" style="display: none;" class="localesCorriente">
         <div class="rayita"></div>
          <div class="thContent">
          <div  class="thContent1"><div class="txtC">LOCAL</div></div>
          <div  class="thContent2"><div class="txtC">LOCATARIO</div></div>
          <div  class="thContent3"><div class="txtC">TELEFONO</div></div>
          <div  class="thContent4"><div class="txtC">ACCIONES</div><div class="accionesT">&nbsp;&nbsp;&nbsp; PAGADO&nbsp; &nbsp;&nbsp; VER PEFIL&nbsp;&nbsp; &nbsp; ENVIAR</div></div>
          </div>
          <div class="tablita">
            <div class="azul11"><div class="azul21"></div></div>
            <div class="azul12"><div class="azul22"></div></div>
            <div class="azul13"><div class="azul23"></div></div>
            <div class="azul14"><div class="azul24"></div></div>
        <table class="tableM">
            <tr>
             <th></th>
             <th></th>
             <th></th>
             <th></th>
            </tr>
            <?php
		    include("conection.php");
            $fechahoy = date("Y-m-d");
			$insertar2 = "SELECT * FROM clientes INNER JOIN ( SELECT cliente_locales.id_local,nombre_local,id_cliente,tipo_pago,fecha_pago FROM cliente_locales INNER JOIN locales ON cliente_locales.id_local = locales.id_local )AS tablan ON clientes.id_cliente = tablan.id_cliente WHERE fecha_pago <= CURRENT_DATE";
            $consulta=mysqli_query($conexion,$insertar2);
            while ($row=mysqli_fetch_array($consulta)) {
              $id_local=$row['nombre_local'];
              $nombre_cliente=$row['nombre_cliente'];
              $celular_cliente=$row['celular_cliente'];
              $correo_cliente=$row['correo_cliente'];
              $domicilio_cliente=$row['domicilio_cliente'];
              $identificacion_cliente=$row['identificacion_cliente'];
              $contrato_cliente=$row['contrato_cliente'];
              $fotirris = $row['imagen'];
                  echo "<tr class='trT'>";
                  echo "<td class='td1'>LOCAL $id_local</td>";
                  echo "<td class='td2'>$nombre_cliente</td>";
                  echo "<td class='td3'>$celular_cliente</td>";
                  echo "<td class='td4'><img class='imgT' src='resources/tache.png'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

                  echo "<a href='#popup1' class='popup-link' id='soyel$id_local'><img class='imgT' src='resources/user.png'></a>
                  <script>
                  $(document).ready(function() {
                  $('#soyel$id_local').click(function(){
                  $('#nombreP1').html('$nombre_cliente');
                  $('#domicilioP1').html('$domicilio_cliente');
                  $('#correoP1').html('$correo_cliente');
                  $('#telefonoP1').html('$celular_cliente');
                  $('#localP1').html('LOCAL <br>$id_local');
                  $('#c21').attr('href', 'archivos/$identificacion_cliente');
                  $('#c22').attr('href', 'archivos/$contrato_cliente');
                  $('#fotirrisLocal').attr('src', 'archivos/LOCALES/sundoormarket.png');
                  });
                  });
                  </script>
                  ";
                  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <img class='imgT' src='resources/message.png'></td>";
                  echo "</tr>";
            }
                  ?>
          </table>
          </div>

          <div class="babilonia">
          <button class="exportarPDF">EXPORTAR A PDF</button>
          </div>
        </div>
      <div id="element3" style="display: none;" class="localesDisponibles">
        <div class="rayita"></div>
          <div class="thContent">
          <div  class="thContent1"><div class="txtC">LOCAL</div></div>
          <div  class="thContent2"><div class="txtC">ACCIONES</div></div>
          <div  class="thContent3">.</div>
          <div  class="thContent4"><div class="txtC1">EXPORTAR A PDF</div>
          </div>
        </div>
           <div class="tablita">
          <table class="tablaLD">
               <thead>
              <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
              </tr>
              </thead>
              <tbody>
                  <?php
		    include("conection.php");
			  $insertar1 = "select * from locales";
            $consulta=mysqli_query($conexion,$insertar1);
            while ($row=mysqli_fetch_array($consulta)) {
              $id_local=$row['id_local'];
              $nombre_local=$row['nombre_local'];
              $estado_local=$row['estado_local'];

                  echo "<tr class='trLD'>";
                  echo "<td class='td12 trT2'>LOCAL $nombre_local</td>";

                  if($estado_local==0){echo "<td class='td12'><a href='#popup' class='popup-link' id='soy$id_local'><input type='submit' value='RENTAR' class='btnrnLD'></a></td>
                  <script>
                  $(document).ready(function() {
                  $('#soy$id_local').click(function(){
                  $('#vari').html('<h2>EL LOCAL $nombre_local ESTA DISPONIBLE<br>¿QUIERE RENTARLO?<h2>');
                  $('#localdelete').val('$id_local');
                  $('#dosddos').val('1');
                  $('#formulocales').attr('action', 'menu.php');
                  });
                  });
                  </script>";
                  echo "<td class='td22'><input type='text' placeholder='WHATSAPP' class='btnwsLD'></td>";
                  echo "<td class='td22'><input type='submit' value='PROMOCIONAR' class='btnprLD'></td>";}


                  else{echo "<td class='td12'>
                 <a href='#popup' class='popup-link' id='soy$id_local'><input type='submit'value='RENTADO' class='btnrnLDR'></a>
                 </td>
                 <script>
                  $(document).ready(function() {
                  $('#soy$id_local').click(function(){
                  $('#vari').html('<h2>¿SEGURO QUE VA A ELIMINAR EL REGISTRO DEL LOCAL $nombre_local?<h2>');
                  $('#localdelete').val('$id_local');
                  $('#dosddos').val('2');
                  $('#formulocales').attr('action', 'eliminar.php');
                  });
                  });
                  </script>
                  <td class='td22'></td>
                  <td class='td22'></td>
                  </tr>";}
            }
                  ?>


              </tbody>
               </table>
          </div>
    </div>
    <div id="element4" style="display: none;" class="localesDisponibles">
    <style media="screen">
      text{
        font-size: 10px;
      }
    </style>
      <svg width="95%" viewBox="0 0 780 240">
        <g id="juegos" stroke="black" stroke-width="1px" fill="white">
          <rect x="0" y="0" width="20" height="240"></rect>
          <text style="writing-mode: tb;" x="10" y="50%" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">Juegos173</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="20" y="0" width="20" height="40"></rect>
        </g>
        <g id="001h" stroke="black" stroke-width="1px" fill="white">
          <rect x="20" y="40" width="20" height="20"></rect>
          <text x="29" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">1h</text>
        </g>
        <g id="054h" stroke="black" stroke-width="1px" fill="white">
          <rect x="20" y="60" width="20" height="20"></rect>
          <text x="29" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">54h</text>
        </g>
        <g id="055h" stroke="black" stroke-width="1px" fill="white">
          <rect x="20" y="100" width="20" height="20"></rect>
          <text x="29" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">55h</text>
        </g>
        <g id="116h" stroke="black" stroke-width="1px" fill="white">
          <rect x="20" y="120" width="20" height="20"></rect>
          <text x="29" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">116h</text>
        </g>
        <g id="117h" stroke="black" stroke-width="1px" fill="white">
          <rect x="20" y="160" width="20" height="20"></rect>
          <text x="29" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">117h</text>
        </g>
        <g id="164h" stroke="black" stroke-width="1px" fill="white">
          <rect x="20" y="180" width="20" height="20"></rect>
          <text x="29" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">164h</text>
        </g>
        <g id="165h" stroke="black" stroke-width="1px" fill="white">
          <rect x="20" y="200" width="20" height="20"></rect>
          <text x="29" y="212" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">165h</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="20" y="220" width="40" height="20"></rect>
        </g>
        <g id="000f" stroke="black" stroke-width="1px" fill="white">
          <rect x="40" y="0" width="20" height="20"></rect>
          <text x="49" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">0f</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="40" y="100" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="40" y="120" width="20" height="20"></rect>
        </g>
        <g id="001f" stroke="black" stroke-width="1px" fill="white">
          <rect x="60" y="0" width="20" height="20"></rect>
          <text x="69" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">1f</text>
        </g>
        <g id="002f" stroke="black" stroke-width="1px" fill="white">
          <rect x="80" y="0" width="20" height="20"></rect>
          <text x="89" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">2f</text>
        </g>
        <g id="003f" stroke="black" stroke-width="1px" fill="white">
          <rect x="100" y="0" width="20" height="20"></rect>
          <text x="109" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">3f</text>
        </g>
        <g id="004f" stroke="black" stroke-width="1px" fill="white">
          <rect x="120" y="0" width="20" height="20"></rect>
          <text x="129" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">4f</text>
        </g>
        <g id="005f" stroke="black" stroke-width="1px" fill="white">
          <rect x="140" y="0" width="20" height="20"></rect>
          <text x="149" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">5f</text>
        </g>
        <g id="006f" stroke="black" stroke-width="1px" fill="white">
          <rect x="160" y="0" width="20" height="20"></rect>
          <text x="169" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">6f</text>
        </g>
        <g id="007f" stroke="black" stroke-width="1px" fill="white">
          <rect x="180" y="0" width="20" height="20"></rect>
          <text x="189" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">7f</text>
        </g>
        <g id="008f" stroke="black" stroke-width="1px" fill="white">
          <rect x="200" y="0" width="20" height="20"></rect>
          <text x="209" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">8f</text>
        </g>
        <g id="009f" stroke="black" stroke-width="1px" fill="white">
          <rect x="220" y="0" width="20" height="20"></rect>
          <text x="229" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">9f</text>
        </g>
        <g id="010f" stroke="black" stroke-width="1px" fill="white">
          <rect x="240" y="0" width="20" height="20"></rect>
          <text x="249" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">10f</text>
        </g>
        <g id="011f" stroke="black" stroke-width="1px" fill="white">
          <rect x="260" y="0" width="20" height="20"></rect>
          <text x="269" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">11f</text>
        </g>
        <g id="012f" stroke="black" stroke-width="1px" fill="white">
          <rect x="280" y="0" width="20" height="20"></rect>
          <text x="289" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">12f</text>
        </g>
        <g id="067f" stroke="black" stroke-width="1px" fill="white">
          <rect x="300" y="0" width="20" height="20"></rect>
          <text x="309" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">67f</text>
        </g>
        <g id="068f" stroke="black" stroke-width="1px" fill="white">
          <rect x="320" y="0" width="20" height="20"></rect>
          <text x="329" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">68f</text>
        </g>
        <g id="13af" stroke="black" stroke-width="1px" fill="white">
          <rect x="340" y="0" width="20" height="20"></rect>
          <text x="349" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">13af</text>
        </g>
        <g id="13bf" stroke="black" stroke-width="1px" fill="white">
          <rect x="360" y="0" width="20" height="20"></rect>
          <text x="369" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">13bf</text>
        </g>
        <g id="14af" stroke="black" stroke-width="1px" fill="white">
          <rect x="400" y="0" width="20" height="20"></rect>
          <text x="409" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">14af</text>
        </g>
        <g id="14bf" stroke="black" stroke-width="1px" fill="white">
          <rect x="420" y="0" width="20" height="20"></rect>
          <text x="429" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">14bf</text>
        </g>
        <g id="071f" stroke="black" stroke-width="1px" fill="white">
          <rect x="440" y="0" width="20" height="20"></rect>
          <text x="449" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">71f</text>
        </g>
        <g id="072f" stroke="black" stroke-width="1px" fill="white">
          <rect x="460" y="0" width="20" height="20"></rect>
          <text x="469" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">72f</text>
        </g>
        <g id="015f" stroke="black" stroke-width="1px" fill="white">
          <rect x="480" y="0" width="20" height="20"></rect>
          <text x="489" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">15f</text>
        </g>
        <g id="016f" stroke="black" stroke-width="1px" fill="white">
          <rect x="500" y="0" width="20" height="20"></rect>
          <text x="509" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">16f</text>
        </g>
        <g id="017f" stroke="black" stroke-width="1px" fill="white">
          <rect x="520" y="0" width="20" height="20"></rect>
          <text x="529" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">17f</text>
        </g>
        <g id="018f" stroke="black" stroke-width="1px" fill="white">
          <rect x="540" y="0" width="20" height="20"></rect>
          <text x="549" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">18f</text>
        </g>
        <g id="019f" stroke="black" stroke-width="1px" fill="white">
          <rect x="560" y="0" width="20" height="20"></rect>
          <text x="569" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">19f</text>
        </g>
        <g id="020f" stroke="black" stroke-width="1px" fill="white">
          <rect x="580" y="0" width="20" height="20"></rect>
          <text x="589" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">20f</text>
        </g>
        <g id="021f" stroke="black" stroke-width="1px" fill="white">
          <rect x="600" y="0" width="20" height="20"></rect>
          <text x="609" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">21f</text>
        </g>
        <g id="022f" stroke="black" stroke-width="1px" fill="white">
          <rect x="620" y="0" width="20" height="20"></rect>
          <text x="629" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">22f</text>
        </g>
        <g id="023f" stroke="black" stroke-width="1px" fill="white">
          <rect x="640" y="0" width="20" height="20"></rect>
          <text x="649" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">23f</text>
        </g>
        <g id="024f" stroke="black" stroke-width="1px" fill="white">
          <rect x="660" y="0" width="20" height="20"></rect>
          <text x="669" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">24f</text>
        </g>
        <g id="025f" stroke="black" stroke-width="1px" fill="white">
          <rect x="680" y="0" width="20" height="20"></rect>
          <text x="689" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">25f</text>
        </g>
        <g id="026f" stroke="black" stroke-width="1px" fill="white">
          <rect x="700" y="0" width="20" height="20"></rect>
          <text x="709" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">26f</text>
        </g>
        <g id="027f" stroke="black" stroke-width="1px" fill="white">
          <rect x="720" y="0" width="20" height="20"></rect>
          <text x="729" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">27f</text>
        </g>
        <g id="107f" stroke="black" stroke-width="1px" fill="white">
          <rect x="740" y="0" width="20" height="20"></rect>
          <text x="749" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">107f</text>
        </g>
        <g id="036n" stroke="black" stroke-width="1px" fill="white">
          <rect x="760" y="0" width="20" height="20"></rect>
          <text x="769" y="12" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">36n</text>
        </g>

        <g id="01" stroke="black" stroke-width="1px" fill="white">
          <rect x="60" y="40" width="20" height="20"></rect>
          <text x="69" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">1</text>
        </g>
        <g id="02" stroke="black" stroke-width="1px" fill="white">
          <rect x="80" y="40" width="20" height="20"></rect>
          <text x="89" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">2</text>
        </g>
        <g id="03" stroke="black" stroke-width="1px" fill="white">
          <rect x="100" y="40" width="20" height="20"></rect>
          <text x="109" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">3</text>
        </g>
        <g id="04" stroke="black" stroke-width="1px" fill="white">
          <rect x="120" y="40" width="20" height="20"></rect>
          <text x="129" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">4</text>
        </g>
        <g id="05" stroke="black" stroke-width="1px" fill="white">
          <rect x="140" y="40" width="20" height="20"></rect>
          <text x="149" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">5</text>
        </g>
        <g id="06" stroke="black" stroke-width="1px" fill="white">
          <rect x="160" y="40" width="20" height="20"></rect>
          <text x="169" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">6</text>
        </g>
        <g id="07" stroke="black" stroke-width="1px" fill="white">
          <rect x="180" y="40" width="20" height="20"></rect>
          <text x="189" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">7</text>
        </g>
        <g id="08" stroke="black" stroke-width="1px" fill="white">
          <rect x="200" y="40" width="20" height="20"></rect>
          <text x="209" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">8</text>
        </g>
        <g id="09" stroke="black" stroke-width="1px" fill="white">
          <rect x="220" y="40" width="20" height="20"></rect>
          <text x="229" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">9</text>
        </g>
        <g id="010" stroke="black" stroke-width="1px" fill="white">
          <rect x="240" y="40" width="20" height="20"></rect>
          <text x="249" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">10</text>
        </g>
        <g id="011" stroke="black" stroke-width="1px" fill="white">
          <rect x="260" y="40" width="20" height="20"></rect>
          <text x="269" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">11</text>
        </g>
        <g id="012" stroke="black" stroke-width="1px" fill="white">
          <rect x="280" y="40" width="20" height="20"></rect>
          <text x="289" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">12</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="300" y="40" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="320" y="40" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="340" y="40" width="20" height="20"></rect>
        </g>
        <g id="013" stroke="black" stroke-width="1px" fill="white">
          <rect x="360" y="40" width="20" height="20"></rect>
          <text x="369" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">13</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="380" y="40" width="20" height="40"></rect>
        </g>
        <g id="014" stroke="black" stroke-width="1px" fill="white">
          <rect x="400" y="40" width="20" height="20"></rect>
          <text x="409" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">14</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="420" y="40" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="440" y="40" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="460" y="40" width="20" height="20"></rect>
        </g>
        <g id="015" stroke="black" stroke-width="1px" fill="white">
          <rect x="480" y="40" width="20" height="20"></rect>
          <text x="489" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">15</text>
        </g>
        <g id="016" stroke="black" stroke-width="1px" fill="white">
          <rect x="500" y="40" width="20" height="20"></rect>
          <text x="509" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">16</text>
        </g>
        <g id="017" stroke="black" stroke-width="1px" fill="white">
          <rect x="520" y="40" width="20" height="20"></rect>
          <text x="529" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">17</text>
        </g>
        <g id="018" stroke="black" stroke-width="1px" fill="white">
          <rect x="540" y="40" width="20" height="20"></rect>
          <text x="549" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">18</text>
        </g>
        <g id="019" stroke="black" stroke-width="1px" fill="white">
          <rect x="560" y="40" width="20" height="20"></rect>
          <text x="569" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">19</text>
        </g>
        <g id="020" stroke="black" stroke-width="1px" fill="white">
          <rect x="580" y="40" width="20" height="20"></rect>
          <text x="589" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">20</text>
        </g>
        <g id="021" stroke="black" stroke-width="1px" fill="white">
          <rect x="600" y="40" width="20" height="20"></rect>
          <text x="609" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">21</text>
        </g>
        <g id="022" stroke="black" stroke-width="1px" fill="white">
          <rect x="620" y="40" width="20" height="20"></rect>
          <text x="629" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">22</text>
        </g>
        <g id="023" stroke="black" stroke-width="1px" fill="white">
          <rect x="640" y="40" width="20" height="20"></rect>
          <text x="649" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">23</text>
        </g>
        <g id="024" stroke="black" stroke-width="1px" fill="white">
          <rect x="660" y="40" width="20" height="20"></rect>
          <text x="669" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">24</text>
        </g>
        <g id="025" stroke="black" stroke-width="1px" fill="white">
          <rect x="680" y="40" width="20" height="20"></rect>
          <text x="689" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">25</text>
        </g>
        <g id="026" stroke="black" stroke-width="1px" fill="white">
          <rect x="700" y="40" width="20" height="20"></rect>
          <text x="709" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">26</text>
        </g>
        <g id="027" stroke="black" stroke-width="1px" fill="white">
          <rect x="720" y="40" width="20" height="20"></rect>
          <text x="729" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">27</text>
        </g>
        <g id="027g" stroke="black" stroke-width="1px" fill="white">
          <rect x="760" y="40" width="20" height="20"></rect>
          <text x="769" y="52" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">27g</text>
        </g>

        <g id="054" stroke="black" stroke-width="1px" fill="white">
          <rect x="60" y="60" width="20" height="20"></rect>
          <text x="69" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">54</text>
        </g>
        <g id="053" stroke="black" stroke-width="1px" fill="white">
          <rect x="80" y="60" width="20" height="20"></rect>
          <text x="89" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">53</text>
        </g>
        <g id="052" stroke="black" stroke-width="1px" fill="white">
          <rect x="100" y="60" width="20" height="20"></rect>
          <text x="109" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">52</text>
        </g>
        <g id="051" stroke="black" stroke-width="1px" fill="white">
          <rect x="120" y="60" width="20" height="20"></rect>
          <text x="129" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">51</text>
        </g>
        <g id="050" stroke="black" stroke-width="1px" fill="white">
          <rect x="140" y="60" width="20" height="20"></rect>
          <text x="149" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">50</text>
        </g>
        <g id="049" stroke="black" stroke-width="1px" fill="white">
          <rect x="160" y="60" width="20" height="20"></rect>
          <text x="169" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">49</text>
        </g>
        <g id="048" stroke="black" stroke-width="1px" fill="white">
          <rect x="180" y="60" width="20" height="20"></rect>
          <text x="189" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">48</text>
        </g>
        <g id="047" stroke="black" stroke-width="1px" fill="white">
          <rect x="200" y="60" width="20" height="20"></rect>
          <text x="209" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">47</text>
        </g>
        <g id="046" stroke="black" stroke-width="1px" fill="white">
          <rect x="220" y="60" width="20" height="20"></rect>
          <text x="229" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">46</text>
        </g>
        <g id="045" stroke="black" stroke-width="1px" fill="white">
          <rect x="240" y="60" width="20" height="20"></rect>
          <text x="249" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">45</text>
        </g>
        <g id="044" stroke="black" stroke-width="1px" fill="white">
          <rect x="260" y="60" width="20" height="20"></rect>
          <text x="269" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">44</text>
        </g>
        <g id="043" stroke="black" stroke-width="1px" fill="white">
          <rect x="280" y="60" width="20" height="20"></rect>
          <text x="289" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">43</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="300" y="60" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="320" y="60" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="340" y="60" width="20" height="20"></rect>
        </g>
        <g id="042" stroke="black" stroke-width="1px" fill="white">
          <rect x="360" y="60" width="20" height="20"></rect>
          <text x="369" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">42</text>
        </g>
        <g id="041" stroke="black" stroke-width="1px" fill="white">
          <rect x="400" y="60" width="20" height="20"></rect>
          <text x="409" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">41</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="420" y="60" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="440" y="60" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="460" y="60" width="20" height="20"></rect>
        </g>
        <g id="040" stroke="black" stroke-width="1px" fill="white">
          <rect x="480" y="60" width="20" height="20"></rect>
          <text x="489" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">40</text>
        </g>
        <g id="039" stroke="black" stroke-width="1px" fill="white">
          <rect x="500" y="60" width="20" height="20"></rect>
          <text x="509" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">39</text>
        </g>
        <g id="038" stroke="black" stroke-width="1px" fill="white">
          <rect x="520" y="60" width="20" height="20"></rect>
          <text x="529" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">38</text>
        </g>
        <g id="037" stroke="black" stroke-width="1px" fill="white">
          <rect x="540" y="60" width="20" height="20"></rect>
          <text x="549" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">37</text>
        </g>
        <g id="036" stroke="black" stroke-width="1px" fill="white">
          <rect x="560" y="60" width="20" height="20"></rect>
          <text x="569" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">36</text>
        </g>
        <g id="035" stroke="black" stroke-width="1px" fill="white">
          <rect x="580" y="60" width="20" height="20"></rect>
          <text x="589" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">35</text>
        </g>
        <g id="034" stroke="black" stroke-width="1px" fill="white">
          <rect x="600" y="60" width="20" height="20"></rect>
          <text x="609" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">34</text>
        </g>
        <g id="033" stroke="black" stroke-width="1px" fill="white">
          <rect x="620" y="60" width="20" height="20"></rect>
          <text x="629" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">33</text>
        </g>
        <g id="032" stroke="black" stroke-width="1px" fill="white">
          <rect x="640" y="60" width="20" height="20"></rect>
          <text x="649" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">32</text>
        </g>
        <g id="031" stroke="black" stroke-width="1px" fill="white">
          <rect x="660" y="60" width="20" height="20"></rect>
          <text x="669" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">31</text>
        </g>
        <g id="030" stroke="black" stroke-width="1px" fill="white">
          <rect x="680" y="60" width="20" height="20"></rect>
          <text x="689" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">30</text>
        </g>
        <g id="029" stroke="black" stroke-width="1px" fill="white">
          <rect x="700" y="60" width="20" height="20"></rect>
          <text x="709" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">29</text>
        </g>
        <g id="028" stroke="black" stroke-width="1px" fill="white">
          <rect x="720" y="60" width="20" height="20"></rect>
          <text x="729" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">28</text>
        </g>
        <g id="028g" stroke="black" stroke-width="1px" fill="white">
          <rect x="760" y="60" width="20" height="20"></rect>
          <text x="769" y="72" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">28g</text>
        </g>
        <g id="029g" stroke="black" stroke-width="1px" fill="white">
          <rect x="760" y="80" width="20" height="20"></rect>
          <text x="769" y="92" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">29g</text>
        </g>

        <g id="055" stroke="black" stroke-width="1px" fill="white">
          <rect x="60" y="100" width="20" height="20"></rect>
          <text x="69" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">55</text>
        </g>
        <g id="056" stroke="black" stroke-width="1px" fill="white">
          <rect x="80" y="100" width="20" height="20"></rect>
          <text x="89" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">56</text>
        </g>
        <g id="057" stroke="black" stroke-width="1px" fill="white">
          <rect x="100" y="100" width="20" height="20"></rect>
          <text x="109" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">57</text>
        </g>
        <g id="058" stroke="black" stroke-width="1px" fill="white">
          <rect x="120" y="100" width="20" height="20"></rect>
          <text x="129" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">58</text>
        </g>
        <g id="059" stroke="black" stroke-width="1px" fill="white">
          <rect x="140" y="100" width="20" height="20"></rect>
          <text x="149" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">59</text>
        </g>
        <g id="060" stroke="black" stroke-width="1px" fill="white">
          <rect x="160" y="100" width="20" height="20"></rect>
          <text x="169" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">60</text>
        </g>
        <g id="061" stroke="black" stroke-width="1px" fill="white">
          <rect x="180" y="100" width="20" height="20"></rect>
          <text x="189" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">61</text>
        </g>
        <g id="062" stroke="black" stroke-width="1px" fill="white">
          <rect x="200" y="100" width="20" height="20"></rect>
          <text x="209" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">62</text>
        </g>
        <g id="063" stroke="black" stroke-width="1px" fill="white">
          <rect x="220" y="100" width="20" height="20"></rect>
          <text x="229" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">63</text>
        </g>
        <g id="064" stroke="black" stroke-width="1px" fill="white">
          <rect x="240" y="100" width="20" height="20"></rect>
          <text x="249" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">64</text>
        </g>
        <g id="065" stroke="black" stroke-width="1px" fill="white">
          <rect x="260" y="100" width="20" height="20"></rect>
          <text x="269" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">65</text>
        </g>
        <g id="066" stroke="black" stroke-width="1px" fill="white">
          <rect x="280" y="100" width="20" height="20"></rect>
          <text x="289" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">66</text>
        </g>
        <g id="067" stroke="black" stroke-width="1px" fill="white">
          <rect x="300" y="100" width="20" height="20"></rect>
          <text x="309" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">67</text>
        </g>
        <g id="068" stroke="black" stroke-width="1px" fill="white">
          <rect x="320" y="100" width="20" height="20"></rect>
          <text x="329" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">68</text>
        </g>
        <g id="069" stroke="black" stroke-width="1px" fill="white">
          <rect x="340" y="100" width="20" height="20"></rect>
          <text x="349" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">69</text>
        </g>
        <g id="070" stroke="black" stroke-width="1px" fill="white">
          <rect x="420" y="100" width="20" height="20"></rect>
          <text x="429" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">70</text>
        </g>
        <g id="071" stroke="black" stroke-width="1px" fill="white">
          <rect x="440" y="100" width="20" height="20"></rect>
          <text x="449" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">71</text>
        </g>
        <g id="072" stroke="black" stroke-width="1px" fill="white">
          <rect x="460" y="100" width="20" height="20"></rect>
          <text x="469" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">72</text>
        </g>
        <g id="073" stroke="black" stroke-width="1px" fill="white">
          <rect x="480" y="100" width="20" height="20"></rect>
          <text x="489" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">73</text>
        </g>
        <g id="074" stroke="black" stroke-width="1px" fill="white">
          <rect x="500" y="100" width="20" height="20"></rect>
          <text x="509" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">74</text>
        </g>
        <g id="075" stroke="black" stroke-width="1px" fill="white">
          <rect x="520" y="100" width="20" height="20"></rect>
          <text x="529" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">75</text>
        </g>
        <g id="076" stroke="black" stroke-width="1px" fill="white">
          <rect x="540" y="100" width="20" height="20"></rect>
          <text x="549" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">76</text>
        </g>
        <g id="077" stroke="black" stroke-width="1px" fill="white">
          <rect x="560" y="100" width="20" height="20"></rect>
          <text x="569" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">77</text>
        </g>
        <g id="078" stroke="black" stroke-width="1px" fill="white">
          <rect x="580" y="100" width="20" height="20"></rect>
          <text x="589" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">78</text>
        </g>
        <g id="079" stroke="black" stroke-width="1px" fill="white">
          <rect x="600" y="100" width="20" height="20"></rect>
          <text x="609" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">79</text>
        </g>
        <g id="080" stroke="black" stroke-width="1px" fill="white">
          <rect x="620" y="100" width="20" height="20"></rect>
          <text x="629" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">80</text>
        </g>
        <g id="081" stroke="black" stroke-width="1px" fill="white">
          <rect x="640" y="100" width="20" height="20"></rect>
          <text x="649" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">81</text>
        </g>
        <g id="082" stroke="black" stroke-width="1px" fill="white">
          <rect x="660" y="100" width="20" height="20"></rect>
          <text x="669" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">82</text>
        </g>
        <g id="083" stroke="black" stroke-width="1px" fill="white">
          <rect x="680" y="100" width="20" height="20"></rect>
          <text x="689" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">83</text>
        </g>
        <g id="084" stroke="black" stroke-width="1px" fill="white">
          <rect x="700" y="100" width="20" height="20"></rect>
          <text x="709" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">84</text>
        </g>
        <g id="085" stroke="black" stroke-width="1px" fill="white">
          <rect x="720" y="100" width="20" height="20"></rect>
          <text x="729" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">85</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="740" y="100" width="20" height="20"></rect>
        </g>
        <g id="085g" stroke="black" stroke-width="1px" fill="white">
          <rect x="760" y="100" width="20" height="20"></rect>
          <text x="769" y="112" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">85g</text>
        </g>
        <g id="116" stroke="black" stroke-width="1px" fill="white">
          <rect x="60" y="120" width="20" height="20"></rect>
          <text x="69" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">116</text>
        </g>
        <g id="115" stroke="black" stroke-width="1px" fill="white">
          <rect x="80" y="120" width="20" height="20"></rect>
          <text x="89" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">115</text>
        </g>
        <g id="114" stroke="black" stroke-width="1px" fill="white">
          <rect x="100" y="120" width="20" height="20"></rect>
          <text x="109" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">114</text>
        </g>
        <g id="113" stroke="black" stroke-width="1px" fill="white">
          <rect x="120" y="120" width="20" height="20"></rect>
          <text x="129" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">113</text>
        </g>
        <g id="112" stroke="black" stroke-width="1px" fill="white">
          <rect x="140" y="120" width="20" height="20"></rect>
          <text x="149" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">112</text>
        </g>
        <g id="111" stroke="black" stroke-width="1px" fill="white">
          <rect x="160" y="120" width="20" height="20"></rect>
          <text x="169" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">111</text>
        </g>
        <g id="110" stroke="black" stroke-width="1px" fill="white">
          <rect x="180" y="120" width="20" height="20"></rect>
          <text x="189" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">110</text>
        </g>
        <g id="109" stroke="black" stroke-width="1px" fill="white">
          <rect x="200" y="120" width="20" height="20"></rect>
          <text x="209" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">109</text>
        </g>
        <g id="108" stroke="black" stroke-width="1px" fill="white">
          <rect x="220" y="120" width="20" height="20"></rect>
          <text x="229" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">108</text>
        </g>
        <g id="107" stroke="black" stroke-width="1px" fill="white">
          <rect x="240" y="120" width="20" height="20"></rect>
          <text x="249" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">107</text>
        </g>
        <g id="106" stroke="black" stroke-width="1px" fill="white">
          <rect x="260" y="120" width="20" height="20"></rect>
          <text x="269" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">106</text>
        </g>
        <g id="105" stroke="black" stroke-width="1px" fill="white">
          <rect x="280" y="120" width="20" height="20"></rect>
          <text x="289" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">105</text>
        </g>
        <g id="104" stroke="black" stroke-width="1px" fill="white">
          <rect x="300" y="120" width="20" height="20"></rect>
          <text x="309" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">104</text>
        </g>
        <g id="103" stroke="black" stroke-width="1px" fill="white">
          <rect x="320" y="120" width="20" height="20"></rect>
          <text x="329" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">103</text>
        </g>
        <g id="102" stroke="black" stroke-width="1px" fill="white">
          <rect x="340" y="120" width="20" height="20"></rect>
          <text x="349" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">102</text>
        </g>
        <g id="101" stroke="black" stroke-width="1px" fill="white">
          <rect x="420" y="120" width="20" height="20"></rect>
          <text x="429" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">101</text>
        </g>
        <g id="100" stroke="black" stroke-width="1px" fill="white">
          <rect x="440" y="120" width="20" height="20"></rect>
          <text x="449" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">100</text>
        </g>
        <g id="099" stroke="black" stroke-width="1px" fill="white">
          <rect x="460" y="120" width="20" height="20"></rect>
          <text x="469" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">99</text>
        </g>
        <g id="098" stroke="black" stroke-width="1px" fill="white">
          <rect x="480" y="120" width="20" height="20"></rect>
          <text x="489" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">98</text>
        </g>
        <g id="097" stroke="black" stroke-width="1px" fill="white">
          <rect x="500" y="120" width="20" height="20"></rect>
          <text x="509" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">97</text>
        </g>
        <g id="096" stroke="black" stroke-width="1px" fill="white">
          <rect x="520" y="120" width="20" height="20"></rect>
          <text x="529" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">96</text>
        </g>
        <g id="095" stroke="black" stroke-width="1px" fill="white">
          <rect x="540" y="120" width="20" height="20"></rect>
          <text x="549" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">95</text>
        </g>
        <g id="094" stroke="black" stroke-width="1px" fill="white">
          <rect x="560" y="120" width="20" height="20"></rect>
          <text x="569" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">94</text>
        </g>
        <g id="093" stroke="black" stroke-width="1px" fill="white">
          <rect x="580" y="120" width="20" height="20"></rect>
          <text x="589" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">93</text>
        </g>
        <g id="092" stroke="black" stroke-width="1px" fill="white">
          <rect x="600" y="120" width="20" height="20"></rect>
          <text x="609" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">92</text>
        </g>
        <g id="091" stroke="black" stroke-width="1px" fill="white">
          <rect x="620" y="120" width="20" height="20"></rect>
          <text x="629" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">91</text>
        </g>
        <g id="090" stroke="black" stroke-width="1px" fill="white">
          <rect x="640" y="120" width="20" height="20"></rect>
          <text x="649" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">90</text>
        </g>
        <g id="089" stroke="black" stroke-width="1px" fill="white">
          <rect x="660" y="120" width="20" height="20"></rect>
          <text x="669" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">89</text>
        </g>
        <g id="088" stroke="black" stroke-width="1px" fill="white">
          <rect x="680" y="120" width="20" height="20"></rect>
          <text x="689" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">88</text>
        </g>
        <g id="087" stroke="black" stroke-width="1px" fill="white">
          <rect x="700" y="120" width="20" height="20"></rect>
          <text x="709" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">87</text>
        </g>
        <g id="086" stroke="black" stroke-width="1px" fill="white">
          <rect x="720" y="120" width="20" height="20"></rect>
          <text x="729" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">86</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="740" y="120" width="20" height="20"></rect>
        </g>
        <g id="086g" stroke="black" stroke-width="1px" fill="white">
          <rect x="760" y="120" width="20" height="20"></rect>
          <text x="769" y="132" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">86g</text>
        </g>
        <g id="117" stroke="black" stroke-width="1px" fill="white">
          <rect x="60" y="160" width="34" height="20"></rect>
          <text x="75" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">117</text>
        </g>
        <g id="118" stroke="black" stroke-width="1px" fill="white">
          <rect x="94" y="160" width="33" height="20"></rect>
          <text x="110" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">118</text>
        </g>
        <g id="119" stroke="black" stroke-width="1px" fill="white">
          <rect x="127" y="160" width="33" height="20"></rect>
          <text x="142" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">119</text>
        </g>
        <g id="120" stroke="black" stroke-width="1px" fill="white">
          <rect x="160" y="160" width="33" height="20"></rect>
          <text x="175" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">120</text>
        </g>
        <g id="121" stroke="black" stroke-width="1px" fill="white">
          <rect x="193" y="160" width="33" height="20"></rect>
          <text x="208" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">121</text>
        </g>
        <g id="122" stroke="black" stroke-width="1px" fill="white">
          <rect x="226" y="160" width="34" height="20"></rect>
          <text x="241" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">122</text>
        </g>
        <g id="123" stroke="black" stroke-width="1px" fill="white">
          <rect x="260" y="160" width="20" height="20"></rect>
          <text x="269" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">123</text>
        </g>
        <g id="124" stroke="black" stroke-width="1px" fill="white">
          <rect x="280" y="160" width="20" height="20"></rect>
          <text x="289" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">124</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="300" y="160" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="320" y="160" width="20" height="20"></rect>
        </g>
        <g id="125" stroke="black" stroke-width="1px" fill="white">
          <rect x="340" y="160" width="20" height="20"></rect>
          <text x="349" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">125</text>
        </g>
        <g id="126" stroke="black" stroke-width="1px" fill="white">
          <rect x="360" y="160" width="20" height="20"></rect>
          <text x="369" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">126</text>
        </g>
        <g id="127" stroke="black" stroke-width="1px" fill="white">
          <rect x="380" y="160" width="20" height="20"></rect>
          <text x="389" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">127</text>
        </g>
        <g id="128" stroke="black" stroke-width="1px" fill="white">
          <rect x="400" y="160" width="20" height="20"></rect>
          <text x="409" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">128</text>
        </g>
        <g id="129" stroke="black" stroke-width="1px" fill="white">
          <rect x="420" y="160" width="20" height="20"></rect>
          <text x="429" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">129</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="440" y="160" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="460" y="160" width="20" height="20"></rect>
        </g>
        <g id="130" stroke="black" stroke-width="1px" fill="white">
          <rect x="480" y="160" width="20" height="20"></rect>
          <text x="489" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">130</text>
        </g>
        <g id="131" stroke="black" stroke-width="1px" fill="white">
          <rect x="500" y="160" width="20" height="20"></rect>
          <text x="509" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">131</text>
        </g>
        <g id="132" stroke="black" stroke-width="1px" fill="white">
          <rect x="520" y="160" width="33" height="20"></rect>
          <text x="535" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">132</text>
        </g>
        <g id="133" stroke="black" stroke-width="1px" fill="white">
          <rect x="553" y="160" width="34" height="20"></rect>
          <text x="568" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">133</text>
        </g>
        <g id="134" stroke="black" stroke-width="1px" fill="white">
          <rect x="587" y="160" width="33" height="20"></rect>
          <text x="602" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">134</text>
        </g>
        <g id="135" stroke="black" stroke-width="1px" fill="white">
          <rect x="620" y="160" width="20" height="20"></rect>
          <text x="629" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">135</text>
        </g>
        <g id="136" stroke="black" stroke-width="1px" fill="white">
          <rect x="640" y="160" width="20" height="20"></rect>
          <text x="649" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">136</text>
        </g>
        <g id="137" stroke="black" stroke-width="1px" fill="white">
          <rect x="660" y="160" width="20" height="20"></rect>
          <text x="669" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">137</text>
        </g>
        <g id="138" stroke="black" stroke-width="1px" fill="white">
          <rect x="680" y="160" width="20" height="20"></rect>
          <text x="689" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">138</text>
        </g>
        <g id="139" stroke="black" stroke-width="1px" fill="white">
          <rect x="700" y="160" width="20" height="20"></rect>
          <text x="709" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">139</text>
        </g>
        <g id="140" stroke="black" stroke-width="1px" fill="white">
          <rect x="720" y="160" width="20" height="20"></rect>
          <text x="729" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">140</text>
        </g>
        <g id="140g" stroke="black" stroke-width="1px" fill="white">
          <rect x="760" y="160" width="20" height="20"></rect>
          <text x="769" y="172" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">140g</text>
        </g>


        <g id="164" stroke="black" stroke-width="1px" fill="white">
          <rect x="60" y="180" width="34" height="20"></rect>
          <text x="75" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">164</text>
        </g>
        <g id="163" stroke="black" stroke-width="1px" fill="white">
          <rect x="94" y="180" width="33" height="20"></rect>
          <text x="110" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">163</text>
        </g>
        <g id="162" stroke="black" stroke-width="1px" fill="white">
          <rect x="127" y="180" width="33" height="20"></rect>
          <text x="142" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">162</text>
        </g>
        <g id="161" stroke="black" stroke-width="1px" fill="white">
          <rect x="160" y="180" width="33" height="20"></rect>
          <text x="175" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">161</text>
        </g>
        <g id="160" stroke="black" stroke-width="1px" fill="white">
          <rect x="193" y="180" width="33" height="20"></rect>
          <text x="208" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">160</text>
        </g>
        <g id="159" stroke="black" stroke-width="1px" fill="white">
          <rect x="226" y="180" width="34" height="20"></rect>
          <text x="241" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">159</text>
        </g>
        <g id="158" stroke="black" stroke-width="1px" fill="white">
          <rect x="260" y="180" width="20" height="20"></rect>
          <text x="269" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">158</text>
        </g>
        <g id="157" stroke="black" stroke-width="1px" fill="white">
          <rect x="280" y="180" width="20" height="20"></rect>
          <text x="289" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">157</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="300" y="180" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="320" y="180" width="20" height="20"></rect>
        </g>
        <g id="156" stroke="black" stroke-width="1px" fill="white">
          <rect x="340" y="180" width="20" height="20"></rect>
          <text x="349" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">156</text>
        </g>
        <g id="155" stroke="black" stroke-width="1px" fill="white">
          <rect x="360" y="180" width="20" height="20"></rect>
          <text x="369" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">155</text>
        </g>
        <g id="154" stroke="black" stroke-width="1px" fill="white">
          <rect x="380" y="180" width="20" height="20"></rect>
          <text x="389" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">154</text>
        </g>
        <g id="153" stroke="black" stroke-width="1px" fill="white">
          <rect x="400" y="180" width="20" height="20"></rect>
          <text x="409" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">153</text>
        </g>
        <g id="152" stroke="black" stroke-width="1px" fill="white">
          <rect x="420" y="180" width="20" height="20"></rect>
          <text x="429" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">152</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="440" y="180" width="20" height="20"></rect>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="460" y="180" width="20" height="20"></rect>
        </g>
        <g id="151" stroke="black" stroke-width="1px" fill="white">
          <rect x="480" y="180" width="20" height="20"></rect>
          <text x="489" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">151</text>
        </g>
        <g id="150" stroke="black" stroke-width="1px" fill="white">
          <rect x="500" y="180" width="20" height="20"></rect>
          <text x="509" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">150</text>
        </g>
        <g id="149" stroke="black" stroke-width="1px" fill="white">
          <rect x="520" y="180" width="33" height="20"></rect>
          <text x="535" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">149</text>
        </g>
        <g id="148" stroke="black" stroke-width="1px" fill="white">
          <rect x="553" y="180" width="34" height="20"></rect>
          <text x="568" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">148</text>
        </g>
        <g id="147" stroke="black" stroke-width="1px" fill="white">
          <rect x="587" y="180" width="33" height="20"></rect>
          <text x="602" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">147</text>
        </g>
        <g id="146" stroke="black" stroke-width="1px" fill="white">
          <rect x="620" y="180" width="20" height="20"></rect>
          <text x="629" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">146</text>
        </g>
        <g id="145" stroke="black" stroke-width="1px" fill="white">
          <rect x="640" y="180" width="20" height="20"></rect>
          <text x="649" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">145</text>
        </g>
        <g id="144" stroke="black" stroke-width="1px" fill="white">
          <rect x="660" y="180" width="20" height="20"></rect>
          <text x="669" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">144</text>
        </g>
        <g id="143" stroke="black" stroke-width="1px" fill="white">
          <rect x="680" y="180" width="20" height="20"></rect>
          <text x="689" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">143</text>
        </g>
        <g id="142" stroke="black" stroke-width="1px" fill="white">
          <rect x="700" y="180" width="20" height="20"></rect>
          <text x="709" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">142</text>
        </g>
        <g id="141" stroke="black" stroke-width="1px" fill="white">
          <rect x="720" y="180" width="20" height="20"></rect>
          <text x="729" y="192" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">141</text>
        </g>

        <g id="banio230" stroke="black" stroke-width="1px" fill="white">
          <rect x="760" y="180" width="20" height="60"></rect>
          <text style="writing-mode: tb;" x="769" y="215" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">Baño230</text>
        </g>

        <g id="269" stroke="black" stroke-width="1px" fill="white">
          <rect x="60" y="220" width="20" height="20"></rect>
          <text x="69" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">269</text>
        </g>
        <g id="268" stroke="black" stroke-width="1px" fill="white">
          <rect x="80" y="220" width="20" height="20"></rect>
          <text x="89" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">268</text>
        </g>
        <g id="267" stroke="black" stroke-width="1px" fill="white">
          <rect x="100" y="220" width="20" height="20"></rect>
          <text x="109" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">267</text>
        </g>
        <g id="266" stroke="black" stroke-width="1px" fill="white">
          <rect x="120" y="220" width="20" height="20"></rect>
          <text x="129" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">266</text>
        </g>
        <g id="265" stroke="black" stroke-width="1px" fill="white">
          <rect x="140" y="220" width="20" height="20"></rect>
          <text x="149" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">265</text>
        </g>
        <g id="264" stroke="black" stroke-width="1px" fill="white">
          <rect x="160" y="220" width="20" height="20"></rect>
          <text x="169" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">264</text>
        </g>
        <g id="263" stroke="black" stroke-width="1px" fill="white">
          <rect x="180" y="220" width="20" height="20"></rect>
          <text x="189" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">263</text>
        </g>
        <g id="262" stroke="black" stroke-width="1px" fill="white">
          <rect x="200" y="220" width="20" height="20"></rect>
          <text x="209" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">262</text>
        </g>
        <g id="261" stroke="black" stroke-width="1px" fill="white">
          <rect x="220" y="220" width="20" height="20"></rect>
          <text x="229" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">261</text>
        </g>
        <g id="260" stroke="black" stroke-width="1px" fill="white">
          <rect x="240" y="220" width="20" height="20"></rect>
          <text x="249" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">260</text>
        </g>
        <g id="259" stroke="black" stroke-width="1px" fill="white">
          <rect x="260" y="220" width="20" height="20"></rect>
          <text x="269" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">259</text>
        </g>
        <g id="258" stroke="black" stroke-width="1px" fill="white">
          <rect x="280" y="220" width="20" height="20"></rect>
          <text x="289" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">258</text>
        </g>
        <g id="257" stroke="black" stroke-width="1px" fill="white">
          <rect x="300" y="220" width="20" height="20"></rect>
          <text x="309" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">257</text>
        </g>
        <g id="256" stroke="black" stroke-width="1px" fill="white">
          <rect x="320" y="220" width="20" height="20"></rect>
          <text x="329" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">256</text>
        </g>
        <g id="255" stroke="black" stroke-width="1px" fill="white">
          <rect x="380" y="220" width="20" height="20"></rect>
          <text x="389" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">255</text>
        </g>
        <g id="254" stroke="black" stroke-width="1px" fill="white">
          <rect x="400" y="220" width="20" height="20"></rect>
          <text x="409" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">254</text>
        </g>
        <g id="253" stroke="black" stroke-width="1px" fill="white">
          <rect x="420" y="220" width="20" height="20"></rect>
          <text x="429" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">253</text>
        </g>
        <g id="252" stroke="black" stroke-width="1px" fill="white">
          <rect x="440" y="220" width="20" height="20"></rect>
          <text x="449" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">252</text>
        </g>
        <g id="251" stroke="black" stroke-width="1px" fill="white">
          <rect x="460" y="220" width="20" height="20"></rect>
          <text x="469" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">251</text>
        </g>
        <g id="250" stroke="black" stroke-width="1px" fill="white">
          <rect x="480" y="220" width="20" height="20"></rect>
          <text x="489" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">250</text>
        </g>
        <g id="249" stroke="black" stroke-width="1px" fill="white">
          <rect x="500" y="220" width="20" height="20"></rect>
          <text x="509" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">249</text>
        </g>
        <g id="248" stroke="black" stroke-width="1px" fill="white">
          <rect x="520" y="220" width="20" height="20"></rect>
          <text x="529" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">248</text>
        </g>
        <g id="247" stroke="black" stroke-width="1px" fill="white">
          <rect x="540" y="220" width="20" height="20"></rect>
          <text x="549" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">247</text>
        </g>
        <g id="246" stroke="black" stroke-width="1px" fill="white">
          <rect x="560" y="220" width="20" height="20"></rect>
          <text x="569" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">246</text>
        </g>
        <g id="245" stroke="black" stroke-width="1px" fill="white">
          <rect x="580" y="220" width="20" height="20"></rect>
          <text x="589" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">245</text>
        </g>
        <g id="244" stroke="black" stroke-width="1px" fill="white">
          <rect x="600" y="220" width="20" height="20"></rect>
          <text x="609" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">244</text>
        </g>
        <g id="243" stroke="black" stroke-width="1px" fill="white">
          <rect x="620" y="220" width="20" height="20"></rect>
          <text x="629" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">243</text>
        </g>
        <g id="242" stroke="black" stroke-width="1px" fill="white">
          <rect x="640" y="220" width="20" height="20"></rect>
          <text x="649" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">242</text>
        </g>
        <g id="241" stroke="black" stroke-width="1px" fill="white">
          <rect x="660" y="220" width="20" height="20"></rect>
          <text x="669" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">241</text>
        </g>
        <g id="240" stroke="black" stroke-width="1px" fill="white">
          <rect x="680" y="220" width="20" height="20"></rect>
          <text x="689" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">240</text>
        </g>
        <g id="239" stroke="black" stroke-width="1px" fill="white">
          <rect x="700" y="220" width="20" height="20"></rect>
          <text x="709" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">239</text>
        </g>
        <g id="238" stroke="black" stroke-width="1px" fill="white">
          <rect x="720" y="220" width="20" height="20"></rect>
          <text x="729" y="232" alignment-baseline="middle" text-anchor="middle" fill="black" stroke="none">238</text>
        </g>
        <g stroke="black" stroke-width="1px" fill="white">
          <rect x="740" y="220" width="20" height="20"></rect>
        </g>
      </svg>
    </div>


</div>
        <div id="BAL" class="tabcontent balanceSC">
 <div class="Subtab">
        <button id="show1">MENSUAL</button>
      </div>
            <div class="BALcontainer">
            <div class="rayita"></div>
          <div class="thContent">
          <div  class="thContent1"><div class="txtC21">MES</div></div>
          <div  class="thContent2"><div class="txtC22">CUENTA DEPOSITO</div></div>
          <div  class="thContent3"><div class="txtC23">TOTAL NETO</div></div>
          <div  class="thContent4">.</div>
          </div>
        </div>
            <div class="tablita">
            <table class="tablaBAL">
               <thead>
              <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                   </tr>
              </thead>
              <tbody>
              <tr class="trLD">
                  <td class="td12 trT2">ENERO</td>
                  <td class="td12 txtBAL2">HSBC<br>2015558889</td>
                  <td class="td22 txtBAL3">$1,200.25 PESOS</td>
                  </tr>
                  <tr class="trLD">
                  <td class="td12 trT2">FEBRERO</td>
                  <td class="td12 txtBAL2">HSBC<br>2015558889</td>
                  <td class="td22 txtBAL3">$1,200.25 PESOS</td>
                  </tr>
                  <tr class="trLD">
                  <td class="td12 trT2">MARZO</td>
                  <td class="td12 txtBAL2">HSBC<br>2015558889</td>
                  <td class="td22 txtBAL3">$1,200.25 PESOS</td>
                  </tr>
                  <tr class="trLD">
                  <td class="td12 trT2">ABRIL</td>
                  <td class="td12 txtBAL2">HSBC<br>2015558889</td>
                  <td class="td22 txtBAL3">$1,200.25 PESOS</td>
                  </tr>
                  <tr class="trLD">
                  <td class="td12 trT2">MAYO</td>
                  <td class="td12 txtBAL2">HSBC<br>2015558889</td>
                  <td class="td22 txtBAL3">$1,200.25 PESOS</td>
                  </tr>
                </tbody>
            </table>
            </div>
             <div class="babilonia">
          <button class="exportarPDF">EXPORTAR A PDF</button>
          </div>
</div>

<div id="CON" class="tabcontent balanceSC">
<div class="Subtab">
<button id="show31">ADMINISTRADOR DE LOCALES</button>
</div>
<div id="element31" style="display: none;" class="localesCorriente">
    <div class="rayita"></div>
    <div class="thContent">
    <div  class="thContent1"><div class="txtC">LOCAL</div></div>
    <div  class="thContent2"><div class="txtC">MODIFICAR</div></div>
    <div  class="thContent3">.</div>
    <a class="modificarA" href="#popup6"><div  class="thContent4"><div class="txtC modificarA">NUEVO</div></div></a>
    </div>
    <div class="tablita">
      <div class="azul11"><div class="azul21"></div></div>
      <div class="azul12"><div class="azul22"></div></div>
      <div class="azul13"><div class="azul23"></div></div>
      <div class="azul14"><div class="azul24"></div></div>
  <table class="tableM">

      <tr>
       <th></th>
       <th></th>
       <th></th>
       <th></th>
      </tr>

            <?php
        include("conection.php");
        $fechahoy = date("Y-m-d");
        $insertar2 = "SELECT * FROM locales";
        $consulta=mysqli_query($conexion,$insertar2);
        while ($row=mysqli_fetch_array($consulta)) {
        $id_local=$row['id_local'];
        $nombre_local=$row['nombre_local'];

            echo "<tr class='trT'>";
            echo "<td class='td1'>LOCAL $nombre_local</td>";
            echo "<td class='td2'><a href='#popup5' class='popup-link' id='loc$id_local'><input type='submit' value='MODIFICAR' class='btnrnLD'></a>
            <script>
            $(document).ready(function() {
            $('#loc$id_local').click(function(){
            $('#vari31').html('<h3>NUEVO NOMBRE DEL LOCAL $nombre_local</h3>');
            $('#modif2').val('$id_local');
            });
            });
            </script>
            </td>";
            echo "<td class='td3'></td>";
            echo "<td class='td4'></td></tr>";
      }
            ?>
    </table>
    </div>
</div></div>

<div class="modal-wrapper" id="popup">
    <div class="popup-contenedor">
        <form action="" method="post" id="formulocales">
        <div id="vari"></div>
            <input type="hidden" name="local" value="" id="localdelete">
            <input type="hidden" name="registro" value="" id="dosddos">
            <input type='submit' value='ACEPTAR' class='btnrnLD'>
        </form>
       <a class="popup-cerrar" href="#">X</a>
    </div>
</div>

<div class="modal-wrapper1" id="popup1">
    <div class="popup-contenedor1">
        <div class="containerModal2" id="vari1"></div>
           <div class="cM21"><div class="fondirris"><img class="fondirris2" src="resources/fondomodal2.png">
             <img class="fondirris3" src="#" id="fotirrisLocal">
               <div class="fondirrisTxt" id="nombreP1">Holis</div>
               </div></div>
           <div class="cM22"><div class="cM22Container"><div class="cuadritoamarillo"><div class="call1"><div class="ca1"><img class="ca1i" src="resources/domicilio.png"></div><div class="ca2"><img class="ca2i" src="resources/telefono.png"></div>
           <div class="ca3"><img class="ca3i" src="resources/suscripcion.png"></div><div class="ca4"><img class="ca4i" src="resources/correo.png"></div></div>
          <div class="call2">
            <div class="ca21" id="domicilioP1">DOMICILIO</div>
            <div class="ca22" id="telefonoP1">TELEFONO</div>
            <div class="ca23" id="suscripcionP1">SUSCRIPCION: ACTIVA</div>
            <div class="ca24" id="correoP1">CORREO</div>
         </div></div></div>
         <div class="abajoc2"><div class="abajoc21"><img src="resources/ifebtn.png" class="c21img"><div class="txtC2"><a href="#" id="c21" target="_blank">DESCARGAR</a></div></div>
                              <div class="abajoc22"><img src="resources/conbtn.png" class="c22img"><div class="txtC2"><a href="#" id="c22" target="_blank">DESCARGAR</a></div></div></div>
       </div>
           <div class="cM23"><div class="cM23Txt"  id="localP1">LOCAL <br>#</div></div>
</div>
       <a class="popup-cerrar1" href="#">X</a>
    </div>

    <div class="modal-wrapper2" id="popup2">
        <div class="popup-contenedor2">
            <div id="vari2">
              ¡REGISTRO REALIZADO CON EXITO!
            </div>
           <a class="popup-cerrar2" href="#">X</a>
        </div>
    </div>

    <div class="modal-wrapper3" id="popup3">
        <div class="popup-contenedor3">
            <div id="vari3">
              ¡REGISTRO ELIMINADO CON EXITO!
            </div>
           <a class="popup-cerrar3" href="#">X</a>
        </div>
    </div>
</div>

<div class="modal-wrapper4" id="popup4">
    <div class="popup-contenedor4">
        <div id="vari2">
          ESPERE...<br>
          <img src="resources/loading.gif">
        </div>
    </div>
</div>

<div class="modal-wrapper5" id="popup5">
    <div class="popup-contenedor5">
        <div id="vari31"></div>
          <form id="fileUploadForm1" method="post">
            <input type="text" name="nuevomod" class='btnwsLD'>
            <input type="hidden" name="idmod" value="" id="modif2"><br><br>
            <button type="submit" name="button" class='btnrnLD' id="btnSubir1">ACEPTAR</button>

          </form>
          <a class="popup-cerrar5" href="#">X</a>
    </div>
</div>

<div class="modal-wrapper6" id="popup6">
    <div class="popup-contenedor6">
        <div id="vari31"><h3>NOMBRE DEL NUEVO LOCAL</h3></div>
          <form id="fileUploadForm2" method="post">
            <input type="text" name="nuevomod" class='btnwsLD'><br><br>
            <button type="submit" name="button" class='btnrnLD' id="btnSubir2">ACEPTAR</button>

          </form>
          <a class="popup-cerrar5" href="#">X</a>
    </div>
</div>

  </body>
<script type="text/javascript">
$(document).ready(function(){
  $("#show1").click(function(){
    $("#element2").hide();
  });
    $("#show1").click(function(){
    $("#element3").hide();
  });
  $("#show1").click(function(){
  $("#element4").hide();
});
  $("#show1").click(function(){
    $("#element1").show();
  });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $("#show2").click(function(){
    $("#element1").hide();
  });
    $("#show2").click(function(){
    $("#element3").hide();
  });
  $("#show2").click(function(){
  $("#element4").hide();
});
  $("#show2").click(function(){
    $("#element2").show();
  });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $("#show3").click(function(){
    $("#element1").hide();
  });
    $("#show3").click(function(){
    $("#element2").hide();
  });
  $("#show3").click(function(){
  $("#element4").hide();
});
  $("#show3").click(function(){
    $("#element3").show();
  });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $("#show4").click(function(){
    $("#element2").hide();
  });
    $("#show4").click(function(){
    $("#element3").hide();
  });
  $("#show4").click(function(){
  $("#element1").hide();
});
  $("#show4").click(function(){
    $("#element4").show();
  });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
  $("#show31").click(function(){
    $("#element31").show();
  });
});
</script>

  <script type="text/javascript">

    function opcion(evt, opc) {
      var i, tabcontent, tablinks;

      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
      }

      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      document.getElementById(opc).style.display = "block";
      evt.currentTarget.className += " active";
    }

    function Subopcion(evt, opc2) {
      var e, Subtabcontent, Subtablinks;

      Subtabcontent = document.getElementsByClassName("Subtabcontent");
      for (e = 0; e < Subtabcontent.length; e++) {
      Subtabcontent[e].style.display = "active";
      }

      Subtablinks = document.getElementsByClassName("Subtablinks");
      for (e = 0; e < tablinks.length; e++) {
      Subtablinks[e].className = Subtablinks[e].className.replace(" active", "");
      }

      document.getElementById(opc2).style.display = "block";
      evt.currentTarget.className += "active";
    }
  </script>

<script type="text/javascript">
    $(document).ready(function() {
    $("#cambio1").click(function(){
    $("img#imagencita").attr("src", "resources/btnRegistro.png");
    });
    });

    $(document).ready(function() {
    $("#cambio2").click(function(){
    $("img#imagencita").attr("src", "resources/btnCobranza.png");
    });
    });

    $(document).ready(function() {
    $("#cambio3").click(function(){
    $("img#imagencita").attr("src", "resources/btnBalance.png");
    });
    });

    $(document).ready(function() {
    $("#cambio4").click(function(){
    $("img#imagencita").attr("src", "resources/btnConfiguracion.png");
    });
    });


    $(document).ready(function() {
    $("#cambio1").click(function(){
    $("img#on").attr("src", "resources/on.png");
    });
    });

    $(document).ready(function() {
    $("#cambio2").click(function(){
    $("img#on").attr("src", "resources/on.png");
    });
    });

    $(document).ready(function() {
    $("#cambio3").click(function(){
    $("img#on").attr("src", "resources/on.png");
    });
    });
    $(document).ready(function() {
    $("#cambio4").click(function(){
    $("img#on").attr("src", "resources/on.png");
    });
    });
    </script>

    <script>
        function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
        return true;
        return /\d/.test(String.fromCharCode(keynum));
        }
        </script>
        <script type="text/javascript">
          console.log("Hola");
          var fecha = "<?php echo date('Y-m-d'); ?>";
          var x = fecha.split("-");
          fecha = x[1] + "-" + x[2] + "-" + x[0];
            $.ajax({
              url : 'obtenerOcupados.php',
              type : 'GET'
            }).done(function(data){

              $.each(JSON.parse(data),function(i,item){
                var z = item.fecha_pago.split("-");
                var fecha2 = z[1] + "-" + z[2] + "-" + z[0];
                if(fecha >= fecha2){
                  $('#'+item.nombre_local).attr('fill','#EF5350');
                }
                if(fecha < fecha2){
                  $('#'+item.nombre_local).attr('fill','#AED581');
                }
                console.log(item.fecha_pago);

              });
            });
          </script>



          <script>
          $(document).ready(function () {
    $("#btnSubir").click(function (event) {
        event.preventDefault();
        var form = $('#fileUploadForm')[0];
        var data = new FormData(form);
        data.append("CustomField", "This is some extra data, testing");
        $("#btnSubir").prop("disabled", false);
          window.location.href = '#popup4';
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "archivos/subir.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {
              window.location.href = 'menu.php?on=res';
            },
            error: function (e) {


            }
        });

    });

});
</script>

          <script>
          $(document).ready(function () {
    $("#btnSubir1").click(function (event) {
        event.preventDefault();
        var form = $('#fileUploadForm1')[0];
        var data = new FormData(form);
        data.append("CustomField", "This is some extra data, testing");
        $("#btnSubir1").prop("disabled", false);
          window.location.href = '#popup4';
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "modificar.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (data) {
              window.location.href = 'menu.php?on=res';
            },
            error: function (e) {


            }
        });

    });

    });
		</script>

    <script>
    $(document).ready(function () {
$("#btnSubir2").click(function (event) {
  event.preventDefault();
  var form = $('#fileUploadForm2')[0];
  var data = new FormData(form);
  data.append("CustomField", "This is some extra data, testing");
  $("#btnSubir2").prop("disabled", false);
    window.location.href = '#popup4';
  $.ajax({
      type: "POST",
      enctype: 'multipart/form-data',
      url: "nuevo.php",
      data: data,
      processData: false,
      contentType: false,
      cache: false,
      timeout: 600000,
      success: function (data) {
        window.location.href = 'menu.php?on=res';
      },
      error: function (e) {


      }
  });

});

});
</script>


</html>
