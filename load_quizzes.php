<?php
// Lecture du fichier CSV
$quizzes = [];
if (($handle = fopen("quizzes.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $quizName = isset($data[0]) ? $data[0] : ''; // Assurez-vous que la clé d'index est définie
        $question = isset($data[1]) ? $data[1] : '';
        $points = isset($data[2]) ? $data[2] : '';
        $reponses = isset($data[3]) ? explode(', ', $data[3]) : array(); // Assurez-vous que la chaîne n'est pas nulle avant d'utiliser explode()

        // Stockage des données dans un tableau associatif
        $quizzes[$quizName][] = array(
            'question' => $question,
            'points' => $points,
            'reponses' => $reponses
        );
    }
    fclose($handle);
}

// Affichage des quiz
foreach ($quizzes as $quizName => $questions) {
    echo "<h2>$quizName</h2>";
    foreach ($questions as $question) {
        echo "<p><strong>Question:</strong> {$question['question']}</p>";
        echo "<p><strong>Points:</strong> {$question['points']}</p>";
        echo "<p><strong>Réponses:</strong></p>";
        echo "<ul>";
        foreach ($question['reponses'] as $reponse) {
            echo "<li>$reponse</li>";
        }
        echo "</ul>";
    }
}
?>
