<?php
session_start();

 // Vérifier si l'utilisateur est un joueur
 if ($_SESSION['type'] == 'utilisateur') {
    // Ouvrir le fichier CSV contenant les résultats de l'utilisateur
    $results_file = fopen('Player_' . $name_quiz . '.csv', 'r');

    if ($results_file !== false) {
        // Lire les lignes du fichier CSV et afficher les résultats de l'utilisateur
        echo "<h1>Résultats de " . $user . "</h1>";
        echo "<ul>";
        while (($data = fgetcsv($results_file, 1000, ',')) !== false) {
            echo "<li>" . $data[0] . ": " . $data[1] . "</li>";
        }
        echo "</ul>";

        // Fermer le fichier CSV
        fclose($results_file);
    } else {
        echo "Erreur: Impossible d'ouvrir le fichier des résultats.";
    }
} else {
    echo "Erreur: Vous n'avez pas l'autorisation d'accéder à cette page.";
}
?>

