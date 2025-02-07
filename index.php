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
        $message = $_POST["option"];
    }

    if (empty($_POST["checkcontacted"])) {
        $checkcontactedError = "Para enviar este formulario, por favor consiente ser contactado";
        $valid = false;
    } else {
        $checkcontacted = $_POST["checkcontacted"];
    }

    if ($valid) {
        addUser($name, $lastname, $option, $message, $email, $checkcontacted, $conexion);
    } else {
        echo "Por favor complete todos los campos.";
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

.form-control {
    transition: border-color 0.3s, box-shadow 0.3s;
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


        
    </style>
</head>
<body>



    <div class="card container w-50 p-5" style="width: 18rem; margin-top: 40px; margin-bottom: 40px;">
     <form id="myForm" action="<?= $_SERVER['PHP_SELF'] ?>" class="formulario" enctype="multipart/form-data" method="post">
        
     <label for="name" class="form-label" style="font-size: 30px; margin-top:-40px;">Contactanos</label>
     <div class="">
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
            <label  class="form-label">Selecciona una opción</label><br>
                <div class="form-control col" style="margin-left: 10px;">
                    <div class="form-check " >
                    <input class="form-check-input" type="radio" id="flexRadioDefault1" name="option" value="1">
                    <label class="form-check-label" for="flexRadioDefault1"> Opción 1 </label>

                    </div>
                </div>
                <div class="form-control col"  style="margin-left: 10px; margin-right: 10px;">
                    <div class="form-check ">
                    <input class="form-check-input" type="radio" name="option" id="flexRadioDefault2"  value="2" >
                    <label class="form-check-label" for="flexRadioDefault2">Opción 2 </label>
                    </div>
                </div>
            </div>
            <?php if (!empty($optionError)): ?>
                <div class="error"><?php echo $optionError; ?></div>
            <?php endif; ?>   
    </div>   
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Mensaje</label>
             <textarea class="form-control <?php echo !empty($emailError) ? 'is-invalid' : ''; ?>"   name="message" id="exampleFormControlTextarea1" rows="3" ></textarea>
             <?php if (!empty($messageError)): ?>
                <div class="error"><?php echo $messageError; ?></div>
            <?php endif; ?>   
            </div>
        
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="checkcontacted"  name="checkcontacted" value="1">
            <label class="form-check-label"   for="checkcontacted">Autorizó para ser contactado por el equipo</label>
            <?php if (!empty($checkcontactedError)): ?>
                <div class="error"><?php echo $checkcontactedError; ?></div>
            <?php endif; ?>   
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- Mensajes de éxito o error -->
        <?php if (isset($errorMessage)) { echo "<p class='error'>$errorMessage</p>"; } ?>
    <?php if (isset($successMessage)) { echo "<p class='success'>$successMessage</p>"; } ?>

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
    document.getElementById("contactForm").addEventListener("submit", function(event) {
        let formIsValid = true;
        
        // Validar Nombre
        let name = document.getElementById("name");
        let nameError = document.getElementById("nameError");
        if (name.value.trim() === "") {
            name.classList.add("is-invalid");
            nameError = document.createElement("div");
            nameError.classList.add("error");
            nameError.textContent = "El nombre es obligatorio.";
            name.parentNode.appendChild(nameError);
            formIsValid = false;
        } else {
            name.classList.remove("is-invalid");
            if (nameError) nameError.remove();
        }
        
        // Validar Apellido
        let lastname = document.getElementById("lastname");
        let lastnameError = document.getElementById("lastnameError");
        if (lastname.value.trim() === "") {
            lastname.classList.add("is-invalid");
            lastnameError = document.createElement("div");
            lastnameError.classList.add("error");
            lastnameError.textContent = "El apellido es obligatorio.";
            lastname.parentNode.appendChild(lastnameError);
            formIsValid = false;
        } else {
            lastname.classList.remove("is-invalid");
            if (lastnameError) lastnameError.remove();
        }

        // Validar Correo
        let email = document.getElementById("email");
        let emailError = document.getElementById("emailError");
        if (email.value.trim() === "") {
            email.classList.add("is-invalid");
            emailError = document.createElement("div");
            emailError.classList.add("error");
            emailError.textContent = "El correo electrónico es obligatorio.";
            email.parentNode.appendChild(emailError);
            formIsValid = false;
        } else {
            email.classList.remove("is-invalid");
            if (emailError) emailError.remove();
        }

        // Si algún campo es inválido, prevenimos el envío
        if (!formIsValid) {
            event.preventDefault();
        }
    });
</script>
    </div>
    <div class="autor">
        Formulario de contacto @2025. Desarrollado por <a href="#">Alejandro Lenier Ireta Xiu</a>.
    </div>

</body>
</html>
