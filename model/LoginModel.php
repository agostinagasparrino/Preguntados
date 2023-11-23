<?php

class LoginModel
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    public function add($nombre, $apellido, $anoDeNacimiento, $sexo, $pais, $ciudad, $email, $contrasenia, $nombreDeUsuario, $foto, $token)
    {
        $sql = "INSERT INTO `usuarios`( `nombre`, `apellido`, `pais`, `ciudad`,`email`, `password`, `nombreUsuario`, `anioDeNacimiento`, `sexo`, `foto`, `token`) 
        VALUES ('$nombre','$apellido','$pais','$ciudad','$email','$contrasenia','$nombreDeUsuario','$anoDeNacimiento',$sexo, '$foto', '$token')";
        $this->database->execute($sql);
        $sql = "SELECT * FROM `usuarios` WHERE `email` = '$email'";
        $resultado = $this->database->query($sql);
        return count($resultado) > 0;
    }
    public function signIn($email, $password)
    {
        $sql = "SELECT u.*,r.descripcion FROM usuarios as u JOIN rol as r ON u.rol=r.id WHERE email LIKE '$email' AND password LIKE '$password' AND verificado = 1";
        return $this->database->query($sql);
    }

    
    public function verificarUsuario($token, $email){
        $sql = "SELECT token FROM usuarios WHERE email = '$email'"; 
        $tokenDB = $this->database->query($sql);
    
        if($tokenDB[0]['token'] === $token){
            $sql = "UPDATE usuarios SET verificado = b'1' WHERE email = '$email'";
            $this->database->execute($sql);
            return true;
        } else {
            return false;
        }
    }
    
}