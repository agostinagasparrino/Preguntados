<?php

class PreguntaModel{
    private $database;

    public function __construct($database){
        $this->database = $database;
    }
    
    public function getLastPartida(){
        $userId = $_SESSION['id'];
        $sql = "SELECT id, vidas, estado FROM partidas WHERE userId LIKE $userId ORDER BY id DESC LIMIT 1";
        $partida = $this->database->query($sql);
        if(isset($partida[0])) return $partida[0];
        else return null;
    }

    public function getPartida(){
        $partidaId = $_SESSION['partidaId'];
        $sql = "SELECT id, vidas, vidasBot, estado FROM partidas WHERE id LIKE $partidaId ORDER BY id DESC LIMIT 1";
        $partida = $this->database->query($sql);
        if(isset($partida[0])) return $partida[0];
        else return null;
    }
  
  
    public function crearPartida(){
        $userId = $_SESSION['id'];
        $sql = "INSERT INTO partidas(userId) VALUES ($userId)";
        $resultado = $this->database->execute($sql);
        $sql = "SELECT id FROM partidas WHERE userId LIKE $userId ORDER BY id DESC LIMIT 1";
        $partidaId = $this->database->query($sql);

        return $datos['partidaId']=$partidaId[0]['id'];
    }

    public function checkCheat(){
        $userId = $_SESSION['id'];

        $sql = "SELECT * FROM useranswers WHERE userId = $userId AND respuestaId IS NULL AND estado IS NULL;";
        
        $cheat = $this->database->query($sql);

        return $cheat;

    }
    
    public function getRandomQuestion()
    {
        $userId = $_SESSION['id'];
        $partidaId = $_SESSION['partidaId'];

        $this->actualizarDificultadPreguntas();

        // Determinar el nivel de jugador
        $nivelJugador = $this->determinarNivelJugador($userId);
    
        // Obtener la pregunta según la dificultad del usuario
        $preguntaId = $this->getPreguntaSegunNivelJugador($userId,$nivelJugador);
    
        if (!$preguntaId) {
            $preguntaId = $this->getPreguntaAleatoria();
        }
    
        // Insertar el registro en la tabla useranswers
        $sql = "INSERT INTO useranswers(userId, partidaId, nivel_de_jugador) VALUES ($userId, $partidaId, '$nivelJugador')";
        $userAnswer = $this->database->execute($sql);
    
        // Obtener la pregunta seleccionada
        $pregunta = $this->getPreguntaById($preguntaId);
    
        // Obtener las respuestas asociadas a la pregunta
        $respuestas = $this->getRespuestasByPreguntaId($preguntaId);
    
        // Obtener las estadísticas de la pregunta
        $estadisticasPregunta = $this->getEstadisticasPregunta($preguntaId);
    
        // Determinar la dificultad de la pregunta
        $data['pregunta'] = $this->getPreguntaById($preguntaId);
        $data['respuestas'] = $this->getRespuestasByPreguntaId($preguntaId);
        $data['nivelJugador'] = $nivelJugador;
    
        return $data;
    }

public function getPreguntaSegunNivelJugador($id,$nivelJugador)
{
    $partidaId=$_SESSION['partidaId'];
    // Mapeo de niveles a dificultades
    $mapaNivelDificultad = [
        'principiante' => 'facil',
        'intermedio' => 'media',
        'avanzado' => 'dificil',
    ];

    // Obtener la dificultad correspondiente al nivel del jugador
    $dificultadJugador = $mapaNivelDificultad[$nivelJugador];

    $sql = "SELECT id_pregunta
            FROM preguntas
            WHERE dificultad = '$dificultadJugador'
            AND id_pregunta NOT IN ( SELECT id_pregunta FROM estadistica WHERE id_partida = $partidaId )
            ORDER BY RAND() LIMIT 1";

    Logger::info("Se seleccionó una pregunta con nivel $nivelJugador y dificultad $dificultadJugador");

    $resultado = $this->database->query($sql);

    if (empty($resultado)) {
        Logger::error("No se encontraron preguntas según la dificultad del jugador.");

        // Si no hay preguntas con la dificultad deseada, obtener una pregunta random
        $sqlMedia = "SELECT id_pregunta FROM preguntas WHERE estado = 'ACTIVA'  ORDER BY RAND() LIMIT 1;";
        $preguntaMediaResult = $this->database->query($sqlMedia);

        if (!empty($preguntaMediaResult)) {
            $preguntaMediaId = $preguntaMediaResult[0]['id_pregunta'];
            return $preguntaMediaId;
        } else {
            Logger::error("No se encontraron preguntas.");
            return null;
        }
    }

    return $resultado[0]['id_pregunta'];
}

    
    
