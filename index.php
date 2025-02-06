<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- displays site properly based on user's device -->

  <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png">
  
  <title>Formulario de contacto</title>

<!-- Es opcional eliminar estos estilos o personalizarlos en su propia hoja de estilos 👍 -->
  <style>
    .autor { font-size: 11px; text-align: center; }
    .autor a { color: hsl(228, 45%, 44%); }
  </style>
</head>
<body>

  <form action="<?=$_SERVER['PHP_SELF']?>" class="formulario" enctype="multipart/form-data" method="post">
    <input type="hidden" name="action" value="updateuser">

    <input type="hidden" name="id_usuario" value="">
    <input type="hidden" name="id" value="">


      <label for="name">Nombre</label>
      <input type="text" name="name" value="">

      <label for="lastname">Apellido</label>
      <input type="text" name="lastname" value="">

      <label for="email">Correo electrónico</label>
      <input type="text" name="email" value="">

      <label for="message">Mensaje</label>
      <textarea name="message"></textarea>

      <input type="submit" value="Submit">

  </form>
  <div class="autor">
    Formulario de contacto @2025</a>. 
    Desarrollado por <a href="#">Alejandro Lenier Ireta Xiu</a>.
  </div>
</body>
</html>