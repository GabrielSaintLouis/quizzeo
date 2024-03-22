<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participer à un lien</title>
</head>
<body>
    <h1>Entrez un lien :</h1>
    <form action="participer.php" method="post">
        <input type="text" name="lien" placeholder="Entrez le lien ici">
        <input type="submit" value="Participer">
    </form>

    <?php
    include 'header.php';
    include 'footer.php';
    include 'style.php;';
    include 'fonction-ban.php';
    // Vérification si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérification si le champ "lien" n'est pas vide
        if (!empty($_POST['lien'])) {
            $lien = $_POST['lien'];
            // Redirection vers le lien saisi
            header("Location: $lien");
            exit; // 
        } else {
            // Affichage d'un message d'erreur si le champ est vide
            echo "<p>Veuillez entrer un lien.</p>";
        }
    }
    ?>
</body>
</html>
