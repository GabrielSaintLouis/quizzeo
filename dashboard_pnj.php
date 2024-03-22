<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 10px;
        }

        .scores-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 24px;
        }

        .scores-table th, .scores-table td {
            padding: 20px; 
            text-align: left;
            border-bottom: 3px solid #ddd; 
        }

        .scores-table th {
            background-color: #f2f2f2;
            font-size: 28px; 
        }

        .scores-table tr:hover {
            background-color: #f5f5f5;
        }

        .message {
            font-style: italic;
            color: #666;
            font-size: 24px; 
        }
    </style>
</head>
<body>

<?php
session_start();
// Inclure l'en-tête
include "header.php";
include "footer.php";
include "style.php";

// e-mail de l'utilisateur connecté
$user_email = $_SESSION['email'];

// fichier CSV du score de l'utilisateur
$user_score_file = "scores_$user_email.csv";

// l'utilisateur existe ?
if (file_exists($user_score_file)) {
    // score du joueur dans le fichier csv
    $user_scores = array_map('str_getcsv', file($user_score_file));

    // Affichage des scores de l'utilisateur
    echo "<div class='container'>";
    echo "<h2>Vos scores</h2>";
    echo "<table class='scores-table'>";
    echo "<tr><th>Quiz</th><th>Score</th></tr>";
    foreach ($user_scores as $user_score) {
        echo "<tr><td>$user_score[0]</td><td>$user_score[1]</td></tr>";
    }
    echo "</table>";
    echo "</div>";
} else {
    echo "<p class='message'>Aucun score trouvé pour cet utilisateur.</p>";
}
?>

</body>
</html>
