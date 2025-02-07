<?php

function addUser($name, $lastname, $option, $message, $email, $checkcontacted, $conexion) {
    try {
        $stmt = $conexion->prepare("
        INSERT INTO userdata (name, lastname, user_option, message, email, contacted)
        VALUES (:name, :lastname, :user_option, :message, :email, :contacted)
    ");

    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindParam(':user_option', $option, PDO::PARAM_INT);
    $stmt->bindParam(':contacted', $checkcontacted, PDO::PARAM_INT);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    if ($stmt->execute()) {
        return "Formulario enviado correctamente.";
    } else {
        return "Error al enviar el formulario.";
    }
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}

?>