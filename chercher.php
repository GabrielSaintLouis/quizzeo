<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chercher un lien</title>
</head>
<body>
    <?php session_start();  ?>
    <?php include "header.php" ?>
    <?php include "footer.php" ?>
    <?php include "fonction-ban.php" ?>
    <?php include "style.php" ?>
    <h1>Entrez le lien que vous souhaitez chercher :</h1>
    <form action="chercher.php" method="post">
        <input type="text" name="lien" placeholder="Entrez le lien ici">
        <button type="submit">Chercher</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifier si le lien est présent dans les données postées
        if (isset($_POST['lien']) && !empty($_POST['lien'])) {
            // Récupérer le lien entré par l'utilisateur
            $lien = $_POST['lien'];

            // Rediriger vers le lien entré par l'utilisateur
            header("Location: $lien");
            exit; // Arrêter l'exécution du script après la redirection
        } else {
            echo "<p>Veuillez entrer un lien valide.</p>";
        }
    }
    ?>
</body>
</html>
