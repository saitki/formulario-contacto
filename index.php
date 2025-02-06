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
    <title>Formulario de contacto</title>

    <style>
        .autor { font-size: 11px; text-align: center; }
        .autor a { color: hsl(228, 45%, 44%); }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>

    <!-- Mensajes de éxito o error -->
    <?php if (isset($errorMessage)) { echo "<p class='error'>$errorMessage</p>"; } ?>
    <?php if (isset($successMessage)) { echo "<p class='success'>$successMessage</p>"; } ?>

    <!-- Formulario -->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" class="formulario" enctype="multipart/form-data" method="post">
        <label for="name">Nombre</label>
        <input type="text" name="name" value="" required>

        <label for="lastname">Apellido</label>
        <input type="text" name="lastname" value="" required>

        <label>Selecciona una opción:</label><br>
        <input type="radio" name="option" value="1" id="option1" required>
        <label for="option1">Opción 1</label>

        <input type="radio" name="option" value="2" id="option2">
        <label for="option2">Opción 2</label>

        <label for="email">Correo electrónico</label>
        <input type="text" name="email" value="" required>

        <label for="message">Mensaje</label>
        <textarea name="message" required></textarea>

        <input type="submit" value="Enviar">
    </form>

    <div class="autor">
        Formulario de contacto @2025. Desarrollado por <a href="#">Alejandro Lenier Ireta Xiu</a>.
    </div>

</body>
</html>
