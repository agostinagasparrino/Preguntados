<?php

class RankingModel{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }
 

    public function getRanking(){

        $sql = "SELECT u.id as userId, u.nombreusuario as userName, COUNT(p.id) as total, SUM(p.ganada) as ganadas FROM partidas as p JOIN usuarios as u on u.id=p.userId GROUP BY userName ORDER BY ganadas DESC LIMIT 10;";
        $ranking = $this->database->query($sql);
        
        foreach ($ranking as $i => &$user) {
            $user['i'] = $i + 1; 
        }

        $data['ranking']=$ranking;

        return $data;

    }

}