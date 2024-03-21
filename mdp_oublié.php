<?php
session_start();

// Fonction pour vérifier si l'email existe dans le fichier CSV
function emailExists($email) {
    $file = fopen('users.csv', 'r');
    if ($file !== false) {
        while (($data = fgetcsv($file)) !== false) {
            if ($data[1] === $email) {
                fclose($file);
                return true;
            }
        }
        fclose($file);
    }
    return false;
}

// Fonction pour mettre à jour le mot de passe dans le fichier CSV
function updatePassword($email, $newPassword) {
    $file = file('users.csv');
    $newData = [];
    foreach ($file as $line) {
        $data = str_getcsv($line);
        if ($data[1] === $email) {
            $data[2] = $newPassword; // Mettre à jour le mot de passe
        }
        $newData[] = implode(',', $data);
    }
    file_put_contents('users.csv', implode("\n", $newData));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword && emailExists($email)) {
        // Mettre à jour le mot de passe
        updatePassword($email, $newPassword);

    } else {
        $error = "L'adresse e-mail n'existe pas ou les mots de passe ne correspondent pas.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Connexion</a></li>
                <li><a href="inscription.php">Inscription</a></li>
            </ul>
        </nav>
    </header>
    <?php include "style.php" ?>
    <div class="container">
    <h2>Réinitialisation du mot de passe</h2>
    <form onsubmit="mdpconfirm()" method="post">
        <label for="email">Adresse e-mail :</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="new_password">Nouveau mot de passe :</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>
        <label for="confirm_password">Confirmer le nouveau mot de passe :</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <button type="submit" id="valider">Réinitialiser</button><br>
    </form>
    </div>
    <?php include "footer.php" ?>
<script>
    function mdpconfirm() {
        alert("Le mot de passe a bien été changé.")
    }
</script>
</body>
<style>
     @import url('https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@100;300;400;500&display=swap');
    header {
        top: 0px;
        position: fixed;
        background-color: rgba(255,255,255,0.8);
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    nav ul li {
        list-style: none;
        display: inline;
        margin-right: 20px;
    }

    nav ul li a {
        text-decoration: none;
        color: black;
    }

    nav ul li a:hover {
        text-decoration: underline;
    }

    
.container {
    border: 1px solid black;
    width: 600px;
    text-align: center;
    background-color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-radius:  20px;
    background-color: rgba(255, 255, 255, 0.8);
}

#valider {
    width: 170px;
    height: 50px;
    font-family: "Anton", sans-serif;
    font-size: 15px;
    background: red;
    color: white;
    border: 1px solid black;
}

form {
    width: 100%; /* S'assurer que le formulaire occupe toute la largeur du conteneur */
    max-width: 300px; /* Limitation de la largeur pour éviter un étirement excessif */
    display: flex;
    flex-direction: column;
    align-items: center;
    font-weight: bold;
}

input {
    margin-bottom: 4px;
    width: 100%; 
    padding: 8px; 
    box-sizing: border-box; 
    text-align: center;
}
select {
    margin-bottom: 10px;
    width: 100%;
    padding: 8px;
    text-align: center;
    border: 1px solid black;
}

form select {
    background: transparent ;
}

</style>
</html>

