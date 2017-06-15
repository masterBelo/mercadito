<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/estiloPagina.css">
    <link rel="stylesheet" href="css/estiloDropdown.css">

    <title>Mercadito Puerta del Sol</title>
  </head>
  <body>
    <?php
    $on = ($_REQUEST['on']);
    if($on == 'market'){
      echo "<script>window.location.href = '#popup';</script>";
    }else {

    }
    ?>

      <section id="seccion1">
        <div class="columna1">
          <img src="resources/mercadito.png" alt="">
          <p>MERCADITO PUERTA DEL SOL</p>
        </div>
        <div class="columna2">
          <div class="filas">
          <div class="fila1">
            <p>¿Tienes dudas?</p>
          </div>
          <div class="fila2">
            <img src="resources/whats.png" alt="">
            <p>899 944 1098</p>
          </div>
        </div>
        </div>
      </section>
      <section id="seccion2">
        <div class="columna1">
          <div class="nav">
            <div class="dropdown">
              <button class="dropbtn">IDIOMA</button>
              <div class="dropdown-content">
                <a href="http://mercaditopuertadelsol.com"> <img src="resources/Mexico.svg" width="25px" height="15px" id="idioma"> ESPAÑOL</a>
                <a href="http://mercaditopuertadelsol.com/ing.php"> <img src="resources/UnitedKingdom.svg" width="25px" height="15px" id="idioma"> INGLES</a>
              </div>
            </div>
          </div>
        </div>
          <div class="columna2">
             <a href="http://mercaditopuertadelsol.com/cliente/php/archivos/form.php"> <button type="button" name="button">REGISTRAR</button> </a>
             <a href="http://mercaditopuertadelsol.com/cliente/index.php"> <button type="button" name="button">ENTRAR</button> </a>
          </div>
      </section>

    <main>
      <section id="seccion3">
        <div class="fila1">
          <p> RENTA UN LOCAL COMERCIAL </p>
        </div>
        <div class="fila2">
          <div class="columna1">
            <p> NORMAL X 1 DÍA = $50 MXN </p>
            <a href="http://mercaditopuertadelsol.com/cliente/index.php"> <button type="button" name="button">RENTAR</button> </a>
          </div>
          <div class="columna2">
            <p> CLASS &nbsp; &nbsp; X 1 DÍA = $100 MXN </p>
            <a href=http://mercaditopuertadelsol.com/cliente/index.php> <button type="button" name="button">RENTAR</button> </a>
          </div>
          <div class="columna3">
            <p> ULTRA &nbsp; &nbsp; X 1 MES = $900 MXN </p>
            <a href=http://mercaditopuertadelsol.com/cliente/index.php> <button type="button" name="button">RENTAR</button> </a>
          </div>
        </div>
        <div class="fila3">
          <p> NO ESPERES MAS Y HAZ NEGOCIO CON NOSOTROS </p>
        </div>
      </section>
      <section id="seccion4">
      </section>
      <section id="seccion5">
        <p> VISITANOS </p>
            <button type="button" name="button">ABRIR MAPAS</button>
        <img src="resources/fire.png" alt="">
      </section>
      <section id="seccion6">
        <form method="post" action="enviar.php">
        <button type="submit" name="button" > SUSCRIBETE</button>
        <input type="mail" placeholder="CORREO" name="correo">
      </form>
      </section>
      <section id="seccion7">
        <div class="columna1">
          <img src="resources/secure.png" alt="">
        </div>
        <div class="columna2">
          <p>TU PAGO ES 100% SEGURO</p>
          <p>NO ARRIESGUES TU OPORTUNIDAD</p>
        </div>
      </section>
      <section id="seccion8">
        <div class="caja">
          <p> PAGA AQUI </p>
          <p> SIN COMPLICACIONES </p>
        </div>
        <img src="resources/openpay.png" alt="">
      </section>
    </main>
    <footer>
        Copyright © Tekvia 2017 Todos los Derechos Reservados
    </footer>
    <div class="modal-wrapper" id="popup">
        <div class="popup-contenedor">
              ¡GRACIAS POR SUSCRIBIRTE!
           <a class="popup-cerrar" href="#">X</a>
        </div>
    </div>
  </body>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</html>
