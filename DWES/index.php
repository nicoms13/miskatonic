<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Miskatonic</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet"/>
</head>

<?php

   session_start();

  define("MAX_TIME", 360);

  if (isset($_SESSION["time"])) {

    $inicio = $_SESSION["time"];
    if (time() >= $inicio+MAX_TIME) { 
      include "includes/logout.inc.php";
      header("Location:login.php");
    }
  }
?>

<body>

    <div class="container">

      <div class="navbar">
        <nav>
          <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="">Categorías</a></li>
            <li><a href="autores.php">Autores</a></li>
            <li><a href="suscripcion.php">Suscripción</a></li>
            <?php
            if(isset($_SESSION["userid"])) {
              if($_SESSION["useruid"]=='adminuser') {
            ?>
            <li><a class="logout-button" href="admin/index.php">Administrador</a></li>
            <?php
            }
            ?>
            <li><a class="logout-button" href="includes/logout.inc.php">Cerrar sesión</a></li>
            <?php
            }
            ?>
          </ul>
        </nav>

        <?php
          if(isset($_SESSION["userid"])) {
        ?>
          
          <button onclick="window.location.href='';" type="button" class="menu-icon"><?php echo $_SESSION["useruid"]; ?></button>

        <?php
        }
        else {
        ?>

         <button onclick="window.location.href='login.php';" type="button" class="menu-icon">Iniciar sesión</button> 

        <?php
        }
        ?>
        
      </div>

      <div class="menu">
        <div class="column">
          <h1>Miskatonic</h1>
          <p>Los mayores éxitos en ventas, las historias más rompedoras y los clásicos inolvidables que nos han convertido en quienes somos. Todo en Miskatonic.</p>
          <button onclick="window.location.href='suscripcion.php';" type="button">Suscríbete</button>
        </div>
      </div>

    </div>

    <div class="spacer layer1"></div>



    <div class="carousel">
      <?php 

      try {
        $username = "root";
        $password = "";
        $dbh = new PDO('mysql:host=localhost;dbname=loginmiskatonic', $username, $password);
      }
      catch (PDOException $e) {
        die();
      } 
        $stmt = $dbh->prepare("SELECT * FROM libros;");

        $stmt->execute();

        $book_list = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($book_list as $book) {
      ?>

      <div onclick= "window.location='book.php?book=<?php echo $book['id'] ?>';" class="book_card"><img src="<?php echo $book['img'] ?>" width="300px" height="500px"></div>

      <?php 
        }
      ?>
      
    </div>

</body>