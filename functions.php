<?php

function addUser($name, $lastname, $option, $message, $email, $conexion) {
    try {
        $stmt = $conexion->prepare("
        INSERT INTO userdata (name, lastname, user_option, message, email)
        VALUES (:name, :lastname, :user_option, :message, :email)
    ");

    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindParam(':user_option', $option, PDO::PARAM_INT);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Formulario enviado correctamente.";
    } else {
        echo "Error al enviar el formulario.";
    }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

?>