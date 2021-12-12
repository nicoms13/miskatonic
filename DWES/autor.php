<?php
  session_start();

  if(!isset($_SESSION["userid"])) {
    header("Location: ./login.php");
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Miskatonic</title>
  <link rel="stylesheet" href="styles-autor.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet"/>
</head>

<?php

  $IDbook = $_GET['autor'];

  try {
    $username = "root";
    $password = "";
    $dbh = new PDO('mysql:host=localhost;dbname=loginmiskatonic', $username, $password);
  }
  catch (PDOException $e) {
    die();
  } 
    $stmt = $dbh->prepare("SELECT * FROM autores WHERE id=:id;");
    $stmt->bindParam(':id',$IDbook);

    $stmt->execute();

    $Current_book = $stmt->fetch(PDO::FETCH_LAZY);

?>

<body>
    <img id="portada" src="<?php echo $Current_book['back']; ?>">
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
          <h1><?php echo $Current_book['name'] ?></h1>

        </div>
      </div>
    <div class="carousel">
      <?php 

        $stmt = $dbh->prepare("SELECT * FROM libros WHERE autor=:name;");
        $txtName = $Current_book['name'];
        $stmt->bindParam(':name',$txtName);

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