<?php   
        session_start();
        $fichier = fopen("ban.csv","r");
        while (($ligne = fgetcsv($fichier)) !== false) {
            foreach ($ligne as $valeur) {
                if ($valeur === $_SESSION["email"]){
                    header("Location: ban.php");
                }
            }
        }
        // Fermer le fichier
        fclose($fichier);
    
    ?>