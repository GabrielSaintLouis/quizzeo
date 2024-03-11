<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!--- header à inclure dans chaque page --->

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


    <h1>Page de de connexion</h1>

    <form action="header.php" method="post">
    <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button>
        <label for="captcha">Êtes-vous un robot ?</label>
        <input type="checkbox" id="checkbox" name="checkbox" required>
        </button><br><br>
        <button type="submit">Se connecter</button><br>
    </form>

    <!--- Afficher Compte Inexistant ou Mot de passe Incorrect --->


    <p>Vous n'avez pas de compte ? <a href="inscription.php">Créer un compte</a></p>

    <?php include 'footer.php'; ?>
</body>
</html>
