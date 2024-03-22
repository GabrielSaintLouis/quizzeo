<?php
session_start();

// Les fonctions ind_debut et ind_fin vont nous aider à parcourir le fichier csv 
if ($_SESSION['type'] != "utilisateur") {
    header("Location: accueil.php");
}

function ind_debut($nb, $t) {
    return $nb * ($t + 3);
}

function ind_fin($nb, $t) {
    return $t + 2 + $nb * ($t + 3);
}

if (isset($_GET['name'])) {
    $name_quiz = $_GET['name'];
    $file = 'quiz.csv';
    $quiz_found = false;

    if (($handle = fopen($file, 'r')) !== false) {
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $test_info = str_getcsv($data[0]); //  Transforme ma chaîne de caractères en tableau afin  d'y accéder plus facilement

            if ($test_info[0] == $name_quiz) {
                $quiz_found = true;   
                $quiz = $data;     //Récupère la ligne csv correspondant au quiz 
                break;
            }
        }
        fclose($handle);
    }

    if ($quiz_found) {
        // Convertir la ligne CSV en tableau
        $info_quiz = str_getcsv($quiz[0]);
        $contenu = str_getcsv($quiz[1]);

        $nbq = $info_quiz[4];
        $np = $info_quiz[5];
        $duree = $info_quiz[6];
        $role_creator =  $info_quiz[1];

        $reponses_quiz = fopen("answer_".$name_quiz.".csv", "w");  //  Ouvre un fichier pour stocker les réponses 

        echo  "<form action='resultats.php?name=".$name_quiz."&nbq=".$nbq."&role_creator=".$role_creator."' method='post' >";
        
        echo "<h1> Intitulé du quiz : ".$info_quiz[0]."</h1>" ;
        echo "<div class='minuteur' id='minuteur'></div>";
       
        
        for ($i = 0; $i < $nbq; $i++) {  // Crée une div à chaque itération pour  afficher le contenu de chaque question
            $question = array();
            $debut_question = ind_debut($i, $np) ;
            $fin_question = ind_fin($i, $np);
            
            for ($j = $debut_question; $j <= $fin_question; $j++) {   // Récupère à chaque itération  une question et ses propositions
                $question[] = $contenu[$j];
            }

            
            echo "<div>";
            echo "Question n°" . ($i + 1) . " : " . $question[0] . "<br />";
            for ($k = 1; $k <= $np; $k++) {
                echo "<label>";
                echo "<input type='radio' name='q".($i + 1)."' value='" . $question[$k] . "'>" . $question[$k] . "<br />";
                echo "</label><br />";
            }
            echo "</div>";

            //Récupère pour chaque question la bonne réponse et sa valeur 
            $rep = [ $question[0], $question[$np + 1], $question[$np + 2]];
            fputcsv($reponses_quiz,$rep);  
        }

        fclose( $reponses_quiz );

        echo "<div>";
        echo "<button id='startTimer' >Terminer</button>";
        echo "<input type = 'submit' class = 'submitBtn' value = 'Terminer'>";
        echo "</div>";

        echo "</form>";

    } else {
        echo 'Quiz non trouvé.';
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .minuteur {
            font-size: 24px;
            text-align: center;
        }

        .submitBtn{
            display: none; /* Cache la boîte de dialogue par défaut */
            position: fixed;
        }
    </style>
</head>
<body>
    <?php include "header.php" ?>
    <?php include "footer.php" ?>
    <?php include "style.php" ?>

    <script>
      <script>

    stopButton.addEventListener('click', function() {
        window.location.href = this.action; // Redirige vers la page resultat.php

        // Enregistrement du nombre de réponses dans un fichier CSV
        const nbReponsesFile = "nb_reponses.csv";
        const formData = new FormData();
        formData.append('nb_reponses', 1); // 1 représente une réponse supplémentaire

        fetch(nbReponsesFile, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur lors de l\'enregistrement du nombre de réponses.');
                }
                return response.text();
            })
            .then(data => console.log(data))
            .catch(error => console.error(error));
    });
</script>

    </script>
</body>
</html>
