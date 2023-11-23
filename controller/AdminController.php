<?php

class AdminController
{
    private $renderer;
    private $model;

    public function __construct($model, $renderer) {
        $this->model = $model;
        $this->renderer = $renderer;
    }
    
    private function getData($filtro, $d_start, $d_end, $group_by){

        if($filtro == "cantPlayers"){
            $data = $this->model->getCantidadUsuarios($d_start, $d_end, $group_by);
            $labels = [];
            $series = [];
            $index = "";
            if($group_by=='year'){
                foreach ($data as $item) {
                    $label = $item['ANIO'];
    
                    $serie = $item['cantidadUsuarios'];
    
                    $labels[] = $label;
    
                    $series[] = floatval($serie);
                }
            }elseif($group_by=='month'){
                foreach ($data as $item) {
                    $label = $item['ANIO'] ."-". $item['MES'];
                    $serie = intval($item['cantidadUsuarios']); 
                    $labels[] = $label;
                    $series[] = $serie;
                }
            }else{
                foreach ($data as $item) {
                    $label = $item['ANIO'] .'-'. $item['MES'] .'-'. $item['DIA'];
                
                    $serie = intval($item['cantidadUsuarios']); 
                
                    $labels[] = $label;
                
                    $series[] = $serie;
                }
            }

            $result = [
                'labels' => $labels,
                'series' => $series,
            ];
            return $resultJson = json_encode($result, JSON_PRETTY_PRINT);
        }
        if($filtro == "cantMatchPlayed"){
            $data = $this->model->getCantidadPartidas($d_start, $d_end, $group_by);
            $labels = [];
            $series = [];
            $index = "";
            if($group_by=='year'){
                foreach ($data as $item) {
                    $label = $item['ANIO'];
    
                    $serie = $item['cantidadPartidas'];
    
                    $labels[] = $label;
    
                    $series[] = floatval($serie);
                }
            }elseif($group_by=='month'){
                foreach ($data as $item) {
                    $label = $item['ANIO'] ."-". $item['MES'];
                    $serie = intval($item['cantidadPartidas']); 
                    $labels[] = $label;
                    $series[] = $serie;
                }
            }else{
                foreach ($data as $item) {
                    $label = $item['ANIO'] .'-'. $item['MES'] .'-'. $item['DIA'];
                
                    $serie = intval($item['cantidadPartidas']); 
                
                    $labels[] = $label;
                
                    $series[] = $serie;
                }
            }

            $result = [
                'labels' => $labels,
                'series' => $series,
            ];
            return $resultJson = json_encode($result, JSON_PRETTY_PRINT);
        }
        if($filtro == "cantQuestionCreatedBySystem"){
            $data = $this->model->getCantidadPreguntas($d_start, $d_end, $group_by);
            $labels = [];
            $series = [];
            $index = "";
            if($group_by=='year'){
                foreach ($data as $item) {
                    $label = $item['ANIO'];
    
                    $serie = $item['cantidadPreguntasSistema'];
    
                    $labels[] = $label;
    
                    $series[] = floatval($serie);
                }
            }elseif($group_by=='month'){
                foreach ($data as $item) {
                    $label = $item['ANIO'] ."-". $item['MES'];
                    $serie = intval($item['cantidadPreguntasSistema']); 
                    $labels[] = $label;
                    $series[] = $serie;
                }
            }else{
                foreach ($data as $item) {
                    $label = $item['ANIO'] .'-'. $item['MES'] .'-'. $item['DIA'];
                
                    $serie = intval($item['cantidadPreguntasSistema']); 
                
                    $labels[] = $label;
                
                    $series[] = $serie;
                }
            }

            $result = [
                'labels' => $labels,
                'series' => $series,
            ];
            return $resultJson = json_encode($result, JSON_PRETTY_PRINT);
        }
        if($filtro == "cantQuestionCreatedByUser"){
            $data = $this->model->getCantidadPreguntasCreadas($d_start, $d_end, $group_by);
            $labels = [];
            $series = [];
            $index = "";
            if($group_by=='year'){
                foreach ($data as $item) {
                    $label = $item['ANIO'];
    
                    $serie = $item['cantidadPreguntasUsuario'];
    
                    $labels[] = $label;
    
                    $series[] = floatval($serie);
                }
            }elseif($group_by=='month'){
                foreach ($data as $item) {
                    $label = $item['ANIO'] ."-". $item['MES'];
                    $serie = intval($item['cantidadPreguntasUsuario']); 
                    $labels[] = $label;
                    $series[] = $serie;
                }
            }else{
                foreach ($data as $item) {
                    $label = $item['ANIO'] .'-'. $item['MES'] .'-'. $item['DIA'];
                
                    $serie = intval($item['cantidadPreguntasUsuario']); 
                
                    $labels[] = $label;
                
                    $series[] = $serie;
                }
            }

            $result = [
                'labels' => $labels,
                'series' => $series,
            ];
            return $resultJson = json_encode($result, JSON_PRETTY_PRINT);
        }
        if($filtro == "cantCorrectAnswers"){
            $data = $this->model->getCantidadDeRespuestasCorrectas($d_start, $d_end, $group_by);
            $labels = [];
            $series = [];
            $index = "";
            if($group_by=='year'){
                foreach ($data as $item) {
                    $label = $item['ANIO'];
    
                    $serie = $item['cantidadRespuestasCorrectas'];
    
                    $labels[] = $label;
    
                    $series[] = floatval($serie);
                }
            }elseif($group_by=='month'){
                foreach ($data as $item) {
                    $label = $item['ANIO'] ."-". $item['MES'];
                    $serie = intval($item['cantidadRespuestasCorrectas']); 
                    $labels[] = $label;
                    $series[] = $serie;
                }
            }else{
                foreach ($data as $item) {
                    $label = $item['ANIO'] .'-'. $item['MES'] .'-'. $item['DIA'];
                
                    $serie = intval($item['cantidadRespuestasCorrectas']); 
                
                    $labels[] = $label;
                
                    $series[] = $serie;
                }
            }

            $result = [
                'labels' => $labels,
                'series' => $series,
            ];
            return $resultJson = json_encode($result, JSON_PRETTY_PRINT);
        }
        if($filtro == "cantUserXCountry"){

            $data = $this->model->getCantidadUsuariosPorPais($d_start, $d_end, $group_by);
            $labels = [];
            $series = [];
            $index = "";
            if($group_by=='year'){
                foreach ($data as $item) {
                    $label = $item['ANIO'] . "-". $item['pais'];
    
                    $serie = $item['cantidadUsuariosPorPais'];
    
                    $labels[] = $label;
    
                    $series[] = floatval($serie);
                }
            }elseif($group_by=='month'){
                foreach ($data as $item) {
                    $label = $item['ANIO'] ."-". $item['MES'] . "-". $item['pais'];
                    $serie = intval($item['cantidadUsuariosPorPais']); 
                    $labels[] = $label;
                    $series[] = $serie;
                }
            }else{
                foreach ($data as $item) {
                    $label = $item['ANIO'] .'-'. $item['MES'] .'-'. $item['DIA'] . "-". $item['pais'];
                
                    $serie = intval($item['cantidadUsuariosPorPais']); 
                
                    $labels[] = $label;
                
                    $series[] = $serie;
                }
            }

            $result = [
                'labels' => $labels,
                'series' => $series,
            ];
            return $resultJson = json_encode($result, JSON_PRETTY_PRINT);
        }
        if($filtro == "cantUserXGenre"){
            $data = $this->model->getCantidadUsuariosPorGenero($d_start, $d_end, $group_by);
            $labels = [];
            $series = [];
            $index = "";
             
            if($group_by=='year'){
                foreach ($data as $item) {
                    $label = $item['ANIO'] . "-". $item['genero'];
    
                    $serie = $item['cantidadUsuariosPorGenero'];
    
                    $labels[] = $label;
    
                    $series[] = floatval($serie);
                }
            }elseif($group_by=='month'){
                foreach ($data as $item) {
                    $label = $item['ANIO'] ."-". $item['MES'] . "-". $item['genero'];
                    $serie = intval($item['cantidadUsuariosPorGenero']); 
                    $labels[] = $label;
                    $series[] = $serie;
                }
            }else{
                foreach ($data as $item) {
                    $label = $item['ANIO'] .'-'. $item['MES'] .'-'. $item['DIA'] . "-". $item['genero'];
                
                    $serie = intval($item['cantidadUsuariosPorGenero']); 
                
                    $labels[] = $label;
                
                    $series[] = $serie;
                }
            }


            $result = [
                'labels' => $labels,
                'series' => $series,
            ];
            return $resultJson = json_encode($result, JSON_PRETTY_PRINT);
    }
        if($filtro == "cantUserXAgeGroup"){
            $data = $this->model->getCantidadUsuariosPorEdad($d_start, $d_end, $group_by);
            $labels = [];
            $series = [];
            
            foreach ($data as $item) {
                // Acceder a los campos correctos según la consulta SQL
                if ($group_by == 'year') {
                    $label = $item['categoria_edad'];
                } elseif ($group_by == 'month') {
                    $label = $item['categoria_edad'];
                } else {
                    $label = $item['categoria_edad'];
                }
            
                $serie = intval($item['cantidadUsuariosPorEdad']);
            
                $labels[] = $label;
                $series[] = $serie;
            }
            
            $result = [
                'labels' => $labels,
                'series' => $series,
            ];
            
            return $resultJson = json_encode($result, JSON_PRETTY_PRINT);
            
     }
        if($filtro == "cantNewPlayers"){
            $data = $this->model->getCantidadUsuariosNuevos($d_start, $d_end, $group_by);
            $labels = [];
            $series = [];
            $index = "";
            if($group_by=='year'){
                foreach ($data as $item) {
                    $label = $item['ANIO'];
    
                    $serie = $item['cantidadUsuariosNuevos'];
    
                    $labels[] = $label;
    
                    $series[] = floatval($serie);
                }
            }elseif($group_by=='month'){
                foreach ($data as $item) {
                    $label = $item['ANIO'] ."-". $item['MES'];
                    $serie = intval($item['cantidadUsuariosNuevos']); 
                    $labels[] = $label;
                    $series[] = $serie;
                }
            }else{
                foreach ($data as $item) {
                    $label = $item['ANIO'] .'-'. $item['MES'] .'-'. $item['DIA'];
                
                    $serie = intval($item['cantidadUsuariosNuevos']); 
                
                    $labels[] = $label;
                
                    $series[] = $serie;
                }
            }

            $result = [
                'labels' => $labels,
                'series' => $series,
            ];
            return $resultJson = json_encode($result, JSON_PRETTY_PRINT);       
        
        }
        return null;
    }

