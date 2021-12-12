<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles-signup.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Miskatonic</title>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <form method="post" action="includes/signup.inc.php">
                <h1>Nueva cuenta</h1>
                <input id="username" type="text" placeholder="Nombre de usuario" name="uid" required>
                <input id="mail" type="text" placeholder="Email" name="email" required>
                <input id="password" type="password" placeholder="Contraseña" name="pwd" required>
                <input id="repeat_password" type="password" placeholder="Repite la contraseña" name="pwdRepeat" required>

                <?php
                if(isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error == 'emptyInput') {
                ?>
                <div class="alert alert-danger" role="alert">
                    No puedes dejar ningún campo vacío
                </div>

                <?php
                        }
                    }
                ?>

                <?php
                if(isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error == 'invalidUid') {
                ?>
                <div class="alert alert-danger" role="alert">
                    El usuario que has intoducido no cumple con el formato
                </div>

                <?php
                        }
                    }
                ?>

                <?php
                if(isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error == 'invalidMail') {
                ?>
                <div class="alert alert-danger" role="alert">
                    El mail que has introducido es incorrecto
                </div>

                <?php
                        }
                    }
                ?>

                <?php
                if(isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error == 'pwdMatch') {
                ?>
                <div class="alert alert-danger" role="alert">
                    Las contaseñas no coinciden
                </div>

                <?php
                        }
                    }
                ?>

                <?php
                if(isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error == 'usersMatch') {
                ?>
                <div class="alert alert-danger" role="alert">
                    El usuario que has intoducido no está disponible
                </div>

                <?php
                        }
                    }
                ?>

                <?php
                if(isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error == 'stmtFailed') {
                ?>
                <div class="alert alert-danger" role="alert">
                    No se ha podido conectar con la base de datos
                </div>

                <?php
                        }
                    }
                ?>

                <button type="submit" name="submit">Enviar</button>
                <span id="registro">Al registrarte aceptas nuestros <a href="">téminos y condiciones</a></span>
            </form>

        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                   <h3 id="welcome1">Crea tu cuenta en</h3><h1 id="welcome2"><a href="index.php"><b>Miskatonic</b></a></h1>
                </div>
            </div>
        </div>
    </div>

</body>
</html>