    private function getPreguntaAleatoria() {
        $sql = "SELECT id_pregunta FROM preguntas WHERE estado = 'ACTIVA' ORDER BY RAND() LIMIT 1;";
        $preguntaResult = $this->database->query($sql);
    
        if (!empty($preguntaResult)) {
            return $preguntaResult[0]['id_pregunta'];
        } else {

            return null;
        }
    }
    
    private function getPreguntaById($preguntaId) {
        $sql = "SELECT p.*, c.descripcion as categoria FROM preguntas as p JOIN categoria as c ON c.id_categoria = p.id_categoria WHERE id_pregunta = $preguntaId;";
        $preguntaResult = $this->database->query($sql);
    
        if (!empty($preguntaResult)) {
            return $preguntaResult[0];
        } else {

            return null;
        }
    }
    
    private function getRespuestasByPreguntaId($preguntaId) {
        $sql = "SELECT * FROM respuestas WHERE id_pregunta = $preguntaId ORDER BY RAND();";
        $respuestasResult = $this->database->query($sql);
    
        if (!empty($respuestasResult)) {
            return $respuestasResult;
        } else {

            return null;
        }
    }
    
    public function getNivelJugador($id)
    {
        // Obtener la cantidad de respuestas correctas e intentos del jugador
        $cantidadRespuestasCorrectas = intval($this->cantidadDeRespuestasCorrectas($id));
        $cantidadIntentos = intval($this->CantidadDeTotales($id));
    
        // Esto quiere decir que el jugador no tiene nivel porque nunca jugó
        if ($cantidadIntentos === 0) {
            return 0;  
        }
    
        // Calcular el porcentaje de respuestas correctas del jugador
        $correctas = $cantidadRespuestasCorrectas;
        $porcentajeCorrectas = ($correctas / $cantidadIntentos) * 100;
    
        return $porcentajeCorrectas;

    }
    

    public function determinarNivelJugador($id)
    {
        // Obtener el porcentaje de respuestas correctas del jugador
        $porcentajeCorrectas = $this->getNivelJugador($id);
    
        // Determinar el nivel de jugador
        $nivelJugador = null;
    
        if ($porcentajeCorrectas >= 70) {
            $nivelJugador = 'avanzado';
        } elseif ($porcentajeCorrectas >= 30) {
            $nivelJugador = 'intermedio';
        } else {
            $nivelJugador = 'principiante';
        }
    
        // Agregar mensajes de log
        Logger::info("ID del jugador: $id, Porcentaje de respuestas correctas: $porcentajeCorrectas, Nivel de jugador determinado: $nivelJugador");
    
        // Actualizar la tabla useranswers con el nivel de dificultad correspondiente
        $sql = "UPDATE useranswers
                SET nivel_de_jugador = '$nivelJugador'
                WHERE userId = $id";
    
        // Ejecutar la actualización en la base de datos
        $this->database->execute($sql);
    
        // Devolver el nivel de jugador
        return $nivelJugador;
    }
    


    
    private function cantidadDeRespuestasCorrectas($idUsuario)
    {
        $sql = "SELECT COUNT(*) AS cant_aciertos
                FROM estadistica
                WHERE id_usuario = '$idUsuario' AND respuesta = '1'";
    
        $resultado = $this->database->query($sql);
    
        return $resultado[0]["cant_aciertos"];
    }
    
