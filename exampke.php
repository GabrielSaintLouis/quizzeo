<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifiez les informations de connexion à partir du fichier CSV
    $users = array_map('str_getcsv', file('users.csv'));
    foreach ($users as $user) {
        if ($user[0] == $email && $user[1] == $password) {
            $_SESSION['email'] = $email;
            header("Location: index.php");
            exit;
        }
    }

    // Ajouter un nouvel utilisateur au fichier CSV
    $newUser = [$email, $password];
    $file = fopen('users.csv', 'a');
    fputcsv($file, $newUser);
    fclose($file);

    $_SESSION['email'] = $email;
    header("Location: accueil.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h1>Page de connexion</h1>
    <form action="index.php" method="post">
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Se connecter</button><br>
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>
