<?php

function conexion(){
    $bd_config = array(
        'basedatos' => 'db_formulario',
        'user' => 'root',
        'pass' => ''
    );
	try {
	$conexion = new PDO('mysql:host=localhost;dbname='.$bd_config['basedatos'], $bd_config['user'], $bd_config['pass']);
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $conexion;

	} catch (PDOException $e) {
		return false;
	}
}
?>