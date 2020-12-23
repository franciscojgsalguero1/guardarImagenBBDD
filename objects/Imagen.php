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
        if (!empty($imagen)) {
            $this->imagen = base64_encode(file_get_contents($imagen));
        }
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
        $number = $id;
        // hacemos la query
        $query = "SELECT imagenes FROM ".$this->table_name." WHERE id= :id";
        $stmt = $this->conn->prepare($query); // Se crea un objeto PDOStatement.
        // comprobamos si hay una imagen con ese id, si no es así, devolvemos la imagen de no encontrado
        if (!$this->contar($stmt, $id)) {
            $number = 1;
        }
        $stmt->bindParam(":id", $number);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $datos = $stmt->fetch(PDO::FETCH_ASSOC)["imagenes"];
        }
        
        $stmt->closeCursor(); // Se libera el recurso.
        $datos = base64_decode($datos); // se descodifica la imagen
        
        return $datos;
    }
    
    private function contar($stmt, $id) {
        
        $output = false;
        
        $stmt->bindParam(":id", $id);
        if($stmt->execute()) {
            if($stmt->rowCount() > 0) {
                $output = true;
            }
        }
        
        return $output;
        
    }
}
