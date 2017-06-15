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
     $nombre=$row['nombre_cliente'];
     $celular=$row['celular_cliente'];
     $correo=$row['correo_cliente'];
     $domicilio=$row['domicilio_cliente'];
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
    <link rel="stylesheet" href="../assets/css/panelEstilos.css">
    <link rel="stylesheet" href="../assets/css/estiloForm.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
  </head>
  <body>
    <div class="linea">
    </div>
    <nav>
      <div class="logo">
      <a href="../panel/"></a>  <img src="../resources/mercadito.png" alt="">
        <span>Mercadito</span>
      </div>
      <ul id="opciones">
        <li><a href="../rentar/">Rentar local nuevo</a></li>
        <li><a href="../rentaActiva/">Rentas activas</a></li>
        <li><a href="../ordenes/">Ordenes de pago</a></li>
        <li><a href="../comprobantes/">Comprobantes</a></li>
      </ul>
      <a href="../php/matar.php"><button id="botonCerrar" class="ui orange inverted button">Cerrar sesion</button></a>
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
        <li><a href="../rentaActiva/">Rentas activas</a></li>
        <li><a href="../ordenes/">Ordenes de pago</a></li>
        <li><a href="../comprobantes/">Comprobantes</a></li>
        <li><a href="../php/matar.php">Cerrar Sesión</a></li>
      </ul>
    </aside>
    <main>

      <section class="infocliente">
        <div class="hg">

      <div class="ui card trarget">
    <div class="content">
      <div class="header"><h2 class="cardtxt">DATOS PERSONALES</h2></div>
    </div>
    <div class="content">
      <h4 class="ui sub header">Información de perfil</h4>
      <div class="ui small feed cardcontxt">
        <div class="event">
          <div class="content">
            <div class="summary">
               Nombre: <div class="txt1"><?php echo "$nombre"; ?></div>
            </div>
          </div>
        </div>
        <div class="event">
          <div class="content">
            <div class="summary">
               Celular: <div class="txt1"><?php echo "$celular"; ?></div>
            </div>
          </div>
        </div>
        <div class="event">
          <div class="content">
            <div class="summary">
               Correo: <div class="txt1"><?php echo "$correo"; ?></div>
            </div>
          </div>
        </div>
        <div class="event">
          <div class="content">
            <div class="summary">
               Domicilio: <div class="txt1"><?php echo "$domicilio"; ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="extra content">
      <?php echo "<img class='ife' src='../php/archivos/$ife'>"; ?>
      <br><br>
      <a  id="editars"><button class="ui button">EDITAR</button></a>
    </div>
  </div>
</div>
</section>
    </main>

    <footer class="abajeno">
      Copyright © Tekvia 2017 Todos los Derechos Reservados
    </footer>
  </body>


  <div class="ui modal modalito" id="modalito1">
  <div class="header arribarriba">EDITAR PERFIL</div>
  <div class="content">
    <form method="post" id="fileUploadForm" onsubmit="return forM(this)" enctype="multipart/form-data" >
    <h4 class="editxt">Nombre:</h4>
    <?php echo "<input id='nombre' class='ediint' name='nombre' type='text' value='$nombre' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = '$nombre';}'>"; ?>
    <h4 class="editxt">Celular:</h4>
    <?php echo "<input id='nick2' class='ediint' maxlength='10' onkeypress='return justNumbers(event);' name='celular' type='tel' value='$celular' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = '$celular';}'>"; ?>
    <h4 class="editxt">Correo:</h4>
    <?php echo "<input id='nick' class='ediint' name='correo' type='text' value='$correo' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = '$correo';}'><br><br>"; ?>
    <h4 class="editxt">Direccion:</h4>
    <?php echo "<input id='domicilio' class='ediint' name='domicilio' type='text' value='$domicilio' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = '$domicilio';}'><br><br>"; ?>
    <h4 class="editxt">Identificación:</h4>
    <?php $archivo = substr("$ife", 22); ?>
    <input class="filint" type="text" placeholder="<?php echo "$archivo"; ?>" name="contrato1" id="ife1" required disabled/> <label for="ife" class="botoncillo"><i class="fa fa-upload" aria-hidden="true"></i></label><br><br>
    <div class="notoy"><input type="file" name="ife" id="ife" onchange="ife1.value = this.value">  </div>
    <?php echo "<input type='hidden' name='id' value='$id'>"; ?>
    <?php echo "<input type='hidden' name='dirife' value='$ife'>"; ?>
    <button type="submit" class="ui primary button" id="btnSubir">
    Guardar
    </button>
    </form><br>
    <a id="editarsc"><button class="ui button">
      Cancelar
    </button></a><br><br>
  </div>
