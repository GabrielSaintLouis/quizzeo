<?php
session_start();

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les valeurs du formulaire
    $email = $_POST['email'];
    $_SESSION['email'] = $email;
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
<header>
    <nav>
        <ul>
            <img src="quizzeo.png" alt="quizzeo">
        </ul>
    </nav>
</header>
<body>
<div class="container">
<h1>Page de connexion</h1>
<form action="index.php" method="post">
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required><br><br>
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required><br><br>
    <button type="submit" id = "connexion">Se connecter</button><br><br>

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

body {
    font-family: "Roboto", sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    border: 1px solid black;
    width: 500px;
    padding: 20px; /* Ajout de padding */
    text-align: center;
    background-color: white;
    display: flex; /* Utilisation de flexbox */
    flex-direction: column; /* Pour aligner les éléments en colonne */
    align-items: center;
}

form {
    width: 100%; /* S'assurer que le formulaire occupe toute la largeur du conteneur */
    max-width: 300px; /* Limitation de la largeur pour éviter un étirement excessif */
    display: flex;
    flex-direction: column;
    align-items: center;
}

label {
    font-size: 18px;
    font-weight: bold; 
}

input {
    margin-bottom: 10px;
    width: 100%; 
    padding: 8px; 
    box-sizing: border-box; 
}

button {
    width: 200px;
    height: 50px;
    font-family: "Anton", sans-serif;
    font-size: 15px;
    background: red;
    color: white;
    border: 1px solid black;
}

p {
    margin-top: 20px;
}

/* Footer */
footer {
    bottom: 0px;
    position: fixed;
    width: 100%;
    text-align: center;
    height: 50px;
    background-color: lightblue;
}

/* Header */
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

a {
    text-decoration: none;
    color: black
}

a:hover {
    text-decoration: underline;
}

</style>
</html>