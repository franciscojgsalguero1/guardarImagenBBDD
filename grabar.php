<?php
    include_once 'config/database.php';
    include_once 'objects/Imagen.php';
    /* Se conecta con la base de datos elegida. */
    $database = new Database();
    $db = $database->getConnection();

    try{
        $imagen = new Imagen($db);
        $imagen->SetImagen($_FILES['imagen']['tmp_name']);
        if ($imagen->insertarImagen()) {
            echo "Imagen almacenada.";
        } else {
            echo "Error al almacenar la imagen.";
        }
        
    } catch (Exception $e) {
            die ("Se produjo un error");
    }
?>