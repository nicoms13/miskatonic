<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Miskatonic</title>
  <link rel="stylesheet" href="styles-suscripcion.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:wght@200&display=swap" rel="stylesheet"/>
  <script src="https://kit.fontawesome.com/3e97fafe51.js" crossorigin="anonymous"></script>
</head>

<body>

    <span onclick="window.location.href='index.php';" id="back-arrow"><i class="fas fa-backspace"></i></span>

    <div class="container"></div>

    <div class="subscribe">
      <div class="adv adv-1">
        <h3>Lee todo lo que quieras. Cancela en </br> cualquier momento.</h3>
        <h1>8,99 €/mes</h1>
        <?php
          session_start();
          if(isset($_SESSION["userid"])) {
        ?>
          
          <button id="sub" onclick="window.location.href='';" type="button">Suscríbete ya</button>

        <?php
        }
        else {
        ?>

         <button id="sub" onclick="window.location.href='login.php';" type="button">Suscríbete ya</button> 

        <?php
        }
        ?>
      </div>
      <div class="adv adv-2">
        <h3>Obtén un 35 % de descuento con una </br> suscripción anual.</h3>
        <h1>69,99 €/año</h1>
        <?php
          if(isset($_SESSION["userid"])) {
        ?>
          
          <button id="aho" onclick="window.location.href='';" type="button">Ahorra ya</button>

        <?php
        }
        else {
        ?>

         <button id="aho" onclick="window.location.href='login.php';" type="button">Ahorra ya</button> 

        <?php
        }
        ?>
      </div>
    </div>

</body>



