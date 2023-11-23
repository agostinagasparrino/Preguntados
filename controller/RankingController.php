<?php

class RankingController {

    private $renderer;
    private $model;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }

    public function show() {
        $this->renderer->render('ranking',[]);
    }

    public function get_ranking_data() {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
        $datos=$this->model->getRanking();
        echo json_encode($datos);
    }
}

?>