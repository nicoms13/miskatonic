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
      $url = 'hhtps://'.$_SERVER['HTTP_HOST'];

      $txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
      $txtName = (isset($_POST['txtName']))?$_POST['txtName']:"";
      $txtAutor = (isset($_POST['txtAutor']))?$_POST['txtAutor']:"";
      $txtDesc = (isset($_POST['txtDesc']))?$_POST['txtDesc']:"";

      $txtIMG = (isset($_POST['txtIMG']))?$_POST['txtIMG']:"";
      $txtPDF = (isset($_POST['txtPDF']))?$_POST['txtPDF']:"";
      $txtBack = (isset($_POST['txtBack']))?$_POST['txtBack']:"";

      $action = (isset($_POST['action']))?$_POST['action']:"";

      include "../classes/dbh.classes.php";
      $dbh = Dbh::connect();

      switch ($action) {
        case "add":

        $stmt = $dbh->prepare("SELECT id FROM autores WHERE name = :autor");
        $stmt->bindParam(':autor',$txtAutor);
        $stmt->execute();

        if($stmt->fetchColumn() > 0) {

          $stmt = $dbh->prepare("INSERT INTO libros (name, autor, descripcion, img, pdf, back) VALUES (:name, :autor, :descripcion, :img, :pdf, :back);");

          $stmt->bindParam(':name',$txtName);
          $stmt->bindParam(':autor',$txtAutor);
          $stmt->bindParam(':descripcion',$txtDesc);
          $stmt->bindParam(':img',$txtIMG);
          $stmt->bindParam(':pdf',$txtPDF);
          $stmt->bindParam(':back',$txtBack);

          $stmt->execute();
        }
          break;
        case "edit":

        $stmt = $dbh->prepare("SELECT id FROM autores WHERE name = :autor");
        $stmt->bindParam(':autor',$txtAutor);
        $stmt->execute();

        if($stmt->fetchColumn() > 0) {

            if (($txtName != "")&&($txtAutor != "")&&($txtDesc != "")&&($txtIMG != "")&&($txtPDF != "")&&($txtBack != "")) {
              $stmt = $dbh->prepare("UPDATE libros SET name=:name, autor=:autor, descripcion=:descripcion, img=:img, pdf=:pdf, back=:back WHERE id=:id;");

              $stmt->bindParam(':name',$txtName);
              $stmt->bindParam(':autor',$txtAutor);
              $stmt->bindParam(':descripcion',$txtDesc);
              $stmt->bindParam(':img',$txtIMG);
              $stmt->bindParam(':pdf',$txtPDF);
              $stmt->bindParam(':id',$txtID);
              $stmt->bindParam(':back',$txtBack);

              $stmt->execute();
            }
          }

          break;
        case "delete":
          break;
        case "select":
          $stmt = $dbh->prepare("SELECT * FROM libros WHERE id=:id;");

          $stmt->bindParam(':id',$txtID);

          $stmt->execute();
          $libro = $stmt->fetch(PDO::FETCH_LAZY);

          $txtName=$libro['name'];
          $txtAutor=$libro['autor'];
          $txtDesc=$libro['descripcion'];
          $txtIMG=$libro['img'];
          $txtPDF=$libro['pdf'];
          $txtBack=$libro['back'];
          break;
        case "remove":
          $stmt = $dbh->prepare("DELETE FROM libros WHERE id=:id;");

          $stmt->bindParam(':id',$txtID);

          $stmt->execute();
          break;
      }

      $stmt = $dbh->prepare("SELECT * FROM libros;");
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
            Libro
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
                <label for="txtAutor">Autor:</label>
                <input type="text" class="form-control" name="txtAutor" id="txtAutor" value="<?php echo $txtAutor; ?>" placeholder="Autor" required>
              </div>

              <div class="mb-2">
                <label for="txtDesc">Desc:</label>
                <input type="text" class="form-control" name="txtDesc" id="txtDesc" value="<?php echo $txtDesc; ?>" placeholder="Descripción" required>
              </div>

              <div class="mb-2">
                <label for="txtIMG">IMG:</label>
                <input type="text" class="form-control" name="txtIMG" id="txtIMG" value="<?php echo $txtIMG; ?>" required>
              </div>

              <div class="mb-2">
                <label for="txtPDF">PDF:</label>
                <input type="text" class="form-control" name="txtPDF" id="txtPDF" value="<?php echo $txtPDF; ?>" required>
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

      <div class="col-md-12">
        <table class="table table-bordered table-dark table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Autor</th>
              <th scope="col">Descripcion</th>
              <th scope="col">Portada</th>
              <th scope="col">PDF</th>
              <th scope="col">Acción</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($libros_info as $libro) { ?>
            <tr>
              <th scope="row"><?php echo $libro['id']; ?></th>
              <td><?php echo $libro['name']; ?></td>
              <td><?php echo $libro['autor']; ?></td>
              <td><?php echo $libro['descripcion']; ?></td>
              <td>
                <img src="<?php echo $libro['img']; ?>" width="100">
              </td>
              <td><?php echo $libro['pdf']; ?></td>

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