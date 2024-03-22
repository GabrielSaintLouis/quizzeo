<!DOCTYPE html>
<html>
<head>
    <title>Votre titre ici</title>
    <style>
        .quiz-table {
            width: 100%;
            border-collapse: collapse;
        }

        .quiz-table th, .quiz-table td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }

        .quiz-table th {
            background-color: #f2f2f2;
        }

        .quiz-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .quiz-table tr:hover {
            background-color: #ddd;
        }

        .disable-btn, .enable-btn {
            background-color: #f44336;
            border: none;
            color: white;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }

        .enable-btn {
            background-color: #4CAF50;
        }
    </style>
</head>
<body><br><br><br>
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
    echo "<th>Statut</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    
    // Parcourir chaque ligne du fichier CSV
    while (($line = fgets($file)) !== false) {
        // Supprimer les éventuels espaces en début et fin de ligne
        $line = trim($line);

        // Diviser la ligne en valeurs en utilisant la virgule comme délimiteur
        $values = explode(",", $line);

        // Vérifier si la ligne contient au moins 4 valeurs
        if (count($values) >= 4) {
            // Extraire les quatre premières valeurs
            list($nom, $type, $email, $lien) = array_map('trim', array_slice($values, 0, 4));

            // Afficher les valeurs extraites dans une ligne du tableau
            echo "<tr>";
            echo "<td>$nom</td>";
            echo "<td>$type</td>";
            echo "<td>$email</td>";
            echo "<td><a href='$lien'>Lien vers le quiz</a></td>";
            
            // Vérifier si le quiz est activé ou désactivé
            $status = $_SESSION[$email] ?? "Activé";
            echo "<td>$status</td>";

            // Bouton pour activer ou désactiver le quiz
            echo "<td>";
            if ($status === "Activé") {
                echo "<form method='post'><input type='hidden' name='email' value='$email'><input type='submit' class='disable-btn' name='disable' value='Désactiver'></form>";
            } else {
                echo "<form method='post'><input type='hidden' name='email' value='$email'><input type='submit' class='enable-btn' name='enable' value='Réactiver'></form>";
            }
            echo "</td>";
            
            echo "</tr>";
        }
    }

    // Fermer le fichier
    fclose($file);

    // Fermer le tableau
    echo "</table>";
} else {
    echo "Erreur lors de l'ouverture du fichier.";
}

// Traitement des formulaires
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Traitement de la désactivation
    if (isset($_POST['disable'])) {
        $email = $_POST['email'];
        $_SESSION[$email] = "Désactivé";
        // Actualiser la page pour afficher les changements
        echo "<meta http-equiv='refresh' content='0'>";
    }
    // Traitement de la réactivation
    if (isset($_POST['enable'])) {
        $email = $_POST['email'];
        $_SESSION[$email] = "Activé";
        // Actualiser la page pour afficher les changements
        echo "<meta http-equiv='refresh' content='0'>";
    }
}
?>
</body>
</html>