</div>

    <div class="ui modal modalitox" id="modalito2">
      <div class="header modalitox">Actualizando información por favor espere...</div>
      <div class="content modalitox">
        <img src="../resources/loading1.gif">
      </div>
    </div>



  <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script src="../assets/sweetalert/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/sweetalert/dist/sweetalert2.min.css">
    <script src="../assets/semantic/semantic.min.js"></script>
    <script type="text/javascript" src="../assets/js/menuJs.js" ></script>




    <script>
                  $(document).ready(function() {
                  $('#editars').click(function(){
                    $('#modalito1')
                    .modal('show');
                  });
                  });

                  $(document).ready(function() {
                  $('#editarsc').click(function(){
                    $('#modalito1')
                    .modal('hide');
                  });
                  });
                  </script>

                  <script>
                  $(document).ready(function () {
                  $("#btnSubir").click(function (event) {
                    if($("#nombre").val().length < 1) {
                            swal(
                          'El nombre es obligatorio',
                          '',
                          'error'
                          )
                            return false;
                        }
                        else if (!$("#nombre").val().match(/^[a-zA-Z\sñ.]+$/)) {
                          document.getElementById("nombre").value='';
                          swal(
                        'Nombre invalido',
                        'Agrege texto A-Z o a-z',
                        'error'
                        )
                            return false;

                        }
                        else if ($("#nick2").val().length < 1) {
                          swal(
                        'El número es obligatorio',
                        '',
                        'error'
                        )
                            return false;
                        }else if ($("#nick").val().length < 1) {
                          swal(
                        'El correo es obligatorio',
                        '',
                        'error'
                        )
                            return false;
                        }
                        else if (!$("#nick").val().match(/^[0-9a-zA-Z\sñ@.-_]+$/)) {
                          document.getElementById("nick").value='';
                          swal(
                        'Correo invalido',
                        'Ingrese un correo valido',
                        'error'
                        )
                            return false;

                        }
                        else if ($("#domicilio").val().length < 1) {
                          swal(
                        'El domicilio es obligatorio',
                        '',
                        'error'
                        )
                            return false;
                          }
                          else if (!$("#domicilio").val().match(/^[0-9a-zA-Z\s,ñ#.]+$/)) {
                            document.getElementById("domicilio").value='';
                            swal(
                          'Dirección invalida',
                          'Agrege una direccion valida evite utilizar (.?¿¡!&%$/*[]"")',
                          'error'
                          )
                              return false;


                      }else if ($("#nick").val().indexOf('@', 0) == -1 || $("#nick").val().indexOf('.', 0) == -1){
                      }
                      else{
                  event.preventDefault();
                  var form = $('#fileUploadForm')[0];
                  var data = new FormData(form);
                  data.append("CustomField", "This is some extra data, testing");
                  $('#modalito1')
                  .modal('hide');
                  $('#modalito2')
                  .modal('show');
                  $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: "../php/actualizar.php",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                    success: function (data) {
                      window.location.href = 'index.php';
                    },
                    error: function (e) {
                    }
                });
              }
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
</html>
