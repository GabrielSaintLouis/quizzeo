<?php
session_start();

$type = $_SESSION['type'];
$mail = $_SESSION['email'];

# Stockage des quiz 
if (isset($_POST['Create_quiz'])) {
    $file = fopen('quiz.csv', 'a+');

    // Récupération des données du formulaire
    $nbq = $_POST['nbq'];
    $np = $_POST['np'];
    $nom = $_POST['name_qcm'];
    $_SESSION['nom-quiz'] =
    $lien = "http://localhost/Quizzeo/start_quiz.php?name=" . $nom;
    $time = $_POST['duree'];

    // Informations sur le quiz
    $info_quiz = [$nom, $type, $mail, $lien, $nbq, $np, $time, "En cours", "Activé"];
    $quiz = [];
    $contenu = [];

    // Boucle pour récupérer les questions, réponses et points
    for ($i = 1; $i <= $nbq; $i++) {
        $info_ques = [];
        $propositions = [];

        $question = $_POST["q$i"];

        for ($j = 1; $j <= $np; $j++) {
            $prop = $_POST["pq${i}_$j"];
            array_push($propositions, $prop);
        }

        // Ajout de la réponse et des points
        array_push($propositions, $_POST["rq$i"]);
        array_push($propositions, $_POST["point$i"]);
        
        // Ajout de la question et des propositions à $info_ques
        array_push($info_ques, $question);
        foreach ($propositions as $prop) {
            array_push($info_ques, $prop);
        }

        // Ajout de $info_ques à $contenu
        array_push($contenu, implode(", ", $info_ques));
    }

    // Ajout des informations sur le quiz et son contenu à $quiz
    array_push($quiz, implode(", ", $info_quiz));
    array_push($quiz, implode(", ", $contenu));

    // Écriture dans le fichier CSV
    fputcsv($file, $quiz);
    fclose($file); 

    // Création du fichier CSV pour stocker l'historique des participants
    $nomFichier = "Player_" . $nom . ".csv";
    if (!file_exists($nomFichier)) {
        touch($nomFichier);
        echo "Le fichier a été créé avec succès !";
    } else {
        echo "Le fichier existe déjà.";
    }

    // Redirection vers la page d'accueil
    header('location: accueil.php');
}
?>