    private function CantidadDeTotales($idUsuario)
    {
        $sql = "SELECT COUNT(*) AS cant_intentos
                FROM estadistica
                WHERE id_usuario = '$idUsuario'";
    
        $resultado = $this->database->query($sql);
    
        return $resultado[0]["cant_intentos"];
    }



    public function actualizarDificultadPreguntas()
{
    $sql = "SELECT 
                id_pregunta,
                SUM(CASE WHEN respuesta = '1' THEN 1 ELSE 0 END) AS porcentaje_aciertos,
                COUNT(*) AS total_apariciones
            FROM estadistica
            GROUP BY id_pregunta";

    $result = $this->database->query($sql);

    foreach ($result as $row) {
        $idPregunta = $row['id_pregunta'];
        $porcentajeAciertos = $row['porcentaje_aciertos'];
        $totalApariciones = $row['total_apariciones'];

        Logger::info("ID Pregunta: $idPregunta, Porcentaje Aciertos: $porcentajeAciertos, Total Apariciones: $totalApariciones");

        $dificultad = $this->determinarDificultadPregunta($porcentajeAciertos, $totalApariciones);

        // Agregar este código para actualizar la dificultad en la base de datos
        $this->actualizarDificultadPreguntaEnBaseDeDatos($idPregunta, $dificultad);

        Logger::info("Actualizada la dificultad para la pregunta ID $idPregunta: $dificultad");
    }
}

private function actualizarDificultadPreguntaEnBaseDeDatos($idPregunta, $dificultad)
{
    // Actualizar la dificultad en la tabla de preguntas
    $updateSql = "UPDATE preguntas SET dificultad = '$dificultad' WHERE id_pregunta = $idPregunta";
    $this->database->execute($updateSql);
}

public function determinarDificultadPregunta($porcentajeAciertos, $totalApariciones)
{
    if ($totalApariciones > 0) {
        $ratioAciertos = $porcentajeAciertos / $totalApariciones;

        Logger::info("Ratio Aciertos: $ratioAciertos");

        if ($ratioAciertos > 0.7) {
            return 'facil';
        } elseif ($ratioAciertos < 0.3) {
            return 'dificil';
        } else {
            return 'media';
        }
    } else {
        Logger::error("Total Apariciones es cero. No se puede determinar la dificultad.");
        return 'sin_datos';
    }
}


        
        public function getEstadisticasPregunta($preguntaId)
    {
        $sql = "SELECT 
                    SUM(CASE WHEN respuesta = '1' THEN 1 ELSE 0 END) AS porcentaje_aciertos,
                    COUNT(*) AS total_apariciones
                FROM estadistica
                WHERE id_pregunta = $preguntaId";

        $result = $this->database->query($sql);

        if ($result) {
            return $result[0]; 
        }

        return null;
    }
    
    
    public function getRandomQuestionBot(){
        $sql = "SELECT p.*, c.descripcion as categoria FROM preguntas as p JOIN categoria as c ON c.id_categoria = p.id_categoria WHERE `estado` = 'ACTIVA' ORDER BY RAND() LIMIT 1;";
        
        $pregunta = $this->database->query($sql);

        $preguntaId = $pregunta[0]['id_pregunta'];

        $userId = $_SESSION['id'];

        $partidaId = $_SESSION['partidaId'];

        $sql = "INSERT INTO useranswers(userId, partidaId,bot) VALUES ($userId, $partidaId, 1)";
        
        $userAnswer = $this->database->execute($sql);

        $sql = "SELECT * FROM `respuestas` WHERE  id_pregunta = $preguntaId ORDER BY RAND();";
        $respuestas = $this->database->query($sql);

        $data['preguntaId']=$preguntaId;
        $data['pregunta']=$pregunta;
        $data['respuestas']=$respuestas;

        return $data;

    }
  
