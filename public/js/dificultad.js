document.addEventListener('DOMContentLoaded', function() {
    var dificultadPregunta = "{{dificultadPregunta}}"; 

    var difficultyElement = document.getElementById('difficulty-text');
    
    if (dificultadPregunta === 'facil') {
        difficultyElement.classList.add('difficulty-easy');
    } else if (dificultadPregunta === 'medio') {
        difficultyElement.classList.add('difficulty-medium');
    } else if (dificultadPregunta === 'dificil') {
        difficultyElement.classList.add('difficulty-hard');
    }
});
