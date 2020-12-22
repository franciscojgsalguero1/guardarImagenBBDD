<?php
    include_once 'config/database.php';
    include_once 'objects/Imagen.php';
    /* Se conecta con la base de datos elegida. */
    $database = new Database();
    $db = $database->getConnection();
    
    $imagen = new Imagen($db);
    echo $imagen->leerUna($_GET['id']);
?>