    public function getRandomAnswer($preguntaId){

        $sql = "SELECT * FROM `respuestas` WHERE  id_pregunta = $preguntaId ORDER BY RAND() LIMIT 1;";
        $respuestas = $this->database->query($sql);
        $respuestaId= $respuestas[0]['id'];
        return $respuestaId;

    }


    public function getPreguntaId($respuestaId){
        $sql = "SELECT id_pregunta FROM respuestas WHERE id = $respuestaId";
        $resultado = $this->database->query($sql);
        return $resultado[0]['id_pregunta'];
    }

    public function verificarRespuesta($respuestaId){
        $sql = "SELECT * FROM respuestas WHERE id = $respuestaId AND es_correcta = 1";
        $resultado = $this->database->query($sql);
    
        return !empty($resultado) && count($resultado) > 0;
    }
    
    public function verificarTiempoRespuesta($userId){
        $sql = "SELECT id FROM useranswers WHERE userId = $userId AND respuestaId IS NULL AND estado IS NULL AND TIMESTAMPDIFF(SECOND, date, NOW()) <= 20";
    
        $resultado = $this->database->query($sql);
    
        return !empty($resultado) && count($resultado) > 0;
    }

    public function guardarRespuesta($userId, $respuestaId, $esRespuestaCorrecta)
{
    $userId = $_SESSION['id'];
    // Obtener la pregunta asociada a la respuesta
    [$idPreguntaAsociada, $esCorrectaAsociada] = $this->getPreguntaAsociada($respuestaId);
  
    // Obtener valores de useranswers, incluyendo el valor de bot
    [$_respuestaId, $bot] = $this->getUserAnswers($userId);

    // Actualizar la tabla useranswers
    $this->updateUserAnswerTable($respuestaId, $esCorrectaAsociada, $_respuestaId,$userId);

    // Obtener el id_partida de la sesión
    $idPartida = $_SESSION['partidaId'];

    // Insertar datos en la tabla estadistica solo si se cumplen las condiciones
    $this->insertEstadistica($esCorrectaAsociada, $bot, $idPreguntaAsociada, $userId, $idPartida);

}



    private function getPreguntaAsociada($respuestaId)
    {
        if ($respuestaId !== null && $respuestaId !== 'null') {
            $sql = "SELECT respuestas.id_pregunta, respuestas.es_correcta
                    FROM respuestas
                    WHERE respuestas.id = $respuestaId";
            $result = $this->database->query($sql);
    
            if (empty($result)) {
                throw new Exception("No se encontró la pregunta asociada a la respuesta con ID $respuestaId");
            }
    
            return [$result[0]['id_pregunta'], $result[0]['es_correcta']];
        }

        return [null, 0];
    }
    
    private function getUserAnswers($userId)
    {
        $sql = "SELECT id, bot FROM useranswers WHERE userId = $userId AND respuestaId IS NULL AND estado IS NULL;";
        $respuesta = $this->database->query($sql);
    
        if (empty($respuesta)) {
            throw new Exception("No se encontró un registro en useranswers para el usuario con ID $userId");
        }
    
        return [$respuesta[0]['id'], $respuesta[0]['bot']];
    }
    
 
    
    private function updateUserAnswerTable($respuestaId, $esRespuestaCorrecta, $_respuestaId, $userId)
    {
        // Verificar si el usuario tiene un registro en useranswers
        $sqlCheck = "SELECT COUNT(*) as count FROM useranswers WHERE id = $_respuestaId AND respuestaId IS NULL AND estado IS NULL";
        $count = $this->database->query($sqlCheck)[0]['count'];
    
        if ($count > 0) {
            // Si el usuario tiene un registro, actualizarlo
            $sql = "UPDATE useranswers SET respuestaId = $respuestaId, estado = $esRespuestaCorrecta WHERE id = $_respuestaId AND respuestaId IS NULL AND estado IS NULL";
        } else {
            // Si el usuario no tiene un registro, insertar uno nuevo
            $sql = "INSERT INTO useranswers (userId, respuestaId, estado) VALUES ($userId, $respuestaId, $esRespuestaCorrecta)";
        }
    
        $resultado = $this->database->execute($sql);
    
        if ($resultado === false) {
            throw new Exception("Error al actualizar o insertar en la tabla useranswers");
        }
    }
    
    
    private function insertEstadistica($esRespuestaCorrecta, $bot, $idPregunta, $userId, $idPartida)
    {

        if (($esRespuestaCorrecta == 1 && $bot == 0) || ($esRespuestaCorrecta == 0 && $bot == 0)) {
            if ($idPregunta !== null) {
                $sql = "INSERT INTO estadistica (id_pregunta, respuesta, id_usuario, id_partida, fecha)
                        VALUES ($idPregunta, $esRespuestaCorrecta, $userId, $idPartida, NOW())";
                $resultadoEstadistica = $this->database->execute($sql);

                if ($resultadoEstadistica === false) {
                    throw new Exception("Error al insertar en la tabla estadistica");
                }
            }
        }
    }


