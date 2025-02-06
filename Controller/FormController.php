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
                alert('Red social agregada exitosamente.');
                window.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>alert('Error: $resultado');</script>";
        }
    }
}
?>
