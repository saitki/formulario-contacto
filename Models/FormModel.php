<?php
class FormModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function addUser($name, $lastname, $option, $message) {
        try {
            $stmt = $this->conexion->prepare("
                INSERT INTO userdata (name, lastname, `option`, message)
                VALUES (:name, :lastname, :option, :message)
            ");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $stmt->bindParam(':option', $option, PDO::PARAM_INT);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
?>
