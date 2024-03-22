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
    
    // Formulaire de création du quiz adapté en fonction du type de compte qui le crée 
    echo "<div class='container'>";
    echo "<form action='action.php' method='post'>";
    echo "<input type='hidden' name='nbq' value='" . $_POST['nbq'] . "'>";
    echo "<input type='hidden' name='np' value='" . $_POST['np'] . "'>";
    
    if ($type === "ecole") {
        echo "<input type='text' name='name_qcm' placeholder='Intitulé du qcm'><br><br>";
        echo "<input type='number' name='duree' placeholder='Durée du qcm en minutes'><br>";
        
        for ($i = 1; $i <= $nbq; $i++) {
            echo "<div>";
            echo "<input type='text' name='q$i' placeholder='Entrer la question $i'><br>";
            echo "<ul>";
            for ($j = 1; $j <= $np; $j++) {
                echo "<li><input type='text' name='pq{$i}_{$j}' placeholder='Proposition $j'></li><br>";
            }
            echo "<input type='text' name='rq$i' placeholder='Entrer la bonne réponse'><br>";
            echo "<input type='number' name='point$i' placeholder='POINTS'><br>";
            echo "</ul><br>";
            echo "</div>";
        }
    } elseif ($type == "entreprise") {
        echo "<input type='text' name='name_qcm' placeholder='Intitulé du qcm'><br><br>";
        echo "<input type='number' name='duree' placeholder='Durée du qcm en minutes'><br>";
        
        for ($i = 1; $i <= $nbq; $i++) {
            echo "<div>";
            echo "<input type='text' name='q$i' placeholder='Entrer la question $i'><br>";
            echo "<ul>";
            for ($j = 1; $j <= $np; $j++) {
                echo "<li><input type='text' name='pq{$i}_{$j}' placeholder='Proposition $j'></li><br>";
            }
            echo "</ul><br>";
            echo "</div>";
        }
    }

    echo "<input type='submit' name='Create_quiz' value='Terminer'>";
    echo "</form></div>";
} 
?>
<style>
 /* CSS style */
.boite_d {
  font-family: Arial, sans-serif;
}

.content {
  color: #333;
}

input[type="number"],
input[type="submit"] {
  margin: 10px 0;
  padding: 8px;
  width: 100%;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 3px;
  background-color: white;
  color: #333;
}

input[type="submit"] {
  background-color: #fff;
  color: #333;
  border: 1px solid #ccc;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #f2f2f2;
}

.error-message {
  color: #f00;
  font-size: 14px;
  margin-top: 5px;
}

.container {
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
