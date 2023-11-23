<?php

class UsuarioModel
{

    private $database;

    public function __construct($database){
        $this->database = $database;
    }
    
    function get($id){
        $sql = "SELECT u.*,s.descripcion FROM `usuarios` as u JOIN sexo as s ON u.sexo=s.id WHERE u.id = $id ";
        return $this->database->query($sql);
    }
   
    function getByUN($userName){
        $sql = "SELECT u.*,s.descripcion FROM `usuarios` as u JOIN sexo as s ON u.sexo=s.id WHERE u.nombreusuario = '$userName' ";
        return $this->database->query($sql);
    }

    
    public function edit($nombre, $apellido, $anoDeNacimiento, $sexo, $pais, $ciudad, $email, $nombreDeUsuario, $foto)
    {
        $id=$_SESSION['id'];
        $sql = "UPDATE `usuarios` SET 
            `nombre` = '$nombre', 
            `apellido` = '$apellido', 
            `pais` = '$pais', 
            `ciudad` = '$ciudad', 
            `email` = '$email', 
            `nombreUsuario` = '$nombreDeUsuario', 
            `anioDeNacimiento` = '$anoDeNacimiento', 
            `sexo` = '$sexo', 
            `foto` = '$foto' 
            WHERE `id` = $id";
        $this->database->execute($sql);
        $sql = "SELECT * FROM `usuarios` WHERE `email` = '$email'";
        $resultado = $this->database->query($sql);
        return count($resultado) > 0;
    }


}