<?php

class EditorModel{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }
 

    public function darDeAlta($id){
        $sql = "UPDATE preguntas SET estado = 'ACTIVO' WHERE id_pregunta = $id";
        $resultado = $this->database->execute($sql);
    }

    public function darDeBaja($id){
        $sql = "DELETE FROM preguntas WHERE id_pregunta = $id";
        $resultado = $this->database->execute($sql);
        $sql = "DELETE FROM respuestas WHERE id_pregunta = $id";
        $resultado = $this->database->execute($sql);
    }

    public function traerPregunta($id){
        $sql = "SELECT * FROM preguntas WHERE id_pregunta = $id";
        $resultado = $this->database->query($sql);
        return $resultado;
    }

    public function traerRespuestas($id){
        $sql = "SELECT * FROM respuestas WHERE id_pregunta = $id";
        $resultado = $this->database->query($sql);
        return $resultado;
    }



    public function modificarPreguntasYRespuestas($id, $pregunta, $id_categoria, $respuestas){
        $sql = "UPDATE preguntas SET pregunta = '$pregunta', id_categoria = '$id_categoria', estado = 'ACTIVA' WHERE id_pregunta = '$id'";
        $stmtPregunta = $this->database->execute($sql);
        
        $sql = "DELETE FROM `respuestas` WHERE id_pregunta = $id";
        $stmtPregunta = $this->database->execute($sql);
        
        foreach ($respuestas as $index => $respuesta) {
            if( $index == 0 ) $correcta = 1;
            else $correcta = 0;
            $sqlRespuesta = "INSERT INTO respuestas(id_pregunta, respuesta, es_correcta) VALUES ($id,'$respuesta',$correcta)";
            $stmtRespuesta = $this->database->execute($sqlRespuesta);
        }
    } 

    public function getCategorias(){
        $sql = "SELECT * FROM categoria";
        $resultado = $this->database->query($sql);
        return $resultado;
    }




}