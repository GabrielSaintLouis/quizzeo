<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création Quiz</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body>
 
<?php
session_start();
include "header.php";
include "footer.php";
include "style.php";
$type = $_SESSION['type'] ;


// Vérifie si les champs ont été remplis puis récupère les valeurs et crée un formulaire sur la base  de ces données
if(isset($_POST[ 'nbq'])  && isset($_POST['np'])) {
    $nbq=$_POST['nbq'];
    $np=$_POST['np'] ;

    // Formulaire de création du quiz adapté en fonction du type de compte qui le crée 

    echo "<div class='container'<form action='action.php?nbq=".$nbq."&np=".$np."' method='post'>";
    if ($type === "ecole"){

        echo "<input type ='text' name = 'name_qcm'  placeholder= 'Intitulé du qcm '>";
        echo "<br><br>";
        echo "<input type ='number' name = 'duree'  placeholder= 'Durée du qcm en minutes '>"."<br>";
        
        // A chaque itération une div sera créée avec des zones de texte respectivement pour la question, les propsitions, la réponse et la valeur de la question
        for ($i = 1; $i <= $nbq; $i++)  {
            echo "<div>";
            echo "<input type ='text' name = 'q".$i."'  placeholder='Entrer la question " . $i . "'>" ."<br>";
            echo "<ul>";
            for ($j = 1; $j <= $np; $j++) {
                echo "<li><input type ='text' name = 'pq".$i."_".$j."' placeholder='Proposition " . $j . "'></li>" . '<br>';
            }
            echo "<input type ='text' name = 'rq".$i."'  placeholder='Entrer la bonne réponse'>" . '<br>';
            echo "<input type ='number' name = 'point".$i."'  placeholder='POINTS'>" . '<br>';
            
            echo  "</ul><br>";
            echo "</div>";
            
        }
    
    }
    elseif($type=="entreprise"){
        

        echo "<input type ='text' name = 'name_qcm'  placeholder= 'Intitulé du qcm '>";
        echo "<br></br>";
        echo "<input type ='number' name = 'duree'  placeholder= 'Durée du qcm en minutes '>"."<br>";
    
        
        // A chaque itération une div sera créée avec des zones de texte respectivement pour la question et  les propsitions
        for ($i = 1; $i <= $nbq; $i++)  {
            echo "<div>";
            echo "<input type ='text' name = 'q".$i."'  placeholder='Entrer la question " . $i . "'>" ."<br>";
          
            echo "<ul>";
            for ($j = 1; $j <= $np; $j++) {
                echo "<li><input type ='text' name = 'pq".$i."_".$j."' placeholder='Proposition " . $j . "'></li>" . '<br>';
            }
            
            echo  "</ul><br>";
            echo "</div>";
            
        }
    }

echo "<input type='submit' name = 'Create_quiz' value='Terminer'>";
echo "</form></div>";
} 
?>
<style>
 /* Nouveau style CSS pour la boîte de dialogue */
.boite_d {
  font-family: Arial, sans-serif; /* Utilisation d'une police de caractères différente */
}

.content {
  color: #333; /* Couleur du texte */
}

input[type="number"],
input[type="submit"] {
  margin: 10px 0; /* Marge autour des champs de saisie et du bouton */
  padding: 8px; /* Rembourrage des champs de saisie */
  width: 100%; /* Largeur des champs de saisie */
  box-sizing: border-box; /* Boîte de modèle de taille de bordure */
  border: 1px solid #ccc; /* Bordure des champs de saisie */
  border-radius: 3px; /* Bordure arrondie */
  background-color: white; /* Fond blanc pour les champs de saisie et le bouton */
  color: #333; /* Couleur du texte pour les champs de saisie */
}

input[type="submit"] {
  background-color: #fff; /* Couleur de fond blanche pour le bouton Soumettre */
  color: #333; /* Couleur du texte pour le bouton Soumettre */
  border: 1px solid #ccc; /* Bordure du bouton Soumettre */
  cursor: pointer; /* Curseur pointeur pour le bouton Soumettre */
}

input[type="submit"]:hover {
  background-color: #f2f2f2; /* Couleur de fond au survol du bouton Soumettre */
}

/* Style pour les messages d'erreur */
.error-message {
  color: #f00; /* Couleur rouge pour les messages d'erreur */
  font-size: 14px; /* Taille de police pour les messages d'erreur */
  margin-top: 5px; /* Marge supérieure pour les messages d'erreur */
}

.container {
  background-color: #fff; /* Fond blanc pour le conteneur */
  border: 1px solid #ccc; /* Bordure grise autour du conteneur */
  border-radius: 5px; /* Bordure arrondie du conteneur */
  padding: 20px; /* Espacement interne du conteneur */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère autour du conteneur */
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}

ul li {
    list-style-type: none;
}


</style>
</body>
</html>