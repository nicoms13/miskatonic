<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles-login.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Miskatonic</title>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <form method="post" action="includes/login.inc.php">
                <h1>Iniciar sesión</h1>
                <input id="username" type="text" placeholder="Nombre de usuario" name="uid" required>
                <input id="password" type="password" placeholder="Contraseña" name="pwd" required>

                <?php
                if(isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if (($error == 'usernotfound') || ($error == 'wrongpwd')) {
                ?>
                <div class="alert alert-danger" role="alert">
                    Usuario o contraseña incorectos
                </div>

                <?php
                        }
                    }
                ?>

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
                <span id="registro">¿Aún no tienes cuenta? Regístrate <a href="signup.php">aquí</a></span>
            </form>

        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                   <h3 id="welcome1">Bienvenido a</h3><h1 id="welcome2"><a href="index.php"><b>Miskatonic</b></a></h1>
                </div>
            </div>
        </div>
    </div>

</body>
</html>