<?php 
require_once __DIR__ . '/DB/db.php'; 
require_once __DIR__ . '/functions.php'; 

$nameError = $lastnameError = $emailError = "";
$name = $lastname = $email = ""; // Para guardar los valores
$conexion = conexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valid = true; // Flag para controlar si todo es válido
    
    if (empty($_POST["name"])) {
        $nameError = "Este campo es obligatorio";
        $valid = false;
    } else {
        $name = $_POST["name"];
    }

    if (empty($_POST["lastname"])) {
        $lastnameError = "Este campo es obligatorio";
        $valid = false;
    } else {
        $lastname = $_POST["lastname"];
    }

    if (empty($_POST["email"])) {
        $emailError = "Este campo es obligatorio";
        $valid = false;
    } else {
        $email = $_POST["email"];
    }

    if (empty($_POST["message"])) {
        $messageError = "Este campo es obligatorio";
        $valid = false;
    } else {
        $message = $_POST["message"];
    }

    if (empty($_POST["option"])) {
        $optionError = "Este campo es obligatorio";
        $valid = false;
    } else {
        $option = $_POST["option"];
    }

    if (empty($_POST["checkcontacted"])) {
        
        $checkcontactedError = "Para enviar este formulario, por favor consiente ser contactado";
        $valid = false;
    } else {
        
        $checkcontacted = $_POST["checkcontacted"];
    }

    if ($valid) {
        $status = addUser($name, $lastname, $option, $message, $email, $checkcontacted, $conexion);
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showCustomAlert('Éxito', " . json_encode($status) . ");
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showCustomAlert('Error', 'Por favor, complete todos los campos obligatorios.');
            });
        </script>";
    }
    
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Formulario de contacto</title>
    <link href="css/style.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .autor { font-size: 11px; text-align: center; }
        .autor a { color: hsl(228, 45%, 44%); }
        .error { color: red; }
        .success { color: green; }
        :root {
            --green-200: hsl(148, 38%, 91%);
            --green-600: hsl(169, 82%, 27%);
            --red-600: hsl(0, 66%, 56%);
            --white: hsl(0, 0%, 100%);
            --gray-700: hsl(187, 24%, 22%);
            --font-primary: 'Karla', sans-serif;
        }
        
body {
    background-color: aquamarine;
    padding-bottom: 50px; /* Ajusta según la altura del footer */
}

.form-control {
    transition: border-color 0.3s, box-shadow 0.3s;
}
.container{
    background: white;
    border-radius: 20px; /* Bordes redondeados */
    border: 0px solidrgb(255, 255, 255);

}
.card{
    background: white;
    border-radius: 20px; /* Bordes redondeados */
    border: 0px solidrgb(255, 255, 255);

}
.form-control:hover {
    border-color: #3d685e; 

}

.form-control:focus {
    border-color: #3d685e; 
    outline: none; 
}

.form-control:active {
    border-color: #3d685e;
}

.form-control.is-invalid {
    border-color: #dc3545; 
}
.error {
    color: #dc3545; 
    font-size: 0.875rem;
    margin-top: 5px;
}

button:hover {
    background-color: #0056b3; 
    border-color: #004085; 
}

button:focus {
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5); 
}

button:active {
    background-color: #004085; 
    border-color: #003366;
}

button:active {
    background-color: #004085; 
    border-color: #003366;
}

        /* Estilos para el contenedor de la alerta */
.custom-alert {
    position: fixed;
    top: 20px; /* Ubicación en la parte superior */
    left: 30%;
    transform: translateX(-0%); /* Centra la alerta horizontalmente */
    background-color: #2a4244; /* Fondo rojo claro */
    color: #f1fdff; /* Texto rojo oscuro */
    border: 1px solid #2a4244;
    border-radius: 10px; /* Bordes redondeados */
    padding: 15px 25px;
    width: 80%; /* Ancho ajustable */
    max-width: 500px; /* Máximo ancho */
    display: none; /* Oculto por defecto */
    z-index: 9999; /* Asegura que esté sobre otros elementos */
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.custom-alert .alert-content {
    text-align: left; /* Centra el contenido dentro de la alerta */
}

.custom-alert .alert-content strong {
    font-size: 1.2em; /* Título más grande */
    display: block;
}

.custom-alert .alert-content p {
    margin: 5px 0 0;
}

/* Animación de aparición de la alerta */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.icon {
  width: 24px;
  height: 24px;
}
#alert-title {
    display: inline-flex;
    align-items: center;
    gap: 5px; /* Espaciado entre el icono y el texto */
}
@media (min-width: 768px) {
            .container {
                max-width: 700px;
            }
        }




