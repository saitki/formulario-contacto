<?php
require_once __DIR__ . '/../models/FormModel.php';

class FormController {
    private $model;

    public function __construct($conexion) {
        $this->model = new FormModel($conexion);
    }

    public function submitForm($name, $lastname, $option, $message) {
        $resultado = $this->model->addUser($name, $lastname, $option, $message);
        
        if ($resultado === true) {
            echo "<script>
                alert('Formulario enviado exitosamente.');
                window.location.href = '/';
            </script>";
        } else {
            echo "<script>alert('Error: $resultado');</script>";
        }
    }
}
?>
