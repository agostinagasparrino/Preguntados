<?php

class AdminModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;

    }

    public function getCantidadUsuarios($dateStart, $dateEnd, $groupBy) {

        $sql = "";
        switch ($groupBy) {
            case "year":
                $sql = "SELECT YEAR(u.fecha_creacion) as ANIO, COUNT(u.id) as cantidadUsuarios
                        FROM usuarios u
                        WHERE u.fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY ANIO";
                break;
    
            case "month":
                $sql = "SELECT YEAR(u.fecha_creacion) as ANIO, MONTH(u.fecha_creacion) as MES, COUNT(u.id) as cantidadUsuarios
                        FROM usuarios u
                        WHERE u.fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY ANIO, MES";
                break;
    
            case "day":
                $sql = "SELECT YEAR(u.fecha_creacion) as ANIO, MONTH(u.fecha_creacion) as MES, DAY(u.fecha_creacion) as DIA, COUNT(u.id) as cantidadUsuarios
                        FROM usuarios u
                        WHERE u.fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY ANIO, MES, DIA";
                break;
        }
    
        return $this->database->query($sql);
    }
    

    public function getCantidadPartidas($dateStart, $dateEnd, $groupBy) {
  
        $sql = "";
        switch ($groupBy) {
            case "year":
                $sql = "SELECT YEAR(e.fecha) as ANIO, COUNT(DISTINCT p.id) as cantidadPartidas 
                        FROM partidas p
                        INNER JOIN estadistica e ON p.id = e.id_partida
                        WHERE e.fecha BETWEEN '$dateStart' AND '$dateEnd' 
                        GROUP BY ANIO";
                break;
    
            case "month":
                $sql = "SELECT YEAR(e.fecha) as ANIO, MONTH(e.fecha) as MES, COUNT(DISTINCT p.id) as cantidadPartidas 
                        FROM partidas p
                        INNER JOIN estadistica e ON p.id = e.id_partida
                        WHERE e.fecha BETWEEN '$dateStart' AND '$dateEnd' 
                        GROUP BY ANIO, MES";
                break;
    
            case "day":
                $sql = "SELECT YEAR(e.fecha) as ANIO, MONTH(e.fecha) as MES, DAY(e.fecha) as DIA, COUNT(DISTINCT p.id) as cantidadPartidas 
                        FROM partidas p
                        INNER JOIN estadistica e ON p.id = e.id_partida
                        WHERE e.fecha BETWEEN '$dateStart' AND '$dateEnd' 
                        GROUP BY ANIO, MES, DIA";
                break;
        }
    
        return $this->database->query($sql);
    }
    

    public function getCantidadPreguntas($dateStart, $dateEnd, $groupBy) {
    //QUERY PARA OBTENER LA CANTIDAD DE PREGUNTAS CREADAS POR SISTEMA ENTRE DOS FECHAS

        $sql = "";
        switch ($groupBy) {
            case "year":
                $sql = "SELECT YEAR(p.fecha_creacion) as ANIO, COUNT(p.id_pregunta) as cantidadPreguntasSistema 
                        FROM preguntas p
                        WHERE p.fecha_creacion BETWEEN '$dateStart' AND '$dateEnd' AND p.usuario = 0
                        GROUP BY ANIO";
                break;
    
            case "month":
                $sql = "SELECT YEAR(p.fecha_creacion) as ANIO, MONTH(p.fecha_creacion) as MES, COUNT(p.id_pregunta) as cantidadPreguntasSistema 
                        FROM preguntas p
                        WHERE p.fecha_creacion BETWEEN '$dateStart' AND '$dateEnd' AND p.usuario = 0
                        GROUP BY ANIO, MES";
                break;
    
            case "day":
                $sql = "SELECT YEAR(p.fecha_creacion) as ANIO, MONTH(p.fecha_creacion) as MES, DAY(p.fecha_creacion) as DIA, COUNT(p.id_pregunta) as cantidadPreguntasSistema 
                        FROM preguntas p
                        WHERE p.fecha_creacion BETWEEN '$dateStart' AND '$dateEnd' AND p.usuario = 0
                        GROUP BY ANIO, MES, DIA";
                break;
        }
    
        return $this->database->query($sql);
    }
    
    public function getCantidadPreguntasCreadas($dateStart, $dateEnd, $groupBy) {
        //OBTENER PREGUNTAS CREADAS

        $sql = "";
        switch ($groupBy) {
            case "year":
                $sql = "SELECT YEAR(p.fecha_creacion) as ANIO, COUNT(p.id_pregunta) as cantidadPreguntasUsuario 
                        FROM preguntas p
                        WHERE p.fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        AND p.usuario = 1
                        GROUP BY ANIO";
                break;
        
            case "month":
                $sql = "SELECT YEAR(p.fecha_creacion) as ANIO, MONTH(p.fecha_creacion) as MES, COUNT(p.id_pregunta) as cantidadPreguntasUsuario 
                        FROM preguntas p
                        WHERE p.fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        AND p.usuario = 1
                        GROUP BY ANIO, MES";
                break;
        
            case "day":
                $sql = "SELECT YEAR(p.fecha_creacion) as ANIO, MONTH(p.fecha_creacion) as MES, DAY(p.fecha_creacion) as DIA, COUNT(p.id_pregunta) as cantidadPreguntasUsuario 
                        FROM preguntas p
                        WHERE p.fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        AND p.usuario = 1
                        GROUP BY ANIO, MES, DIA";
                break;
        }
        
        return $this->database->query($sql);
        
    }

    public function getCantidadDeRespuestasCorrectas($dateStart, $dateEnd, $groupBy) {
        $sql = "";
        switch ($groupBy) {
            case "year":
                $sql = "SELECT YEAR(e.fecha) as ANIO, COUNT(e.id_estadistica) as cantidadRespuestasCorrectas
                        FROM estadistica e
                        WHERE e.respuesta = 1
                        AND e.fecha BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY ANIO";
                break;
    
            case "month":
                $sql = "SELECT YEAR(e.fecha) as ANIO, MONTH(e.fecha) as MES, COUNT(e.id_estadistica) as cantidadRespuestasCorrectas
                        FROM estadistica e
                        WHERE e.respuesta = 1
                        AND e.fecha BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY ANIO, MES";
                break;
    
            case "day":
                $sql = "SELECT YEAR(e.fecha) as ANIO, MONTH(e.fecha) as MES, DAY(e.fecha) as DIA, COUNT(e.id_estadistica) as cantidadRespuestasCorrectas
                        FROM estadistica e
                        WHERE e.respuesta = 1
                        AND e.fecha BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY ANIO, MES, DIA";
                break;
        }
    
        return $this->database->query($sql);
    }
    

    public function getCantidadUsuariosPorPais($dateStart, $dateEnd, $groupBy) {
        $sql = "";
        switch ($groupBy) {
            case "year":
                $sql = "SELECT pais, YEAR(fecha_creacion) as ANIO, COUNT(id) as cantidadUsuariosPorPais
                        FROM usuarios
                        WHERE fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY pais, ANIO";
                break;
    
            case "month":
                $sql = "SELECT pais, YEAR(fecha_creacion) as ANIO, MONTH(fecha_creacion) as MES, COUNT(id) as cantidadUsuariosPorPais
                        FROM usuarios
                        WHERE fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY pais, ANIO, MES";
                break;
    
            case "day":
                $sql = "SELECT pais, YEAR(fecha_creacion) as ANIO, MONTH(fecha_creacion) as MES, DAY(fecha_creacion) as DIA, COUNT(id) as cantidadUsuariosPorPais
                        FROM usuarios
                        WHERE fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY pais, ANIO, MES, DIA";
                break;
        }
    
        return $this->database->query($sql);
    }
    
    
    public function getCantidadUsuariosPorGenero($dateStart, $dateEnd, $groupBy) {
        $sql = "";
        switch ($groupBy) {
            case "year":
                $sql = "SELECT s.descripcion as genero, YEAR(u.fecha_creacion) as ANIO, COUNT(u.id) as cantidadUsuariosPorGenero
                        FROM usuarios u
                        INNER JOIN sexo s ON u.sexo = s.id
                        WHERE u.fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY genero, ANIO";
                break;
    
            case "month":
                $sql = "SELECT s.descripcion as genero, YEAR(u.fecha_creacion) as ANIO, MONTH(u.fecha_creacion) as MES, COUNT(u.id) as cantidadUsuariosPorGenero
                        FROM usuarios u
                        INNER JOIN sexo s ON u.sexo = s.id
                        WHERE u.fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY genero, ANIO, MES";
                break;
    
            case "day":
                $sql = "SELECT s.descripcion as genero, YEAR(u.fecha_creacion) as ANIO, MONTH(u.fecha_creacion) as MES, DAY(u.fecha_creacion) as DIA, COUNT(u.id) as cantidadUsuariosPorGenero
                        FROM usuarios u
                        INNER JOIN sexo s ON u.sexo = s.id
                        WHERE u.fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY genero, ANIO, MES, DIA";
                break;
        }
    
        return $this->database->query($sql);
    }
    
    

    public function getCantidadUsuariosPorEdad($dateStart, $dateEnd, $groupBy) {
        $sql = "";
        switch ($groupBy) {
            case "year":
                $sql = "SELECT CASE
                            WHEN (YEAR(NOW()) - anioDeNacimiento) < 18 THEN 'Menor'
                            WHEN (YEAR(NOW()) - anioDeNacimiento) >= 18 AND (YEAR(NOW()) - anioDeNacimiento) < 65 THEN 'Medio'
                            ELSE 'Jubilado'
                        END as categoria_edad,
                        COUNT(id) as cantidadUsuariosPorEdad
                        FROM usuarios
                        WHERE fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY categoria_edad";
                break;
    
            case "month":
                $sql = "SELECT CASE
                            WHEN (YEAR(NOW()) - anioDeNacimiento) < 18 THEN 'Menor'
                            WHEN (YEAR(NOW()) - anioDeNacimiento) >= 18 AND (YEAR(NOW()) - anioDeNacimiento) < 65 THEN 'Medio'
                            ELSE 'Jubilado'
                        END as categoria_edad,
                        COUNT(id) as cantidadUsuariosPorEdad
                        FROM usuarios
                        WHERE fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY categoria_edad";
                break;
    
            case "day":
                $sql = "SELECT CASE
                            WHEN (YEAR(NOW()) - anioDeNacimiento) < 18 THEN 'Menor'
                            WHEN (YEAR(NOW()) - anioDeNacimiento) >= 18 AND (YEAR(NOW()) - anioDeNacimiento) < 65 THEN 'Medio'
                            ELSE 'Jubilado'
                        END as categoria_edad,
                        COUNT(id) as cantidadUsuariosPorEdad
                        FROM usuarios
                        WHERE fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY categoria_edad";
                break;
        }
    
        return $this->database->query($sql);
    }
    

    public function getCantidadUsuariosNuevos($dateStart, $dateEnd, $groupBy) {
        $sql = "";
        switch ($groupBy) {
            case "year":
                $sql = "SELECT YEAR(fecha_creacion) as ANIO, COUNT(id) as cantidadUsuariosNuevos
                        FROM usuarios
                        WHERE fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY ANIO";
                break;
    
            case "month":
                $sql = "SELECT YEAR(fecha_creacion) as ANIO, MONTH(fecha_creacion) as MES, COUNT(id) as cantidadUsuariosNuevos
                        FROM usuarios
                        WHERE fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY ANIO, MES";
                break;
    
            case "day":
                $sql = "SELECT YEAR(fecha_creacion) as ANIO, MONTH(fecha_creacion) as MES, DAY(fecha_creacion) as DIA, COUNT(id) as cantidadUsuariosNuevos
                        FROM usuarios
                        WHERE fecha_creacion BETWEEN '$dateStart' AND '$dateEnd'
                        GROUP BY ANIO, MES, DIA";
                break;
        }
    
        return $this->database->query($sql);
    }
    

}