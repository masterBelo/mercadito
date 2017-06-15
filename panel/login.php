

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="css/estiloLogin.css">
    <link rel="stylesheet" href="css/style.css"/>

    <title>Mercadito Puerta del Sol</title>
  </head>
  <body>
    <main>
      <section id="login">
        <div class="car">
          <img src="resources/mercadito.png" alt="">
        </div>
        <div class="user">
          <div class="input1">
            <img src="resources/user.png" alt="">
              <form method="post" action="comprobar.php">
            <input type="text" placeholder="USUARIO" name="user">
          </div>
        </div>
        <div class="password">
          <div class="input2">
            <img src="resources/spell.png" alt="">
            <input type="password" placeholder="CONTRASEÑA" name="password">
          </div>
        </div>
        <div class="opciones">
          <label class="control control--checkbox">
            <input type="checkbox" checked="checked"/>
            <div class="control__indicator"></div>
          </label>
          <p>RECORDAR</p>
          <a href="">¿OLVIDASTE TU CONTRASEÑA?</a>
        </div>
        <div class="boton">
            <input type="submit" class="button" value="ENTRAR">
            </div>
            </form>
      </section>
      </main>
      <footer>
        Copyright © Tekvia 2017 Todos los Derechos Reservados
      </footer>
  </body>
</html>
