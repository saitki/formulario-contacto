<?php 
require_once __DIR__ . '/DB/db.php'; 
require_once __DIR__ . '/functions.php'; 

$conexion = conexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $option = $_POST["option"];
    $message = $_POST["message"];
    $email = $_POST["email"];

    addUser($name, $lastname, $option, $message, $email, $conexion);


}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

    <title>Formulario de contacto</title>

    <style>
        .autor { font-size: 11px; text-align: center; }
        .autor a { color: hsl(228, 45%, 44%); }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>



    <div class="card container w-50 p-5" style="width: 18rem; margin-top: 40px; margin-bottom: 40px;">
     <form action="<?= $_SERVER['PHP_SELF'] ?>" class="formulario" enctype="multipart/form-data" method="post">
        
     <label for="name" class="form-label" style="font-size: 30px; margin-top:-40px;">Contactanos</label>
     <div class="">
        <div class="row ">
        <div class="mb-3 col align-self-start">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" required>
            <div id="nameHelp" class="form-text"></div>
        </div>
        <div class="mb-3 col">
            <label for="lastname" class="form-label">Apellido</label>
            <input type="text" class="form-control"  name="lastname" id="lastname" aria-describedby="lastnameHelp" required>
            <div id="lastnameHelp" class="form-text"></div>
        </div>
        </div>
    </div>   
     


        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text"></div>
        </div>

        <div class=" mb-3 ">
            <div class="row ">
            <label  class="form-label">Selecciona una opción</label><br>

                <div class="form-check col" style="margin-left: 10px;">
                <input class="form-check-input" type="radio" id="flexRadioDefault1" name="option" value="1" checked>
                <label class="form-check-label" for="flexRadioDefault1"> Opción 1 </label>

                </div>
                <div class="form-check col" style="margin-left: 10px;">
                <input class="form-check-input" type="radio" name="option" id="flexRadioDefault2"  value="2" >
                <label class="form-check-label" for="flexRadioDefault2">Opción 2 </label>
                </div>
            </div>
    </div>   


       
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Mensaje</label>
             <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3" required></textarea>
        </div>
        
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- Mensajes de éxito o error -->
        <?php if (isset($errorMessage)) { echo "<p class='error'>$errorMessage</p>"; } ?>
    <?php if (isset($successMessage)) { echo "<p class='success'>$successMessage</p>"; } ?>


    </div>
    <div class="autor">
        Formulario de contacto @2025. Desarrollado por <a href="#">Alejandro Lenier Ireta Xiu</a>.
    </div>

</body>
</html>
