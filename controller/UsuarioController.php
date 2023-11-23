<?php

class UsuarioController
{

    private $model;
    private $renderer;

    public function __construct($model, $renderer)
    {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function perfil(){
        if(isset($_GET['userName'])){
            $userName = $_GET['userName'];
            $result = $this->model->getByUN($userName);
        }else{
            $usuarioId = $_SESSION['id'];
            $result = $this->model->get($usuarioId);
        }
        $datos['usuario']=$result;

        $this->renderer->render("perfil", $datos);    

    }

    public function editar_perfil(){
        $usuarioId = $_SESSION['id'];
        $this->renderer->render("editar_perfil", []);    
    }
  
    public function get_user_data(){
        $usuarioId = $_SESSION['id'];
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $rawData = $this->model->get($usuarioId) ;
        $data = $rawData[0];
        $usuario['nombre']=$data['nombre'];
        $usuario['apellido']=$data['apellido'];
        $usuario['pais']=$data['pais'];
        $usuario['ciudad']=$data['ciudad'];
        $usuario['foto']=$data['foto'];
        $usuario['email']=$data['email'];
        $usuario['password']=$data['password'];
        $usuario['nombreUsuario']=$data['nombreUsuario'];
        $usuario['anioDeNacimiento']=$data['anioDeNacimiento'];
        $usuario['sexo']=$data['sexo'];
        echo json_encode($usuario);
    }


    public function editar()
    {
        $nombre = $_POST["nombre"];
        $apellido = $_POST['apellido'];
        $anoDeNacimiento = $_POST['nacimiento'];
        $sexo = $_POST['sexo'];
        $pais = $_POST['pais'];
        $ciudad = $_POST['ciudad'];
        $email = $_POST['email'];
        $nombreDeUsuario = $_POST['username'];
        $img = ""; 

        $usuarioId = $_SESSION['id'];
        $userData = $this->model->get($usuarioId) ;

        if($_FILES["foto"]["error"] == 0){
            $nuevoNombre = time();
            $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
            $destino = "public/uploads/" . $nuevoNombre . "." . $extension;
            move_uploaded_file($_FILES["foto"]["tmp_name"],$destino); 
            $img="$nuevoNombre.$extension";
    
            if(isset($userData[0]['foto'])){
                $foto =$userData[0]['foto'];
                unlink("public/uploads/" . $foto );
            }
        }else{
            $img=$userData[0]['foto'];
        }


        $result = $this->model->edit($nombre, $apellido, $anoDeNacimiento, $sexo, $pais, $ciudad, $email, $nombreDeUsuario, $img);
        
        header('Location:/usuario/perfil');
        exit();

    }



}