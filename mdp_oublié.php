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
    <?php include "style.php" ?>
    <h2>Réinitialisation du mot de passe</h2>
    <form onsubmit="mdpconfirm()" method="post">
        <label for="email">Adresse e-mail :</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="new_password">Nouveau mot de passe :</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>
        <label for="confirm_password">Confirmer le nouveau mot de passe :</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        <button type="submit">Réinitialiser le mot de passe</button>
    </form>
    <?php include "footer.php" ?>
<script>
    function mdpconfirm() {
        alert("Le mot de passe a bien été changé.")
    }
</script>
</body>
</html>

