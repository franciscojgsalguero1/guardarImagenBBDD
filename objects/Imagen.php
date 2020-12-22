<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Imagen
 *
 * @author Francisco José Gordo Salguero
 */
class Imagen {
    //put your code here
    
    private $conn;
    private $table_name = "images_tabla";
    private $imagen;
    private $creado;
    
    public function __construct($db){
        $this->conn = $db;
    }
    
    public function SetImagen($imagen) {
        $this->imagen = base64_encode(file_get_contents($imagen));
    }
    
    public function insertarImagen() {
        //Insertar imagen en la base de datos
        // insert query
        $query = "INSERT INTO " . $this->table_name . " SET imagenes=:imagen, creado=:creado";
        
        $stmt = $this->conn->prepare($query);
        
        // to get time-stamp for 'created' field
        $this->creado  = date('Y-m-d H:i:s');

        // bind values 
        $stmt->bindParam(":imagen", $this->imagen);
        $stmt->bindParam(":creado", $this->creado);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    public function leerUna($id) {
        // hacemos la query
        $query = "SELECT imagenes FROM ".$this->table_name." WHERE id= :id";
        $stmt = $this->conn->prepare($query); // Se crea un objeto PDOStatement.
        $stmt->bindParam(":id", $id);
        $stmt->execute();// Se ejecuta la consulta.
        $datos = $stmt->fetch(PDO::FETCH_ASSOC)["imagenes"]; // Se recuperan los resultados.
        $stmt->closeCursor(); // Se libera el recurso.
        $datos = base64_decode($datos); // se descodifica la imagen
        return $datos;
    }
}
