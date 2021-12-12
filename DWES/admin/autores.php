<?php
  session_start();

  if(!isset($_SESSION["userid"])) {
    header("Location: ../index.php");
  }
  else {
    if($_SESSION["useruid"] !=='adminuser') {
      header("Location: ../index.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ADMINISTRADOR</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <?php 

      $txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
      $txtName = (isset($_POST['txtName']))?$_POST['txtName']:"";

      $txtLogo = (isset($_POST['txtLogo']))?$_POST['txtLogo']:"";
      $txtBack = (isset($_POST['txtBack']))?$_POST['txtBack']:"";

      $action = (isset($_POST['action']))?$_POST['action']:"";

      include "../classes/dbh.classes.php";
      $dbh = Dbh::connect();

      switch ($action) {
        case "add":
          $stmt = $dbh->prepare("INSERT INTO autores (name, logo, back) VALUES (:name, :logo, :back);");

          $stmt->bindParam(':name',$txtName);
          $stmt->bindParam(':logo',$txtLogo);
          $stmt->bindParam(':back',$txtBack);

          $stmt->execute();
          break;
        case "edit":

          if (($txtName != "")&&($txtIMG != "")&&($txtBack != "")) {
            $stmt = $dbh->prepare("UPDATE autores SET name=:name, logo=:logo, back=:back WHERE id=:id;");

            $stmt->bindParam(':name',$txtName);
            $stmt->bindParam(':logo',$txtIMG);
            $stmt->bindParam(':back',$txtBack);
            $stmt->bindParam(':id',$txtID);

            $stmt->execute();
          }

          break;
        case "delete":
          break;
        case "select":
          $stmt = $dbh->prepare("SELECT * FROM autores WHERE id=:id;");

          $stmt->bindParam(':id',$txtID);

          $stmt->execute();
          $libro = $stmt->fetch(PDO::FETCH_LAZY);

          $txtName=$libro['name'];
          $txtIMG=$libro['logo'];
          $txtBack=$libro['back'];
          break;
        case "remove":
          $stmt = $dbh->prepare("DELETE FROM autores WHERE id=:id;");

          $stmt->bindParam(':id',$txtID);

          $stmt->execute();
          break;
      }

      $stmt = $dbh->prepare("SELECT * FROM autores;");
      $stmt->execute();
      $libros_info = $stmt->fetchAll(PDO::FETCH_ASSOC);

    ?>

      <div class="navbar">
        <nav>
          <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="index.php">Libros</a></li>
            <li><a href="autores.php">Autores</a></li>
            <li><a href="suscripcion.php">Suscripción</a></li>
          </ul>
        </nav>
      </div>

      <div class="col-md-5">

        <div class="card text-white bg-dark mb-3">
          <div class="card-header">
            Autor
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
              <div class="mb-2">
                <label for="txtID">ID:</label>
                <input type="text" class="form-control" name="txtID" id="txtID" value="<?php echo $txtID; ?>" placeholder="ID" readonly>
              </div>

              <div class="mb-2">
                <label for="txtName">Nombre:</label>
                <input type="text" class="form-control" name="txtName" id="txtName" value="<?php echo $txtName; ?>" placeholder="Nombre" required>
              </div>

              <div class="mb-2">
                <label for="txtLogo">Logo:</label>
                <input type="text" class="form-control" name="txtLogo" id="txtLogo" value="<?php echo $txtLogo; ?>" required>
              </div>

              <div class="mb-2">
                <label for="txtBack">Background:</label>
                <input type="text" class="form-control" name="txtBack" id="txtBack" value="<?php echo $txtBack; ?>" required>
              </div>

              <div class="btn-group" role="group">
                <button type="submit" class="btn btn-success" name="action" value="add">Agregar</button>
                <button type="submit" class="btn btn-warning" name="action" value="edit">Editar</button>
                <button type="submit" class="btn btn-danger" name="action" value="delete">Eliminar</button>
              </div>
            </form>
          </div>
        </div>


      </div>

      <div class="col-md-7">
        <table class="table table-bordered table-dark table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Logo</th>
              <th scope="col">Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($libros_info as $libro) { ?>
            <tr>
              <th scope="row"><?php echo $libro['id']; ?></th>
              <td><?php echo $libro['name']; ?></td>
              <td>
                <img src="<?php echo $libro['logo']; ?>" width="100">
              </td>
              <td>

                <form method="POST">

                  <input type="hidden" name="txtID" id="txtID" value="<?php echo $libro['id']; ?>">
                  <input type="submit" name="action" value="select" class="btn btn-primary">
                  <input type="submit" name="action" value="remove" class="btn btn-danger">
                  
                </form>
              </td>

            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

</body>