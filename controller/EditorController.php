<?php

class EditorController {

    private $renderer;
    private $model;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function alta(){
        $preguntaId = $_GET['id_pregunta'];
        $this->model->darDeAlta($preguntaId); 
        header('location:/');
        exit();
    }    

    public function mostrarEdicion(){
        if($_SESSION['rol']!=2){
            header('location:/');
            exit();
        }
        $preguntaId = $_GET['id_pregunta'];
        $data['pregunta'] = $this->model->traerPregunta($preguntaId);
        $data['respuestas'] = $this->model->traerRespuestas($preguntaId);
        $data['categorias'] = $this->model->getCategorias();
        $this->renderer->render("edit_pregunta", $data);
    }   

    public function baja(){
        $preguntaId = $_GET['id_pregunta'];
        $this->model->darDeBaja($preguntaId); 
        header('location:/');
        exit();
    }   

    public function modificarPregunta(){
        $preguntaId = $_GET['id_pregunta'];
        $pregunta = $_POST['pregunta'];
        $categoria = $_POST['categoria'];
        $respuestas = $_POST['respuesta'];

        $this->model->modificarPreguntasYRespuestas($preguntaId, $pregunta, $categoria, $respuestas);
    
        header('location:/');
        exit();
    } 

}

?>