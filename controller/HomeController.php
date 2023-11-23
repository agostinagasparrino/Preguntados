<?php

class HomeController {

    private $renderer;
    private $model;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function show() {
        $rol = $_SESSION['rol'];
        if($rol == 1){
            $datos=$this->model->getPuestoRanking();
            $this->renderer->render('home',$datos);
        }elseif($rol == 2){
            $data['preguntas_reportadas'] = $this->model->getReportedQuestions();
            $data['preguntas_creadas'] = $this->model->getCreatedQuestions();
            $this->renderer->render("editor_pregunta", $data);
        }else{
            $this->renderer->render("admin", []);
        }
    }

}

?>