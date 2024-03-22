<?php
session_start();
$filename = "quiz.csv";
include "header.php";
include "footer.php";
include "style.php";
// Ouvrir le fichier CSV en mode lecture
$file = fopen($filename, "r");

// Vérifier si le fichier a été ouvert avec succès
if ($file !== false) {
    // Afficher l'en-tête du tableau
    echo "<table class='quiz-table'>";
    echo "<tr>";
    echo "<th>Nom</th>";
    echo "<th>Type</th>";
    echo "<th>Email</th>";
    echo "<th>Lien</th>";
    echo "<th>Actions</th>"; // Nouvelle colonne pour les actions
    echo "</tr>";
    
    // Parcourir chaque ligne du fichier CSV
    $count = 0; // Compteur pour les premières lignes
    while (($line = fgets($file)) !== false && $count < 4) {
        // Supprimer les éventuels espaces en début et fin de ligne
        $line = trim($line);

        // Diviser la ligne en valeurs en utilisant la virgule comme délimiteur
        $values = explode(",", $line);

        // Vérifier si la ligne contient au moins 4 valeurs
        if (count($values) >= 4) {
            // Extraire les quatre premières valeurs
            list($nom, $type, $email, $lien) = array_map('trim', array_slice($values, 0, 4));

            // Vérifier si l'email de session correspond au créateur du quiz
            if ($_SESSION['email'] === $email) {
                // Afficher les valeurs extraites dans une ligne du tableau
                echo "<tr>";
                echo "<td>$nom</td>";
                echo "<td>$type</td>";
                echo "<td>$email</td>";
                echo "<td><a href='$lien'>Lien vers le quiz</a></td>";
                // Ajout du bouton de copie du lien
                echo "<td><button onclick='copyToClipboard(\"$lien\")'>Copier le lien</button></td>";
                echo "</tr>";
                $count++; // Incrémenter le compteur
            }
        }
    }

    // Fermer le fichier
    fclose($file);

    // Fermer le tableau
    echo "</table>";
} else {
    echo "Erreur lors de l'ouverture du fichier.";
}
?>

<!-- JavaScript pour copier le lien -->
<script>
function copyToClipboard(text) {
    var input = document.createElement('textarea');
    input.innerHTML = text;
    document.body.appendChild(input);
    input.select();
    document.execCommand('copy');
    document.body.removeChild(input);
    alert("Lien copié avec succès : " + text);
}
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
    .quiz-table {
    width: 100%;
    border-collapse: collapse;
}

.quiz-table th,
.quiz-table td {
    padding: 8px;
    border: 1px solid #ddd;
    text-align: left;
}

.quiz-table th {
    background-color: #f2f2f2;
}

.quiz-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.quiz-table tr:hover {
    background-color: #f2f2f2;
}

.quiz-table a {
    text-decoration: none;
    color: #007bff;
}

.quiz-table a:hover {
    text-decoration: underline;
}

    </style>
</body>
</html>