<?php
session_start();

include "header.php";
include "footer.php";
include "style.php";

if ($_SESSION['type'] != "utilisateur") {
    header("Location: accueil.php");
}

if (isset($_GET['name'])) {
    $name_quiz = $_GET['name'];
    $reponses_fichier = "answer_" . $name_quiz . ".csv";

    if (file_exists($reponses_fichier)) {
        $reponses_quiz = array_map('str_getcsv', file($reponses_fichier));
        $nbq = count($reponses_quiz);
        $score = 0;

        for ($i = 1; $i <= $nbq; $i++) {
            $question = "q$i";
            if (isset($_POST[$question])) {
                $reponse_utilisateur = $_POST[$question];
                $reponse_correcte = $reponses_quiz[$i - 1][1];
                if ($reponse_utilisateur === $reponse_correcte) {
                    $score++;
                }
            }
        }

        // Enregistrement du score dans un fichier CSV dédié à l'utilisateur
        $user_email = $_SESSION['email'];
        $user_score_file = "scores_$user_email.csv";

        $user_score_data = array($name_quiz, "$score/$nbq");

        if (!file_exists($user_score_file)) {
            $file = fopen($user_score_file, 'a');
            fputcsv($file, array('Quiz', 'Score')); // Écriture de l'en-tête du fichier CSV
        } else {
            $file = fopen($user_score_file, 'a');
        }

        fputcsv($file, $user_score_data); // Écriture du score de l'utilisateur dans le fichier CSV
        fclose($file);

        // Affichage des résultats
        echo "<h1>Résultats du quiz : $name_quiz</h1>";
        echo "<p>Votre score : $score / $nbq</p>";

        echo "<h2>Réponses correctes :</h2>";
        echo "<ul>";
        foreach ($reponses_quiz as $index => $reponse) {
            echo "<li>Question " . ($index + 1) . ": " . $reponse[0] . " - Réponse correcte: " . $reponse[1] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Le fichier des réponses n'existe pas.";
    }
} else {
    echo 'Nom du quiz non spécifié.';
}

$_SESSION['score'] = $score;
$_SESSION['name'] = $name_quiz;
?>