    public function terminarPartida(){
        $partidaId = $_SESSION['partidaId'];
        $sql = "UPDATE partidas SET estado=0, vidas=0, ganada=0 WHERE id LIKE $partidaId";
        $resultado = $this->database->execute($sql);
    }
    
    public function terminarPartidaBot(){
        $partidaId = $_SESSION['partidaId'];
        $sql = "UPDATE partidas SET estado=0, vidasBot=0, ganada=1 WHERE id LIKE $partidaId";
        $resultado = $this->database->execute($sql);
    }
   
    public function restarVida($vidas){
        $partidaId = $_SESSION['partidaId'];
        $vidas--;
        $sql = "UPDATE partidas SET vidas=$vidas WHERE id LIKE $partidaId";
        $resultado = $this->database->execute($sql);
    }
 
    public function restarVidaBot($vidas){
        $partidaId = $_SESSION['partidaId'];
        $vidas--;
        $sql = "UPDATE partidas SET vidasBot=$vidas WHERE id LIKE $partidaId";
        $resultado = $this->database->execute($sql);
    }

    public function terminarPorTrampa(){
        $partidaId = $_SESSION['partidaId'];
        $userId = $_SESSION['id'];

        $sql = "UPDATE partidas SET estado=0, vidas=0, ganada=0 WHERE id LIKE $partidaId";
        $resultado = $this->database->execute($sql);

        $sql = "UPDATE useranswers SET estado=0 WHERE partidaId LIKE $partidaId AND userId LIKE $userId AND estado IS NULL";
        $resultado = $this->database->execute($sql);
    }


    public function reportar($preguntaId){
        $sql = "SELECT * FROM preguntas WHERE id_pregunta = $preguntaId";
        $respuesta = $this->database->query($sql);
        if(!empty($respuesta) && count($respuesta) > 0){
            $updateSql = "UPDATE preguntas SET estado = 'REPORTADA' WHERE id_pregunta = $preguntaId";
            $this->database->execute($updateSql);
            return true;
        }else return false;
    }
    

    public function getCategorias(){
        $sql = "SELECT * FROM categoria";
        $resultado = $this->database->query($sql);
        return $resultado;
    }

    
    public function crear($pregunta, $id_categoria, $respuestas){
        $sql = "INSERT INTO preguntas(id_categoria, pregunta, estado, usuario) VALUES ($id_categoria, '$pregunta', 'INACTIVA', 1)";
        $stmtPregunta = $this->database->execute($sql);

        $sql = "SELECT id_pregunta FROM preguntas ORDER BY id_pregunta DESC LIMIT 1";
        $result = $this->database->query($sql);

        $id=$result[0]['id_pregunta'];
        
        foreach ($respuestas as $index => $respuesta) {
            if( $index == 0 ) $correcta = 1;
            else $correcta = 0;
            $sqlRespuesta = "INSERT INTO respuestas(id_pregunta, respuesta, es_correcta) VALUES ($id,'$respuesta',$correcta)";
            $stmtRespuesta = $this->database->execute($sqlRespuesta);
        }
    } 


}