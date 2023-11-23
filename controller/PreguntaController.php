<?php
class PreguntaController
{
    private $model;
    private $renderer;

    public function __construct($model, $renderer)
    {
        $this->model = $model;
        $this->renderer = $renderer;
    }


    public function crearPartida()
    {
        if(!isset($_SESSION['partidaId']) ){   
            $partida = $this->model->getLastPartida(); 
            if(!isset($partida['estado']) || $partida['estado']==0 || $partida==null){
                $datos = $this->model->crearPartida();
                $_SESSION['partidaId']=$datos;
            }else{
                $_SESSION['partidaId']=$partida['id'];
            }
        }else{
            $partida = $this->model->getPartida();
            if($partida['estado']==0){
                $datos = $this->model->crearPartida();
                $_SESSION['partidaId']=$datos;
            }
        }
        $this->randomQuestion();
        
    }


    public function randomQuestion()
    {
        $partida = $this->model->getPartida();
        if($partida['estado']==0){
            header("location:/home");
            exit();
        }else{
            $cheat = $this->model->checkCheat();

            if(!$cheat){
                $datos = $this->model->getRandomQuestion();
                $datos['userId'] = $_SESSION['id'];
                $this->renderer->render("pregunta", $datos);    
            }else{
                $this->model->terminarPorTrampa();
                $datos['Titulo']="Partida Perdida";
                $datos['subtitulo']="Perdiste la partida por hacer trampa";
                $this->renderer->render("partida_terminada",$datos);
            }

        }
    }

    public function turnoBot()
    {
        $partida = $this->model->getPartida();
        if($partida['estado']==0){
            header("location:/home");
            exit();
        }else{
            $datos = $this->model->getRandomQuestionBot();
            $this->renderer->render("pregunta_bot", $datos);    
        }
    }
    

    public function tiempoVencido()
    {
        $userId = $_GET['userId'];  
        $datos['titulo']="¡Incorrecto!";
        $datos['subtitulo']="Se ha vencido el tiempo.";
        $datos['boton']="Sigue intentando";
        $datos['es_correcta']=false;
        $this->model->guardarRespuesta($userId,"null",0);
        $partida = $this->model->getPartida();
        if($partida['vidas']==1){
            $this->model->terminarPartida();
            $datos['Titulo']="Partida Perdida";
            $datos['subtitulo']="Perdiste la partida";
            $this->renderer->render("partida_terminada",$datos);
        }
        else {
            $this->model->restarVida($partida['vidas']);
            $this->renderer->render("pregunta_estado", $datos);    
        }
        
    }
    public function validateAnswer()
    {
        $respuestaId = $_GET['respuestaId'];
        $userId = $_GET['userId'];
        $noCheat = $this->model->verificarTiempoRespuesta($userId);
        $esRespuestaCorrecta = $this->model->verificarRespuesta($respuestaId);
        $preguntaId = $this->model->getPreguntaId($respuestaId);
    
        if ($noCheat) {
            // Obtener el id_partida de la sesión
            $idPartida = $_SESSION['partidaId'];
    
            if ($esRespuestaCorrecta) {
                $datos['titulo'] = "¡Correcto!";
                $datos['subtitulo'] = "Que bien, tu respuesta es correcta.";
                $datos['boton'] = "Turno de la pc";
                $datos['es_correcta'] = true;
                $datos['preguntaId'] = $preguntaId;
                $this->model->guardarRespuesta($userId, $respuestaId, 1, $idPartida);
                $this->renderer->render("pregunta_estado", $datos);
            } else {
                $datos['titulo'] = "¡Incorrecto!";
                $datos['subtitulo'] = "Lo siento, tu respuesta es incorrecta.";
                $datos['boton'] = "Turno de la pc";
                $datos['es_correcta'] = false;
                $datos['preguntaId'] = $preguntaId;
                // Modificación aquí, pasando null directamente
                $this->model->guardarRespuesta($userId, $respuestaId, 0, $idPartida);
                $partida = $this->model->getPartida();
                if ($partida['vidas'] == 1) {
                    $this->model->terminarPartida();
                    $datos['Titulo'] = "Partida Perdida";
                    $datos['subtitulo'] = "Perdiste la partida";
                    $this->renderer->render("partida_terminada", $datos);
                } else {
                    $this->model->restarVida($partida['vidas']);
                    $this->renderer->render("pregunta_estado", $datos);
                }
            }
        } else {
            $this->model->terminarPorTrampa();
            $datos['Titulo'] = "Partida Perdida";
            $datos['subtitulo'] = "Perdiste la partida por hacer trampa";
            $this->renderer->render("partida_terminada", $datos);
        }
    }
    

    
    public function respuestaBot()
    {
        $preguntaId = $_GET['preguntaId'];
        $respuestaId = $this->model->getRandomAnswer($preguntaId);
        $esRespuestaCorrecta = $this->model->verificarRespuesta($respuestaId);
        $userId = $_SESSION['id'];
        
        if ($esRespuestaCorrecta) {
            $datos['titulo']="¡Correcto!";
            $datos['subtitulo']="La pc contesto correctamente";
            $datos['boton']="Tu Turno";
            $datos['es_correcta']=true;
            $this->model->guardarRespuesta($userId,$respuestaId,1);
            $this->renderer->render("pregunta_bot_estado", $datos);    
        } else {
            $datos['titulo']="¡Incorrecto!";
            $datos['subtitulo']="La pc contesto incorrectamente";
            $datos['boton']="Tu turno";
            $datos['es_correcta']=false;
            $partida = $this->model->getPartida();
            $this->model->guardarRespuesta($userId,$respuestaId,0);
            if($partida['vidasBot']==1){
                $this->model->terminarPartidaBot();
                $datos['Titulo']="Partida Ganada";
                $datos['subtitulo']="Ganaste la partida";
                $this->renderer->render("partida_terminada",$datos);
            }
            else {
                $this->model->restarVidaBot($partida['vidasBot']);
                $this->renderer->render("pregunta_bot_estado", $datos);    
            }
        }

        
    }

    public function exito(){
        $this->renderer->render("pregunta_exito", []);  
    }
 
    public function error(){
        $this->renderer->render("pregunta_error", []);  
    }

    public function reportar(){
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $preguntaId = $_GET['preguntaId'];
        $estado = $this->model->reportar($preguntaId);
        if($estado) $datos['status']="success";
        else $datos['status']="success";
        echo json_encode($datos);
    }
     
    public function sugerir(){
        $data['categorias'] = $this->model->getCategorias();
        $this->renderer->render("sugerir_pregunta", $data);  
    }

    public function crear(){
        $pregunta = $_POST['pregunta'];
        $categoria = $_POST['categoria'];
        $respuestas = $_POST['respuesta'];

        $this->model->crear($pregunta, $categoria, $respuestas);
    
        header('location:/');
        exit();
    } 
    
}