<?php
session_start();

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les valeurs du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérifie si l'utilisateur existe dans le fichier CSV
    $file = fopen('users.csv', 'r');
    if ($file !== false) {
        while (($userData = fgetcsv($file)) !== false) {
            if ($userData[1] == $email && $userData[2] == $password) {
                // L'utilisateur existe, démarre la session et redirige vers le dashboard approprié
                $_SESSION['type'] = $userData[0];
                header('Location: accueil.php');
                exit;
            }
        }
        fclose($file);
    } else {
        echo "Erreur lors de l'ouverture du fichier.";
    }
}
if (isset($_SESSION["type"])) {
    header('Location: accueil.php');
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

<header>
    <nav>
        <ul>
            <?php
            if (isset($_SESSION["type"])) {
                if ($_SESSION['type'] === "entreprise"){
                    echo '<li><a href="dashboard_business">Dashboard</a></li>';
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                }
                else if ($_SESSION["type"] === "ecole"){
                    echo '<li><a href="dashboard_school">Dashboard</a></li>';
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                }
                else if ($_SESSION["type"] === "utilisateur") {
                    echo '<li><a href="dashboard_pnj">Dashboard</a></li>';
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                }
                else if ($_SESSION["type"] === "admin") {
                    echo '<li><a href="dashboard_admin">Dashboard</a></li>';
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                }
            } 
            else {
                echo '<li><a href="index.php">Connexion</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>

<h1>Page de connexion</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit">Se connecter</button><br>
</form>

<!-- Afficher un message en cas de compte inexistant ou mot de passe incorrect -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION["type"])) {
    echo '<p style="color: red;">Mot de passe incorrect ou utilisateur inexistant.</p>';
}
?>

<p>Vous n'avez pas de compte ? <a href="inscription.php">Créer un compte</a></p>

<?php include 'footer.php'; ?>

</body>
</html>