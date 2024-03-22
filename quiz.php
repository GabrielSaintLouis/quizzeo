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
if(isset($_POST['nbq']) && isset($_POST['np'])) {
    $nbq = $_POST['nbq'];
    $np = $_POST['np'];
    echo "<br><h1>Créez votre Quiz !</h1> ";
    // Formulaire de création du quiz adapté en fonction du type de compte qui le crée 
    echo "<div class='container'>";
    echo "<form action='action.php' method='post'>";
    echo "<input type='hidden' name='nbq' value='" . $_POST['nbq'] . "'>";
    echo "<input type='hidden' name='np' value='" . $_POST['np'] . "'>";
    
    if ($type === "ecole" || $type === "entreprise") {
        echo "<input type='text' name='name_qcm' placeholder='Intitulé du qcm'><br>";
        echo "<input type='number' name='duree' placeholder='Durée du qcm en minutes'><br>";
        
        for ($i = 1; $i <= $nbq; $i++) {
            echo "<div class='neuille'>";
            echo "<input type='text' name='q$i' placeholder='Entrer la question $i'><br>";
            echo "<ul>";
            for ($j = 1; $j <= $np; $j++) {
                echo "<li><input type='text' name='pq{$i}_{$j}' placeholder='Proposition $j'></li>";
            }
            echo "</ul>";
            echo "<input type='text' name='rq$i' placeholder='Entrer la bonne réponse'><br>";
            // Supprimer le champ pour le nombre de points
            echo "</div>";
        }
    } 

    echo "<input type='submit' name='Create_quiz' value='Terminer'>";
    echo "</form></div>";
} 
?>
</body>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

input[type="text"],
input[type="number"],
input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

ul {
    list-style-type: none;
    padding: 0;
}

li input[type="text"] {
    width: calc(100% - 20px); /* Ajuste la largeur pour tenir compte de la marge du li */
    margin-bottom: 5px;
}

.neuille {
    background-color: #f9f9f9;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

</style>
</html>
