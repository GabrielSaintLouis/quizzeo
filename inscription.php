<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $type = $_POST['type'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $userData = [$type, $email, $password];
    
    $file = fopen('users.csv', 'w');
    if ($file !== false) {
 
        fputcsv($file, $userData);

        fclose($file);
        header('Location: index.php');
    } 
    else {
        echo "Erreur lors de l'ouverture du fichier.";
    }
}
?>
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

    <h1>Page de d'inscription</h1>
    <form action="inscription.php" method="post">
        <label for="type">Type: </label><br>
        <select name="type" id="option_type" required>
            <option value="entreprise">Entreprise</option>
            <option value="ecole">Ecole</option>
            <option value="utilisateur">Utilisateur</option>
        </select><br><br>
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button>
        <label for="captcha">Êtes-vous un robot ?</label>
        <input type="checkbox" id="checkbox" name="checkbox" required>
        </button><br><br>
        <button type="submit">S'inscrire</button><br>
    </form>
    <?php include 'footer.php'; ?>
</body>
</html>
