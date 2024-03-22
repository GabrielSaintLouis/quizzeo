<?php
$filename = "quiz.csv";

// Ouvrir le fichier CSV en mode lecture
$file = fopen($filename, "r");

// Vérifier si le fichier a été ouvert avec succès
if ($file !== false) {
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

            // Afficher les valeurs extraites
            echo "Nom: $nom, Type: $type, Email: $email, Lien: $lien <br>";
        }
    }

    // Fermer le fichier
    fclose($file);
} else {
    echo "Erreur lors de l'ouverture du fichier.";
}
?>