    public function getGraph() {
        header("Access-Control-Allow-Origin: *");
        header('Content-Type: application/json');
    
        if (isset($_GET["filter"]) && isset($_GET["date_start"]) && isset($_GET["date_end"]) && isset($_GET["groupBy"])) {
            $d_start = date('Y-m-d', strtotime($_GET["date_start"]));
            $d_end = date('Y-m-d', strtotime($_GET["date_end"]));
            $data = $this->getData($_GET["filter"], $d_start, $d_end, $_GET["groupBy"]);
       

            echo $data;

        } else {
            echo json_encode(["error" => "Todos los datos son requeridos"]);
        }
    }
    

    public function getPDF()
    {
        if (isset($_GET["filter"]) && isset($_GET["date_start"]) && isset($_GET["date_end"]) && isset($_GET["groupBy"])) {
            $d_start = date('Y-m-d', strtotime($_GET["date_start"]));
            $d_end = date('Y-m-d', strtotime($_GET["date_end"]));

            $data = $this->getData($_GET["filter"], $d_start, $d_end, $_GET["groupBy"]);
            if (count($data) == 0) {
                $data = array(0 => array("##VALUE##" => "EMPTY"));
            }

             echo $this->pdfgenerator->generateFile($data);
        } else {
            header('Location: /error');
        }
    }
}