.autor a {
    color: #1abc9c; /* Color del enlace */
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.autor a:hover {
    color: #16a085; /* Color del enlace al pasar el mouse */
    text-decoration: underline;
}
html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

.contenido {
    flex: 1; /* Hace que el contenido ocupe el espacio disponible */
}

.autor {
    width: 100%;
    background-color: #f8f9fa; /* Color de fondo */
    text-align: center;
    padding: 10px;
    font-size: 14px;
    border-top: 1px solid #ccc; /* Línea superior */
}

    </style>
</head>
<body>
<svg xmlns="http://www.w3.org/2000/svg" class="d-none" >
  <symbol id="check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>

<div id="customAlert" class="custom-alert">
    <div class="alert-content">
    <svg class="bi flex-shrink-0 me-2 icon" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
    <p id="alert-title" style="font-size: 20px;"> ¡Alerta!</p>
        <p id="alert-message">Este es el contenido de la alerta.</p>
    </div>
</div>
    <div class="card container w-50 p-5" style="width: 18rem; margin-top: 120px; margin-bottom: 40px;">
     <form id="myForm" action="<?= $_SERVER['PHP_SELF'] ?>" class="formulario" enctype="multipart/form-data" method="post">
        
     <label for="name" class="form-label" style="font-size: 30px; margin-bottom:20px; font-weight: bold;">Contactanos</label>
        <div class="row ">
            <div class="mb-3 col align-self-start">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control <?php echo !empty($nameError) ? 'is-invalid' : ''; ?>" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>">
                <?php if (!empty($nameError)): ?>
                    <div class="error"><?php echo $nameError; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3 col">
                <label for="lastname" class="form-label">Apellido</label>
                <input type="text" class="form-control <?php echo !empty($lastnameError) ? 'is-invalid' : ''; ?>"  name="lastname" id="lastname" aria-describedby="lastnameHelp" >
                <?php if (!empty($lastnameError)): ?>
                    <div class="error"><?php echo $lastnameError; ?></div>
                <?php endif; ?>        
            </div>   
     
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control <?php echo !empty($emailError) ? 'is-invalid' : ''; ?>" name="email" id="email" aria-describedby="emailHelp" >
                <?php if (!empty($emailError)): ?>
                    <div class="error"><?php echo $emailError; ?></div>
                <?php endif; ?>                
            </div>

            <div class=" mb-3 ">
                <div class="row ">
                <label class="form-label">Selecciona una opción</label><br>
                <div class="form-control col option-container" style="margin-left: 10px;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="flexRadioDefault1" name="option" value="1">
                        <label class="form-check-label" for="flexRadioDefault1"> Opción 1 </label>
                    </div>
                </div>
                <div class="form-control col option-container" style="margin-left: 10px; margin-right: 10px;">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="option" id="flexRadioDefault2" value="2">
                        <label class="form-check-label" for="flexRadioDefault2">Opción 2 </label>
                    </div>
                </div>

                <style>
                    .active-container {
                        border-color: #3d685e;
                        background-color: #e0f7fa; /* Fondo ligero para destacar */
                    }
                </style>

                <script>
                    document.querySelectorAll(".form-check-input").forEach(input => {
                        input.addEventListener("change", function() {
                            document.querySelectorAll(".option-container").forEach(container => {
                                container.classList.remove("active-container");
                            });
                            this.closest(".option-container").classList.add("active-container");
                        });
                    });
                </script>

                <?php if (!empty($optionError)): ?>
                    <div class="error"><?php echo $optionError; ?></div>
                <?php endif; ?>   
                </div>
            </div>   
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Mensaje</label>
             <textarea class="form-control <?php echo !empty($messageError) ? 'is-invalid' : ''; ?>"   name="message" id="exampleFormControlTextarea1" rows="3" ></textarea>
             <?php if (!empty($messageError)): ?>
                <div class="error"><?php echo $messageError; ?></div>
            <?php endif; ?>   
        </div>
        
        <div class="mb-3 ">
            <input type="checkbox" class="form-check-input" id="checkcontacted"  name="checkcontacted" value="1" >
            <label class="form-check-label"   for="checkcontacted">Autorizó para ser contactado por el equipo</label>
            <?php if (!empty($checkcontactedError)): ?>
                <div class="error"><?php echo $checkcontactedError; ?></div>
            <?php endif; ?>   
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        <!-- Mensajes de éxito o error -->


    </div>
    <script>
  document.getElementById('myForm').addEventListener('submit', function(event) {
    const checkbox = document.getElementById('checkcontacted');
    if (!checkbox.checked) {
      // Si no está marcado, enviamos un valor de 0
      checkbox.value = "0";
    }
  });
</script>



<script>
    // Validación en el lado del cliente (JavaScript)
  
   function showCustomAlert(title, message) {
    const alertElement = document.getElementById('customAlert');
    const alertTitle = document.getElementById('alert-title');
    const alertMessage = document.getElementById('alert-message');
    
    // Cambiar el contenido de la alerta
    alertTitle.textContent = title;
    alertMessage.textContent = message;

    // Mostrar la alerta
    alertElement.style.display = 'block';  // Asegúrate de que se muestre cada vez que se llame

    // Ocultar la alerta después de un tiempo (3 segundos)
    setTimeout(function() {
        alertElement.style.display = 'none'; // Volver a ocultar
    }, 3000);
}


// Ejemplo de uso: Mostrar la alerta con título y mensaje

</script>
</div>
<footer class="autor" style="margin-top: 60px;">
        Formulario de contacto @2025. Desarrollado por <a href="#">Alejandro Lenier Ireta Xiu</a>.
</footer>
</body>
</html>
