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
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<?php include "header.php"; ?>
<div class="container">
<h1>Page de connexion</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Mot de passe :</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit">Se connecter</button><br><br>

</form>
<!-- Afficher un message en cas de compte inexistant ou mot de passe incorrect -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION["type"])) {
    echo '<p style="color: red;">Mot de passe incorrect ou utilisateur inexistant.</p>';
}
?>

<p>Vous n'avez pas de compte ? <a href="inscription.php">Créer un compte</a></p><br>
</div>


<?php include 'footer.php'; ?>
<script src="script.js"></script>
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Anton&family=Roboto:wght@100;300;400;500&display=swap');

    header {
        top: 0px;
        position: fixed;
        background-color: lightblue;
        width: 100%;
    }

    nav ul {
        list-style-type: none; 
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center; 
        align-items: center; 
    }

    nav ul img {
        width: auto;
        height: 50px;
    }

    body {
        font-family: "Roboto", sans-serif;
        padding: 150px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .container {
        width: 500px;
        text-align: center;
        border: 1px solid black;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    footer {
        bottom: 0px;
        position: fixed;
        width: 100%;
        text-align: center;
        height: 50px;
        background-color: lightblue;
    }

    button {
        width: 170px;
        height: 50px;
        font-family: "Anton", sans-serif;
        font-size: 15px;
        background: transparent;
        border: 1px solid black;
        border-radius: 50px;
        background-color: lightblue;
        color: white;
    }
    a {
        text-decoration: none;
        color: black
    }
    
    a:hover {
        text-decoration: underline;
    }
</style>
</html>