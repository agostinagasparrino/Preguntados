<?php

class HomeModel{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }
 
    public function getPuestoRanking(){

        $sql = "SELECT u.id as userId, u.nombreusuario as userName, COUNT(p.id) as total, SUM(p.ganada) as ganadas FROM partidas as p JOIN usuarios as u on u.id=p.userId GROUP BY userName ORDER BY ganadas DESC LIMIT 10;";
        $ranking = $this->database->query($sql);
        
        $puesto=[];

        foreach ($ranking as $i => &$user) {
            $user['i'] = $i + 1; 
            
            if($user['userId']== $_SESSION['id']){
                $puesto=$user;
            }
       
        }

        $data['ranking']=$puesto;

        return $data;

    }



    public function getReportedQuestions(){
        $sql = "SELECT p.id_pregunta,c.descripcion, p.pregunta FROM preguntas as p JOIN categoria as c ON  p.id_categoria=c.id_categoria WHERE estado = 'REPORTADA'";
        $listaDePreguntas = $this->database->query($sql);
        return $listaDePreguntas;
    }


    public function getCreatedQuestions(){
        $sql = "SELECT p.id_pregunta,c.descripcion, p.pregunta FROM preguntas as p JOIN categoria as c ON  p.id_categoria=c.id_categoria WHERE estado = 'INACTIVA'";
        $listaDePreguntas = $this->database->query($sql);
        return $listaDePreguntas;
    }


}