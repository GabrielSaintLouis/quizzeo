<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<?php
session_start();
// Inclure l'en-tête
include "header.php";
include "footer.php";
include "style.php";

// Obtenez l'e-mail de l'utilisateur connecté
$user_email = $_SESSION['email'];

// Chemin vers le fichier CSV du score de l'utilisateur
$user_score_file = "scores_$user_email.csv";

// Vérifie si le fichier CSV du score de l'utilisateur existe
if (file_exists($user_score_file)) {
    // Lire les scores de l'utilisateur à partir du fichier CSV
    $user_scores = array_map('str_getcsv', file($user_score_file));

    // Affichage des scores de l'utilisateur
    echo "<h2>Vos scores</h2>";
    echo "<table>";
    echo "<tr><th>Quiz</th><th>Score</th></tr>";
    foreach ($user_scores as $user_score) {
        echo "<tr><td>$user_score[0]</td><td>$user_score[1]</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>Aucun score trouvé pour cet utilisateur.</p>";
}
?>

</body>
</html>
