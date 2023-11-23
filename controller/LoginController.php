<?php
include_once "Configuration.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class LoginController
{

    private $model;
    private $renderer;

    public function __construct($model, $renderer)
    {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function form()
    {
        $this->renderer->render("login", []);
    }

    public function salir()
    {
        session_start();
        $_SESSION['id'] = null;
        $_SESSION['partidaId'] = null;
        header("location:/login/form");
        exit();
    }
    
    public function signIn()
    {
        $email = $_POST["email"];
        $password = $_POST['password'];
        
        $result = $this->model->signIn($email, $password);
        
        if (count($result) > 0){
            session_start();
            $_SESSION['id'] = $result[0]['id'];
            $_SESSION ['rol'] = $result[0]['rol'];
            $_SESSION['partidaId'] = null;
            header("location:/");
        } 
        else header("location:/login/form");
        exit();
    }

    public function registro()
    {
        $this->renderer->render("register", []);
    }

    public function registrarse()
    {
        $nombre = $_POST["nombre"];
        $apellido = $_POST['apellido'];
        $anoDeNacimiento = $_POST['nacimiento'];
        $sexo = $_POST['sexo'];
        $pais = $_POST['pais'];
        $ciudad = $_POST['ciudad'];
        $email = $_POST['email'];
        $contrasenia = $_POST['password'];
        $rcontrasenia = $_POST['repeat-password'];
        $nombreDeUsuario = $_POST['username'];
        $img = ""; 



        if($contrasenia!=$rcontrasenia){
            header("location:/login/registro");
            exit();
        }

        if($_FILES["foto"]["error"] == 0){
            $nuevoNombre = time();
            $extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
            $destino = "public/uploads/" . $nuevoNombre . "." . $extension;
            move_uploaded_file($_FILES["foto"]["tmp_name"],$destino); 
            $img="$nuevoNombre.$extension";
        }

        $token = uniqid();

        $result = $this->model->add($nombre, $apellido, $anoDeNacimiento, $sexo, $pais, $ciudad, $email, $contrasenia, $nombreDeUsuario, $img, $token);

        if(!$result) unlink("public/uploads/" . $img );

        if ($this->enviarEmailRegistro($email, $nombre, $token)) {
            echo 'Se envió un correo de verificación.';
        } else {
            echo 'ERROR.';
            header('Location:/registro?error=ERROR-EMAIL');
            exit();
        }


        header("location:/login/form");
        exit();
    }

    public function enviarEmailRegistro($email, $nombre, $token)
    {

        // Generar enlace verificacion
        $enlaceVerificacion = 'http://localhost/login/verificarUsuario?token=' . $token . '&email=' . $email;

        $mailer = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP
            $mailer->isSMTP();
            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMTPAuth = true;
            $mailer->Username = 'pregunta2.unlam@gmail.com';
            $mailer->Password = 'srtbcimoovaimmjl';
            $mailer->Port = 587;

            // Configuración del remitente y destinatario
            $mailer->setFrom('pregunta2.unlam@gmail.com', 'Pregunta2');
            $mailer->addAddress($email, $nombre);


            // Contenido del correo
            $mailer->isHTML(true);
            $mailer->Subject = 'Verificacion de Registro en Pregunta2';
            $mailer->Body = '<h1>¡Hola ' . $nombre . '!</h1><br> <h3>¡Gracias por registrarte! <br></br> Por favor, haz clic en el siguiente enlace para verificar tu cuenta: <a href="' . $enlaceVerificacion . '">Verificar cuenta</a></h3>';
            $mailer->send();

            // Redirigir a una vista de éxito
            header('Location:/autenticacion?mail=OK');
            exit();
        } catch (Exception $e) {
            header('Location:/autenticacion?mail=BAD');
            exit();
        }
    }

    public function verificarUsuario()
    {
        $tokenCod = $_GET['token'];
        $emailCod = $_GET['email'];
        $token = $tokenCod;
        $email = $emailCod;

        if (empty($token) || empty($email)) {
            header('Location:/error?codError=333');
            exit();
        } else {
            $usuarioVerificado = $this->model->verificarUsuario($token, $email);
            if ($usuarioVerificado) {

                header('Location: /login?EXITO=1');;
            } else {
                header('Location:/error?codError=333');
            }
            exit();
        }
    }
}